<?php
class PARSEENTRIES
{
        function PARSEENTRIES()
        {
                $this->preamble = $this->strings = $this->undefinedStrings = $this->entries = array();
                $this->count = 0;
                $this->fieldExtract = TRUE;
                $this->removeDelimit = TRUE;
                $this->expandMacro = FALSE;
                $this->parseFile = TRUE;
                $this->outsideEntry = TRUE;
        }
// Open bib file
        function openBib($file)
        {
                if(!is_file($file))
                        die;
                $this->fid = fopen ($file,'r');
                $this->parseFile = TRUE;
        }
// Load a bibtex string to parse it
        function loadBibtexString($bibtex_string)
        {
                if(is_string($bibtex_string))
                        $this->bibtexString = explode("\n",$bibtex_string);
                else
                        $this->bibtexString = $bibtex_string;
                $this->parseFile = FALSE;
                $this->currentLine = 0;
        }
	function loadStringMacro($macro_array)
        {
                $this->userStrings = $macro_array;
        }
// Close bib file
        function closeBib()
        {
                fclose($this->fid);
        }
// Get a non-empty line from the bib file or from the bibtexString
        function getLine()
        {
                if($this->parseFile)
                {
                        if(!feof($this->fid))
                        {
                                do
                                {
                                        $line = trim(fgets($this->fid));
                                }
                                while(!feof($this->fid) && !$line);
                                return $line;
                        }
                        return FALSE;
                }
                else
                {
                        do
                        {
                                $line = trim($this->bibtexString[$this->currentLine]);
                                $this->currentLine++;
                        }
                        while($this->currentLine < count($this->bibtexString) && !$line);
                        return $line;
                }
        }
	function extractStringValue($string)
        {
                // $string contains a end delimiter, remove it
                $string = trim(substr($string,0,strlen($string)-1));
                // remove delimiters and expand
                $string = $this->removeDelimitersAndExpand($string);
                return $string;
        }
// Extract a field
        function fieldSplit($seg)
        {
// echo "**** ";print_r($seg);echo "<BR>";
                // handle fields like another-field = {}
                $array = preg_split("/,\s*([-_.:,a-zA-Z0-9]+)\s*={1}\s*/U", $seg, PREG_SPLIT_DELIM_CAPTURE);
// echo "**** ";print_r($array);echo "<BR>";
                //$array = preg_split("/,\s*(\w+)\s*={1}\s*/U", $seg, PREG_SPLIT_DELIM_CAPTURE);
                if(!array_key_exists(1, $array))
                        return array($array[0], FALSE);
                return array($array[0], $array[1]);
        }
	function reduceFields($oldString)
        {
                // 03/05/2005 G. Gardey. Do not remove all occurences, juste one
                // * correctly parse an entry ended by: somefield = {aValue}}                $lg = strlen($oldString);
                if($oldString[$lg-1] == "}" || $oldString[$lg-1] == ")" || $oldString[$lg-1] == ",")
                        $oldString = substr($oldString,0,$lg-1);
                // $oldString = rtrim($oldString, "}),");
                $split = preg_split("/=/", $oldString, 2);
                $string = $split[1];
                while($string)
                {
                        list($entry, $string) = $this->fieldSplit($string);
                        $values[] = $entry;
                }
                foreach($values as $value)
                {                        $pos = strpos($oldString, $value);
                        $oldString = substr_replace($oldString, '', $pos, strlen($value));
                }
                $rev = strrev(trim($oldString));
                if($rev{0} != ',')
                        $oldString .= ',';
                $keys = preg_split("/=,/", $oldString);                // 22/08/2004 - Mark Grimshaw
                // I have absolutely no idea why this array_pop is required but it is.  Seems to always be 
                // an empty key at the end after the split which causes problems if not removed.
                array_pop($keys);
                foreach($keys as $key)
                {
                        $value = trim(array_shift($values));
                        $rev = strrev($value);
                        // remove any dangling ',' left on final field of entry
                        if($rev{0} == ',')
                                $value = rtrim($value, ",");
                        if(!$value)
                                continue;                        // 21/08/2004 G.Gardey -> expand macro
                        // Don't remove delimiters now needs to know if the value is a string macro
                        $key = strtolower(trim($key));
                        $value = trim($value);
                        $this->entries[$this->count][$key] = $value;
                }
// echo "**** ";print_r($this->entries[$this->count]);echo "<BR>";
        }
// Start splitting a bibtex entry into component fields.
// Store the entry type and citation.
        function fullSplit($entry)
        {
                $matches = preg_split("/@(.*)[{(](.*),/U", $entry, 2, PREG_SPLIT_DELIM_CAPTURE);
                $this->entries[$this->count]['bibtexEntryType'] = strtolower(trim($matches[1]));
                // sometimes a bibtex entry will have no citation key
                if(preg_match("/=/", $matches[2])) // this is a field
                        $matches = preg_split("/@(.*)\s*[{(](.*)/U", $entry, 2, PREG_SPLIT_DELIM_CAPTURE);
                // print_r($matches); print "<P>";
                $this->entries[$this->count]['bibtexCitation'] = $matches[2];
                $this->reduceFields($matches[3]);
        }

	function parseEntry($entry)
        {
                $count = 0;
                $lastLine = FALSE;
                if(preg_match("/@(.*)([{(])/U", preg_quote($entry), $matches))
                {
                        if(!array_key_exists(1, $matches))
                                return $lastLine;
                        if(preg_match("/string/i", trim($matches[1])))
                                $this->strings[] = $entry;                        else if(preg_match("/preamble/i", trim($matches[1])))
                                $this->preamble[] = $entry;
                        else if(preg_match("/comment/i", $matches[1])); // MG (31/Jan/2006) -- ignore @comment
                        else
                        {
                                if($this->fieldExtract)
                                        $this->fullSplit($entry);
                                else
                                        $this->entries[$this->count] = $entry;
                                $this->count++;
                        }
                        return $lastLine;
                }
        }
	function removeDelimiters($string)
        {
                if($string  && ($string{0} == "\""))
                {
                        $string = substr($string, 1);
                        $string = substr($string, 0, -1);
                }
                else if($string && ($string{0} == "{"))
                {
                        if(strlen($string) > 0 && $string[strlen($string)-1] == "}")
                        {
                                $string = substr($string, 1);
                                $string = substr($string, 0, -1);                        }
                }                else if(!is_numeric($string) && !array_key_exists($string, $this->strings)
                         && (array_search($string, $this->undefinedStrings) === FALSE))
                {
                        $this->undefinedStrings[] = $string; // Undefined string that is not a year etc.
                        return '';
                }
                return $string;
        }

	 function explodeString($val)
        {
                $openquote = $bracelevel = $i = $j = 0;
                while ($i < strlen($val))
                {
                        if ($val[$i] == '"')
                                $openquote = !$openquote;
                        elseif ($val[$i] == '{')
                                $bracelevel++;
                        elseif ($val[$i] == '}')
                                $bracelevel--;
                        elseif ( $val[$i] == '#' && !$openquote && !$bracelevel )
                        {
                                $strings[] = substr($val,$j,$i-$j);
                                $j=$i+1;
                        }
                        $i++;
                }
                $strings[] = substr($val,$j);
                return $strings;
        }

	function closingDelimiter($val,$delimitEnd)
        {
//  echo "####>$delimitEnd $val<BR>";
                $openquote = $bracelevel = $i = $j = 0;
                while ($i < strlen($val))
                {
                        // a '"' found at brace level 0 defines a value such as "ss{\"o}ss"
                        if ($val[$i] == '"' && !$bracelevel)
                                $openquote = !$openquote;
                        elseif ($val[$i] == '{')
                                $bracelevel++;
                        elseif ($val[$i] == '}')
                                $bracelevel--;
                        if ( $val[$i] == $delimitEnd && !$openquote && !$bracelevel )
                                return $i;
                        $i++;
                }
// echo "--> $bracelevel, $openquote";
                return 0;
        }
	function removeDelimitersAndExpand($string, $inpreamble = FALSE)
        {
                // only expand the macro if flag set, if strings defined and not in preamble
                if(!$this->expandMacro || empty($this->strings) || $inpreamble)
                        $string = $this->removeDelimiters($string);
                else
                {
                        $stringlist = $this->explodeString($string);
                        $string = "";
                        foreach ($stringlist as $str)
                        {
                                // trim the string since usually # is enclosed by spaces
                                $str = trim($str);
                                // replace the string if macro is already defined
                                // strtolower is used since macros are case insensitive
                                if (isset($this->strings[strtolower($str)]))
                                        $string .= $this->strings[strtolower($str)];
                                else
                                        $string .= $this->removeDelimiters(trim($str));
                        }
                }
                return $string;
        }
	function extractEntries()
        {
                $inside = $possibleEntryStart = FALSE;
                $entry="";
                while($line=$this->getLine())
                {
                        if($possibleEntryStart)
                                $line = $possibleEntryStart . $line;
                        if (!$inside && strchr($line,"@"))
                        {
                                // throw all characters before the '@'
                                $line=strstr($line,'@');
                                if(!strchr($line, "{") && !strchr($line, "("))
                                        $possibleEntryStart = $line;
                                elseif(preg_match("/@.*([{(])/U", preg_quote($line), $matches))
                                {
                                        $inside = TRUE;
                                        if ($matches[1] == '{')
                                                $delimitEnd = '}';
                                        else
                                                $delimitEnd = ')';
                                        $possibleEntryStart = FALSE;
                                }
                        }
                        if ($inside)
                        {
                                $entry .= " ".$line;
                                if ($j=$this->closingDelimiter($entry,$delimitEnd))
                                {
                                        // all characters after the delimiter are thrown but the remaining 
                                        // characters must be kept since they may start the next entry !!!
                                        $lastLine = substr($entry,$j+1);
                                        $entry = substr($entry,0,$j+1);
                                        // Strip excess whitespaces from the entry 
                                        $entry = preg_replace('/\s\s+/', ' ', $entry);
                                        $this->parseEntry($entry);
                                        $entry = strchr($lastLine,"@");
                                        if ($entry)
                                                $inside = TRUE;
                                        else
			                $inside = FALSE;
                                }
                        }
                }
        }
	 function returnArrays()        {
                foreach($this->preamble as $value)
                {
                        preg_match("/.*?[{(](.*)/", $value, $matches);
                        $preamble = substr($matches[1], 0, -1);
                        $preambles['bibtexPreamble'] = trim($this->removeDelimitersAndExpand(trim($preamble), TRUE));                }
                if(isset($preambles))
                        $this->preamble = $preambles;                if($this->fieldExtract)
                {                        
                       $strings = $this->strings;
                        foreach($strings as $value)                        {
                                // changed 21/08/2004 G. Gardey
                                // 23/08/2004 Mark G. account for comments on same line as @string - count delimiters in string value
                                $value = trim($value);
                                $matches = preg_split("/@\s*string\s*([{(])/i", $value, 2, PREG_SPLIT_DELIM_CAPTURE);
                                $delimit = $matches[1];
                                $matches = preg_split("/=/", $matches[2], 2, PREG_SPLIT_DELIM_CAPTURE);
                                // macros are case insensitive
                                $this->strings[strtolower(trim($matches[0]))] = $this->extractStringValue($matches[1]);
                        }
                }
                // changed 21/08/2004 G. Gardey
		// 22/08/2004 Mark Grimshaw - stopped useless looping.
                // removeDelimit and expandMacro have NO effect if !$this->fieldExtract
                if($this->removeDelimit || $this->expandMacro && $this->fieldExtract)
                {
                        for($i = 0; $i < count($this->entries); $i++)
                        {
                                foreach($this->entries[$i] as $key => $value)
                                // 02/05/2005 G. Gardey don't expand macro for bibtexCitation 
                                // and bibtexEntryType
                                if($key != 'bibtexCitation' && $key != 'bibtexEntryType')
                                        $this->entries[$i][$key] = trim($this->removeDelimitersAndExpand($this->entries[$i][$key]));
                        }
                }
// EZ: Remove this to be able to use the same instance for parsing several files, 
// e.g., parsing a entry file with its associated abbreviation file
//              if(empty($this->preamble))
//                      $this->preamble = FALSE;
//              if(empty($this->strings))
//                      $this->strings = FALSE;
//              if(empty($this->entries))
//                      $this->entries = FALSE;
                return array($this->preamble, $this->strings, $this->entries, $this->undefinedStrings);
        }

}

?>

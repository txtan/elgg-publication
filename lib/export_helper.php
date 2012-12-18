<?php

function getBibTex($publication){
	$type = $publication->pubtype;
	//process authors
	$authors = explode(',',$publication->authors);
	$authors_str_arr = array();
	foreach($authors as $author){
		if(is_numeric($author)){
			$author_entity = get_entity($author);
			$author_name = $author_entity->name;
		}else{
			$author_name = $author;
		}
		$authors_str_arr[] = $author_name;
	}
	$authors_str = implode(' and ',$authors_str_arr);
	if($publication->description)
		$abstract = strip_tags($publication->description);
	if($publication->tags)
		$keywords = implode(',',$publication->tags);
	$result = "@$type{\n";
	$result .= "author={".$authors_str."},\n";
	
	if($abstract)
		$result .= "abstract={".$abstract."},\n";
	if($keywords)
		$result .= "keywords={".$keywords."},\n";

	$fields_array = array(
		  'title'          ,
                  'journal'        ,
                  'booktitle'      ,
                  'edition'        ,
                  'series'         ,
                  'volume'         ,
                  'number'         ,
                  'chapter'        ,
                  'year'           ,
                  'month'          ,
                  'pages'      ,
                  'publisher'      ,
                  'location'       ,
                  'institution'    ,
                  'organization'   ,
                  'school'         ,
                  'address'        ,
                  'howpublished'   ,
                  'note'           ,
                  'doi'       ,
                  'url'       ,
		  'uri'       ,
                  'issn'           ,
                  'isbn'           ,
                  'namekey'        );

	foreach($fields_array as $field){
		if($publication->$field){
			$result .= "$field={".$publication->$field."},\n";
		}
	}

	$result .= "}";
	
	return $result;
}

?>

<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */


	gatekeeper();
        action_gatekeeper();

	// Get input data
	$title = get_input('publicationtitle');
	$abstract = get_input('publicationabstract');
	$keywords = get_input('publicationkeywords');
//	$access = get_input('access_id');
	$access = ACCESS_PUBLIC;
	$comments_on = get_input('comments_select','Off');
	$authors = get_input('authorselected');
	$uri = get_input('uri');
	$pres = get_input('pres');
	$type = get_input('type');
	$year = get_input('year');
	$journal = get_input('journal');
	$publisher = get_input('publisher');
	$booktitle = get_input('booktitle');
	$school = get_input('school');
	$institution = get_input('institution');
	$volume = get_input('volume');
	$number = get_input('number');
	$pages = get_input('number');
	$month = get_input('month');
	$note = get_input('note');
	$series = get_input('series');
	$address = get_input('address');
	$edition = get_input('edition');
	$organization = get_input('organization');
	$type_field = get_input('type_field');

	if(is_array($authors)){
		$pauthors = array();
		for($i=0; $i < count($authors); $i++){
			$ca = preg_split('/,/',$authors[$i]);
			if($ca[0] == 'new') $pauthors[] = $ca[1];
			else $pauthors[] = (int)$ca[0];
		}
	}else{
		register_error(elgg_echo("publication:blankauthors"));
                forward($_SERVER['HTTP_REFERER']);
	}
	$attachment = get_input('attachment_guid');		
		
	// Cache to the session
	//$_SESSION['user']->publicationtitle = $title;
	//$_SESSION['user']->publicationabstract = $abstract;
	//$_SESSION['user']->publicationkeywords = $keywords;
	//$_SESSION['user']->publicationuri = $uri;
		
	// Convert string of tags into a preformatted array
	$tagarray = string_to_tag_array($keywords);
		
	// Make sure the title / description aren't blank
	if (empty($title)) {
		register_error(elgg_echo("publication:blank"));
		forward($_SERVER['HTTP_REFERER']);
	} 


	if($type == 'ARTICLE'){
		if(empty($journal) || empty($year)){
		register_error(elgg_echo("publication:blankdefault"));
		forward($_SERVER['HTTP_REFERER']);
		}	
	}else if($type =='INPROCEEDINGS'){
		if(empty($booktitle) || empty($year)){
		register_error(elgg_echo("publication:blankdefault"));
		forward($_SERVER['HTTP_REFERER']);
		}
	}else if($type =='BOOK'){
		if(empty($publisher) || empty($year)){
		register_error(elgg_echo("publication:blankdefault"));
		forward($_SERVER['HTTP_REFERER']);
		}
	}else if($type =='PHDTHESIS' || $type == 'MASTERSTHESIS'){
		if(empty($school) || empty($year)){
		register_error(elgg_echo("publication:blankdefault"));
		forward($_SERVER['HTTP_REFERER']);
		}
	}else if($type == 'TECHREPORT'){
		if(empty($institution) || empty($year)){
		register_error(elgg_echo("publication:blankdefault"));
		forward($_SERVER['HTTP_REFERER']);
		}
	}

	$publication = new ElggObject();
	$publication->subtype = "publication";
	$publication->owner_guid = $_SESSION['user']->getGUID();
	$publication->container_guid = (int)get_input('container_guid', $_SESSION['user']->getGUID());
	$publication->access_id = $access;
	$publication->title = $title;
	$publication->description = $abstract;
	if (!$publication->save()) {
		register_error(elgg_echo("publication:error"));
		forward($_SERVER['HTTP_REFERER']);
	}
	if (is_array($tagarray)) {
		$publication->tags = $tagarray;
	}
	$publication->comments_on = $comments_on; 
	$publication->uri = $uri;
	//foreach($CONFIG->publication as $shortname => $valuetype)
        //       	$publication->$shortname = $params_value[$shortname];
	$publication->year = $year;
	$publication->pubtype = $type;
	$publication->journal = $journal;
	$publication->booktitle = $booktitle;
	$publication->school = $school;
	$publication->institution = $institution;
	$publication->volume = $volume;
	$publication->number = $number;
	$publication->pages = $pages;
	$publication->month = $month;
	$publication->note = $note;
	$publication->series = $series;
	$publication->address = $address;
	$publication->edition = $edition;
	$publication->organization = $organization;
	$publication->type_field = $type_field;
	$publication->clearRelationships();
	if (is_array($pauthors) && sizeof($pauthors) > 0) {
		foreach($pauthors as $author) {
			if(is_int($author))
				add_entity_relationship($publication->getGUID(),'author',$author);
		}
	}
	$pauthors = implode(',',$pauthors);
	$publication->authors=$pauthors;

	if(is_array($pres) && sizeof($pres) > 0){
                    foreach($pres as $pre){  
                         add_entity_relationship($pre, 'presentation_of', $publication->getGUID());
                    }
	}

	$publication->attachment = $attachment;
		
	system_message(elgg_echo("publication:posted"));
        add_to_river('river/object/publication/create','create',$_SESSION['user']->guid,$publication->guid);
			
	//remove_metadata($_SESSION['user']->guid,'publicationtitle');
	//remove_metadata($_SESSION['user']->guid,'publicationabstract');
	//remove_metadata($_SESSION['user']->guid,'publicationkeywords');
	//remove_metadata($_SESSION['user']->guid,'publicationauthors');
	//remove_metadata($_SESSION['user']->guid,'publicationexauthors');
	//remove_metadata($_SESSION['user']->guid,'publicationuri');
	//remove_metadata($_SESSION['user']->guid,'publicationsource');
	//remove_metadata($_SESSION['user']->guid,'publicationyear');
			
	$page_owner = get_entity($publication->container_guid);
	if ($page_owner instanceof ElggUser)
		$username = $page_owner->username;
	else if ($page_owner instanceof ElggGroup)
		$username = "group:" . $page_owner->guid;
	forward("pg/publications/$username");
				
		
?>

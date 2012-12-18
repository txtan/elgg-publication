<?php

		gatekeeper();
	
		
    // Get input data
		$bibtex_file_guid = get_input('attachment_guid');
		$bibtex_file = get_entity($bibtex_file_guid);
		$data = $bibtex_file->grabFile();
		$access = ACCESS_PUBLIC;
	
		if(empty($bibtex_file_guid)){
			register_error(elgg_echo("publication:bibtex:fileerror"));
       			forward($_SERVER['HTTP_REFERER']);
			
		}
    //parse BibTex file
		$parse = new PARSEENTRIES();
		$parse->loadBibtexString($data);
		$parse->extractEntries();
		list($preamble,$strings,$entries,$undefinedStrings) = $parse->returnArrays();
		
		if(empty($entries)){
			register_error(elgg_echo('publication:bibtex:blank'));
       			forward($_SERVER['HTTP_REFERER']);
		}

		foreach($entries as $entry){
			$found_name = false;
			$authors = array();
			$creator = new PARSECREATORS();
			$creatorArray = $creator->parse($entry['author']);
			foreach($creatorArray as $author){
				$name = "";
				foreach($author as $a){
					$name .= trim($a) . " ";
				}
				$name = trim($name);
				$authors[] = $name;
			}
			$authors = implode(',',$authors);

			//get all current publication and check for duplication
			$all_pubs_count = elgg_get_entities(array('types'=>'object','subtypes'=>'publication', 'count'=>true));
			$all_pubs = elgg_get_entities(array('types'=>'object','subtypes'=>'publication','limit'=>$all_pubs_count)); 
			foreach($all_pubs as $cpubs){
				if($cpubs->title == $entry['title']){
					$found_name = true;
					break;
				}
			}
			if($found_name == false && !(empty($entry['title']))){
				$publication = new ElggObject();
				$publication->subtype = "publication";
				$publication->owner_guid = $_SESSION['user']->getGUID();
				$publication->container_guid = (int)get_input('container_guid',$_SESSION['user']->getGUID());
				$publication->access_id = $access;
				$publication->title = $entry['title'];
				$publication->description = $entry['abstract'];
				$publication->save();
				$publication->pubtype = strtoupper($entry['bibtexEntryType']);;
				if(is_array($tagarray = string_to_tag_array($entry['keywords'])))	
					$publication->tags = $tagarray;
				$publication->authors = $authors;
				foreach(array_keys($entry) as $key){
					if($key != 'author' || $key = 'keywords' || $key != 'type' || $key != 'abstract' || $key != 'title'){
						$publication->$key = $entry[$key];
					}
				}
			}
		}
		
		system_message("BibTex imported sucessfully");
       		forward($_SERVER['HTTP_REFERER']);
	//get all current feeds and check for duplicate names
	/*$all_feeds_count = elgg_get_entities(array('types'=>'object','subtypes'=>'feed','count'=>true));
	$all_feeds= elgg_get_entities(array('types'=>'object','subtypes'=>'feed','limit'=>$all_feeds_count));
		foreach($feeds as $f){
			$found_name = false;
			foreach($all_feeds as $cfeed){
				if($cfeed->title == $f['names']){
					$found_name = true;
					break;
				}
			}
			if($found_name == false){				
				$feed = new ElggObject();
				$feed->subtype = "feed";
				$feed->owner_guid = $_SESSION['user']->getGUID();
				$feed->access_id=$access;
				$feed->title = $f['names'];
				$feed->description = $f['feeds'];
				if(!$feed->save()){
					register_error(elgg_echo("feeds:error"));
				}
			}
		}
		system_message(elgg_echo("feeds:bibtex:added"));
		
		
    //forward back to the users feeds page
       forward("pg/feeds/" . $_SESSION['user']->username);
	*/		

?>

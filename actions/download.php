<?php


	gatekeeper();
	$download_type = get_input('type');
	if($download_type == 'single'){
		$pub_guid = get_input('pub_guid');
		$pub = get_entity($pub_guid);
		$output = getBibTex($pub);
		
	}
	else if($download_type == 'user'){
		$user_guid = get_input('user_guid');	
		$user = get_entity($user_guid);
		if($user instanceof ElggGroup){
			$pubs = get_entities_from_relationship('tagby',$user_guid,false,'object','publication',0);
		}else{
			$pubs = get_entities_from_relationship('author',$user_guid,true,'object','publication',0);
		}
		if($pubs){
			foreach($pubs as $pub){
			$bibtex = getBibTex($pub);
			$output .= $bibtex."\n\n";
			}
		}
	}
	else if($download_type == 'all'){
		$all_pubs_count = elgg_get_entities(array('types'=>'object','subtypes'=>'publication', 'count'=>true));
                $pubs = elgg_get_entities(array('types'=>'object','subtypes'=>'publication','limit'=>$all_pubs_count));
		if($pubs){
			foreach($pubs as $pub){
				$bibtex = getBibTex($pub);
				$output .= $bibtex."\n\n";
			}
		}
	}

	header("Content-type: text/plain");
	header("Content-Disposition: attachment; filename=\"export.bib\"");
	$splitString = str_split($output, 8192);
	foreach($splitString as $chunk)
		echo $chunk;
	exit;
	
?>

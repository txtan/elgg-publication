<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/engine/start.php");

	$guid = get_input('guid');
	$type = get_input('type');
	$entity = get_entity($guid);

	if($guid){
		$action = 'edit';
		$keywords = $entity->tags;
		$uri = $entity->uri;
		$year = $entity->year;
		$journal = $entity->journal;
		$publisher = $entity->publisher;
		$booktitle = $entity->booktitle;
		$school = $entity->school;
		$institution = $entity->institution;
		$volume = $entity->volume;
		$number = $entity->number;
		$pages = $entity->pages;
		$month = $entity->month;
		$note = $entity->note;
		$series = $entity->series;
		$address = $entity->address;
		$edition = $entity->edition;
		$organization = $entity->organization;
		$type_field = $entity->type_field;
	}
	else{ 
		$action = 'add';
		$keywords = '';	
		$uri = '';
		$year = '';
		$journal = '';
		$publisher = '';
		$booktitle = '';
		$school = '';
		$institution = '';
		$volume = '';
		$number = '';
		$pages = '';
		$month = '';
		$note = '';
		$series = '';
		$address = '';
		$edition = '';
		$organization = '';
		$type_field = '';
	}


	//required filed by type
	if($type == "ARTICLE"){
	$journal_label = elgg_echo('publication:journal');
	$journal_input = elgg_view('input/text',array('internalname'=>'journal','value'=>$journal));
	$custom_field .= "<p><label>$journal_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br/>$journal_input</p>";
	}else if($type == "INPROCEEDINGS"){
	$booktitle_label = elgg_echo('publication:booktitle');
	$booktitle_input = elgg_view('input/text',array('internalname'=>'booktitle','value'=>$booktitle));
	$custom_field .= "<p><label>$booktitle_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br/>$booktitle_input</p>";
	}else if($type == "BOOK"){
	$publisher_label = elgg_echo('publication:publisher');
	$publisher_input = elgg_view('input/text',array('internalname'=>'publisher','value'=>$publisher));
	$custom_field .= "<p><label>$publisher_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br/>$publisher_input</p>";
	}else if($type == "PHDTHESIS" || $type == "MASTERSTHESIS"){	
	$school_label = elgg_echo('publication:school');
	$school_input = elgg_view('input/text',array('internalname'=>'school','value'=>$school));
	$custom_field .= "<p><label>$school_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br/>$school_input</p>";
	}else if($type == "TECHREPORT"){
	$institution_label = elgg_echo('publication:institution');
	$institution_input = elgg_view('input/text',array('internalname'=>'institution','value'=>$institution));
	$custom_field .= "<p><label>$institution_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br/>$institution_input</p>";
	}

	$year_label = elgg_echo('publication:year');
	$year_input = elgg_view('input/text',array('internalname'=>'year','value'=>$year));
	$custom_field .= "<p><label>$year_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br/>$year_input</p>";


	//optional fields by type	
	if($type == 'ARTICLE'){
	//ARTICLE
	$volume_label = elgg_echo('publication:volume');
	$volume_input = elgg_view('input/text',array('internalname'=>'volume','value'=>$volume));
	$custom_field .= "<p><label>$volume_label</label><br/>$volume_input</p>";
	$number_label = elgg_echo('publication:number');
	$number_input = elgg_view('input/text',array('internalname'=>'number','value'=>$number));
	$custom_field .= "<p><label>$number_label</label><br/>$number_input</p>";
	$pages_label = elgg_echo('publication:pages');
	$pages_input = elgg_view('input/text',array('internalname'=>'pages','value'=>$pages));
	$custom_field .= "<p><label>$pages_label</label><br/>$pages_input</p>";
	}else if($type == 'INPROCEEDINGS'){
	//INPROCEEDINGS
	$volume_label = elgg_echo('publication:volume');
	$volume_input = elgg_view('input/text',array('internalname'=>'volume','value'=>$volume));
	$custom_field .= "<p><label>$volume_label</label><br/>$volume_input</p>";
	$number_label = elgg_echo('publication:number');
	$number_input = elgg_view('input/text',array('internalname'=>'number','value'=>$number));
	$custom_field .= "<p><label>$number_label</label><br/>$number_input</p>";
	$series_label = elgg_echo('publication:series');
	$series_input = elgg_view('input/text',array('internalname'=>'series','value'=>$series));
	$custom_field .= "<p><label>$series_label</label><br/>$series_input</p>";
	$pages_label = elgg_echo('publication:pages');
	$pages_input = elgg_view('input/text',array('internalname'=>'pages','value'=>$pages));
	$custom_field .= "<p><label>$pages_label</label><br/>$pages_input</p>";
	$address_label = elgg_echo('publication:address');
	$address_input = elgg_view('input/text',array('internalname'=>'address','value'=>$address));
	$custom_field .= "<p><label>$address_label</label><br/>$address_input</p>";
	$organization_label = elgg_echo('publication:organization');
	$organization_input = elgg_view('input/text',array('internalname'=>'organization','value'=>$organization));
	$custom_field .= "<p><label>$organization_label</label><br/>$organization_input</p>";
	$publisher_label = elgg_echo('publication:publisher');
	$publisher_input = elgg_view('input/text',array('internalname'=>'publisher','value'=>$publisher));
	$custom_field .= "<p><label>$publisher_label</label><br/>$publisher_input</p>";
	}else if($type == 'BOOK'){
	//BOOK
	$volume_label = elgg_echo('publication:volume');
	$volume_input = elgg_view('input/text',array('internalname'=>'volume','value'=>$volume));
	$custom_field .= "<p><label>$volume_label</label><br/>$volume_input</p>";
	$number_label = elgg_echo('publication:number');
	$number_input = elgg_view('input/text',array('internalname'=>'number','value'=>$number));
	$custom_field .= "<p><label>$number_label</label><br/>$number_input</p>";
	$series_label = elgg_echo('publication:series');
	$series_input = elgg_view('input/text',array('internalname'=>'series','value'=>$series));
	$custom_field .= "<p><label>$series_label</label><br/>$series_input</p>";
	$address_label = elgg_echo('publication:address');
	$address_input = elgg_view('input/text',array('internalname'=>'address','value'=>$address));
	$custom_field .= "<p><label>$address_label</label><br/>$address_input</p>";
	$edition_label = elgg_echo('publication:edition');
	$edition_input = elgg_view('input/text',array('internalname'=>'edition','value'=>$edition));
	$custom_field .= "<p><label>$edition_label</label><br/>$edition_input</p>";
	}else if($type == 'PHDTHESIS' || $type == 'MASTERSTHESIS'){
	//THESIS
	$type_field_label = elgg_echo('publication:type_field');
	$type_field_input = elgg_view('input/text',array('internalname'=>'type_field','value'=>$type_field));
	$custom_field .= "<p><label>$type_field_label</label><br/>$type_field_input</p>";
	$address_label = elgg_echo('publication:address');
	$address_input = elgg_view('input/text',array('internalname'=>'address','value'=>$address));
	$custom_field .= "<p><label>$address_label</label><br/>$address_input</p>";
	}else if($type == 'TECHREPORT'){
	//TECHREPORT
	$type_field_label = elgg_echo('publication:type_field');
	$type_field_input = elgg_view('input/text',array('internalname'=>'type_field','value'=>$type_field));
	$custom_field .= "<p><label>$type_field_label</label><br/>$type_field_input</p>";
	$number_label = elgg_echo('publication:number');
	$number_input = elgg_view('input/text',array('internalname'=>'number','value'=>$number));
	$custom_field .= "<p><label>$number_label</label><br/>$number_input</p>";
	$address_label = elgg_echo('publication:address');
	$address_input = elgg_view('input/text',array('internalname'=>'address','value'=>$address));
	$custom_field .= "<p><label>$address_label</label><br/>$address_input</p>";
	}

	//common optional fields across all types
	$keywords_label = elgg_echo('publication:keywords');
        $keywords_input = elgg_view('input/tags', array('internalname' => 'publicationkeywords', 'value' => $keywords));

	$uri_label = elgg_echo('publication:uri');
        $uri_input = elgg_view('input/text', array('internalname' => 'uri', 'value' => $uri));

	$month_label = elgg_echo('publication:month');
	$month_input = elgg_view('input/text', array('internalname' => 'month', 'value'=> $month));
	//$month_input = elgg_view('input/pulldown',array('internalname'=>'month','value'=>$month,'options'=>array('January','February','March','April','May','June','July','August','September','October','November','December')));	
	
	$note_label = elgg_echo('publication:note');
        $note_input = elgg_view('input/text', array('internalname' => 'note', 'value' => $note));
	$custom_field .= "<p><label>$month_label</label><br/>$month_input</p>";
	$custom_field .= "<p><label>$keywords_label</label><br/>$keywords_input</p>";
	$custom_field .= "<p><label>$uri_label</label><br/>$uri_input</p>";
	$custom_field .= "<p><label>$note_label</label><br/>$note_input</p>";

	echo $custom_field;

?>

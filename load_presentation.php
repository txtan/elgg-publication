<?php


	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	$page_owner = page_owner_entity();
	//$userguid = $_SESSION['guid'];
	$userguid = 0;
	$limit = 10;
	$offset = (int)get_input('offset',0);
	$selected = (int)get_input('selected',0);
	echo elgg_view('publication/tabs',array('selected'=>$selected,'limit'=>$limit, 'offset'=>$offset,'user_guid'=>$userguid));

?>

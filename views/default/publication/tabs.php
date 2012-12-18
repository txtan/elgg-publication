<?php

$limit = $vars['limit'];
$offset = $vars['offset'];
$userguid = $vars['user_guid'];
$selected = $vars['selected'];
$pubs = elgg_get_entities(array('types'=>'object','subtypes'=>'presentation','limit='=>$limit,'owner_guids'=>$userguid,'offset'=>$offset));
$pubscount = elgg_get_entities(array('count'=>true,'types'=>'object','subtypes'=>'presentation','limit'=>$limit,'owner_guids'=>$userguid,'offset'=>$offset));
$pagination = elgg_view('embed/pagination',array('offset'=>$offset,'baseurl'=>$vars['url'].'mod/publication/load.php?user_guid='.$userguid.'&selected=0','limit'=>$limit,'count'=>$pubscount));

set_context('references');
foreach($pubs as $pub){
	$pubslist.= elgg_view('publication/presentation',array('entity'=>$pub)) . "<br/><br/>";
}

?>

<h2>Select Presentation</h2>
<div style='margin-top:10px'>
	<?php echo $pagination;?>
	<?php echo $pubslist;?>
</div>


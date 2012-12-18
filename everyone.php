<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */


	
	define('everyonepublication','true');
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	$page_owner = page_owner_entity();
	if($page_owner === false || is_null($page_owner)){	
		$page_owner = $_SESSION['user'];
		set_page_owner($_SESSION['guid']);
	}	
	$nav = elgg_view('navigation/pagination', array('baseurl'=>$_SERVER['REQUEST_URI'],'offset' => 0,'count' => $count,'limit' => 10,'word' => 'annoff','nonefound' => false));
	$area2 .= $nav;
	$area2 = elgg_view_title(elgg_echo('publication:everyone'));
	set_context('references');
	$area2 .= '<div class="contentWrapper">';
	$area2 .= list_entities('object','publication',0,0,false);
	$area2 .= '</div>';
	set_context('publications');
	if(isloggedin()){
	$area3 = "<div style='margin:0 0 10px 10px'>".elgg_view('output/confirmlink',array('text'=>'Export to BibTeX','class'=>'add_import', 'href'=>'/action/publication/download?type=all','confirm'=>'Do you want to export all publications as a bibTeX file?'))."</div>";
	}
	$area3 .= elgg_view('publication/search');
	$body = elgg_view_layout("two_column_left_sidebar", '', $area2, $area3);
		
	page_draw(elgg_echo('publication:everyone'),$body);
		
?>

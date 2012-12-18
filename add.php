<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

		
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	gatekeeper();
		
	$page_owner = page_owner_entity();
	if ($page_owner === false || is_null($page_owner)) {
		$page_owner = $_SESSION['user'];
		set_page_owner($_SESSION['guid']);
	}
	if ($page_owner instanceof ElggGroup)
		$container = $page_owner->guid;
		
	$area1 = elgg_view_title(elgg_echo('publication:add'));
	$area1 .= elgg_view("publication/forms/edit", array('container_guid' => $container));
	$area3 = elgg_view("publication/import");		 
	page_draw(elgg_echo('publication:add'),elgg_view_layout("two_column_left_sidebar", '', $area1,$area3));

		
?>

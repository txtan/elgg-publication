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
		
	$publicationpost = (int) get_input('publicationpost');
	if ($post = get_entity($publicationpost)) {
		if ($post->canEdit()) {
			$area1 = elgg_view_title(elgg_echo('publication:edit'));
			$area1 .= elgg_view("publication/forms/edit", array('entity' => $post));
			$body = elgg_view_layout("two_column_left_sidebar", '', $area1);
		}
	}
		
	// Display page
	page_draw(sprintf(elgg_echo('publication:edit'),$post->title),$body);
		
?>

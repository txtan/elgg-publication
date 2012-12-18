<?php
	/**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

	action_gatekeeper();
	$groupguid = get_input('groupguid');
	$pubguid = get_input('pubguid');
	add_entity_relationship($groupguid, 'tagby', $pubguid);
?>

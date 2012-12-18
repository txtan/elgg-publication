<?php

	/**
         * @package Elgg                  
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

		if (is_array($vars['posts']) && sizeof($vars['posts']) > 0) {
			
			foreach($vars['posts'] as $post) {
				
				echo elgg_view_entity($post);
				
			}
			
		}

?>

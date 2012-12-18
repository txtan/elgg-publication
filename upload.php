<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */


	if (!is_callable('elgg_view')) exit;
		
	$internalname = get_input('internalname');
		
		
	echo elgg_view('publication/embed/upload', array(
		'entities' => $entities,
		'internalname' => $internalname,
	));

?>

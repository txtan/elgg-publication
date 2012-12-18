<?php

     	/**
         * @package Elgg 
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */
 
    //the number of publications to display
	$number = (int) $vars['entity']->num_display;
	if (!$number)
		$number = 4;
		
    //the page owner
	$owner = $vars['entity']->owner_guid;
      
	$publications = get_entities_from_relationship('author',$owner,true,'object','publication',0,'',$number);

    if($publications){
		
		echo "<div id=\"publicationwidget\" class=\"contentWrapper\">";

		foreach($publications as $publication){
			set_context('references');
			echo elgg_view_entity($publication);
		}
		echo "</div>";
    }
      
?>

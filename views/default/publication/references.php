<?php

	/**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

		$type = $vars['entity']->pubtype;
		$info = "<em><b><a href=\"{$vars['entity']->getURL()}\">{$vars['entity']->title}</a></b></em>";
		$authors = $vars['entity']->authors;
		$authors = explode(',',$authors);
		if (!empty($authors)) {
			for($index= 0; $index < count($authors) - 1; $index++) {
				$cauthor = $authors[$index];
				if(!ctype_digit($cauthor)) echo "$cauthor, ";
				else{
					$user = get_entity((int)$cauthor);
					echo '<a href="' . $CONFIG->wwwroot . 'pg/publications/' . $user->username . '">' . $user->name . '</a>, ';
						
				}
			}
			$cauthor = $authors[$index];
			if(!ctype_digit($cauthor)) echo "$cauthor";
			else{
				$user = get_entity((int)$cauthor);
				echo '<a href="' . $CONFIG->wwwroot . 'pg/publications/' . $user->username . '">' . $user->name . '</a>';
			}
			
		}
		
		echo ", <i>$info</i>,";
		if($type == 'ARTICLE'){
			if(!empty($vars['entity']->journal))
				echo " " . $vars['entity']->journal . ",";	
		}else if($type == 'INPROCEEDINGS'){
			if(!empty($vars['entity']->booktitle))
				echo " Proceedings of the " . $vars['entity']->booktitle . ",";
		}else if($type == 'BOOK'){
			if(!empty($vars['entity']->edition))
				echo " " . $vars['entity']->edition . " ed.,";
			if(!empty($vars['entity']->publisher))
				echo " " .$vars['entity']->publisher . ",";
		}else if($type == 'PHDTHESIS'){
			if(!empty($vars['entity']->school))
				echo " PhD Thesis, " .$vars['entity']->school . ",";
		}else if($type == 'MASTERSTHESIS'){
			if(!empty($vars['entity']->school))
				echo " Masters Thesis, " .$vars['entity']->school . ",";
		}else if($type == 'TECHREPORT'){
			if(!empty($vars['entity']->institution))
				echo " Techreport, " .$vars['entity']->institution . ",";
		}	
		if (!empty($vars['entity']->year)) {
                        echo ' ' . $vars['entity']->year . ", ";
                }
		if (!empty($vars['entity']->pages)) {
                        echo ' pp. ' . $vars['entity']->pages;
		}
		
		$page_owner = page_owner_entity();
		if($page_owner instanceof ElggGroup){
			$group = get_entity($page_owner->guid);
			if(isloggedin() && is_group_member($group->guid,$_SESSION['guid'])){
				echo elgg_view('publication/tag',array('pub'=>$vars['entity']->guid,'group'=>$group->guid));
			}
		}
		
?>

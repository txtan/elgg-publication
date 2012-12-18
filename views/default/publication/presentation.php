<?php
$type = $vars['type'];
$pub_guid = $vars['entity']->guid;
$title = $vars['entity']->title;
echo "<div style='float:right;width:95%'>";
 $info = "<em><b>{$vars['entity']->title}</b></em>";
                $authors = $vars['entity']->authors;
                $authors = explode(',',$authors);
                if (!empty($authors)) {
                        for($index= 0; $index < count($authors) - 1; $index++) {
                                $cauthor = $authors[$index];
                                if(!ctype_digit($cauthor)) echo "$cauthor, ";
                                else{
                                        $user = get_entity((int)$cauthor);
                                        echo $user->name . ', ';

                                }
                        }
                        $cauthor = $authors[$index];
                        if(!ctype_digit($cauthor)) echo "$cauthor";                        else{
                                $user = get_entity((int)$cauthor);                                echo $user->name;
                        }

                }

                echo ". $info.";
		echo "<span style='font-style:italic'>";
		if(!empty($vars['entity']->event_name)){
                        $event_name = $vars['entity']->event_name;
                        echo " $event_name";
                }
                if(!empty($vars['entity']->event_loc)){
                        $event_loc = $vars['entity']->event_loc;
                        echo ", $event_loc";
                }
                if(!empty($vars['entity']->date)){
                        echo ", ".$vars['entity']->date.".";
                }

		echo "</span>";
echo "</div>";
		if($type != 'info')
		echo "<div style='margin-top:10px;float:left'><a onclick=\"add_pres('$title','$pub_guid')\" class='save-button'>Add</a></div>";

?>
<div class='clearfloat'></div>

<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */


	$embedselected = '';
	$uploadselected = '';
	if ($vars['tab'] == 'media') { 
		$embedselected = 'class="embed_tab_selected"'; 
	} else {
		$uploadselected = 'class="embed_tab_selected"';
	}

	$user = get_loggedin_user();
	$username=$user->username;
?>


<div id="embed_media_tabs">
	<ul>
		<li>
			<a href="#" <?php echo $embedselected; ?> onclick="javascript:$('.popup .content').load('<?php echo $vars['url'] . "pg/publications/$username/embed/media"; ?>?internalname=<?php echo $vars['internalname']; ?>'); return false"><?php echo elgg_echo('publication:file'); ?></a>
		</li>
		<li>
			<a href="#" <?php echo $uploadselected; ?> onclick="javascript:$('.popup .content').load('<?php echo $vars['url'] . "pg/publications/$username/upload"; ?>?internalname=<?php echo $vars['internalname']; ?>'); return false"><?php echo elgg_echo('publication:upload'); ?></a>
		</li>
	</ul>
</div>
<div class="clearfloat"></div>

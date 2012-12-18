<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

	$user = get_loggedin_user();
	$username = $user->username;
?>

<a class="embed_media" href="<?php echo $vars['url'] . "pg/publications/$username/embed/media"; ?>?internalname=<?php echo $vars['internalname']; ?>" rel="facebox"><?php echo elgg_echo('publication:attachment'); ?></a><br />

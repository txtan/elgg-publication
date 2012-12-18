<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

global $CONFIG;

$exauthor = $vars['exauthor'];
$formatauthor = preg_replace('/ /','_',$exauthor);
$publication_guid = $vars['publication_guid'];
$publication = get_entity($publication_guid);
$publication_title = $publication->title;
$invitee = get_loggedin_user();
$invitee_name = $invitee->name;
$canedit = $vars['canedit'];
$content = '<p>'.sprintf(elgg_echo("publication:inviteinfomsg"),$exauthor,$exauthor).'</p>';
$content .= "<p><label>Enter email address</label>";
$content .= elgg_view('input/email', array('internalname'=>'emails', 'internalid'=>'emails'));
$content .= "</p><p><label>Message</label>";
$content .= "<textarea class='input-textarea' name='emailmessage'>" .sprintf(elgg_echo('publication:invitemsg'),$exauthor,$publication_title,$invitee_name).elgg_echo('publication:additionalmsg')."</textarea></p>";
$content .= "<input type='hidden' name='author' value=''/>";
$content .= "<input type='hidden' name='publication' value='$publication_guid' />";
$content .= "<input type='submit' value='invite'/>&nbsp<input type='button' value='cancel' onclick=\"hide_dialog('$formatauthor')\"/>";
$form = elgg_view('input/form', array('action'=>"$CONFIG->wwwroot/action/publication/invite", 'body'=>$content));
$dialog = "<div style='display:none' id='invite_dialog_$formatauthor' class='publication_dialog'>$form</div>";
$userinfo = <<< EOT
	<div class='search_listing'>
		<div class='search_listing_icon'>
		<div class='usericon'>
		<img border='0' src="$CONFIG->wwwroot/mod/profile/graphics/defaultsmall.gif"/>
		</div>
		</div>
		<div class='search_listing_info'>
		<p><b>$exauthor</b>
EOT;
if($canedit){
	if(get_plugin_setting('toggleinvites','publications') != 'Off')
	$userinfo.= " <input type=button class='submit_button' value='invite' onclick=\"show_dialog('$exauthor');\"/>";
}
$userinfo .= "</p></div></div>";
echo $userinfo;
echo $dialog;

?>
<script type='text/javascript'>
                function show_dialog(author){
                       $("input:hidden[name='author']").val(author);
			var formatauthor = author.replace(/ /g,'_');
                        $('#invite_dialog_'+formatauthor).show();
                }
                function hide_dialog(author){
			var formatauthor = author.replace(/ /g,'_');
                        $('#invite_dialog_'+formatauthor).hide();
                }
</script>


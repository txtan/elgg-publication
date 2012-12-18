<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */


	gatekeeper();
	action_gatekeeper();
	$emails = get_input('emails');
	$emailmessage = get_input('emailmessage');
	
	if($author = get_input('author')){
		$publication = get_input('publication');
	}

	if(empty($emails)){
                register_error('No email addresses specified');
                forward($_SERVER['HTTP_REFERER']);
        }
	
	$emails = explode("\n",$emails);
	
	global $CONFIG;
	
	if (sizeof($emails)) {
		foreach($emails as $email) {
			$email = trim($email);
			if (!empty($email)) {
				$link = $CONFIG->wwwroot . 'account/register.php?friend_guid=' . $_SESSION['guid'] . '&invitecode=' . generate_invite_code($_SESSION['user']->username);
				if($author && $publication){
					$author = urlencode($author);
					$link .= "&author=".$author."&publication=".$publication;
				}
				$message = sprintf(elgg_echo('invitefriends:email'),$CONFIG->site->name,$_SESSION['user']->name,$emailmessage,$link);
				$site = $CONFIG->site;
				if (($site) && (isset($site->email))) 
					$from = $site->email;
				else if (isset($from->url)){
					$breakdown = parse_url($from->url);
					$from = 'noreply@' . $breakdown['host']; 
				}
				else // If all else fails, use the domain of the site.
					$from = 'noreply@' . get_site_domain($CONFIG->site_guid); 
				$headers = "From: \"{$CONFIG->site->name}\" <{$CONFIG->site->email}>\r\n"
				. "Content-Type: text/plain; charset=UTF-8; format=flowed\r\n"
	    		. "MIME-Version: 1.0\r\n"
	    		. "Content-Transfer-Encoding: 8bit\r\n";
				mail($email, sprintf(elgg_echo('invitefriends:subject'), $CONFIG->site->name),wordwrap($message), $headers);
			}
		}
		system_message(elgg_echo('invitefriends:success'));
	} else {
		register_error(elgg_echo('invitefriends:failure'));
	}
	forward($_SERVER['HTTP_REFERER']);

?>

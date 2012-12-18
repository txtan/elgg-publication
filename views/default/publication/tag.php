<?php
	/**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

	$pubguid = $vars['pub'];
	$groupguid = $vars['group'];
	$ts = time();
	$token = generate_action_token($ts);
	
		
	$html = "<span class='tagpubspan'>";
	if(check_entity_relationship($groupguid, 'tagby', $pubguid)){
		$html .= <<< EOT
			<a id="$groupguid-$pubguid-tag" style='display:none' class='tagpubBtn' onclick="tag('$groupguid','$pubguid','$ts','$token')">tag as group publication</a>
			<a id="$groupguid-$pubguid-untag" class='tagpubBtn' onclick="untag('$groupguid','$pubguid','$ts','$token')">untag</a>
EOT;
	}else{	
		$html .= <<< EOT
			<a id="$groupguid-$pubguid-tag" class='tagpubBtn' onclick="tag('$groupguid', '$pubguid', '$ts', '$token')">tag as group publication</a>
			<a id="$groupguid-$pubguid-untag" class='tagpubBtn' style='display:none' onclick="untag('$groupguid','$pubguid','$ts','$token')">untag</a>
EOT;
	}
	
	$html .= "</span>";
	
	echo $html;

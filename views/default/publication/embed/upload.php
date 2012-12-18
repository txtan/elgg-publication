<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */
?>
<h1 class="mediaModalTitle">Upload File</h1>
<?php

	$user = get_loggedin_user();
	$username = $user->username;
	//echo elgg_view('publication/embed/tabs',array('tab' => 'upload','internalname'=>get_input('internalname')));
	echo elgg_view('publication/embed/tabs',array('tab' => 'upload'));

	if (!elgg_view_exists('file/upload')) {
		echo "<p>" . elgg_echo('embed:file:required') . "</p>";
	} else {
		$action = 'file/upload';
		
?>
	<form id="mediaUpload" action="<?php echo $vars['url']; ?>action/file/upload" method="post" enctype="multipart/form-data">
		<p>
			<label for="upload"><?php echo elgg_echo("file:file"); ?><br />
		<?php
				echo elgg_view('input/securitytoken');
				echo elgg_view("input/file",array('internalname' => 'upload', 'js' => 'id="upload"'));
			
		?>
		</label></p>
		<p>
			<label><?php echo elgg_echo("title"); ?><br />
			<?php

				echo elgg_view("input/text", array(
									"internalname" => "title",
									"value" => $title,
													));
			
			?>
			</label>
		</p>
		<p>
		<label for="filedescription"><?php echo elgg_echo("description"); ?><br />
		<textarea class="input-textarea" name="description" id="filedescription"></textarea>
		</label></p>
		
		<p>
			<label><?php echo elgg_echo("tags"); ?><br />
			<?php
				echo elgg_view("input/tags", array(
									"internalname" => "tags",
									"value" => $tags,
													));
	
			?>
			</label>
		</p>
		<p>
			<label>
				<?php echo elgg_echo('access'); ?><br />
				<?php echo elgg_view('input/access', array('internalname' => 'access_id','value' => $access_id)); ?>
			</label>
		</p>
	
		<p>
			<?php

				if (isset($vars['container_guid']))
					echo "<input type=\"hidden\" name=\"container_guid\" value=\"{$vars['container_guid']}\" />";
				if (isset($vars['entity']))
					echo "<input type=\"hidden\" name=\"file_guid\" value=\"{$vars['entity']->getGUID()}\" />";
			
			?>
			<input type="submit" value="<?php echo elgg_echo("save"); ?>" />
		</p>
	</form>
	<script type="text/javascript"> 
        // wait for the DOM to be loaded 
        //$(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#mediaUpload').submit(function() { 
	            var options = {  
				    success:    function() { 
				        $('.popup .content').load('<?php echo $vars['url'] . "pg/publications/$username/embed/media"; ?>?internalname=<?php echo $vars['internalname']; ?>'); 
				    } 
				}; 
            	$(this).ajaxSubmit(options);
                return false; 
            }); 
        //}); 
    </script> 

<?php
		
	}
	
?>

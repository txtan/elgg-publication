<?php
	global $CONFIG;

	/**
         * @package Elggi
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */

	//$shortnames = $CONFIG->publication;
	// Set title, form destination
		if (isset($vars['entity'])) {
                  	$guid = $vars['entity']->getGUID();
			$action = "publication/edit";
			$type = $vars['entity']->pubtype;
			$title = $vars['entity']->title;
			$abstract = $vars['entity']->description;
			if(empty($abstract))$abstract = "";
			//$keywords = $vars['entity']->tags;
			$access_id = $vars['entity']->access_id;
			$owner = $vars['entity']->getOwnerEntity();
			$highlight = 'default';
			$authors = $vars['entity']->authors;
			$authors = explode(',',$authors);
			$attachment_guid = $vars['entity']->attachment;
			if($attachment_guid){
				$attachment_entity = get_entity($attachment_guid);
				if($attachment_entity)
					$attachment_file = $attachment_entity->title;
				else{
					$attachment_guid = '';
					$attachment_file = '';
				}
			}else{
				$attachment_file = '';
			}
			//$uri = $vars['entity']->uri;
			$pres = get_entities_from_relationship('presentation_of',$vars['entity']->guid, true, 'object','presentation');
			//foreach($shortnames as $shortname => $valuetype)
		 	//	$params_value[$shortname] = $vars['entity']->$shortname;
		} else  {
			$guid = '';
			$title = elgg_echo("publication:add");
			$action = "publication/add";
			//$keywords = "";
			$title = "";
			$type = "ARTICLE";
			$abstract = "";
			$access_id = ACCESS_PUBLIC;
			$owner = $vars['user'];
			$highlight = 'all';
			$authors = array();
			$attachment_guid = '';
			$attachment_file = '';
			//$uri = "";
			//$params_value = array();
			$container = $vars['container_guid'] ? elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => $vars['container_guid'])) : "";
		}

	// Just in case we have some cached details
		//if (empty($abstract) || empty($title)) {
		//	$abstract = $vars['user']->publicationabstract;
		//	$title = $vars['user']->publicationtitle;
			//$keywords = $vars['user']->publicationkeywords;
		//	$authors = $vars['user']->publicationauthors;
			//$uri = $vars['user']->publicationuri;
			//$source = $vars['user']->publicationsource;
			//$year = $vars['user']->publicationyear;
		////}

	// set the required variables
	
		$type_label = elgg_echo('publication:type');	
			$type_dropdown = elgg_view("input/pulldown", array('internalname'=>'type', 'value'=>$type, 'js'=>"onchange=draw_custom_fields(this.options[this.selectedIndex].text,'$guid')",'options'=>array('ARTICLE','INPROCEEDINGS','BOOK','PHDTHESIS','MASTERSTHESIS','TECHREPORT')));

                $title_label = elgg_echo('title');
                $title_textbox = elgg_view('input/text', array('internalname' => 'publicationtitle', 'value' => $title));
                $abstract_label = elgg_echo('publication:abstract');
                $abstract_textarea = elgg_view('input/longtext', array('internalname' => 'publicationabstract', 'value' => $abstract));
                //$keywords_label = elgg_echo('publication:keywords');
                //$keywords_input = elgg_view('input/tags', array('internalname' => 'publicationkeywords', 'value' => $keywords));
         //       $access_label = elgg_echo('access');


          //$access_input = elgg_view('input/access', array('internalname' => 'access_id', 'value' => $access_id));
          $submit_input = elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('publish'),'js'=>'onclick=selectall()'));
		  $publish = elgg_echo('publish');
		  $//privacy = elgg_echo('access');
		  

		  //$authors_label= elgg_echo('publication:authors');
		  $authors_label = 'Authors';

if ($friends = get_entities('user',"",0,"",9999)) { 
		$authors_input = elgg_view('publication/authorentry', array('authors'=>$authors));
		  }

		  $pres_label = elgg_echo('publication:presentation');
		  $pres_add_btn = "<a class='save-button' href='$CONFIG->wwwroot/mod/publications/load_presentation.php' rel='facebox'>select</a>";
                  $pres_list = "<div class='contentWrapper' id='pres_list'>";
		  if($pres){
                  foreach($pres as $pre){
                        $title = $pre->title;
                        $pre_guid = $pre->guid;
                        $pres_list .= "<script type='text/javascript'>add_pres('$title','$pre_guid')</script>";
                  }}
                  $pres_list .= "</div>";
		

	
		  //$uri_label = elgg_echo('publication:uri');
		  //$uri_input = elgg_view('input/text', array('internalname' => 'uri', 'value' => $uri));
		
		  //foreach($shortnames as $shortname => $valuetype){
		  //	$params_label[$shortname] = elgg_echo('publication:'.$shortname);
		//	$params_input[$shortname] = elgg_view('input/text', array('internalname'=>$shortname,'value'=>$params_value[$shortname]));
		  //}

		  if(get_plugin_setting('toggleattachment','publications') != 'Off'){
		  $attachment_title = elgg_echo('publication:attachment:title');
		  $attachment_name = elgg_view('input/text',array('internalid'=>'attachment_name','internalname'=>'attachment_name','value'=>$attachment_file,'disabled'=>true));
		  $attachment_hidden = elgg_view('input/hidden',array('internalid'=>'attachment_guid','internalname' => 'attachment_guid','value'=>$attachment_guid)); 
		  $attachment = elgg_view('publication/embed/link',array('internalname'=>'pubattachment'));
		  }
		  $form_body = <<<EOT
	<div class="contentWrapper">
EOT;
                if (isset($vars['entity'])) {
                  $entity_hidden = elgg_view('input/hidden', array('internalname' => 'publicationpost', 'value' => $guid));
                } else {
                  $entity_hidden = '';
                }

                $form_body .= <<<EOT
		<p>
			<label>$title_label<span style='font-size:small;font-style:italic''> (*required field)</span></label><br />
                        $title_textbox
		</p>
		<p>
			<label>$type_label</label><br/>
			$type_dropdown
		</p>
		<p>
			<label>Authors<span style='font-size:small;font-style:italic''> (*required field)</span></label> 
			$authors_input
		</p>
		<p class='longtext_editarea'>
			<label>$abstract_label</label><br />
                        $abstract_textarea
		</p>
		<script type='text/javascript'>
			draw_custom_fields('$type','$guid');
		</script>
		<div id='pub_custom_fields'></div>
		<p>
			<label>$pres_label</label> $pres_add_btn<br/>
			$pres_list
		</p>
		<p>
			$entity_hidden
			$submit_input
		</p>
		</div>
		<div class="classfloat"></div>
EOT;
/*		<p>
			<label>$keywords_label</label><br />
                        $keywords_input
		</p>
		<p>
			<label>$uri_label</label><br />
                        $uri_input
		</p>

EOT;
		foreach(array_keys($shortnames) as $shortname){
			$form_body .= "<p><label>$params_label[$shortname]</label><br/>$params_input[$shortname]</p>";
		}
		$form_body .= <<< EOT
		<p>
			<label>$pres_label</label> $pres_add_btn<br/>
			$pres_list
		</p>
		<p>
                        <label>$attachment_title</label> $attachment
                        $attachment_name
			$attachment_hidden
                </p>
	<!--	<p>
			<label>$access_label</label><br />
                        $access_input
		</p>-->
		<p>
			$entity_hidden
			$submit_input
		</p>
	</div><div class="clearfloat"></div>
EOT;*/

      echo elgg_view('input/form', array('action' => "{$vars['url']}action/$action", 'body' => $form_body, 'internalid' => 'publicationPostForm'));
?>

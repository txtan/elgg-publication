<?php
	echo "<div id='import_div'>";
   	if(isloggedin()){
?>
       	<div id="open_import_form">
	<a href="javascript:void(0);" class='add_import'><?php echo elgg_echo("publication:import");?></a>
      	</div>
<?php
	}
?>
	<div id="add_new_import">
       	<form action="<?php echo $vars['url']; ?>action/publication/import" method="post">
	<?php echo elgg_view('input/securitytoken'); ?>
        <p><label><?php echo elgg_echo("publication:bibtex"); ?><br />
        <input type="text" id="add_import_url" name="attachment_name" value="" /></label></p>
        <?php
		echo elgg_view('input/hidden',array('internalid'=>'attachment_guid','internalname'=>'attachment_guid','value'=>''));
        ?>
         <?php
		echo elgg_view('publication/embed/link_import',array('internalname'=>'bibtex_import'));
         ?>
         <input type="submit" name="add_import" id="add_import" value="<?php echo elgg_echo("publication:saveimport"); ?>" />
         </form>
	</div>

<script>
$(document).ready(function(){
        $('a.add_import').click(function(){
                $('div#add_new_import').slideToggle('medium');
                if($('div#add_new_feed').is(':visible'))
                        $('div#add_new_feed').slideToggle("medium");
                return false;
        });

});

function addattachment(fileguid,name){
	$("input[name='attachment_name']").val(name);
        $("#attachment_guid").val(fileguid);
        $.facebox.close();
}

</script>
</div>

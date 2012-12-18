<p>
<?php echo elgg_echo('publication:modify'); ?>
<select name="params[toggleinvites]">
<option value='On' <?php if($vars['entity']->toggleinvites == 'On') echo "selected=\"yes\"";?>> ON </option>
<option value='Off' <?php if($vars['entity']->toggleinvites == 'Off') echo "selected=\"yes\"";?>> OFF </option>
</select>
</p>

<p>
<?php echo elgg_echo('publication:attachment:title'); ?>
<select name="params[toggleattachment]">
<option value='On' <?php if($vars['entity']->toggleattachment == 'On') echo "selected=\"yes\"";?>> ON </option>
<option value='Off' <?php if($vars['entity']->toggleattachment == 'Off') echo "selected=\"yes\"";?>> OFF </option>
</select>
</p>


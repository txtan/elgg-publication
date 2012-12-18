<?php
	$list = elgg_view('categories/list',$vars);
	if (!empty($list)) {
?>

	<div class="publication_categories">
		<?php echo $list; ?>
	</div>

<?php

	}

?>
<?php
        /**
         * @package Elgg
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @author Tingxi Tan, Grid Research Centre [txtan@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
         */



?>

<div class='publication_searchbox'>
	<?php echo elgg_echo('publication:search');?><br/>
	<form id="searchform" action="<?php echo $vars['url'];?>search/" method="get"/>
	<input type="text" name="q" value="search" onclick="{this.value=''}" class="search_input"/>
	<input type="hidden" name="entity_subtype" value="publication"/>
	<input type="hidden" name="entity_type" value="object"/>
	<input type="hidden" name="search_type" value="entities"/>
	<input type="submit" value="Go" class="search_submit_button"/>
	<form>
</div>



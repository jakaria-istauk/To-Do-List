<?php 
	$items 	= ltd_get_list();
 ?>
<div class="tdl-container">
	<div id="list-inputs" class="header">
	  <form id="ltd-form">
	  	<input type="hidden" name="action" value="ltd-add-item">
	  	<input type="text" name="item" id="item" placeholder="Whats need to be done ?">
	  </form>
	</div>
	<ul id="to-do-lists">
	  <?php 
	  	if ( !empty( $items ) ) {
	  		foreach ( $items as $key => $item ) {
	  			$checked = $item->status == 'completed' ? 'checked' : '';
	  			echo "
	  				<li class='{$checked}' data-id='{$item->id}'>
	  					<input type='checkbox' class='checkbox'>
	  					<input class='text' value='{$item->item}' >
	  					<button class='rmv-btn' >&times;</button>
	  				</li>
	  			";
	  		}
	  	}
	  ?>
	</ul>
	<div class="ltd-nav">
		<div class="count"></div>
		<div class="filter">
			<span class="ltd-button" data-show='all' ><?php _e( 'All', 'list-to-do' ) ?></span>
			<span class="ltd-button" data-show='active' ><?php _e( 'Active', 'list-to-do' ) ?></span>
			<span class="ltd-button" data-show='completed' ><?php _e( 'Completed', 'list-to-do' ) ?></span>
		</div>
		<div class="clear-completed"><?php _e( 'Clear completed', 'list-to-do' ) ?></div>
	</div>
</div>
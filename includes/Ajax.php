<?php
namespace jakaria\List_To_Do;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Ajax
{
	public function add_items()	{
		extract( $_POST );
		global $wpdb;
	    $_table = "{$wpdb->prefix}list_to_do";
	    if ( $item != '' ) {
		    $wpdb->insert(
	    	    $_table,
	    	    array(
	    	        'item'       => $item,
	    	        'status'      => '',
	    	    ),
	    	    array(
	    	        '%s',
	    	        '%s',
	    	    )
	    	);
	    }

    	$items 	= ltd_get_list();
    	$list 	= '';
    	if ( !empty( $items ) ) {
    		foreach ( $items as $key => $item ) {
    			$checked = $item->status == 'completed' ? 'checked' : '';
    			$list .= "
    				<li class='{$checked}' data-id='{$item->id}'>
    					<input type='checkbox' class='checkbox' {$checked}>
    					<input class='text' value='{$item->item}' >
    					<button class='rmv-btn' >&times;</button>
    				</li>
    			";
    		}
    	}
		$reponse['list'] 	= $list;
		$reponse['items'] 	= $items;
		wp_send_json( $reponse );
	}

	public function update_status()	{
		extract( $_POST );
		global $wpdb;
	    $_table = "{$wpdb->prefix}list_to_do";

	    $wpdb->update( $_table, [ 'status' => $status ], [ 'id' => $id ], [ '%s' ] );

	    $reponse['status'] = 1;
	    wp_send_json( $reponse );
	}

	public function update_item() {
		extract( $_POST );
		global $wpdb;
	    $_table = "{$wpdb->prefix}list_to_do";

	    $wpdb->update( $_table, [ 'item' => $value ], [ 'id' => $id ], [ '%s' ] );

	    $reponse['status'] = 1;
	    wp_send_json( $reponse );
	}

	public function delete_item() {
		extract( $_POST );
		global $wpdb;
	    $_table = "{$wpdb->prefix}list_to_do";

	    $wpdb->delete( $_table, [ 'id' => $id ] );

	    $reponse['status'] = 1;
	    wp_send_json( $reponse );
	}
}
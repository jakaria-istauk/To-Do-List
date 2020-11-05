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
    	$sql 	= "SELECT * FROM {$_table}";
    	$items 	= $wpdb->get_results( $sql );
    	$list 	= '';
    	if ( !empty( $items ) ) {
    		foreach ( $items as $key => $item ) {
    			$checked = $item->status == 'completed' ? 'checked' : '';
    			$list .= "
    				<li class='{$checked}'>
    					<input type='checkbox' class='checkbox' data-id='{$item->id}'>
    					<span class='text'>{$item->item}</span>
    					<button class='rmv-btn' data-id='{$item->id}'>&times;</button>
    				</li>
    			";
    		}
    	}
		$reponse['list'] = $list;
		$reponse['items'] = $items;
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

	public function update_item()	{
		extract( $_POST );
		global $wpdb;
	    $_table = "{$wpdb->prefix}list_to_do";

	    $wpdb->update( $_table, [ 'item' => $value ], [ 'id' => $id ], [ '%s' ] );

	    $reponse['status'] = 1;
	    wp_send_json( $reponse );

	}

	public function delete_item()	{
		extract( $_POST );
		global $wpdb;
	    $_table = "{$wpdb->prefix}list_to_do";

	    $wpdb->delete( $_table, [ 'id' => $id ] );

	    $reponse['status'] = 1;
	    wp_send_json( $reponse );

	}
}
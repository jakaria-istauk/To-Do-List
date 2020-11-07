<?php
if( !function_exists( 'ltd_get_templates' ) ) :
function ltd_get_templates( $slug ) {

	$template_path =  dirname( LTD ) . "/templates/" . $slug . '.php';

	if ( file_exists( $template_path ) ) {
		ob_start();
		include $template_path;
		return ob_get_clean();
	}
	else {
		return __( 'Template not found!', 'list-to-do' );
	}
}
endif;

if( !function_exists( 'ltd_get_list' ) ) :
function ltd_get_list() {
	global $wpdb;
    $_table = "{$wpdb->prefix}list_to_do";
	$sql 	= "SELECT * FROM {$_table} ORDER BY `id` DESC";
	$items 	= $wpdb->get_results( $sql );

	return $items;
}
endif;
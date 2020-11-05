<?php



if( !function_exists( 'ldt_get_templates' ) ) :
function ldt_get_templates( $slug ) {

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
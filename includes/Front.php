<?php
namespace jakaria\List_To_Do;

/**
 * 
 */
class Front
{
	public $plugin;
	
	function __construct( $plugin )	{
		$this->plugin = $plugin;
		$this->slug = $plugin['textdomain'];
		$this->version = $plugin['version'];
	}

	public function enqueue_scripts()	{
		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/front.css", LTD ), '', $this->version, 'all' );
		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/front.js", LTD ), [ 'jquery' ], $this->version, true );
		$localized = [
			'ajaxurl'	=> admin_url( 'admin-ajax.php' )
		];
		wp_localize_script( $this->slug, 'LTD',  $localized );
	}

	public function list_to_do(){

		$source = 'https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_todo';		

		return ldt_get_templates('list-to-do-html');
	}
}
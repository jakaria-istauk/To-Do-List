<?php
/*
Plugin Name: List to do
Description: Create a to do list
Version: 1.0.0
Text Domain: list-to-do
Author: Jakaria Istauk
Author URI: https://jakariaistauk.com
Plugin URI: https://jakariaistauk.com
*/

namespace jakaria\List_To_Do;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 */
class Plugin
{
	public static $instance;

	function __construct(){
		require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
		self::define();
		self::hooks();
	}

	public function define(){
		define( 'LTD', __FILE__ );

		$this->plugin['textdomain'] = 'list-to-do';
		$this->plugin['version'] = '1.0.0';
	}

	public function hooks()	{
		$admin = new Admin( $this->plugin );
		register_activation_hook( __FILE__, [ $admin, 'create_to_do_list_table' ] );

		$front = new Front( $this->plugin );
		add_action( 'wp_enqueue_scripts',[ $front, 'enqueue_scripts' ] );
		add_shortcode( 'list-to-do', [ $front, 'list_to_do' ] );

		$ajax = new Ajax( $this->plugin );
		add_action( 'wp_ajax_ltd-add-item', [ $ajax, 'add_items' ] );
		add_action( 'wp_ajax_update-status', [ $ajax, 'update_status' ] );
		add_action( 'wp_ajax_update-item', [ $ajax, 'update_item' ] );
		add_action( 'wp_ajax_delete-item', [ $ajax, 'delete_item' ] );
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
Plugin::instance();
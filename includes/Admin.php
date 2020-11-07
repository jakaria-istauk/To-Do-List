<?php
namespace jakaria\List_To_Do;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin
{
	public $plugin;
	
	function __construct( $plugin )	{
		$this->plugin 	= $plugin;
		$this->slug 	= $plugin['textdomain'];
		$this->version 	= $plugin['version'];
	}

	public function create_to_do_list_table(){
		global $wpdb;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $_table = "{$wpdb->prefix}list_to_do";
        $sql = "CREATE TABLE $_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            item text NOT NULL,
            status varchar(20) NOT NULL,
            UNIQUE KEY id (id)
        );";

        dbDelta( $sql );
	}
}
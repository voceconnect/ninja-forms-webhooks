<?php
/*
Plugin Name: Ninja Forms - Webhooks
Plugin URI: http://ninjaforms.com
Description: Send submission data collected by Ninja Forms to an external API/URL.
Version: 1.0.1
Author: The WP Ninjas
Author URI: http://ninjaforms.com
Text Domain: ninja-forms-wh
Domain Path: /lang/

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

/**
* 
*/
class NF_Webhooks
{
	function __construct() {
		// Define our plugin directory.
		if ( ! defined( 'NF_WH_DIR' ) )
			define( 'NF_WH_DIR', plugin_dir_path( __FILE__ ) );

		// Define our plugin URL.
		if ( ! defined( 'NF_WH_URL' ) )
			define( 'NF_WH_URL', plugin_dir_url( __FILE__ ) );

		// Define our plugin version.
		if ( ! defined( 'NF_WH_VERSION' ) )
			define( 'NF_WH_VERSION', '1.0.1' );

		add_filter( 'nf_notification_types', array( $this, 'register_action_type' ) );
		add_action( 'admin_init', array( $this, 'register_licensing' ) );
	}

	public function register_action_type( $types ) {
		$types['webhooks'] = require_once( NF_WH_DIR . 'classes/action-webhooks.php' );
		return $types;
	}

	public function register_licensing() {
		if ( class_exists( 'NF_Extension_Updater' ) ) {
	    	$NF_Extension_Updater = new NF_Extension_Updater( 'Webhooks', NF_WH_VERSION, 'WP Ninjas', __FILE__ );
		}
	}
}

new NF_Webhooks();
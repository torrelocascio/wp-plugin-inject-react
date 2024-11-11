<?php

/**
* The plugin bootstrap file
*
* This file is read by WordPress to generate the plugin information in the plugin
* admin area. This file also includes all of the dependencies used by the plugin,
* registers the activation and deactivation functions, and defines a function
* that starts the plugin.
*
* @link              http://github.com/real-token/torre-wp-plugin-template
* @since             1.0.26
* @package           torre-wp-plugin-template
*
* @wordpress-plugin
* Plugin Name:       > torre Plugin Template 1.0.0
* Plugin URI:        https://github.com/real-token/torre-wp-plugin-template
* GitHub Plugin URI: https://github.com/real-token/torre-wp-plugin-template
* Description:       torre-wp-plugin-template with ES6 and NPM in JS
* Version:           1.0.0
* Author:            Torre Locascio
* Author URI:        http://example.com
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       torre-wp-plugin-template
* Domain Path:       /languages

*/

// If this file is called directly, abort.

if ( !defined( 'WPINC' ) ) {
    die;
}


/**
* Current plugin version.
* Start at version 1.0.0 and use SemVer - https://semver.org
* Rename this for your plugin and update it as you release new versions.
*/
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
* The code that runs during plugin activation.
* This action is documented in includes/Activator.php
*/

function activate_plugin_title() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/Activator.php';
    Plugin_Abbr_Activator::activate();
}


/**
* The code that runs during plugin deactivation.
* This action is documented in includes/Deactivator.php
*/

function deactivate_plugin_title() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/Deactivator.php';
    Plugin_Abbr_Deactivator::deactivate();
}



register_activation_hook( __FILE__, 'activate_plugin_title' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_title' );



/**
* The core plugin class that is used to define internationalization,
* admin-specific hooks, and public-facing site hooks.
*/
require plugin_dir_path( __FILE__ ) . 'includes/Main.php';

/**
* Begins execution of the plugin.
*
* Since everything within the plugin is registered via hooks,
* then kicking off the plugin from this point in the file does
* not affect the page life cycle.
*
* @since    1.0.0
*/

function run_plugin_title() {

    $plugin = new Plugin_Name();
    $plugin->run();

}

run_plugin_title();

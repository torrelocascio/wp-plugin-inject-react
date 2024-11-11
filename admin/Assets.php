<?php

/**
* The admin-specific script and style enqueueing and versioning processes.
*
* @link       http://example.com
* @since      1.0.0
*
* @package    plugin-name
* @subpackage plugin-name/admin
*/

/**
* The admin-specific script and style enqueueing and versioning processes.
*
* Defines the plugin name and version,
* enqueues the admin-facing stylesheet and JavaScript,
* and assigns file modification time versions to break cache.
*
* @package    plugin-name
* @subpackage plugin-name/admin
* @author     Your Name <email@example.com>
*/
class Plugin_Abbr_Admin_Assets {

    /**
    * The ID of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $plugin_title    The ID of this plugin.
    */
    private $plugin_title;

    /**
    * The version of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $version    The current version of this plugin.
    */
    private $version;




    /**
    * Initialize the class and set its properties.
    *
    * @since    1.0.0
    * @param      string    $plugin_title        The name of the plugin.
    * @param      string    $version            The version of this plugin.
    */
    public function __construct( $plugin_title, $version /*, $conn, $queries */ ) {

        $this->plugin_title = $plugin_title;
        $this->version = $version;

        // For DB interactions:     OLD.  NEEDED IN MODULES.
        //$this->conn = $conn;
        //$this->queries = $queries;

    }


    /**
    * Register the combined stylesheet for the admin-facing side of the site.
    *
    * @since    1.0.0
    */
    public function enqueue_styles() {

        /**
        * An instance of this class is passed to the run() function
        * defined in Plugin_Abbr_Loader, which then creates the relationship
        * between the defined hooks and the functions defined in this
        * class.
        *
        * This architecture assumes you are transpiling all child directory
        * css/scss/less files into a single admin.css file in the /admin directory.
        */

        // Variable to hold the URL path for enqueueing.
        $admin_css_dir_url = plugin_dir_url( __DIR__ ) . 'admin/build/admin.min.css';

        // Variable to hold the server path for filemtime() and versioning.
        $admin_css_dir_path = plugin_dir_path( __DIR__ ) . 'admin/build/admin.min.css';

        // Register the style using an automatic and unique version based on modification time.
        wp_register_style( $this->plugin_title . '-admin-css', $admin_css_dir_url, array(), filemtime( $admin_css_dir_path ), 'all' );

        // Enqueue the style.
        wp_enqueue_style( $this->plugin_title . '-admin-css' );
        //wp_enqueue_style( 'thickbox' );

    }

    /**
    * Register the concat/minified JavaScript for the admin-facing side of the site.
    *
    * @since    1.0.0
    */
    public function enqueue_scripts() {

        /**
        * An instance of this class is passed to the run() function
        * defined in Plugin_Abbr_Loader, which then creates the relationship
        * between the defined hooks and the functions defined in this
        * class.
        *
        * This architecture assumes you are transpiling all child directory
        * JavaScript files into "/admin/admin.min.js".
        */

        // Variable to hold the URL path for enqueueing.
        $admin_js_dir_url = plugin_dir_url( __DIR__ ) . 'admin/build/index.js';

        // Variable to hold the server path for filemtime() and versioning.
        $admin_js_dir_path = plugin_dir_path( __DIR__ ) . 'admin/build/index.js';


        // Enqueue the build file here for npm

        wp_register_script( $this->plugin_title . '-admin-js', $admin_js_dir_url, [ 'wp-blocks', 'wp-element', 'wp-editor', 'jquery' ], filemtime( $admin_js_dir_path ), true );

        wp_enqueue_script( $this->plugin_title . '-admin-js' );

    }


    public function enqueue_admin_app_scripts() {

        /**
        * An instance of this class is passed to the run() function
        * defined in BKYC_Loader, which then creates the relationship
        * between the defined hooks and the functions defined in this
        * class.
        *
        * This architecture assumes that you are transpiling all child directory
        * JavaScript files into a single admin.min.js file in the /assets/admin directory.
        */

        // ***** Gift Order React App Scripts ***** //
        $admin_my_app_js_url = plugin_dir_url( __FILE__ ) . 'my-app/build/static/js/';
        $admin_my_app_js_path = plugin_dir_path( __FILE__ ) . 'my-app/build/static/js/';


        $my_app_js = scandir( $admin_my_app_js_path );


        foreach( $my_app_js as $index => $filename ) {
          if( strpos( $filename, '.js' ) && !strpos( $filename, '.map.js' ) && !strpos( $filename, '.txt') ) {
            wp_enqueue_script(
              $this->plugin_title . '-my-app-' . $index,
              $admin_my_app_js_url . $filename,
              array(),
              filemtime( $admin_my_app_js_path . $filename ),
              true
            );
          }
        }

      }

}

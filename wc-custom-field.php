<?php
/**
 * Plugin Name: WooCommerce Custom Field
 * Plugin URI: https://codeastrology.com
 * Description: WooCommerce Custom field setup and display.
 * Author: Saiful Islam
 * Author URI: https://codecanyon.net/user/codersaiful
 * Tags: WooCommerce, Woocommerce custom field
 * 
 * Version: 1.0
 * Requires at least:    4.0.0
 * Tested up to:         5.0.3
 * WC requires at least: 3.0.0
 * WC tested up to: 	 3.5.2
 * 
 * Text Domain: wccf
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Defining constant
 */
define( 'WCCF_PLUGIN_BASE_FOLDER', plugin_basename( dirname( __FILE__ ) ) );
define( 'WCCF_PLUGIN_BASE_FILE', plugin_basename( __FILE__ ) );
define( "WCCF_BASE_URL", WP_PLUGIN_URL . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
define( "wccf_dir_base", dirname( __FILE__ ) . '/' );
define( "WCCF_BASE_DIR", str_replace( '\\', '/', wccf_dir_base ) );



$WC_Custom_Field = WC_Custom_Field::getInstance();

/**
 * Setting Default Quantity for Configuration page
 * It will work for all product
 * 
 * @since 1.0
 */
WC_Custom_Field::$default_values = array(
    //DEFAULT VALUES WILL BE HERE
);

/**
 * Main Class for "WooCommerce Min Max Quantity & Step Control"
 * We have included file from __constructor of this class [WC_Custom_Field]
 */
class WC_Custom_Field {
    
    /**
     * Default keyword for WCMMQ
     * You will find this in wp_options table of database
     */
    const KEY = 'wccf_custom_fields';
    
    /*
     * Set default value based on default keyword.
     * All value will store in wp_options table based on Keyword wcmmq_universal_minmaxstep
     * 
     * @Sinc Version 1.0.0
     */
    public static $default_values = array();
    
    /**
     * For Instance
     *
     * @var Object 
     * @since 1.0
     */
    private static $_instance;
    
    /**

     */

    public function __construct() {
        $dir = dirname( __FILE__ );
        
        //Test File will load always when developing
        
        if( is_admin() ){
            
            require_once $dir . '/admin/product_panel.php';
            require_once $dir . '/admin/set_menu_and_fac.php';
            require_once $dir . '/admin/settings.php';
            require_once $dir . '/admin/custom_field.php';
        }
        require_once $dir . '/includes/enqueue.php';       
    }
    
    public static function getInstance() {
        if( ! ( self::$_instance instanceof self ) ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Installation function for Plugn WC_Custom_Field
     * 
     * @since 1.0
     */
    public static function install() {
        
        //code excute after plugin install
        
    }
    
    /**
     * Getting default key and value 's array
     * 
     * @return Array getting default value for basic plugin
     * @since 1.0
     */
    public static function getDefaults(){
        return self::$default_values;
    }

    /**
     * Getting Array of Options of wcmmq_universal_minmaxstep
     * 
     * @return Array Full Array of Options of wcmmq_universal_minmaxstep
     * 
     * @since 1.0.0
     */
    public static function getOptions(){
        return get_option( self::KEY );
    }
    
    /**
     * Getting Array of Options of wcmmq_universal_minmaxstep
     * 
     * @return Array Full Array of Options of wcmmq_universal_minmaxstep
     * 
     * @since 1.0.0
     */
    public static function getOption( $kewword = false ){
        $data = get_option( self::KEY );
        return $kewword && isset( $data[$kewword] ) ? $data[$kewword] : false;
    }
    
    /**
     * Un instalation Function
     * 
     * @since 1.0
     */
    public static function uninstall() {
        //Nothing to do for now
    }
    
    /**
    * Getting full Plugin data. We have used __FILE__ for the main plugin file.
    * 
    * @since V 1.0
    * @return Array Returnning Array of full Plugin's data for This Woo Product Table plugin
    */
    public static function getPluginData(){
       return get_plugin_data( __FILE__ );
    }

    /**
    * Getting Version by this Function/Method
    * 
    * @return type static String
    */
    public static function getVersion() {
       $data = self::getPluginData();
       return $data['Version'];
    }

    /**
    * Getting Version by this Function/Method
    * 
    * @return type static String
    */
    public static function getName() {
       $data = self::getPluginData();
       return $data['Name'];
    }
    
    /**
     * For checking anything
     * Only for test, Nothing for anything else
     * 
     * @since 1.0
     * @param void $something
     */
    public static function vd( $something ){
        echo '<div style="width:400px; margin: 30px 0 0 181px;">';
        var_dump( $something );
        echo '</div>';
    }
}

register_activation_hook(__FILE__, array( 'WC_Custom_Field','install' ) );
register_deactivation_hook( __FILE__, array( 'WC_Custom_Field','uninstall' ) );
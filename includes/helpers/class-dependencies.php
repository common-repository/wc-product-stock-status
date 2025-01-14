<?php
/**
 * Dependency Checker
 *
 * Checks if required Dependency plugin is enabled
 *
 * @link https://wordpress.org/plugins/wc-product-stock-status/
 * @package WC Product Stock Status
 * @subpackage WC Product Stock Status/core
 * @since 1.0
 */

if ( ! class_exists( 'WC_Product_Stock_Status_Dependencies' ) ){
    class WC_Product_Stock_Status_Dependencies {
		
        private static $active_plugins;
		
        public static function init() {
            self::$active_plugins = (array) get_option( 'active_plugins', array() );
            if ( is_multisite() )
                self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
        }
		
        public static function active_check($pluginToCheck = '') {
            if ( ! self::$active_plugins ) 
				self::init();
            return in_array($pluginToCheck, self::$active_plugins) || array_key_exists($pluginToCheck, self::$active_plugins);
        }
    }
}
/**
 * WC Detection
 */
if(! function_exists('WC_Product_Stock_Status_Dependencies')){
    function WC_Product_Stock_Status_Dependencies($pluginToCheck = 'woocommerce/woocommerce.php') {
        return WC_Product_Stock_Status_Dependencies::active_check($pluginToCheck);
    }
}
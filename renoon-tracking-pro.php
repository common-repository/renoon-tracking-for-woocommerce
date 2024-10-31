<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://renoon.com/partners/woocommerce-plugin
 * @since             1.0.0
 * @package           renoon_tracking
 *
 * @wordpress-plugin
 * Plugin Name:       Renoon Tracking for Woocommerce
 * Plugin URI:        https://renoon.com/partners/woocommerce-plugin
 * Description:       This plugin is for renoon tracking for WooCommerce. It allows Renoon merchants to to track sales from the renoon market place from their WooCommerce Store
 * Version:           1.1.4
 * Author:            Renoon
 * Author URI:        https://www.renoon.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       renoon_tracking
 * Domain Path:       /languages
 * WC requires at least: 3.0
 * WC tested up to: 6.2.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RENOON_TRACKING_PRO_VERSION', '1.1.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-renoon-tracking-activator.php
 */
function activate_renoon_tracking_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-renoon-tracking-pro-activator.php';
	renoon_tracking_pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-renoon-tracking-deactivator.php
 */
function deactivate_renoon_tracking_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-renoon-tracking-pro-deactivator.php';
	renoon_tracking_pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_renoon_tracking_pro' );
register_deactivation_hook( __FILE__, 'deactivate_renoon_tracking_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-renoon-tracking-pro.php';

function renoon_tracking_pro_plugin_add_settings_link( $links ) {
	$settings_link = '<a href="tools.php?page=renoon-tracking-pro">' . __( 'Settings' ) . '</a>';
	$premium_link = '<a href="https://www.wpconcierges.com/plugins/renoon-tracking/">' . __( 'Documentation' ) . '</a>';
	array_push( $links, $settings_link );
	array_push( $links, $premium_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'renoon_tracking_pro_plugin_add_settings_link' );
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_renoon_tracking_pro() {

	$plugin = new renoon_tracking_pro();
	$plugin->run();

}
run_renoon_tracking_pro();

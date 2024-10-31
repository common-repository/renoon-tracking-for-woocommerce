<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.wpconcierges.com/plugins/renoon_tracking/
 * @since      1.0.0
 *
 * @package    renoon_tracking
 * @subpackage renoon_tracking/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    renoon_tracking
 * @subpackage renoon_tracking/includes
 * @author     WpConcierges <support@wpconcierges.com>
 */
class renoon_tracking_pro_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'renoon_tracking_pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

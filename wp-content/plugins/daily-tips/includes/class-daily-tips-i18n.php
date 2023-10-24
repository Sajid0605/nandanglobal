<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://iamsajidansari.com
 * @since      1.0.0
 *
 * @package    Daily_Tips
 * @subpackage Daily_Tips/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Daily_Tips
 * @subpackage Daily_Tips/includes
 * @author     Sajid Ansari <sajidansari0605@gmail.com>
 */
class Daily_Tips_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'daily-tips',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

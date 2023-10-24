<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://iamsajidansari.com
 * @since             1.0.0
 * @package           Daily_Tips
 *
 * @wordpress-plugin
 * Plugin Name:       Tip of the day
 * Plugin URI:        https://iamsajidansari.com
 * Description:       showing a tip of the day set by the admin
 * Version:           1.0.0
 * Author:            Sajid Ansari
 * Author URI:        https://iamsajidansari.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       daily-tips
 * Domain Path:       /languages
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
define( 'DAILY_TIPS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-daily-tips-activator.php
 */
function activate_daily_tips() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-daily-tips-activator.php';
	Daily_Tips_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-daily-tips-deactivator.php
 */
function deactivate_daily_tips() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-daily-tips-deactivator.php';
	Daily_Tips_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_daily_tips' );
register_deactivation_hook( __FILE__, 'deactivate_daily_tips' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-daily-tips.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_daily_tips() {

	$plugin = new Daily_Tips();
	$plugin->run();

}
run_daily_tips();


function daily_tip_post_type_init() {
	// REGISTER CUSTOM POST TYPE
	register_post_type('daily-tip', array(
		'label' => __('Tips of the Day','daily-tip'),
		'singular_label' => __('Tip of the Day','daily-tip'),
		'public' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'hierarchical'=>false,
		'query_var' => true,
		'capability_type' => 'post', //should be yclad
		/*
		'edit_cap' => 'edit_daily-tip',
		'edit_type_cap' => 'edit_daily-tips',
		'edit_others_cap' => 'edit_others_daily-tips',
		'publish_cap' => 'publish_daily-tips',
		'read_cap' => 'read_daily-tip',
		'read_private_cap' => 'read_private_daily-tips',
		'delete_cap' => 'delete_daily-tip',
		*/
		'supports' => array('title', 'editor', 'author','excerpt','custom-fields'),
		'rewrite' => array( 'slug' => __('daily-tip','yclads-slugs'), 'with_front' => false )
	));
	
	add_post_type_support( 'daily-tip', 'post-thumbnails' );

	// Create thumbnail sizes
	add_image_size( 'daily-tip_large', 500, 500 );
	add_image_size( 'daily-tip_normal', 200, 200 );
	add_image_size( 'daily-tip_thumb', 100,100 ); 

}
// Initiate the class
add_action("init", "daily_tip_post_type_init");
<?php
/*
Plugin Name: Veems
Plugin URI:  https://wordpress.org/plugins/veems/
Description: Add Veems support to your WordPress site
Version:     1.0
Author:      Rami Yushuvaev
Author URI:  http://GenerateWP.com/
Text Domain: veems
*/



/*
 * Security check
 * Exit if file accessed directly.
 *
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/*
 * Include plugin files
 */
include_once ( plugin_dir_path( __FILE__ ) . 'activator.php' );   // Add Activation hook
include_once ( plugin_dir_path( __FILE__ ) . 'deactivator.php' ); // Add Deactivation hook
include_once ( plugin_dir_path( __FILE__ ) . 'admin.php' );       // Add Admin Page
include_once ( plugin_dir_path( __FILE__ ) . 'api.php' );         // Add veems API
include_once ( plugin_dir_path( __FILE__ ) . 'content.php' );     // Add follow me button to the content



/*
 * Add settings link on plugin page
 *
 * @since 1.0
 */
function veems_settings_link( $links ) {
	$links[] = '<a href="options-general.php?page=veems">' . __( 'Settings' ) . '</a>';
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'veems_settings_link' );

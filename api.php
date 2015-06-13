<?php
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
 * Veems API request send
 *
 * @since 1.0
 */
function veems_api_ping_send( $post ) {

	// Load veems settings
	$options = (array) get_option( 'veems_settings' );

	// Set veems params
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$api_url = 'http://ping.veems.in/';
	$veems = esc_url_raw(
		$api_url . 
		'?api_type=2' .
		'&api_key=' . $options['veems_api_key'] . 
		'&site_url=' . get_home_url() . 
		'&site_name=' . get_bloginfo( 'name' ) . 
		'&site_owner_email=' . get_bloginfo( 'admin_email' ) . 
		'&post_link=' . get_permalink( $post->ID ) . 
		'&post_title=' . urlencode( get_the_title( $post->ID ) ) . 
		'&post_thumbnail=' . $thumb[0]
	);

	// API call
	$response = wp_remote_get( $veems );

}

function veems_api_ping_check( $new_status, $old_status, $post ) {

	// Check if the new status is 'publish'
	if ( $new_status == 'publish' && $new_status != $old_status )
		return

	// Send ping
	veems_api_ping_send( $post );

}

add_action( 'transition_post_status', 'veems_api_ping_check', 10, 3 );



/*
 * TODO: replace the above filter with one of those
 */
//add_filter( 'wp_insert_post_data', 'veems_api_ping_send', 10, 2 );
//add_filter( 'wp_insert_post', 'veems_api_ping_send' );

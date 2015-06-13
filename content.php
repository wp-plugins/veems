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
 * Veems follow me button
 * Add a button to the end of every post.
 *
 * @uses is_single()
 */
function veems_followme_button( $content ) {

	// Load veems settings
	$options = (array) get_option( 'veems_settings' );

	// Validate
	if ( ! array_key_exists( 'veems_followme_button', $options ) )
		return $content;

	// Bail if the option is not checked on the settings page
	if ( ! $options['veems_followme_button'] )
		return $content;

	// Check if it's a single post view
	if ( is_single() ) {

		// Add image to the beginning of each page
		$content = sprintf(
			'%1$s<a href="%2$s" target="_blank"><img src="%3$s" class="veems-follow-me" alt="Follow me on veems"></a>',
			$content,
			'http://getveems.com/',
			plugins_url( 'images/follow_me.png', __FILE__ )
		);

	}

	// Returns the new content
	return $content;

}
add_filter( 'the_content', 'veems_followme_button', 20 );

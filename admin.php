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
 * Veems admin menu
 *
 * @since 1.0
 */
function veems_add_admin_menu() { 

	add_options_page(
		__( 'Veems', 'veems' ),
		__( 'Veems', 'veems' ),
		'manage_options',
		'veems',
		'veems_options_page'
	);

}
add_action( 'admin_menu', 'veems_add_admin_menu' );



/*
 * Veems admin layout
 *
 * @since 1.0
 */
function veems_options_page() { 

	?>
	<h1><?php esc_html_e( 'Veems', 'veems' ); ?></h1>

	<form action='options.php' method='post'>

		<?php
		settings_fields( 'veems_admin_page' );
		do_settings_sections( 'veems_admin_page' );
		submit_button();
		?>

	</form>
	<?php

}



/*
 * Register veems settings
 *
 * @since 1.0
 */
function veems_settings_init() { 

	register_setting(
		'veems_admin_page',
		'veems_settings'
	);

	add_settings_section(
		'veems_veems_admin_page_section', 
		__( 'Settings', 'veems' ),
		'veems_settings_section_render', 
		'veems_admin_page'
	);

	add_settings_field( 
		'veems_api_key', 
		__( 'API Key', 'veems' ), 
		'veems_api_key_render', 
		'veems_admin_page', 
		'veems_veems_admin_page_section' 
	);

	add_settings_field( 
		'veems_followme_button', 
		__( 'Follow me button', 'veems' ), 
		'veems_followme_button_render', 
		'veems_admin_page', 
		'veems_veems_admin_page_section' 
	);

}
add_action( 'admin_init', 'veems_settings_init' );



function veems_settings_section_render() {

	echo '<p>';
	_e( 'Grow you audience, expanding your network reach, Integrate your site content into veems!', 'veems' );
	echo '</p>';

	echo '<p>';
	_e( 'To make the magic happen, enter the following information:', 'veems' );
	echo '</p>';

}
function veems_api_key_render() { 

	// Load veems settings
	$options = (array) get_option( 'veems_settings' );

	// Validate
	if ( ! array_key_exists( 'veems_api_key', $options ) ) {
		$options['veems_api_key'] = '';
	}

	// Output
	?>
	<input type='text' name='veems_settings[veems_api_key]' value='<?php echo $options['veems_api_key']; ?>' class='regular-text'>
	<p class="description"><?php _e( 'Your Veems API key.', 'veems' ); ?></p>
	<?php

}
function veems_followme_button_render() { 

	// Load veems settings
	$options = (array) get_option( 'veems_settings' );

	// Validate
	if ( ! array_key_exists( 'veems_followme_button', $options ) ) {
		$options['veems_followme_button'] = '';
	}

	// Output
	?>
	<input type='checkbox' name='veems_settings[veems_followme_button]' <?php checked( $options['veems_followme_button'], 1 ); ?> value="1"> <?php _e( 'Add veems "Follow Me" button to the content.', 'veems' ); ?>
	<p class="description"><?php _e( 'The button will allow veems users to follow your post each time you publish new post.', 'veems' ); ?></p>
	<?php

}

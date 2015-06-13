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
 * Fired when the plugin is activated.
 * This class defines all code necessary to run during plugin activation.
 *
 * @since 1.0
 */
class VeemsActivator {

	/*
	 * Activate
	 */
	public static function activate() {

		// Set default option
		$options['veems_api_key']         = '';
		$options['veems_followme_button'] = 1;

		// Add default option to the database
		add_option( 'veems_settings', $options, '', 'yes' );

		// Add default option to the database in multisite
		add_site_option( 'veems_settings', $options );

	}

}



/*
 * Register WordPress activation hook
 * Run the activator class only when activation hook called
 *
 * @since 1.0
 */
function Veems_activation() {

	VeemsActivator::activate();

}
register_activation_hook( __FILE__, 'Veems_activation' );

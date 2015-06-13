<?php
/*
 * Security check
 * Exit if uninstall not called from WordPress.
 *
 * @since 1.0
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit ();
}



/*
 * Delete option from options table
 *
 * @since 1.0
 */
delete_option( 'veems_settings' );



/*
 * Delete option from the database in multisite
 *
 * @since 1.0
 */
delete_site_option( 'veems_settings' );

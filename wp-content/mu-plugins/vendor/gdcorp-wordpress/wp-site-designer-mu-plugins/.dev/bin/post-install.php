#!/usr/bin/env php
<?php
/**
 * Post-install script for composer.
 *
 * @package WP_Site_Designer
 */

$wp_site_designer_base_dir    = dirname( __DIR__, 2 );
$wp_site_designer_mozart_path = $wp_site_designer_base_dir . '/vendor/bin/mozart';

if ( file_exists( $wp_site_designer_mozart_path ) ) {
	chdir( $wp_site_designer_base_dir );
	// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.system_calls_system -- Build script requires system calls.
	system( escapeshellarg( $wp_site_designer_mozart_path ) . ' compose' );
	// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.system_calls_system -- Build script requires system calls.
	system( 'composer dump-autoload' );
}

<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Theme Updater
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://desertthemes.com/', // Site where EDD is hosted
		'item_name' => 'NewsMunch Pro', // Name of theme
		'theme_slug' => 'newsmunch-pro', // Theme slug
		'version' => '1.0', // The current version of this theme
		'author' => 'Desert Themes', // The author of this theme
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'newsmunch-pro' ),
		'enter-key' => __( 'Enter your theme license key.', 'newsmunch-pro' ),
		'license-key' => __( 'License Key', 'newsmunch-pro' ),
		'license-action' => __( 'License Action', 'newsmunch-pro' ),
		'deactivate-license' => __( 'Deactivate License', 'newsmunch-pro' ),
		'activate-license' => __( 'Activate License', 'newsmunch-pro' ),
		'status-unknown' => __( 'License status is unknown.', 'newsmunch-pro' ),
		'renew' => __( 'Renew?', 'newsmunch-pro' ),
		'unlimited' => __( 'unlimited', 'newsmunch-pro' ),
		'license-key-is-active' => __( 'License key is active.', 'newsmunch-pro' ),
		'expires%s' => __( 'Expires %s.', 'newsmunch-pro' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'newsmunch-pro' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'newsmunch-pro' ),
		'license-key-expired' => __( 'License key has expired.', 'newsmunch-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'newsmunch-pro' ),
		'license-is-inactive' => __( 'License is inactive.', 'newsmunch-pro' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'newsmunch-pro' ),
		'site-is-inactive' => __( 'Site is inactive.', 'newsmunch-pro' ),
		'license-status-unknown' => __( 'License status is unknown.', 'newsmunch-pro' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'newsmunch-pro' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'newsmunch-pro' )
	)

);
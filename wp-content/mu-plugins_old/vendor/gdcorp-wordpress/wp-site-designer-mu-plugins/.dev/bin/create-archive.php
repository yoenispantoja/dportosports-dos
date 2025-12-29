#!/usr/bin/env php
<?php
/**
 * Create release archive
 *
 * @package WP_Site_Designer
 */

// Get version from main plugin file.
$wp_site_designer_plugin_file = __DIR__ . '/../../wp-site-designer-mu-plugins.php';
if ( ! file_exists( $wp_site_designer_plugin_file ) ) {
	echo "Error: Plugin file not found\n";
	exit( 1 );
}

// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- CLI script reading local file, WordPress not loaded.
$wp_site_designer_content = file_get_contents( $wp_site_designer_plugin_file );

if ( ! preg_match( '/Version:\s*([0-9.]+)/', $wp_site_designer_content, $matches ) ) {
	echo "Error: Could not extract version from plugin file\n";
	exit( 1 );
}

$wp_site_designer_version  = $matches[1];
$wp_site_designer_base_dir = dirname( __DIR__, 2 );
$wp_site_designer_zip_file = $wp_site_designer_base_dir . "/../wp-site-designer-mu-plugins-{$wp_site_designer_version}.zip";

// Validate and normalize the zip file path to prevent directory traversal.
$wp_site_designer_zip_file_real = realpath( dirname( $wp_site_designer_zip_file ) ) . '/' . basename( $wp_site_designer_zip_file );
$wp_site_designer_expected_dir  = realpath( $wp_site_designer_base_dir . '/..' );

// Only proceed if the resolved path is within the expected directory and filename matches expected pattern.
if ( $wp_site_designer_expected_dir && strpos( $wp_site_designer_zip_file_real, $wp_site_designer_expected_dir ) === 0 && preg_match( '/^wp-site-designer-mu-plugins-[0-9.]+\.zip$/', basename( $wp_site_designer_zip_file_real ) ) ) {
	$wp_site_designer_zip_file = $wp_site_designer_zip_file_real;
} else {
	echo "Error: Invalid archive path\n";
	exit( 1 );
}

// Remove old archive if it exists.
if ( file_exists( $wp_site_designer_zip_file ) ) {
	unlink( $wp_site_designer_zip_file );
}

// Create zip archive.
$wp_site_designer_zip = new ZipArchive();
if ( $wp_site_designer_zip->open( $wp_site_designer_zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE ) !== true ) {
	echo "Error: Failed to create archive\n";
	exit( 1 );
}

$wp_site_designer_exclude = array(
	'.git',
	'.gitignore',
	'.DS_Store',
	'.idea',
	'.vscode',
	'*.log',
	'composer.json',
	'composer.lock',
	'phpcs.xml',
	'README.md',
	'AUTHENTICATION_AUTHORIZATION_SECURITY.md',
	'auth.json',
	'.dev',
	'node_modules',
);

$wp_site_designer_iterator = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator( $wp_site_designer_base_dir, RecursiveDirectoryIterator::SKIP_DOTS ),
	RecursiveIteratorIterator::SELF_FIRST
);

foreach ( $wp_site_designer_iterator as $wp_site_designer_file ) {
	if ( $wp_site_designer_file->isFile() ) {
		$wp_site_designer_file_path      = $wp_site_designer_file->getRealPath();
		$wp_site_designer_relative_path  = substr( $wp_site_designer_file_path, strlen( $wp_site_designer_base_dir ) + 1 );
		$wp_site_designer_should_exclude = false;

		// For vendor directory, only include composer/ and autoload.php.
		if ( 0 === strpos( $wp_site_designer_relative_path, 'vendor/' ) ) {
			if ( 'vendor/autoload.php' !== $wp_site_designer_relative_path && 0 !== strpos( $wp_site_designer_relative_path, 'vendor/composer/' ) ) {
				$wp_site_designer_should_exclude = true;
			}
		} else {
			// For non-vendor files, use exclusion patterns.
			foreach ( $wp_site_designer_exclude as $wp_site_designer_pattern ) {
				// Check if path starts with pattern (for directory exclusions).
				if ( 0 === strpos( $wp_site_designer_relative_path, $wp_site_designer_pattern . '/' ) || $wp_site_designer_relative_path === $wp_site_designer_pattern ) {
					$wp_site_designer_should_exclude = true;
					break;
				}
				// Check fnmatch for wildcard patterns.
				if ( fnmatch( $wp_site_designer_pattern, $wp_site_designer_relative_path ) || fnmatch( $wp_site_designer_pattern, basename( $wp_site_designer_relative_path ) ) ) {
					$wp_site_designer_should_exclude = true;
					break;
				}
			}
		}

		if ( ! $wp_site_designer_should_exclude ) {
			$wp_site_designer_zip->addFile( $wp_site_designer_file_path, $wp_site_designer_relative_path );
		}
	}
}

$wp_site_designer_zip->close();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI script output, WordPress not loaded.
echo "Archive created: {$wp_site_designer_zip_file}\n";
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI script output, WordPress not loaded.
echo 'Archive size: ' . wp_site_designer_format_bytes( filesize( $wp_site_designer_zip_file ) ) . "\n";

/**
 * Format bytes to human-readable format.
 *
 * @param int $bytes Bytes to format.
 * @param int $precision Precision for rounding.
 * @return string Formatted string.
 */
function wp_site_designer_format_bytes( $bytes, $precision = 2 ) {
	$wp_site_designer_units  = array( 'B', 'KB', 'MB', 'GB', 'TB' );
	$wp_site_designer_bytes  = max( $bytes, 0 );
	$wp_site_designer_pow    = floor( ( $wp_site_designer_bytes ? log( $wp_site_designer_bytes ) : 0 ) / log( 1024 ) );
	$wp_site_designer_pow    = min( $wp_site_designer_pow, count( $wp_site_designer_units ) - 1 );
	$wp_site_designer_bytes /= pow( 1024, $wp_site_designer_pow );
	return round( $wp_site_designer_bytes, $precision ) . ' ' . $wp_site_designer_units[ $wp_site_designer_pow ];
}


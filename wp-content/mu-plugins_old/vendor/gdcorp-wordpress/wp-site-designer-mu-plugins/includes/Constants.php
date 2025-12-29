<?php
/**
 * Shared constants for Site Designer plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner;

use function getenv;

/**
 * Shared constants for Site Designer plugin
 */
class Constants {

	public const SITE_DESIGNER_OPTION = 'gdmu_site_designer';

	/**
	 * Environment-based allowed origins for iframe embedding
	 */
	public const ALLOWED_IFRAME_ORIGINS = array(
		'dev'  => array(
			'https://airo-sentinel.dev-godaddy.com',
		),
		'test' => array(
			'https://airo-sentinel.test-godaddy.com',
		),
		'prod' => array(
			'https://airo-sentinel.godaddy.com',
			'https://airo.ai',
			'https://godaddy.com',
			'https://www.godaddy.com',
			'https://hub.godaddy.com',
			'https://host.godaddy.com',
			'https://account.godaddy.com',
			'https://sec.godaddy.com',
			'https://dcc.godaddy.com',
			'https://start.godaddy.com',
			'https://dashboard.godaddy.com',
		),
	);

	/**
	 * Environment-based allowed origins for API calls
	 */
	public const ALLOWED_API_ORIGINS = array(
		'dev'  => array(
			'https://site-designer-api.dev-godaddy.com',
		),
		'test' => array(
			'https://site-designer-api.test-godaddy.com',
		),
		'prod' => array(
			'https://site-designer-api.godaddy.com',
		),
	);

	/**
	 * Get allowed iframe origins for the current environment
	 *
	 * @return array
	 */
	public static function getActiveOrigins(): array {
		$env = self::getEnvironment();

		if ( isset( self::ALLOWED_IFRAME_ORIGINS[ $env ] ) ) {
			return self::ALLOWED_IFRAME_ORIGINS[ $env ];
		}

		return self::ALLOWED_IFRAME_ORIGINS['prod'];
	}

	/**
	 * Get allowed API origins for the current environment
	 *
	 * @return array
	 */
	public static function getActiveApiOrigins(): array {
		$env = self::getEnvironment();

		if ( isset( self::ALLOWED_API_ORIGINS[ $env ] ) ) {
			return self::ALLOWED_API_ORIGINS[ $env ];
		}

		return self::ALLOWED_API_ORIGINS['prod'];
	}

	/**
	 * Get current environment
	 *
	 * @return string
	 */
	public static function getEnvironment(): string {
		$env = getenv( 'SERVER_ENV' );
		if ( $env && in_array( $env, array( 'dev', 'test', 'prod' ), true ) ) {
			return $env;
		}

		return 'prod';
	}

	public static function usesSiteDesigner(): bool {
		return boolval( get_option( self::SITE_DESIGNER_OPTION, false ) );

	}
}


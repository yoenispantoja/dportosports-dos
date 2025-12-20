<?php
/**
 * Request Validator Utility
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Utilities;

/**
 * Validates request origins and rate limiting
 */
class RequestValidator {

	/**
	 * Validate Origin header for server-to-server API requests
	 *
	 * @param array $headers Request headers (key-value pairs).
	 * @param array $allowed_origins Array of allowed origins.
	 * @return bool
	 */
	public static function validateOriginHeader( $headers, $allowed_origins ) {
		$origin = self::getHeader( $headers, 'origin' );

		if ( empty( $origin ) ) {
			return false;
		}

		return self::isAllowedOrigin( $origin, $allowed_origins );
	}

	/**
	 * Check if origin is in allowed list
	 *
	 * @param string $origin The origin header value.
	 * @param array  $allowed_origins Array of allowed origins.
	 * @return bool
	 */
	public static function isAllowedOrigin( $origin, $allowed_origins ) {
		$origin_parts = self::parseOrigin( $origin );
		if ( null === $origin_parts ) {
			return false;
		}

		foreach ( $allowed_origins as $allowed ) {
			$allowed_parts = self::parseOrigin( $allowed );
			if ( null === $allowed_parts ) {
				continue;
			}

			if ( self::originsMatch( $origin_parts, $allowed_parts ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Parse and normalize origin components (scheme, host, port)
	 *
	 * @param string $origin The origin URL.
	 * @return array|null Array with 'scheme', 'host', 'port' keys, or null if invalid.
	 */
	public static function parseOrigin( $origin ) {
		if ( empty( $origin ) ) {
			return null;
		}

		$parsed = parse_url( $origin );
		$scheme = $parsed['scheme'] ?? '';
		$host   = $parsed['host'] ?? '';
		$port   = $parsed['port'] ?? null;

		if ( empty( $scheme ) || empty( $host ) ) {
			return null;
		}

		return array(
			'scheme' => $scheme,
			'host'   => $host,
			'port'   => $port,
		);
	}

	/**
	 * Compare two parsed origins for equality
	 *
	 * @param array $origin1 First origin parts from parseOrigin().
	 * @param array $origin2 Second origin parts from parseOrigin().
	 * @return bool True if origins match.
	 */
	public static function originsMatch( $origin1, $origin2 ) {
		// phpcs:disable WordPress.WhiteSpace.PrecisionAlignment -- Aligned for readability.
		return $origin1['scheme'] === $origin2['scheme'] &&
			   $origin1['host'] === $origin2['host'] &&
			   $origin1['port'] === $origin2['port'];
		// phpcs:enable
	}

	/**
	 * Check rate limit using fixed window counter
	 *
	 * @param string $identifier Unique identifier (IP, customer_id, JWT hash).
	 * @param int    $max_requests Maximum requests allowed.
	 * @param int    $window_seconds Time window in seconds.
	 * @return bool True if within limit, false if rate limited.
	 */
	public static function checkRateLimitSliding( $identifier, $max_requests = 10, $window_seconds = 60 ) {
		$now        = time();
		$window_key = floor( $now / $window_seconds ); // Fixed time bucket.
		$key        = 'rate_limit_' . hash( 'sha256', $identifier . '_' . $window_key );

		// Get current count for this time window.
		$count = (int) get_transient( $key );

		// Check if limit exceeded.
		if ( $count >= $max_requests ) {
			return false;
		}

		// Increment counter (race conditions may allow slightly over limit, but acceptable).
		set_transient( $key, $count + 1, $window_seconds * 2 );

		return true;
	}

	/**
	 * Get header value from headers array
	 *
	 * @param array  $headers Headers array.
	 * @param string $key Header key (case-insensitive).
	 * @return string|null
	 */
	private static function getHeader( $headers, $key ) {
		$key = strtolower( $key );

		foreach ( $headers as $header_key => $header_value ) {
			if ( strtolower( $header_key ) === $key ) {
				if ( is_array( $header_value ) ) {
					return ! empty( $header_value ) ? (string) $header_value[0] : null;
				}
				return (string) $header_value;
			}
		}

		return null;
	}
}


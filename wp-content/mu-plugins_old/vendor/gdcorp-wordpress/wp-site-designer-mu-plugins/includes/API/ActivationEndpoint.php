<?php
/**
 * Activation Endpoint API
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\API;

use GoDaddy\WordPress\Plugins\SiteDesigner\Auth\JWTAuthenticator;
use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;
use GoDaddy\WordPress\Plugins\SiteDesigner\Utilities\RequestValidator;

/**
 * REST API endpoint for Site Designer activation/deactivation
 */
class ActivationEndpoint {

	/**
	 * JWT authenticator instance
	 *
	 * @var JWTAuthenticator
	 */
	private $authenticator;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->authenticator = new JWTAuthenticator();
	}

	/**
	 * Register hooks
	 */
	public function register() {
		add_action( 'rest_api_init', array( $this, 'registerRoutes' ) );
		add_filter( 'gdl_unrestricted_rest_endpoints', array( $this, 'add_unrestricted_endpoints' ) );
	}

	/**
	 * Register REST API routes
	 */
	public function registerRoutes() {
		register_rest_route(
			'wp-site-designer/v1',
			'/activate',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'handleActivation' ),
				'permission_callback' => function ( $request ) {
					return $this->validateWithRateLimit( $request, 50, 300 ); // 10 per 1 minute
				},
			)
		);

		register_rest_route(
			'wp-site-designer/v1',
			'/deactivate',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'handleDeactivation' ),
				'permission_callback' => function ( $request ) {
					return $this->validateWithRateLimit( $request, 50, 300 ); // 10 per 1 minute
				},
			)
		);

		register_rest_route(
			'wp-site-designer/v1',
			'/status',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'handleStatus' ),
				'permission_callback' => function ( $request ) {
					return $this->validateWithRateLimit( $request, 60, 60 ); // 60 per minute
				},
			)
		);
	}

	/**
	 * Validate JWT with rate limiting
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @param int $max_requests Maximum requests allowed.
	 * @param int $window_seconds Time window in seconds.
	 *
	 * @return bool|\WP_Error
	 */
	public function validateWithRateLimit( $request, $max_requests, $window_seconds ) {
		$site_id    = $request->get_header( 'X-Site-ID' ) ?? $request->get_param( 'site_id' ) ?? '';
		$jwt        = $request->get_header( 'X-GD-JWT' );
		$identifier = ! empty( $site_id ) ? $site_id : hash( 'sha256', $jwt ?? '' );

		if ( ! RequestValidator::checkRateLimitSliding( $identifier, $max_requests, $window_seconds ) ) {
			return new \WP_Error(
				'rate_limit_exceeded',
				'Too many requests. Please try again later.',
				array( 'status' => 429 )
			);
		}

		return $this->validateJWT( $request );
	}

	/**
	 * Validate JWT from request headers
	 *
	 * @param \WP_REST_Request $request Request object.
	 *
	 * @return bool
	 */
	public function validateJWT( $request ) {
		if ( ! RequestValidator::validateOriginHeader( $request->get_headers(), Constants::getActiveApiOrigins() ) ) {
			return false;
		}

		$jwt = $request->get_header( 'X-GD-JWT' );
		if ( empty( $jwt ) ) {
			return false;
		}

		$site_id = $request->get_header( 'X-Site-ID' ) ?? $request->get_param( 'site_id' ) ?? '';

		return $this->authenticator->authenticate_request( $jwt, $site_id );
	}

	/**
	 * Handle activation request
	 *
	 * @param \WP_REST_Request $request Request object.
	 *
	 * @return \WP_REST_Response
	 */
	public function handleActivation( $request ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter -- REST API callback requires specific signature.
		update_option( 'wp_site_designer_activated', true, true );
		update_option( Constants::SITE_DESIGNER_OPTION, '1', false );

		return rest_ensure_response(
			array(
				'status'    => 'activated',
				'timestamp' => time(),
			)
		);
	}

	/**
	 * Handle deactivation request
	 *
	 * @param \WP_REST_Request $request Request object.
	 *
	 * @return \WP_REST_Response
	 */
	public function handleDeactivation( $request ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter -- REST API callback requires specific signature.
		delete_option( 'wp_site_designer_activated' );

		return rest_ensure_response(
			array(
				'status'    => 'deactivated',
				'timestamp' => time(),
			)
		);
	}

	/**
	 * Handle status request
	 *
	 * @param \WP_REST_Request $request Request object.
	 *
	 * @return \WP_REST_Response
	 */
	public function handleStatus( $request ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter -- REST API callback requires specific signature.
		$is_activated = (bool) get_option( 'wp_site_designer_activated', false );

		return rest_ensure_response(
			array(
				'activated' => $is_activated,
				'timestamp' => time(),
			)
		);
	}

	/**
	 * Add unrestricted endpoints
	 *
	 * @param array $endpoints Endpoints array.
	 *
	 * @return array
	 */
	public function add_unrestricted_endpoints( $endpoints ) {

		$endpoints[] = '/wp-site-designer/v1';

		return $endpoints;
	}
}


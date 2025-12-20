<?php
/**
 * Upload Image Tool Class
 *
 * @package     mcp-adapter-initializer
 * @author      GoDaddy
 * @copyright   2025 GoDaddy
 * @license     GPL-2.0-or-later
 */

namespace GD\MCP\Tools;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/class-base-tool.php';

/**
 * Upload Image Tool
 *
 * Handles the registration and execution of the upload image ability
 * for the MCP adapter.
 */
class Upload_Image_Tool extends Base_Tool {
	/**
	 * Tool identifier
	 *
	 * @var string
	 */
	const TOOL_ID = 'gd-mcp/upload-image';

	/**
	 * @var self|null
	 */
	private static $instance = null;

	/**
		* @return self
		*/
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Private constructor to prevent direct instantiation
	 */
	private function __construct() {}

	/**
	 * Register the upload image ability
	 *
	 * @return void
	 */
	public function register(): void {
		wp_register_ability(
			self::TOOL_ID,
			array(
				'label'               => __( 'Upload Image', 'mcp-adapter-initializer' ),
				'description'         => __( 'Downloads an image from a URL and uploads it to the WordPress media library, optionally attaching it to a post', 'mcp-adapter-initializer' ),
				'input_schema'        => $this->get_input_schema(),
				'output_schema'       => $this->get_output_schema(),
				'execute_callback'    => array( $this, 'execute_with_admin' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Get the tool identifier
	 *
	 * @return string
	 */
	public function get_tool_id(): string {
		return self::TOOL_ID;
	}

	/**
	 * Get input schema for the tool
	 *
	 * @return array
	 */
	private function get_input_schema(): array {
		return array(
			'type'       => 'object',
			'properties' => array(
				'url'     => array(
					'type'        => 'string',
					'description' => __( 'The URL of the image to download and upload', 'mcp-adapter-initializer' ),
				),
				'post_id' => array(
					'type'        => 'integer',
					'description' => __( 'Optional. The post ID to attach the image to', 'mcp-adapter-initializer' ),
				),
				'title'   => array(
					'type'        => 'string',
					'description' => __( 'Optional. The title/description for the image', 'mcp-adapter-initializer' ),
				),
			),
			'required'   => array( 'url' ),
		);
	}

	/**
	 * Get output schema for the tool
	 *
	 * @return array
	 */
	private function get_output_schema(): array {
		return array(
			'type'       => 'object',
			'properties' => array(
				'success'       => array(
					'type'        => 'boolean',
					'description' => 'Whether the upload was successful',
				),
				'attachment_id' => array(
					'type'        => 'integer',
					'description' => 'The attachment ID of the uploaded image',
				),
				'url'           => array(
					'type'        => 'string',
					'description' => 'The URL of the uploaded image',
				),
				'message'       => array(
					'type'        => 'string',
					'description' => 'Success or error message',
				),
			),
		);
	}

	/**
	 * Execute the upload image tool
	 *
	 * @param array $input Input parameters
	 * @return array Upload result or error
	 */
	public function execute( array $input ): array {
		if ( empty( $input['url'] ) ) {
			return array(
				'success' => false,
				'message' => __( 'Image URL is required', 'mcp-adapter-initializer' ),
			);
		}

		// Sanitize and validate URL
		$url = esc_url_raw( $input['url'] );

		if ( ! $url || ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
			return array(
				'success' => false,
				'message' => __( 'Invalid URL provided', 'mcp-adapter-initializer' ),
			);
		}

		// Check user permissions
		if ( ! current_user_can( 'upload_files' ) ) {
			return array(
				'success' => false,
				'message' => __( 'You do not have permission to upload files', 'mcp-adapter-initializer' ),
			);
		}

		// Get post ID if provided, otherwise null
		$post_id = isset( $input['post_id'] ) ? absint( $input['post_id'] ) : null;

		// Validate post ID only if one was provided
		if ( $post_id && ! get_post( $post_id ) ) {
			return array(
				'success' => false,
				'message' => sprintf( __( 'Post with ID %d does not exist', 'mcp-adapter-initializer' ), $post_id ),
			);
		}

		// Get title/description
		$title = isset( $input['title'] ) ? sanitize_text_field( $input['title'] ) : null;

		// Include media handling functions
		if ( ! function_exists( 'media_sideload_image' ) ) {
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
		}

		// Upload the image and get the attachment ID
		$result = media_sideload_image( $url, $post_id, $title, 'id' );

		if ( is_wp_error( $result ) ) {
			return array(
				'success' => false,
				'message' => sprintf( __( 'Failed to upload image: %s', 'mcp-adapter-initializer' ), $result->get_error_message() ),
			);
		}

		// Get the attachment URL
		$attachment_url = wp_get_attachment_url( $result );

		return array(
			'success'       => true,
			'attachment_id' => $result,
			'url'           => $attachment_url,
			'message'       => __( 'Image uploaded successfully', 'mcp-adapter-initializer' ),
		);
	}

	/**
	 * Prevent cloning
	 */
	private function __clone() {}

	/**
	 * Prevent unserialization
	 */
	public function __wakeup() {
		throw new \Exception( 'Cannot unserialize singleton' );
	}
}

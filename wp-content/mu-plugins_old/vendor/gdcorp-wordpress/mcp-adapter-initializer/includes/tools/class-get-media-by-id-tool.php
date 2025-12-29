<?php
/**
 * Get Media By ID Tool Class
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
 * Get Media By ID Tool
 *
 * Handles the registration and execution of the get media by ID ability
 * for the MCP adapter.
 */
class Get_Media_By_Id_Tool extends Base_Tool {

	/**
	 * Tool identifier
	 *
	 * @var string
	 */
	const TOOL_ID = 'gd-mcp/get-media-by-id';

	/**
	 * Tool instance
	 *
	 * @var Get_Media_By_Id_Tool|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance
	 *
	 * @return Get_Media_By_Id_Tool
	 */
	public static function get_instance(): Get_Media_By_Id_Tool {
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
	 * Register the get media by ID ability
	 *
	 * @return void
	 */
	public function register(): void {
		wp_register_ability(
			self::TOOL_ID,
			array(
				'label'               => __( 'Get Media By ID', 'mcp-adapter-initializer' ),
				'description'         => __( 'Retrieves a WordPress media attachment by its ID', 'mcp-adapter-initializer' ),
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
				'media_id'     => array(
					'type'        => 'integer',
					'description' => __( 'The ID of the media attachment to retrieve', 'mcp-adapter-initializer' ),
					'minimum'     => 1,
				),
				'include_meta' => array(
					'type'        => 'boolean',
					'description' => __( 'Whether to include attachment meta data', 'mcp-adapter-initializer' ),
					'default'     => true,
				),
			),
			'required'   => array( 'media_id' ),
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
				'id'            => array(
					'type'        => 'integer',
					'description' => 'The media attachment ID',
				),
				'title'         => array(
					'type'        => 'string',
					'description' => 'The media title',
				),
				'description'   => array(
					'type'        => 'string',
					'description' => 'The media description',
				),
				'caption'       => array(
					'type'        => 'string',
					'description' => 'The media caption',
				),
				'alt_text'      => array(
					'type'        => 'string',
					'description' => 'The media alt text',
				),
				'status'        => array(
					'type'        => 'string',
					'description' => 'The attachment status',
				),
				'author_id'     => array(
					'type'        => 'integer',
					'description' => 'The media author ID',
				),
				'date_created'  => array(
					'type'        => 'string',
					'description' => 'The media creation date',
				),
				'date_modified' => array(
					'type'        => 'string',
					'description' => 'The media modification date',
				),
				'slug'          => array(
					'type'        => 'string',
					'description' => 'The media slug',
				),
				'url'           => array(
					'type'        => 'string',
					'description' => 'The media file URL',
				),
				'mime_type'     => array(
					'type'        => 'string',
					'description' => 'The media MIME type',
				),
				'file_size'     => array(
					'type'        => 'integer',
					'description' => 'The file size in bytes',
				),
				'dimensions'    => array(
					'type'        => 'object',
					'properties'  => array(
						'width'  => array(
							'type'        => 'integer',
							'description' => 'Image width in pixels',
						),
						'height' => array(
							'type'        => 'integer',
							'description' => 'Image height in pixels',
						),
					),
					'description' => 'Image dimensions (for images)',
				),
				'meta'          => array(
					'type'        => 'object',
					'description' => 'Attachment meta data (if requested)',
				),
			),
		);
	}

	/**
	 * Execute the get media by ID tool
	 *
	 * @param array $input Input parameters
	 * @return array Media information or error
	 */
	public function execute( array $input ): array {
		$media_id = ! empty( $input['media_id'] ) ? (int) $input['media_id'] : 0;

		if ( empty( $media_id ) ) {
			return array(
				'success' => false,
				'message' => __( 'Media ID is required', 'mcp-adapter-initializer' ),
			);
		}

		$post = get_post( $media_id );

		// Check if post exists and is an attachment
		if ( ! $post ) {
			return array(
				'success' => false,
				/* translators: %d: Media ID */
				'message' => sprintf( __( 'Media with ID %d not found', 'mcp-adapter-initializer' ), $media_id ),
			);
		}

		if ( 'attachment' !== $post->post_type ) {
			return array(
				'success' => false,
				/* translators: %d: Post ID */
				'message' => sprintf( __( 'Post with ID %d is not a media attachment', 'mcp-adapter-initializer' ), $media_id ),
			);
		}

		// Get attachment metadata
		$attachment_metadata = wp_get_attachment_metadata( $media_id );
		$file_path           = get_attached_file( $media_id );
		$file_size           = $file_path && file_exists( $file_path ) ? filesize( $file_path ) : 0;

		// Prepare result
		$result = array(
			'id'            => $post->ID,
			'title'         => $post->post_title,
			'description'   => $post->post_content,
			'caption'       => $post->post_excerpt,
			'alt_text'      => get_post_meta( $media_id, '_wp_attachment_image_alt', true ),
			'status'        => $post->post_status,
			'author_id'     => (int) $post->post_author,
			'date_created'  => $post->post_date,
			'date_modified' => $post->post_modified,
			'slug'          => $post->post_name,
			'url'           => wp_get_attachment_url( $media_id ),
			'mime_type'     => $post->post_mime_type,
			'file_size'     => $file_size,
			'dimensions'    => array(),
			'meta'          => array(), // Always include meta field, even if empty
		);

		// Add dimensions for images
		if ( isset( $attachment_metadata['width'] ) && isset( $attachment_metadata['height'] ) ) {
			$result['dimensions'] = array(
				'width'  => (int) $attachment_metadata['width'],
				'height' => (int) $attachment_metadata['height'],
			);
		}

		// Add meta data if requested
		if ( ! empty( $input['include_meta'] ) ) {
			$result['meta'] = get_post_meta( $media_id );
		}

		return $result;
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

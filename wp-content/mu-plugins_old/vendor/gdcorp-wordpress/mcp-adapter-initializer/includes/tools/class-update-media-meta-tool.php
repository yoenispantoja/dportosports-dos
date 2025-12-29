<?php
/**
 * Update Media Meta Tool Class
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
 * Update Media Meta Tool
 *
 * Handles the registration and execution of the update media meta ability
 * for the MCP adapter.
 */
class Update_Media_Meta_Tool extends Base_Tool {

	/**
	 * Tool identifier
	 *
	 * @var string
	 */
	const TOOL_ID = 'gd-mcp/update-media-meta';

	/**
	 * Tool instance
	 *
	 * @var Update_Media_Meta_Tool|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance
	 *
	 * @return Update_Media_Meta_Tool
	 */
	public static function get_instance(): Update_Media_Meta_Tool {
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
	 * Register the update media meta ability
	 *
	 * @return void
	 */
	public function register(): void {
		wp_register_ability(
			self::TOOL_ID,
			array(
				'label'               => __( 'Update Media Meta', 'mcp-adapter-initializer' ),
				'description'         => __( 'Updates the title, description, alt text, and caption of a WordPress media attachment', 'mcp-adapter-initializer' ),
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
				'media_id'    => array(
					'type'        => 'integer',
					'description' => __( 'The ID of the media attachment to update', 'mcp-adapter-initializer' ),
					'minimum'     => 1,
				),
				'title'       => array(
					'type'        => 'string',
					'description' => __( 'The new title for the media attachment', 'mcp-adapter-initializer' ),
				),
				'description' => array(
					'type'        => 'string',
					'description' => __( 'The new description for the media attachment', 'mcp-adapter-initializer' ),
				),
				'alt_text'    => array(
					'type'        => 'string',
					'description' => __( 'The new alt text for the media attachment', 'mcp-adapter-initializer' ),
				),
				'caption'     => array(
					'type'        => 'string',
					'description' => __( 'The new caption for the media attachment', 'mcp-adapter-initializer' ),
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
				'success'       => array(
					'type'        => 'boolean',
					'description' => 'Whether the update was successful',
				),
				'message'       => array(
					'type'        => 'string',
					'description' => 'Success or error message',
				),
				'updated_media' => array(
					'type'        => 'object',
					'properties'  => array(
						'id'          => array(
							'type'        => 'integer',
							'description' => 'The media attachment ID',
						),
						'title'       => array(
							'type'        => 'string',
							'description' => 'The updated media title',
						),
						'description' => array(
							'type'        => 'string',
							'description' => 'The updated media description',
						),
						'alt_text'    => array(
							'type'        => 'string',
							'description' => 'The updated media alt text',
						),
						'caption'     => array(
							'type'        => 'string',
							'description' => 'The updated media caption',
						),
					),
					'description' => 'The updated media information (only present on success)',
				),
			),
		);
	}

	/**
	 * Execute the update media meta tool
	 *
	 * @param array $input Input parameters
	 * @return array Update result or error
	 */
	public function execute( array $input ): array {
		$media_id = ! empty( $input['media_id'] ) ? (int) $input['media_id'] : 0;

		if ( empty( $media_id ) ) {
			return array(
				'success' => false,
				'message' => __( 'Media ID is required', 'mcp-adapter-initializer' ),
			);
		}

		// Check if at least one field to update is provided
		$updatable_fields = array( 'title', 'description', 'alt_text', 'caption' );
		$has_update_field = false;

		foreach ( $updatable_fields as $field ) {
			if ( isset( $input[ $field ] ) ) {
				$has_update_field = true;
				break;
			}
		}

		if ( ! $has_update_field ) {
			return array(
				'success' => false,
				'message' => __( 'At least one field (title, description, alt_text, or caption) is required to update', 'mcp-adapter-initializer' ),
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

		// Prepare update data
		$update_data = array( 'ID' => $media_id );

		$updated_fields = array();

		// Update title (post_title)
		if ( isset( $input['title'] ) ) {
			$update_data['post_title'] = sanitize_text_field( $input['title'] );

			$updated_fields[] = 'title';
		}

		// Update description (post_content)
		if ( isset( $input['description'] ) ) {
			$update_data['post_content'] = wp_kses_post( $input['description'] );

			$updated_fields[] = 'description';
		}

		// Update caption (post_excerpt)
		if ( isset( $input['caption'] ) ) {
			$update_data['post_excerpt'] = wp_kses_post( $input['caption'] );

			$updated_fields[] = 'caption';
		}

		// Update the post if there are post fields to update
		if ( count( $update_data ) > 1 ) { // More than just the ID
			$result = wp_update_post( $update_data, true );
			if ( is_wp_error( $result ) ) {
				return array(
					'success' => false,
					'message' => sprintf( __( 'Failed to update media: %s', 'mcp-adapter-initializer' ), $result->get_error_message() ),
				);
			}
		}

		// Update alt text (post meta)
		if ( isset( $input['alt_text'] ) ) {
			$alt_text_result = update_post_meta( $media_id, '_wp_attachment_image_alt', sanitize_text_field( $input['alt_text'] ) );

			if ( false === $alt_text_result ) {
				return array(
					'success' => false,
					'message' => __( 'Failed to update alt text', 'mcp-adapter-initializer' ),
				);
			}

			$updated_fields[] = 'alt_text';
		}

		// Get the updated post data
		$updated_post = get_post( $media_id );

		return array(
			'success'       => true,
			'message'       => sprintf(
				/* translators: %1$s: comma-separated list of updated fields, %2$d: Media ID */
				__( 'Successfully updated %1$s for media ID %2$d', 'mcp-adapter-initializer' ),
				implode( ', ', $updated_fields ),
				$media_id
			),
			'updated_media' => array(
				'id'          => $updated_post->ID,
				'title'       => $updated_post->post_title,
				'description' => $updated_post->post_content,
				'alt_text'    => get_post_meta( $media_id, '_wp_attachment_image_alt', true ),
				'caption'     => $updated_post->post_excerpt,
			),
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

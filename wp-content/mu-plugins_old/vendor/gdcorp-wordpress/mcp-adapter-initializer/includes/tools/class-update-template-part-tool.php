<?php
/**
 * Update Template Part Tool Class
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
 * Update Template Part Tool
 *
 * Handles the registration and execution of the update template part ability
 * for the MCP adapter.
 */
class Update_Template_Part_Tool extends Base_Tool {

	/**
	 * Tool identifier
	 *
	 * @var string
	 */
	const TOOL_ID = 'gd-mcp/update-template-part';

	/**
	 * Tool instance
	 *
	 * @var Update_Template_Part_Tool|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance
	 *
	 * @return Update_Template_Part_Tool
	 */
	public static function get_instance(): Update_Template_Part_Tool {
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
	 * Register the update template part ability
	 *
	 * @return void
	 */
	public function register(): void {
		wp_register_ability(
			self::TOOL_ID,
			array(
				'label'               => __( 'Update Template Part', 'mcp-adapter-initializer' ),
				'description'         => __( 'Updates a template part in the database with new HTML content. Creates the template part if it does not exist.', 'mcp-adapter-initializer' ),
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
				'theme'     => array(
					'type'        => 'string',
					'description' => __( 'The theme slug where the template part belongs', 'mcp-adapter-initializer' ),
				),
				'id'        => array(
					'type'        => 'string',
					'description' => __( 'The template part ID (optional if part_name is provided)', 'mcp-adapter-initializer' ),
				),
				'part_name' => array(
					'type'        => 'string',
					'description' => __( 'The template part name/slug (optional if id is provided, e.g., "header", "footer")', 'mcp-adapter-initializer' ),
				),
				'html'      => array(
					'type'        => 'string',
					'description' => __( 'The new HTML content for the template part', 'mcp-adapter-initializer' ),
				),
			),
			'required'   => array( 'theme', 'html' ),
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
				'success' => array(
					'type'        => 'boolean',
					'description' => 'Whether the update was successful',
				),
				'data'    => array(
					'type'        => 'object',
					'description' => 'Template part data',
					'properties'  => array(
						'id'      => array(
							'type'        => 'string',
							'description' => 'The template part ID',
						),
						'slug'    => array(
							'type'        => 'string',
							'description' => 'The template part slug',
						),
						'theme'   => array(
							'type'        => 'string',
							'description' => 'The theme slug',
						),
						'content' => array(
							'type'        => 'string',
							'description' => 'The updated HTML content',
						),
					),
				),
				'message' => array(
					'type'        => 'string',
					'description' => 'Success or error message',
				),
			),
		);
	}

	/**
	 * Execute the tool
	 *
	 * Uses WordPress core REST API controller for template part operations.
	 * Permissions are handled automatically via Base_Tool::execute_with_admin().
	 *
	 * @param array $input Tool input parameters.
	 * @return array
	 */
	public function execute( array $input ): array {
		try {
			// Validate required parameters.
			$theme        = isset( $input['theme'] ) ? sanitize_text_field( $input['theme'] ) : '';
			$template_id  = isset( $input['id'] ) ? sanitize_text_field( $input['id'] ) : '';
			$part_name    = isset( $input['part_name'] ) ? sanitize_text_field( $input['part_name'] ) : '';
			$html_content = isset( $input['html'] ) ? $input['html'] : '';

			if ( empty( $theme ) ) {
				return array(
					'success' => false,
					'message' => __( 'Theme parameter is required', 'mcp-adapter-initializer' ),
				);
			}

			if ( empty( $template_id ) && empty( $part_name ) ) {
				return array(
					'success' => false,
					'message' => __( 'Either template part ID or part_name is required', 'mcp-adapter-initializer' ),
				);
			}

			if ( empty( $html_content ) ) {
				return array(
					'success' => false,
					'message' => __( 'HTML content is required', 'mcp-adapter-initializer' ),
				);
			}

			if ( ! empty( $template_id ) ) {
				$wp_template_id = (string) $template_id;
				// Extract slug from template ID.
				$parts = explode( '//', $wp_template_id );
				$slug  = end( $parts );
			} else {
				// Build template ID in WordPress format: theme//slug.
				$wp_template_id = $theme . '//' . $part_name;
				$slug           = $part_name;
			}

			/*
			 * Use WordPress core function to check if template exists.
			 * This handles both database and file system lookups automatically.
			 */
			$existing_template = get_block_template( $wp_template_id, 'wp_template_part' );

			// Prepare request object for WordPress REST API.
			$request = new \WP_REST_Request( 'POST', '/wp/v2/template-parts' );
			$request->set_param( 'id', $wp_template_id );
			$request->set_param( 'theme', $theme );
			$request->set_param( 'slug', $slug );
			$request->set_param( 'content', $html_content );

			/*
			 * Use WordPress REST controller for create/update operations.
			 * Permission checks pass automatically because we're running as admin
			 * via Base_Tool::execute_with_admin().
			 */
			$controller = new \WP_REST_Templates_Controller( 'wp_template_part' );

			if ( $existing_template ) {
				// Update existing template using WordPress core.
				$response = $controller->update_item( $request );
			} else {
				// Create new template using WordPress core.
				$response = $controller->create_item( $request );
			}

			// Handle WordPress REST API errors.
			if ( is_wp_error( $response ) ) {
				return array(
					'success' => false,
					'message' => $response->get_error_message(),
				);
			}

			$data = $response->get_data();

			/*
			 * Sync to theme file if it exists.
			 * This maintains current behavior: only updates existing files, doesn't create new ones.
			 * Useful for theme development workflows and version control.
			 */
			$this->sync_to_theme_file_if_exists( $theme, $slug, $html_content );

			return array(
				'success' => true,
				'data'    => array(
					'id'      => $data['id'],
					'slug'    => $data['slug'],
					'theme'   => $data['theme'],
					'content' => $data['content']['raw'],
				),
				'message' => __( 'Template part updated successfully', 'mcp-adapter-initializer' ),
			);

		} catch ( \Exception $e ) {
			return array(
				'success' => false,
				'message' => sprintf(
					__( 'Error updating template part: %s', 'mcp-adapter-initializer' ),
					$e->getMessage()
				),
			);
		}
	}

	/**
	 * Sync template part content to theme file if it exists
	 *
	 * This maintains the current behavior: only updates existing files, doesn't create new ones.
	 * Useful for theme development workflows and version control integration.
	 *
	 * WordPress standard behavior is database-only updates. This additional file syncing
	 * is optional and only occurs when the theme file already exists and is writable.
	 *
	 * @param string $theme Theme slug.
	 * @param string $part_name Template part slug.
	 * @param string $html_content HTML content to write.
	 * @return bool True on success, false on failure or if file doesn't exist.
	 */
	private function sync_to_theme_file_if_exists( $theme, $part_name, $html_content ) {
		$theme_root = get_theme_root();
		$file_path  = $theme_root . '/' . $theme . '/parts/' . $part_name . '.html';

		// Only write if file already exists and is writable.
		if ( ! file_exists( $file_path ) || ! is_writable( $file_path ) ) {
			return false;
		}

		// Write the HTML content to the file.
		$result = file_put_contents( $file_path, $html_content );

		if ( false === $result ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log(
				sprintf(
					'[gd-mcp-update-template-part] Failed to sync to theme file: %s',
					$file_path
				)
			);
			return false;
		}

		return true;
	}
}

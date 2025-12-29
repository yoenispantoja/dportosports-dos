<?php
/**
 * Get Block Types Tool Class
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
 * Get Block Types Tool
 *
 * Handles the registration and execution of the get block types ability
 * for the MCP adapter.
 */
class Get_Block_Types_Tool extends Base_Tool {

	/**
	 * Tool identifier
	 *
	 * @var string
	 */
	const TOOL_ID = 'gd-mcp/get-block-types';

	/**
	 * Tool instance
	 *
	 * @var Get_Block_Types_Tool|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance
	 *
	 * @return Get_Block_Types_Tool
	 */
	public static function get_instance(): Get_Block_Types_Tool {
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
	 * Register the get block types ability
	 *
	 * @return void
	 */
	public function register(): void {
		wp_register_ability(
			self::TOOL_ID,
			array(
				'label'               => __( 'Get Block Types', 'mcp-adapter-initializer' ),
				'description'         => __( 'Retrieves all registered block types on the site', 'mcp-adapter-initializer' ),
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
			'properties' => array(),
			'required'   => array(),
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
				'success'     => array(
					'type'        => 'boolean',
					'description' => 'Whether the request was successful',
				),
				'block_types' => array(
					'type'        => 'array',
					'description' => 'Array of registered block types',
					'items'       => array(
						'type'       => 'object',
						'properties' => array(
							'name'        => array(
								'type'        => 'string',
								'description' => 'The block type name',
							),
							'title'       => array(
								'type'        => 'string',
								'description' => 'The block type title',
							),
							'description' => array(
								'type'        => 'string',
								'description' => 'The block type description',
							),
							'category'    => array(
								'type'        => 'string',
								'description' => 'The block category',
							),
							'icon'        => array(
								'description' => 'The block icon (string or object)',
							),
							'keywords'    => array(
								'type'        => 'array',
								'description' => 'Array of block keywords',
								'items'       => array(
									'type' => 'string',
								),
							),
							'supports'    => array(
								'type'        => 'object',
								'description' => 'Block support settings',
							),
						),
					),
				),
				'message'     => array(
					'type'        => 'string',
					'description' => 'Success or error message',
				),
			),
		);
	}

	/**
	 * Execute the get block types tool
	 *
	 * @param array $input Input parameters (none required)
	 * @return array Block types result or error
	 */
	public function execute( array $input ): array {
		// Check if WP_Block_Type_Registry is available
		if ( ! class_exists( 'WP_Block_Type_Registry' ) ) {
			return array(
				'success' => false,
				'message' => __( 'Block type registry is not available', 'mcp-adapter-initializer' ),
			);
		}

		// Get the block type registry
		$block_registry    = ( new \WP_Block_Type_Registry() )::get_instance();
		$registered_blocks = $block_registry->get_all_registered();

		if ( ! is_array( $registered_blocks ) ) {
			return array(
				'success' => false,
				'message' => __( 'Unable to retrieve registered block types', 'mcp-adapter-initializer' ),
			);
		}

		$block_types = array();

		foreach ( $registered_blocks as $block_name => $block_type ) {
			$block_data = array(
				'name'        => $block_name,
				'title'       => isset( $block_type->title ) ? $block_type->title : '',
				'description' => isset( $block_type->description ) ? $block_type->description : '',
				'category'    => isset( $block_type->category ) ? $block_type->category : '',
				'icon'        => isset( $block_type->icon ) ? $block_type->icon : '',
				'keywords'    => isset( $block_type->keywords ) ? $block_type->keywords : array(),
				'supports'    => isset( $block_type->supports ) ? $block_type->supports : array(),
			);

			$block_types[] = $block_data;
		}

		return array(
			'success'     => true,
			'block_types' => $block_types,
			// translators: %d is the number of block types found
			'message'     => sprintf( __( 'Retrieved %d registered block types', 'mcp-adapter-initializer' ), count( $block_types ) ),
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

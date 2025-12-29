<?php
declare( strict_types=1 );

namespace GoDaddy\WordPress\Plugins\SiteDesigner\WooCommerce;

/**
 * WooCommerce Setup Handler
 *
 * Orchestrates automatic WooCommerce configuration and setup wizard skipping
 *
 * @package wp-site-designer-mu-plugins
 */
class Setup {

	/**
	 * Singleton instance
	 *
	 * @var Setup|null
	 */
	protected static ?Setup $instance = null;

	/**
	 * Installation flag option name
	 */
	private const INSTALLATION_FLAG_OPTION = 'gdmu_site_designer_woo_configured';

	/**
	 * Installation version option name
	 */
	private const INSTALLATION_VERSION_OPTION = 'gdmu_site_designer_woo_version';

	/**
	 * WooCommerce pages setup handler
	 *
	 * @var SetupWooPages
	 */
	private SetupWooPages $woo_pages;

	/**
	 * WooCommerce options setup handler
	 *
	 * @var SetupWooOptions
	 */
	private SetupWooOptions $woo_options;

	/**
	 * GoDaddy options setup handler
	 *
	 * @var SetupGDOptions
	 */
	private SetupGDOptions $gd_options;

	/**
	 * Tracks if WooCommerce is active
	 *
	 * @var bool
	 */
	private bool $is_woocommerce_active = false;

	/**
	 * Tracks if WooCommerce is configured
	 *
	 * @var bool
	 */
	private bool $is_woocommerce_configured = false;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->woo_pages   = new SetupWooPages();
		$this->woo_options = new SetupWooOptions();
		$this->gd_options  = new SetupGDOptions();
	}

	public static function init(): self {
		if ( is_null( self::$instance ) ) {
			$instance = new self();
			// setup hooks
			$instance->setupHooks();
			self::$instance = $instance;
		}

		return self::$instance;
	}

	/**
	 * Setup WordPress hooks
	 *
	 * @return void
	 */
	public function setupHooks(): void {
		// Always run these checks early.
		add_action( 'woocommerce_init', array( $this, 'checkIsWooCommerceActive' ), 0 );
		add_action( 'woocommerce_init', array( $this, 'checkIsWooCommerceConfigured' ), 0 );
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'checkIsWooCommerceActive' ), 0 );
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'checkIsWooCommerceConfigured' ), 0 );

		// Prevent WooCommerce from creating pages on activation.
		add_filter( 'woocommerce_create_pages', array( $this, 'preventWooCommercePageCreation' ) );
		// Run after plugins are loaded to check if WooCommerce needs configuration.
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'maybeConfigureWooCommerce' ), 0 );
		// Configure GoDaddy-specific WooCommerce options.
		add_action( 'woocommerce_init', array( $this, 'configureGdOptions' ) );
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'configureGdOptions' ) );
		// Run page creation on init hook to ensure rewrite rules are initialized.
		add_action( 'woocommerce_init', array( $this, 'maybeCreateWooCommercePages' ) );
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'maybeCreateWooCommercePages' ) );
		// Disable cart and account links in header.
		add_action( 'woocommerce_init', array( $this, 'disableHeaderCartAccount' ) );
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'disableHeaderCartAccount' ) );
		// Skip setup wizard redirect.
		add_action( 'activate_woocommerce/woocommerce.php', array( $this, 'skipSetupWizardRedirect' ) );
		add_filter( 'woocommerce_prevent_admin_access', array( $this, 'preventAdminAccess' ), 10, 2 );
		add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
	}

	/**
	 * Check if WooCommerce is installed and active
	 *
	 * @return void
	 */
	public function checkIsWooCommerceActive(): void {
		$this->is_woocommerce_active = function_exists( 'WC' );
	}

	public function isWooCommerceActive(): bool {
		return $this->is_woocommerce_active;
	}

	/**
	 * Check if WooCommerce is configured
	 *
	 * @return void
	 */
	public function checkIsWooCommerceConfigured(): void {
		$is_installed      = get_option( self::INSTALLATION_FLAG_OPTION, false );
		$installed_version = get_option( self::INSTALLATION_VERSION_OPTION, '' );
		$current_version   = defined( 'WC_VERSION' ) ? WC_VERSION : '';

		// If installation flag is set and version matches, setup is complete.
		if ( $is_installed && $installed_version === $current_version && ! empty( $current_version ) ) {
			$this->is_woocommerce_configured = true;

			return;
		}

		// If version has changed, we need to re-run setup for new options.
		if ( $is_installed && $installed_version !== $current_version && ! empty( $current_version ) ) {
			$this->is_woocommerce_configured = false;

			return;
		}

		$woo_setup_complete = $this->woo_options->isSetupComplete();
		$woo_pages_created  = $this->woo_pages->checkRequiredPagesExist();

		$this->is_woocommerce_configured = $woo_pages_created && $woo_setup_complete;
	}

	/**
	 * Check if WooCommerce is configured
	 *
	 * @return bool True if WooCommerce is configured, false otherwise.
	 */
	public function isWooCommerceConfigured(): bool {
		return $this->is_woocommerce_configured;
	}

	/**
	 * Maybe configure GoDaddy-specific WooCommerce options
	 *
	 * @return void
	 */
	public function configureGdOptions(): void {
		$this->gd_options->configureOptions();
	}

	/**
	 * Maybe configure WooCommerce if it's installed but not configured
	 *
	 * @return void
	 */
	public function maybeConfigureWooCommerce(): void {
		// Skip if already configured or WooCommerce is not active.
		if ( $this->isWooCommerceConfigured() ) {
			return;
		}

		// Configure options immediately (these don't require rewrite rules).
		$this->woo_options->configureOptions();
		$this->woo_options->markSetupCompleted();

		// Mark installation as complete after configuration is done.
		// This will also check if pages exist and mark complete if everything is ready.
		$this->maybeMarkInstallationComplete();
	}

	/**
	 * Maybe create WooCommerce pages if they don't exist
	 *
	 * Runs on init hook to ensure rewrite rules are initialized before wp_insert_post.
	 *
	 * @return void
	 */
	public function maybeCreateWooCommercePages(): void {
		// Skip if already configured or WooCommerce is not active.
		if ( $this->isWooCommerceConfigured() ) {
			return;
		}

		// Create required pages if they don't exist.
		// This runs on init hook to ensure rewrite rules are initialized.
		$this->woo_pages->createRequiredPages();

		// Mark installation as complete after page creation is done.
		$this->maybeMarkInstallationComplete();
	}

	/**
	 * Maybe mark installation as complete if all configuration is done
	 *
	 * Checks if both options and pages are configured before marking complete.
	 *
	 * @return void
	 */
	public function maybeMarkInstallationComplete(): void {
		// Rerun check here to ensure latest status.
		$this->checkIsWooCommerceConfigured();

		if ( $this->isWooCommerceConfigured() ) {
			// Only mark complete if WooCommerce is configured.
			$this->markInstallationComplete();
		}
	}


	/**
	 * Mark installation as complete and store WooCommerce version
	 *
	 * @return void
	 */
	public function markInstallationComplete(): void {
		update_option( self::INSTALLATION_FLAG_OPTION, true );

		// Store current WooCommerce version.
		if ( defined( 'WC_VERSION' ) ) {
			update_option( self::INSTALLATION_VERSION_OPTION, WC_VERSION );
		}
	}

	/**
	 * Skip setup wizard redirect
	 *
	 * @return void
	 */
	public function skipSetupWizardRedirect(): void {
		$this->woo_options->skipSetupWizardRedirect();
	}

	/**
	 * Prevent admin access restrictions during setup
	 *
	 * @param bool $prevent Whether to prevent admin access.
	 * @param string|null $capability The capability being checked (optional).
	 *
	 * @return bool
	 */
	public function preventAdminAccess( bool $prevent, ?string $capability = null ): bool {
		// Allow admin access even if WooCommerce setup is incomplete.
		if ( ! $this->isWooCommerceConfigured() ) {
			return false;
		}

		return $prevent;
	}

	/**
	 * Prevent WooCommerce from creating pages on activation
	 *
	 * Returns an empty array to prevent WooCommerce's default page creation behavior.
	 *
	 * @param array<string, array{title: string, content: string, option: string}> $pages Array of pages to create.
	 *
	 * @return array<string, array{title: string, content: string, option: string}> Empty array to prevent page creation.
	 */
	public function preventWooCommercePageCreation( array $pages ): array {
		// Return empty array to prevent WooCommerce from creating pages on activation.
		return array();
	}

	/**
	 * Disable cart and account links in header template
	 *
	 * Prevents WooCommerce from adding cart and account links to header during installation.
	 * Works for FSE (Full Site Editing) enabled themes.
	 *
	 * This disables WooCommerce hooked blocks (Mini Cart and Customer Account blocks)
	 * that are automatically inserted into header templates.
	 *
	 * @return void
	 */
	public function disableHeaderCartAccount(): void {
		// Disable WooCommerce hooked blocks by setting the option to 'no'.
		// This prevents Mini Cart and Customer Account blocks from being auto-inserted into headers.
		update_option( 'woocommerce_hooked_blocks_version', 'no' );
	}
}

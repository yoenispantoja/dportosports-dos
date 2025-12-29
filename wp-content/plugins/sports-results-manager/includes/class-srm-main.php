<?php
/**
 * Clase principal del plugin
 */

class SRM_Main {
    
    protected $loader;
    protected $plugin_name;
    protected $version;
    
    public function __construct() {
        $this->version = SRM_VERSION;
        $this->plugin_name = 'sports-results-manager';
        
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    
    /**
     * Cargar las dependencias necesarias
     */
    private function load_dependencies() {
        require_once SRM_PLUGIN_DIR . 'includes/class-srm-loader.php';
        require_once SRM_PLUGIN_DIR . 'includes/class-srm-database.php';
        require_once SRM_PLUGIN_DIR . 'admin/class-srm-admin.php';
        require_once SRM_PLUGIN_DIR . 'public/class-srm-public.php';
        
        $this->loader = new SRM_Loader();
    }
    
    /**
     * Registrar hooks del área de administración
     */
    private function define_admin_hooks() {
        $plugin_admin = new SRM_Admin($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('wp_ajax_srm_save_result', $plugin_admin, 'ajax_save_result');
        $this->loader->add_action('wp_ajax_srm_delete_result', $plugin_admin, 'ajax_delete_result');
        $this->loader->add_action('wp_ajax_srm_get_result', $plugin_admin, 'ajax_get_result');
    }
    
    /**
     * Registrar hooks del área pública
     */
    private function define_public_hooks() {
        $plugin_public = new SRM_Public($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_shortcode('sports_results', $plugin_public, 'sports_results_shortcode');
        $this->loader->add_action('wp_ajax_srm_filter_results', $plugin_public, 'ajax_filter_results');
        $this->loader->add_action('wp_ajax_nopriv_srm_filter_results', $plugin_public, 'ajax_filter_results');
    }
    
    /**
     * Ejecutar el loader
     */
    public function run() {
        $this->loader->run();
    }
    
    public function get_plugin_name() {
        return $this->plugin_name;
    }
    
    public function get_version() {
        return $this->version;
    }
}

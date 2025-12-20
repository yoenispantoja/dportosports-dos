<?php
/**
 * Plugin Name: Sports Results Manager
 * Plugin URI: https://dportosports.com
 * Description: Gestiona y visualiza resultados de eventos deportivos con shortcodes. Permite a los editores crear, editar y eliminar resultados de diferentes deportes (MLB, La Liga, NBA, Serie Nacional Cubana, etc).
 * Version: 1.0.0
 * Author: DPorto Sports
 * Author URI: https://dportosports.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: sports-results-manager
 * Domain Path: /languages
 */

// Si este archivo es llamado directamente, abortar.
if (!defined('WPINC')) {
    die;
}

/**
 * Versión actual del plugin
 */
define('SRM_VERSION', '1.0.0');
define('SRM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SRM_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Código que se ejecuta durante la activación del plugin
 */
function activate_sports_results_manager() {
    require_once SRM_PLUGIN_DIR . 'includes/class-srm-activator.php';
    SRM_Activator::activate();
}

/**
 * Código que se ejecuta durante la desactivación del plugin
 */
function deactivate_sports_results_manager() {
    require_once SRM_PLUGIN_DIR . 'includes/class-srm-deactivator.php';
    SRM_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_sports_results_manager');
register_deactivation_hook(__FILE__, 'deactivate_sports_results_manager');

/**
 * La clase principal del plugin
 */
require SRM_PLUGIN_DIR . 'includes/class-srm-main.php';

/**
 * Ejecutar el plugin
 */
function run_sports_results_manager() {
    $plugin = new SRM_Main();
    $plugin->run();
}
run_sports_results_manager();

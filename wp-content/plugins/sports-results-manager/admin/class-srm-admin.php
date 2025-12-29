<?php
/**
 * Admin functionality
 */

class SRM_Admin {
    private $plugin_name;
    private $version;
    private $db;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->db = new SRM_Database();
    }

    public function enqueue_styles($hook) {
        // Solo cargar en la página del plugin
        if ($hook != 'toplevel_page_' . $this->plugin_name) {
            return;
        }
        wp_enqueue_style($this->plugin_name, SRM_PLUGIN_URL . 'admin/css/srm-admin.css', array(), $this->version, 'all');
        wp_enqueue_style('wp-color-picker');
    }

    public function enqueue_scripts($hook) {
        // Solo cargar en la página del plugin
        if ($hook != 'toplevel_page_' . $this->plugin_name) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script($this->plugin_name, SRM_PLUGIN_URL . 'admin/js/srm-admin.js', array('jquery', 'wp-color-picker'), $this->version, false);
        wp_localize_script($this->plugin_name, 'srmAdmin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('srm_admin_nonce')
        ));
    }

    public function add_plugin_admin_menu() {
        add_menu_page(
            'Sports Results Manager',
            'Resultados Deportivos',
            'manage_sports_results',
            $this->plugin_name,
            array($this, 'display_plugin_admin_page'),
            'dashicons-awards',
            26
        );
    }

    public function display_plugin_admin_page() {
        include_once SRM_PLUGIN_DIR . 'admin/views/admin-display.php';
    }

    public function ajax_save_result() {
        check_ajax_referer('srm_admin_nonce', 'nonce');

        if (!current_user_can('manage_sports_results')) {
            wp_send_json_error('No autorizado');
            return;
        }

        // Validar campos requeridos
        if (empty($_POST['event_name']) || empty($_POST['event_date']) || empty($_POST['sport_type']) ||
            empty($_POST['team1_name']) || empty($_POST['team1_abbr']) ||
            empty($_POST['team2_name']) || empty($_POST['team2_abbr'])) {
            wp_send_json_error('Faltan campos requeridos');
            return;
        }

        $data = array(
            'event_name' => sanitize_text_field($_POST['event_name']),
            'event_date' => sanitize_text_field($_POST['event_date']),
            'sport_type' => sanitize_text_field($_POST['sport_type']),
            'team1_name' => sanitize_text_field($_POST['team1_name']),
            'team1_abbr' => sanitize_text_field($_POST['team1_abbr']),
            'team1_logo' => isset($_POST['team1_logo']) ? esc_url_raw($_POST['team1_logo']) : '',
            'team1_score' => isset($_POST['team1_score']) ? sanitize_text_field($_POST['team1_score']) : '',
            'team2_name' => sanitize_text_field($_POST['team2_name']),
            'team2_abbr' => sanitize_text_field($_POST['team2_abbr']),
            'team2_logo' => isset($_POST['team2_logo']) ? esc_url_raw($_POST['team2_logo']) : '',
            'team2_score' => isset($_POST['team2_score']) ? sanitize_text_field($_POST['team2_score']) : '',
            'status' => isset($_POST['status']) ? sanitize_text_field($_POST['status']) : 'scheduled',
            'post_url' => isset($_POST['post_url']) ? esc_url_raw($_POST['post_url']) : '',
            'display_order' => isset($_POST['display_order']) ? intval($_POST['display_order']) : 0
        );

        try {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $result = $this->db->update_result(intval($_POST['id']), $data);
                $message = 'Resultado actualizado correctamente';
            } else {
                $result = $this->db->insert_result($data);
                $message = 'Resultado creado correctamente';
            }

            if ($result !== false) {
                wp_send_json_success($message);
            } else {
                wp_send_json_error('Error al guardar el resultado en la base de datos');
            }
        } catch (Exception $e) {
            wp_send_json_error('Error: ' . $e->getMessage());
        }
    }

    public function ajax_delete_result() {
        check_ajax_referer('srm_admin_nonce', 'nonce');

        if (!current_user_can('manage_sports_results')) {
            wp_send_json_error('Unauthorized');
            return;
        }

        $id = intval($_POST['id']);
        $result = $this->db->delete_result($id);

        if ($result !== false) {
            wp_send_json_success('Resultado eliminado correctamente');
        } else {
            wp_send_json_error('Error al eliminar el resultado');
        }
    }

    public function ajax_get_result() {
        check_ajax_referer('srm_admin_nonce', 'nonce');

        if (!current_user_can('manage_sports_results')) {
            wp_send_json_error('Unauthorized');
            return;
        }

        $id = intval($_POST['id']);
        $result = $this->db->get_result($id);

        if ($result) {
            wp_send_json_success($result);
        } else {
            wp_send_json_error('Resultado no encontrado');
        }
    }
}

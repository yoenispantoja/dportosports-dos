<?php
/**
 * Activador del plugin
 * Se ejecuta durante la activación del plugin
 */

class SRM_Activator {

    /**
     * Crear tablas de base de datos y configuración inicial
     */
    public static function activate() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'sports_results';

        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            event_name varchar(100) NOT NULL,
            event_date datetime NOT NULL,
            sport_type varchar(50) NOT NULL,
            team1_name varchar(100) NOT NULL,
            team1_abbr varchar(10) NOT NULL,
            team1_logo varchar(500) DEFAULT '',
            team1_score varchar(20) DEFAULT '',
            team2_name varchar(100) NOT NULL,
            team2_abbr varchar(10) NOT NULL,
            team2_logo varchar(500) DEFAULT '',
            team2_score varchar(20) DEFAULT '',
            status varchar(20) DEFAULT 'scheduled',
            post_url varchar(500) DEFAULT '',
            display_order int(11) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY sport_type (sport_type),
            KEY event_date (event_date),
            KEY status (status)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // Agregar capacidades para los editores
        $role = get_role('editor');
        if ($role) {
            $role->add_cap('manage_sports_results');
        }

        // Agregar capacidades para administradores
        $admin_role = get_role('administrator');
        if ($admin_role) {
            $admin_role->add_cap('manage_sports_results');
        }

        // Guardar versión del plugin
        add_option('srm_version', SRM_VERSION);
    }
}

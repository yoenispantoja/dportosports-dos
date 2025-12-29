<?php
/**
 * Clase para operaciones de base de datos
 */

class SRM_Database {

    private $table_name;

    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'sports_results';
    }

    /**
     * Obtener todos los resultados
     */
    public function get_all_results($limit = null, $offset = 0, $sport_type = null) {
        global $wpdb;

        $sql = "SELECT * FROM {$this->table_name}";

        if ($sport_type && $sport_type !== 'all') {
            $sql .= $wpdb->prepare(" WHERE sport_type = %s", $sport_type);
        }

        $sql .= " ORDER BY event_date DESC, display_order ASC";

        if ($limit) {
            $sql .= $wpdb->prepare(" LIMIT %d OFFSET %d", $limit, $offset);
        }

        return $wpdb->get_results($sql);
    }

    /**
     * Obtener un resultado por ID
     */
    public function get_result($id) {
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM {$this->table_name} WHERE id = %d",
            $id
        ));
    }

    /**
     * Insertar un nuevo resultado
     */
    public function insert_result($data) {
        global $wpdb;

        $result = $wpdb->insert(
            $this->table_name,
            array(
                'event_name' => $data['event_name'],
                'event_date' => $data['event_date'],
                'sport_type' => $data['sport_type'],
                'team1_name' => $data['team1_name'],
                'team1_abbr' => $data['team1_abbr'],
                'team1_logo' => $data['team1_logo'],
                'team1_score' => $data['team1_score'],
                'team2_name' => $data['team2_name'],
                'team2_abbr' => $data['team2_abbr'],
                'team2_logo' => $data['team2_logo'],
                'team2_score' => $data['team2_score'],
                'status' => $data['status'],
                'post_url' => isset($data['post_url']) ? $data['post_url'] : '',
                'display_order' => $data['display_order']
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d')
        );

        if ($result === false) {
            error_log('SRM Insert Error: ' . $wpdb->last_error);
            return false;
        }

        return $wpdb->insert_id;
    }

    /**
     * Actualizar un resultado
     */
    public function update_result($id, $data) {
        global $wpdb;

        $result = $wpdb->update(
            $this->table_name,
            array(
                'event_name' => $data['event_name'],
                'event_date' => $data['event_date'],
                'sport_type' => $data['sport_type'],
                'team1_name' => $data['team1_name'],
                'team1_abbr' => $data['team1_abbr'],
                'team1_logo' => $data['team1_logo'],
                'team1_score' => $data['team1_score'],
                'team2_name' => $data['team2_name'],
                'team2_abbr' => $data['team2_abbr'],
                'team2_logo' => $data['team2_logo'],
                'team2_score' => $data['team2_score'],
                'status' => $data['status'],
                'post_url' => isset($data['post_url']) ? $data['post_url'] : '',
                'display_order' => $data['display_order']
            ),
            array('id' => $id),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'),
            array('%d')
        );

        if ($result === false) {
            error_log('SRM Update Error: ' . $wpdb->last_error);
        }

        return $result;
    }

    /**
     * Eliminar un resultado
     */
    public function delete_result($id) {
        global $wpdb;
        return $wpdb->delete($this->table_name, array('id' => $id), array('%d'));
    }

    /**
     * Obtener tipos de deportes únicos
     */
    public function get_sport_types() {
        global $wpdb;
        return $wpdb->get_col("SELECT DISTINCT sport_type FROM {$this->table_name} ORDER BY sport_type ASC");
    }

    /**
     * Obtener resultados por tipo de deporte
     */
    public function get_results_by_sport($sport_type) {
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM {$this->table_name} WHERE sport_type = %s ORDER BY event_date DESC, display_order ASC",
            $sport_type
        ));
    }
}

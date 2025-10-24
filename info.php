<?php
// Carga las constantes de WP
require_once('wp-config.php');

// Función para probar conexión y leer datos
function test_wp_table($table, $limit = 10) {
    global $wpdb;
    
    echo "<h2>Revisando tabla: $table</h2>";
    
    $results = $wpdb->get_results("SELECT * FROM $table LIMIT $limit");
    
    if ($results === false) {
        echo "<p style='color:red'>Error al leer la tabla $table: " . $wpdb->last_error . "</p>";
        return;
    }
    
    foreach ($results as $row) {
        foreach ($row as $col => $val) {
            // Intentamos unserialize para detectar valores corruptos
            if (is_string($val) && @unserialize($val) === false && $val !== 'b:0;') {
                echo "<p style='color:orange'>Valor posiblemente corrupto en columna <strong>$col</strong>: $val</p>";
            }
        }
    }

    echo "<p style='color:green'>Tabla $table revisada, sin errores fatales detectados en los primeros $limit registros.</p>";
}

echo "<h1>Chequeo rápido de WP</h1>";

require_once(ABSPATH . 'wp-includes/wp-db.php');
global $wpdb;

test_wp_table($wpdb->prefix . 'options');
test_wp_table($wpdb->prefix . 'usermeta');

echo "<p>Si hay valores en naranja, podrían estar rompiendo WordPress.</p>";

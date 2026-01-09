<?php
/**
 * Public functionality
 */

class SRM_Public {
    private $plugin_name;
    private $version;
    private $db;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->db = new SRM_Database();
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, SRM_PLUGIN_URL . 'public/css/srm-public.css', array(), $this->version . '.' . time(), 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, SRM_PLUGIN_URL . 'public/js/srm-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'srmPublic', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('srm_public_nonce')
        ));
    }

    /**
     * Shortcode para mostrar resultados deportivos
     * Uso: [sports_results] o [sports_results sport="MLB"]
     */
    public function sports_results_shortcode($atts) {
        $atts = shortcode_atts(array(
            'sport' => 'all',
            'limit' => 10
        ), $atts);

        $sport_type = sanitize_text_field($atts['sport']);
        $limit = intval($atts['limit']);

        // Obtener logo del sitio como fallback
        $site_logo_url = '';
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo_data = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($logo_data) {
                $site_logo_url = $logo_data[0];
            }
        }
        // Si no hay logo personalizado, usar el icono del sitio
        if (empty($site_logo_url)) {
            $site_logo_url = get_site_icon_url(512);
        }
        // Fallback final
        if (empty($site_logo_url)) {
            $site_logo_url = 'https://dportosports.com/wp-content/uploads/2025/10/cropped-android-chrome-512x512-1-32x32.png';
        }

        // Obtener tipos de deportes únicos
        $sport_types = $this->db->get_sport_types();

        // Obtener resultados
        if ($sport_type === 'all') {
            $results = $this->db->get_all_results($limit);
        } else {
            $results = $this->db->get_results_by_sport($sport_type);
            if (count($results) > $limit) {
                $results = array_slice($results, 0, $limit);
            }
        }

        // Generar HTML
        ob_start();
        ?>
        <div class="srm-sports-results-container">
            <div class="srm-content-layout">
                <div class="srm-sport-selector">
                    <select class="srm-sport-dropdown" id="srm-sport-filter">
                        <option value="all" <?php echo $sport_type === 'all' ? 'selected' : ''; ?>>Todos los deportes</option>
                        <?php foreach ($sport_types as $sport): ?>
                            <option value="<?php echo esc_attr($sport); ?>" <?php echo $sport_type === $sport ? 'selected' : ''; ?>>
                                <?php echo esc_html($sport); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="srm-results-wrapper">
                <button class="srm-nav-btn srm-nav-prev" aria-label="Anterior">
                    <span>&lsaquo;</span>
                </button>

                <div class="srm-results-carousel">
                    <div class="srm-results-track" data-current-sport="<?php echo esc_attr($sport_type); ?>">
                        <?php if (!empty($results)): ?>
                            <?php foreach ($results as $result): ?>
                                <div class="srm-result-card<?php echo !empty($result->post_url) ? ' srm-clickable' : ''; ?>"
                                     data-sport="<?php echo esc_attr($result->sport_type); ?>"
                                     <?php if (!empty($result->post_url)): ?>
                                     data-url="<?php echo esc_url($result->post_url); ?>"
                                     title="Clic para ver detalles del partido"
                                     <?php endif; ?>>
                                    <div class="srm-result-header">
                                        <span class="srm-event-name"><?php echo esc_html($result->event_name); ?></span>
                                        <?php if ($result->status === 'live'): ?>
                                            <span class="srm-live-badge">EN VIVO</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="srm-match-display">
                                        <div class="srm-team">
                                            <img src="<?php echo esc_url($result->team1_logo ?: $site_logo_url); ?>"
                                                 alt="<?php echo esc_attr($result->team1_name); ?>"
                                                 class="srm-team-logo">
                                            <span class="srm-team-abbr"><?php echo esc_html($result->team1_abbr); ?></span>
                                        </div>

                                        <div class="srm-score">
                                            <span class="srm-score-value"><?php echo ($result->team1_score !== '' && $result->team1_score !== null) ? esc_html($result->team1_score) : '-'; ?></span>
                                            <span class="srm-score-separator">-</span>
                                            <span class="srm-score-value"><?php echo ($result->team2_score !== '' && $result->team2_score !== null) ? esc_html($result->team2_score) : '-'; ?></span>
                                        </div>

                                        <div class="srm-team">
                                            <img src="<?php echo esc_url($result->team2_logo ?: $site_logo_url); ?>"
                                                 alt="<?php echo esc_attr($result->team2_name); ?>"
                                                 class="srm-team-logo">
                                            <span class="srm-team-abbr"><?php echo esc_html($result->team2_abbr); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="srm-no-results">
                                <p>No hay resultados disponibles en este momento.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <button class="srm-nav-btn srm-nav-next" aria-label="Siguiente">
                    <span>&rsaquo;</span>
                </button>
            </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * AJAX para filtrar resultados por deporte
     */
    public function ajax_filter_results() {
        check_ajax_referer('srm_public_nonce', 'nonce');

        $sport_type = sanitize_text_field($_POST['sport']);

        if ($sport_type === 'all') {
            $results = $this->db->get_all_results(10);
        } else {
            $results = $this->db->get_results_by_sport($sport_type);
        }

        // Obtener logo del sitio como fallback
        $site_logo_url = '';
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo_data = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($logo_data) {
                $site_logo_url = $logo_data[0];
            }
        }
        if (empty($site_logo_url)) {
            $site_logo_url = get_site_icon_url(512);
        }
        if (empty($site_logo_url)) {
            $site_logo_url = 'https://dportosports.com/wp-content/uploads/2025/10/cropped-android-chrome-512x512-1-32x32.png';
        }

        if (!empty($results)) {
            ob_start();
            foreach ($results as $result):
            ?>
                <div class="srm-result-card<?php echo !empty($result->post_url) ? ' srm-clickable' : ''; ?>"
                     data-sport="<?php echo esc_attr($result->sport_type); ?>"
                     <?php if (!empty($result->post_url)): ?>
                     data-url="<?php echo esc_url($result->post_url); ?>"
                     title="Clic para ver detalles del partido"
                     <?php endif; ?>>
                    <div class="srm-result-header">
                        <span class="srm-event-name"><?php echo esc_html($result->event_name); ?></span>
                        <?php if ($result->status === 'live'): ?>
                            <span class="srm-live-badge">EN VIVO</span>
                        <?php endif; ?>
                    </div>

                    <div class="srm-match-display">
                        <div class="srm-team">
                            <img src="<?php echo esc_url($result->team1_logo ?: $site_logo_url); ?>"
                                 alt="<?php echo esc_attr($result->team1_name); ?>"
                                 class="srm-team-logo">
                            <span class="srm-team-abbr"><?php echo esc_html($result->team1_abbr); ?></span>
                        </div>

                        <div class="srm-score">
                            <span class="srm-score-value"><?php echo ($result->team1_score !== '' && $result->team1_score !== null) ? esc_html($result->team1_score) : '-'; ?></span>
                            <span class="srm-score-separator">-</span>
                            <span class="srm-score-value"><?php echo ($result->team2_score !== '' && $result->team2_score !== null) ? esc_html($result->team2_score) : '-'; ?></span>
                        </div>

                        <div class="srm-team">
                            <img src="<?php echo esc_url($result->team2_logo ?: $site_logo_url); ?>"
                                 alt="<?php echo esc_attr($result->team2_name); ?>"
                                 class="srm-team-logo">
                            <span class="srm-team-abbr"><?php echo esc_html($result->team2_abbr); ?></span>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            $html = ob_get_clean();
            wp_send_json_success($html);
        } else {
            wp_send_json_success('<div class="srm-no-results"><p>No hay resultados disponibles para este deporte.</p></div>');
        }
    }
}

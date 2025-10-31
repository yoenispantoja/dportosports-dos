<?php
/*
Plugin Name: Live Streams Widget Universal
Description: CPT + widget para mostrar cualquier embed HTML de transmisiones en vivo en el sidebar. Intuitivo y responsive.
Version: 1.2
Author: Yoenis Pantoja (yoenis.pantoja@gmail.com)
*/

if (!defined('ABSPATH')) exit; // Evitar acceso directo

/* ---------------------------
1️⃣ Registro CPT "Streams"
----------------------------*/
function lsw_register_cpt_stream() {
    $labels = [
        'name' => 'Streams',
        'singular_name' => 'Stream',
        'add_new_item' => 'Agregar Stream en Vivo',
        'edit_item' => 'Editar Stream',
        'all_items' => 'Todos los Streams',
        'menu_name' => 'Streams En Vivo'
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_in_menu' => true,
        'menu_position' => 20,
        'supports' => ['title'], // solo título, no necesitamos editor
        'menu_icon' => 'dashicons-video-alt3',
    ];
    register_post_type('stream', $args);
}
add_action('init', 'lsw_register_cpt_stream');

/* ---------------------------
2️⃣ Meta Fields: Activo + Fecha + Embed HTML
----------------------------*/
function lsw_add_meta_boxes() {
    add_meta_box('lsw_stream_meta', 'Detalles del Stream', 'lsw_stream_meta_box_cb', 'stream', 'normal', 'high');
}
add_action('add_meta_boxes', 'lsw_add_meta_boxes');

function lsw_stream_meta_box_cb($post) {
    wp_nonce_field('lsw_stream_save_meta', 'lsw_stream_nonce');

    $embed_html = get_post_meta($post->ID, '_lsw_stream_embed', true);
    $is_active  = get_post_meta($post->ID, '_lsw_stream_active', true);
    $event_date = get_post_meta($post->ID, '_lsw_stream_date', true);
    ?>
    <p>
      <label for="lsw_stream_date"><strong>Fecha del evento</strong></label><br>
      <input type="date" id="lsw_stream_date" name="lsw_stream_date" value="<?php echo esc_attr($event_date); ?>" style="width:200px;" />
    </p>
    <p>
      <label>
        <input type="checkbox" name="lsw_stream_active" value="1" <?php checked($is_active, '1'); ?> />
        &nbsp;Activo (mostrar en sidebar)
      </label>
    </p>
    <p>
      <label for="lsw_stream_embed"><strong>Embed HTML del stream</strong></label><br>
      <textarea id="lsw_stream_embed" name="lsw_stream_embed" rows="10" style="width:100%; font-family: monospace;" placeholder="Pega aquí el iframe, embed HTML o script que te da la plataforma (YouTube, Twitch, TikTok, Instagram, X, etc.)"><?php echo esc_textarea($embed_html); ?></textarea>
    </p>
    <p style="font-size:12px;color:#666;">
      Ejemplo YouTube: <code>&lt;iframe src='https://www.youtube.com/embed/VIDEOID' width='100%' height='200' allowfullscreen&gt;&lt;/iframe&gt;</code><br>
      Ejemplo Twitch: <code>&lt;iframe src='https://player.twitch.tv/?channel=canal&parent=tuweb.com' width='100%' height='200' allowfullscreen&gt;&lt;/iframe&gt;</code>
    </p>
    <?php
}

function lsw_save_stream_meta($post_id) {
    if (!isset($_POST['lsw_stream_nonce']) || !wp_verify_nonce($_POST['lsw_stream_nonce'], 'lsw_stream_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (get_post_type($post_id) !== 'stream') return;

    // Guardar Embed HTML con wp_kses personalizado para permitir iframe, video, script
    if (isset($_POST['lsw_stream_embed'])) {
        $allowed_tags = array(
            'iframe' => array(
                'src' => true,
                'width' => true,
                'height' => true,
                'frameborder' => true,
                'allowfullscreen' => true,
                'style' => true,
                'scrolling' => true,
                'marginwidth' => true,
                'marginheight' => true,
            ),
            'video' => array(
                'src' => true,
                'width' => true,
                'height' => true,
                'controls' => true,
                'autoplay' => true,
                'style' => true,
            ),
            'script' => array(
                'src' => true,
                'type' => true,
                'async' => true,
                'charset' => true,
            ),
        );
        update_post_meta($post_id, '_lsw_stream_embed', wp_kses($_POST['lsw_stream_embed'], $allowed_tags));
    }

    // Activo
    $active = (isset($_POST['lsw_stream_active']) && $_POST['lsw_stream_active'] == '1') ? '1' : '0';
    update_post_meta($post_id, '_lsw_stream_active', $active);

    // Fecha del evento
    if (isset($_POST['lsw_stream_date'])) {
        update_post_meta($post_id, '_lsw_stream_date', sanitize_text_field($_POST['lsw_stream_date']));
    }
}
add_action('save_post', 'lsw_save_stream_meta');

/* ---------------------------
3️⃣ Widget: LiveStreams_Widget
----------------------------*/
class LiveStreams_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'live_streams_widget',
            __('Eventos en Vivo', 'lsw'),
            ['description' => __('Muestra streams activos en sidebar', 'lsw')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : '📺 En vivo ahora';
        echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];

        $count = !empty($instance['count']) ? intval($instance['count']) : 3;
        $today = date('Y-m-d');

        $streams = get_posts([
            'post_type' => 'stream',
            'posts_per_page' => $count,
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => '_lsw_stream_active',
                    'value' => '1',
                ],
                [
                    'key' => '_lsw_stream_date',
                    'value' => $today,
                    'compare' => '>=',
                    'type' => 'DATE'
                ]
            ],
            'orderby' => 'meta_value',
            'order' => 'ASC'
        ]);

        if ($streams) {
            echo '<div class="lsw-widget">';
            foreach ($streams as $stream) {
                $embed = get_post_meta($stream->ID, '_lsw_stream_embed', true);
                $title_stream = get_the_title($stream);
                echo '<div class="lsw-item">';
                echo '<h4 class="lsw-item-title">'.esc_html($title_stream).'</h4>';
                if ($embed) {
                    echo '<div class="lsw-iframe-wrap">';
                    echo $embed;
                    echo '</div>';
                } else {
                    echo '<p style="font-size:13px;color:#777;">No hay embed válido.</p>';
                }
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No hay eventos en vivo ahora.</p>';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '📺 En vivo ahora';
        $count = isset($instance['count']) ? intval($instance['count']) : 3;
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                 name="<?php echo $this->get_field_name('title'); ?>" type="text"
                 value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('count'); ?>">Cantidad a mostrar:</label>
          <input id="<?php echo $this->get_field_id('count'); ?>"
                 name="<?php echo $this->get_field_name('count'); ?>" type="number" min="1" max="10"
                 value="<?php echo esc_attr($count); ?>" style="width:70px;" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $inst = [];
        $inst['title'] = sanitize_text_field($new_instance['title']);
        $inst['count'] = intval($new_instance['count']);
        return $inst;
    }
}
add_action('widgets_init', function() {
    register_widget('LiveStreams_Widget');
});

/* ---------------------------
4️⃣ CSS responsive para embeds
----------------------------*/
function lsw_enqueue_styles() {
    wp_register_style('lsw-styles', false);
    wp_enqueue_style('lsw-styles');
    $custom_css = "
    .lsw-item { margin-bottom: 12px; }
    .lsw-item-title { font-size: 13px; margin: 0 0 6px 0; }
    .lsw-iframe-wrap { position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.2); }
    .lsw-iframe-wrap iframe, .lsw-iframe-wrap video { position: absolute; top:0; left:0; width:100%; height:100%; border:0; }
    @media (max-width:480px){ .lsw-item-title{font-size:12px;} }
    ";
    wp_add_inline_style('lsw-styles', $custom_css);
}
add_action('wp_enqueue_scripts', 'lsw_enqueue_styles');

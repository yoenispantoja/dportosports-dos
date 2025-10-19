<?php
/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-plugin-notice/newsmunch-customizer-notify.php';
$newsmunch_config_customizer = array(
    'recommended_plugins' => array( 
        'desert-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'To take full advantage of all the features of this theme. please install and activate %s plugin then use the demo importer and install the Demo according to your need.', 'newsmunch' ), '<strong>Desert Companion</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'newsmunch' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'newsmunch' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'newsmunch' ),
	'activate_button_label'     => esc_html__( 'Activate', 'newsmunch' ),
	'newsmunch_deactivate_button_label'   => esc_html__( 'Deactivate', 'newsmunch' ),
);
Newsmunch_Customizer_Notify::init( apply_filters( 'newsmunch_customizer_notify_array', $newsmunch_config_customizer ) );
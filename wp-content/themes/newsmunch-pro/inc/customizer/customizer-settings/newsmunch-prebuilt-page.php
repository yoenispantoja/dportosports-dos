<?php
function newsmunch_prebuilt_pg_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	NewsMunch Page Templates
	=========================================*/
	$wp_customize->add_panel(
		'newsmunch_pages_options', array(
			'priority' => 33,
			'title' => esc_html__( 'Theme Prebuilt Pages', 'newsmunch-pro' ),
		)
	);
	
	
	/*=========================================
	About Page
	=========================================*/
	$wp_customize->add_section(
		'about_pg_options', array(
			'title' => esc_html__( 'About Page', 'newsmunch-pro' ),
			'priority' => 1,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	About Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_about_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_head_options',
		array(
			'type' => 'hidden',
			'label' => __('About Section','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_about_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	/*=========================================
	Skill Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_about_skill_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_skill_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Skill Section','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_about_skill_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_skill_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	/*=========================================
	Team Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_about_team_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_team_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Team Section','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_about_team_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 10,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_team_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	
	/*=========================================
	FAQ Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_about_faq_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_faq_head_options',
		array(
			'type' => 'hidden',
			'label' => __('FAQ Section','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_about_faq_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 10,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_about_faq_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'about_pg_options',
		)
	);
	
	/*=========================================
	Author Page
	=========================================*/
	$wp_customize->add_section(
		'author_pg_options', array(
			'title' => esc_html__( 'Author Page', 'newsmunch-pro' ),
			'priority' => 2,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	Author Page
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_author_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_author_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Author Page','newsmunch-pro'),
			'section' => 'author_pg_options',
		)
	);
	
	//Author Exclude
	class Newsmunch_Author_Customize_Control extends WP_Customize_Control {
	public $type = 'author_exclude';

		   function render_content()
		   
		   {
		    echo '<h3>' .  __( 'Author Exclude', 'newsmunch-pro' ) . '</h3>';
			  $name = '_customize-author-exclude-' . $this->id;
			$users = get_users();		
				?>
				   <select multiple <?php $this->link(); ?>>
						<?php
						printf( '<option value="%s" %s>%s</option>', 0, selected( $this->value(), '', false ), __( 'None', 'newsmunch-pro' )  );
						?>
						<?php if ( ! empty( $users ) ) :  ?>
							<?php foreach ( $users as $key => $user ) :  ?>
								<?php
								printf( '<option value="%s" %s>%s</option>', esc_attr( $user->ID ), selected( $this->value(), $user->ID, false ), esc_html( $user->nickname ) );
								?>
							<?php endforeach ?>
						<?php endif ?>
					</select>	
			  <?php
		   }

	}
	
	// Exclude Author
	$wp_customize->add_setting(
    'author_pg_author_exclude',
		array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'priority' => 5,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Newsmunch_Author_Customize_Control( $wp_customize, 
	'author_pg_author_exclude', 
		array(
		'label'   => __('Exclude Author','newsmunch-pro'),
		'section' => 'author_pg_options',
		) 
	) );
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_pg_author_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 5,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_pg_author_cat', 
		array(
		'label'   => __('Select Category','newsmunch-pro'),
		'section' => 'author_pg_options',
		) 
	) );
	
	
	/*=========================================
	Contact Page
	=========================================*/
	$wp_customize->add_section(
		'contact_pg_options', array(
			'title' => esc_html__( 'Contact Page', 'newsmunch-pro' ),
			'priority' => 3,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	Contact Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_contact_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_contact_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Contact Info Section','newsmunch-pro'),
			'section' => 'contact_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_contact_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_contact_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'contact_pg_options',
		)
	);
	
	/*=========================================
	Contact Form Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_contact_form_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_contact_form_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Contact Form Section','newsmunch-pro'),
			'section' => 'contact_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_contact_form_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_contact_form_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'contact_pg_options',
		)
	);
	
	/*=========================================
	Contact Map Section
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_contact_map_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_contact_map_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Contact Map Section','newsmunch-pro'),
			'section' => 'contact_pg_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'newsmunch_pg_contact_map_hs_options'
			,array(
			'default' => 1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_contact_map_hs_options',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','newsmunch-pro'),
			'section' => 'contact_pg_options',
		)
	);
	
	/*=========================================
	404 Page
	=========================================*/
	$wp_customize->add_section(
		'404_pg_options', array(
			'title' => esc_html__( '404 Page', 'newsmunch-pro' ),
			'priority' => 4,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	404 Page
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_404_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_404_head_options',
		array(
			'type' => 'hidden',
			'label' => __('404 Page','newsmunch-pro'),
			'section' => '404_pg_options',
		)
	);
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_ttl',
    	array(
	        'default'			=> __('<b class="is_on">Page Not Found</b><b>Page Not Found</b><b>Page Not Found</b>','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => '404_pg_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_subttl',
    	array(
	        'default'			=> __('<i class="fas fa-4" aria-hidden="true"></i> <i class="fas fa-question" aria-hidden="true"></i> <i class="fas fa-4" aria-hidden="true"></i>','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_subttl',
		array(
		    'label'   => __('Subtitle','newsmunch-pro'),
		    'section' => '404_pg_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_subttl2',
    	array(
	        'default'			=> __("Oops! That page can't be found.",'newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_subttl2',
		array(
		    'label'   => __('Subtitle 2','newsmunch-pro'),
		    'section' => '404_pg_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Text // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_text',
    	array(
	        'default'			=> __('Unfortunately, something went wrong and this page does not exist. Try using click the button and return to the previous page.','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_text',
		array(
		    'label'   => __('Text','newsmunch-pro'),
		    'section' => '404_pg_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_btn_lbl',
    	array(
	        'default'			=> __('Return To Home','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_btn_lbl',
		array(
		    'label'   => __('Button Label','newsmunch-pro'),
		    'section' => '404_pg_options',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_btn_link',
    	array(
	        'default'			=> esc_url( home_url( '/' ) ),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_btn_link',
		array(
		    'label'   => __('Button Link','newsmunch-pro'),
		    'section' => '404_pg_options',
			'type'           => 'text',
		)  
	);
	
	
	
	
	/*=========================================
	Single Page
	=========================================*/
	$wp_customize->add_section(
		'single_pg_options', array(
			'title' => esc_html__( 'Single Page', 'newsmunch-pro' ),
			'priority' => 4,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	Single Page Author
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_single_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_single_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Single Page','newsmunch-pro'),
			'section' => 'single_pg_options',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'newsmunch_hs_single_author_option'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hs_single_author_option',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Single Post Author?','newsmunch-pro'),
			'section' => 'single_pg_options',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'newsmunch_hs_single_post_nav'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hs_single_post_nav',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Single Post Navigation?','newsmunch-pro'),
			'section' => 'single_pg_options',
		)
	);
	
	/*=========================================
	Related Post
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_single_related_post_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_single_related_post_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Related Post','newsmunch-pro'),
			'section' => 'single_pg_options',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'newsmunch_hs_single_related_post'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hs_single_related_post',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Related Post?','newsmunch-pro'),
			'section' => 'single_pg_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_related_post_ttl',
    	array(
	        'default'			=> __('Related Posts','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_related_post_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'single_pg_options',
			'type'           => 'text',
		)  
	);
}
add_action( 'customize_register', 'newsmunch_prebuilt_pg_customize_setting' );
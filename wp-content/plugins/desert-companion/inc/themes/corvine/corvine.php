<?php
/**
 * @package   Corvine
 */

require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-overview-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-features-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-selective-partial.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/front/site-header.php';

if ( ! function_exists( 'desert_companion_corpiva_frontpage_sections' ) ) :
	function desert_companion_corpiva_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/corvine/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-overview.php';
		require desert_companion_plugin_dir . 'inc/themes/corvita/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-features.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Corpiva_frontpage', 'desert_companion_corpiva_frontpage_sections' );
endif;


/*=========================================
Corvine Site Header
=========================================*/
if ( ! function_exists( 'corvine_site_header' ) ) :
function corvine_site_header() {
$corpiva_hs_hdr 	= get_theme_mod( 'corpiva_hs_hdr','1');
if($corpiva_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-2 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<?php  do_action('corpiva_site_social'); ?>
					</div>
				</div>
				<div class="dt-col-lg-10 dt-col-12">
					<div class="widget--right dt-text-lg-right">   
						<?php  do_action('corpiva_header_address'); ?>
						<?php  do_action('corpiva_header_email'); ?>
						<?php  do_action('corpiva_header_time'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'corvine_site_header', 'corvine_site_header' );
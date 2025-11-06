<?php  
$newsmunch_team_ttl		= get_theme_mod('newsmunch_team_ttl','Meet Our Team');
$newsmunch_team_option	= get_theme_mod('newsmunch_team_option',newsmunch_team_options_default());
$newsmunch_team_column	= get_theme_mod('newsmunch_team_column','3');
do_action('newsmunch_team_option_before');	
?>	
<div class="spacer" data-height="50"></div>           
<div class="dt-row hm-team">
	<?php if ( ! empty( $newsmunch_team_ttl ) ) : ?>
		<div class="dt-col-lg-12">
			<div class="widget-header">
				<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_team_ttl); ?></h4>
			</div>
		</div>
	<?php endif; ?>
	<div class="dt-col-lg-12">
		<div class="dt-row dt-g-4 position-relative">
			<?php
				if ( ! empty( $newsmunch_team_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);	
				$newsmunch_team_option = json_decode( $newsmunch_team_option );
				foreach ( $newsmunch_team_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'newsmunch_translate_single_string', $item->title, 'Team section' ) : '';
					$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'newsmunch_translate_single_string', $item->subtitle, 'Team section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'newsmunch_translate_single_string', $item->link, 'Team section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'newsmunch_translate_single_string', $item->image_url, 'Team section' ) : '';
			?>
				<div class="team-item dt-col-lg-<?php echo esc_attr($newsmunch_team_column); ?> dt-col-md-6 dt-col-sm-6 dt-col-xs-12">
					<div class="team-content-wrap">
						<div class="team-thumb">
							<?php if ( ! empty( $image ) ) : ?>
								<a href="<?php echo esc_url($link); ?>">
									<img src="<?php echo esc_url($image); ?>" class="wp-post-image" alt=""/>
								</a>
							<?php endif; ?>
							<div class="widget widget_social">
								<?php if ( ! empty( $item->social_repeater ) ) :
								$icons         = html_entity_decode( $item->social_repeater );
								$icons_decoded = json_decode( $icons, true );
								if ( ! empty( $icons_decoded ) ) : ?>
								<?php
									foreach ( $icons_decoded as $value ) {
										$social_icon = ! empty( $value['icon'] ) ? apply_filters( 'newsmunch_translate_single_string', $value['icon'], 'Team section' ) : '';
										$social_link = ! empty( $value['link'] ) ? apply_filters( 'newsmunch_translate_single_string', $value['link'], 'Team section' ) : '';
										if ( ! empty( $social_icon ) ) {
								?>
									<a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a>
								<?php	} } endif; endif; ?>
							</div>
						</div>
						<div class="mask-wrap">
							<div class="team-content">
								<?php if ( ! empty( $title ) ) : ?>
									<h5 class="team-title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
								<?php endif; ?>
								
								<?php if ( ! empty( $subtitle ) ) : ?>
									<div class="team-designation"><?php echo wp_kses( html_entity_decode( $subtitle ), $allowed_html ); ?></div>  
								<?php endif; ?>	                       
							</div>
						</div>
					</div>
				</div>
			<?php } } ?>
			<div class="element circle"></div>
		</div>                    
	</div>
</div>
<?php do_action('newsmunch_team_option_after'); ?>
<div class="spacer" data-height="30"></div>
<hr>

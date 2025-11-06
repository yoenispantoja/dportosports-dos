<?php
/**
 * Template part for displaying author Meta
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMunch
 */

$newsmunch_author_data 		= get_the_author_meta( 'description' );
$newsmunch_active_author_id  = get_the_author_meta( 'ID' );
$newsmunch_active_user_id    = is_user_logged_in() ? wp_get_current_user()->ID : false;
?>
<div class="about-author padding-30 rounded">
	<div class="thumb">
		<?php echo get_avatar( get_the_author_meta('ID'), 200); ?>
	</div>
	<div class="details">
		<h4 class="name"><?php the_author_link(); ?></h4>
		<?php 
			if ( '' === $newsmunch_author_data ) {
				if ( $newsmunch_active_user_id && $newsmunch_active_author_id === $newsmunch_active_user_id ) {

					// Translators: %1$s: <a> tag. %2$s: </a>.
					printf( wp_kses_post( __( 'You haven&rsquo;t entered your Biographical Information yet. %1$sEdit your Profile%2$s now.', 'newsmunch-pro' ) ), '<a href="' . esc_url( get_edit_user_link( $newsmunch_active_user_id ) ) . '">', '</a>' );
				}
			}else{
				echo wp_kses_post( $newsmunch_author_data ); 
			}
		?>
		<div class="social-share">
			<ul class="icons list-unstyled list-inline dt-mt-0 dt-mb-0">
				<?php $user = wp_get_current_user(); $facebook_profile = $user->facebook_profile; 
				if ( $facebook_profile != '' ): ?>
					<li class="list-inline-item"><a href="<?php echo esc_url($facebook_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-facebook"></a></li>
				<?php endif; ?>
				
				<?php $instagram_profile = $user->instagram_profile; 
				if ( $instagram_profile != '' ): ?>
					<li class="list-inline-item"><a href="<?php echo esc_url($facebook_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-instagram"></a></li>
				<?php endif; ?>
				
				<?php $linkedin_profile = $user->linkedin_profile; 
				if ( $linkedin_profile != '' ): ?>
					<li class="list-inline-item"><a href="<?php echo esc_url($facebook_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-linkedin"></a></li>
				<?php endif; ?>
				
				<?php $twitter_profile = $user->twitter_profile; 
				if ( $twitter_profile != '' ): ?>
					<li class="list-inline-item"><a href="<?php echo esc_url($twitter_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-twitter"></a></li>
				<?php endif; ?>
				
				<?php $youtube_profile = $user->youtube_profile; 
				if ( $youtube_profile != '' ): ?>
					<li class="list-inline-item"><a href="<?php echo esc_url($youtube_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-youtube"></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
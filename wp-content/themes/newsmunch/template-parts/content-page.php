<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMunch
 */
$newsmunch_hs_latest_post_title		    = get_theme_mod('newsmunch_hs_latest_post_title','1');
$newsmunch_hs_latest_post_cat_meta	    = get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
$newsmunch_hs_latest_post_auth_meta	    = get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
$newsmunch_hs_latest_post_date_meta	    = get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
$newsmunch_hs_latest_post_comment_meta	= get_theme_mod('newsmunch_hs_latest_post_comment_meta','1');
$newsmunch_hs_latest_post_content_meta  = get_theme_mod('newsmunch_hs_latest_post_content_meta','1');
$newsmunch_hs_latest_post_social_share  = get_theme_mod('newsmunch_hs_latest_post_social_share');
$newsmunch_hs_latest_post_reading_meta  = get_theme_mod('newsmunch_hs_latest_post_reading_meta');
$newsmunch_hs_latest_post_view_meta	    = get_theme_mod('newsmunch_hs_latest_post_view_meta','1');
$newsmunch_latest_post_rm_lbl           = get_theme_mod('newsmunch_latest_post_rm_lbl','Continue reading');
$newsmunch_hs_latest_post_format_icon	= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
$format = get_post_format() ? : 'standard';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="thumb">
			<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories('','position-absolute');  endif; ?>
			<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
				<span class="post-format-sm">
					<?php do_action('newsmunch_post_format_icon_type'); ?>
				</span>
			<?php endif; ?>
			<a href="<?php echo esc_url(get_permalink()); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
				<?php else: ?>
					<div class="inner"></div>
				<?php endif; ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="details bg-white shadow dt-p-3 clearfix">
		<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h6','post-title dt-mb-0 dt-mt-0'); endif; ?> 
		<ul class="meta list-inline dt-mt-2 dt-mb-0">
			<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
				<?php do_action('newsmunch_common_post_author'); ?>
			<?php endif; ?>	
			<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
				<?php do_action('newsmunch_common_post_date'); ?>
			<?php endif; ?>	 
			<?php newsmunch_edit_post_link(); ?>
		</ul>
		<?php  if($newsmunch_hs_latest_post_content_meta=='1'):	?> 
			<p class="excerpt dt-mb-0"><?php do_action('newsmunch_post_format_content'); ?></p>
		<?php endif; ?>
		<div class="post-bottom clearfix dt-mt-2">
			<a href="<?php echo esc_url(get_permalink()); ?>" class="more-link"><?php echo wp_kses_post($newsmunch_latest_post_rm_lbl); ?> <i class="fas fa-arrow-right"></i></a>
		</div>
	</div>
</article>
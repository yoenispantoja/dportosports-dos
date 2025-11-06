<?php
if (!class_exists('Newsmunch_Posts_Slider_Widget')) :
    /**
     * Adds Newsmunch_Posts_Slider_Widget.
     */
    class Newsmunch_Posts_Slider_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsmunch-posts-slider-ttl', 'newsmunch-count-posts');
            $this->select_fields = array('newsmunch-select-post-cat','newsmunch-select-column');


            $widget_ops = array(
                'classname' => 'newsmunch_posts_slider_widget',
                'description' => __('Displays posts slider from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_posts_slider_widget', __('DT : Posts Slider', 'newsmunch-pro'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::newsmunch_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters('widget_title', $instance['newsmunch-posts-slider-ttl'], $instance, $this->id_base);
            $category = isset($instance['newsmunch-select-post-cat']) ? $instance['newsmunch-select-post-cat'] : 0; 
			$newsmunch_count_posts = isset($instance['newsmunch-count-posts']) ? $instance['newsmunch-count-posts'] : '5';
			$column = isset($instance['newsmunch-select-column']) ? $instance['newsmunch-select-column'] : '1';
			
            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="widget dt_widget_post_carousel_banner">
                <div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					<?php endif;  ?>
                </div>
                <?php
                $all_posts = newsmunch_get_posts($newsmunch_count_posts, $category); ?>
				<div class="post-carousel-banner post-carousel-column<?php echo esc_attr($column); ?>" data-slick='{"slidesToShow": <?php echo esc_attr($column); ?>, "slidesToScroll": 1}'>
					<?php
						$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
						$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
						$newsmunch_hs_latest_post_auth_meta	= get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
						$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
						$newsmunch_hs_latest_post_comment_meta	= get_theme_mod('newsmunch_hs_latest_post_comment_meta','1');
						$newsmunch_hs_latest_post_view_meta	= get_theme_mod('newsmunch_hs_latest_post_view_meta','1');
						$newsmunch_hs_latest_post_reading_meta= get_theme_mod('newsmunch_hs_latest_post_reading_meta');
						if ($all_posts->have_posts()) :
							while ($all_posts->have_posts()) : $all_posts->the_post();
								global $post;
								$format = get_post_format() ? : 'standard';	
					?>
						<div class="post featured-post-xl">
							<div class="details clearfix">
								<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
								<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?> 
								<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
									<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch-pro');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" title="Posts by David" rel="author"><?php esc_html(the_author()); ?></a></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo esc_html(get_the_date( 'F j, Y' )); ?></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_latest_post_comment_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_latest_post_reading_meta=='1'): ?>
										<li class="list-inline-item"><i class="fa-solid fa-eye"></i> <?php echo esc_html(newsmunch_read_time()); ?></li>
									<?php endif; ?>
									
									<?php if($newsmunch_hs_latest_post_view_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
									<?php endif; newsmunch_edit_post_link(); ?>
								</ul>
							</div>
							<div class="thumb">
								<?php if ( $format !== 'standard'): ?>
									<span class="post-format-sm">
										<?php do_action('newsmunch_post_format_icon_type'); ?>
									</span>
								<?php endif; ?>
								<a href="<?php echo esc_url(get_permalink()); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="inner data-bg-image" data-bg-image="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
									<?php else: ?>
										<div class="inner"></div>
									<?php endif; ?>
								</a>
							</div>
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
            </div>
            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            
            $categories = newsmunch_get_cat_terms();
			$newsmunch_count_posts = isset($instance['newsmunch-count-posts']) ? $instance['newsmunch-count-posts'] : '5';
            
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('newsmunch-posts-slider-ttl', __('Title', 'newsmunch-pro'), 'Posts Slider');

                echo parent::newsmunch_generate_select_options('newsmunch-select-post-cat', __('Select category', 'newsmunch-pro'), $categories);
				
				 echo parent::newsmunch_generate_text_input('newsmunch-count-posts', __('Number of Post to Show', 'newsmunch-pro'), $newsmunch_count_posts);
				 
				 echo parent::newsmunch_generate_select_options('newsmunch-select-column', __('Select Column', 'newsmunch-pro'), newsmunch_widget_crousel_column());
				 
            }
            
        }
    }
endif;
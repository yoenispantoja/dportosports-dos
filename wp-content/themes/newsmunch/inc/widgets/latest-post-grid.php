<?php
if (!class_exists('newsmunch_Latest_Post_Grid_Widget')) :
    /**
     * Adds newsmunch_Latest_Post_Grid_Widget widget.
     */
    class newsmunch_Latest_Post_Grid_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('title', 'count-posts', 'count_posts_limit', 'load_more_btn_lbl');
            $this->select_fields = array('select-cat');

            $widget_ops = array(
                'classname' => 'newsmunch_Latest_Post_grid_Widget',
                'description' => __('Displays posts from selected category.', 'newsmunch'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_Latest_Post_grid_Widget', __('DT: Latest Post Grid', 'newsmunch'), $widget_ops);
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

            $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
            $category = isset($instance['select-cat']) ? $instance['select-cat'] : '0';
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '6';
			$count_posts_limit = isset($instance['count_posts_limit']) ? $instance['count_posts_limit'] : '3';
			$load_more_btn_lbl = isset($instance['load_more_btn_lbl']) ? $instance['load_more_btn_lbl'] : 'Load More';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
            // open the widget container
            echo $args['before_widget'];
            ?>
			 <div class="widget dt_widget_post_single_grid" <?php if($enable_bg_pd==true):?> style="background: #fff;padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
					<div class="widget-header">
						<?php if (!empty($title)): ?>
							<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
						<?php endif; ?>
					</div>
					<div class="widget-content dt-posts-module loadon">
						<div class="dt-row dt-g-4 dt-posts" data-col="<?php echo esc_attr($count_posts_limit); ?>" data-loadname="<?php echo esc_attr($load_more_btn_lbl); ?>">
							<?php 
							$all_posts = newsmunch_get_posts($newsmunch_count_posts, $category);
							$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
							$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
							$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
							$newsmunch_hs_latest_post_view_meta	= get_theme_mod('newsmunch_hs_latest_post_view_meta','1');
							$newsmunch_hs_latest_post_auth_meta	= get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
							$newsmunch_hs_latest_post_content_meta= get_theme_mod('newsmunch_hs_latest_post_content_meta','1');
							$newsmunch_hs_latest_post_social_share= get_theme_mod('newsmunch_hs_latest_post_social_share');
							$newsmunch_hs_latest_post_reading_meta= get_theme_mod('newsmunch_hs_latest_post_reading_meta');
							$newsmunch_latest_post_rm_type= get_theme_mod('newsmunch_latest_post_rm_type','style-1');
							$newsmunch_latest_post_rm_lbl= get_theme_mod('newsmunch_latest_post_rm_lbl','Continue reading');
							$newsmunch_hs_latest_post_format_icon	= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
							 if ($all_posts->have_posts()) :
							while ($all_posts->have_posts()) : $all_posts->the_post();
								global $post;
								$format = get_post_format() ? : 'standard';	
						 ?>	
							<div class="dt-col-md-4 dt-col-sm-6">
								<div class="post">
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
								</div>
							</div>   
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</div>
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
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '6';
			$count_posts_limit = isset($instance['count_posts_limit']) ? $instance['count_posts_limit'] : '3';
			$load_more_btn_lbl = isset($instance['load_more_btn_lbl']) ? $instance['load_more_btn_lbl'] : 'Load More';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
         
          

            
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('title', 'Title', 'Latest Posts');
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat', __('Select Blog Category', 'newsmunch'), $categories);
				}
                echo parent::newsmunch_generate_text_input('count-posts', __('Number of Post to Show', 'newsmunch'), $newsmunch_count_posts);
				echo parent::newsmunch_generate_text_input('count_posts_limit', __('Number of Post to Show Before Load More Button', 'newsmunch'), $count_posts_limit);
				echo parent::newsmunch_generate_text_input('load_more_btn_lbl', __('Load More Button Label', 'newsmunch'), $load_more_btn_lbl);
               ?>
			   <p>
					<label for="<?php echo $this->get_field_id( 'enable_bg_pd' ); ?>"><?php _e( 'Enable Background & Padding','newsmunch' ); ?></label> 
					<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_bg_pd' ); ?>" name="<?php echo $this->get_field_name( 'enable_bg_pd' ); ?>" <?php if($enable_bg_pd==true) echo 'checked'; ?> >
			   </p>
			   <?php 
          
            //print_pre($terms);


        }
		
		public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['select-cat'] = ( ! empty( $new_instance['select-cat'] ) ) ? $new_instance['select-cat'] : '';
		$instance['count-posts'] = ( ! empty( $new_instance['count-posts'] ) ) ? $new_instance['count-posts'] : '';
		$instance['count_posts_limit'] = ( ! empty( $new_instance['count_posts_limit'] ) ) ? $new_instance['count_posts_limit'] : '';
		$instance['load_more_btn_lbl'] = ( ! empty( $new_instance['load_more_btn_lbl'] ) ) ? $new_instance['load_more_btn_lbl'] : '';
		$instance['enable_bg_pd'] = ( ! empty( $new_instance['enable_bg_pd'] ) ) ? $new_instance['enable_bg_pd'] : '';
		
		return $instance;
	}

    }
endif;
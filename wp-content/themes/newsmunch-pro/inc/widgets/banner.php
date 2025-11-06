<?php
if (!class_exists('newsmunch_Banner_Widget')) :
    /**
     * Adds newsmunch_Banner_Widget widget.
     */
    class newsmunch_Banner_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('title', 'count-posts','count-posts2');
            $this->select_fields = array('select-cat','select-cat2');

            $widget_ops = array(
                'classname' => 'newsmunch_banner_Widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_banner_Widget', __('DT: Banner', 'newsmunch-pro'), $widget_ops);
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
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '5';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
            $category2 = isset($instance['select-cat2']) ? $instance['select-cat2'] : '0';
            $newsmunch_count_posts2 = isset($instance['count-posts2']) ? $instance['count-posts2'] : '2';
			$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
			$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
			$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
			$newsmunch_hs_latest_post_auth_meta	= get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
			$newsmunch_hs_latest_post_format_icon	= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
			$newsmunch_hs_latest_post_view_meta	= get_theme_mod('newsmunch_hs_latest_post_view_meta','1');
			$newsmunch_hs_latest_post_reading_meta= get_theme_mod('newsmunch_hs_latest_post_reading_meta');
			$newsmunch_hs_latest_post_comment_meta	= get_theme_mod('newsmunch_hs_latest_post_comment_meta','1');
			$newsmunch_hs_latest_post_content_meta= get_theme_mod('newsmunch_hs_latest_post_content_meta','1');
			$newsmunch_latest_post_rm_lbl= get_theme_mod('newsmunch_latest_post_rm_lbl','Continue reading');
            // open the widget container
            echo $args['before_widget'];
            ?>
			<div class="widget dt_widget_post_featured_lg" <?php if($enable_bg_pd==true):?> style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
				<div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					<?php endif; ?>
				</div>
				<div class="widget-content">
					<div class="main-banner-section style-1">
						<div class="dt-row dt-g-4">
							<div class="dt-col-lg-6">
								<div class="post-carousel-banner">
									<?php 
										$all_posts = newsmunch_get_posts($newsmunch_count_posts, $category);
										 if ($all_posts->have_posts()) :
										while ($all_posts->have_posts()) : $all_posts->the_post();
											global $post;
											$format = get_post_format() ? : 'standard';	
									 ?>
									<div class="post featured-post-lg">
										<div class="details clearfix">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
											<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?>
											<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
												<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_author'); ?>
												<?php endif; ?>	
												<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_date'); ?>
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
											<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
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
							<div class="dt-col-lg-6">
								<div class="post_columns-grid">
									<?php 
										$all_posts = newsmunch_get_posts($newsmunch_count_posts2, $category2);
										 if ($all_posts->have_posts()) :
										 $i=0;
										while ($all_posts->have_posts()) : $all_posts->the_post();
											global $post;
											$format = get_post_format() ? : 'standard';	
											if($i<=1):	
											$i++;
									 ?>
									<div class="post featured-post-lg">
										<div class="details clearfix">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
											<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?>
											<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
												<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_author'); ?>
												<?php endif; ?>	
												<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_date'); ?>
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
											<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
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
									<?php endif; endwhile; endif; wp_reset_postdata(); ?>
								</div>
							</div>
							<?php 
								$all_posts = newsmunch_get_posts($newsmunch_count_posts2, $category2);
								 if ($all_posts->have_posts()) :
								 $i=0;
								while ($all_posts->have_posts()) : $all_posts->the_post();
									global $post;
									$format = get_post_format() ? : 'standard';	
									$i++;
									if($i>2):	
							 ?>
								<div class="dt-col-lg-6">
									<div class="post_columns-grid">
										<div class="post featured-post-lg">
											<div class="details clearfix">
												<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
												<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?>
												<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
													<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
														<?php do_action('newsmunch_common_post_author'); ?>
													<?php endif; ?>	
													<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
														<?php do_action('newsmunch_common_post_date'); ?>
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
												<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
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
									</div>
								</div>
							 <?php endif;  endwhile; endif; wp_reset_postdata(); ?>
						</div>
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
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '5';
			$newsmunch_count_posts2 = isset($instance['count-posts2']) ? $instance['count-posts2'] : '2';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
			$enable_second_sticky = isset($instance['enable_second_sticky']) ? $instance['enable_second_sticky'] :true;
         
          

            
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('title', 'Title 1', 'Editor’s Pick');
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat', __('Select Blog Category 1', 'newsmunch-pro'), $categories);
				}
				
				echo parent::newsmunch_generate_text_input('count-posts', __('Number of Post for Category 1', 'newsmunch-pro'), $newsmunch_count_posts);
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat2', __('Select Blog Category 2', 'newsmunch-pro'), $categories);
				}
                
				echo parent::newsmunch_generate_text_input('count-posts2', __('Number of Post Category 2', 'newsmunch-pro'), $newsmunch_count_posts2);
               ?>
			   
			   <p>
					<label for="<?php echo $this->get_field_id( 'enable_bg_pd' ); ?>"><?php _e( 'Enable Background & Padding','newsmunch-pro' ); ?></label> 
					<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_bg_pd' ); ?>" name="<?php echo $this->get_field_name( 'enable_bg_pd' ); ?>" <?php if($enable_bg_pd==true) echo 'checked'; ?> >
			   </p>
			   <?php 
          
            //print_pre($terms);


        }
		
		public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['select-cat'] = ( ! empty( $new_instance['select-cat'] ) ) ? $new_instance['select-cat'] : '';
		$instance['select-cat2'] = ( ! empty( $new_instance['select-cat2'] ) ) ? $new_instance['select-cat2'] : '';
		$instance['count-posts'] = ( ! empty( $new_instance['count-posts'] ) ) ? $new_instance['count-posts'] : '';
		$instance['count-posts2'] = ( ! empty( $new_instance['count-posts2'] ) ) ? $new_instance['count-posts2'] : '';
		$instance['enable_bg_pd'] = ( ! empty( $new_instance['enable_bg_pd'] ) ) ? $new_instance['enable_bg_pd'] : '';
		
		return $instance;
	}

    }
endif;
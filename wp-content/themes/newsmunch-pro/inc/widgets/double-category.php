<?php
if (!class_exists('newsmunch_Double_Category_Widget')) :
    /**
     * Adds newsmunch_Double_Category_Widget widget.
     */
    class newsmunch_Double_Category_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('title','title2', 'count-posts','count-posts2');
            $this->select_fields = array('select-cat','select-cat2');

            $widget_ops = array(
                'classname' => 'newsmunch_double_category_Widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_double_category_Widget', __('DT: Double Categories Post', 'newsmunch-pro'), $widget_ops);
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
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '4';
			$enable_first_sticky = isset($instance['enable_first_sticky']) ? $instance['enable_first_sticky'] :true;
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
			
			$title2 = apply_filters('widget_title', $instance['title2'], $instance, $this->id_base);
            $category2 = isset($instance['select-cat2']) ? $instance['select-cat2'] : '0';
            $newsmunch_count_posts2 = isset($instance['count-posts2']) ? $instance['count-posts2'] : '4';
			$enable_second_sticky = isset($instance['enable_second_sticky']) ? $instance['enable_second_sticky'] :false;
            // open the widget container
            echo $args['before_widget'];
            ?>
				 <div class="widget dt_widget_post_double_category" <?php if($enable_bg_pd==true):?> style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
					<div class="dt-row dt-g-4">
						<div class="dt-col-sm-6">
							<div class="widget-header">
								<?php if (!empty($title)): ?>
									<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
								 <?php endif; ?>
							</div>
							<div class="widget-content">
								<?php 
									$all_posts = newsmunch_get_posts($newsmunch_count_posts, $category);
									$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
									$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
									$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
									$newsmunch_hs_latest_post_auth_meta	= get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
									$newsmunch_hs_latest_post_format_icon	= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
									$newsmunch_hs_latest_post_view_meta	= get_theme_mod('newsmunch_hs_latest_post_view_meta','1');
									$newsmunch_hs_latest_post_reading_meta= get_theme_mod('newsmunch_hs_latest_post_reading_meta');
									$newsmunch_hs_latest_post_comment_meta	= get_theme_mod('newsmunch_hs_latest_post_comment_meta','1');
									 if ($all_posts->have_posts()) :
									$i=0;
									while ($all_posts->have_posts()) : $all_posts->the_post();
										global $post;
										$format = get_post_format() ? : 'standard';	
										if($i==0 && $enable_first_sticky==true):
										$i++;
								 ?>
									<div class="post post-over-content">
										<div class="details clearfix">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
											<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h5','post-title'); endif; ?> 
											<ul class="meta list-inline dt-mt-0 dt-mb-0">
												<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
													<li class="list-inline-item"><i class="far fa-user-circle"></i> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php esc_html(the_author()); ?></a></li>
												<?php endif; ?>	
												<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_date'); ?>
												<?php endif; ?>
												
												<?php if($newsmunch_hs_latest_post_comment_meta=='1'): ?>
													<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
												<?php endif; newsmunch_edit_post_link(); ?>
											</ul>
										</div>
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<div class="thumb">
												<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
													<span class="post-format-sm">
														<?php do_action('newsmunch_post_format_icon_type'); ?>
													</span>
												<?php endif; ?>
												<?php if ( has_post_thumbnail() ) : ?>
													<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
												<?php else: ?>
													<div class="inner"></div>
												<?php endif; ?>
											</div>
										</a>
									</div>
									<?php else: ?>
									<div class="post post-list-md square bg-white shadow">
										<div class="thumb">
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
										<div class="details clearfix dt-py-3 dt-px-3">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
											<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
											<ul class="meta list-inline dt-mt-1 dt-mb-0">
												<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_author'); ?>
												<?php endif; ?>	
												
												<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_date'); ?>
												<?php endif; newsmunch_edit_post_link(); ?>
											</ul>
										</div>
									</div>
								<?php endif; endwhile; endif; wp_reset_postdata(); ?>
							</div>
						</div>
						<div class="dt-col-sm-6">
							<div class="widget-header">
								<?php if (!empty($title2)): ?>
									<h4 class="widget-title"><?php echo esc_html($title2); ?></h4>
								 <?php endif; ?>
							</div>
							<div class="widget-content">
								<?php 
									$all_posts2 = newsmunch_get_posts($newsmunch_count_posts2, $category2);
									 if ($all_posts2->have_posts()) :
									$i=0;
									while ($all_posts2->have_posts()) : $all_posts2->the_post();
										global $post;
										$format = get_post_format() ? : 'standard';	
									if($i==0 && $enable_second_sticky==true):
									$i++;
								 ?>	
									<div class="post post-over-content">
										<div class="details clearfix">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
											<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h5','post-title'); endif; ?> 
											<ul class="meta list-inline dt-mt-0 dt-mb-0">
												<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
													<li class="list-inline-item"><i class="far fa-user-circle"></i> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php esc_html(the_author()); ?></a></li>
												<?php endif; ?>	
												<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_date'); ?>
												<?php endif; ?>
												
												<?php if($newsmunch_hs_latest_post_comment_meta=='1'): ?>
													<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
												<?php endif; newsmunch_edit_post_link(); ?>
											</ul>
										</div>
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<div class="thumb">
												<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
													<span class="post-format-sm">
														<?php do_action('newsmunch_post_format_icon_type'); ?>
													</span>
												<?php endif; ?>
												<?php if ( has_post_thumbnail() ) : ?>
													<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
												<?php else: ?>
													<div class="inner"></div>
												<?php endif; ?>
											</div>
										</a>
									</div>
									<?php else: ?>
									<div class="post post-list-md square bg-white shadow">
										<div class="thumb">
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
										<div class="details clearfix dt-py-3 dt-px-3">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
											<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
											<ul class="meta list-inline dt-mt-1 dt-mb-0">
												<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_author'); ?>
												<?php endif; ?>	
												
												<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
													<?php do_action('newsmunch_common_post_date'); ?>
												<?php endif;  newsmunch_edit_post_link(); ?>
											</ul>
										</div>
									</div>
								<?php endif; endwhile; endif; wp_reset_postdata(); ?>
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
			$title2 = isset($instance['title2']) ? $instance['title2'] : 'Trending';
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '4';
			$newsmunch_count_posts2 = isset($instance['count-posts2']) ? $instance['count-posts2'] : '4';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
			$enable_first_sticky = isset($instance['enable_first_sticky']) ? $instance['enable_first_sticky'] :true;
			$enable_second_sticky = isset($instance['enable_second_sticky']) ? $instance['enable_second_sticky'] :true;
         
          

            
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('title', 'Title 1', 'Editor’s Pick');
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat', __('Select Blog Category 1', 'newsmunch-pro'), $categories);
				}
				
				echo parent::newsmunch_generate_text_input('count-posts', __('Number of Post for Category 1', 'newsmunch-pro'), $newsmunch_count_posts);
				?>
				<p>
					<label for="<?php echo $this->get_field_id( 'enable_first_sticky' ); ?>"><?php _e( 'Enable First Sticky','newsmunch-pro' ); ?></label> 
					<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_first_sticky' ); ?>" name="<?php echo $this->get_field_name( 'enable_first_sticky' ); ?>" <?php if($enable_first_sticky==true) echo 'checked'; ?> >
			   </p>
				<?php
				
				echo parent::newsmunch_generate_text_input('title2', __('Title 2', 'newsmunch-pro'), $title2);
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat2', __('Select Blog Category 2', 'newsmunch-pro'), $categories);
				}
                
				echo parent::newsmunch_generate_text_input('count-posts2', __('Number of Post Category 2', 'newsmunch-pro'), $newsmunch_count_posts2);
               ?>
			   
			   <p>
					<label for="<?php echo $this->get_field_id( 'enable_second_sticky' ); ?>"><?php _e( 'Enable Second Sticky','newsmunch-pro' ); ?></label> 
					<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_second_sticky' ); ?>" name="<?php echo $this->get_field_name( 'enable_second_sticky' ); ?>" <?php if($enable_second_sticky==true) echo 'checked'; ?> >
			   </p>
			   
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
		$instance['title2'] = ( ! empty( $new_instance['title2'] ) ) ? $new_instance['title2'] : '';
		$instance['select-cat'] = ( ! empty( $new_instance['select-cat'] ) ) ? $new_instance['select-cat'] : '';
		$instance['select-cat2'] = ( ! empty( $new_instance['select-cat2'] ) ) ? $new_instance['select-cat2'] : '';
		$instance['count-posts'] = ( ! empty( $new_instance['count-posts'] ) ) ? $new_instance['count-posts'] : '';
		$instance['count-posts2'] = ( ! empty( $new_instance['count-posts2'] ) ) ? $new_instance['count-posts2'] : '';
		$instance['enable_bg_pd'] = ( ! empty( $new_instance['enable_bg_pd'] ) ) ? $new_instance['enable_bg_pd'] : '';
		$instance['enable_first_sticky'] = ( ! empty( $new_instance['enable_first_sticky'] ) ) ? $new_instance['enable_first_sticky'] : '';
		$instance['enable_second_sticky'] = ( ! empty( $new_instance['enable_second_sticky'] ) ) ? $new_instance['enable_second_sticky'] : '';
		
		return $instance;
	}

    }
endif;
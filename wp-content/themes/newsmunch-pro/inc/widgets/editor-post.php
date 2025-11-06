<?php
if (!class_exists('newsmunch_Editor_post_Widget')) :
    /**
     * Adds newsmunch_Editor_post_Widget widget.
     */
    class newsmunch_Editor_post_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('title', 'count-posts');
            $this->select_fields = array('select-cat');

            $widget_ops = array(
                'classname' => 'newsmunch_editor_post_Widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_editor_post_Widget', __('DT: Editor Posts', 'newsmunch-pro'), $widget_ops);
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
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
            // open the widget container
            echo $args['before_widget'];
            ?>
			<div class="widget dt_widget_post_editors" <?php if($enable_bg_pd==true):?> style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
				<div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					 <?php endif; ?>
				</div>
				<div class="widget-content">
					<div class="padding-20 bg-white shadow">
						<div class="dt-row dt-g-4">
							<?php 
								$all_posts = newsmunch_get_posts($newsmunch_count_posts, $category);
								$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
								$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
								$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
								$newsmunch_hs_latest_post_auth_meta	= get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
								$newsmunch_hs_latest_post_format_icon= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
								$newsmunch_hs_latest_post_content_meta= get_theme_mod('newsmunch_hs_latest_post_content_meta','1');
								$newsmunch_hs_latest_post_view_meta	= get_theme_mod('newsmunch_hs_latest_post_view_meta','1');
								 if ($all_posts->have_posts()) :
								$i=0;
								while ($all_posts->have_posts()) : $all_posts->the_post();
									global $post;
									$format = get_post_format() ? : 'standard';	
								if($i==0):	
								$i++;
							 ?>
							<div class="dt-col-sm-6">
								<div class="post">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="thumb">
											<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories('','position-absolute');  endif; ?>
											<?php if ( $format !== 'standard' && $newsmunch_hs_latest_post_format_icon=='1'): ?>
												<span class="post-format">
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
									<ul class="meta list-inline dt-mt-4 dt-mb-0">
										<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
											<?php do_action('newsmunch_common_post_author'); ?>
										<?php endif; ?>	
										<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
											<?php do_action('newsmunch_common_post_date'); ?>
										<?php endif; newsmunch_edit_post_link(); ?>
									</ul>
									<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h5','post-title dt-mb-3 dt-mt-3'); endif; ?>
									<?php if($newsmunch_hs_latest_post_content_meta=='1'): ?> 
										<p class="excerpt dt-mb-0"><?php do_action('newsmunch_post_format_content'); ?></p>
									<?php endif; ?>
								</div>
							</div>
							<?php endif; break; endwhile; ?>
							<div class="dt-col-sm-6">
								<?php 
									while ($all_posts->have_posts()) : $all_posts->the_post();
										global $post;
										$format = get_post_format() ? : 'standard';	
									if($i>0):	
									$i++;
								?>
								<div class="post post-list-sm square">
									<div class="thumb">
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
											<?php else: ?>
												<div class="inner"></div>
											<?php endif; ?>
										</a>
									</div>
									<div class="details clearfix">
										<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories('','normal');  endif; ?>
										<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?>
										<ul class="meta list-inline dt-mt-1 dt-mb-0">
											<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
												<?php do_action('newsmunch_common_post_author'); ?>
											<?php endif; ?>	
											<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
												<?php do_action('newsmunch_common_post_date'); ?>
											<?php endif; ?>
											<?php if($newsmunch_hs_latest_post_view_meta=='1'): ?>
												<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
											<?php endif; newsmunch_edit_post_link(); ?>
										</ul>
									</div>
								</div>
								<?php endif; endwhile; ?>
							</div>
							<?php endif; wp_reset_postdata(); ?>
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
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
         
          

            
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('title', 'Title', 'Editor Posts');
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat', __('Select Blog Category', 'newsmunch-pro'), $categories);
				}
                echo parent::newsmunch_generate_text_input('count-posts', __('Number of Post to Show', 'newsmunch-pro'), $newsmunch_count_posts);
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
		$instance['count-posts'] = ( ! empty( $new_instance['count-posts'] ) ) ? $new_instance['count-posts'] : '';
		$instance['enable_bg_pd'] = ( ! empty( $new_instance['enable_bg_pd'] ) ) ? $new_instance['enable_bg_pd'] : '';
		
		return $instance;
	}

    }
endif;
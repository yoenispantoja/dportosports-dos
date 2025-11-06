<?php
if (!class_exists('newsmunch_Popular_Post_Widget')) :
    /**
     * Adds newsmunch_Popular_Post_Widget widget.
     */
    class newsmunch_Popular_Post_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('title', 'count-posts');
            $this->select_fields = array('select-cat','select-column');

            $widget_ops = array(
                'classname' => 'newsmunch_popular_post_widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_popular_post_widget', __('DT: Popular Posts', 'newsmunch-pro'), $widget_ops);
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
			$column = isset($instance['select-column']) ? $instance['select-column'] : '4';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
			$enable_vertical = isset($instance['enable_vertical']) ? $instance['enable_vertical'] :false;
            // open the widget container
            echo $args['before_widget'];
            ?>
             <div class="widget <?php if($enable_vertical==true): esc_attr_e('dt_widget_post_list_md','newsmunch-pro'); else: esc_attr_e('dt_widget_post_list_sm','newsmunch-pro'); endif;?>" <?php if($enable_bg_pd==true):?> style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
				<div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					 <?php endif; ?>
				</div>
				<?php if($enable_vertical==true):?>
				<div class="widget-content posts-vertical-carousel">
				<?php else: ?>
				<div class="widget-content post-carousel-post_list_sm post-carousel post-carousel-column<?php echo esc_attr($column); ?>" data-slick='{"slidesToShow": <?php echo esc_attr($column); ?>, "slidesToScroll": 1}'>
				<?php endif; ?>
					 <?php 
						$all_posts = newsmunch_get_posts($newsmunch_count_posts, $category);
						$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
						$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
						$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
						 if ($all_posts->have_posts()) :
						$i=0;
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post;
                     ?>
						<div class="post-item">
							<div class="post post-list-md square bg-white shadow">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="thumb">
										<span class="number"><?php  $i++; echo esc_html($i); ?></span>
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>										
										</a>
									</div>
								<?php endif; ?>
								<div class="details clearfix dt-py-3 dt-px-3">
									<?php if($newsmunch_hs_latest_post_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
									<?php if($newsmunch_hs_latest_post_title=='1'): newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
									<ul class="meta list-inline dt-mt-1 dt-mb-0">
										<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
											<?php do_action('newsmunch_common_post_date'); ?>
										<?php endif; ?>	
									</ul>
								</div>
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
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '5';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
			$enable_vertical = isset($instance['enable_vertical']) ? $instance['enable_vertical'] :false;
          

            
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('title', 'Title', 'Popular Posts');
				
				if (isset($categories) && !empty($categories)) {
					echo parent::newsmunch_generate_select_options('select-cat', __('Select Blog Category', 'newsmunch-pro'), $categories);
				}
                echo parent::newsmunch_generate_text_input('count-posts', __('Number of Post to Show', 'newsmunch-pro'), $newsmunch_count_posts);
				echo parent::newsmunch_generate_select_options('select-column', __('Select Column', 'newsmunch-pro'), newsmunch_widget_crousel_column());
               ?>
			   <p>
					<label for="<?php echo $this->get_field_id( 'enable_bg_pd' ); ?>"><?php _e( 'Enable Background & Padding','newsmunch-pro' ); ?></label> 
					<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_bg_pd' ); ?>" name="<?php echo $this->get_field_name( 'enable_bg_pd' ); ?>" <?php if($enable_bg_pd==true) echo 'checked'; ?> >
			   </p>
			   <p>
					<label for="<?php echo $this->get_field_id( 'enable_vertical' ); ?>"><?php _e( 'Enable Vertical Crousel','newsmunch-pro' ); ?></label> 
					<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_vertical' ); ?>" name="<?php echo $this->get_field_name( 'enable_vertical' ); ?>" <?php if($enable_vertical==true) echo 'checked'; ?> >
			   </p>
			   <?php 
          
            //print_pre($terms);


        }
		
		public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['select-cat'] = ( ! empty( $new_instance['select-cat'] ) ) ? $new_instance['select-cat'] : '';
		$instance['count-posts'] = ( ! empty( $new_instance['count-posts'] ) ) ? $new_instance['count-posts'] : '';
		$instance['select-column'] = ( ! empty( $new_instance['select-column'] ) ) ? $new_instance['select-column'] : '';
		$instance['enable_bg_pd'] = ( ! empty( $new_instance['enable_bg_pd'] ) ) ? $new_instance['enable_bg_pd'] : '';
		$instance['enable_vertical'] = ( ! empty( $new_instance['enable_vertical'] ) ) ? $new_instance['enable_vertical'] : '';
		
		return $instance;
	}

    }
endif;
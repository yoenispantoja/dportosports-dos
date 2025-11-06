<?php
if (!class_exists('newsmunch_Youtube_Slider_Widget')) :
    /**
     * Adds newsmunch_Youtube_Slider_Widget widget.
     */
    class newsmunch_Youtube_Slider_Widget extends Newsmunch_Widget_Base
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
                'classname' => 'newsmunch_youtube_slider_Widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_youtube_slider_Widget', __('DT: Youtube Video Slider', 'newsmunch-pro'), $widget_ops);
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
			$all_posts = newsmunch_get_posts($newsmunch_count_posts, $category);
			$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
			$newsmunch_hs_latest_post_cat_meta	= get_theme_mod('newsmunch_hs_latest_post_cat_meta','1');
			$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
			$mediaFound = false; 
            // open the widget container
            echo $args['before_widget'];
            ?>
			<div class="widget dt_widget_video_slider" <?php if($enable_bg_pd==true):?> style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
				<div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					 <?php endif; ?>
				</div>
				<div class="widget-content">
					<div class="dt-row">
						<div class="dt-col-12">
							<?php if ($all_posts->have_posts()) : ?>
								<div class="slider-pro dt_video_slider">
									<div class="sp-slides">
									<?php
									$mediaFound = false; // Flag to check if any media is found in posts

									while ($all_posts->have_posts()) : $all_posts->the_post();
										global $post;
										$media = get_media_embedded_in_content(
											apply_filters('the_content', get_the_content())
										);

										if (!empty($media)) :
											$mediaFound = true; // Set the flag to true if media is found
											$htmlCode = $media['0'];
											// Regular expression to match the YouTube video ID
											$pattern = '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/';
											preg_match($pattern, $htmlCode, $matches);

											// Check if a match is found
											if (isset($matches[1])) {
												$videoId = $matches[1];
									?>
												<div class="sp-slide">
													<a class="sp-video" href="https://www.youtube.com/watch?v=<?php echo $videoId; ?>">
														<img src="https://img.youtube.com/vi/<?php echo $videoId; ?>/maxresdefault.jpg" alt="">
													</a>
												</div>
									<?php
											}
										endif;
									endwhile;

									// Reset post data before checking $mediaFound
									wp_reset_postdata();
									?>
									</div>
									<?php

									if (!$mediaFound) :
										// Print a message when no media is found in any post
										echo '<p>No Youtube Video found for these posts.</p>';
									else :
										// If media is found, display the rest of the slider structure
									?>
										<div class="sp-thumbnails">
											<?php while ($all_posts->have_posts()) : $all_posts->the_post();
												global $post;
												$media = get_media_embedded_in_content(
													apply_filters('the_content', get_the_content())
												);
												if (!empty($media)) :
													$htmlCode = $media['0'];
													// Regular expression to match the YouTube video ID
													$pattern = '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/';
													preg_match($pattern, $htmlCode, $matches);

													// Check if a match is found
													if (isset($matches[1])) {
														$videoId = $matches[1];
											?>
														<div class="sp-thumbnail">
															<div class="sp-thumbnail-image-container">
																<img src="https://img.youtube.com/vi/<?php echo $videoId; ?>/mqdefault.jpg" alt="">
															</div>
														</div>
											<?php
													}
												endif;
											endwhile;
											wp_reset_postdata();
											?>
										</div>
									<?php endif; // end if $mediaFound ?>
								</div>
							<?php endif; ?>
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
                echo parent::newsmunch_generate_text_input('title', 'Title', 'youtube Video');
				
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
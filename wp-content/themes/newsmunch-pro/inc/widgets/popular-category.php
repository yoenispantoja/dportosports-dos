<?php
if (!class_exists('newsmunch_Popular_Cat_Widget')) :
    /**
     * Adds newsmunch_Popular_Cat_Widget widget.
     */
    class newsmunch_Popular_Cat_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('title', 'count-posts');
			$this->select_fields = array('select-column');
            $widget_ops = array(
                'classname' => 'newsmunch_popular_cat_Widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_popular_cat_Widget', __('DT: Popular Category', 'newsmunch-pro'), $widget_ops);
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
            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '6';
			$column = isset($instance['select-column']) ? $instance['select-column'] : '4';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
            // open the widget container
            echo $args['before_widget'];
			if($column=='1'): $col='12'; elseif($column=='2'): $col='6'; elseif($column=='3'): $col='4'; else: $col='3'; endif;
            ?>
			<div class="widget dt_widget_post_category" <?php if($enable_bg_pd==true):?> style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);";<?php endif;?>>
				<div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					 <?php endif; ?>
				</div>
				<div class="widget-content">
					<div class="dt-row dt-g-2">
						<?php
							$categories = get_categories( array(
								'orderby' => 'name',
								'order'   => 'ASC'
							) );
							$i=0;
							foreach( $categories as $category ) {
								 $thumbnail_id = get_term_meta( $category->term_id, 'category-image-id', true );
								 $image = wp_get_attachment_url( $thumbnail_id );
								 $newsmunch_cat_article_lbl = get_term_meta( $category->term_id, 'newsmunch_cat_article_lbl', true );
								 $i++;
						?>
						<div class="dt-col-lg-<?php echo esc_attr($col); ?> dt-col-sm-6 dt-col-12">
							<div class="post featured-post-md">
								<div class="details clearfix">
									<h4 class="post-title"><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name ); ?></a></h4>
									<p class="post-number dt-mt-2 dt-mb-0"><?php echo esc_html($category->count); ?></p>
								</div>
								<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
									<div class="thumb">
										<div class="overlay decoration-border"></div>
										<?php if ( $image ) : ?>
											<div class="inner data-bg-image" data-bg-image="<?php echo esc_url($image); ?>"></div>
										<?php else: ?>
											<div class="inner"></div>
										<?php endif; ?>
									</div>
								</a>
							</div>
						</div>
						<?php if($i>(int)$newsmunch_count_posts-1): break; endif; } ?>
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
           

            $newsmunch_count_posts = isset($instance['count-posts']) ? $instance['count-posts'] : '6';
			$enable_bg_pd = isset($instance['enable_bg_pd']) ? $instance['enable_bg_pd'] :true;
         
          

            
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('title', 'Title', 'Popular Category');
				echo parent::newsmunch_generate_select_options('select-column', __('Select Column', 'newsmunch-pro'), newsmunch_widget_crousel_column());
				
                echo parent::newsmunch_generate_text_input('count-posts', __('Number of Category to Show', 'newsmunch-pro'), $newsmunch_count_posts);
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
		$instance['count-posts'] = ( ! empty( $new_instance['count-posts'] ) ) ? $new_instance['count-posts'] : '';
		$instance['select-column'] = ( ! empty( $new_instance['select-column'] ) ) ? $new_instance['select-column'] : '';
		$instance['enable_bg_pd'] = ( ! empty( $new_instance['enable_bg_pd'] ) ) ? $new_instance['enable_bg_pd'] : '';
		
		return $instance;
	}

    }
endif;
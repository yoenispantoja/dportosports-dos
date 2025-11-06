<?php
if (!class_exists('newsmunch_Popular_Tab_Widget')) :
    /**
     * Adds newsmunch_Popular_Tab_Widget widget.
     */
    class newsmunch_Popular_Tab_Widget extends Newsmunch_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsmunch-popular-tab-ttl', 'newsmunch_popular_tab_lttl','newsmunch_popular_tab_pttl','newsmunch_popular_tab_cttl','newsmunch-count-posts');

            $widget_ops = array(
                'classname' => 'newsmunch_popular_tab_widget',
                'description' => __('Displays posts from selected category.', 'newsmunch-pro'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsmunch_popular_tab_widget', __('DT: Popular Tab', 'newsmunch-pro'), $widget_ops);
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
			$tab_id = 'tabbed-' . $this->number;
			$show_excerpt = 'false';
			$excerpt_length = '20';
            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['newsmunch-popular-tab-ttl'], $instance, $this->id_base);
			$number_of_posts = isset($instance['newsmunch-count-posts']) ? $instance['newsmunch-count-posts'] : '5';
            $lttl = isset($instance['newsmunch_popular_tab_lttl']) ? $instance['newsmunch_popular_tab_lttl'] :  __('Recent', 'newsmunch-pro');
			$pttl = isset($instance['newsmunch_popular_tab_pttl']) ? $instance['newsmunch_popular_tab_pttl'] :  __('Popular', 'newsmunch-pro');
			$cttl = isset($instance['newsmunch_popular_tab_cttl']) ? $instance['newsmunch_popular_tab_cttl'] :  __('Comment', 'newsmunch-pro');

            // open the widget container
            echo $args['before_widget'];
            ?>
                <div class="widget-header">
					<?php if (!empty($title)): ?>
						<h4 class="widget-title"><?php echo esc_html($title); ?></h4>
					<?php endif; ?>
                </div>
				<div class="dt_tabs post-tabs">
					<ul class="dt_tabslist" id="postsTab" role="tablist">
						<li role="presentation"><button aria-controls="popular" aria-selected="true" class="nav-link active" data-tab="popular-<?php echo esc_attr($tab_id); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i> <?php echo esc_html($lttl); ?></button></li>
						<li role="presentation"><button aria-controls="trending" aria-selected="false" class="nav-link" data-tab="trending-<?php echo esc_attr($tab_id); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i> <?php echo esc_html($pttl); ?></button></li>
						<li role="presentation"><button aria-controls="recent" aria-selected="false" class="nav-link" data-tab="recent-<?php echo esc_attr($tab_id); ?>" role="tab" type="button"><i class="far fa-clock" aria-hidden="true"></i> <?php echo esc_html($cttl); ?></button></li>
					</ul>
					<div class="tab-content" id="postsTabContent">
						<div class="lds-dual-ring"></div>
						<div aria-labelledby="popular-tab" class="tab-pane fade active show" id="popular-<?php echo esc_attr($tab_id); ?>" role="tabpanel">
							<?php newsmunch_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts); ?>
						</div>
						<div aria-labelledby="trending-tab" class="tab-pane fade" id="trending-<?php echo esc_attr($tab_id); ?>" role="tabpanel">
							<?php newsmunch_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts); ?>
						</div>
						<div aria-labelledby="recent-tab" class="tab-pane fade" id="recent-<?php echo esc_attr($tab_id); ?>" role="tabpanel">
							<?php newsmunch_render_posts('comment', $show_excerpt, $excerpt_length, $number_of_posts); ?>
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
            $newsmunch_count_posts = isset($instance['newsmunch-count-posts']) ? $instance['newsmunch-count-posts'] : '5';
         
          

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsmunch_generate_text_input('newsmunch-popular-tab-ttl', 'Title', 'Popular Posts');
				echo parent::newsmunch_generate_text_input('newsmunch_popular_tab_lttl', 'Recent Post Title', 'Recent');
				echo parent::newsmunch_generate_text_input('newsmunch_popular_tab_pttl', 'Popular Post Title', 'Popular');
				echo parent::newsmunch_generate_text_input('newsmunch_popular_tab_cttl', 'Comment Post Title', 'Comment');

                echo parent::newsmunch_generate_text_input('newsmunch-count-posts', __('Number of Post to Show', 'newsmunch-pro'), $newsmunch_count_posts);

               
            }
            //print_pre($terms);


        }

    }
endif;
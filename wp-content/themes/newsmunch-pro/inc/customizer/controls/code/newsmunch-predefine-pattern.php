<?php
/**
 * NewsMunch
 * Customizer Control: NewsMunch Predefine Pattern
 */
class NewsMunch_Predefine_Pattern_Control extends WP_Customize_Control {
	public $type = 'predefine-pattern';

	   function render_content()
	   
	   {
		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		<?php endif;
		 echo '<div class="newsmunch-predefine-pattern">';
		  $name = '_customize-image-radio-' . $this->id;
		  $i=1;
		  foreach($this->choices as $key => $value ) {
			?>
			   <label>
				<input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr( $name ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" <?php if($this->value() == $key){ echo 'checked'; } ?>>
				<img <?php if($this->value() == $key){ echo 'class="newsmunch_theme_layout_style_active"'; } ?> src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/customizer/controls/images/patterns/<?php echo $value; ?>" alt="<?php echo esc_attr( $value ); ?>" />
				</label>
			<?php 
			if($i==4)
			{
			  echo '<p></p>';
			  $i=0;
			}
			$i++;
			
			} ?>
			</div>
		  <script>
			jQuery(document).ready(function($) {
				$("#customize-control-newsmunch_theme_layout_style label img").click(function(){
					$("#customize-control-newsmunch_theme_layout_style label img").removeClass("newsmunch_theme_layout_style_active");
					$(this).addClass("newsmunch_theme_layout_style_active");
				});
			});
		  </script>
		<?php
	   }
	}
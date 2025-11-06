<?php
/**
 * NewsMunch
 * Customizer Control: NewsMunch Predefine Color
 */
class NewsMunch_Predefine_Color_Control extends WP_Customize_Control {
	public $type = 'predefine-color';

		   function render_content()
		   {
			 if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
			<?php endif; 
		   echo '<div class="newsmunch-predefine-color">';
			  $name = '_customize-color-radio-' . $this->id; 
			  foreach($this->choices as $key => $value ) {
				?>
				   <label>
					<input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr( $name ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" <?php if($this->value() == $key){ echo 'checked'; } ?>>
					<span class="color_select" style="background:<?php echo esc_attr( $value ); ?>"></span>
					</label>
					
				<?php
			  } ?>
			</div>
			  <script>
				jQuery(document).ready(function($) {
					$(".newsmunch-predefine-color label .color_select").click(function(){
						$(".newsmunch-predefine-color label .color_select").removeClass("selected_color");
						$(this).addClass("selected_color");
					});
				});
			  </script>
			  <?php 
		   }

	}
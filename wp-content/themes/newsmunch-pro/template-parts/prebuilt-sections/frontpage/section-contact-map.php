<?php  
$newsmunch_contact_map_link		= get_theme_mod('newsmunch_contact_map_link','https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near');
do_action('newsmunch_contact_map_option_before');
?>	
<div class="dt-row dt-mt-6">
	<div class="dt-col-lg-12">
		<iframe width="100%" height="400" loading="lazy" src="<?php echo esc_url($newsmunch_contact_map_link); ?>"></iframe>
	</div>
</div>
<?php do_action('newsmunch_contact_map_option_after'); ?>
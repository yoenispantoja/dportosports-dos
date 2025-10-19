<?php  
do_action('newsmunch_site_preloader'); 
$newsmunch_hs_hdr 		 = get_theme_mod( 'newsmunch_hs_hdr','1');
$newsmunch_hs_hdr_sticky = get_theme_mod( 'newsmunch_hs_hdr_sticky','1');
?>
<header id="dt_header" class="dt_header header--four menu_active-three">
	<div class="dt_header-inner">
		<?php if($newsmunch_hs_hdr == '1') {  ?>
			<div class="dt_header-topbar dt-d-lg-block dt-d-none">
				<?php do_action('newsmunch_site_header'); ?>
			</div>
		<?php } ?>
		<div class="dt_header-navwrapper">
			<div class="dt_header-navwrapperinner">
				<!--=== / Start: DT_Navbar / === -->
				<div class="dt_navbar dt-d-none dt-d-lg-block">
					<div class="dt_navbar-wrapper <?php if($newsmunch_hs_hdr_sticky=='1'): esc_attr_e('is--sticky','newsalert'); endif; ?>">
						<div class="dt_navbar-inner <?php if ( has_header_image() ) : esc_attr_e('data-bg-image','newsalert'); endif;?>" <?php if ( has_header_image() ) : ?> data-bg-image="<?php echo esc_url( get_header_image()); ?>"<?php endif; ?>>
							<div class="dt-container-md">
								<div class="dt-row">                                        
									<div class="dt-col-md"></div>
									<div class="dt-col-md">
										<div class="site--logo">
											<?php do_action('newsmunch_site_logo'); ?>
										</div>
									</div>
									<div class="dt-col-md"></div>
								</div>
							</div>
						</div>
						<div class="dt_navbar-menus">
							<div class="dt-container-md">
								<div class="dt-row">
									<div class="dt-col-12">										
										<div class="dt_navbar-menu">
											<nav class="dt_navbar-nav">
												<?php
													$newsmunch_hs_hdr_home_icon 	= get_theme_mod( 'newsmunch_hs_hdr_home_icon','1');	
													if($newsmunch_hs_hdr_home_icon == '1') {
												?>
												<span class="dt_home-icon"><a href="<?php echo esc_url(home_url()); ?>" class="nav-link" aria-current="page"><i class="fas fa-home"></i></a></span>
												<?php
													}
													do_action('newsmunch_site_header_navigation'); 
												?>
											</nav>
											<div class="dt_navbar-right">
												<ul class="dt_navbar-list-right">
													<li class="dt_navbar-widget-item">
														<?php do_action('newsmunch_site_social'); ?>
													</li>
													<?php do_action('newsmunch_woo_cart'); ?>
													<?php do_action('newsmunch_site_main_search'); ?>
													<?php do_action('newsmunch_hdr_account'); ?>
													<?php do_action('newsmunch_hdr_subscribe'); ?>
													<?php do_action('newsmunch_dark_light_switcher'); ?>
													<?php do_action('newsmunch_header_button', 'dt-btn-primary'); ?>
													<?php do_action('newsmunch_menu_side_docker'); ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--=== / End: DT_Navbar / === -->
				<!--=== / Start: DT_Mobile Menu / === -->
				<div class="dt_mobilenav dt-d-lg-none">
					<?php if($newsmunch_hs_hdr == '1') {  ?>
						<div class="dt_mobilenav-topbar">
							<button type="button" class="dt_mobilenav-topbar-toggle"><i class="fas fa-angle-double-down" aria-hidden="true"></i></button>
							<div class="dt_mobilenav-topbar-content">
								<div class="dt_header-topbar">
									<?php do_action('newsmunch_site_header'); ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="dt_mobilenav-main <?php if ( has_header_image() ) : esc_attr_e('data-bg-image','newsalert'); endif;?> <?php if($newsmunch_hs_hdr_sticky=='1'): esc_attr_e('is--sticky','newsalert'); endif; ?>" <?php if ( has_header_image() ) : ?> data-bg-image="<?php echo esc_url( get_header_image()); ?>"<?php endif; ?>>
						<div class="dt-container-md">
							<div class="dt-row">
								<div class="dt-col-12">
									<div class="dt_mobilenav-menu">
										<div class="dt_mobilenav-toggles">
											<div class="dt_mobilenav-mainmenu">
												<button type="button" class="hamburger dt_mobilenav-mainmenu-toggle">
													<span></span>
													<span></span>
													<span></span>
												</button>
												<nav class="dt_mobilenav-mainmenu-content">
													<div class="dt_header-closemenu off--layer"></div>
													<div class="dt_mobilenav-mainmenu-inner">
														<button type="button" class="dt_header-closemenu site--close"></button>
														<?php do_action('newsmunch_site_header_navigation'); ?>
													</div>
												</nav>
											</div>
										</div>
										<div class="dt_mobilenav-logo">
											<div class="site--logo">
												<?php do_action('newsmunch_site_logo'); ?>
											</div>
										</div>
										<div class="dt_mobilenav-right">
											<div class="dt_navbar-right">
												<ul class="dt_navbar-list-right">
													<?php do_action('newsmunch_site_main_search'); ?>
													<?php do_action('newsmunch_header_button', 'dt-btn-primary'); ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--=== / End: DT_Mobile Menu / === -->
			</div>
		</div>
	</div>
</header>
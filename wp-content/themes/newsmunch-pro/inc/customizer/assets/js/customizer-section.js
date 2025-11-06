( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['plugin-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );


function newsmunchfrontpagesectionsscroll( newsmunch_section_id ){
    var navigation_id = "dt_slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( newsmunch_section_id ) {
        case 'accordion-section-information_options':
        navigation_id = "dt_service_one";
        break;

        case 'accordion-section-about_options':
        navigation_id = "dt_about";
        break;
		
        case 'accordion-section-service_options':
        navigation_id = "dt_service_two";
        break;
		
		case 'accordion-section-features_options':
        navigation_id = "dt_feature";
        break;
		
		case 'accordion-section-funfact_options':
        navigation_id = "dt_funfact";
        break;
		
		case 'accordion-section-portfolio_options':
        navigation_id = "dt_project";
        break;
		
		case 'accordion-section-protect_options':
        navigation_id = "dt_protect";
        break;
		
		case 'accordion-section-cta_options':
        navigation_id = "dt_cta";
        break;
		
		case 'accordion-section-team_options':
        navigation_id = "dt_teams";
        break;
		
		case 'accordion-section-gallery_options':
        navigation_id = "dt_gallery";
        break;
		
		
		case 'accordion-section-why_choose_options':
        navigation_id = "dt_whychoose";
        break;
		
		case 'accordion-section-offer_options':
        navigation_id = "dt_offering_clients";
        break;
		
		case 'accordion-section-cta2_options':
        navigation_id = "dt_cta_two";
        break;
		
		case 'accordion-section-work_options':
        navigation_id = "dt_process";
        break;
		
		case 'accordion-section-timeline_options':
        navigation_id = "dt_history";
        break;
		
		case 'accordion-section-pricing_options':
        navigation_id = "dt_pricing";
        break;
		
		case 'accordion-section-features2_options':
        navigation_id = "dt_featurelist";
        break;
		
		case 'accordion-section-testimonial_options':
        navigation_id = "dt_testimonials";
        break;
		
		case 'accordion-section-sponsor_options':
        navigation_id = "dt_clients";
        break;
		
		case 'accordion-section-solution_options':
        navigation_id = "dt_solution";
        break;
		
		case 'accordion-section-blog_options':
        navigation_id = "dt_posts";
        break;
		
		case 'accordion-section-product_options':
        navigation_id = "dt_product";
        break;
		
		case 'accordion-section-skill_options':
        navigation_id = "dt_skills";
        break;
		
		case 'accordion-section-ctform_options':
        navigation_id = "dt_contact";
        break;
		
		case 'accordion-section-cta3_options':
        navigation_id = "dt_cta_three";
        break;
		
		case 'accordion-section-map_options':
        navigation_id = "dt_contact_map";
        break;
		
		// case 'accordion-section-job_options':
        // navigation_id = "dt_job";
        // break;
		
		// case 'accordion-section-contact_options':
        // navigation_id = "dt_contact";
        // break;
		
		// case 'accordion-section-ctform_options':
        // navigation_id = "dt_contact_form";
        // break;
		
		// case 'accordion-section-office_options':
        // navigation_id = "dt_contact_office";
        // break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}



 jQuery('body').on('click', '#sub-accordion-panel-newsmunch_frontpage_options .control-subsection .accordion-section-title', function(event) {
        var newsmunch_section_id = jQuery(this).parent('.control-subsection').attr('id');
        newsmunchfrontpagesectionsscroll( newsmunch_section_id );
});
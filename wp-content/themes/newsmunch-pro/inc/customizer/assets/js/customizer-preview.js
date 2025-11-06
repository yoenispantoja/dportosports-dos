/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
     * Outputs custom css for responsive controls
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @param  {[array]} css_prop css property to write
     * @param  {String} ext css value extension eg: px, in
     * @return {[string]} css output
     */
    function range_live_media_load( setting, css_selector, css_prop, ext = '' ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-' + setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';
                        var tablet_css      = '';
                        var mobile_css      = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + desktop_value + ext + ';';

                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var tablet_css      = tablet_css + property_name[1] + ': ' + tablet_value + ext + ';';

                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                            var mobile_css      = mobile_css + property_name[1] + ': ' + mobile_value + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + mobile_css + ' } } @media (min-width: 720px){ ' + selector_name + ' { ' + tablet_css + ' } } @media (min-width: 960px){ ' + selector_name + ' { ' + desktop_css + ' } }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( "head" ).append( head_append );
                        }
                    }
                );
            }
        );
    }
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( 'body header .site--logo .site--title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( 'body header .site--logo .site--description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( 'body header .site--logo .site--title, body header .site--logo .site--description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( 'body header .site--logo .site--title, body header .site--logo .site--description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( 'body header .site--logo .site--title, body header .site--logo .site--description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	$(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.cs-range-value').html(val);
            $(this).val(val);
        });
    })
	
	
	/**
	 * Sidebar width.
	 */
	wp.customize( 'newsmunch_sidebar_width', function( value ) {		
            'use strict';
            value.bind(
                function( to ){
                    var class_name      = 'customizer-sidebar-width'; // Used as id in gfont link
                    var css_class       = $( '.' + class_name );

                    var sidebar_width   = to;
                    var content_width   = ( 100 - to );

                    var head_append     = '<style class="' + class_name + '">@media (min-width: 992px){#dt-main { max-width: ' + sidebar_width + '%;flex-basis: ' + sidebar_width + '%; } #av-primary-content { max-width: ' + content_width + '%;flex-basis: ' + content_width + '%; }}</style>';

                    if ( css_class.length ) {
                        css_class.replaceWith( head_append );
                    } else {
                        $( 'head' ).append( head_append );
                    }
                }
            );
        }
    );
	
	/**
	 * sidebar_wid_ttl_size
	 */
	range_live_media_load( 'sidebar_wid_ttl_size', '.sidebar .widget .widget-title', [ 'font-size' ], 'px' );
	
	/**
	 * hdr_logo_size
	 */
	range_live_media_load( 'hdr_logo_size', '.site--logo img', [ 'max-width' ], 'px !important' );
	
	/**
	 * hdr_site_title_size
	 */
	range_live_media_load( 'hdr_site_title_size', '.site--logo .site--title', [ 'font-size' ], 'px !important' );
	
	/**
	 * hdr_site_desc_size
	 */
	range_live_media_load( 'hdr_site_desc_size', '.site--logo .site--description', [ 'font-size' ], 'px !important' );
	
	//newsmunch_hdr_left_ttl
	wp.customize(
		'newsmunch_hdr_left_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_header-topbar .dt-news-headline .dt-news-heading' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_hdr_top_ads_title
	wp.customize(
		'newsmunch_hdr_top_ads_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_header-topbar .dt-address span' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_hdr_btn_lbl
	wp.customize(
		'newsmunch_hdr_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_navbar-button-item .dt-btn' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_top_tags_ttl
	wp.customize(
		'newsmunch_top_tags_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.exclusive-tags .title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_hlatest_story_ttl
	wp.customize(
		'newsmunch_hlatest_story_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.exclusive-posts .title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_slider_ttl
	wp.customize(
		'newsmunch_slider_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.sl-main .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_slider_mdl_ttl
	wp.customize(
		'newsmunch_slider_mdl_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.sl-mid .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_slider_right_ttl
	wp.customize(
		'newsmunch_slider_right_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.sl-right .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_featured_link_ttl
	wp.customize(
		'newsmunch_featured_link_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.fl-content .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_you_missed_ttl
	wp.customize(
		'newsmunch_you_missed_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.ym-content .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_about_ttl
	wp.customize(
		'newsmunch_about_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-about .widget-header .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_about_subttl
	wp.customize(
		'newsmunch_about_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-about .dt-section-header .dt-section-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_about_text
	wp.customize(
		'newsmunch_about_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-about .dt-section-header .dt-mt-2.dt-mb-0' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_about_btn_lbl
	wp.customize(
		'newsmunch_about_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-about .dt-btn' ).text( newval );
				}
			);
		}
	);
	
	
	//newsmunch_skill_ttl
	wp.customize(
		'newsmunch_skill_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-skill .widget-header .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_skill_subttl
	wp.customize(
		'newsmunch_skill_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-skill .dt-section-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_skill_text
	wp.customize(
		'newsmunch_skill_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-skill .dt-section-header .dt-mt-2.dt-mb-0' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_team_ttl
	wp.customize(
		'newsmunch_team_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-team .widget-header .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_faq_ttl
	wp.customize(
		'newsmunch_faq_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-faq .widget-header .widget-title' ).text( newval );
				}
			);
		}
	);
	
	//newsmunch_contact_form_ttl
	wp.customize(
		'newsmunch_contact_form_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.hm-contact_form .widget-header .widget-title' ).text( newval );
				}
			);
		}
	);
	
	/**
	 * Container Width
	 */
	wp.customize( 'newsmunch_site_container_width', function( value ) {
		
		value.bind( function( newsmunch_site_container_width ) {
			var class_name      = 'newsmunch_site_container_width'; // Used as id in gfont link
			var css_class       = $( '.' + class_name );			
			
			if (newsmunch_site_container_width >= 768 && newsmunch_site_container_width < 2000){
				var head_append     = '<style class="' + class_name + '">.dt-container-md,.dt__slider-main .owl-dots{ max-width: ' + newsmunch_site_container_width + 'px;}</style>';
			}

			if ( css_class.length ) {
				css_class.replaceWith( head_append );
			} else {
				$( 'head' ).append( head_append );
			}
			
		});
		
	} );
	
	/**
	 * Breadcrumb Typography
	 */
	range_live_media_load( 'newsmunch_breadcrumb_title_size', '.page-header h1', [ 'font-size' ], 'px' );
	range_live_media_load( 'newsmunch_breadcrumb_content_size', '.page-header .breadcrumb li', [ 'font-size' ], 'px' );
	
	
	/**
	 * Sidebar width.
	 */
	wp.customize( 'newsmunch_sidebar_width', function( value ) {		
            'use strict';
            value.bind(
                function( to ){
                    var class_name      = 'customizer-sidebar-width'; // Used as id in gfont link
                    var css_class       = $( '.' + class_name );

                    var sidebar_width   = to;
                    var content_width   = ( 100 - to );

                    var head_append     = '<style class="' + class_name + '">@media (min-width: 992px){#dt-sidebar { max-width: ' + sidebar_width + '%;flex-basis: ' + sidebar_width + '%; } #dt-main { max-width: ' + content_width + '%;flex-basis: ' + content_width + '%; }}</style>';

                    if ( css_class.length ) {
                        css_class.replaceWith( head_append );
                    } else {
                        $( 'head' ).append( head_append );
                    }
                }
            );
        }
    );
	
	
	/**
	 * newsmunch_widget_ttl_size
	 */
	range_live_media_load( 'newsmunch_widget_ttl_size', '.widget-header .widget-title', [ 'font-size' ], 'px !important' );
	
	
	/**
	 * Body font family
	 */
	wp.customize( 'newsmunch_body_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'body' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * Body font size
	 */
	
	range_live_media_load( 'newsmunch_body_font_size_option', 'body', [ 'font-size' ], 'px' );
	
	/**
	 * Body Letter Spacing
	 */
	
	range_live_media_load( 'newsmunch_body_ltr_space_option', 'body', [ 'letter-spacing' ], 'px' );
	
	/**
	 * Body font weight
	 */
	wp.customize( 'newsmunch_body_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'body' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * Body font style
	 */
	wp.customize( 'newsmunch_body_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'body' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * Body Text Decoration
	 */
	wp.customize( 'newsmunch_body_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'body, a' ).css( 'text-decoration', decoration );
		} );
	} );
	/**
	 * Body text tranform
	 */
	wp.customize( 'newsmunch_body_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'body' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * newsmunch_body_line_height
	 */
	range_live_media_load( 'newsmunch_body_line_height_option', 'body', [ 'line-height' ] );
	
	/**
	 * H1 font family
	 */
	wp.customize( 'newsmunch_h1_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h1' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H1 font size
	 */
	range_live_media_load( 'newsmunch_h1_font_size_option', 'h1', [ 'font-size' ], 'px' );
	
	/**
	 * H1 font style
	 */
	wp.customize( 'newsmunch_h1_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h1' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H1 Text Decoration
	 */
	wp.customize( 'newsmunch_h1_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h1' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H1 font weight
	 */
	wp.customize( 'newsmunch_h1_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h1' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H1 text tranform
	 */
	wp.customize( 'newsmunch_h1_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h1' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H1 line height
	 */
	range_live_media_load( 'newsmunch_h1_line_height_option', 'h1', [ 'line-height' ] );
	
	/**
	 * H1 Letter Spacing
	 */
	 
	range_live_media_load( 'newsmunch_h1_ltr_space_option', 'h1', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H2 font family
	 */
	wp.customize( 'newsmunch_h2_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h2' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H2 font size
	 */
	range_live_media_load( 'newsmunch_h2_font_size_option', 'h2', [ 'font-size' ], 'px' );
	
	/**
	 * H2 font style
	 */
	wp.customize( 'newsmunch_h2_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h2' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H2 Text Decoration
	 */
	wp.customize( 'newsmunch_h2_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h2' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H2 font weight
	 */
	wp.customize( 'newsmunch_h2_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h2' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H2 text tranform
	 */
	wp.customize( 'newsmunch_h2_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h2' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H2 line height
	 */
	range_live_media_load( 'newsmunch_h2_line_height_option', 'h2', [ 'line-height' ]);
	
	/**
	 * H2 Letter Spacing
	 */
	
	range_live_media_load( 'newsmunch_h2_ltr_space_option', 'h2', [ 'letter-spacing' ], 'px' );
	/**
	 * H3 font family
	 */
	wp.customize( 'newsmunch_h3_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h3' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H3 font size
	 */
	range_live_media_load( 'newsmunch_h3_font_size_option', 'h3', [ 'font-size' ], 'px' );
	
	/**
	 * H3 font style
	 */
	wp.customize( 'newsmunch_h3_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h3' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H3 Text Decoration
	 */
	wp.customize( 'newsmunch_h3_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h3' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H3 font weight
	 */
	wp.customize( 'newsmunch_h3_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h3' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H3 text tranform
	 */
	wp.customize( 'newsmunch_h3_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h3' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H3 line height
	 */
	range_live_media_load( 'newsmunch_h3_line_height_option', 'h3', [ 'line-height' ]);
	
	/**
	 * H3 Letter Spacing
	 */
	
	range_live_media_load( 'newsmunch_h3_ltr_space_option', 'h3', [ 'letter-spacing' ], 'px' );
	
	
	/**
	 * H4 font family
	 */
	wp.customize( 'newsmunch_h4_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h4' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H4 font size
	 */
	range_live_media_load( 'newsmunch_h4_font_size_option', 'h4', [ 'font-size' ], 'px' );
	
	/**
	 * H4 font style
	 */
	wp.customize( 'newsmunch_h4_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h4' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H4 Text Decoration
	 */
	wp.customize( 'newsmunch_h4_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h4' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H4 font weight
	 */
	wp.customize( 'newsmunch_h4_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h4' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H4 text tranform
	 */
	wp.customize( 'newsmunch_h4_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h4' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H4 line height
	 */
	range_live_media_load( 'newsmunch_h4_line_height_option', 'h4', [ 'line-height' ]);
	
	/**
	 * H4 Letter Spacing
	 */
	
		range_live_media_load( 'newsmunch_h4_ltr_space_option', 'h4', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H5 font family
	 */
	wp.customize( 'newsmunch_h5_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h5' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H5 font size
	 */
	range_live_media_load( 'newsmunch_h5_font_size_option', 'h5', [ 'font-size' ], 'px' );
	
	/**
	 * H5 font style
	 */
	wp.customize( 'newsmunch_h5_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h5' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H5 Text Decoration
	 */
	wp.customize( 'newsmunch_h5_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h5' ).css( 'text-decoration', decoration );
		} );
	} );
	
	
	/**
	 * H5 font weight
	 */
	wp.customize( 'newsmunch_h5_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h5' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H5 text tranform
	 */
	wp.customize( 'newsmunch_h5_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h5' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H5 line height
	 */
	range_live_media_load( 'newsmunch_h5_line_height_option', 'h5', [ 'line-height' ]);
	
	/**
	 * H5 Letter Spacing
	 */
	
	range_live_media_load( 'newsmunch_h5_ltr_space_option', 'h5', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H6 font family
	 */
	wp.customize( 'newsmunch_h6_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h6' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H6 font size
	 */
	range_live_media_load( 'newsmunch_h6_font_size_option', 'h6', [ 'font-size' ], 'px' );
	
	/**
	 * H6 font style
	 */
	wp.customize( 'newsmunch_h6_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h6' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H6 Text Decoration
	 */
	wp.customize( 'newsmunch_h6_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h6' ).css( 'text-decoration', decoration );
		} );
	} );
	
	
	/**
	 * H6 font weight
	 */
	wp.customize( 'newsmunch_h6_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h6' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H6 text tranform
	 */
	wp.customize( 'newsmunch_h6_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h6' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H6 line height
	 */
	range_live_media_load( 'newsmunch_h6_line_height_option', 'h6', [ 'line-height' ]);
	
	/**
	 * H6 Letter Spacing
	 */
	
	range_live_media_load( 'newsmunch_h6_ltr_space_option', 'h6', [ 'letter-spacing' ], 'px' );
	
} )( jQuery );
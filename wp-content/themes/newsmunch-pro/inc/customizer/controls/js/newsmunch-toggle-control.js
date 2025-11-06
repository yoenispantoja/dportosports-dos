/**
 * Customizer controls toggles
 *
 * @package NewsMunch
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	NEWSMUNCHControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @since 1.0.0
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'newsmunch-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @since 1.0.0
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'newsmunch-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @since 1.0.0
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'newsmunch-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @since 1.0.0
	 * @class NEWSMUNCHCustomizerToggles
	 */
	NEWSMUNCHCustomizerToggles = {
		
		/**
		 *  newsmunch_header_design
		 */
		// 'newsmunch_header_design' :
		// [
			// {
				// controls: [
					// 'newsmunch_hdr_banner',
					// 'newsmunch_hs_hdr_banner',
					// 'newsmunch_hdr_banner_img',
					// 'newsmunch_hdr_banner_link',
					// 'newsmunch_hdr_banner_target'
				// ],
				// callback: function( newsmunch_header_design ) {

					// var newsmunch_header_design = api( 'newsmunch_header_design' ).get();

					// if ( 'header--four' == newsmunch_header_design || 'header--six' == newsmunch_header_design || 'header--seven' == newsmunch_header_design ) {
						// return true;
					// }
					// return false;
				// }
			// }
		// ],
		
		/**
		 *  newsmunch_enable_post_excerpt
		 */
		'newsmunch_enable_post_excerpt' :
		[
			{
				controls: [
					'newsmunch_post_excerpt_length',
					'newsmunch_blog_excerpt_more',
					'newsmunch_show_post_btn',
					'newsmunch_read_btn_txt',
				],
				callback: function( newsmunch_enable_post_excerpt ) {

					var newsmunch_enable_post_excerpt = api( 'newsmunch_enable_post_excerpt' ).get();

					if ( '1' == newsmunch_enable_post_excerpt ) {
						return true;
					}
					return false;
				}
			}
		],
		
		
		/**
		 *  newsmunch_featured_link_content_type
		 */
		'newsmunch_featured_link_content_type' :
		[
			{
				controls: [
					'newsmunch_featured_link_post_style',
					'newsmunch_featured_link_cat',
					'newsmunch_hs_featured_link_title',
					'newsmunch_hs_featured_link_cat_meta',
					'newsmunch_hs_featured_link_auth_meta',
					'newsmunch_hs_featured_link_date_meta',
					'newsmunch_hs_featured_link_comment_meta',
					'newsmunch_hs_featured_link_views_meta',
					'newsmunch_hs_featured_link_pf_icon'
				],
				callback: function( newsmunch_featured_link_content_type ) {

					var newsmunch_featured_link_content_type = api( 'newsmunch_featured_link_content_type' ).get();

					if ( 'post' == newsmunch_featured_link_content_type ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'newsmunch_featured_link_type',
					'newsmunch_featured_link_custom',
				],
				callback: function( newsmunch_featured_link_content_type ) {

					var newsmunch_featured_link_content_type = api( 'newsmunch_featured_link_content_type' ).get();

					if ( 'category' == newsmunch_featured_link_content_type ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  newsmunch_featured_link_type
		 */
		'newsmunch_featured_link_type' :
		[
			{
				controls: [
					'newsmunch_featured_link_custom',
				],
				callback: function( newsmunch_featured_link_type ) {

					var newsmunch_featured_link_content_type = api( 'newsmunch_featured_link_content_type' ).get();

					if ( 'custom' == newsmunch_featured_link_type && 'post' != newsmunch_featured_link_content_type) {
						return true;
					}
					return false;
				}
			}
		],
		
		
		/**
		 *  newsmunch_footer_style
		 */
		'newsmunch_footer_style' :
		[
			{
				controls: [
					'newsmunch_footer_text_color',
					'newsmunch_footer_bg_color',
				],
				callback: function( newsmunch_footer_style ) {

					var newsmunch_footer_style = api( 'newsmunch_footer_style' ).get();

					if ( 'footer-dark' == newsmunch_footer_style ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  newsmunch_latest_post_type
		 */
		'newsmunch_latest_post_type' :
		[
			{
				controls: [
					'newsmunch_latest_post_column',
				],
				callback: function( newsmunch_latest_post_type ) {

					var newsmunch_latest_post_type = api( 'newsmunch_latest_post_type' ).get();

					if ( 'grid' == newsmunch_latest_post_type ) {
						return true;
					}
					return false;
				}
			}
		],
		
		/**
		 *  newsmunch_post_pagination_type
		 */
		'newsmunch_post_pagination_type' :
		[
			{
				controls: [
					'newsmunch_post_pagination_lm_btn',
				],
				callback: function( newsmunch_post_pagination_type ) {

					var newsmunch_post_pagination_type = api( 'newsmunch_post_pagination_type' ).get();

					if ( 'default' !== newsmunch_post_pagination_type) {
						return true;
					}
					return false;
				}
			}
		],
	};

} )( jQuery );

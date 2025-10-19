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
		
	};

} )( jQuery );

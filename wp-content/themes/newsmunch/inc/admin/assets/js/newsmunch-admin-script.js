( function( $ ){
  $( document ).ready( function(){
    $( '.newsmunch-btn-get-started' ).on( 'click', function( e ) {
        e.preventDefault();
        $( this ).html( 'Processing.. Please wait' ).addClass( 'updating-message' );
        $.post( newsmunch_ajax_object.ajax_url, {
            'action' : 'install_act_plugin',
            'nonce'  : newsmunch_ajax_object.nonce // Include the nonce in the request
        }, function( response ){
            location.href = 'themes.php?page=desert-demo-import';
        } );
    } );
  } );

  $( document ).on( 'click', '.notice-get-started-class .notice-dismiss', function () {
      // Read the "data-notice" information to track which notice
      // is being dismissed and send it via AJAX
      var type = $( this ).closest( '.notice-get-started-class' ).data( 'notice' );
      // Make an AJAX call
      $.ajax( newsmunch_ajax_object.ajax_url,
        {
          type: 'POST',
          data: {
            action: 'newsmunch_dismissed_notice_handler',
            type: type,
            nonce: newsmunch_ajax_object.nonce // Include the nonce in the request
          }
        } );
    } );
}( jQuery ) )
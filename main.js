jQuery( function( $ ) {
  $('#kamar-contact-form').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    $.post( kamar.ajax_url, form.serialize() + '&action=send_contact', function( res ) {
      if ( res.success ) {
        alert( 'تم الإرسال بنجاح' );
        form[0].reset();
      } else {
        alert( 'حدث خطأ' );
      }
    });
  });
});
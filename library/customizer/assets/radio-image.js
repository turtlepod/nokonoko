jQuery(document).ready(function ($) {
	$( ".tmb-radio-image-item input" ).change( function(){
		if( $( this ).is(':checked') ){
			$( this ).parent( '.tmb-radio-image-item' ).siblings( '.tmb-radio-image-item' ).removeClass( 'item-selected' );
			$( this ).parent( '.tmb-radio-image-item' ).addClass( 'item-selected' );
		}
	});
});
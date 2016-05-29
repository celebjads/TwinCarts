(function () {
	jQuery(document).ready(function($) {  
		 
		$('body').delegate(".input_datetime", 'hover', function(e){
	            e.preventDefault();
	            $(this).datepicker({
		               defaultDate: "",
		               dateFormat: "yy-mm-dd",
		               numberOfMonths: 1,
		               showButtonPanel: true,
	            });
         });

		var hides = ['coolstuff_audio_link','coolstuff_link_link','coolstuff_link_text','coolstuff_video_link','coolstuff_gallery_files'];
		var shows = {
			audio:['coolstuff_audio_link'],
			video:['coolstuff_video_link','coolstuff_video_text'],
			link:['coolstuff_link_link'],
			gallery:['coolstuff_gallery_files']	
		}
		$( '.post-type-post #post-formats-select input' ).click( function(){
			 $(hides).each( function( i, item ){
			 	$("[name="+item+']').parent().parent().hide();
			 } );
			 var s = $(this).val();
			 if( shows[s] != null ){
			 	$(shows[s]).each( function( i, is ){
			 		$("[name="+is+']').parent().parent().show();
				 } );
			 }
		} );
	});	
} )( jQuery );
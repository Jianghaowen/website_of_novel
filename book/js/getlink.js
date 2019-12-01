jQuery(document).ready(function () {
	jQuery('.read').click( function () {
		jQuery(this).attr('href',function(){
			return jQuery('.mchapter li:first a').attr('href');
		});
	});
	jQuery('.chaps').click( function () {
		jQuery(this).attr('href',function(){
			return jQuery('.chapters .page-top h2 a').attr('href');
		});
	});
});
jQuery(document).ready( function () { 
	jQuery( '.menu li' ).hover( 
		function () { 
			jQuery( this ).find( 'ul:first' ).css( { "visibility":"visible", "display":"block" } )
		},
		function () {
			jQuery( this ).find('ul:first').css( { "visibility":"hidden"} )
		}
	);
} );
jQuery(document).ready( function () { 
	jQuery("#s").focus(
		function(){
				   jQuery("#s").css("background",'white');
				   jQuery("#s").val("");
							   
		}
	);
	 jQuery("#s").blur(
		function(){
				   jQuery("#s").css("color",'#aaa');	
	});
	 jQuery("#s").keydown(
		function(){
				   jQuery("#s").css("color",'#333');
	 });
	});
jQuery(document).ready( function () { 
	jQuery( '.shuping' ).hover( 
		function () { 
			jQuery( this ).find( 'a:first' ).attr("target","_blank");
		} );
} );
jQuery(document).ready( function () { 
	jQuery(".bianhua3").focus(
		function(){
				   jQuery(".bianhua2").css("display","none");
				   jQuery(".bianhua").css("display","block");
				   jQuery(".bianhua3").css("color","black");
				   jQuery(".bianhua5").css("color","#666");				   
   });
    jQuery(".bianhua5").focus(
		function(){
				   jQuery(".bianhua").css("display","none");
				   jQuery(".bianhua2").css("display","block");
				   jQuery(".bianhua5").css("color","black");
                   jQuery(".bianhua3").css("color","#666");
               				   
   });   
	});
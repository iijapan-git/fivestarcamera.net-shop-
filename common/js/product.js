(function($){
	$(function(){

		var slider = $('#bxslider ul').bxSlider({
			pagerCustom: '#bxpager',
			controls: false,
			mode: "fade",
			speed: 200,
		});

		if ($('#productslider').length) {
			// $("#productslider a[rel^='lightbox']").prettyPhoto({
			// 	animation_speed: 300,
			// 	theme: 'pp_default', /* theme: 'pp_default', light_rounded / dark_rounded / light_square / dark_square / facebook */
			// 	slideshow: 3000, 
			// 	default_width: 1000,
			// 	default_height: 666,
			// 	horizontal_padding: 0,
			// 	autoplay_slideshow: false,
			// 	overlay_gallery: false,
			// 	social_tools: false,
			// 	show_title: false
			// });
			$("#productslider  a[rel^='lightbox']").magnificPopup({
				type: 'image',
				gallery: {enabled:true}
			});
		}

	});

})(jQuery);
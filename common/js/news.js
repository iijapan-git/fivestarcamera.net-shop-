$(document).ready(function() {
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 300,
		theme: 'pp_default', /* theme: 'pp_default', light_rounded / dark_rounded / light_square / dark_square / facebook */
		slideshow: 3000, 
		default_width: 840,
		default_height: 540,
		horizontal_padding: 0, /* The padding on each side of the picture */
		autoplay_slideshow: false,
		overlay_gallery: false,
		social_tools: false,
		show_title: false /* true/false */
	});
});
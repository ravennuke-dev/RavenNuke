$(function(){
	var $container = $("#IBblock-center");
	$(window).resize(function(){
		$container.masonry({
			itemSelector: ".IBinfosection",
			isAnimated: true,
			columnWidth: $container.width() / 7,
			gutterWidth: $container.width() / 40
		});
	}).resize();
});
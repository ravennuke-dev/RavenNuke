$(document).ready(function() {
	// margin corrections for ie7 in table based themes
	if(jQuery.support.inlineBlockNeedsLayout) {
		$(window).resize(function(){
			if ($('.ul-box-center').length) {
				var width = $(".ul-box-center").width();
				} else {
				var width = $(".ol-box-center").width();
			}
			var newWidth = width / 40;
			$("td .ul-box-center ul.rn-ul li.li-first,td .ul-box-center ul.rn-ul li.li-even,td .ul-box-center ul.rn-ul li.li-odd,td .ol-box-center ol.rn-ol li.li-first,td .ol-box-center ol.rn-ol li.li-odd,td .ol-box-center ol.rn-ol li.li-even,td .ul-box-center ul.rn-list li.rn-list,td .ul-box-center ul.ul-head li,td td ul.nukeNAV-center li,td .ul-box-center.block-modules ul.rn-ul li,td .ul-box-center.block-random_headlines img.centered,td .ul-box-center.block-random_headlines ul.rn-ul li").css("marginLeft",newWidth+"px");
		}).resize();
	}
});
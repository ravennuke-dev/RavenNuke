	$(document).ready(function(){
		$(".colorbox").colorbox({opacity:0.65, current:"{current} of {total}"});
		$(".colorboxSEO").colorbox({opacity:0.50, width:"750", height:"300", iframe:true});
		$("#IByesnewpm").colorbox({inline:true, open:true, href:"#IBnewmessages" });
		$(".IBGuestsModal").colorbox({ width: "630px", inline:true, href:"#IBGuestsView" });
		$(".IBmodal").colorbox({opacity:0.50, width:"80%", height:"80%", iframe:true});
	});
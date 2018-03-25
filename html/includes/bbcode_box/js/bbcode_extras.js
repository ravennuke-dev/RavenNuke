$(document).ready(function(){
	$(".spoilbutton").click(function() {
		$(this).next('div.spoildiv').slideToggle();
		$(this).hide();
		});
});

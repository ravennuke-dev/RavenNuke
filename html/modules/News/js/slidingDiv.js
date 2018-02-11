function Moreinfo(){
$("#slidingDiv1").animate({"height": "toggle"}, { duration: 300 });
}
function Rateinfo(){
$("#slidingDiv2").animate({"height": "toggle"}, { duration: 300 });
}
function Bminfo(){
$("#slidingDiv3").animate({"height": "toggle"}, { duration: 300 });
}
function Qreply(){
$("#slidingDiv4").animate({"height": "toggle"}, { duration: 300 });
}
function selectAllText(textbox) {
    textbox.focus();
    textbox.select();
}
jQuery("#goourl").click(function() { selectAllText(jQuery(this)) });

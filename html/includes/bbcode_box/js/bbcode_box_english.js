var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;

var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

var baseHeight = 0;

abbcb_help = " Bold: [b]text[/b]";
abbci_help = " Italic: [i]text[/i]";
abbcu_help = " Underline: [u]text[/u]";
abbcquote_help = " Quote: [quote]text[/quote]";
abbccode_help = " Code: [code]code[/code]";
abbcspoil_help = " Spoiler: [spoil]text[/spoil]";
abbcimg_help = " Insert Image: [img]http://image path[/img]";
abbcurl_help = " Insert URL: [url]http://www.site.com[/url] or [url=http://www.site.com]site[/url]";
abbcfc_help = " Font Color: [color=red]text[/color] You can use HTML color=#FF0000";
abbcrtl_help = " Make message box align from Right to Left";
abbcltr_help = " Make message box align from Left to Right";
abbcmail_help = " Insert Email: [email]loki@myemail.com[/email]";
abbcright_help=" Set text align to right: [align=right]text[/align]";
abbcleft_help=" Set text align to left: [align=left]text[/align]";
abbccenter_help=" Set text align to center: [align=center]text[/align]";
abbcjustify_help=" Justify text: [align=justify]text[/align]";
abbcstream_help=" Insert stream file: [stream]File URL[/stream]";
abbchr_help=" Insert Line Break: [hr]";
abbcvideo_help=" Insert video file: [video width=# height=#]file URL[/video]";
abbcflash_help=" Insert flash file: [flash width=# height=#]flash URL[/flash]";
abbclist_help = " Ordered list: [list|=1|a]text[/list] Tip: you can use [*] to insert bullet";
abbcstrike_help = " Strike text: [s]text[/s]";
abbcsup_help = " Superscript: [sup]text[/sup]";
abbcsub_help = " Subscript: [sub]text[/sub]";
abbcxfirevideo_help = " xFire Video [xfirevideo]http://www.xfire.com/video/4facce/[/xfirevideo]";
abbcwiki_help = " Wikipedia Search: [wiki]search term[/wiki]";
abbcduck_help = " DuckDuckGo Search: [duck]search term[/duck]";
abbcfloatL_help = " Image Left: [imgleft]img url[/imgleft]";
abbcfloatR_help = " Image Right: [imgright]img url[/imgright]";
abbctags_help = " Search Term/Tag: [tag]one single term[/tag]";
abbctwitter_help = " Dynamic Twitter Sig: [twitter]username[/twitter]";
abbcfontcolor_help = " Show/Hide Font Color Selection";
abbcfontface_help = " Show/Hide Font Family and Custom Class Selection";
abbcfontsize_help = " Show/Hide Font Size Selection";
abbcgeneral_help = " Show/Hide General Settings";
abbcshowall_help = " Show/Hide Main Toolbars";
abbcsmiles_help = ' Add emoticons/smilies to your post';
abbchelphex_help = ' Use a custom hex color code, or use the picker to the left';
abbchelpcolor_help = ' Help and Tips regarding use of the [color] bbcode';
abbchelpcodepre_help = ' Help and Tips regarding use of the [code][/code] and [pre=php][/pre] bbcode';
abbchelpclasses_help = ' Help and Tips regarding Fonts and the use of the [class=\"yourclass\"][/class] bbcode';
abbchelpyoutube_help = ' Help and Tips regarding use of the [youtube=\"video\"][/youtube] bbcode';
abbchelparchive_help = ' Help and Tips regarding use of the [archive=\"video\"][/archive] bbcode';
abbclaunchpik_help = ' Launch the Color Picker';

var abbcQuote = 0;
var abbcBold  = 0;
var abbcItalic = 0;
var abbcUnderline = 0;
var abbcBasicCode = 0;
var abbcCode = 0;
var abbccenter = 0;
var abbcright = 0;
var abbcleft = 0;
var abbcjustify = 0;
var abbcList = 0;
var abbcStrikeout = 0;
var abbcSpoiler = 0;
var abbcsuperscript = 0;
var abbcsubscript = 0;
var abbcemotional = 0;
var abbccolors = 0;
var abbcfontface = 0;
var abbcswatches = 0;
var abbcfonthelps = 0;
var abbccolorhelps = 0;
var abbcvidhelps = 0;
var abbctubehelps = 0;
var abbccodehelps = 0;

// help functions
function helpline(help) {
	document.post.helpbox.value = eval(help + "_help");
	document.post.helpbox.readOnly = "true";
}

function customhelpline() {
	var enterCOLOR = document.post.fc.value;
	document.post.helpbox.value = " Custom Color: [color=#"+enterCOLOR+"]text[/color]";
	document.post.helpbox.readOnly = "true";
}

function customclassline() {
	var enterCLASS = document.post.customclass.value;
	document.post.helpbox.value = " CSS Class: [class=\""+enterCLASS+"\"]text[/class]";
	document.post.helpbox.readOnly = "true";
}

function youtubeline() {
	var enterSIZE = document.post.utubes.value;
	var enterPOS = document.post.utubesposition.value;
	document.post.helpbox.value = " [youtube=\""+enterSIZE+enterPOS+"\"]http://www.youtube.com/watch?v=brfDU6HyWs8[/youtube]";
	document.post.helpbox.readOnly = "true";
}

function archiveline() {
	var archSIZE = document.post.arctype.value;
	var archPOS = document.post.arcposition.value;
	document.post.helpbox.value = " [archive=\""+archSIZE+archPOS+"\"]http://archive.org/details/night_of_the_living_dead[/archive]";
	document.post.helpbox.readOnly = "true";
}

function classline(theclass) {
	document.post.helpbox.value = " CSS Class: [class=\""+theclass+"\"]text[/class]";
	document.post.helpbox.readOnly = "true";
}

function codehelpline() {
	var codehelp = document.post.codetypes.value;
	if (codehelp == "code") {
		document.post.helpbox.value = " generic code: [code]your code here[/code]";
		document.post.helpbox.readOnly = "true";
	} else {
		document.post.helpbox.value = codehelp+" code: [pre="+codehelp+"]your "+codehelp+" code here[/pre]";
		document.post.helpbox.readOnly = "true";
	}

}

// Fix a bug involving the TextRange object in IE. From
// http://www.frostjedi.com/terra/scripts/demo/caretBug.html
// (script by TerraFrost modified by reddog)
function initInsertions() {
	document.post.message.focus();
	if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
}


function BBChr() {
	ToAdd = "[hr]";
	PostWrite(ToAdd);
}

function BBCstream() {
	var FoundErrors = '';
	var enterURL   = prompt("Please write stream file URL","http://");
	if (!enterURL) {
		FoundErrors += " You didn't write the file URL.";
	}
	if (FoundErrors) {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[stream]"+enterURL+"[/stream]";
	PostWrite(ToAdd);
}

function BBCvideo() {
	var FoundErrors = '';
	var enterURL   = prompt("Please Enter the video file URL", "http://");
	if (!enterURL)    {
		FoundErrors += " You didn't write the file URL.";
	}
		var enterW   = prompt("Enter the video file width", "400");
	if (!enterW)    {
		FoundErrors += " You didn't enter the video file width.";
	}
	var enterH   = prompt("Enter the video file height", "350");
	if (!enterH)    {
		FoundErrors += " You didn't enter the video file height.";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[video width="+enterW+" height="+enterH+"]"+enterURL+"[/video]";
	PostWrite(ToAdd);
}


function BBCmail() {
	var FoundErrors = '';
	var entermail   = prompt("Enter the Email Address","");
	if (!entermail) {
		FoundErrors += " You didn't write the Email Address.";
	}
	if (FoundErrors) {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[email]"+entermail+"[/email]";
	PostWrite(ToAdd);
}

function BBCstrike() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[s]" + theSelection + "[/s]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[s]", "[/s]");
		return;
	}
	if (abbcStrikeout == 0) {
		ToAdd = "[s]";
		document.getElementById('abbcstrik').className='postimage bbc-active';
		abbcStrikeout = 1;
	} else {
		ToAdd = "[/s]";
		document.getElementById('abbcstrik').className='postimage bbc-inactive';
		abbcStrikeout = 0;
	}
	PostWrite(ToAdd);
}

function BBCspoil() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[spoil]" + theSelection + "[/spoil]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[spoil]", "[/spoil]");
		return;
	}
	if (abbcSpoiler == 0) {
		ToAdd = "[spoil]";
		document.getElementById('abbcspoil').className='postimage bbc-active';
		abbcSpoiler = 1;
	} else {
		ToAdd = "[/spoil]";
		document.getElementById('abbcspoil').className='postimage bbc-inactive';
		abbcSpoiler = 0;
	}
	PostWrite(ToAdd);
}

function BBCdir(dirc) {
	if (dirc == 'ltr') {
		document.getElementById('abbcdirltr').className='postimage bbc-active';
		document.getElementById('abbcdirrtl').className='postimage bbc-inactive';
	} else {
		document.getElementById('abbcdirltr').className='postimage bbc-inactive';
		document.getElementById('abbcdirrtl').className='postimage bbc-active';
	}
	document.post.message.dir=(dirc);
}

function BBCjustify() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=justify]", "[/align]");
		return;
	}
	if (abbcjustify == 0) {
		ToAdd = "[align=justify]";
		document.getElementById('abbcjustify').className='postimage bbc-active';
		abbcjustify = 1;
	} else {
		ToAdd = "[/align]";
		document.getElementById('abbcjustify').className='postimage bbc-inactive';
		abbcjustify = 0;
	}
	PostWrite(ToAdd);
}

function BBCleft() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=left]", "[/align]");
		return;
	}
	if (abbcleft == 0) {
		ToAdd = "[align=left]";
		document.getElementById('abbcleft').className='postimage bbc-active';
		abbcleft = 1;
	} else {
		ToAdd = "[/align]";
		document.getElementById('abbcleft').className='postimage bbc-inactive';
		abbcleft = 0;
	}
	PostWrite(ToAdd);
}

function BBCright() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=right]", "[/align]");
		return;
	}
	if (abbcright == 0) {
		ToAdd = "[align=right]";
		document.getElementById('abbcright').className='postimage bbc-active';
		abbcright = 1;
	} else {
		ToAdd = "[/align]";
		document.getElementById('abbcright').className='postimage bbc-inactive';
		abbcright = 0;
	}
	PostWrite(ToAdd);
}

function BBCcenter() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=center]", "[/align]");
		return;
	}
	if (abbccenter == 0) {
		ToAdd = "[align=center]";
		document.getElementById('abbccenter').className='postimage bbc-active';
		abbccenter = 1;
	} else {
		ToAdd = "[/align]";
		document.getElementById('abbccenter').className='postimage bbc-inactive';
		abbccenter = 0;
	}
	PostWrite(ToAdd);
}

function BBCpicker() {
	var txtarea = document.post.message;
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[color=#"+document.post.fc.value+"]" + theSelection + "[/color]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[color=#"+document.post.fc.value+"]", "[/color]");
		return;
	}
	if (abbccolors == 0) {
		ToAdd = "[color=#"+document.post.fc.value+"]";
		document.getElementById('abbchole').className='xcolor bbc-active';
		abbccolors = 1;
	} else {
		ToAdd = "[/color]";
		document.getElementById('abbchole').className='xcolor bbc-inactive';
		abbccolors = 0;
	}
	PostWrite(ToAdd);
}

function BBCflash() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the flash file URL", "http://");
	if (!enterURL)    {
		FoundErrors += " You didn't write the flash file URL.";
	}
	var enterW   = prompt("Enter the flash width", "250");
	if (!enterW)    {
		FoundErrors += " You didn't write the flash width.";
	}
	var enterH   = prompt("Enter the flash height", "250");
	if (!enterH)    {
		FoundErrors += " You didn't write the flash height.";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[flash width="+enterW+" height="+enterH+"]"+enterURL+"[/flash]";
	PostWrite(ToAdd);
}

function BBCInternetArchive() {
	var FoundErrors = '';
	var enterTYPE = document.post.arctype.value;
	if (enterTYPE=="none")  {
		alert("Error: Please select embed type first");
		return;
	}
	var enterURL   = prompt("Enter the movie URL", "http://");
	var ccount = enterURL.length;
	if (!enterURL) {
		FoundErrors += "You didn't write the file URL";
	}
	else if (ccount<8) {
		FoundErrors += "You didn't write the file URL";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[archive=\""+document.post.arctype.value+document.post.arcposition.value+"\"]"+enterURL+"[/archive]";
	PostWrite(ToAdd);
}

function BBCyoutube() {
	var FoundErrors = '';
	var enterTYPE = document.post.utubes.value;
	if (enterTYPE=="none")  {
		alert("Error: Please select size first");
		return;
	}
	var enterURL   = prompt("Enter the movie URL", "http://");
	var ccount = enterURL.length;
	if (!enterURL) {
		FoundErrors += "You didn't write the file URL";
	}
	else if (ccount<8) {
		FoundErrors += "You didn't write the file URL";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[youtube=\""+document.post.utubes.value+document.post.utubesposition.value+"\"]"+enterURL+"[/youtube]";
	PostWrite(ToAdd);
}

function BBCxfire() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the movie URL", "http://");
	var ccount = enterURL.length;
	if (!enterURL) {
		FoundErrors += "You didn't write the file URL";
	}
	else if (ccount<8) {
		FoundErrors += "You didn't write the file URL";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[xfirevideo]"+enterURL+"[/xfirevideo]";
	PostWrite(ToAdd);
}


function checkForm() {
	formErrors = false;    
	if (document.post.message.value.length < 2) {
		formErrors = "You must enter a message when posting";
	}
	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

function emoticon(text) {
	var ToAdd = ' ' + text + ' ';
	PostWrite(ToAdd);
}

function bbfontstyle(bbopen, bbclose) {
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (!theSelection) {
			txtarea.value += bbopen + bbclose;
			txtarea.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		txtarea.focus();
		return;
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, bbopen, bbclose);
		return;
	}
	else
	{
		txtarea.value += bbopen + bbclose;
		txtarea.focus();
	}
	storeCaret(txtarea);
}

function PostWrite(text) {
	//Get textArea HTML control 
	var txtArea = document.post.message;
	
	//IE
	if (document.selection) {
		txtArea.focus();
		var sel = document.selection.createRange();
		sel.text = text;
		return;
	}
	//Firefox, chrome, mozilla
	else if (txtArea.selectionStart || txtArea.selectionStart == '0') {
		var startPos = txtArea.selectionStart;
		var endPos = txtArea.selectionEnd;
		var scrollTop = txtArea.scrollTop;
		txtArea.value = txtArea.value.substring(0, startPos) + text + txtArea.value.substring(endPos, txtArea.value.length);
		txtArea.focus();
		txtArea.selectionStart = startPos + text.length;
		txtArea.selectionEnd = startPos + text.length;
	}
	else {
		txtArea.value += textArea.value;
		txtArea.focus();
	}
}

function BBCsup() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[sup]" + theSelection + "[/sup]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[sup]", "[/sup]");
		return;
	}
	if (abbcsuperscript == 0) {
		ToAdd = "[sup]";
		document.getElementById('abbcsupscript').className='postimage bbc-active';
		abbcsuperscript = 1;
	} else {
		ToAdd = "[/sup]";
		document.getElementById('abbcsupscript').className='postimage bbc-inactive';
		abbcsuperscript = 0;
	}
	PostWrite(ToAdd);
}

function BBCsub() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[sub]" + theSelection + "[/sub]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[sub]", "[/sub]");
		return;
	}
	if (abbcsubscript == 0) {
		ToAdd = "[sub]";
		document.getElementById('abbcsubs').className='postimage bbc-active';
		abbcsubscript = 1;
	} else {
		ToAdd = "[/sub]";
		document.getElementById('abbcsubs').className='postimage bbc-inactive';
		abbcsubscript = 0;
	}
	PostWrite(ToAdd);
}

function BBCbasiccode() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[code]" + theSelection + "[/code]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[code]", "[/code]");
		return;
	}	
	if (abbcBasicCode == 0) {
		ToAdd = "[code]";
		document.getElementById('abbccode').className='postimage bbc-active';
		abbcBasicCode = 1;
	} else {
		ToAdd = "[/code]";
		document.getElementById('abbccode').className='postimage bbc-inactive';
		abbcBasicCode = 0;
	}
	PostWrite(ToAdd);
}

function BBCcode() {
	var txtarea = document.post.message;
	var codetype = document.post.codetypes.value;
	if (codetype == "code") {
		bbtype = "code";
		bbtype2 = "code";
	} else {
		bbtype = "pre="+codetype;
		bbtype2 = "pre";
	}
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "["+bbtype+"]" + theSelection + "[/"+bbtype2+"]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "["+bbtype+"]", "[/"+bbtype2+"]");
		return;
	}	
	if (abbcCode == 0) {
		ToAdd = "["+bbtype+"]";
		document.getElementById('abbccode2').className='postimage bbc-active';
		abbcCode = 1;
	} else {
		ToAdd = "[/"+bbtype2+"]";
		document.getElementById('abbccode2').className='postimage bbc-inactive';
		abbcCode = 0;
	}
	PostWrite(ToAdd);
}

function BBCquote() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[quote]", "[/quote]");
		return;
	}
	if (abbcQuote == 0) {
		ToAdd = "[quote]";
		document.getElementById('abbcquote').className='postimage bbc-active';
		abbcQuote = 1;
	} else {
		ToAdd = "[/quote]";
		document.getElementById('abbcquote').className='postimage bbc-inactive';
		abbcQuote = 0;
	}
	PostWrite(ToAdd);
}

function BBClist() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[list]" + theSelection + "[/list]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[list]", "[/list]");
		return;
	}
	if (abbcList == 0) {
		ToAdd = "[list]";
		document.getElementById('abbclistdf').className='postimage bbc-active';
		abbcList = 1;
	} else {
		ToAdd = "[/list]";
		document.getElementById('abbclistdf').className='postimage bbc-inactive';
		abbcList = 0;
	}
	PostWrite(ToAdd);
}

function BBCbold() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[b]" + theSelection + "[/b]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[b]", "[/b]");
		return;
	}
	if (abbcBold == 0) {
		ToAdd = "[b]";
		document.getElementById('abbcbold').className='postimage bbc-active';
		abbcBold = 1;
	} else {
		ToAdd = "[/b]";
		document.getElementById('abbcbold').className='postimage bbc-inactive';
		abbcBold = 0;
	}
	PostWrite(ToAdd);
}

function BBCitalic() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[i]" + theSelection + "[/i]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[i]", "[/i]");
		return;
	}
	if (abbcItalic == 0) {
		ToAdd = "[i]";
		document.getElementById('abbcitalic').className='postimage bbc-active';
		abbcItalic = 1;
	} else {
		ToAdd = "[/i]";
		document.getElementById('abbcitalic').className='postimage bbc-inactive';
		abbcItalic = 0;
	}
	PostWrite(ToAdd);
}

function BBCunder() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[u]" + theSelection + "[/u]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[u]", "[/u]");
		return;
	}
	if (abbcUnderline == 0) {
		ToAdd = "[u]";
		document.getElementById('abbcunder').className='postimage bbc-active';
		abbcUnderline = 1;
	} else {
		ToAdd = "[/u]";
		document.getElementById('abbcunder').className='postimage bbc-inactive';
		abbcUnderline = 0;
	}
	PostWrite(ToAdd);
}

function BBCfloatleft() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the image URL","http://");
	var ccount = enterURL.length;
	if (!enterURL) {
		FoundErrors += "You didn't write the image URL";
	}
	else if (ccount<8) {
		FoundErrors += "You didn't write the image URL";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[imgleft]"+enterURL+"[/imgleft]";
	PostWrite(ToAdd);
}

function BBCfloatright() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the image URL","http://");
	var ccount = enterURL.length;
	if (!enterURL) {
		FoundErrors += "You didn't write the image URL";
	}
	else if (ccount<8) {
		FoundErrors += "You didn't write the image URL";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[imgright]"+enterURL+"[/imgright]";
	PostWrite(ToAdd);
}

function BBCurl() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the URL", "http://");
	var enterTITLE = prompt("Enter the page name", "Web Page Name");
	if (!enterURL)    {
		FoundErrors += " You didn't write the URL.";
	}
	if (!enterTITLE)  {
		FoundErrors += " You didn't write the page name.";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
	PostWrite(ToAdd);
}

function BBCimg() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the image URL","http://");
	var ccount = enterURL.length;
	if (!enterURL) {
		FoundErrors += "You didn't write the image URL";
	}
	else if (ccount<8) {
		FoundErrors += "You didn't write the image URL";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[img]"+enterURL+"[/img]";
	PostWrite(ToAdd);
}

function BBCwiki() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter a Wikipedia Search Term","");
	if (!enterURL) {
		FoundErrors += "You didn't enter a Wikipedia Search Term";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[wiki]"+enterURL+"[/wiki]";
	PostWrite(ToAdd);
}

function BBCtags() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter a Search Term/Tag","");
	if (!enterURL) {
		FoundErrors += "You didn't enter a Search Term/Tag";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[tag]"+enterURL+"[/tag]";
	PostWrite(ToAdd);
}

function BBCduck() {
	var FoundErrors = '';
	var enterURL   = prompt("DuckDuckGo Search","");
	if (!enterURL) {
		FoundErrors += "You didn't enter a Search Term";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[duck]"+enterURL+"[/duck]";
	PostWrite(ToAdd);
}

function BBCtwitter() {
	var FoundErrors = '';
	var enterURL   = prompt("Twitter Username","");
	if (!enterURL) {
		FoundErrors += "You didn't enter a Twitter Username";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[twitter]"+enterURL+"[/twitter]";
	PostWrite(ToAdd);
}

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function mozWrap(txtarea, open, close)
{
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd == 1 || selEnd == 2) 
		selEnd = selLength;

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + open + s2 + close + s3;
	return;
}



function BBCswatches(setclass) {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[class=\"" + setclass + "\"]" + theSelection + "[/class]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[class=\"" + setclass + "\"]", "[/class]");
		return;
	}
	if (abbcswatches == 0) {
		ToAdd = "[class=\"" + setclass + "\"]";
		document.getElementById('abbc' + setclass).className='postcolor bbc-active bg-'+setclass;
		abbcswatches = 1;
	} else {
		ToAdd = "[/class]";
		document.getElementById('abbc' + setclass).className='postcolor bbc-inactive bg-'+setclass;
		abbcswatches = 0;
	}
	PostWrite(ToAdd);
}

function BBCfamily(setclass,baseclass) {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[class=\"" + setclass + "\"]" + theSelection + "[/class]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[class=\"" + setclass + "\"]", "[/class]");
		return;
	}
	if (abbcfontface == 0) {
		ToAdd = "[class=\"" + setclass + "\"]";
		document.getElementById('abbc' + setclass).className=baseclass + ' bbc-active';
		abbcfontface = 1;
	} else {
		ToAdd = "[/class]";
		document.getElementById('abbc' + setclass).className=baseclass + ' bbc-inactive';
		abbcfontface = 0;
	}
	PostWrite(ToAdd);
}

function BBCyourclass() {
	var txtarea = document.post.message;
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[class=\""+document.post.customclass.value+"\"]" + theSelection + "[/class]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[class=\""+document.post.customclass.value+"\"]", "[/class]");
		return;
	}
	if (abbccolors == 0) {
		ToAdd = "[class=\""+document.post.customclass.value+"\"]";
		document.getElementById('insertcustomclass').className='postfonts bbc-active';
		abbccolors = 1;
	} else {
		ToAdd = "[/class]";
		document.getElementById('insertcustomclass').className='postfonts bbc-inactive';
		abbccolors = 0;
	}
	PostWrite(ToAdd);
}

function BBCcodetype(){
	$("#codestatus").slideToggle('slow', function() {
	$("#abbccode").toggleClass('bbc-active');
  });
}

function BBCarchivetype(){
	$("#archivestatus").slideToggle('slow', function() {
	//$("#abbcsettings").toggleClass('bbc-active');
  });
}

function BBCutubesize(){
	$("#youtubestatus").slideToggle('slow', function() {
	//$("#abbcsettings").toggleClass('bbc-active');
  });
}

function BBCstatusdefault(){
	$("#defaultstatus").slideToggle('slow', function() {
	$("#abbcsettings").toggleClass('bbc-active');
  });
}

function BBCstatuscolor(){
	$("#colorstatus").slideToggle('slow', function() {
	$("#abbcfontcolor").toggleClass('bbc-active');
  });
}

function BBCfontfacestatus(){
	$("#fontfacestatus,#fontfacestatus2").slideToggle('slow');
	$("#abbcfontface").toggleClass('bbc-active');
}

function BBCfontsizestatus(){
	$("#fontsizestatus").slideToggle('slow', function() {
	$("#abbcfontsize").toggleClass('bbc-active');
  });
}

function BBCemostatus(){
shouldscroll=isScrolledIntoView("#emocontainer");
	$("#emostatus").slideToggle('slow', function() {
	$("#abbcsmiles").toggleClass('bbc-active');
	if (abbcemotional == 0) {
		if (shouldscroll) {
			abbcemotional = 1;
			//alert(shouldscroll);
		} else {
			$('html, body').animate({scrollTop: $("#message").offset().top}, 2000);
			abbcemotional = 1;
			//alert(shouldscroll);
		}
	} else {
		abbcemotional = 0;
	}
  });
}

function BBCcodehelpstatus(){
	if (abbccodehelps == 0) {
		$('#helpcodeclass').hide();
		$('#helpcodeload').show();
		$('#codehelpstatus').load('modules.php?name=Forums&file=faq&mode=bbcode #faq16', function() {
			$('#helpcodeload').hide();
			$('#helpcodeclass').show();
			$("#codehelpstatus").slideToggle("slow");
		});
		abbccodehelps = 1;
	} else {
		$("#codehelpstatus").slideToggle("slow");
		abbccodehelps = 0;
	}
	
}

function BBCfonthelpstatus(){
	if (abbcfonthelps == 0) {
		$('#helpcustomclass').hide();
		$('#helpcustomload').show();
		$('#fonthelpstatus').load('modules.php?name=Forums&file=faq&mode=bbcode #faq11', function() {
			$('#helpcustomload').hide();
			$('#helpcustomclass').show();
			$("#fonthelpstatus").slideToggle("slow");
		});
		abbcfonthelps = 1;
	} else {
		$("#fonthelpstatus").slideToggle("slow");
		abbcfonthelps = 0;
	}
	
}

function BBCclickloader(target,container){
	$('#helpcustomclass,#helpcodeclass,#helpcolorclass,#helpvidclass,#helputube').hide();
	$('#helpcustomload,#helpcodeload,#helpcolorload,#helpvidload,#helputubeload').show();
	$('#'+container+'').load('modules.php?name=Forums&file=faq&mode=bbcode #'+target, function() {
		$('#helpcustomload,#helpcodeload,#helpcolorload,#helpvidload,#helputubeload').hide();
		$('#helpcustomclass,#helpcodeclass,#helpcolorclass,#helpvidclass,#helputube').show();
	});
}

function BBCcolorhelpstatus(){
	if (abbccolorhelps == 0) {
		$('#helpcolorclass').hide();
		$('#helpcolorload').show();
		$('#colorhelpstatus').load('modules.php?name=Forums&file=faq&mode=bbcode #faq15', function() {
			$('#helpcolorload').hide();
			$('#helpcolorclass').show();
			$("#colorhelpstatus").slideToggle("slow");
		});
		abbccolorhelps = 1;
	} else {
		$("#colorhelpstatus").slideToggle("slow");
		abbccolorhelps = 0;
	}
	
}


function BBCvidhelpstatus(){
	if (abbcvidhelps == 0) {
		$('#helpvidclass').hide();
		$('#helpvidload').show();
		$('#vidhelpstatus').load('modules.php?name=Forums&file=faq&mode=bbcode #faq14', function() {
			$('#helpvidload').hide();
			$('#helpvidclass').show();
			if (abbctubehelps == 0) {
				$("#vidhelpstatus").slideToggle("slow");
			}
		});
		abbcvidhelps = 1;
	} else {
		$("#vidhelpstatus").slideToggle("slow");
		abbcvidhelps = 0;
		abbctubehelps = 0;
	}
	
}

function BBCtubestatus(){
	if (abbctubehelps == 0) {
		$('#helputube').hide();
		$('#helputubeload').show();
		$('#vidhelpstatus').load('modules.php?name=Forums&file=faq&mode=bbcode #faq13', function() {
			$('#helputubeload').hide();
			$('#helputube').show();
			if (abbcvidhelps == 0) {
				$("#vidhelpstatus").slideToggle("slow");
			}
		});
		abbctubehelps = 1;
	} else {
		$("#vidhelpstatus").slideToggle("slow");
		abbcvidhelps = 0;
		abbctubehelps = 0;
	}
}

function BBCallbars(){
	$('#colorstatus,#fontfacestatus,#fontsizestatus,#fontfacestatus2').slideToggle('slow');
	$("#abbcexpand,#abbcfontface,#abbcfontsize,#abbcfontcolor").toggleClass('bbc-active');
}

function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
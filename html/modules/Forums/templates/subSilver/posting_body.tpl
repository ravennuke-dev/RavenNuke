<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>
{POST_PREVIEW_BOX}
{ERROR_BOX}
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>
<!-- BEGIN switch_parent_link -->
-> <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
<!-- END switch_parent_link -->
<!-- BEGIN switch_not_privmsg -->
&raquo; <a href="{U_VIEW_FORUM}" title="{FORUM_NAME}">{FORUM_NAME}</a>
<!-- END switch_not_privmsg -->
</td>
</tr>
</table>
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">{L_POST_A}</th>
</tr>
<!--
//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== vRN2.5.2 ======================================================== |
//====
-->
<!-- BEGIN switch_username_select -->
<tr>
<td colspan="2" class="row1"><label for="username">{L_USERNAME}</label><input type="text" class="post" tabindex="1" name="username" id="username" size="25" maxlength="25" value="{USERNAME}" />
</td>
</tr>
<!-- END switch_username_select -->
<!-- BEGIN switch_privmsg -->
<tr>
<td colspan="2" class="row1"><label for="username">{L_USERNAME}</label><input type="text"  class="post" name="username" id="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" />
&nbsp; <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="button" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
</td>
</tr>
<!-- END switch_privmsg -->
<tr>
<td colspan="2" class="row1"><label for="subject">{L_SUBJECT}</label><input type="text" name="subject" id="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
</td>
</tr>
<tr>
<td colspan="2" class="row1" valign="top">
<table id="posttable" width="100%" cellspacing="0" cellpadding="0">
<tr valign="middle"> 
<td align="center">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td class="box-background abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcjustify" onclick="BBCjustify()" onmouseover="helpline('abbcjustify')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcleft" onclick="BBCleft()" onmouseover="helpline('abbcleft')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbccenter" onclick="BBCcenter()" onmouseover="helpline('abbccenter')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcright" onclick="BBCright()" onmouseover="helpline('abbcright')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcsupscript" onclick="BBCsup()" onmouseover="helpline('abbcsup')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcsubs" onclick="BBCsub()" onmouseover="helpline('abbcsub')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcfontcolor" onclick="BBCstatuscolor()" onmouseover="helpline('abbcfontcolor')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcfontsize" onclick="BBCfontsizestatus()" onmouseover="helpline('abbcfontsize')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcfontface" onclick="BBCfontfacestatus()" onmouseover="helpline('abbcfontface')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcbold" onclick="BBCbold()" onmouseover="helpline('abbcb')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcitalic" onclick="BBCitalic()" onmouseover="helpline('abbci')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcunder" onclick="BBCunder()" onmouseover="helpline('abbcu')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcstrik" onclick="BBCstrike()" onmouseover="helpline('abbcstrike')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbccode" onclick="{S_ABBC_CODETYPE}()" onmouseover="helpline('abbccode')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcquote" onclick="BBCquote()" onmouseover="helpline('abbcquote')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbclistdf" onclick="BBClist()" onmouseover="helpline('abbclist')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbchr" onclick="BBChr()" onmouseover="helpline('abbchr')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcsettings" onclick="BBCstatusdefault()" onmouseover="helpline('abbcgeneral')" alt="" />
</td>
</tr>
<tr>
<td class="box-background abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcfloatL" onclick="BBCfloatleft()" onmouseover="helpline('abbcfloatL')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcimg" onclick="BBCimg()" onmouseover="helpline('abbcimg')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcfloatR" onclick="BBCfloatright()" onmouseover="helpline('abbcfloatR')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcurl" onclick="BBCurl()" onmouseover="helpline('abbcurl')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcemail" onclick="BBCmail()" onmouseover="helpline('abbcmail')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcflash" onclick="BBCflash()" onmouseover="helpline('abbcflash')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcvideo" onclick="BBCvideo()" onmouseover="helpline('abbcvideo')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcstream" onclick="BBCstream()" onmouseover="helpline('abbcstream')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcspoil" onclick="BBCspoil()" onmouseover="helpline('abbcspoil')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcarchive" onclick="BBCarchivetype()" onmouseover="archiveline()" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcyoutube" onclick="BBCutubesize()" onmouseover="youtubeline()" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcxfirevideo" onclick="BBCxfire()" onmouseover="helpline('abbcxfirevideo')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcwiki" onclick="BBCwiki()" onmouseover="helpline('abbcwiki')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcduck" onclick="BBCduck()" onmouseover="helpline('abbcduck')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbctags" onclick="BBCtags()" onmouseover="helpline('abbctags')" alt="" />
<div class="postimage bbc-inactive" id="abbcsmiles" onclick="BBCemostatus()" onmouseover="helpline('abbcsmiles')"><img class="abbcshim" src="includes/bbcode_box/images/icon_rolleyes.gif" alt="" /></div>
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcexpand" onclick="BBCallbars()" onmouseover="helpline('abbcshowall')" alt="" />
</td>
</tr>
<tr>
<td class="box-background optionbox">
<div id="archivestatus" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<div class="box-select"><select id="arctype" name="arctype" onchange="archiveline()">
<option value="none">Choose Type</option>
<option value="video-small">Video Small</option>
<option value="video" selected="selected">Video Default</option>
<option value="video-medium">Video Medium</option>
<option value="video-large">Video Large</option>
<option value="audio">Audio</option>
</select></div>
<div class="box-select"><select id="arcposition" name="arcposition" onchange="archiveline()">
<option value="">Default</option>
<option value="-left">Left</option>
<option value="-center" selected="selected">Center</option>
<option value="-right">Right</option>
</select></div>
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcarchive2" onclick="BBCInternetArchive()" onmouseover="archiveline()" alt="" />
<div class="posthelps bbc-inactive" onclick="BBCvidhelpstatus()" onmouseover="helpline('abbchelparchive')"><div class="posthelps bbc-inactive" id="helpvidclass"></div><div class="posthelps2" id="helpvidload"><img src="includes/bbcode_box/images/helpload.gif" alt="" /></div></div>
</div>
<div id="youtubestatus" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<div class="box-select"><select id="utubes" name="utubes" onchange="youtubeline()">
<option value="none">Choose Size</option>
<option value="video-small">Video Small</option>
<option value="video" selected="selected">Video Default</option>
<option value="video-medium">Video Medium</option>
<option value="video-large">Video Large</option>
</select></div>
<div class="box-select"><select id="utubesposition" name="utubesposition" onchange="youtubeline()">
<option value="">Default</option>
<option value="-left">Left</option>
<option value="-center" selected="selected">Center</option>
<option value="-right">Right</option>
</select></div>
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcyoutube2" onclick="BBCyoutube()" onmouseover="youtubeline()" alt="" />
<div class="posthelps bbc-inactive" onclick="BBCtubestatus()" onmouseover="helpline('abbchelpyoutube')"><div class="posthelps bbc-inactive" id="helputube"></div><div class="posthelps2" id="helputubeload"><img src="includes/bbcode_box/images/helpload.gif" alt="" /></div></div>
</div>
<div id="vidhelpstatus" class="abbchelpbars"><img src="includes/bbcode_box/images/helpload.png" alt="" /></div>
<div id="defaultstatus" class="abbctoolbars">
<img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbcdirrtl" onclick="BBCdir('rtl')" onmouseover="helpline('abbcrtl')" alt="" />
<img src="images/transparent.gif" class="postimage bbc-active" id="abbcdirltr" onclick="BBCdir('ltr')" onmouseover="helpline('abbcltr')" alt="" />
<div class="boardstatus"> {HTML_STATUS} </div><div class="boardstatus"> {BBCODE_STATUS} </div><div class="boardstatus"> {SMILIES_STATUS} </div><div class="boardstatus"> ABBC Box for RavenNuke v2.5 </div>
</div>
<div id="codestatus" class="abbctoolbars">
<img src="images/transparent.gif" class="box-dots" alt="" />
<div class="box-select"><select id="codetypes" name="codetypes" onchange="codehelpline()">
<optgroup label="Common Languages">
<option value="code" selected="selected">generic</option>
<option value="apache">apache</option>
<option value="css">css</option>
<option value="html">html</option>
<option value="javascript">javascript</option>
<option value="php">php</option>
<option value="sql">sql</option>
<option value="xml">xml</option>
</optgroup>
<optgroup label="Additional Languages">
<option value="bash">bash</option>
<option value="cs">c#</option>
<option value="cpp">c++</option>
<option value="diff">diff</option>
<option value="ini">ini</option>
<option value="java">java</option>
<option value="perl">perl</option>
<option value="python">python</option>
<option value="ruby">ruby</option>
</optgroup>
</select></div>
<img src="images/transparent.gif" class="postimage bbc-inactive" id="abbccode2" onclick="BBCcode()" onmouseover="codehelpline()" alt="" />
<div class="posthelps bbc-inactive" onclick="BBCcodehelpstatus()" onmouseover="helpline('abbchelpcodepre')"><div class="posthelps bbc-inactive" id="helpcodeclass"></div><div class="posthelps2" id="helpcodeload"><img src="includes/bbcode_box/images/helpload.gif" alt="" /></div></div>
</div>

<div id="codehelpstatus" class="abbchelpbars"><img src="includes/bbcode_box/images/helpload.png" alt="" /></div>

<div id="fontfacestatus" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbcarialblack" onclick="BBCfamily('arialblack','postfonts')" onmouseover="classline('arialblack')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbccenturygothic" onclick="BBCfamily('centurygothic','postfonts')" onmouseover="classline('centurygothic')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbccomicsans" onclick="BBCfamily('comicsans','postfonts')" onmouseover="classline('comicsans')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbccouriernew" onclick="BBCfamily('couriernew','postfonts')" onmouseover="classline('couriernew')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbcgeorgia" onclick="BBCfamily('georgia','postfonts')" onmouseover="classline('georgia')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbcimpact" onclick="BBCfamily('impact','postfonts')" onmouseover="classline('impact')" alt="" />
<input class="specialclass" name="customclass" id="customclass" value="uppercase" />
</div>
<div id="fontfacestatus2" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbclucidac" onclick="BBCfamily('lucidac','postfonts')" onmouseover="classline('lucidac')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbclucidau" onclick="BBCfamily('lucidau','postfonts')" onmouseover="classline('lucidau')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbcpalatino" onclick="BBCfamily('palatino','postfonts')" onmouseover="classline('palatino')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbctahoma" onclick="BBCfamily('tahoma','postfonts')" onmouseover="classline('tahoma')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbctrebuchet" onclick="BBCfamily('trebuchet','postfonts')" onmouseover="classline('trebuchet')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="abbcverdana" onclick="BBCfamily('verdana','postfonts')" onmouseover="classline('verdana')" alt="" />
<img src="images/transparent.gif" class="postfonts bbc-inactive" id="insertcustomclass" onclick="BBCyourclass()" onmouseover="customclassline()" alt="" />
<div class="posthelps bbc-inactive" onclick="BBCfonthelpstatus()" onmouseover="helpline('abbchelpclasses')"><div class="posthelps bbc-inactive" id="helpcustomclass"></div><div class="posthelps2" id="helpcustomload"><img src="includes/bbcode_box/images/helpload.gif" alt="" /></div></div>
</div>

<div id="fonthelpstatus" class="abbchelpbars"><img src="includes/bbcode_box/images/helpload.png" alt="" /></div>

<div id="colorstatus" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color1" id="abbccolor1" onclick="BBCswatches('color1')" onmouseover="classline('color1')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color2" id="abbccolor2" onclick="BBCswatches('color2')" onmouseover="classline('color2')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color3" id="abbccolor3" onclick="BBCswatches('color3')" onmouseover="classline('color3')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color4" id="abbccolor4" onclick="BBCswatches('color4')" onmouseover="classline('color4')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color5" id="abbccolor5" onclick="BBCswatches('color5')" onmouseover="classline('color5')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color6" id="abbccolor6" onclick="BBCswatches('color6')" onmouseover="classline('color6')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color7" id="abbccolor7" onclick="BBCswatches('color7')" onmouseover="classline('color7')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color8" id="abbccolor8" onclick="BBCswatches('color8')" onmouseover="classline('color8')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color9" id="abbccolor9" onclick="BBCswatches('color9')" onmouseover="classline('color9')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color10" id="abbccolor10" onclick="BBCswatches('color10')" onmouseover="classline('color10')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color11" id="abbccolor11" onclick="BBCswatches('color11')" onmouseover="classline('color11')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color12" id="abbccolor12" onclick="BBCswatches('color12')" onmouseover="classline('color12')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color13" id="abbccolor13" onclick="BBCswatches('color13')" onmouseover="classline('color13')" alt="" />
<img src="images/transparent.gif" class="postcolor bbc-inactive bg-color14" id="abbccolor14" onclick="BBCswatches('color14')" onmouseover="classline('color14')" alt="" />
<img src="images/transparent.gif" class="box-blackdot" alt="" />
<img src="images/transparent.gif" class="xcolor" name="abbchole" id="abbchole" onclick="BBCpicker()" onmouseover="customhelpline()" alt="" />
<input readonly="readonly" class="color {valueElement:'fc',styleElement:'abbchole',pickerClosable:true}" value="" name="abbcpicker" id="abbcpicker" onmouseover="helpline('abbclaunchpik')" />
<input class="nocolor" name="fc" id="fc" value="2F8187" onmouseover="helpline('abbchelphex')" />
<div class="posthelps bbc-inactive" onclick="BBCcolorhelpstatus()" onmouseover="helpline('abbchelpcolor')"><div class="posthelps bbc-inactive" id="helpcolorclass"></div><div class="posthelps2" id="helpcolorload"><img src="includes/bbcode_box/images/helpload.gif" alt="" /></div></div>
</div>
<div id="colorhelpstatus" class="abbchelpbars"><img src="includes/bbcode_box/images/helpload.png" alt="" /></div>

<div id="fontsizestatus" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbcsmall-caps" onclick="BBCfamily('small-caps','postsizes')" onmouseover="classline('small-caps')" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbcsmall" onclick="BBCfamily('small','postsizes')" onmouseover="classline('small')" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbcnormal" onclick="BBCfamily('normal','postsizes')" onmouseover="classline('normal')" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbclarge" onclick="BBCfamily('large','postsizes')" onmouseover="classline('large')" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbcx-large" onclick="BBCfamily('x-large','postsizes')" onmouseover="classline('x-large')" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbcsmaller" onclick="BBCfamily('smaller','postsizes')" onmouseover="classline('smaller')" alt="" />
<img src="images/transparent.gif" class="postsizes bbc-inactive" id="abbclarger" onclick="BBCfamily('larger','postsizes')" onmouseover="classline('larger')" alt="" />
</div>
</td>
</tr>
</table>
</td>
</tr>
<tr> 
<td class="box-background abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<input type="text" name="helpbox" size="45" maxlength="100" class="abbchelpline thehelpbox" value="{L_STYLES_TIP}" />
</td>
</tr>
<tr> 
<td class="messageback">
<textarea name="message" id="message" rows="15" cols="35" tabindex="3" class="abbcmessage" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea>
</td>
</tr>
<tr> 
<td class="box-background optionbox" id="emocontainer">
<div id="emostatus" class="abbctoolbars"><img src="images/transparent.gif" class="box-dots" alt="" />
<!-- BEGIN smilies_row -->
<!-- BEGIN smilies_col -->
<a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" class="abbcemos" /></a>
<!-- END smilies_col -->
<!-- END smilies_row -->
<!-- BEGIN switch_smilies_extra -->
<div class="boardstatus"> <a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', 'phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=300');return false;" target="phpbbsmilies">{L_MORE_SMILIES}</a> </div>
<!-- END switch_smilies_extra -->
</div>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="2" class="row1" valign="top">
<table cellspacing="0" cellpadding="1" border="0">
<!-- BEGIN switch_html_checkbox -->
<tr>
<td>
<input type="checkbox" id="disable_html" name="disable_html" {S_HTML_CHECKED} />
</td>
<td><label for="disable_html">{L_DISABLE_HTML}</label></td>
</tr>
<!-- END switch_html_checkbox -->
<!-- BEGIN switch_bbcode_checkbox -->
<tr>
<td>
<input type="checkbox" id="disable_bbcode" name="disable_bbcode" {S_BBCODE_CHECKED} />
</td>
<td><label for="disable_bbcode">{L_DISABLE_BBCODE}</label></td>
</tr>
<!-- END switch_bbcode_checkbox -->
<!-- BEGIN switch_smilies_checkbox -->
<tr>
<td>
<input type="checkbox" id="disable_smilies" name="disable_smilies" {S_SMILIES_CHECKED} />
</td>
<td><label for="disable_smilies">{L_DISABLE_SMILIES}</label></td>
</tr>
<!-- END switch_smilies_checkbox -->
<!-- BEGIN switch_signature_checkbox -->
<tr>
<td>
<input type="checkbox" id="attach_sig" name="attach_sig" {S_SIGNATURE_CHECKED} />
</td>
<td><label for="attach_sig">{L_ATTACH_SIGNATURE}</label></td>
</tr>
<!-- END switch_signature_checkbox -->
<!-- BEGIN switch_notify_checkbox -->
<tr>
<td>
<input type="checkbox" id="notify" name="notify" {S_NOTIFY_CHECKED} />
</td>
<td><label for="notify">{L_NOTIFY_ON_REPLY}</label></td>
</tr>
<!-- END switch_notify_checkbox -->
<!-- BEGIN switch_delete_checkbox -->
<tr>
<td>
<input type="checkbox" id="delete" name="delete" />
</td>
<td><label for="delete">{L_DELETE_POST}</label></td>
</tr>
<!-- END switch_delete_checkbox -->
<!-- BEGIN switch_type_toggle -->
<tr>
<td></td>
<td><strong>{S_TYPE_TOGGLE}</strong></td>
</tr>
<!-- END switch_type_toggle -->
</table>
</td>
</tr>
<!--
//====
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |
-->
{ATTACHBOX}
{POLLBOX}
<tr>
<td class="cat" colspan="2" align="center" height="28">{S_HIDDEN_FORM_FIELDS}
<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />
&nbsp;&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
</td>
</tr>
</table>
</form>
{TOPIC_REVIEW_BOX}
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>
<!-- BEGIN switch_parent_link -->
-> <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
<!-- END switch_parent_link -->
<!-- BEGIN switch_not_privmsg -->
&raquo; <a href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
<!-- END switch_not_privmsg -->
</td>
</tr>
</table>
<br clear="all" />
<div align="left">{JUMPBOX}</div>

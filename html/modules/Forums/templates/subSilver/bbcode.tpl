<!-- BEGIN ulist_open --><ul><!-- END ulist_open -->
<!-- BEGIN ulist_close --></ul><!-- END ulist_close -->

<!-- BEGIN olist_open --><ol type="{LIST_TYPE}"><!-- END olist_open -->
<!-- BEGIN olist_close --></ol><!-- END olist_close -->

<!-- BEGIN listitem --><li><!-- END listitem -->

<!-- BEGIN quote_username_open --><table class="quotetable">
<tr>
<td><span class="uppercase">{USERNAME} {L_WROTE}:
<script>
   var id = 'SXBB' + (1000 + Math.floor(Math.random() * 5000));
   SXBB[id] = new _SXBB(id);
   SXBB[id].T['select'] = '{L_SELECT}';
   SXBB[id].T['expand'] = '{L_EXPAND}';
   SXBB[id].T['contract'] = '{L_CONTRACT}';
   SXBB[id].writeCmd();
</script>
      </span></td>
   </tr>
   <tr>
     <td>
<script>
   SXBB[id].writeDiv();
</script><!-- END quote_username_open --> 
<!-- BEGIN quote_open --><table class="quotetable">
<tr>
<td><span class="uppercase">{L_QUOTE}:
<script>
   var id = 'SXBB' + (1000 + Math.floor(Math.random() * 5000));
   SXBB[id] = new _SXBB(id);
   SXBB[id].T['select'] = '{L_SELECT}';
   SXBB[id].T['expand'] = '{L_EXPAND}';
   SXBB[id].T['contract'] = '{L_CONTRACT}';
   SXBB[id].writeCmd();
</script>
      </span></td>
   </tr>
   <tr>
     <td>
<script>
   SXBB[id].writeDiv();
</script><!-- END quote_open --> 
<!-- BEGIN quote_close -->
<script>
   document.write('<\/div>');
</script>
      </td>
</tr>
</table><!-- END quote_close -->

<!-- BEGIN code_open --><table class="codetable">
<tr>
<td><span class="uppercase">{L_CODE}:<script>
   var id = 'SXBB' + (1000 + Math.floor(Math.random() * 5000));
   SXBB[id] = new _SXBB(id);
   SXBB[id].T['select'] = '{L_SELECT}';
   SXBB[id].T['expand'] = '{L_EXPAND}';
   SXBB[id].T['contract'] = '{L_CONTRACT}';
   SXBB[id].writeCmd();
</script></span><script>SXBB[id].writeDiv();</script><pre><code class="codestyle"><!-- END code_open -->
<!-- BEGIN code_close --></code></pre><script>document.write('<\/div>');</script></td>
</tr>
</table><!-- END code_close -->

<!-- BEGIN pre_open --><table class="codetable">
<tr>
<td><span class="uppercase">{PRECLASS} {ITS_CODE}:<script>
   var id = 'SXBB' + (1000 + Math.floor(Math.random() * 5000));
   SXBB[id] = new _SXBB(id);
   SXBB[id].T['select'] = '{L_SELECT}';
   SXBB[id].T['expand'] = '{L_EXPAND}';
   SXBB[id].T['contract'] = '{L_CONTRACT}';
   SXBB[id].writeCmd();
</script></span><script>SXBB[id].writeDiv();</script><pre class="language-{PRECLASS}"><code class="codestyle"><!-- END pre_open -->
<!-- BEGIN pre_close --></code></pre><script>document.write('<\/div>');</script></td>
</tr>
</table><!-- END pre_close -->

<!-- BEGIN b_open --><span class="thick"><!-- END b_open -->
<!-- BEGIN b_close --></span><!-- END b_close -->
<!-- BEGIN u_open --><span class="underline"><!-- END u_open -->
<!-- BEGIN u_close --></span><!-- END u_close -->
<!-- BEGIN i_open --><span class="italic"><!-- END i_open -->
<!-- BEGIN i_close --></span><!-- END i_close -->
<!-- BEGIN color_open --><span style="color:{COLOR}"><!-- END color_open -->
<!-- BEGIN color_close --></span><!-- END color_close -->
<!-- BEGIN size_open --><span style="font-size:{SIZE}px; line-height:normal"><!-- END size_open -->
<!-- BEGIN size_close --></span><!-- END size_close -->
<!-- BEGIN img --><img src="{URL}" alt="Image" title="Image" /><!-- END img -->

<!-- BEGIN search --><a class="postlink ficon ftags" href="modules.php?name=Forums&amp;file=search&amp;search_keywords={KEYWORD}&amp;mode=results">{STRING}</a><!-- END search -->
<!-- BEGIN left --><img src="{URL}" class="float-left forum-img-left" alt="" /><!-- END left -->
<!-- BEGIN right --><img src="{URL}" class="float-right forum-img-right" alt="" /><!-- END right -->
<!-- BEGIN url --><a class="postlink" href="{URL}" target="_blank">{DESCRIPTION}</a><!-- END url -->
<!-- BEGIN email --><a class="postlink ficon femail" href="mailto:{EMAIL}">{EMAIL}</a><!-- END email -->
<!-- BEGIN duck --><a class="postlink duck ficon" href="http://duckduckgo.com/?q={QUERY}" target="_blank">{STRING}</a><!-- END duck -->
<!-- BEGIN wiki --><a class="postlink wiki ficon IBmodal" href="http://{WIKI}.wikipedia.org/wiki/Special:Search/{QUERY}" rel="{WIKI}.wikipedia" title="{STRING}" target="_blank">{STRING}</a><!-- END wiki -->
<!-- BEGIN wiki_default --><a class="postlink wiki-en ficon IBmodal" href="http://en.wikipedia.org/wiki/Special:Search/{QUERY}" rel="en.wikipedia" title="{STRING}" target="_blank">{STRING}</a><!-- END wiki_default -->
<!-- BEGIN twitter_last -->
<!--<a class="postlink ftweet ficon" href="http://twitter.com/{USERNAME}">{USERNAME}</a>
<div class="tweets tw{USERID}"><img src="mods/bbcode_box/images/76.png" alt=""/></div>
<script>
$(document).ready(function(){
    if ( typeof y{USERID} == "undefined" ) {
		y{USERID} = 0;
		n{USERID} = $("div.tweets.tw{USERID}").length;
    }
	if (n{USERID}<2) {
		$.getJSON("http://twitter.com/statuses/user_timeline/{USERNAME}.json?callback=?", function(data) {
		$(".tweets.tw{USERID}").html(ify.clean(data[0].text));
		});
	}
	else if (y{USERID}==0){
		$.getJSON("http://twitter.com/statuses/user_timeline/{USERNAME}.json?callback=?", function(data) {
		$(".tweets.tw{USERID}").html(ify.clean(data[0].text));
		});
	++y{USERID};
	}
});
</script>-->
<!-- END twitter_last -->
<!-- BEGIN s_open --><span class="line-through"><!-- END s_open -->
<!-- BEGIN s_close --></span><!-- END s_close -->

<!-- BEGIN sup_open --><sup><!-- END sup_open -->
<!-- BEGIN sup_close --></sup><!-- END sup_close -->

<!-- BEGIN sub_open --><sub><!-- END sub_open -->
<!-- BEGIN sub_close --></sub><!-- END sub_close -->

<!-- BEGIN spoil_open -->
    <button type="button" class="spoilbutton">{L_BBCODEBOX_VIEW}</button>
    <div class="spoildiv" style="display: none;">
<!-- END spoil_open -->
<!-- BEGIN spoil_close --></div><!-- END spoil_close -->

<!-- BEGIN align_open --><div class="text-{ALIGN}"><!-- END align_open -->
<!-- BEGIN align_close --></div><!-- END align_close -->

<!-- BEGIN font_open --><span style="font-family:{FONT}"><!-- END font_open --> 
<!-- BEGIN font_close --></span><!-- END font_close --> 

<!-- BEGIN class_open --><span class="{FONTCLASS}"><!-- END class_open --> 
<!-- BEGIN class_close --></span><!-- END class_close -->

<!-- BEGIN flash --><!-- URL's used in the movie-->
<!-- text used in the movie--> 
<!-- --> 
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH={WIDTH} HEIGHT={HEIGHT}> 
<PARAM NAME=movie VALUE="{URL}"><PARAM NAME=quality VALUE=high> <PARAM NAME=scale VALUE=noborder> <PARAM NAME=wmode VALUE=transparent> <PARAM NAME=bgcolor VALUE=#000000> 
  <EMBED src="{URL}" quality=high scale=noborder wmode=transparent bgcolor=#000000 WIDTH={WIDTH} HEIGHT={HEIGHT} TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
</EMBED></OBJECT><!-- END flash --> 

<!-- BEGIN archive -->
<div class="forumvideo {ARCHIVETYPE}"><iframe src="http://www.archive.org/embed/{ARCHIVEID}" frameborder="0" allowfullscreen></iframe>
<div class="forumvideotagline"><a class="postlink iarchive ficon" href="http://www.archive.org/details/{ARCHIVEID}" target="_blank">{ARCHIVEID}</a></div></div>
<!-- END archive -->

<!-- BEGIN youtube -->
<div class="forumvideo video"><iframe src="https://www.youtube.com/embed/{YOUTUBEID}" frameborder="0" allowfullscreen></iframe>
<div class="forumvideotagline"><a class="postlink youtu ficon" href="https://youtu.be/{YOUTUBEID}" target="_blank">youtu.be/{YOUTUBEID}</a></div></div>
<!-- END youtube -->

<!-- BEGIN newtube -->
<div class="forumvideo {NEWTUBESIZE}"><iframe src="https://www.youtube.com/embed/{NEWTUBEID}" frameborder="0" allowfullscreen></iframe>
<div class="forumvideotagline"><a class="postlink youtu ficon" href="https://youtu.be/{NEWTUBEID}" target="_blank">youtu.be/{NEWTUBEID}</a></div></div>
<!-- END newtube -->

<!-- BEGIN xfirevideo -->
<object width="405" height="344"><embed src="http://media.xfire.com/swf/embedplayer.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="405" height="344" flashvars="videoid={XFIREID}"></embed></object>
<br />
<a class="postlink xfire ficon" href="http://www.xfire.com/video/{XFIREID}/" target="_blank">www.xfire.com/video/{XFIREID}/</a><br />
<!-- END xfirevideo -->

<!-- BEGIN stream --><object id="wmp" width=300 height=70 classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95"
codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,0,0"
standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject">
<param name="FileName" value="{URL}">
<param name="ShowControls" value="1">
<param name="ShowDisplay" value="0">
<param name="ShowStatusBar" value="1">
<param name="AutoSize" value="1">
<param name="autoplay" value="0">
<embed type="application/x-mplayer2"
pluginspage="http://www.microsoft.com/windows95/downloads/contents/wurecommended/s_wufeatured/mediaplayer/default.asp"
src="{URL}" name=MediaPlayer2 showcontrols=1 showdisplay=0 showstatusbar=1 autosize=1 autoplay=0 visible=1 animationatstart=0 transparentatstart=1 loop=0 height=70 width=300>
</embed>
</object><!-- END stream -->

<!-- BEGIN video -->
<div><embed src="{URL}" autoplay="false" width={WIDTH} height={HEIGHT}></embed></div>
<!-- END video -->

<!-- BEGIN hr --><hr class="fobar" /><!-- END hr -->
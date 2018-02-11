<?php
/*  Content Plus for RavenNuke(tm): /index.php
 *  Copyright 2004 - 2009 Jonathan Estrella <jestrella04@gmail.com>
 *	Join me at http://slaytanic.sourceforge.net
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *  MA 02110-1301, USA.
 */

if (!defined('MODULE_FILE')) { die ('You can\'t access this file directly...'); }
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = '- '.$module_name;

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}
// END: Added in v2.40.00 - Mantis Issue 0001043

define('IN_CPM', true);
require_once('modules/'.$module_name.'/var/cpfunc.php');

if (isset($_GET['pa'])) {$pa = $_GET['pa'];} else {$pa = '';}
if (isset($_GET['cid'])) {$cid = $_GET['cid'];} else {$cid = '';}
if (isset($_GET['pid'])) {$pid = $_GET['pid'];} else {$pid = '';}
if (isset($_GET['tag'])) {$tag = $_GET['tag'];} else {$tag = '';}
if (isset($_GET['tags'])) {$tags = $_GET['tags'];} else {$tags = '';}
if (isset($_GET['order'])) {$order = $_GET['order'];} else {$order = '';}

/* New pagination system by Vecchio Joe   [ http://www.vecchiojoe.it ] */
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$ofsppg = 15; // Items per page
$ofsbgn = ($page*$ofsppg)-$ofsppg;

switch($pa) {
	default: list_pages(); break;
	case 'showpage': showpage($pid, $page); break;
	case 'add_page': add_page(); break;
	case 'preview_page': csrf_check(); preview_page(); break;
	case 'send_page': send_page(); break;
	case 'list_pages_categories': list_pages_categories($cid, $ofsbgn, $ofsppg, $order); break;
	case 'print_page': print_page($pid); break;
	case 'print_pdf': @PrintPDF($pid); break;
	case 'share_page': include('modules/'.$module_name.'/var/friend.php'); break;
	case 'browse_tag': BrowseTag($tag, $order, $ofsbgn, $ofsppg); break;
	case 'browse_tags': BrowseTags($tags); break;
}

function showpage($pid, $page) {
global $prefix, $user_prefix, $db, $sitename, $admin, $module_name, $locale, $datetime, $bgcolor4, $nukeurl, $admin_file;
	include('header.php');
	cpheader();
	OpenTable();
	$pid = intval($pid);
	$mypage = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\''));
	$myactive = intval($mypage['active']);
	$mytitle = stripslashes(check_html($mypage['title'], 'nohtml'));
	$mysubtitle = stripslashes(check_html($mypage['subtitle'], 'nohtml'));
	$mytags = stripslashes(check_html($mypage['tags'], 'nohtml'));
	$mycategory = intval($mypage['cid']);
	$mypage_header = stripslashes($mypage['page_header']);
	$mytext = stripslashes($mypage['text']);
	$mypage_footer = stripslashes($mypage['page_footer']);
	$mysignature = stripslashes($mypage['signature']);
	$mydate = $mypage['date'];
	$mycounter = intval($mypage['counter']);
	$myuname = $mypage['uname'];

	setlocale (LC_TIME, $locale);
	preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $mydate, $datetime);
	$datetime = strftime(_CP_CPDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);

	if (($myactive == 0) && (!is_admin($admin))) {
		echo '<div class="text-center">'._CP_NOCONTENTID.'</div>'.PHP_EOL;
	} else {
		$db->sql_query('UPDATE '.$prefix.'_pages SET counter=counter+1 WHERE pid='.$pid.'');
		echo '<script type="text/javascript">'.PHP_EOL;
		echo '	//Link Description script- © Dynamic Drive (www.dynamicdrive.com)'.PHP_EOL;
		echo '	//For full source code and TOS, visit http://www.dynamicdrive.com'.PHP_EOL;
		echo '	//change link descriptions to your own. Extend as needed'.PHP_EOL;
		echo '	var linktext=new Array()'.PHP_EOL;
		echo '	linktext[0]="'._CP_PRINTER.'"'.PHP_EOL;
		echo '	linktext[1]="'._CP_PRINTPDF.'"'.PHP_EOL;
		echo '	linktext[2]="'._CP_SHARE.'"'.PHP_EOL;
		if(is_admin($admin)) {
			echo '	linktext[3]="'._CP_EDITPAGE.'"'.PHP_EOL;
			if ($myactive==1) {
				echo '	linktext[4]="'._CP_DEACTIVATEPAGE.'"'.PHP_EOL;
			} else {
				echo '	linktext[4]="'._CP_ACTIVATEPAGE2.'"'.PHP_EOL;
			}
			echo '	linktext[5]="'._CP_DELETEPAGE.'"'.PHP_EOL;
			//echo '	linktext[6]=""'.PHP_EOL;
		}
		echo '	var ns6=document.getElementById&&!document.all'.PHP_EOL;
		echo '	var ie=document.all'.PHP_EOL;
		echo '	function show_text(thetext, whichdiv){'.PHP_EOL;
		echo '	if (ie) eval("document.all."+whichdiv).innerHTML=linktext[thetext]'.PHP_EOL;
		echo '	else if (ns6) document.getElementById(whichdiv).innerHTML=linktext[thetext]'.PHP_EOL;
		echo '	}'.PHP_EOL;
		echo '	function resetit(whichdiv){'.PHP_EOL;
		echo '	if (ie) eval("document.all."+whichdiv).innerHTML=\' \''.PHP_EOL;
		echo '	else if (ns6) document.getElementById(whichdiv).innerHTML=\' \''.PHP_EOL;
		echo '	}'.PHP_EOL;
		echo '</script>'.PHP_EOL;
		echo '<span style="font-size: 90%;">'.$datetime.'</span><br />'.PHP_EOL;
		echo '<h2 style="margin: 0pt;">'.$mytitle.'</h2>'.PHP_EOL;

		if(!empty($mysubtitle)) {
			echo '<h3 style="margin: 0pt;">'.$mysubtitle.'</h3>'.PHP_EOL;
		}

		$result = $db->sql_query('SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$myuname.'\' LIMIT 1');
		$numrows = $db->sql_numrows($result);
		if($numrows !== 0) {
			$result = $db->sql_query('SELECT name FROM '.$user_prefix.'_users WHERE username=\''.$myuname.'\' LIMIT 1');
			$row = $db->sql_fetchrow($result);
			$realname = $row['name'];
			if(empty($realname)) { $realname = $myuname; }
			echo '<span style="float: left;">'._CP_AUTHOR.': <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$myuname.'"><span class="thick">'.$realname.'</span></a>.</span>'.PHP_EOL;
		} else {
			echo '<span style="float: left;">'._CP_AUTHOR.': <span class="thick">'.$myuname.'</span>.</span>'.PHP_EOL;
		}

		echo '<span style="margin-right: 5px; float: right;">'.$mycounter.' '._CP_READS.'</span>'.PHP_EOL;
		echo '<div style="clear: both;"></div>'.PHP_EOL;
		echo '<div style="text-align: right; background-color: '.$bgcolor4.'; margin-top: 5px; padding: 5px;">'.PHP_EOL;
		echo '<span style="font-weight: bold;" id="div1"></span>	&nbsp;'.PHP_EOL;
		echo '<a href="modules.php?name='.$module_name.'&amp;pa=print_page&amp;pid='.$pid.'" onmouseover="show_text(0,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/printer_48.png" width="24" height="24" alt="'._CP_PRINTER.'" title="'._CP_PRINTER.'" border="0" /></a>'.PHP_EOL;
		echo '&nbsp;&nbsp;<a href="modules.php?name='.$module_name.'&amp;pa=print_pdf&amp;pid='.$pid.'" target="_blank" onmouseover="show_text(1,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/application-pdf.png" width="24" height="24" alt="'._CP_PRINTPDF.'" title="'._CP_PRINTPDF.'" border="0" /></a>'.PHP_EOL;
		echo '&nbsp;&nbsp;<a href="modules.php?name='.$module_name.'&amp;pa=share_page&amp;op=FriendSend&amp;pid='.$pid.'" onmouseover="show_text(2,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/mail_48.png" width="24" height="24" alt="'._CP_SHARE.'" title="'._CP_SHARE.'" border="0" /></a>'.PHP_EOL;
		if (is_admin($admin)) {
			echo '&nbsp;&nbsp;<a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'" onmouseover="show_text(3,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" width="24" height="24" alt="'._CP_EDITPAGE.'" title="'._CP_EDITPAGE.'" border="0" /></a>'.PHP_EOL;
			if ($myactive == 1) {
				echo '&nbsp;&nbsp;<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=1" onmouseover="show_text(4,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" /></a>'.PHP_EOL;
			} elseif ($myactive == 0) {
				echo '&nbsp;&nbsp;<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=0" onmouseover="show_text(4,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_ACTIVATE.'" title="'._CP_ACTIVATE.'" border="0" /></a>'.PHP_EOL;
			}
			echo '&nbsp;&nbsp;<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'" onmouseover="show_text(5,\'div1\')" onmouseout="resetit(\'div1\')"><img src="modules/'.$module_name.'/images/icons/cancel_48.png" width="24" height="24" alt="'._CP_DELETEPAGE.'" title="'._CP_DELETEPAGE.'" border="0" /></a>'.PHP_EOL;
		}
		echo '</div>'.PHP_EOL;
		echo '<br /><br />'.PHP_EOL;

		$contentpages = explode('[--pagebreak--]', $mytext);
		$pageno = count($contentpages);
		if (empty($page) || $page < 1)
			$page = 1;
		if ( $page > $pageno )
		$page = $pageno;
		$arrayelement = (int)$page;
		$arrayelement --;
		if ($pageno > 1) {
			echo '<div class="text-center">('._CP_PAGE.': '.$page.'/'.$pageno.')</div><br /><br />'.PHP_EOL;
		}
		if ($page == 1 && !empty($mypage_header)) {
			echo '<div style="text-align: justify;">'.$mypage_header.'</div><br />'.PHP_EOL;
		}
		echo '<div style="text-align: justify;">'.$contentpages[$arrayelement].'</div><br /><br />'.PHP_EOL;
		$next_page = '';
		if($page < $pageno) {
			$next_pagenumber = $page + 1;
			if ($page !== 1) {
				$next_page .= '- ';
			}
			$next_page .= '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'&amp;page='.$next_pagenumber.'">'._CP_NEXT.' ('.$next_pagenumber.'/'.$pageno.')</a>'.PHP_EOL;
			$next_page .= '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'&amp;page='.$next_pagenumber.'"><img src="modules/'.$module_name.'/images/icons/arrow_right_48.png" border="0" alt="'._CP_NEXT.'" title="'._CP_NEXT.'" width="24" height="24" /></a>'.PHP_EOL;
		}
		if ($page == $pageno && !empty($mypage_footer)) {
			echo '<div style="text-align: justify;">'.$mypage_footer.'</div><br /><br />'.PHP_EOL;
		}

		if ($page == $pageno && !empty($mysignature)) {
			echo $mysignature.'<br /><br />'.PHP_EOL;
		}

		if ($page == $pageno) {
			if($mycategory !== 0) {
				$result = $db->sql_query('SELECT title FROM '.$prefix.'_pages_categories WHERE cid='.$mycategory.' LIMIT 1');
				$row = $db->sql_fetchrow($result);
				$category = '<a href="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$mycategory.'">'.$row['title'].'</a>';
			} else {
				$category = _CP_NONE;
			}
			echo '<span class="tiny">'.PHP_EOL;
			echo _CP_COPYRIGHT.' '.$sitename.'<br />'.PHP_EOL;
			echo _CP_COPYRIGHT2.'<br />'.PHP_EOL;
			echo '</span><br /><br />'.PHP_EOL;
			echo '<span class="thick">'._CP_CATEGORY.'</span>: '.$category.'<br />'.PHP_EOL;
			if (!empty($mytags)) {
				echo '<span class="thick">'._CP_TAGS.'</span>: '.Tag2Link($mytags, $module_name).'<br />'.PHP_EOL;
			} else {
				echo '<span class="thick">'._CP_TAGS.'</span>: '._CP_NONE.'<br />'.PHP_EOL;
			}

			$pageurl = $nukeurl.'/modules.php?name='.$module_name.'&pa=showpage&pid='.$pid;
			$bookmark_title_anchor = rawurlencode(utf8_encode($mytitle));
			$bookmark_url_anchor = rawurlencode(utf8_encode($pageurl));

			$bookmark_title_js = real_escape_content($mytitle);
			$bookmark_url_js = str_replace('&amp;','&', $pageurl);

			echo '<span class="thick">'._CP_BOOKMARK.'</span>:'.PHP_EOL;
			echo '<a class="a2a_dd" onmouseover="a2a_show_dropdown(this)" onmouseout="a2a_onMouseOut_delay()" href="http://www.addtoany.com/share_save?linkname='.$bookmark_title_anchor.'&amp;linkurl='.$bookmark_url_anchor.'" target="_blank">'.PHP_EOL;
			echo '   <img src="modules/'.$module_name.'/images/share_save_100_16.png" width="100" height="16" border="0" alt="Share/Save/Bookmark"/>'.PHP_EOL;
			echo '</a>'.PHP_EOL;
			echo '<script type="text/javascript">'.PHP_EOL;
			echo '   //<![CDATA['.PHP_EOL;
			echo '   a2a_linkname="'.$bookmark_title_js.'";a2a_linkurl="'.$bookmark_url_js.'";'.PHP_EOL;
			echo '   //]]>'.PHP_EOL;
			echo '</script>'.PHP_EOL;
			echo '<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script><br /><br />'.PHP_EOL;
		}

		if($page <= 1) {
			$previous_page = '';
		} else {
			$previous_pagenumber = $page - 1;
			$previous_page = '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'&amp;page='.$previous_pagenumber.'">'.PHP_EOL;
			$previous_page.= '<img src="modules/'.$module_name.'/images/icons/arrow_left_48.png" border="0" alt="'._CP_PREVIOUS.'" title="'._CP_PREVIOUS.'" width="24" height="24" /></a>'.PHP_EOL;
			$previous_page.= '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'&amp;page='.$previous_pagenumber.'">'._CP_PREVIOUS.' ('.$previous_pagenumber.'/'.$pageno.')</a>'.PHP_EOL;
		}

		echo '<div class="text-center">'.PHP_EOL;
		if(!empty($previous_page)) {echo $previous_page;}
		if(!empty($next_page)) {echo $next_page;}
		if(!empty($previous_page) || !empty($next_page)) {echo '<br /><br />'.PHP_EOL;}
		echo _CP_GOBACK.'</div>'.PHP_EOL;
	}
	CloseTable();
	include('footer.php');
}

function list_pages() {
	global $prefix, $db, $user, $sitename, $admin, $multilingual, $module_name, $admin_file, $bgcolor1, $bgcolor4;
	include('header.php');
	cpheader();
	OpenTable();
	echo '<div class="text-center">'._CP_LISTOFCONTENT.'<br />'.PHP_EOL;
	echo '<span class="thick">'.$sitename.'</span><br /><br /></div>'.PHP_EOL;
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages_categories');
	$numrows = $db->sql_numrows($result);
	//$numrows2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE cid!=\'0\' AND active=\'1\''));
	if ($numrows > 0) {
		echo '<div class="text-center">'._CP_CONTENTCATEGORIES.'</div><br />'.PHP_EOL;
		echo '<table cellpadding="3" cellspacing="1" border="0" width="95%" style="margin-right: auto; margin-left: auto;">'.PHP_EOL;
		while ($row = $db->sql_fetchrow($result)) {
			$cid = intval($row['cid']);
			$title = stripslashes(check_html($row['title'], 'nohtml'));
			$description = stripslashes($row['description']);
			$cimg = stripslashes($row['cimg']);
			if (empty($cimg) || !file_exists('modules/'.$module_name.'/images/categories/'.$cimg.'')) {
				$cimg='no_icon.png';
			}
			$cimg_link = 'modules/'.$module_name.'/images/categories/'.$cimg.'';
			$numrows3 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE cid=\''.$cid.'\''));
			//if ($numrows3 > 0) {
				echo '	<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
				echo '		<td align="center" valign="middle" width="20%">'.PHP_EOL;
				echo '			<a href="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'">'.PHP_EOL;
				echo '			<img border="0" src="'.$cimg_link.'" alt="'.$title.'" title="'.$title.'" width="48" height="48" /></a>'.PHP_EOL;
				echo '		</td>'.PHP_EOL;
				echo '		<td valign="top">'.PHP_EOL;
				echo '			<span style="font-size: 115%;"><span class="thick"><a href="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'">'.$title.'</a></span> ('.$numrows3.' '._CP_CPARTICLES.')</span><br />'.$description.PHP_EOL;
				echo '		</td>'.PHP_EOL;
				echo '	</tr>'.PHP_EOL;
			//}
		}
		echo '</table><br /><br />'.PHP_EOL;
	}
	$result4 = $db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE active=\'1\' AND cid=\'0\' ORDER BY date');
	$numresults = $db->sql_numrows($result4);
	if($numresults > 0) {
		echo '<div class="text-center">'._CP_NONCLASSCONT.'</div><br />'.PHP_EOL;
		echo '<table cellpadding="3" cellspacing="1" border="0" align="center" width="100%">'.PHP_EOL;
		while ($row4 = $db->sql_fetchrow($result4)) {
			$pid = intval($row4['pid']);
			$title = stripslashes(check_html($row4['title'], 'nohtml'));
			$subtitle = stripslashes(check_html($row4['subtitle'], 'nohtml'));
			$date = $row4['date'];
			$counter = intval($row4['counter']);
			$clanguage = $row4['clanguage'];
			if ($multilingual == 1) {
				$the_lang = '<img src="images/language/flag-'.$clanguage.'.png" hspace="3" border="0" height="10" width="20" alt="'.$clanguage.'" title="'.$clanguage.'" />';
			} else {
				$the_lang = '';
			}
			if (!empty($subtitle)) {
				$subtitle = ' ('.$subtitle.')';
			} else {
				$subtitle = '';
			}
			if (is_admin($admin)) {
				echo '	<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
				echo '		<td width="80%"><span class="thick"><span class="larger">&middot;</span></span> '.$the_lang.'&nbsp;'.PHP_EOL;
				echo '			<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> '.$subtitle.''.PHP_EOL;
				newcontentgraphic($date);
				popgraphic($counter);
				echo '		</td>'.PHP_EOL;
				echo '		<td><div class="text-center"><a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'">'.PHP_EOL;
				echo '			<img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" width="24" height="24" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" /></a>'.PHP_EOL;
				echo '			<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=1">'.PHP_EOL;
				echo '			<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" /></a>'.PHP_EOL;
				echo '			<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'">'.PHP_EOL;
				echo '			<img src="modules/'.$module_name.'/images/icons/cancel_48.png" width="24" height="24" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" /></a></div>'.PHP_EOL;
				echo '		</td>'.PHP_EOL;
				echo '	</tr>'.PHP_EOL;
			} else {
				echo '	<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
				echo '		<td width="80%"><span class="larger"><span class="thick">&middot;</span></span> '.$the_lang.'&nbsp;'.PHP_EOL;
				echo '			<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> '.$subtitle.PHP_EOL;
				newcontentgraphic($date);
				popgraphic($counter);
				echo '		</td>'.PHP_EOL;
				echo '		<td><div class="text-center"><a href="modules.php?name='.$module_name.'&amp;pa=print_page&amp;pid='.$pid.'">'.PHP_EOL;
				echo '			<img src="modules/'.$module_name.'/images/icons/printer_48.png" width="24" height="24" alt="'._CP_PRINTER.'" title="'._CP_PRINTER.'" border="0" /></a>'.PHP_EOL;
				echo '			<a href="modules.php?name='.$module_name.'&amp;pa=print_pdf&amp;pid='.$pid.'" target="_blank">'.PHP_EOL;
				echo '			<img src="modules/'.$module_name.'/images/icons/application-pdf.png" width="24" height="24" alt="'._CP_PRINTPDF.'" title="'._CP_PRINTPDF.'" border="0" /></a>'.PHP_EOL;
				echo '			<a href="modules.php?name='.$module_name.'&amp;pa=share_page&amp;op=FriendSend&amp;pid='.$pid.'">'.PHP_EOL;
				echo '			<img src="modules/'.$module_name.'/images/icons/mail_48.png" width="24" height="24" alt="'._CP_SHARE.'" title="'._CP_SHARE.'" border="0" /></a></div>'.PHP_EOL;
				echo '		</td>'.PHP_EOL;
				echo '	</tr>'.PHP_EOL;
			}
		}
		echo '</table><br /><br />';
	}

	if (is_admin($admin)) {
		$result5 = $db->sql_query('SELECT pid, cid, title, subtitle, clanguage FROM '.$prefix.'_pages WHERE active=\'0\' AND cid=\'0\' ORDER BY date');
		$nonactive = $db->sql_numrows($result5);
		if($nonactive > 0) {
			echo '<br /><br />'.PHP_EOL;
			echo '<div class="text-center"><span class="thick">'._CP_YOURADMINLIST.'</span></div><br /><br />'.PHP_EOL;
			echo '<blockquote>'.PHP_EOL;
			while ($row5 = $db->sql_fetchrow($result5)) {
				$pid = intval($row5['pid']);
				$cid = intval($row5['cid']);
				$title = stripslashes(check_html($row5['title'], 'nohtml'));
				$subtitle = stripslashes(check_html($row5['subtitle'], 'nohtml'));
				$clanguage = $row5['clanguage'];
				if ($multilingual == 1) {
					$the_lang = '<img src="images/language/flag-'.$clanguage.'.png" hspace="3" border="0" height="10" width="20" />';
				} else {
					$the_lang = '';
				}
				if (!empty($subtitle)) {
					$subtitle = ' ('.$subtitle.') ';
				} else {
					$subtitle = '';
				}
				echo $the_lang.'&nbsp;'.PHP_EOL;
				echo '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> '.$subtitle.' [&nbsp;'.PHP_EOL;
				echo '<a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'">'._CP_EDIT.'</a> |&nbsp;'.PHP_EOL;
				echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=0">'._CP_ACTIVATE.'</a> |&nbsp;'.PHP_EOL;
				echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'">'._CP_DELETE.'</a> ]<br />'.PHP_EOL;
			}
			echo '</blockquote>'.PHP_EOL;
		}
	}
	CloseTable();
	include('footer.php');
}

function list_pages_categories($cid, $ofsbgn, $ofsppg, $order) {
	global $prefix, $db, $sitename, $slogan, $admin, $multilingual, $module_name, $admin_file, $datetime, $bgcolor1, $bgcolor4, $page;
	include('header.php');
	cpheader();
	OpenTable();
	$cid = intval($cid);
	featured_content($cid);
	echo '<div class="text-center">'._CP_LISTOFCONTENT.'<br />'.PHP_EOL;
	echo '<span class="thick">'.$sitename.'</span></div><br /><br />'.PHP_EOL;
	for($i=0; $i<=6; $i++) { $selected[$i]=''; }
	if(!empty($order)) {
		if($order=='1') {$orderby='date DESC'; $selected[1]='selected="selected"';}
		if($order=='2') {$orderby='date ASC'; $selected[2]='selected="selected"';}
		if($order=='3') {$orderby='title ASC'; $selected[3]='selected="selected"';}
		if($order=='4') {$orderby='title DESC'; $selected[4]='selected="selected"';}
		if($order=='5') {$orderby='counter DESC'; $selected[5]='selected="selected"';}
		if($order=='6') {$orderby='counter ASC'; $selected[6]='selected="selected"';}
	} else { $orderby='title ASC'; }
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE active=\'1\' AND cid=\''.$cid.'\' ORDER BY '.$orderby.' LIMIT '.$ofsbgn.','.$ofsppg.'');
	echo '<script type="text/javascript" language="javascript">'.PHP_EOL;
	echo '	function cp_GoTo(url){location.href = url;}'.PHP_EOL;
	echo '</script>'.PHP_EOL;
	echo '<table border="0" width="100%" cellpadding="3" cellspacing="1" style="margin-right: auto; margin-left: auto;">'.PHP_EOL;
	echo '	<tr>'.PHP_EOL;
	echo '		<td width="80%" align="right" colspan="2"><span class="thick">'._CP_SORTBY.'</span>'.PHP_EOL;
	echo '			<form action="" style="display: inline;"><select onchange="cp_GoTo(this.value)">'.PHP_EOL;
	echo '				<option value="#" >'._CP_SELECT.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'&amp;order=1" '.$selected[1].'>'._CP_DATEDESC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'&amp;order=2" '.$selected[2].'>'._CP_DATEASC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'&amp;order=3" '.$selected[3].'>'._CP_TITLEASC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'&amp;order=4" '.$selected[4].'>'._CP_TITLEDESC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'&amp;order=5" '.$selected[5].'>'._CP_COUNTERDESC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=list_pages_categories&amp;cid='.$cid.'&amp;order=6" '.$selected[6].'>'._CP_COUNTERASC.'</option>'.PHP_EOL;
	echo '			</select></form>'.PHP_EOL;
	echo '		</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;
	while ($row = $db->sql_fetchrow($result)) {
		$pid = intval($row['pid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$subtitle = stripslashes(check_html($row['subtitle'], 'nohtml'));
		$clanguage = $row['clanguage'];
		$counter = $row['counter'];
		$date = $row['date'];
		$the_lang = '';
		if ($multilingual == 1) {
			$the_lang = '<img src="images/language/flag-'.$clanguage.'.png" hspace="3" border="0" height="10" width="20" alt="" />';
		}
		if (!empty($subtitle)) { $subtitle = ' ('.$subtitle.')'; }
		if (is_admin($admin)) {
			echo '<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
			echo '<td width="80%">'.$the_lang.'&nbsp;'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a>'.PHP_EOL;
			newcontentgraphic($date);
			popgraphic($counter);
			echo '</td>'.PHP_EOL;
			echo '<td width="20%"><div class="text-center"><a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" width="24" height="24" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" /></a>'.PHP_EOL;
			echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=1">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" /></a>'.PHP_EOL;
			echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/cancel_48.png" width="24" height="24" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" /></a></div></td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
		} else {
			echo '<tr style="background-color: '.$bgcolor4.';">'.PHP_EOL;
			echo '<td width="80%">'.$the_lang.'&nbsp;'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a>'.PHP_EOL;
			newcontentgraphic($date);
			popgraphic($counter);
			echo '</td>'.PHP_EOL;
			echo '<td width="20%"><div class="text-center"><a href="modules.php?name='.$module_name.'&amp;pa=print_page&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/printer_48.png" width="24" height="24" alt="'._CP_PRINTER.'" title="'._CP_PRINTER.'" border="0" /></a>'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=print_pdf&amp;pid='.$pid.'" target="_blank">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/application-pdf.png" width="24" height="24" alt="'._CP_PRINTPDF.'" title="'._CP_PRINTPDF.'" border="0" /></a>'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=share_page&amp;op=FriendSend&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/mail_48.png" width="24" height="24" alt="'._CP_SHARE.'" title="'._CP_SHARE.'" border="0" /></a></div></td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
		}
	}
	echo '</table>'.PHP_EOL;
	cp_pagination($ofsbgn, $ofsppg);
	if (is_admin($admin)) {
		$result2 = $db->sql_query('SELECT pid, title, subtitle, clanguage FROM '.$prefix.'_pages WHERE active=\'0\' AND cid=\''.$cid.'\' ORDER BY title');
		$numresults = $db->sql_numrows($result2);
		if($numresults > 0) {
			echo '<br /><br /><div class="text-center thick">'._CP_YOURADMINLIST.'</div>'.PHP_EOL;
			echo '<br /><br />'.PHP_EOL;
			while ($row2 = $db->sql_fetchrow($result2)) {
				$pid = intval($row2['pid']);
				$title = stripslashes(check_html($row2['title'], 'nohtml'));
				$subtitle = stripslashes(check_html($row2['subtitle'], 'nohtml'));
				$clanguage = $row2['clanguage'];
				if ($multilingual == 1) {
					$the_lang = '<img src="images/language/flag-'.$clanguage.'.png" hspace="3" border="0" height="10" width="20" alt="" />';
				} else {
					$the_lang = '';
				}
				if (!empty($subtitle)) {
					$subtitle = ' ('.$subtitle.') ';
				} else {
					$subtitle = '';
				}
				echo '<span class="larger thick">&middot;</span> '.$the_lang.'&nbsp;'.PHP_EOL;
				echo '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> '.$subtitle.' [&nbsp;'.PHP_EOL;
				echo '<a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'">'._CP_EDIT.'</a> |&nbsp;'.PHP_EOL;
				echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=0">'._CP_ACTIVATE.'</a> |&nbsp;'.PHP_EOL;
				echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'">'._CP_DELETE.'</a> ]<br />'.PHP_EOL;
			}
		}
	}
	echo '<div class="text-center">'._CP_GOBACK.'</div>'.PHP_EOL;
	CloseTable();
	include('footer.php');
}
?>
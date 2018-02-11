<?php
/*************************************************************************/
/* Tableless CSS Sprite Powered Info Box Block by                        */
/* SpasticDonkey - web-cms-designs.com                                   */
/* Inspired by: Info Box for RavenNuke by nukecoder.com                  */
/* RavenWebServices User Info Block www.ravenphpscripts.com              */
/* nukeNAV by nukeSEO nukeseo.com                                        */
/* Icons adapted from the Crystal project www.everaldo.com/crystal/ and  */
/* the Tango Desktop Project tango.freedesktop.org/Tango_Desktop_Project */
/* Intended for use on RavenNuke(tm) v2.5+                               */
/*************************************************************************/
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
if (!isset($side)) { $side = ''; }
if ($side == 'c' || $side == 'd' || $side == 't') { $IBCentermode = true; } else { $IBCentermode = false; }
if (!defined('PHP_EOL')) define ('PHP_EOL', strtoupper(substr(PHP_OS,0,3) == 'WIN') ? "\r\n" : "\n");
/*********************************************************************************************************/
/* Setup - Use these settings to control how the user info block displays to users/admins/anonymous.     */
/*********************************************************************************************************/
/* MEMBER TOTALS SECTION */
$membercounter_view  = 1;  // MEMBER TOTALS SECTION: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$zero_in_column_view = 2;  // If zero registrations during period show column to: 0=everyone 1=user-only 2=admin-only 3=disable
/* RECENT MEMBER SECTION */
$recent_member_view  = 1; // RECENT MEMBER SECTION: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$recent_member_count = 1; // how many newest members to show to all
$recent_member_user  = 2; // how many newest members to show to users
$recent_member_admin = 4; // how many newest members to show to admins
/* ONLINE NOW SECTION */
$who_is_online_view  = 1; // ONLINE NOW SECTION: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$show_guest_guest    = 2; // show online guests to 0=everyone 1=user-only 2=admin-only 3=disable
$max_display_guests  = 6; // maximum number of online guests to display
$max_display_members = 6; // maximum number of online members to display
$showonlinecount     = 1; // total count of online guests/members: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$max_session_mins    = 60; // how long before inactive users are dropped from online list
/* LAST SEEN MEMBER SECTION */
$lastseen_user_view  = 0; // LAST SEEN MEMBER SECTION: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$lastseen_count      = 2; // how many last seen members to show to all
$lastseen_count_user = 4; // how many last seen members to show to users
$lastseen_count_admn = 6; // how many last seen members to show to admins
/* SERVER TRAFFIC SECTION */
$servertraffic_view  = 0;  // SERVER TRAFFIC SECTION: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$traffic_year_view   = 1;  // Traffic stats by year: Who can view? 0=everyone 1=user-only 2=admin-only 3=disable
$how_many_years      = 2;  // how many years to display in traffic stats
/* GENERAL BLOCK SETTINGS */
$nameMaxLength       = 13; // Max length for username display.  Will truncate with ...
$langMaxLength       = 17; // Max length for some problem language defines.  Will display in smaller font-size
$LargeSectionIcons   = false; // use 32x32 icons for the sections
$display_lost_pass   = true; // set to false to hide the lost password link (displays in smaller font in some languages)
$pm_colorbox_notice  = true; // if set to true, users will only be notified of private messages once per session
$UsemodalLogin       = true; // modal login popup - nukeNAV module must be ACTIVE!
$UseSearchPopUp      = true; // modal search popup - nukeNAV and Search modules must be ACTIVE!
$whoisUseModal       = true; //admin ip lookup in modal window
$OnlineGuestsModal   = true; //compact the online guests into one modal link
$whoisServerString   = 'whois.domaintools.com/'; //admin ip lookup
if ($IBCentermode) { // <- do not edit
/*********************************************************************************************************/
/* CENTER BLOCK SETTINGS (only used when in center position, overrides settings above)                   */
/*********************************************************************************************************/
$membercounter_view  = 0;
$zero_in_column_view = 2;
$recent_member_view  = 0;
$recent_member_count = 2;
$recent_member_user  = 2;
$recent_member_admin = 2;
$who_is_online_view  = 0;
$show_guest_guest    = 0;
$max_display_guests  = 20;
$max_display_members = 6;
$showonlinecount     = 0;
$lastseen_user_view  = 0;
$lastseen_count      = 6;
$lastseen_count_user = 6;
$lastseen_count_admn = 6;
$servertraffic_view  = 0;
$traffic_year_view   = 0;
$how_many_years      = 2;
$LargeSectionIcons   = true;
} // <- do not edit
/*********************************************************************************************************/
/* Sprite Settings - For more info see http://www.rtsforce.com/InfoBox-CSS/                              */
/*********************************************************************************************************/
$IBtran          = 'images/transparent.gif'; // source for the transparent gif sprite container
$IBicon          = 'IBicon8'; // default classes for icons (changed by theme below unless $MultiThemeMode = false)
$rnIBicon        = 'rnIBicon'; // default classes for icons (changed by theme below unless $MultiThemeMode = false)
$MultiThemeMode  = true; // false to disable loading theme specific icons, and ignore array settings below - see readme
$rnIBWhite       = array('3D-Fantasy', 'DeepBlue', 'ExtraLite', 'NukeNews', 'Slash', 'SlashOcean', 'Traditional'); // Themes with white block backgrounds
$rnIBGray        = array('Anagram', 'Karate', 'Milo'); // Themes with gray block backgrounds
$rnIBCreme       = array('Sunset'); // Themes with creme block backgrounds
$rnIBSimplyBlue  = array('SimplyBlue'); // Themes with sky blue block backgrounds
$rnIBSandJourney = array('Sand_Journey'); // Themes with sand block backgrounds
$rnIBBlueBlog    = array('Blue_Blog'); // Themes with taupe block backgrounds
$rnIBCTRN        = array('CT_RN'); // Themes with crimson backgrounds
$rnIBRavenIce    = array('RavenIce', 'fisubice'); // Themes with off-white/blue block backgrounds
$rnIBKaput       = array('Kaput'); // Themes with blue/gray block backgrounds
$rnIBBlack       = array(); // Themes with black block backgrounds
$rnIBExtra       = array(); // An extra group for other themes (use class rnIBExtra and IBExtra to define your sprite background - see readme)
/*********************************************************************************************************/
/* You should not need to modify anything below this line                                                */
/*********************************************************************************************************/
global $db, $prefix, $ya_config, $anonymous, $user_prefix, $user, $sitekey, $gfx_chk, $admin, $currentlang, $language, $startdate, $name;

if(file_exists('language/infobox/lang-' . $currentlang . '.php')) {
	include_once 'language/infobox/lang-' . $currentlang . '.php';
} elseif(file_exists('language/infobox/lang-' . $language . '.php')) {
	include_once 'language/infobox/lang-' . $language . '.php';
} else {
	include_once 'language/infobox/lang-english.php';
}
if (!isset($name)) { $name = ''; }
if ($IBCentermode) {
	$ListClass = 'IBblock-center';
	addJSToBody('includes/jquery/jquery.masonry.min.js', 'file');
	addJSToBody('includes/jquery/jquery.userinfo.js', 'file');
} else {
	$ListClass = 'IBblock';
}
if (!isset($ya_config)) $ya_config = ya_get_configs();
if ($MultiThemeMode){
	$ThemeSel = get_theme();
	if (in_array($ThemeSel, $rnIBWhite)) {$rnIBicon = 'rnIBWhite';$IBicon = 'IBWhite';}
	else if (in_array($ThemeSel, $rnIBGray)) {$rnIBicon = 'rnIBGray';$IBicon = 'IBGray';}
	else if (in_array($ThemeSel, $rnIBCreme)) {$rnIBicon = 'rnIBCreme';$IBicon = 'IBCreme';}
	else if (in_array($ThemeSel, $rnIBSimplyBlue)) {$rnIBicon = 'rnIBSimplyBlue';$IBicon = 'IBSimplyBlue';}
	else if (in_array($ThemeSel, $rnIBSandJourney)) {$rnIBicon = 'rnIBSandJourney';$IBicon = 'IBSandJourney';}
	else if (in_array($ThemeSel, $rnIBBlueBlog)) {$rnIBicon = 'rnIBBlueBlog';$IBicon = 'IBBlueBlog';}
	else if (in_array($ThemeSel, $rnIBCTRN)) {$rnIBicon = 'rnIBCT-RN';$IBicon = 'IBCT-RN';}
	else if (in_array($ThemeSel, $rnIBRavenIce)) {$rnIBicon = 'rnIBRavenIce';$IBicon = 'IBRavenIce';}
	else if (in_array($ThemeSel, $rnIBKaput)) {$rnIBicon = 'rnIBKaput';$IBicon = 'IBKaput';}
	else if (in_array($ThemeSel, $rnIBBlack)) {$rnIBicon = 'rnIBBlack';$IBicon = 'IBBlack';}
	else if (in_array($ThemeSel, $rnIBExtra)) {$rnIBicon = 'rnIBExtra';$IBicon = 'IBExtra';}
	else {$rnIBicon = 'rnIBicon';$IBicon = 'IBicon8';}
}
if ($LargeSectionIcons) {$IBadjust = 'LG';$IBicon = 'IBBigIcons';} else {$IBadjust = '';}
if (is_admin($admin)) {
	$viewlevel = 2;
	$lastseen_count=$lastseen_count_admn;
	$recent_member_count=$recent_member_admin;
} else if (is_user($user)) {
	$viewlevel = 1;
	$lastseen_count=$lastseen_count_user;
	$recent_member_count=$recent_member_user;
} else {
	$viewlevel = 0;
}
$anonyname = 'Anonymous';
$displayname = '';
$show_pms = 0;
$onlinenames = array();

$content = '<!-- Start Info -->
<div id="' . $ListClass . '"><div class="fullwidth">
';

// get user info/show login
if (is_user($user)) {
	$uinfo = cookiedecode($user);
	$displayname = check_html($uinfo[1], 'nohtml');
	$content .= '<div class="IBinfosection" id="IBsection1">'.PHP_EOL;
	$content .= '<div><a href="modules.php?name=Your_Account&amp;op=edituser" class="IBuser' . $IBadjust . '" title="' . _FSIYOURACCOUNT . '"><img src="' . $IBtran . '" class="' . $IBicon . '" alt="' . _FSIYOURACCOUNT . '" /><span class="IBtextpad">' . $displayname . '</span></a></div>'.PHP_EOL;
	$content .= '<ul class="rninfobox">'.PHP_EOL;
	if ($whoisUseModal){$iblinktype = 'class="IBmodal"';} else {$iblinktype = 'target="_blank"';}
	$content .= '<li class="' . $rnIBicon . ' IByourip" title="' . _YOURIP . ' ' . $_SERVER['REMOTE_ADDR'] . '"><span class="thick"><a ' . $iblinktype . ' href="http://' . $whoisServerString . $_SERVER['REMOTE_ADDR'] . '" title="' . _YOURIP . ' ' . $_SERVER['REMOTE_ADDR'] . '">' . $_SERVER['REMOTE_ADDR'] . '</a></span></li>'.PHP_EOL;

	if (is_active('Forums')) {
		$adjustment = strlen(html_entity_decode(_INFOBOX_EGOPOSTS));
		if ($adjustment>=$langMaxLength){$getsmall = ' smaller';} else {$getsmall = '';}
		$content .= '<li class="' . $rnIBicon . ' IByourposts' . $getsmall . '" title="' . _INFOBOX_EGOPOSTS . '"><a href="modules.php?name=Forums&amp;file=search&amp;search_id=egosearch" title="' . _INFOBOX_EGOPOSTS . '">' . _INFOBOX_EGOPOSTS . '</a></li>'.PHP_EOL;
	}
	if ($ya_config['allowusertheme']=='1') {
		$content .= '<li class="' . $rnIBicon . ' IBchangetheme" title="' . _INFOBOX_CHANGETHEME . '"><a href="modules.php?name=Your_Account&amp;op=chgtheme" title="' . _INFOBOX_CHANGETHEME . '">' . _INFOBOX_CHANGETHEME . '</a></li>'.PHP_EOL;
	}
	if (is_active('nukeNAV') and is_active('Search') and $UseSearchPopUp) $content .= '<li class="' . $rnIBicon . ' IBsearch" title="' . _SEARCH . '"><a href="modules.php?name=nukeNAV&amp;op=search" class="colorbox" title="">' . _SEARCH . '</a></li>'.PHP_EOL;
	$content .= '<li class="' . $rnIBicon . ' IBlogout" title="' . _LOGOUT . '"><a href="modules.php?name=Your_Account&amp;op=logout" title="' . _LOGOUT . '">' . _LOGOUT . '</a></li>'.PHP_EOL;
	$content .= '</ul>'.PHP_EOL;
	$content .= '</div>'.PHP_EOL;

	// check new pms
	$sql = 'SELECT privmsgs_to_userid FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid=' . intval($uinfo[0]) . ' AND (privmsgs_type=5 OR privmsgs_type=1)';
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error checking new pms');
	}
	$new_pms = $db->sql_numrows($result);
	$db->sql_freeresult($result);

	// check old pms
	$sql = 'SELECT privmsgs_to_userid FROM ' . $prefix . '_bbprivmsgs WHERE privmsgs_to_userid=' . intval($uinfo[0]) . ' AND (privmsgs_type=0)';
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error checking old pms');
	}
	$old_pms = $db->sql_numrows($result);
	$db->sql_freeresult($result);

	$show_pms = $new_pms+$old_pms;
	if ($show_pms > 0 AND is_active('Private_Messages')) {
	$content .= '<div class="IBinfosection" id="IBsection2">'.PHP_EOL;
	$content .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBpms' . $IBadjust . '" alt="' . _BPM . '" /><span class="IBtextpad thick">' . _BPM . '</span></div>'.PHP_EOL;
	$content .= '<ul class="rninfobox">'.PHP_EOL;
	$content .= '<li class="' . $rnIBicon . ' IBnewpms" title="' . _BPM . '"><a href="modules.php?name=Private_Messages" title="' . _BPM . '">' . _BUNREAD . ': ' . $new_pms . '</a></li>'.PHP_EOL;
	$content .= '<li class="' . $rnIBicon . ' IBoldpms" title="' . _BREAD . '"> ' . _BREAD . ': <span class="thick">' . $old_pms . '</span></li>'.PHP_EOL;
	$content .= '</ul>'.PHP_EOL;
	$content .= '</div>'.PHP_EOL;
		if (($pm_colorbox_notice && $new_pms > 0) and (!isset($_COOKIE["youhaveapm"])) and ($name!='Private_Messages')) {
			setcookie('youhaveapm', 'checked');
			$content .= '<div id="IByesnewpm" style="display:none">'.PHP_EOL;
			$content .= '<div id="IBnewmessages">'.PHP_EOL;
			$content .= '<span class="IBCBtext"><img src="' . $IBtran . '" class="' . $IBicon . ' IBoldpms" alt="' . _NEWPMSG . '" /> ' . _YOUHAVE . ' <a href="modules.php?name=Private_Messages">' . $new_pms . ' ' . _NEWPMSG . '.</a></span>'.PHP_EOL;
			$content .= '</div>'.PHP_EOL;
			$content .= '</div>'.PHP_EOL;
		}
	}
} else {
	$content .= '<div class="IBinfosection" id="IBsection3">'.PHP_EOL;
	$content .= '<div><a href="modules.php?name=Your_Account" title="' . _FSIYOURACCOUNT . '" class="IBglobe' . $IBadjust . '"><img src="' . $IBtran . '" class="' . $IBicon . ' IBglobe' . $IBadjust . '" alt="' . $anonymous . '" /><span class="IBtextpad">' . $anonymous . '</span></a></div>'.PHP_EOL;
	$content .= '<ul class="rninfobox">'.PHP_EOL;
	$content .= '<li class="' . $rnIBicon . ' IByourip IBguestip" title="' . _YOURIP . ' ' . $_SERVER['REMOTE_ADDR'] . '"><span class="thick">' . $_SERVER['REMOTE_ADDR'] . '</span></li>'.PHP_EOL;
	$content .= '<li class="' . $rnIBicon . ' IByourposts" title="' . _BREG . '"><a href="modules.php?name=Your_Account&amp;op=new_user">' . _BREG . '</a></li>'.PHP_EOL;
	if (is_active('nukeNAV') and is_active('Search') and $UseSearchPopUp) $content .= '<li class="' . $rnIBicon . ' IBsearch" title="' . _SEARCH . '"><a href="modules.php?name=nukeNAV&amp;op=search" class="colorbox" title="">' . _SEARCH . '</a></li>'.PHP_EOL;
	if ($UsemodalLogin){
		$content .= '<li class="' . $rnIBicon . ' IBlogout" title="' . _LOGIN . '"><a href="modules.php?name=nukeNAV&amp;op=login" class="colorbox">' . _LOGIN . '</a></li>'.PHP_EOL;
	} else {
		$content .= '<li class="' . $rnIBicon . ' IBlogout" title="' . _LOGIN . '"><a href="modules.php?name=Your_Account">' . _LOGIN . '</a></li>'.PHP_EOL;
	}
	if ($display_lost_pass) {
		$adjustment = strlen(html_entity_decode(_PASSWORDLOST));
		if ($adjustment>=$langMaxLength){$getsmall = ' smaller';} else {$getsmall = '';}
		$content .= '<li class="' . $rnIBicon . ' IBonlineguest' . $getsmall . '" title="' . _PASSWORDLOST . '"><a href="modules.php?name=Your_Account&amp;op=pass_lost">' . _PASSWORDLOST . '</a></li>'.PHP_EOL;
	}
	$content .= '</ul>'.PHP_EOL;
	$content .= '</div>'.PHP_EOL;
}

if ($viewlevel>=$membercounter_view) {
	// MEMBER COUNTS
	$sql = 'SELECT username FROM ' . $user_prefix . '_users_temp';
	$result = $db->sql_query($sql);
	$waiting = $db->sql_numrows($result);

	$content .= '<div class="IBinfosection" id="IBsection4">'.PHP_EOL;
	$content .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBmembers' . $IBadjust . '" alt="' . _BMEM . '" /><span class="IBtextpad thick">' . _BMEM . '</span></div>'.PHP_EOL;

    // 0001856: User Info block enhancements
    $IBgetmonth = _UMONTH;
    $IBgetyear = _YEAR;

    // get new member info
	$timestamp = time();
	$today = date("M d, Y");
	$yesterday = date("M d, Y", ($timestamp - 86400) );
	$this_month = date("M");
	$this_year = date("Y");

	// today
	$sql = 'SELECT COUNT(user_id) FROM ' . $user_prefix . '_users WHERE user_regdate=\'' . $today . '\'';
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error getting todays users');
	}
	list($new_today) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// yesterday
	$sql = 'SELECT COUNT(user_id) FROM ' . $user_prefix . '_users WHERE user_regdate=\'' . $yesterday . '\'';
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error getting yesterdays users');
	}
	list($new_yesterday) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// this month
	$sql = 'SELECT COUNT(user_id) FROM ' . $user_prefix . '_users WHERE SUBSTRING(user_regdate, 1, 4)=\'' . $this_month . '\' AND SUBSTRING(user_regdate, 9, 12)=\'' . $this_year . '\'';
	if (!($result = $db->sql_query($sql))){
		// error
		die('error getting this months users');
	}
	list($new_month) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// this year
	$sql = 'SELECT COUNT(user_id) FROM ' . $user_prefix . '_users WHERE SUBSTRING(user_regdate, 9, 12)=\'' . $this_year . '\'';
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error getting this years users');
	}
	list($new_year) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// all time
	$sql = 'SELECT COUNT(user_id) FROM ' . $user_prefix . '_users';
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error getting total users');
	}
	if (is_admin($admin) AND @file_exists('modules/Resend_Email/index.php')) {
		$waitLink = '<a href="modules.php?name=Resend_Email" title="' . _TTL_RESENDEMAIL . '">' . _WAITLINK . ': <span class="thick">' . $waiting . '</span></a>';
	} else {
		$waitLink = _WAITLINK . ': <span class="thick">' . $waiting . '</span>';
	}
	list($total_users) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$content .= '<ul class="rninfobox">'.PHP_EOL;
	if (($new_today==0 AND $viewlevel>=$zero_in_column_view) OR ($new_today!=0)) {
		$content .= '<li class="' . $rnIBicon . ' IBtoday" title="' . _INFOBOX_BTD . '">' . _INFOBOX_BTD . ': <span class="thick">' . $new_today . '</span></li>'.PHP_EOL;
	}
	if (($new_yesterday==0 AND $viewlevel>=$zero_in_column_view) OR ($new_yesterday!=0)) {
		$adjustment = strlen(html_entity_decode(_INFOBOX_BYD));
		if ($adjustment>=$langMaxLength){$getsmall = ' smaller';} else {$getsmall = '';}
		$content .= '<li class="' . $rnIBicon . ' IByesterday' . $getsmall . '" title="' . _INFOBOX_BYD . '">' . _INFOBOX_BYD . ': <span class="thick">' . $new_yesterday . '</span></li>'.PHP_EOL;
	}
	if (($new_month==0 AND $viewlevel>=$zero_in_column_view) OR ($new_month!=0)) {
		$content .= '<li class="' . $rnIBicon . ' IBmonth" title="' . _UMONTH . '">' . $IBgetmonth . ': <span class="thick">' . $new_month . '</span></li>'.PHP_EOL;
	}
	if (($new_year==0 AND $viewlevel>=$zero_in_column_view) OR ($new_year!=0)) {
		$content .= '<li class="' . $rnIBicon . ' IByear" title="' . _YEAR . '">' . $IBgetyear . ': <span class="thick">' . $new_year . '</span></li>'.PHP_EOL;
	}
	$content .= '<li class="' . $rnIBicon . ' IBtotalusers" title="' . _BTT . '">' . _BTT . ': <span class="thick">' . $total_users . '</span></li>'.PHP_EOL;
	if (($waitLink==0 AND $viewlevel>=$zero_in_column_view) OR ($waitLink!=0)) {
		$content .= '<li class="' . $rnIBicon . ' IBwaiting" title="' . _WAITLINK . '">' . $waitLink . '</li>'.PHP_EOL;
	}
	$content .= '</ul></div>'.PHP_EOL;
}
// NEWEST MEMBERS
if ($viewlevel>=$recent_member_view) {
	$sql = 'SELECT username FROM ' . $user_prefix . '_users WHERE username!=\'' . $anonyname . '\' ORDER BY user_id DESC LIMIT ' . intval($recent_member_count);
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error getting latest users');
	}
	$latestusers = $db->sql_numrows($result = $db->sql_query($sql));
	$content .= '<div class="IBinfosection" id="IBsection5">'.PHP_EOL;
	$content .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBnewusers' . $IBadjust . '" alt="' . _INFOBOX_NEW_MEMBERS . '" /><span class="IBtextpad thick">' . _INFOBOX_NEW_MEMBERS . '</span></div>'.PHP_EOL;
	if ($latestusers > 0){
		$content .= '<ul class="rninfobox">'.PHP_EOL;
		$newusercounter = 0;
	}
	while($row = $db->sql_fetchrow($result)) {
		$newusercounter += 1;
		$TruncateUser = strlen($row['username'])<=$nameMaxLength?$row['username']:substr($row['username'],0,$nameMaxLength).'...'; // 2.2.0
		$lastusername = $row['username'];
		$content .= '<li class="' . $rnIBicon . ' IBmembernew" title="' . _ALT_CHKPROFILE . $lastusername . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['username'] . '" title="' . _ALT_CHKPROFILE . $lastusername . '">' . $TruncateUser . '</a></li>'.PHP_EOL;
		if ($newusercounter==$latestusers){
			$content .= '</ul>'.PHP_EOL;
		}
	}
	$db->sql_freeresult($result);
	$content .= '</div>'.PHP_EOL;
}
$m = 0;
if ($viewlevel>=$who_is_online_view) {
	// WHOS ONLINE
	$members = '';
	$guests = '';
	$m = $g = 0;
	$sql = "SELECT uname, time, host_addr, guest FROM ". $prefix ."_session WHERE time > '".( time() - ($max_session_mins * 60) )."' ORDER BY guest ASC,time DESC";
	if (!($result = $db->sql_query($sql))) {
		// error
		die('error getting online users');
	}
	$content .= '<div class="IBinfosection" id="IBsection6">'.PHP_EOL;
	$content .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBmembers' . $IBadjust . $IBadjust . '" alt="' . _BON . '" /><span class="IBtextpad thick">' . _BON . '</span></div>'.PHP_EOL;

	while($row = $db->sql_fetchrow($result)) {
		if ($row['guest'] == 0) {
			$m++;
			if ($m <= $max_display_members) {
				$TruncateUser = strlen($row['uname'])<=$nameMaxLength?$row['uname']:substr($row['uname'],0,$nameMaxLength).'...'; // 2.2.0
				$lastusername = $row['uname'];
				$onlinenames[] = $lastusername;

				$members .= '<li class="' . $rnIBicon . ' IBonline2" title="' . _BON . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['uname'] . '" title="' . _ALT_CHKPROFILE . $lastusername . '">' . $TruncateUser . '</a></li>'.PHP_EOL;
			}
		} else {
			$g++;
			if ($viewlevel>=$show_guest_guest && $g <= $max_display_guests) {
				if (is_admin($admin)) {
					if ($whoisUseModal){
						$uname = '<a class="IBmodal" href="http://' . $whoisServerString . $row['uname'] . '">' . $row['uname'] . '</a>';
					} else {
						$uname = '<a target="_blank" href="http://' . $whoisServerString . $row['uname'] . '">' . $row['uname'] . '</a>';
					}
				} else {
					// hide last 2 octets of guest ip's.
					$ip = explode('.', $row['uname']);
					$uname = $ip[0] . '.' . $ip[1] . '.' . preg_replace("/(0|1|2|3|4|5|6|7|8|9)/", "x", $ip[2]) . '.' . preg_replace("/(0|1|2|3|4|5|6|7|8|9)/", "x", $ip[3]);
				}
				$guests .= '<li class="' . $rnIBicon . ' IBonlineguest" title="' . _BON . '">' . $uname . '</li>'.PHP_EOL;
			}
		}
	}
	$db->sql_freeresult($result);

	if (($viewlevel>=$showonlinecount) AND (($m > 0) OR ($g > 0 AND !$OnlineGuestsModal))) {
		$content .= '<div class="IBsmallnotes">';
		if ($m > 0) {
			$content .= _BMEM . ':<span class="thick">' . $m . '</span>';
		}
		if ($g > 0 AND !$OnlineGuestsModal) {
			$content .= ' ' . _BVIS . ':<span class="thick">' . $g . '</span>';
		}
		$content .= '&nbsp;</div>'.PHP_EOL;
	}

	if (($m > 0) OR ($viewlevel>=$show_guest_guest && $g > 0)) {
		if ($g > 0 AND $OnlineGuestsModal AND $viewlevel == 2) {
			$content .= '<div style="display:none">'.PHP_EOL;
			$content .= '<div id="IBGuestsView" style="margin-left:20px;">'.PHP_EOL;
			$content .= '<h1>' . _BON . '</h1>'.PHP_EOL;
			$content .= '<ul class="rninfobox">'.PHP_EOL;
			$content .= $guests;
			$content .= '</ul>'.PHP_EOL;
			$content .= '</div>'.PHP_EOL;
			$content .= '</div>'.PHP_EOL;
		}
		$content .= '<ul class="rninfobox">'.PHP_EOL;
	}
	if ($g > 0 AND $OnlineGuestsModal) {
		$content .= '<li class="' . $rnIBicon . ' IBonlineguest" title="' . _BON . '">';
		if ($viewlevel == 2) {
			$content .= '<a class="IBGuestsModal" href="#">' . $g . ' ' . _BVIS . '</a>';
		} else {
			$content .= $g . ' ' . _BVIS;
		}
		$content .= '</li>' . PHP_EOL;
	}
	if ($m > 0) {
		$content .= $members;
	}
	if ($g > 0 AND !$OnlineGuestsModal) {
		$content .= $guests;
	}
	if (($m > 0) OR ($viewlevel>=$show_guest_guest && $g > 0)) {
		$content .= '</ul>'.PHP_EOL;
	}
	$content .= '</div>'.PHP_EOL;
}
// LAST SEEN MEMBERS
if ($viewlevel>=$lastseen_user_view) {
	$lastseennumber = intval($lastseen_count)+$m;
	if (is_user($user)) {
		$exclusion = 'AND username!=\'' . $displayname . '\' ';
	} else {
		$exclusion = '';
	}
	$sql = 'SELECT username, lastsitevisit FROM ' . $user_prefix . '_users WHERE username!=\'' . $anonyname . '\' ' . $exclusion . 'ORDER BY lastsitevisit DESC LIMIT ' . $lastseennumber;
	$latestusers = $db->sql_numrows($result = $db->sql_query($sql));
	$latestusercounter = 1;
	if ($latestusers > 0) {
		$latuse = '<div class="IBinfosection" id="IBsection7">'.PHP_EOL;
		$latuse .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBlastseen' . $IBadjust . '" alt="' . _INFOBOX_LAST_SEEN . '" /><span class="IBtextpad thick">' . _INFOBOX_LAST_SEEN . '</span></div>'.PHP_EOL;
		$latuse .= '<ul class="rninfobox">'.PHP_EOL;
		while( $row = $db->sql_fetchrow($result) ) {
			if ($latestusercounter <= $lastseen_count) {
				$TruncateUser = strlen($row['username'])<=$nameMaxLength?$row['username']:substr($row['username'],0,$nameMaxLength).'...'; // 2.2.0
				$lastusername = $row['username'];
				$row['lastsitevisit'] = date('d F Y H:i', $row['lastsitevisit']);
				if (!in_array($lastusername, $onlinenames)){
					$latestusercounter += 1;
					$latuse .= '<li class="' . $rnIBicon . ' IBonline"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['username'] . '" title="' . _INFOBOX_LAST_SEEN . ': ' . $row['lastsitevisit'] . '">' . $TruncateUser . '</a></li>'.PHP_EOL;
				}
			}
		}
		$latuse .= '</ul>'.PHP_EOL;
		$db->sql_freeresult($result);
		$latuse .= '</div>'.PHP_EOL;
	}
	if ($latestusercounter > 1) $content .= $latuse;
}
// SERVER TRAFFIC
if ($viewlevel>=$servertraffic_view) {
	$content .= '<div class="IBinfosection" id="IBsection8">'.PHP_EOL;
	$content .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBtraffic' . $IBadjust . '" alt="' . _INFOBOX_SERVERTRAFFIC . '" /><span class="IBtextpad thick">' . _INFOBOX_SERVERTRAFFIC . '</span></div>'.PHP_EOL;
	$content .= '<ul class="rninfobox">'.PHP_EOL;
	$totalhits = 0;
	$result = $db->sql_query('SELECT sum(hits) FROM ' . $prefix . '_stats_year');
	list($totalhits) = $db->sql_fetchrow($result);
	$content .= '<li class="' . $rnIBicon . ' IBtotalhits" title="' . _WERECEIVED . ' ' . number_format($totalhits,0) . ' ' . _PAGESVIEWS . ' ' . $startdate . '">' . _INFOBOX_TOTALHITS.number_format($totalhits,0) . '</li>'.PHP_EOL;
	$today = 0;
	$todayDST = date('I',time())*3600;
	$t_time = time()-$todayDST;
	$t_year = date('Y', $t_time);
	$t_month = date('n', $t_time);
	$t_date = date('j', $t_time);
	$result = $db->sql_query('SELECT hits FROM ' . $prefix . '_stats_date WHERE year=' . $t_year . ' AND month=' . $t_month . ' AND date=' . $t_date);
	list($today) = $db->sql_fetchrow($result);
	$content .= '<li class="' . $rnIBicon . ' IBtodayhits" title="' . _INFOBOX_TODAYHITS.number_format($today,0) . '">' . _INFOBOX_TODAYHITS.number_format($today,0) . '</li>'.PHP_EOL;
	if ($how_many_years>0 AND $viewlevel>=$traffic_year_view) {
		$sql = 'SELECT year, hits FROM ' . $prefix . '_stats_year ORDER BY year DESC LIMIT ' . intval($how_many_years);
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$content .= '<li class="' . $rnIBicon . ' IByearlyhits" title="' . $row['year'] . ': ' . number_format($row['hits']) . '">' . $row['year'] . ': ' . number_format($row['hits']) . '</li>'.PHP_EOL;
		}
	}
	$content .= '</ul>'.PHP_EOL;
	$content .= '</div>'.PHP_EOL;
}
// SERVER DATE/TIME
$content .= '<div class="IBinfosection" id="IBsection9">'.PHP_EOL;
$content .= '<div><img src="' . $IBtran . '" class="' . $IBicon . ' IBserver' . $IBadjust . '" alt="' . _INFOBOX_SERVERINFO . '" /><span class="IBtextpad thick">' . _INFOBOX_SERVERINFO . '</span></div>'.PHP_EOL;
$content .= '<ul class="rninfobox">'.PHP_EOL;
$content .= '<li class="' . $rnIBicon . ' IBserdate" title="' . _SERDT . '">' . date('M d, Y') . '</li>'.PHP_EOL;
$content .= '<li class="' . $rnIBicon . ' IBtime" title="' . _SERDT . '">' . date('h:i a T') . '</li>'.PHP_EOL;
if ((is_admin($admin)) and (defined('RAVENNUKE_VERSION_FRIENDLY'))) {
	$content .= '<li class="' . $rnIBicon . ' IBglobe" title="RN ' . RAVENNUKE_VERSION_FRIENDLY . '">RN ' . RAVENNUKE_VERSION_FRIENDLY . '</li>'.PHP_EOL;
}
$content .= '</ul>'.PHP_EOL;
$content .= '</div>'.PHP_EOL;
$content .= '</div></div>'.PHP_EOL;
// make sure content does not float outside the block
$content .= '<div class="block-spacer">&nbsp;</div>'.PHP_EOL;
$content .= '<!-- END Info -->'.PHP_EOL;
?>
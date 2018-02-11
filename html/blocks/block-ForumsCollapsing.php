<?php
########################################################################
# This program is free software. You can redistribute it and/or modify #
# it under the terms of the GNU General Public License as published by #
# the Free Software Foundation; either version 2 of the License.       #
# If you modify this, let me know for fun. =)                          #
########################################################################
# Raven modified (heavily) to use a collapsing table structure.        #
# Date Released: Original: 01/23/2004                                  #
#              : v2.0.0  : 07/14/2005                                  #
#              : v2.0.1  : 07/16/2005                                  #
#              : v2.1.0  : 08/21/2005                                  #
#              : v2.2.0  : 10/23/2005                                  #
#              : v2.3.0  : 01/19/2006                                  #
#              : v2.3.1  : 02/13/2006                                  #
#              : v2.3.2  : 03/14/2007                                  #
#              : v2.3.3  : 03/17/2007                                  #
#              : v2.3.4  : 09/21/2008                                  #
# Support      : http://ravenphpscripts.com                            #
# Hosting      : http://ravenwebhosting.com                            #
# RavenNuke(tm): http://ravennuke.com                                  #
# Version: 2.3.4                                                       #
########################################################################
# Version 2.3.4                                                        #
# 09/21/2008  : Converted all the & to &amp;.  I'm not sure why I had  #
#             : not done before but it is done now!                    #
# Version 2.3.3                                                        #
# 03/17/2007  : Modified the code to allow the backendforums xml icon  #
#             : to show when Show Top Posters is NOT selected.         #
# Version 2.3.2                                                        #
# 03/14/2007  : Corrected reference to hard coded "forumsbackend.php"  #
#             : to reference the "$backendForumsXML" setting.  Thanks  #
#             : to Misha for pointing this out.                        #
# Version 2.3.1                                                        #
# 02/13/2006  : Modified default empty $skipTopPostersUserNames="''"   #
#             : due to certain releases of MySQL behavior.             #
#             : Added setting ($showTickerMessage) to control ticker   #
# Version 2.3.0                                                        #
# 11/27/2005  : Modified behavior of $showJumpBox to $showJumpBoxes    #
#             : Added setting ($showTickerMessage) to control ticker   #
# 11/13/2005  : Converted drop down boxes to use FieldSet              #
#             : Removed underlining of Jump To boxes                   #
#             : Added style tag for text color to optgroup             #
# 01/19/2006  : Added style sheet for show/hide button                 #
#             : Moved language defines to their own language folder    #
# Version 2.2.0                                                        #
# 10/23/2005  : Released.                                              #
# 10/23/2005  : Automated the recognizing of Admin and Moderators.     #
# 10/21/2005  : Restored some links that had been mistakenly GT'd.     #
# 10/20/2005  : Fixed links and titles for differentiatng forum, topic #
#               and last topic post.        .                          #
# 10/19/2005  : Added setting for number of posters/row and automated  #
#               the newline routine for same.                          #
# 10/15/2005  : Modified TopTenPoster verbiage and code to Top Posters.#
#               to allow for varying number to show.                   #
# 10/16/2005  : Modified code to not show hyper-links of profiles to   #
#               Anaonymous users.  This is for better SEO. It is       #
#               controllable through setting $hideLinksFromGuests      #
# Version 2.1.0                                                        #
# 08/21/2005  : Added routine to allow manual hiding of selected forums#
#               Renamed a few variables for standardization purposes.  #
# 08/20/2005  : Added routine to adjust displayed post time by profile #
# 08/13/2005  : Added border="0" to xmlicon - Thanks CurtisH           #
#               Added manual routines to recognise admins and mods in  #
#               order to hilite their roles when mousing over their    #
#               icons in the Top 10 posters. This could be automated,  #
#               but until that happens, this will suffice.             #
# Version 2.0.1                                                        #
# 07/16/2005  : Fixed layout of ticking message                        #
# Version 2.0.0                                                        #
# 07/14/2005  : Added a drop down box for a Jump-To Forum.  This was   #
#               suggested by ring_c. It has an optional switch.        #
#             : Converted several navigational links to drop down.     #
#             : Converted all text to language defines.                #
#             : Created some settings to make more flexible.           #
#             : Added ability to exclude user names from top ten list. #
# 06/19/2005  : Removed some not used code.                            #
#               Added top ten posters with avatars.  Made it optional. #
# 05/03/2005  : Added Watched Posts to header menu                     #
# 02/14/2004  : optimized sql for faster building                      #
# 05/25/2004  : Added code to identify the Forum and Section           #
# 06/28/2004  : Fixed code to show the Forum and Section when NOT in   #
#               hideViewReadOnly mode.                                 #
# 12/03/2004  : Added truncation to poster name and last replied name. #
########################################################################

global $admin, $bgcolor1, $bgcolor2, $currentlang, $db, $language, $prefix, $sitename, $textcolor1, $textcolor2, $user, $userinfo, $user_prefix;

if(!defined('IN_PHPBB')) define('IN_PHPBB', TRUE);
require_once NUKE_MODULES_DIR . 'Forums/includes/constants.php';

$hideLinksFromGuests = FALSE;
$hideTheseForums = '-1';  // use a comma delimited list of forum id's to hide like '1,5,8'
$tickerBGColor = $bgcolor2;
$tickDelay = 4000; // in miliseconds
$lastNewTopics = 25; // Number of topics to show when list is expanded
$countTopics = 0;
$showClosedNum = 3; // Number of messages that are visible when collapsed
$showJumpBoxes = TRUE; // Display or don't display the 2 Jump Boxes
$showTopPosters = 2;  // 0=None, 1=Username - no avatar,  2=Username and avatar
$showTopPostersRanks = 3;  // 0=None, 1=Admin only, 2=Moderator only, 3=Admin and Moderator, 4=All
$showTopPostersNum = 5;  // Total number of top posters to show
$showTopPostersPerRow = 5;  // Number to show per line
$showTickerMessage = TRUE; // show/hide the top ticker message
$skipTopPostersUserNames = "''"; // use a comma separated list with each name in single quotes, like 'user1','user2'.
$backendForumsXML = 'forumsbackend.php';  //Filename of the xml script.  Assumed in root directory.

//////////////////////////////////////////////////////////////////
// THERE SHOULD BE NO NEED TO EDIT BELOW THIS LINE
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

if(file_exists('language/rwsforumcollapsing/lang-' . $currentlang . '.php')) {
	include_once 'language/rwsforumcollapsing/lang-' . $currentlang . '.php';
} elseif(file_exists('language/rwsforumcollapsing/lang-' . $language . '.php')) {
	include_once 'language/rwsforumcollapsing/lang-' . $language . '.php';
} else {
	include_once 'language/rwsforumcollapsing/lang-english.php';
}

/*
* The following should not be changed.  If you need to modify them, modify them in the language folder.
* These are strictly local scope
*/
$bfcShowHide = bfcSHOWHIDEBUTTONTEXT;
$bfcJumpForum = bfcJUMPFORUM;
$bfcJumpFunction = bfcJUMPFUNCTION;
$bfcForum = bfcFORUM;
$bfcTopic = bfcTOPIC;
$bfcReplies = bfcREPLIES;
$bfcAuthor = bfcAUTHOR;
$bfcViews = bfcVIEWS;
$bfcLastPost = bfcLASTPOST;

// Calculate posting time offset for user defined timezones
$serverTimeZone = date('Z') / 3600;
if ($serverTimeZone >= 0) {
	$serverTimeZone = '+' . $serverTimeZone;
}
if (is_user($user)) {
	$userinfo = getusrinfo($user);
	$userTimeZone = $userinfo['user_timezone'];
} else {
	$sql  = 'SELECT `config_value` FROM `' . $prefix . '_bbconfig` WHERE `config_name`="board_timezone"';
	$result = $db->sql_query($sql);
	$rows = $db->sql_fetchrow($result);
	$userTimeZone = $rows['config_value'];
}
$userTimeZone = ($userTimeZone - $serverTimeZone) * 3600;
if (!is_numeric($userTimeZone)) {
	$userTimeZone = 0;
}

$javascript_content = '
<script type="text/javascript" language="JavaScript">
	$(document).ready(function(){
		var elem;
		var topic_count;

		topic_count = $("tr.child_topic").length;
		if(topic_count >= 1) {
			$("#main_topic").siblings(".child_topic").hide();
			$("#show_hide").click(function(){
				//$("#main_topic").siblings(".child_topic").toggle();
				var elem = $(".child_topic")[0];
				if(elem.style.display == "none") {
					$(".child_topic").show();
				} else {
					$(".child_topic").hide();
				}
				return false;
			});
		}
	});
</script>';

if ($showTickerMessage) {
	$javascript_content .= '
	<script type="text/javascript" language="JavaScript">
		var current_topic;
		var vurrent_topic_html;
		var old_topic = -1;
		var topic_count;
		var topic_interval;

		$(document).ready(function(){
			topic_count = $("tr.child_topic").length;
			if(topic_count >= 1) {
				topic_interval = setInterval(topic_rotate,' . $tickDelay . ');
				topic_rotate();
			} else {
				$("#main_topic").remove()
			}
		});

		function topic_rotate() {
			current_topic = (old_topic + 1) % topic_count;
			current_topic_html = $("tr.child_topic:eq(" + current_topic + ")").html();
			$("tr#main_topic").html(current_topic_html);
			old_topic = current_topic;
		}
	</script>';
}

$content = '';

if (strlen($backendForumsXML)>0) {
	$content .= '<div style="text-align: center"><a href="' . $backendForumsXML . '" title="' . bfcBACKENDTITLE . '"><img src="images/blocks/xmlicon.gif" alt="" border="0" /></a></div><br />';
}

if ($showTopPosters==1 || $showTopPosters==2) {
	$sql = 'SELECT `user_id`, `username`, `user_posts`, `user_avatar`, `user_level`, `rank_title`, `rank_id` FROM `' . $user_prefix . '_users` u LEFT JOIN `' . $prefix . '_bbranks`'
		. ' r on u.user_rank=r.rank_id WHERE `username` NOT IN (' . $skipTopPostersUserNames . ') ORDER BY `user_posts` DESC LIMIT 0,' . $showTopPostersNum;
	$result=$db->sql_query($sql);
	$num_posters=$db->sql_numrows($result);
	$content .= '<div style="text-align: center"><span style="font-weight: bold; text-decoration: underline;">' . bfcTOPPOSTERS . '</span><br /><br /><table class="outer" cellpadding="0"'
			. ' style="border-collapse: collapse; border-color: ' . $textcolor1 . '; margin: 0 auto; vertical-align: middle;" cellspacing="1" border="0">';
	$cycle = 1;
	$content .= '<tr class="even">';
	while(list($user_id, $username, $user_posts, $user_avatar, $user_level, $rank_title, $rank_id) = $db->sql_fetchrow($result)) {
		$staffTitle = '';
		if ($showTopPostersRanks==3) {
			if ($user_level==2||$user_level==3) {
				$staffTitle = 'title="' . $rank_title . '"';
			} else {
				$staffTitle = '';
			}
		} elseif ($showTopPostersRanks==4) {
			$staffTitle = 'title="' . $rank_title . '"';
		} elseif ($showTopPostersRanks==1) {
			if ($user_level==2) {
				$staffTitle = 'title="' . $rank_title . '"';
			} else {
				$staffTitle = '';
			}
		} elseif ($showTopPostersRanks==2) {
			if ($user_level==3) {
				$staffTitle = 'title="' . $rank_title . '"';
			} else {
				$staffTitle = '';
			}
		}

		$newLine = FALSE;
		if ($showTopPosters==2) {
			$content .= '<td align="center">';
			if ($user_avatar == '') {
				$content .= '&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $user_id . '" ' . $staffTitle . '>'
						. '<img alt="" src="modules/Forums/images/avatars/noimage.gif" border ="0" width="32" /></a></td>';
			} elseif (stristr($user_avatar, 'http://')) {
				$content .= '&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $user_id . '" ' . $staffTitle . '>'
						. '<img alt="" src="' . $user_avatar . '" border ="0" width="32" /></a></td>';
			} else {
				$content .= '&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $user_id . '" ' . $staffTitle . '>'
						. '<img alt="" src="modules/Forums/images/avatars/' . $user_avatar . '" border ="0" width ="32" /></a></td>';
			}
		}
		$content .= '<td>&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $user_id . '" ' . $staffTitle . '>'
				. '<span style="font-weight: bold;">' . $username . '</span></a>&nbsp;<br />&nbsp;'
				. '<a href="modules.php?name=Forums&amp;file=search&amp;mode=results&amp;search_author=' . $username . '" ' . $staffTitle . '>Posts:</a>'
				. '&nbsp;<a href="modules.php?name=Forums&amp;file=search&amp;mode=results&amp;search_author=' . $username . '" ' . $staffTitle . '>' . $user_posts . '</a>&nbsp;</td>';
		if (!($cycle % $showTopPostersPerRow) || $cycle == $num_posters) {
			$content .= '</tr>';
		}
		$cycle++;
	}
	$content .= '</table></div><br />';
}

if ($hideLinksFromGuests && !(is_admin($admin) || is_user($user))) {
	$content = strip_tags($content, '<tr><td><img><table><div>');
}
$content = addJSToBody($javascript_content,'inline') . $content;

if ($showJumpBoxes) {
	if(!defined('IN_PHPBB')) define('IN_PHPBB', TRUE);
	require_once NUKE_MODULES_DIR . 'Forums/includes/constants.php';
	$sql = 'SELECT c.cat_id, c.cat_title, c.cat_order
			FROM `' . $prefix . '_bbcategories` c, `' . $prefix . '_bbforums` f
			WHERE f.cat_id = c.cat_id
			GROUP BY c.cat_id, c.cat_title, c.cat_order
			ORDER BY c.cat_order';
	if ( !($result = $db->sql_query($sql)) ) {
		$content = bfcGETCATEGORYLISTERROR . bfcMYSQLSAID . $db->error;
	}

	$category_rows = array();
	while ( $row = $db->sql_fetchrow($result) ) {
		$category_rows[] = $row;
	}

	if ( $total_categories = count($category_rows) ) {
		$sql = 'SELECT *
				FROM `' . $prefix . '_bbforums`
				ORDER BY `cat_id`, `forum_order`';
		if ( !($result = $db->sql_query($sql)) ) {
			$content = bfcGETFORUMINFOERROR . bfcMYSQLSAID . $db->error;
		}

		$boxstring = '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ top.location.href=this.options[this.selectedIndex].value }">'
					. '<optgroup label="' . 'Select Forum' . '" style="color:' . $textcolor2 . '"><option value="-1">&nbsp;</option></optgroup>';

		$forum_rows = array();
		while ( $row = $db->sql_fetchrow($result) ) {
			$forum_rows[] = $row;
		}

		if ( $total_forums = count($forum_rows) ) {
			for($i = 0; $i < $total_categories; $i++) {
				$boxstring_forums = '';
				for($j = 0; $j < $total_forums; $j++) {
					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$j]['auth_view'] <= AUTH_REG ) {
						$boxstring_forums .=  '<option value="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_rows[$j]['forum_id'] . '">' . $forum_rows[$j]['forum_name'] . '</option>';
					}
				}

				if ( $boxstring_forums != '' ) {
					$boxstring .= '<optgroup label="' . $category_rows[$i]['cat_title'] . '" style="color:' . $textcolor2 . '">';
					$boxstring .= $boxstring_forums . '</optgroup>';
				}
			}
		}
		$boxstring .= '</select>';
	} else {
		$boxstring = '<select name="' . POST_FORUM_URL . '"><option value="-1">&nbsp;</option></select>';
	}

	if ( !empty($SID) ) {
		$boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
	}
}

$links = '<select onchange="if(this.options[this.selectedIndex].value != -1){ top.location.href=this.options[this.selectedIndex].value }">'
		. '<optgroup style="color:' . $textcolor2 . ';" label="' . bfcSELECT . '"><option value="-1">&nbsp;</option>'
		. '<option value="modules.php?name=Forums&amp;file=search&amp;search_id=unanswered">' . bfcVIEWUNANSWEREDPOSTS . '</option>'
		. '<option value="modules.php?name=Forums">' . bfcFORUMINDEX . '</option>'
		. '<option value="modules.php?name=Forums&amp;file=search">' . bfcSEARCHFORUMS . '</option>';
if (is_user($user)) {
	$links .= '<option value="modules.php?name=Forums&amp;file=search&amp;search_id=newposts">' . bfcVIEWPOSTSSINCELASTVISIT . '</option>'
		. '<option value="modules.php?name=Forums&amp;file=search&amp;search_id=egosearch">' . bfcVIEWYOURPOSTS . '</option>'
		. '<option value="modules.php?name=Watched_Topics">' . bfcWATCHEDTOPICS . '</option>'
		. '<option value="modules.php?name=Forums&amp;file=profile&amp;mode=editprofile">' . bfcPROFILE . '</option>'
		. '<option value="modules.php?name=Private_Messages&amp;file=index&amp;folder=inbox">' . bfcPRIVATEMESSAGES . '</option>';
}
$links .= '</optgroup></select>';
$content .= '<div style="text-align: center">';
if ($showJumpBoxes) {
	$content .= '<table width="100%"><tr>'
			. '<td><span style="font-weight: bold;">' . $bfcJumpFunction . '</span></td>'
			. '<td><span style="font-weight: bold;">' . $bfcJumpForum . '</span></td></tr>'
			. '<tr><td>' . $links . '</td><td>' . $boxstring . '</td></tr>'
			. '</table><br />';
}
$content .= '<table style="background-color: ' . $tickerBGColor . ';"><tr>'
		. '<th height="25" width="100%" nowrap="nowrap"><span style="color:' . $textcolor1 . ';"><strong><span class="italic">[' . $bfcForum . ']</span>&nbsp;' . $bfcTopic . '</strong></span></th>'
		. '<th height="25" nowrap="nowrap"><span style="color:' . $textcolor1 . ';"><strong>&nbsp;' . $bfcReplies . '&nbsp;</strong></span></th>'
		. '<th height="25" nowrap="nowrap"><span style="color:' . $textcolor1 . ';"><strong>&nbsp;' . $bfcAuthor . '&nbsp;</strong></span></th>'
		. '<th height="25" nowrap="nowrap"><span style="color:' . $textcolor1 . ';"><strong>&nbsp;' . $bfcViews . '&nbsp;</strong></span></th>'
		. '<th height="25" nowrap="nowrap"><span style="color:' . $textcolor1 . ';"><strong>&nbsp;' . $bfcLastPost . '&nbsp;</strong></span></th>'
		. '</tr>';

if ($showTickerMessage) {
	$id = '';
} else {
	$id = ' id="main_topic"';
}
$content .=	'<tr' . $id . ' bgcolor="' . $tickerBGColor . '"><td colspan="4"><div style="text-align: left;">'.bfcSHOWHIDELABELTEXT.'</div></td>'
		. '<td id="show_hide"><div style="margin: 0 auto; border: 1px solid #4B4B4B; background-color: ' . $bgcolor1 . '; width: 60px; height: 12px; font: normal 11px Arial, Verdana, Helvetica, sans-serif; text-align: center;'
		. ' cursor: pointer;">' . $bfcShowHide . '</div></td></tr>';

if ($showTickerMessage) {
	$content .= '<tr id="main_topic"><td bgcolor="' . $bgcolor1 . '" class="row1"></td>'
			. '<td bgcolor="' . $bgcolor1 . '" class="row2"></td>'
			. '<td bgcolor="' . $bgcolor1 . '" class="row3"></td>'
			. '<td bgcolor="' . $bgcolor1 . '" class="row2"></td>'
			. '<td bgcolor="' . $bgcolor1 . '" class="row3"></td></tr>';
}

if (!function_exists('auth')) {
	function auth($userdata) {
		global $db, $prefix, $user;

		$a_sql = 'auth_view, auth_read';
		$auth_fields = array('auth_view', 'auth_read');

		/*
		* We need to pull the auth information on the all forums
		*/

		$sql = 'SELECT forum_id, ' . $a_sql
					. ' FROM `' . $prefix . '_bbforums`';
		$result = $db->sql_query($sql);

		if ( !($f_access = $db->sql_fetchrowset($result)) ) {
			return array();
		}

		/*
		* If the user isn't logged on then all we need do is check if the forum
		* has the type set to ALL, if yes they are good to go, if not then they
		* are denied access
		*/
		$u_access = array();

		if (is_user($user)) {
			$sql = 'SELECT a.forum_id, ' . $a_sql . ', a.auth_mod '
						. 'FROM `' . $prefix . '_bbauth_access` a, `' . $prefix . '_bbuser_group` ug '
						. 'WHERE ug.user_id = ' . $userdata['user_id']
							. ' AND ug.user_pending = 0'
							. ' AND a.group_id = ug.group_id';
			$result = $db->sql_query($sql);

			if ( $row = $db->sql_fetchrow($result) ) {
				do{
						$u_access[$row['forum_id']][] = $row;
				} while( $row = $db->sql_fetchrow($result) );
			}
			/*
			* Is user an admin?
			*/
			$is_admin = ( $userdata['user_level'] == 2 ) ? TRUE : 0;
		} else {
			$is_admin = 0;
		}

		$auth_user = array();
		for($i = 0; $i < count($auth_fields); $i++) {
			$key = $auth_fields[$i];

			/*
			* If the type if ACL, MOD or ADMIN then we need to see if the user has specific permissions
			* to do whatever it is they want to do ... to do this we pull relevant information for the
			* user (and any groups they belong to)
			*
			* Now we compare the users access level against the forums. We assume here that a moderator
			* and admin automatically have access to an ACL forum, similarly we assume admins meet an
			* auth requirement of MOD
			*/
			for($k = 0; $k < count($f_access); $k++) {
				$value = $f_access[$k][$key];
				$f_forum_id = $f_access[$k]['forum_id'];
				$u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();
				switch( $value ) {
					case AUTH_ALL:
						$auth_user[$f_forum_id][$key] = TRUE;
						break;
					case AUTH_REG:
						$auth_user[$f_forum_id][$key] = TRUE;
						break;
					case AUTH_ACL:
						$auth_user[$f_forum_id][$key] = auth_check_user(AUTH_ACL, $key, $u_access[$f_forum_id], $is_admin);
						break;
					case AUTH_MOD:
						$auth_user[$f_forum_id][$key] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin);
						break;
					case AUTH_ADMIN:
						$auth_user[$f_forum_id][$key] = $is_admin;
						break;
					default:
						$auth_user[$f_forum_id][$key] = 0;
						break;
				}
			}
		}

		/*
		* Is user a moderator?
		*/
		for($k = 0; $k < count($f_access); $k++) {
			$f_forum_id = $f_access[$k]['forum_id'];

			$u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();
			$auth_user[$f_forum_id]['auth_mod'] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin);
		}

		return $auth_user;
	}
}

if (!function_exists('auth_check_user')) {
	function auth_check_user($type, $key, $u_access, $is_admin) {
		$auth_user = 0;

		if ( count($u_access) ) {
			for($j = 0; $j < count($u_access); $j++) {
				$result = 0;
				switch($type) {
					case AUTH_ACL:
						$result = $u_access[$j][$key];
					case AUTH_MOD:
						$result = $result || $u_access[$j]['auth_mod'];
					case AUTH_ADMIN:
						$result = $result || $is_admin;
						break;
				}

				$auth_user = $auth_user || $result;
			}
		} else {
			$auth_user = $is_admin;
		}

		return $auth_user;
	}
}

/*
* Get users forum permissions
*/
$f_permission = auth($userinfo);

$result = $db->sql_query( 'SELECT t.topic_id, t.forum_id, t.topic_last_post_id, t.topic_title, t.topic_poster, t.topic_views, t.topic_replies, t.topic_moved_id, t.topic_status, f.forum_name'
						. ' FROM `' . $prefix . '_bbtopics` t, `' . $prefix . '_bbforums` f'
						. ' WHERE t.forum_id NOT IN(' . $hideTheseForums . ') AND t.forum_id=f.forum_id ORDER BY t.topic_last_post_id DESC');

$cnt = 0;
while( list( $topic_id, $forum_id, $topic_last_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_moved_id, $topic_status, $forum_name ) = $db->sql_fetchrow( $result ) ) {
	$skip_display = 0;
	$result1 = $db->sql_query( 'SELECT `auth_view`, `auth_read`, `forum_name`, `cat_id` FROM `' . $prefix . '_bbforums` WHERE `forum_id` = "' . $forum_id . '"');
	list( $auth_view, $auth_read, $forum_name, $cat_id ) = $db->sql_fetchrow( $result1 );

	if ( ( $auth_view != 0 ) || ( $auth_read != 0 ) ) {
		if ($f_permission[$forum_id]['auth_read'] == FALSE) {
			$skip_display = 1;
		}
	}

	if( $topic_moved_id != 0 ) {
		// Shadow Topic !!
		$skip_display = 1;
	}

	if( $skip_display == 0 || is_admin($admin)) {
		if ($cnt >= $showClosedNum) {
			$class = ' class="child_topic" style="display: none"';
		} else {
			$class = '';
		}
		$countTopics += 1;
		$result5 = $db->sql_query('SELECT `cat_title` FROM `' . $prefix . '_bbcategories` WHERE `cat_id`="' . $cat_id . '"');
		list($cat_title)=$db->sql_fetchrow($result5);
		$result2 = $db->sql_query('SELECT `username`, `user_id` FROM `' . $user_prefix . '_users` WHERE `user_id`="' . $topic_poster . '"');
		list($username, $user_id)=$db->sql_fetchrow($result2);
		$avtor=$username;
		$sifra=$user_id;
		$result4 = $db->sql_query('SELECT u.username, u.user_id, p.poster_id, FROM_UNIXTIME(p.post_time + ' . $userTimeZone . ') as post_time'
								. ' FROM `' . $user_prefix . '_users` u, `' . $prefix . '_bbposts` p WHERE u.user_id=p.poster_id AND p.post_id="' . $topic_last_post_id . '"');
		list($username, $user_id, $poster_id, $post_time)=$db->sql_fetchrow($result4);
		$_username = substr($username,0,15);
		$_avtor = substr($avtor,0,15);
		if ($topic_status) {
			$lockTopic = '<img src="/images/blocks/locktopicgray.gif" width="14" height="14" alt="' . bfcTOPICLOCKED . '" title="' . bfcTOPICLOCKED . '" border="none" /> ';
		} else {
			$lockTopic = '';
		}
		if (!$hideLinksFromGuests || is_admin($admin) || is_user($user)) {
			$content .= '<tr' . $class .'><td bgcolor="' . $bgcolor1 . '" class="row1"><div style="text-align: left; text-decoration: none; font-style: italic">&nbsp;&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_id . '" title="' . $forum_name . '">'
					. '[' . $cat_title . ':&nbsp;' . $forum_name . ']</a><br />'
					. '&nbsp;&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=viewtopic&amp;t=' . $topic_id . '" title="' . $topic_title . '">&nbsp;' . $lockTopic . $topic_title . '</a></div>'
					. '</td><td bgcolor="' . $bgcolor1 . '" class="row2">' . $topic_replies . '</td><td bgcolor="' . $bgcolor1 . '" class="row3">'
					. '<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $sifra . '">&nbsp;&nbsp;' . $_avtor . '&nbsp;&nbsp;</a></td><td bgcolor="' . $bgcolor1 . '" class="row2">' . $topic_views . '</td>'
					. '<td nowrap="nowrap" bgcolor="' . $bgcolor1 . '" class="row3"><span class="italic smaller">&nbsp;&nbsp;' . $post_time . '&nbsp;&nbsp;</span><br />'
					. '<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $user_id . '">&nbsp;&nbsp;' . $_username . '&nbsp;&nbsp;</a>&nbsp;<a href="modules.php?name=Forums&amp;file=viewtopic&amp;p=' . $topic_last_post_id . '#' . $topic_last_post_id . '">'
					. '<img src="images/blocks/icon_minipost_new.gif" alt="" border="0" /></a></td></tr>';
		} else {
			$content .= '<tr' . $class .'><td bgcolor="' . $bgcolor1 . '" class="row1"><div style="text-align: left; text-decoration: none; font-style: italic">&nbsp;&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_id . '" title="' . $forum_name . '">'
					. '[' . $cat_title . ':&nbsp;' . $forum_name . ']</a><br />'
					. '&nbsp;&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=viewtopic&amp;t=' . $topic_id . '" title="' . $topic_title . '">&nbsp;' . $lockTopic . $topic_title . '</a></div>'
					. '</td><td bgcolor="' . $bgcolor1 . '" class="row2">' . $topic_replies . '</td><td bgcolor="' . $bgcolor1 . '" class="row3">' . $_avtor .'</td>'
					. '<td bgcolor="' . $bgcolor1 . '" class="row2">' . $topic_views . '</td>'
					. '<td nowrap="nowrap" bgcolor="' . $bgcolor1 . '" class="row3"><span class="italic smaller">&nbsp;&nbsp;' . $post_time . '&nbsp;&nbsp;</span><br />'
					. $_username . '&nbsp;<img src="images/blocks/icon_minipost_new.gif" alt="" border="0" /></td></tr>';
		}
		$content = str_replace(chr(153), '(tm)', $content);
		$cnt++;
	}
	if( $lastNewTopics == $countTopics ) {
		break 1;
	}

}

$content .= '</table></div>';

?>
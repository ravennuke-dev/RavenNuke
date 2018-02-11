<?php

######################################################
# After you used this file, you can safely delete it.
######################################################
#            -= WARNING: PLEASE READ =-
#
# NOTE: This file uses config.php to retrieve needed
# variables values. So, to do the upgrade PLEASE copy
# this file in your server root directory and execute
# it from your browser.
######################################################

include("mainfile.php");

// Forums Table Update
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.11' where config_name='version'");
$db->sql_query("DROP TABLE IF EXISTS " . $prefix . "_bbconfirm");
$db->sql_query("CREATE TABLE ".$prefix."_bbconfirm (confirm_id char(32) DEFAULT '' NOT NULL, session_id char(32) DEFAULT '' NOT NULL, code char(6) DEFAULT '' NOT NULL, PRIMARY KEY (session_id, confirm_id))");
$result = $db->sql_query("SELECT * FROM " . $user_prefix . "_users WHERE `username` = 'Anonymous'");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
    $db->sql_query("UPDATE " . $user_prefix . "_users SET `user_id` = '-1' WHERE `username` = 'Anonymous' LIMIT 1");
    } else {
$db->sql_query("INSERT INTO " . $user_prefix . "_users (user_id, name, username, user_email, femail, user_website, user_avatar, user_regdate, user_icq, user_occ, user_from, user_interests, user_sig, user_viewemail, user_theme, user_aim, user_yim, user_msnm, user_password, storynum, umode, uorder, thold, noscore, bio, ublockon, ublock, theme, commentmax, counter, newsletter, user_posts, user_attachsig, user_rank, user_level, broadcast, popmeson, user_active, user_session_time, user_session_page, user_lastvisit, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_emailtime, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_avatar_type, user_sig_bbcode_uid, user_actkey, user_newpasswd, points, last_ip) VALUES (-1, '', 'Anonymous', '', '', '', 'blank.gif', 'Nov 10, 2000', '', '', '', '', '', 0, 0, '', '', '', '', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 10, NULL, 'english', 'D M d, Y g:i a', 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 0, 3, NULL, NULL, NULL, 0, 0)");
}
echo "BBtoNuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
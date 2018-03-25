<?php
/***************************************************************************
 *                            lang_main.php [Magyar magázó]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php,v 1.85.2.15 2003/06/10 00:31:19 psotfx Exp $
 *
 *     translated by   : Szilard Andai
 *     web             : http://iranon.ezustkep.hu
 *     version         : 2.0.22
 *     edited by       : Fodor Bertalan - http://phpbb.hu and László Miklós
 *
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//         Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'ISO-8859-2';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  'Y.m.d. l G:i'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = 'Magyar ford&iacute;t&aacute;s &copy; <a class="copyright" href="http://iranon.ezustkep.hu">Andai Szil&aacute;rd</a> - Mag&aacute;z&oacute; verzi&oacute;: <a class="copyright" href="http://www.phpbb.hu" title="Ford&iacute;t&aacute;s friss&iacute;t&eacute;se &eacute;s jav&iacute;t&aacute;sa valamint a mag&aacute;z&oacute; verzi&oacute; k&eacute;sz&iacute;t&eacute;se: Fodor Bertalan">Magyar phpBB k&ouml;z&ouml;ss&eacute;g</a> &eacute;s L&aacute;szl&oacute; Mikl&oacute;s';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'F&oacute;rum';
$lang['Category'] = 'T&eacute;mak&ouml;r';
$lang['Topic'] = 'T&eacute;ma';
$lang['Topics'] = 'T&eacute;m&aacute;k';
$lang['Replies'] = 'V&aacute;laszok';
$lang['Views'] = 'Megtekintve';
$lang['Post'] = 'Hozz&aacute;sz&oacute;l&aacute;s';
$lang['Posts'] = 'Hozz&aacute;sz&oacute;l&aacute;sok';
$lang['Posted'] = 'Elk&uuml;ldve';
$lang['Username'] = 'Felhaszn&aacute;l&oacute;n&eacute;v';
$lang['Password'] = 'Jelsz&oacute;';
$lang['Email'] = 'Email';
$lang['Poster'] = 'K&uuml;ld&otilde;';
$lang['Author'] = 'Szerz&otilde;';
$lang['Time'] = 'Id&otilde;';
$lang['Hours'] = '&Oacute;ra';
$lang['Message'] = '&Uuml;zenet';

$lang['1_Day'] = '1 nap';
$lang['7_Days'] = '7 nap';
$lang['2_Weeks'] = '2 h&eacute;t';
$lang['1_Month'] = '1 h&oacute;nap';
$lang['3_Months'] = '3 h&oacute;nap';
$lang['6_Months'] = '6 h&oacute;nap';
$lang['1_Year'] = '1 &eacute;v';

$lang['Go'] = 'Mehet';
$lang['Jump_to'] = 'Ugr&aacute;s';
$lang['Submit'] = 'Elk&uuml;ld';
$lang['Reset'] = 'T&ouml;r&ouml;l';
$lang['Cancel'] = 'M&eacute;gsem';
$lang['Preview'] = 'El&otilde;n&eacute;zet';
$lang['Confirm'] = 'Elfogad';
$lang['Spellcheck'] = 'Helyes&iacute;r&aacute;s';
$lang['Yes'] = 'Igen';
$lang['No'] = 'Nem';
$lang['Enabled'] = 'Bekapcsolva';
$lang['Disabled'] = 'Kikapcsolva';
$lang['Error'] = 'Hiba';

$lang['Next'] = 'K&ouml;vetkez&otilde;';
$lang['Previous'] = 'El&otilde;z&otilde;';
$lang['Goto_page'] = 'Ugr&aacute;s a k&ouml;v. oldalra:';
$lang['Joined'] = 'Csatlakozott';
$lang['IP_Address'] = 'IP-c&iacute;m';

$lang['Select_forum'] = 'F&oacute;rum kiv&aacute;laszt&aacute;sa';
$lang['View_latest_post'] = 'Legut&oacute;bbi hozz&aacute;sz&oacute;l&aacute;sok';
$lang['View_newest_post'] = 'Leg&uacute;jabb hozz&aacute;sz&oacute;l&aacute;sok';
$lang['Page_of'] = '<span class="thick">%d</span> / <span class="thick">%d</span> oldal'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ';
$lang['AIM'] = 'AIM';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = 'Tartalomjegyz&eacute;k';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = '&Uacute;j t&eacute;ma nyit&aacute;sa';
$lang['Reply_to_topic'] = 'Hozz&aacute;sz&oacute;l&aacute;s a t&eacute;m&aacute;hoz';
$lang['Reply_with_quote'] = 'Hozz&aacute;sz&oacute;l&aacute;s az el&otilde;zm&eacute;ny id&eacute;z&eacute;s&eacute;vel';

$lang['Click_return_topic'] = '%sVisszat&eacute;r&eacute;s%s a t&eacute;m&aacute;hoz.'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Kattintson %side%s, hogy ism&eacute;t megpr&oacute;b&aacute;lja.';
$lang['Click_return_forum'] = 'Kattintson %side%s, hogy visszat&eacute;rjenen a f&oacute;rumba.';
$lang['Click_view_message'] = 'Kattintson %side%s a hozz&aacute;sz&oacute;l&aacute;sa megtekint&eacute;s&eacute;hez.';
$lang['Click_return_modcp'] = '%sVisszat&eacute;r&eacute;s%s a Moder&aacute;tor vez&eacute;rl&otilde;pulthoz.';
$lang['Click_return_group'] = '%sVisszat&eacute;r&eacute;s%s a csoporthoz.';

$lang['Admin_panel'] = 'F&oacute;rum adminisztr&aacute;ci&oacute;';

$lang['Board_disable'] = 'A f&oacute;rum ideiglenesen sz&uuml;netel, k&eacute;rem pr&oacute;b&aacute;lkozzon k&eacute;s&otilde;bb.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Regisztr&aacute;lt felhaszn&aacute;l&oacute;k:';
$lang['Browsing_forum'] = 'Jelenl&eacute;v&otilde; f&oacute;rumoz&oacute;k:';
$lang['Online_users_zero_total'] = '&Ouml;sszesen <span class="thick">0</span> felhaszn&aacute;l&oacute; van jelen :: ';
$lang['Online_users_total'] = 'Jelenleg <span class="thick">%d</span> felhaszn&aacute;l&oacute; van itt :: ';
$lang['Online_user_total'] = 'Jelenleg <span class="thick">%d</span> felhaszn&aacute;l&oacute; van itt :: ';
$lang['Reg_users_zero_total'] = '0 regisztr&aacute;lt, ';
$lang['Reg_users_total'] = '%d regisztr&aacute;lt, ';
$lang['Reg_user_total'] = '%d regisztr&aacute;lt, ';
$lang['Hidden_users_zero_total'] = '0 rejtett &eacute;s ';
$lang['Hidden_user_total'] = '%d rejtett &eacute;s ';
$lang['Hidden_users_total'] = '%d rejtett &eacute;s ';
$lang['Guest_users_zero_total'] = '0 vend&eacute;g';
$lang['Guest_users_total'] = '%d vend&eacute;g';
$lang['Guest_user_total'] = '%d vend&eacute;g';
$lang['Record_online_users'] = 'A legt&ouml;bb felhaszn&aacute;l&oacute; (<span class="thick">%s</span> f&otilde;) %s-kor volt itt.'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdminisztr&aacute;tor%s';
$lang['Mod_online_color'] = '%sModer&aacute;tor%s';

$lang['You_last_visit'] = 'Legutols&oacute; l&aacute;togat&aacute;s&aacute;nak d&aacute;tuma: %s'; // %s replaced by date/time
$lang['Current_time'] = 'Pontos id&otilde;: %s'; // %s replaced by time

$lang['Search_new'] = 'Hozz&aacute;sz&oacute;l&aacute;sok a legutols&oacute; l&aacute;togat&aacute;s &oacute;ta';
$lang['Search_your_posts'] = '&Uuml;zenetei megtekint&eacute;se';
$lang['Search_unanswered'] = 'Megv&aacute;laszolatlan &uuml;zenetek megtekint&eacute;se';

$lang['Register'] = 'Regisztr&aacute;ci&oacute;';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Profil szerkeszt&eacute;se';
$lang['Search'] = 'Keres&eacute;s';
$lang['Memberlist'] = 'Taglista';
$lang['FAQ'] = 'Gy.I.K.';
$lang['BBCode_guide'] = 'BBCode kalauz';
$lang['Usergroups'] = 'Csoportok';
$lang['Last_Post'] = 'Legutols&oacute; &uuml;zenet';
$lang['Moderator'] = 'Moder&aacute;tor';
$lang['Moderators'] = 'Moder&aacute;torok';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Jelenleg &ouml;sszesen <span class="thick">0</span> hozz&aacute;sz&oacute;l&aacute;s olvashat&oacute;.'; // Number of posts
$lang['Posted_articles_total'] = 'Jelenleg &ouml;sszesen <span class="thick">%d</span> hozz&aacute;sz&oacute;l&aacute;s olvashat&oacute;.'; // Number of posts
$lang['Posted_article_total'] = 'Eddig &ouml;sszesen <span class="thick">%d</span> hozz&aacute;sz&oacute;l&aacute;s olvashat&oacute;.'; // Number of posts
$lang['Registered_users_zero_total'] = '&Ouml;sszesen <span class="thick">0</span> regisztr&aacute;lt felhaszn&aacute;l&oacute;nk van.'; // # registered users
$lang['Registered_users_total'] = '&Ouml;sszesen <span class="thick">%d</span> regisztr&aacute;lt felhaszn&aacute;l&oacute;nk van.'; // # registered users
$lang['Registered_user_total'] = '&Ouml;sszesen <span class="thick">%d</span> regisztr&aacute;lt felhaszn&aacute;l&oacute;nk van.'; // # registered users
$lang['Newest_user'] = 'Leg&uacute;jabb regisztr&aacute;lt tagunk: <span class="thick">%s%s%s</span>'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Nincsen &uacute;j hozz&aacute;sz&oacute;l&aacute;s a legutols&oacute; l&aacute;togat&aacute;sa &oacute;ta.';
$lang['No_new_posts'] = 'Nincsenek &uacute;j hozz&aacute;sz&oacute;l&aacute;sok';
$lang['New_posts'] = '&Uacute;j hozz&aacute;sz&oacute;l&aacute;sok';
$lang['New_post'] = '&Uacute;j hozz&aacute;sz&oacute;l&aacute;s';
$lang['No_new_posts_hot'] = 'Nincsenek &uacute;j hozz&aacute;sz&oacute;l&aacute;sok [ N&eacute;pszer&ucirc; ]';
$lang['New_posts_hot'] = '&Uacute;j hozz&aacute;sz&oacute;l&aacute;sok [ N&eacute;pszer&ucirc; ]';
$lang['No_new_posts_locked'] = 'Nincsenek &uacute;j hozz&aacute;sz&oacute;l&aacute;sok [ Lez&aacute;rt ]';
$lang['New_posts_locked'] = '&Uacute;j hozz&aacute;sz&oacute;l&aacute;sok [ Lez&aacute;rt ]';
$lang['Forum_is_locked'] = 'Lez&aacute;rt f&oacute;rum';


//
// Login
//
$lang['Enter_password'] = 'A bel&eacute;p&eacute;shez adja meg a felhaszn&aacute;l&oacute;nev&eacute;t &eacute;s jelszav&aacute;t.';
$lang['Login'] = 'Bel&eacute;p&eacute;s';
$lang['Logout'] = 'Kil&eacute;p&eacute;s';

$lang['Forgotten_password'] = 'Elfelejtettem a jelsz&oacute;t!';

$lang['Log_me_in'] = 'Automatikus bejelentkez&eacute;s';

$lang['Error_login'] = 'Hib&aacute;s, vagy inakt&iacute;v felhaszn&aacute;l&oacute;nevet &eacute;s/vagy hib&aacute;s jelsz&oacute;t adott meg!';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Nincs hozz&aacute;sz&oacute;l&aacute;s.';
$lang['No_forums'] = 'Nincsenek f&oacute;rumok.';

$lang['Private_Message'] = 'Priv&aacute;t &uuml;zenet';
$lang['Private_Messages'] = 'Priv&aacute;t &uuml;zenetek';
$lang['Who_is_Online'] = 'Ki van itt?';

$lang['Mark_all_forums'] = '&Ouml;sszes f&oacute;rum megjel&ouml;l&eacute;se olvasottk&eacute;nt';
$lang['Forums_marked_read'] = '&Ouml;sszes f&oacute;rum megjel&ouml;lve olvasottk&eacute;nt.';


//
// Viewforum
//
$lang['View_forum'] = 'F&oacute;rum megtekint&eacute;se';

$lang['Forum_not_exist'] = 'A kiv&aacute;lsztott f&oacute;rum nem l&eacute;tezik.';
$lang['Reached_on_error'] = 'Hiba.';

$lang['Display_topics'] = '&Ouml;sszes t&eacute;ma mutat&aacute;sa';
$lang['All_Topics'] = '&Ouml;sszes t&eacute;ma';

$lang['Topic_Announcement'] = '<span class="thick">K&ouml;zlem&eacute;ny:</span>';
$lang['Topic_Sticky'] = '<span class="thick">Kiemelt:</span>';
$lang['Topic_Moved'] = '<span class="thick">&Aacute;rny&eacute;k:</span>';
$lang['Topic_Poll'] = '<span class="thick">[ Szavaz&aacute;s ]</span>';

$lang['Mark_all_topics'] = '&Ouml;sszes t&eacute;ma megjel&ouml;l&eacute;se olvasottk&eacute;nt';
$lang['Topics_marked_read'] = '&Ouml;sszes t&eacute;ma megjel&ouml;lve olvasottk&eacute;nt.';

$lang['Rules_post_can'] = '<span class="thick">K&eacute;sz&iacute;thet</span> &uacute;j t&eacute;m&aacute;kat ebben a f&oacute;rumban.';
$lang['Rules_post_cannot'] = '<span class="thick">Nem</span> k&eacute;sz&iacute;thet &uacute;j t&eacute;m&aacute;kat ebben a f&oacute;rumban.';
$lang['Rules_reply_can'] = '<span class="thick">V&aacute;laszolhat</span> egy t&eacute;m&aacute;ra ebben a f&oacute;rumban.';
$lang['Rules_reply_cannot'] = '<span class="thick">Nem</span> v&aacute;laszolhat egy t&eacute;m&aacute;ra ebben a f&oacute;rumban.';
$lang['Rules_edit_can'] = '<span class="thick">M&oacute;dos&iacute;thatja</span> a hozz&aacute;sz&oacute;l&aacute;sait a f&oacute;rumban.';
$lang['Rules_edit_cannot'] = '<span class="thick">Nem</span> m&oacute;dos&iacute;thatja a hozz&aacute;sz&oacute;l&aacute;sait a f&oacute;rumban.';
$lang['Rules_delete_can'] = '<span class="thick">T&ouml;r&ouml;lheti</span> a hozz&aacute;sz&oacute;l&aacute;sait a f&oacute;rumban.';
$lang['Rules_delete_cannot'] = '<span class="thick">Nem</span> t&ouml;r&ouml;lheti a hozz&aacute;sz&oacute;l&aacute;sait a f&oacute;rumban.';
$lang['Rules_vote_can'] = '<span class="thick">Szavazhat</span> ebben a f&oacute;rumban.';
$lang['Rules_vote_cannot'] = '<span class="thick">Nem</span> szavazhat ebben f&oacute;rumban.';
$lang['Rules_moderate'] = '<span class="thick">%sModer&aacute;lhatja%s</span> ezt a f&oacute;rumot.'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'Nincsenek t&eacute;m&aacute;k a f&oacute;rumban.<br />Kattintson az <span class="thick">&Uacute;j t&eacute;ma k&eacute;sz&iacute;t&eacute;s&eacute;re</span>.';


//
// Viewtopic
//
$lang['View_topic'] = 'T&eacute;ma megtekint&eacute;se';

$lang['Guest'] = 'Vend&eacute;g';
$lang['Post_subject'] = 'Hozz&aacute;sz&oacute;l&aacute;s t&eacute;m&aacute;ja';
$lang['View_next_topic'] = 'K&ouml;vetkez&otilde; t&eacute;ma megtekint&eacute;se';
$lang['View_previous_topic'] = 'El&otilde;z&otilde; t&eacute;ma megtekint&eacute;se';
$lang['Submit_vote'] = 'Szavaz&aacute;s k&uuml;ld&eacute;se';
$lang['View_results'] = 'Eredm&eacute;ny megtekint&eacute;se';

$lang['No_newer_topics'] = 'Nincsenek &uacute;jabb t&eacute;m&aacute;k a f&oacute;rumban.';
$lang['No_older_topics'] = 'Nincsenek r&eacute;gbbi t&eacute;m&aacute;k a f&oacute;rumban.';
$lang['Topic_post_not_exist'] = 'A t&eacute;ma vagy hozz&aacute;sz&oacute;l&aacute;s nem l&eacute;tezik.';
$lang['No_posts_topic'] = 'Nincs hozz&aacute;sz&oacute;l&aacute;s a t&eacute;m&aacute;ban.';

$lang['Display_posts'] = 'Hozz&aacute;sz&oacute;l&aacute;sok megtekint&eacute;se';
$lang['All_Posts'] = '&Ouml;sszes';
$lang['Newest_First'] = '&Uacute;jak el&otilde;re';
$lang['Oldest_First'] = 'R&eacute;gebbiek el&otilde;re';

$lang['Back_to_top'] = 'Vissza az elej&eacute;re';

$lang['Read_profile'] = 'Felhaszn&aacute;l&oacute; profilj&aacute;nak megtekint&eacute;se';
$lang['Visit_website'] = 'Felhaszn&aacute;l&oacute; weblapj&aacute;nak megtekint&eacute;se';
$lang['ICQ_status'] = 'ICQ st&aacute;tusz';
$lang['Edit_delete_post'] = 'Hozz&aacute;sz&oacute;l&aacute;s szerkeszt&eacute;se/t&ouml;rl&eacute;se';
$lang['View_IP'] = 'Felhaszn&aacute;l&oacute; IP-c&iacute;me';
$lang['Delete_post'] = 'Hozz&aacute;sz&oacute;l&aacute;s t&ouml;rl&eacute;se';

$lang['wrote'] = '&iacute;rta'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Id&eacute;zet'; // comes before bbcode quote output.
$lang['Code'] = 'K&oacute;d'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'A hozz&aacute;sz&oacute;l&aacute;st %1$s &ouml;sszesen %3$d alkalommal szerkesztette, legut&oacute;bb %2$s-kor.';
$lang['Edited_times_total'] = 'A hozz&aacute;sz&oacute;l&aacute;st %1$s &ouml;sszesen %3$d alkalommal szerkesztette, legut&oacute;bb %2$s-kor.';

$lang['Lock_topic'] = 'T&eacute;ma lez&aacute;r&aacute;sa';
$lang['Unlock_topic'] = 'T&eacute;ma megnyit&aacute;sa';
$lang['Move_topic'] = 'T&eacute;ma &aacute;thelyez&eacute;se';
$lang['Delete_topic'] = 'T&eacute;ma t&ouml;rl&eacute;se';
$lang['Split_topic'] = 'T&eacute;ma sz&eacute;tv&aacute;laszt&aacute;sa';

$lang['Stop_watching_topic'] = 'Leiratkoz&aacute;s a t&eacute;m&aacute;r&oacute;l';
$lang['Start_watching_topic'] = 'Feliratkoz&aacute;s a t&eacute;m&aacute;ra';
$lang['No_longer_watching'] = 'T&eacute;ma figyel&eacute;se megsz&uuml;ntetve!';
$lang['You_are_watching'] = 'Feliratkozott a t&eacute;m&aacute;ra.';

$lang['Total_votes'] = '&Ouml;sszes szavazat';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = '&Uuml;zenet tartalma';
$lang['Topic_review'] = 'T&eacute;ma el&otilde;n&eacute;zet';

$lang['No_post_mode'] = 'Nincs hozz&aacute;sz&oacute;l&aacute;s-t&iacute;pus kiv&aacute;lasztva.'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = '&Uacute;j t&eacute;ma k&uuml;ld&eacute;se';
$lang['Post_a_reply'] = '&Uacute;j v&aacute;lasz k&uuml;ld&eacute;se';
$lang['Post_topic_as'] = 'T&eacute;ma k&uuml;ld&eacute;se, mint';
$lang['Edit_Post'] = 'Hozz&aacute;sz&oacute;l&aacute;s szerkeszt&eacute;se';
$lang['Options'] = 'Be&aacute;ll&iacute;t&aacute;sok';

$lang['Post_Announcement'] = 'K&ouml;zlem&eacute;ny';
$lang['Post_Sticky'] = 'Kiemelt';
$lang['Post_Normal'] = 'Sima';

$lang['Confirm_delete'] = 'Biztosan t&ouml;r&ouml;lni akarja a hozz&aacute;sz&oacute;l&aacute;st?';
$lang['Confirm_delete_poll'] = 'Biztosan t&ouml;r&ouml;lni akarja a szavaz&aacute;st?';

$lang['Flood_Error'] = 'Nem k&uuml;ldhet r&ouml;vid id&otilde;n bel&uuml;l t&ouml;bb hozz&aacute;sz&oacute;l&aacute;st, v&aacute;rjon egy kicsit.';
$lang['Empty_subject'] = '&Uacute;j t&eacute;ma ind&iacute;t&aacute;sakor adja meg a c&iacute;m&eacute;t.';
$lang['Empty_message'] = 'Nem k&uuml;ldhet &uuml;res hozz&aacute;sz&oacute;l&aacute;st.';
$lang['Forum_locked'] = 'Lez&aacute;rt f&oacute;rum: ide nem k&uuml;ldhet t&eacute;m&aacute;t, v&aacute;laszt, nem szerkesztheti a hozz&aacute;sz&oacute;l&aacute;sait.';
$lang['Topic_locked'] = 'Lez&aacute;rt t&eacute;ma: ide nem &iacute;rhat v&aacute;laszt, &eacute;s nem szerkesztheti a hozz&aacute;sz&oacute;l&aacute;sait.';
$lang['No_post_id'] = 'A szerkeszt&eacute;shez v&aacute;lasszon ki egy hozz&aacute;sz&oacute;l&aacute;st.';
$lang['No_topic_id'] = 'V&aacute;lasz&uuml;zenet k&uuml;ld&eacute;s&eacute;hez v&aacute;lasszon ki egy t&eacute;m&aacute;t.';
$lang['No_valid_mode'] = 'Csak k&uuml;ldhet, szerkeszthet, vagy id&eacute;zhet hozz&aacute;sz&oacute;l&aacute;st. L&eacute;pjen vissza, &eacute;s pr&oacute;b&aacute;lja &uacute;jra.';
$lang['No_such_post'] = 'Nincsen ilyen hozz&aacute;sz&oacute;l&aacute;s. L&eacute;pjen vissza, &eacute;s pr&oacute;b&aacute;lja &uacute;jra.';
$lang['Edit_own_posts'] = 'Csak szerkesztheti a hozz&aacute;sz&oacute;l&aacute;sait.';
$lang['Delete_own_posts'] = 'Csak t&ouml;r&ouml;lheti a hozz&aacute;sz&oacute;l&aacute;sait.';
$lang['Cannot_delete_replied'] = 'Nem t&ouml;r&ouml;lheti a hozz&aacute;sz&oacute;l&aacute;st, melyre m&aacute;r &eacute;rkezett v&aacute;lasz.';
$lang['Cannot_delete_poll'] = 'Nem t&ouml;r&ouml;lhet akt&iacute;v szavaz&aacute;st.';
$lang['Empty_poll_title'] = 'Adjon meg egy c&iacute;met a szavaz&aacute;snak.';
$lang['To_few_poll_options'] = 'Legal&aacute;bb k&eacute;t v&aacute;laszt&aacute;si lehet&otilde;s&eacute;get adjon meg.';
$lang['To_many_poll_options'] = 'T&uacute;l sok v&aacute;laszt&aacute;si lehet&otilde;s&eacute;get adott meg.';
$lang['Post_has_no_poll'] = 'A hozz&aacute;sz&oacute;l&aacute;shoz nem tartozik szavaz&aacute;s.';
$lang['Already_voted'] = 'Egyszer m&aacute;r szavazott.';
$lang['No_vote_option'] = 'V&aacute;lasszon egy lehet&otilde;s&eacute;get a szavaz&aacute;sn&aacute;l.';

$lang['Add_poll'] = 'Szavaz&aacute;s hozz&aacute;ad&aacute;sa';
$lang['Add_poll_explain'] = 'Ha nem akar szavaz&aacute;st adni a t&eacute;m&aacute;hoz, hagyja &uuml;resen a mez&otilde;ket.';
$lang['Poll_question'] = 'A szavaz&aacute;s k&eacute;rd&eacute;se';
$lang['Poll_option'] = 'V&aacute;laszt&aacute;si lehet&otilde;s&eacute;g';
$lang['Add_option'] = 'Hozz&aacute;ad&aacute;s';
$lang['Update'] = 'Friss&iacute;t&eacute;s';
$lang['Delete'] = 'T&ouml;rl&eacute;s';
$lang['Poll_for'] = 'A szavaz&aacute;s &eacute;rv&eacute;nyes';
$lang['Days'] = 'nap'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Hagyja &uuml;resen, ha soha sem j&aacute;r le a szavaz&aacute;s. ]';
$lang['Delete_poll'] = 'Szavaz&aacute;s t&ouml;rl&eacute;se';

$lang['Disable_HTML_post'] = 'HTML kikapcsol&aacute;sa a hozz&aacute;sz&oacute;l&aacute;sban';
$lang['Disable_BBCode_post'] = 'BBCode kikapcsol&aacute;sa a hozz&aacute;sz&oacute;l&aacute;sban';
$lang['Disable_Smilies_post'] = 'Emotikonok kikapcsol&aacute;sa a hozz&aacute;sz&oacute;l&aacute;sban';

$lang['HTML_is_ON'] = 'HTML <span class="underline">bekapcsolva</span>';
$lang['HTML_is_OFF'] = 'HTML <span class="underline">kikapcsolva</span>';
$lang['BBCode_is_ON'] = '%sBBCode%s <span class="underline">bekapcsolva</span>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s <span class="underline">kikapcsolva</span>';
$lang['Smilies_are_ON'] = 'Emotikonok <span class="underline">bekapcsolva</span>';
$lang['Smilies_are_OFF'] = 'Emotikonok <span class="underline">kikapcsolva</span>';

$lang['Attach_signature'] = 'Al&aacute;&iacute;r&aacute;s hozz&aacute;ad&aacute;sa (az al&aacute;&iacute;r&aacute;s megv&aacute;ltoztathat&oacute; a profilban)';
$lang['Notify'] = '&Eacute;rtes&iacute;t&eacute;s, ha v&aacute;lasz &eacute;rkezik';

$lang['Stored'] = 'A hozz&aacute;sz&oacute;l&aacute;s sikeresen beker&uuml;lt a f&oacute;rumba!';
$lang['Deleted'] = 'A hozz&aacute;sz&oacute;l&aacute;s t&ouml;rl&eacute;se siker&uuml;lt.';
$lang['Poll_delete'] = 'A szavaz&aacute;s t&ouml;rl&eacute;se siker&uuml;lt.';
$lang['Vote_cast'] = 'Szavaz&aacute;s elfogadva.';

$lang['Topic_reply_notification'] = 'T&eacute;ma eml&eacute;keztet&otilde;';

$lang['bbcode_b_help'] = 'F&eacute;lk&ouml;v&eacute;r: [b]sz&ouml;veg[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'D&otilde;lt: [i]sz&ouml;veg[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Al&aacute;h&uacute;z&aacute;s: [u]sz&ouml;veg[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Id&eacute;zet: [quote]sz&ouml;veg[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'K&oacute;d: [code]k&oacute;d[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'Lista: [list]sz&ouml;veg[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Rendezett lista: [list=]sz&ouml;veg[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'K&eacute;p beilleszt&eacute;se: [img]http://k&eacute;p_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'Link beilleszt&eacute;se: [url]http://link[/url]vagy[url=http://url]link sz&ouml;veg[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Nyitott BBCode tag-ek lez&aacute;r&aacute;sa';
$lang['bbcode_s_help'] = 'Bet&ucirc;sz&iacute;n: [color=red]sz&ouml;veg[/color] \(a \"color=#FF0000 is haszn&aacute;lhat&oacute;\)';
$lang['bbcode_f_help'] = 'Bet&ucirc;m&eacute;ret: [size=x-small]kis sz&ouml;veg[/size]';

$lang['Emoticons'] = 'Emotikonok';
$lang['More_emoticons'] = 'A t&ouml;bbi emotikon megtekint&eacute;se';

$lang['Font_color'] = 'Bet&ucirc;sz&iacute;n';
$lang['color_default'] = 'Alap';
$lang['color_dark_red'] = 'S&ouml;t&eacute;tpiros';
$lang['color_red'] = 'Piros';
$lang['color_orange'] = 'Narancs';
$lang['color_brown'] = 'Barna';
$lang['color_yellow'] = 'S&aacute;rga';
$lang['color_green'] = 'Z&ouml;ld';
$lang['color_olive'] = 'Ol&iacute;va';
$lang['color_cyan'] = 'Ci&aacute;n';
$lang['color_blue'] = 'K&eacute;k';
$lang['color_dark_blue'] = 'S&ouml;t&eacute;tk&eacute;k';
$lang['color_indigo'] = 'Indig&oacute;';
$lang['color_violet'] = 'Ibolya';
$lang['color_white'] = 'Feh&eacute;r';
$lang['color_black'] = 'Fekete';

$lang['Font_size'] = 'Bet&ucirc;m&eacute;ret';
$lang['font_tiny'] = 'Apr&oacute;';
$lang['font_small'] = 'Kicsi';
$lang['font_normal'] = 'Norm&aacute;l';
$lang['font_large'] = 'Nagy';
$lang['font_huge'] = '&Oacute;ri&aacute;si';

$lang['Close_Tags'] = 'Tag-ek lez&aacute;r&aacute;sa';
$lang['Styles_tip'] = 'Tipp: st&iacute;lusok gyors alkalmaz&aacute;sa az adott sz&ouml;vegen.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Priv&aacute;t &uuml;zenetek';

$lang['Login_check_pm'] = 'Priv&aacute;t &uuml;zenetei olvas&aacute;s&aacute;hoz be kell jelentkeznie';
$lang['New_pms'] = '%d &uacute;j priv&aacute;t &uuml;zenete van'; // You have 2 new messages
$lang['New_pm'] = '%d &uacute;j priv&aacute;t &uuml;zenete van'; // You have 1 new message
$lang['No_new_pm'] = 'Nincsen &uacute;j priv&aacute;t &uuml;zenete';
$lang['Unread_pms'] = '%d olvasatlan priv&aacute;t &uuml;zenete van.';
$lang['Unread_pm'] = '%d olvasatlan priv&aacute;t &uuml;zenete van.';
$lang['No_unread_pm'] = 'Nincsen olvasatlan priv&aacute;t &uuml;zenete.';
$lang['You_new_pm'] = '&Uacute;j priv&aacute;t &uuml;zenet &eacute;rkezett!';
$lang['You_new_pms'] = '&Uacute;j priv&aacute;t &uuml;zenetek &eacute;rkeztek!';
$lang['You_no_new_pm'] = 'Nincs &uacute;j priv&aacute;t &uuml;zenet.';

$lang['Unread_message'] = 'Olvasatlan &uuml;zenetek';
$lang['Read_message'] = 'Olvasott &uuml;zenetek';

$lang['Read_pm'] = '&Uuml;zenet olvas&aacute;sa';
$lang['Post_new_pm'] = '&Uuml;zenet k&uuml;ld&eacute;se';
$lang['Post_reply_pm'] = 'V&aacute;lasz az &uuml;zenetre';
$lang['Post_quote_pm'] = '&Uuml;zenet id&eacute;z&eacute;se';
$lang['Edit_pm'] = '&Uuml;zenet szerkeszt&eacute;se';

$lang['Inbox'] = '&Eacute;rkezett fi&oacute;k';
$lang['Outbox'] = 'Kimen&otilde; fi&oacute;k';
$lang['Savebox'] = 'Ment&eacute;s fi&oacute;k';
$lang['Sentbox'] = 'Elk&uuml;ld&ouml;tt fi&oacute;k';
$lang['Flag'] = 'Jel&ouml;l&eacute;s';
$lang['Subject'] = 'T&eacute;ma';
$lang['From'] = 'Felad&oacute;';
$lang['To'] = 'C&iacute;mzett';
$lang['Date'] = 'D&aacute;tum';
$lang['Mark'] = 'Kijel&ouml;l&eacute;s';
$lang['Sent'] = 'Elk&uuml;ld&ouml;tt';
$lang['Saved'] = 'Elmentett';
$lang['Delete_marked'] = 'Kijel&ouml;ltek t&ouml;rl&eacute;se';
$lang['Delete_all'] = '&Ouml;sszes t&ouml;rl&eacute;se';
$lang['Save_marked'] = 'Kijel&ouml;ltek ment&eacute;se';
$lang['Save_message'] = '&Uuml;zenet ment&eacute;se';
$lang['Delete_message'] = '&Uuml;zenet t&ouml;rl&eacute;se';

$lang['Display_messages'] = '&Uuml;zenetek megjelen&iacute;t&eacute;se'; // Followed by number of days/weeks/months
$lang['All_Messages'] = '&Ouml;sszes &uuml;zenet';

$lang['No_messages_folder'] = 'Nincs &uuml;zenete ebben a fi&oacute;kban.';

$lang['PM_disabled'] = 'Nincs lehet&otilde;s&eacute;g priv&aacute;t &uuml;zenet k&uuml;ld&eacute;s&eacute;re.';
$lang['Cannot_send_privmsg'] = 'Sajnos nem k&uuml;ldhet priv&aacute;t &uuml;zeneteket. L&eacute;pjen kapcsolatba az Adminisztr&aacute;torral.';
$lang['No_to_user'] = 'Az &uuml;zenet k&uuml;ld&eacute;s&eacute;hez meg kell adnia a c&iacute;mzettet.';
$lang['No_such_user'] = 'Ilyen nev&ucirc; felhaszn&aacute;l&oacute; nem l&eacute;tezik.';

$lang['Disable_HTML_pm'] = 'HTML kikapcsol&aacute;sa az &uuml;zenetben';
$lang['Disable_BBCode_pm'] = 'BBCode kikapcsol&aacute;sa az &uuml;zenetben';
$lang['Disable_Smilies_pm'] = 'Emotikonok kikapcsol&aacute;sa az &uuml;zenetben';

$lang['Message_sent'] = '&Uuml;zenet elk&uuml;ldve.';

$lang['Click_return_inbox'] = 'Kattintson %side%s, hogy visszat&eacute;rjen az &Eacute;rkezett &uuml;zenetekhez.';
$lang['Click_return_index'] = 'Kattintson %side%s, hogy visszat&eacute;rjen a Tartalomjegyz&eacute;khez.';

$lang['Send_a_new_message'] = '&Uacute;j priv&aacute;t &uuml;zenet k&uuml;ld&eacute;se';
$lang['Send_a_reply'] = 'V&aacute;lasz a priv&aacute;t &uuml;zenetre';
$lang['Edit_message'] = 'Priv&aacute;t &uuml;zenet szerkeszt&eacute;se';

$lang['Notification_subject'] = '&Uacute;j priv&aacute;t &uuml;zenet &eacute;rkezett!';

$lang['Find_username'] = 'Felhaszn&aacute;l&oacute;n&eacute;v keres&eacute;se';
$lang['Find'] = 'Tal&aacute;lat';
$lang['No_match'] = 'Nincs tal&aacute;lat.';

$lang['No_post_id'] = 'Nincs hozz&aacute;sz&oacute;l&aacute;s azonos&iacute;t&oacute; meghat&aacute;rozva.';
$lang['No_such_folder'] = 'Nem l&eacute;tezik ilyen fi&oacute;k.';
$lang['No_folder'] = 'Nincs fi&oacute;k meghat&aacute;rozva.';

$lang['Mark_all'] = '&Ouml;sszes kijel&ouml;l&eacute;se';
$lang['Unmark_all'] = '&Ouml;sszes kijel&ouml;l&eacute;s&eacute;nek megsz&uuml;ntet&eacute;se';

$lang['Confirm_delete_pm'] = 'Biztosan t&ouml;r&ouml;lni akarja az &uuml;zenetet?';
$lang['Confirm_delete_pms'] = 'Biztosan t&ouml;r&ouml;lni akarja az &uuml;zeneteket?';

$lang['Inbox_size'] = 'Az &Eacute;rkezett fi&oacute;k %d%%-a telt meg.'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Az Elk&uuml;ld&ouml;tt fi&oacute;k %d%%-a telt meg.';
$lang['Savebox_size'] = 'A Ment&eacute;s fi&oacute;k %d%%-a telt meg.';

$lang['Click_view_privmsg'] = 'Kattintson %side%s az &Eacute;rkezett fi&oacute;kja megtekint&eacute;s&eacute;hez.';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profil megtekint&eacute;se :: %s'; // %s is username
$lang['About_user'] = '%s adatlapja'; // %s is username

$lang['Preferences'] = 'Be&aacute;ll&iacute;t&aacute;sok';
$lang['Items_required'] = 'A csillaggal megjel&ouml;lt mez&otilde;k kit&ouml;lt&eacute;se k&ouml;telez&otilde;.';
$lang['Registration_info'] = 'Regisztr&aacute;ci&oacute; inform&aacute;ci&oacute;';
$lang['Profile_info'] = 'Profil inform&aacute;ci&oacute;';
$lang['Profile_info_warn'] = 'Ezek az inform&aacute;ci&oacute;k mindenki sz&aacute;m&aacute;ra l&aacute;that&oacute;ak lesznek.';
$lang['Avatar_panel'] = 'Avatar be&aacute;ll&iacute;t&aacute;s';
$lang['Avatar_gallery'] = 'Avatar gal&eacute;ria';

$lang['Website'] = 'Honlap';
$lang['Location'] = 'Tart&oacute;zkod&aacute;si hely';
$lang['Contact'] = 'Kapcsolat: ';
$lang['Email_address'] = 'Email c&iacute;m';
$lang['Send_private_message'] = 'Priv&aacute;t &uuml;zenet k&uuml;ld&eacute;se';
$lang['Hidden_email'] = '[ Rejtett ]';
$lang['Interests'] = '&Eacute;rdekl&otilde;d&eacute;si k&ouml;r';
$lang['Occupation'] = 'Foglalkoz&aacute;s';
$lang['Poster_rank'] = 'Rang';

$lang['Total_posts'] = '&Ouml;sszes hozz&aacute;sz&oacute;l&aacute;sa';
$lang['User_post_pct_stats'] = 'Az &ouml;sszes %.2f%%-ka'; // 1.25% of total
$lang['User_post_day_stats'] = 'Naponta %.2f hozz&aacute;sz&oacute;l&aacute;s'; // 1.5 posts per day
$lang['Search_user_posts'] = '%s hozz&aacute;sz&oacute;l&aacute;sainak keres&eacute;se'; // Find all posts by username

$lang['No_user_id_specified'] = 'A felhaszn&aacute;l&oacute; nem l&eacute;tezik.';
$lang['Wrong_Profile'] = 'Nem m&oacute;dos&iacute;thatja m&aacute;s profilj&aacute;t.';

$lang['Only_one_avatar'] = 'Csak egy avatart v&aacute;lasszon ki.';
$lang['File_no_data'] = 'A megadott webc&iacute;m nem tartalmaz adatot!';
$lang['No_connection_URL'] = 'A megadott webc&iacute;mhez nem lehet csatlakozni!';
$lang['Incomplete_URL'] = 'A megadott webc&iacute;m hi&aacute;nyos.';
$lang['Wrong_remote_avatar_format'] = 'A t&aacute;voli avatar webc&iacute;me nem &eacute;rv&eacute;nyes.';
$lang['No_send_account_inactive'] = 'A jelsz&oacute; sajnos nem k&eacute;rhet&otilde; le, mivel a felhaszn&aacute;l&oacute;n&eacute;v jelenleg inakt&iacute;v. L&eacute;pjen kapcsolatba az Adminisztr&aacute;torral.';

$lang['Always_smile'] = 'Mindig enged&eacute;lyezze a emotikonokat';
$lang['Always_html'] = 'Mindig enged&eacute;lyezze a HTML-t';
$lang['Always_bbcode'] = 'Mindig enged&eacute;lyezze a BBCode-ot';
$lang['Always_add_sig'] = 'Mindig csatolja az al&aacute;&iacute;r&aacute;somat';
$lang['Always_notify'] = 'Mindig &eacute;rtes&iacute;tsen, ha v&aacute;lasz &eacute;rkezik';
$lang['Always_notify_explain'] = 'K&uuml;ld egy emailt, ha hozz&aacute;sz&oacute;l&aacute;s &eacute;rkezik az adott t&eacute;m&aacute;ban. Ez b&aacute;rmikor megv&aacute;ltoztathat&oacute;, ha egy &uacute;jabb hozz&aacute;sz&oacute;l&aacute;st k&uuml;ld.';

$lang['Board_style'] = 'Sablon';
$lang['Board_lang'] = 'Nyelv';
$lang['No_themes'] = 'Nincsenek sablonok az adatb&aacute;zisban.';
$lang['Timezone'] = 'Id&otilde;z&oacute;na';
$lang['Date_format'] = 'D&aacute;tum form&aacute;tum';
$lang['Date_format_explain'] = 'A PHP <a href=\'http://hu.php.net/manual/hu/function.date.php#AEN22851\' target=\'_blank\'>date()</a> f&uuml;ggv&eacute;nye szerint haszn&aacute;land&oacute;.';
$lang['Signature'] = 'Al&aacute;&iacute;r&aacute;s';
$lang['Signature_explain'] = 'A hozz&aacute;sz&oacute;l&aacute;sok v&eacute;g&eacute;re ker&uuml;l&otilde; sz&ouml;veg. Legfeljebb %d karakter lehet.';
$lang['Public_view_email'] = 'Email-c&iacute;m megjelen&iacute;t&eacute;se';

$lang['Current_password'] = 'Jelenlegi jelsz&oacute;';
$lang['New_password'] = '&Uacute;j jelsz&oacute;';
$lang['Confirm_password'] = 'Jelsz&oacute; megism&eacute;tl&eacute;se';
$lang['Confirm_password_explain'] = 'Ha meg szeretn&eacute; v&aacute;ltoztatni a jelszav&aacute;t, vagy az email c&iacute;m&eacute;t, meg kell adnia a jelenlegi jelszav&aacute;t.';
$lang['password_if_changed'] = 'Csak akkor kell megadnia a jelsz&oacute;t, ha meg akarja v&aacute;ltoztatni.';
$lang['password_confirm_if_changed'] = 'A fenti jelsz&oacute; &eacute;rv&eacute;nyes&iacute;t&eacute;s&eacute;hez sz&uuml;ks&eacute;ges.';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Egy k&eacute;p, mely a hozz&aacute;sz&oacute;l&aacute;sokban a neved&eacute;n&eacute;l lesz l&aacute;that&oacute;.<br />Az avatar nem lehet sz&eacute;lesebb, mint %d pixel, &eacute;s nem lehet magasabb, mint %d pixel. A m&eacute;rete nem lehet nagyobb, mint %d KByte.';
$lang['Upload_Avatar_file'] = 'Avatar felt&ouml;lt&eacute;se a sz&aacute;m&iacute;t&oacute;g&eacute;pr&otilde;l';
$lang['Upload_Avatar_URL'] = 'Avatar felt&ouml;lt&eacute;se webc&iacute;mr&otilde;l';
$lang['Upload_Avatar_URL_explain'] = '&Iacute;rja be az avatar k&eacute;p&eacute;nek webc&iacute;m&eacute;t (a k&eacute;p &aacute;t lesz m&aacute;solva erre az oldalra).';
$lang['Pick_local_Avatar'] = 'Avatar kiv&aacute;laszt&aacute;sa a gal&eacute;ri&aacute;b&oacute;l';
$lang['Link_remote_Avatar'] = 'Avatar k&eacute;p belinkel&eacute;se';
$lang['Link_remote_Avatar_explain'] = '&Iacute;rja be az Avatar k&eacute;p&eacute;nek webc&iacute;m&eacute;t, amelyet be szeretne linkelni (a k&eacute;p nem lesz &aacute;tm&aacute;solva erre az oldalra).';
$lang['Avatar_URL'] = 'Avatar k&eacute;p&eacute;nek webc&iacute;me';
$lang['Select_from_gallery'] = 'Avatar kiv&aacute;laszt&aacute;sa a gal&eacute;ri&aacute;b&oacute;l';
$lang['View_avatar_gallery'] = 'Gal&eacute;ria megtekint&eacute;se';

$lang['Select_avatar'] = 'Avatar kiv&aacute;laszt&aacute;sa';
$lang['Return_profile'] = 'M&eacute;gsem';
$lang['Select_category'] = 'Kateg&oacute;ria kiv&aacute;laszt&aacute;sa';

$lang['Delete_Image'] = 'K&eacute;p t&ouml;rl&eacute;se';
$lang['Current_Image'] = 'Jelenlegi k&eacute;p';

$lang['Notify_on_privmsg'] = '&Eacute;rtes&iacute;t&eacute;s &uacute;j priv&aacute;t &uuml;zenet &eacute;rkez&eacute;sekor';
$lang['Popup_on_privmsg'] = 'Felugr&oacute; ablak &uacute;j priv&aacute;t &uuml;zenet &eacute;rkez&eacute;sekor';
$lang['Popup_on_privmsg_explain'] = 'N&eacute;h&aacute;ny sablon &uacute;j ablakot nyit, ha &uacute;j &uuml;zeneted &eacute;rkezik.';
$lang['Hide_user'] = 'Jelenl&eacute;t elrejt&eacute;se';

$lang['Profile_updated'] = 'A profil megv&aacute;ltozott!';
$lang['Profile_updated_inactive'] = 'A profil megv&aacute;ltozott, de mivel n&eacute;h&aacute;ny alapvet&otilde; inform&aacute;ci&oacute;n v&aacute;ltoztatott, &iacute;gy a hozz&aacute;f&eacute;r&eacute;se inakt&iacute;vra v&aacute;ltozott. Ellen&otilde;rize az email-c&iacute;m&eacute;t, melyben a megtal&aacute;lja az &uacute;jraaktiv&aacute;l&aacute;shoz sz&uuml;ks&eacute;ges inform&aacute;ci&oacute;kat, vagy ha ehhez Adminisztr&aacute;tor sz&uuml;ks&eacute;ges, v&aacute;rjon m&iacute;g &otilde; reaktiv&aacute;lja a hozz&aacute;f&eacute;r&eacute;s&eacute;t.';

$lang['Password_mismatch'] = 'A be&iacute;rt jelszavak nem egyeznek meg.';
$lang['Current_password_mismatch'] = 'A jelenlegi jelsz&oacute; nem egyezik meg az adatb&aacute;zisban tal&aacute;lhat&oacute;val.';
$lang['Password_long'] = 'A jelsz&oacute; nem lehet t&ouml;bb mint 32 karakter.';
$lang['Username_taken'] = 'Ez a felhaszn&aacute;l&oacute;n&eacute;v m&aacute;r foglalt.';
$lang['Username_invalid'] = 'A felhaszn&aacute;l&oacute;n&eacute;v &eacute;rv&eacute;nytelen karaktert tartalmaz.';
$lang['Username_disallowed'] = 'Ez a felhaszn&aacute;l&oacute;n&eacute;v nem enged&eacute;lyezett.';
$lang['Email_taken'] = 'Ezt az email-c&iacute;met m&aacute;r regisztr&aacute;lta egy m&aacute;sik felhaszn&aacute;l&oacute;.';
$lang['Email_banned'] = 'Ez az email-c&iacute;m le van tiltva.';
$lang['Email_invalid'] = '&Eacute;rv&eacute;nytelen email-c&iacute;m.';
$lang['Signature_too_long'] = 'T&uacute;l hossz&uacute; al&aacute;&iacute;r&aacute;s.';
$lang['Fields_empty'] = 'A csillaggal jel&ouml;lt mez&otilde;k kit&ouml;lt&eacute;se k&ouml;telez&otilde;.';
$lang['Avatar_filetype'] = 'Az avatar k&eacute;p t&iacute;pusa csak JPG, GIF vagy PNG lehet.';
$lang['Avatar_filesize'] = 'Az avatar k&eacute;p nem lehet nagyobb mint %d KByte.'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'Az avatar nem lehet nagyobb mint %d pixel sz&eacute;les &eacute;s %d pixel magas.';

$lang['Welcome_subject'] = '&Uuml;dv&ouml;z&ouml;lj&uuml;k a f&oacute;rumban!'; // Welcome to dollar-s forums
$lang['New_account_subject'] = '&Uacute;j felhaszn&aacute;l&oacute;';
$lang['Account_activated_subject'] = 'Felhaszn&aacute;l&oacute; aktiv&aacute;lva.';

$lang['Account_added'] = 'K&ouml;sz&ouml;nj&uuml;k a regisztr&aacute;ci&oacute;j&aacute;t, mely sikeresen befejez&otilde;d&ouml;tt. Most m&aacute;r bejelentkezhet a nev&eacute;vel, &eacute;s a hozz&aacute; tartoz&oacute; jelsz&oacute;val.';
$lang['Account_inactive'] = 'A regisztr&aacute;ci&oacute; sikeres volt, de a bel&eacute;p&eacute;s el&otilde;tt m&eacute;g aktiv&aacute;lnia kell az azonos&iacute;t&oacute;j&aacute;tt.<br />Az ezzel kapcsolatos inform&aacute;ci&oacute;k&eacute;rt n&eacute;zze meg a regisztr&aacute;ci&oacute;n&aacute;l megadott email-c&iacute;met.';
$lang['Account_inactive_admin'] = 'A regisztr&aacute;ci&oacute; sikeres volt, de a f&oacute;rum haszn&aacute;lat&aacute;hoz az Adminisztr&aacute;tor j&oacute;v&aacute;hagy&aacute;sa sz&uuml;ks&eacute;ges.<br />R&ouml;videsen &eacute;rtes&iacute;ti az regisztr&aacute;ci&oacute;ja befejez&eacute;s&eacute;r&otilde;l, a felhaszn&aacute;l&oacute;neve aktiv&aacute;l&aacute;s&aacute;r&oacute;l.';
$lang['Account_active'] = 'A felhaszn&aacute;l&oacute;neve aktiv&aacute;lva lett. K&ouml;sz&ouml;nj&uuml;k a regisztr&aacute;ci&oacute;t.';
$lang['Account_active_admin'] = 'A felhaszn&aacute;l&oacute; aktiv&aacute;lva van.';
$lang['Reactivate'] = 'Felhaszn&aacute;l&oacute;n&eacute;v &uacute;jraaktiv&aacute;l&aacute;sa!';
$lang['Already_activated'] = 'M&aacute;r aktiv&aacute;lta a felhaszn&aacute;l&oacute;nev&eacute;t.';
$lang['COPPA'] = 'A felhaszn&aacute;l&oacute;n&eacute;v elk&eacute;sz&uuml;lt, de ellen&otilde;rz&eacute;s &uuml;gy&eacute;ben el&otilde;bb n&eacute;zze meg az email-c&iacute;m&eacute;t.';

$lang['Registration'] = 'Felhaszn&aacute;l&oacute;i szab&aacute;lyzat';
$lang['Reg_agreement'] = 'Noha az Adminisztr&aacute;tor, &eacute;s a moder&aacute;torok mindent megtesznek, hogy min&eacute;l hamarabb elt&aacute;vol&iacute;ts&aacute;k a F&oacute;rumb&oacute;l az &aacute;ltal&aacute;nosan kifog&aacute;solhat&oacute; anyagokat, lehetetlen, hogy minden egyes hozz&aacute;sz&oacute;l&aacute;st &aacute;tn&eacute;zzenek. Ebb&otilde;l ad&oacute;d&oacute;an elfogadom, hogy a F&oacute;rumon tal&aacute;lhat&oacute; &ouml;sszes hozz&aacute;sz&oacute;l&aacute;s a szerz&otilde; n&eacute;zeteit t&uuml;kr&ouml;zi, &eacute;s nem az Adminisztr&aacute;torok, Moder&aacute;torok, vagy a Webmester &aacute;ll&aacute;spontj&aacute;t - &iacute;gy &otilde;k nem v&aacute;llalnak felel&otilde;ss&eacute;get a hozz&aacute;sz&oacute;l&aacute;sok tartalm&aacute;&eacute;rt.<br /><br
/>Beleegyezek, hogy nem k&uuml;ld&ouml;k s&eacute;rteget&otilde;, obszc&eacute;n, vulg&aacute;ris, r&aacute;galmaz&oacute;, gy&ucirc;l&ouml;letkelt&otilde;, t&aacute;mad&oacute;,
vagy b&aacute;rmely m&aacute;s olyan tartalmat, illetve anyagot, mely t&ouml;rv&eacute;nyt s&eacute;rt. Mivel ez egy nyilv&aacute;nos f&oacute;rum, ez&eacute;rt olyan anyagot sem k&uuml;ld&ouml;k, mely ellent&eacute;tes az &aacute;ltal&aacute;nos k&ouml;z&iacute;zl&eacute;ssel. A fentiek megs&eacute;rt&eacute;se azonnali &eacute;s v&eacute;gleges t&ouml;rl&eacute;st von maga ut&aacute;n.<br
/>Elfogadom, hogy a F&oacute;rum webmester&eacute;nek, az Adminisztr&aacute;tornak &eacute;s b&aacute;rmely Moder&aacute;tornak jog&aacute;ban &aacute;ll
elt&aacute;vol&iacute;tani, szerkeszteni a hozz&aacute;sz&oacute;l&aacute;saimat, vagy lez&aacute;rni az &aacute;ltalam nyitott t&eacute;m&aacute;kat,
amennyiben &uacute;gy &iacute;t&eacute;lik meg hogy ez sz&uuml;ks&eacute;ges. Mint felhaszn&aacute;l&oacute;, elfogadom, hogy n&eacute;h&aacute;ny, &aacute;ltalam
megadott adat t&aacute;rol&aacute;sra ker&uuml;l a F&oacute;rum adatb&aacute;zis&aacute;ban. Ezek az inform&aacute;ci&oacute;k semmilyen m&oacute;don nem ker&uuml;lnek ki egy
harmadik f&eacute;lhez, de sem az Adminisztr&aacute;tor sem a Moder&aacute;torok nem tudnak felel&otilde;ss&eacute;get v&aacute;llalni az adatok&eacute;rt egy esetleges "hacker-t&aacute;mad&aacute;s" eset&eacute;n.<br /><br />A F&oacute;rum "cookie"-kat (s&uuml;tiket) haszn&aacute;l, hogy adatokat t&aacute;roljon a felhaszn&aacute;l&oacute; sz&aacute;m&iacute;t&oacute;g&eacute;p&eacute;n, de egyik sem tartalmaz szem&eacute;lyes adatokat, melyek a regisztr&aacute;ci&oacute;n&aacute;l ker&uuml;ltek megad&aacute;sra: a cookie-k puszt&aacute;n technikai szempontb&oacute;l sz&uuml;ks&eacute;gesek.<br />A megadott email-c&iacute;m csak a regisztr&aacute;ci&oacute; (&eacute;s az &uacute;j jelsz&oacute;) &eacute;rv&eacute;nyes&iacute;t&eacute;s&eacute;hez sz&uuml;ks&eacute;geltetik, semmilyen m&aacute;s felhaszn&aacute;l&aacute;sra nem ker&uuml;l, &eacute;s a hozz&aacute;tartoz&oacute; szem&eacute;lyes adatok sem.<br /><br />';

$lang['Agree_under_13'] = '<span class="thick">Elfogadom</span> a felt&eacute;teleket, &eacute;s 13 &eacute;vesn&eacute;l <span class="italic">fiatalabb</span> vagyok.';
$lang['Agree_over_13'] = '<span class="thick">Elfogadom</span> a felt&eacute;teleket.';
$lang['Agree_not'] = '<span class="thick">Nem fogadom el</span> a felt&eacute;teleket.';

$lang['Wrong_activation'] = 'Az aktiv&aacute;ci&oacute;s kulcs nem egyezik meg az adatb&aacute;zisban l&eacute;v&otilde;vel.';
$lang['Send_password'] = '&Uacute;j jelsz&oacute; k&uuml;ld&eacute;se';
$lang['Password_updated'] = 'Az &uacute;j jelsz&oacute; elk&eacute;sz&uuml;lt, ellen&otilde;rizze az email-c&iacute;m&eacute;t a tov&aacute;bbi inform&aacute;ci&oacute;k&eacute;rt.';
$lang['No_email_match'] = 'A megadott email-c&iacute;m nem egyezik meg a hozz&aacute; adott felhaszn&aacute;l&oacute;n&eacute;vhez.';
$lang['New_password_activation'] = '&Uacute;j jelsz&oacute; aktiv&aacute;ci&oacute;';
$lang['Password_activated'] = 'A hozz&aacute;f&eacute;r&eacute;s&eacute;t &uacute;jraaktiv&aacute;ltuk. A bejelentkez&eacute;shez &iacute;rja be az emailben megadott jelsz&oacute;t.';

$lang['Send_email_msg'] = 'Email &uuml;zenet k&uuml;ld&eacute;se';
$lang['No_user_specified'] = 'Nem adott meg felhaszn&aacute;l&oacute;nevet.';
$lang['User_prevent_email'] = 'A felhaszn&aacute;l&oacute; nem k&iacute;v&aacute;n emaileket fogadni. Pr&oacute;b&aacute;ljon priv&aacute;t &uuml;zenetet k&uuml;ldeni.';
$lang['User_not_exist'] = 'Ilyen felhaszn&aacute;l&oacute; nem l&eacute;tezik.';
$lang['CC_email'] = 'M&aacute;solat k&uuml;ld&eacute;se mag&aacute;nak';
$lang['Email_message_desc'] = 'Az &uuml;zenet sima sz&ouml;vegk&eacute;nt lesz elk&uuml;ldve, ez&eacute;rt ne haszn&aacute;ljon HTML-t vagy BBCode tageket. A v&aacute;laszc&iacute;m az &Ouml;n email-c&iacute;me lesz.';
$lang['Flood_email_limit'] = 'Most nem k&uuml;ldhet t&ouml;bb emailt, pr&oacute;b&aacute;lkozzon k&eacute;s&otilde;bb.';
$lang['Recipient'] = 'C&iacute;mzett';
$lang['Email_sent'] = 'Email elk&uuml;ldve.';
$lang['Send_email'] = 'Email k&uuml;ld&eacute;se';
$lang['Empty_subject_email'] = 'K&ouml;telez&otilde; a t&eacute;ma megad&aacute;sa.';
$lang['Empty_message_email'] = 'Az &uuml;zenet &uuml;res.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Az &eacute;rv&eacute;nyes&iacute;t&otilde; k&oacute;d hib&aacute;s.';
$lang['Too_many_registers'] = 'Egyszerre t&uacute;l sok regisztr&aacute;ci&oacute;val pr&oacute;b&aacute;lkoztott. Pr&oacute;b&aacute;lkozzon k&eacute;s&otilde;bb.';
$lang['Confirm_code_impaired'] = 'Ha l&aacute;t&aacute;si (vagy egy&eacute;b) probl&eacute;m&aacute;k folyt&aacute;n nem tudn&aacute; elolvasni a k&oacute;dot, vegye fel a kapcsolatot az %sAdminisztr&aacute;torral%s.';
$lang['Confirm_code'] = '&Eacute;rv&eacute;nyes&iacute;t&otilde; k&oacute;d';
$lang['Confirm_code_explain'] = 'A k&oacute;dot &uacute;gy kell beg&eacute;pelni, ahogy itt l&aacute;tja. &Uuml;gyeljen a kis- &eacute;s nagybet&ucirc;kre, a 0 egy &aacute;tl&oacute;s vonallal van &aacute;th&uacute;zva.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Rendez&eacute;si m&oacute;d kiv&aacute;laszt&aacute;sa';
$lang['Sort'] = 'Rendez&eacute;s';
$lang['Sort_Top_Ten'] = 'A legt&ouml;bb hozz&aacute;sz&oacute;l&aacute;st k&uuml;ld&otilde; 10 felhaszn&aacute;l&oacute;';
$lang['Sort_Joined'] = 'Regisztr&aacute;ci&oacute; d&aacute;tuma';
$lang['Sort_Username'] = 'Felhaszn&aacute;l&oacute;n&eacute;v';
$lang['Sort_Location'] = 'Tart&oacute;zkod&aacute;si hely';
$lang['Sort_Posts'] = '&Ouml;sszes hozz&aacute;sz&oacute;l&aacute;s';
$lang['Sort_Email'] = 'Email';
$lang['Sort_Website'] = 'Honlap';
$lang['Sort_Ascending'] = 'N&ouml;vekv&otilde;';
$lang['Sort_Descending'] = 'Cs&ouml;kken&otilde;';
$lang['Order'] = 'Sorrend';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Csoport vez&eacute;rl&otilde;pult';
$lang['Group_member_details'] = 'Csoporttags&aacute;g r&eacute;szletek';
$lang['Group_member_join'] = 'Csatlakoz&aacute;s egy csoporthoz';

$lang['Group_Information'] = 'Csoport inform&aacute;ci&oacute;';
$lang['Group_name'] = 'A csoport neve';
$lang['Group_description'] = 'A csoport le&iacute;r&aacute;sa';
$lang['Group_membership'] = 'Csoporttags&aacute;g';
$lang['Group_Members'] = 'Csoporttagok';
$lang['Group_Moderator'] = 'Csoport moder&aacute;tor';
$lang['Pending_members'] = 'K&eacute;relmezett tags&aacute;gok';

$lang['Group_type'] = 'A csoport t&iacute;pusa';
$lang['Group_open'] = 'Ny&iacute;lt csoport';
$lang['Group_closed'] = 'Z&aacute;rt csoport';
$lang['Group_hidden'] = 'Rejtett csoport';

$lang['Current_memberships'] = 'Aktu&aacute;lis tags&aacute;gok';
$lang['Non_member_groups'] = 'Csoportok';
$lang['Memberships_pending'] = 'Tags&aacute;gi k&eacute;relmek';

$lang['No_groups_exist'] = 'Jelenleg m&eacute;g nincsen csoport a F&oacute;rumon.';
$lang['Group_not_exist'] = 'A megadott csoport nem l&eacute;tezik.';

$lang['Join_group'] = 'Csatlakoz&aacute;s a csoporthoz';
$lang['No_group_members'] = 'A csoportnak nincsenek tagjai.';
$lang['Group_hidden_members'] = 'A csoport rejtett, nem tudja megn&eacute;zni a tagjait.';
$lang['No_pending_group_members'] = 'A csoportnak nincsenek f&uuml;gg&otilde; k&eacute;relmez&eacute;sben l&eacute;v&otilde; tagjai.';
$lang['Group_joined'] = 'A jelentkez&eacute;s sikeresen megt&ouml;rt&eacute;nt!<br />A Csoport moder&aacute;tora &eacute;rtes&iacute;teni fogja, ha elfogadta a k&eacute;relm&eacute;t.';
$lang['Group_request'] = 'A csatlakoz&aacute;si k&eacute;relme elk&eacute;sz&uuml;lt.';
$lang['Group_approved'] = 'Csatlakoz&aacute;si k&eacute;relme elfogadva.';
$lang['Group_added'] = 'Csatlakozott a csoporthoz.';
$lang['Already_member_group'] = 'M&aacute;r tagja ennek a csoportnak.';
$lang['User_is_member_group'] = 'A felhaszn&aacute;l&oacute; m&aacute;r most is tagja ennek a csoportnak.';
$lang['Group_type_updated'] = 'Sikeresen megv&aacute;ltozott a csoport t&iacute;pusa.';

$lang['Could_not_add_user'] = 'A kiv&aacute;lasztott felhaszn&aacute;l&oacute; nem l&eacute;tezik.';
$lang['Could_not_anon_user'] = 'Nem k&eacute;sz&iacute;thet n&eacute;vtelen csoporttagot.';

$lang['Confirm_unsub'] = 'Biztosan le akarja mondani ezt a csoporttags&aacute;got?';
$lang['Confirm_unsub_pending'] = 'A jelentkez&eacute;se m&eacute;g nincs j&oacute;v&aacute;hagyva ehhez a csoporthoz, biztosan le akarja mondani?';

$lang['Unsub_success'] = 'Sikeresen lemondta a csoporttags&aacute;got.';

$lang['Approve_selected'] = 'Kiv&aacute;lasztottak elfogad&aacute;sa';
$lang['Deny_selected'] = 'Kiv&aacute;laszottak elutas&iacute;t&aacute;sa';
$lang['Not_logged_in'] = 'Be kell jelentkeznie, hogy csatlakozhasson egy csoporthoz.';
$lang['Remove_selected'] = 'Kijel&ouml;lt tagok t&ouml;rl&eacute;se';
$lang['Add_member'] = 'Tag hozz&aacute;ad&aacute;sa';
$lang['Not_group_moderator'] = '&Ouml;n nem a csoport moder&aacute;tora, &iacute;gy nem v&eacute;gezheti el ezeket a m&oacute;dos&iacute;t&aacute;sokat.';

$lang['Login_to_join'] = 'A csatlakoz&aacute;shoz, vagy a csoporttags&aacute;gok ir&aacute;ny&iacute;t&aacute;s&aacute;hoz el&otilde;sz&ouml;r be kell jelentkeznie.';
$lang['This_open_group'] = 'Nyitott csoport, kattints a tags&aacute;g k&eacute;relmez&eacute;s&eacute;shez.';
$lang['This_closed_group'] = 'Z&aacute;rt csoport, t&ouml;bb felhaszn&aacute;l&oacute; nem enged&eacute;lyezett.';
$lang['This_hidden_group'] = 'Ehhez a rejtett csoporthoz nem lehet automatikusan &uacute;j felhaszn&aacute;l&oacute;kat adni!';
$lang['Member_this_group'] = '&Ouml;n a csoport tajga.';
$lang['Pending_this_group'] = 'A csoport moder&aacute;tora m&eacute;g nem d&ouml;nt&ouml;tt a felv&eacute;tel&eacute;r&otilde;l.';
$lang['Are_group_moderator'] = '&Ouml;n a csoport moder&aacute;tora.';
$lang['None'] = 'nincsen';

$lang['Subscribe'] = 'Jelentkez&eacute;s';
$lang['Unsubscribe'] = 'Lemond&aacute;s';
$lang['View_Information'] = 'Inform&aacute;ci&oacute;k a csoportr&oacute;l';


//
// Search
//
$lang['Search_query'] = 'Keres&eacute;si felt&eacute;telek';
$lang['Search_options'] = 'Keres&eacute;si be&aacute;ll&iacute;t&aacute;sok';

$lang['Search_keywords'] = 'Keres&eacute;s kulcssz&oacute;ra';
$lang['Search_keywords_explain'] = 'Haszn&aacute;lhatja az <span class="underline">AND</span> (&eacute;s) sz&oacute;t, hogy a keres&eacute;sben megadott &ouml;sszes sz&oacute; benne legyen a tal&aacute;latban, az <span class="underline">OR</span> (vagy) sz&oacute;t mellyel a "benne lehet" szavakat v&aacute;laszthatja el, &eacute;s a <span class="underline">NO</span> (nem) sz&oacute;t, mellyel kiz&aacute;rhat szavakat.<br />Haszn&aacute;ljon *-ot a r&eacute;szleges szavakhoz.';
$lang['Search_author'] = 'Szerz&otilde; keres&eacute;se';
$lang['Search_author_explain'] = 'Haszn&aacute;ljon *-ot a r&eacute;szleges szavakhoz.';

$lang['Search_for_any'] = 'Keres&eacute;s b&aacute;rmely kifejez&eacute;sre';
$lang['Search_for_all'] = 'Keres&eacute;s az &ouml;sszes kifejez&eacute;sre';
$lang['Search_title_msg'] = 'Keres&eacute;s t&eacute;ma c&iacute;mre, &eacute;s sz&ouml;vegre';
$lang['Search_msg_only'] = 'Csak sz&ouml;vegben keresse';

$lang['Return_first'] = 'A tal&aacute;lt t&eacute;m&aacute;k els&otilde;'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'karakter&eacute;nek megjelen&iacute;t&eacute;se.';

$lang['Search_previous'] = 'Keres&eacute;s az el&otilde;z&otilde; x id&otilde;tartamban'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Rendez&eacute;si felt&eacute;tel';
$lang['Sort_Time'] = 'Bek&uuml;ld&eacute;s ideje';
$lang['Sort_Post_Subject'] = 'T&eacute;ma';
$lang['Sort_Topic_Title'] = 'T&eacute;ma c&iacute;me';
$lang['Sort_Author'] = 'Szerz&otilde;';
$lang['Sort_Forum'] = 'F&oacute;rum';

$lang['Display_results'] = 'Tal&aacute;latok megjelen&iacute;t&eacute;se';
$lang['All_available'] = '&Ouml;sszes tal&aacute;lat';
$lang['No_searchable_forums'] = 'Nincs joga keresni a f&oacute;rumban.';

$lang['No_search_match'] = 'A keres&eacute;si felt&eacute;teleknek egy f&oacute;rum, &eacute;s egy t&eacute;ma sem felelt meg.';
$lang['Found_search_match'] = '%d tal&aacute;lat'; // eg. Search found 1 match
$lang['Found_search_matches'] = '%d tal&aacute;lat'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'K&eacute;t keres&eacute;s k&ouml;z&ouml;tt el kell telnie egy meghat&aacute;rozott id&otilde;tartamnak, v&aacute;rjon egy kicsit &eacute;s pr&oacute;b&aacute;lkozzon &uacute;jra.';

$lang['Close_window'] = 'Ablak bez&aacute;r&aacute;sa';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Csak a %s k&uuml;ldhetnek k&ouml;zlem&eacute;nyt ebbe a f&oacute;rumba.';
$lang['Sorry_auth_sticky'] = 'Csak a %s k&uuml;ldhetnek kiemelt t&eacute;m&aacute;t ebbe a f&oacute;rumba.';
$lang['Sorry_auth_read'] = 'Csak a %s olvashatj&aacute;k a f&oacute;rum t&eacute;m&aacute;it.';
$lang['Sorry_auth_post'] = 'Csak a %s nyithatnak &uacute;j t&eacute;m&aacute;t ebben a f&oacute;rumban.';
$lang['Sorry_auth_reply'] = 'Csak a %s v&aacute;laszolhatnak egy hozz&aacute;sz&oacute;l&aacute;sra ebben a f&oacute;rumban.';
$lang['Sorry_auth_edit'] = 'Csak a %s szerkeszthetnek hozz&aacute;sz&oacute;l&aacute;sokat ebben a f&oacute;rumban.';
$lang['Sorry_auth_delete'] = 'Csak a %s t&ouml;r&ouml;lhetnek hozz&aacute;sz&oacute;l&aacute;sokat ebben a f&oacute;rumban.';
$lang['Sorry_auth_vote'] = 'Csak a %s szavazhatnak ebben a f&oacute;rumban.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<span class="thick">vend&eacute;gek</span>';
$lang['Auth_Registered_Users'] = '<span class="thick">regisztr&aacute;lt felhaszn&aacute;l&oacute;k</span>';
$lang['Auth_Users_granted_access'] = '<span class="thick">priv&aacute;t enged&eacute;llyel rendelkez&otilde; felhaszn&aacute;l&oacute;k</span>';
$lang['Auth_Moderators'] = '<span class="thick">moder&aacute;torok</span>';
$lang['Auth_Administrators'] = '<span class="thick">adminisztr&aacute;torok</span>';

$lang['Not_Moderator'] = '&Ouml;n nem a f&oacute;rum moder&aacute;tora!';
$lang['Not_Authorised'] = '&Ouml;n nem jogosult erre a m&ucirc;veletre!';

$lang['You_been_banned'] = 'Ki lett tiltva a F&oacute;rumr&oacute;l!<br />A tov&aacute;bbi tudnival&oacute;k&eacute;rt vegye fel a kapcsolatot a Webmesterrel, vagy az Adminisztr&aacute;torral.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = '0 regisztr&aacute;lt felhaszn&aacute;l&oacute; &eacute;s  '; // There are 5 Registered and
$lang['Reg_users_online'] = '%d regisztr&aacute;lt felhaszn&aacute;l&oacute; &eacute;s '; // There are 5 Registered and
$lang['Reg_user_online'] = '%d regisztr&aacute;lt felhaszn&aacute;l&oacute; &eacute;s '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 rejtett felhaszn&aacute;l&oacute; van jelen'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d rejtett felhaszn&aacute;l&oacute; van jelen.'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d rejtett felhaszn&aacute;l&oacute; van jelen'; // 6 Hidden users online
$lang['Guest_users_online'] = '%d vend&eacute;g van jelen'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = '0 vend&eacute;g van jelen'; // There are 10 Guest users online
$lang['Guest_user_online'] = '%d vend&eacute;g van jelen'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'Jelenleg egy felhaszn&aacute;l&oacute; sem b&ouml;ng&eacute;szi a f&oacute;rum oldalait';

$lang['Online_explain'] = 'A fenti adat az elm&uacute;lt 5 perc alapj&aacute;n k&eacute;sz&uuml;lt.';

$lang['Forum_Location'] = 'F&oacute;rum helye';
$lang['Last_updated'] = 'Legut&oacute;bb friss&iacute;tett';

$lang['Forum_index'] = 'F&oacute;rum index';
$lang['Logging_on'] = 'Bejelentkez&eacute;s';
$lang['Posting_message'] = '&Uuml;zenet k&uuml;ld&eacute;se';
$lang['Searching_forums'] = 'F&oacute;rumok keres&eacute;se';
$lang['Viewing_profile'] = 'Profil megtekint&eacute;se';
$lang['Viewing_online'] = 'Jelenl&eacute;v&otilde; felhaszn&aacute;l&oacute;k megtekint&eacute;se';
$lang['Viewing_member_list'] = 'Taglista megtekint&eacute;se';
$lang['Viewing_priv_msgs'] = 'Priv&aacute;t &uuml;zenetek megtekint&eacute;se';
$lang['Viewing_FAQ'] = 'Gy.I.K. megtekint&eacute;se';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Moder&aacute;tor vez&eacute;rl&otilde;pult';
$lang['Mod_CP_explain'] = 'Az al&aacute;bbi &ucirc;rlap seg&iacute;ts&eacute;g&eacute;vel kezelheti a f&oacute;rumot, pld. lez&aacute;r&aacute;s, megnyit&aacute;s, &aacute;thelyez&eacute;s, t&ouml;rl&eacute;s.';

$lang['Select'] = 'Kiv&aacute;laszt';
$lang['Delete'] = 'T&ouml;r&ouml;l';
$lang['Move'] = '&Aacute;thelyez';
$lang['Lock'] = 'Lez&aacute;r';
$lang['Unlock'] = 'Megnyit';

$lang['Topics_Removed'] = 'A kiv&aacute;laszott t&eacute;m&aacute;k sikeresen t&ouml;r&ouml;lve lettek az adatb&aacute;zisb&oacute;l!';
$lang['Topics_Locked'] = 'A kiv&aacute;laszott t&eacute;m&aacute;k le lettek z&aacute;rva!';
$lang['Topics_Moved'] = 'A kiv&aacute;laszott t&eacute;m&aacute;k sikeresen &aacute;tker&uuml;ltek az &uacute;j helyre!';
$lang['Topics_Unlocked'] = 'A kiv&aacute;laszott t&eacute;m&aacute;k sikeresen meg lettek nyitva!';
$lang['No_Topics_Moved'] = 'Nem lett &aacute;thelyezve t&eacute;ma!';

$lang['Confirm_delete_topic'] = 'Biztosan el akarja t&aacute;vol&iacute;tani a kiv&aacute;laszott t&eacute;m&aacute;(ka)t?';
$lang['Confirm_lock_topic'] = 'Biztosan le akarja z&aacute;rni a kiv&aacute;lasztott t&eacute;m&aacute;(ka)t?';
$lang['Confirm_unlock_topic'] = 'Biztosan meg akarja nyitni a kiv&aacute;lasztott t&eacute;m&aacute;(ka)t?';
$lang['Confirm_move_topic'] = 'Biztosan &aacute;t akarja helyezni a kiv&aacute;lasztott t&eacute;m&aacute;(ka)t?';

$lang['Move_to_forum'] = '&Aacute;thelyez&eacute;s a k&ouml;vetkez&otilde; f&oacute;rumba:';
$lang['Leave_shadow_topic'] = '&Aacute;rny&eacute;k-t&eacute;ma hagy&aacute;sa a r&eacute;gi f&oacute;rumban.';

$lang['Split_Topic'] = 'T&eacute;ma-sz&eacute;tv&aacute;laszt&oacute;';
$lang['Split_Topic_explain'] = 'Az al&aacute;bbi mez&otilde;k haszn&aacute;lat&aacute;val egy t&eacute;m&aacute;t k&eacute;tf&eacute;lek&eacute;ppen v&aacute;laszthat sz&eacute;t: vagy az adott hozz&aacute;sz&oacute;l&aacute;sok kiemel&eacute;s&eacute;vel, vagy egy adott hozz&aacute;sz&oacute;l&aacute;st&oacute;l sz&aacute;m&iacute;tva';
$lang['Split_title'] = 'A t&eacute;ma &uacute;j c&iacute;me';
$lang['Split_forum'] = 'A t&eacute;ma &uacute;j f&oacute;ruma';
$lang['Split_posts'] = 'Megjel&ouml;lt hozz&aacute;sz&oacute;l&aacute;sok sz&eacute;tv&aacute;laszt&aacute;sa';
$lang['Split_after'] = 'Sz&eacute;tv&aacute;laszt&aacute;s a bejel&ouml;lt hozz&aacute;sz&oacute;l&aacute;st&oacute;l';
$lang['Topic_split'] = 'A t&eacute;ma sz&eacute;tv&aacute;laszt&aacute;sa siker&uuml;lt!';

$lang['Too_many_error'] = 'T&uacute;l sok hozz&aacute;sz&oacute;l&aacute;st v&aacute;lasztott ki. Csak egy hozz&aacute;sz&oacute;l&aacute;st v&aacute;lasszon ki, az ut&aacute;na k&ouml;vetkez&otilde;k is kiemel&otilde;dnek!';

$lang['None_selected'] = 'A m&ucirc;velet v&eacute;grahajt&aacute;s&aacute;hoz t&eacute;m&aacute;t is ki kell v&aacute;lasztani. L&eacute;pjen vissza, &eacute;s v&aacute;lasszon ki legal&aacute;bb egyet.';
$lang['New_forum'] = '&Uacute;j f&oacute;rum';

$lang['This_posts_IP'] = 'A hozz&aacute;sz&oacute;l&aacute;s IP-je';
$lang['Other_IP_this_user'] = 'A felhaszn&aacute;l&oacute;hoz tartoz&oacute; egy&eacute;b IP-c&iacute;mek';
$lang['Users_this_IP'] = 'Az IP-hez tartoz&oacute; felhaszn&aacute;l&oacute;k';
$lang['IP_info'] = 'IP inform&aacute;ci&oacute;';
$lang['Lookup_IP'] = 'IP keres&eacute;se';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Id&otilde;z&oacute;na: %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = '(GMT -12 &oacute;ra)';
$lang['-11'] = '(GMT -11 &oacute;ra)';
$lang['-10'] = '(GMT -10 &oacute;ra)';
$lang['-9'] = '(GMT -9 &oacute;ra)';
$lang['-8'] = '(GMT -8 &oacute;ra)';
$lang['-7'] = '(GMT -7 &oacute;ra)';
$lang['-6'] = '(GMT -6 &oacute;ra)';
$lang['-5'] = '(GMT -5 &oacute;ra)';
$lang['-4'] = '(GMT -4 &oacute;ra)';
$lang['-3.5'] = '(GMT -3.5 &oacute;ra)';
$lang['-3'] = '(GMT -3 &oacute;ra)';
$lang['-2'] = '(GMT -2 &oacute;ra)';
$lang['-1'] = '(GMT -1 &oacute;ra)';
$lang['0'] = '(GMT 0) ';
$lang['1'] = '(GMT +1 &oacute;ra)';
$lang['2'] = '(GMT +2 &oacute;ra)';
$lang['3'] = '(GMT +3 &oacute;ra)';
$lang['3.5'] = '(GMT +3.5 &oacute;ra)';
$lang['4'] = '(GMT +4 &oacute;ra)';
$lang['4.5'] = '(GMT +4.5 &oacute;ra)';
$lang['5'] = '(GMT +5 &oacute;ra)';
$lang['5.5'] = '(GMT +5.5 &oacute;ra)';
$lang['6'] = '(GMT +6 &oacute;ra)';
$lang['6.5'] = '(GMT +6.5 &oacute;ra)';
$lang['7'] = '(GMT +7 &oacute;ra)';
$lang['8'] = '(GMT +8 &oacute;ra)';
$lang['9'] = '(GMT +9 &oacute;ra)';
$lang['9.5'] = '(GMT +9.5 &oacute;ra)';
$lang['10'] = '(GMT +10 &oacute;ra)';
$lang['11'] = '(GMT +11 &oacute;ra)';
$lang['12'] = '(GMT +12 &oacute;ra)';
$lang['13'] = 'GMT + 13 &oacute;ra';

// These are displayed in the timezone select box
$lang['tz']['-12'] = '(GMT -12 &oacute;ra) Eniwetok, Kwajalein';
$lang['tz']['-11'] = '(GMT -11 &oacute;ra) Midway-sziget, Szamoa';
$lang['tz']['-10'] = '(GMT -10 &oacute;ra) Hawaii';
$lang['tz']['-9'] = '(GMT -9 &oacute;ra) Alaszka';
$lang['tz']['-8'] = '(GMT -8 &oacute;ra) Csendes-&oacute;ce&aacute;ni id&otilde;, Tijuana';
$lang['tz']['-7'] = '(GMT -7 &oacute;ra) Arizona, Hegyi id&otilde;';
$lang['tz']['-6'] = '(GMT -6 &oacute;ra) Amerikai k&ouml;z&eacute;pid&otilde;, K&ouml;z&eacute;p-Amerika, Mexik&oacute;v&aacute;ros';
$lang['tz']['-5'] = '(GMT -5 &oacute;ra) Bogota, Lima, Quito, Indiana, Keleti id&otilde;';
$lang['tz']['-4'] = '(GMT -4 &oacute;ra) Atlanti-&oacute;ce&aacute;ni id&otilde;, Caracas, La Paz';
$lang['tz']['-3.5'] = '(GMT -3.5 &oacute;ra) &Uacute;j-Fulland';
$lang['tz']['-3'] = '(GMT -3 &oacute;ra) Braz&iacute;lia, Buenos Aires, Georgetown, Gr&ouml;nland';
$lang['tz']['-2'] = '(GMT -2 &oacute;ra) K&ouml;z&eacute;p-atlanti id&otilde;z&oacute;na';
$lang['tz']['-1'] = '(GMT -1 &oacute;ra) Azori-szigetek, Z&ouml;ld-foki-szigetek';
$lang['tz']['0'] = '(GMT 0) Greenwich, London, Dublin, Lisszabon';
$lang['tz']['1'] = '(GMT +1 &oacute;ra) Belgr&aacute;d, Budapest, Ljubljana, Pozsony, Pr&aacute;ga';
$lang['tz']['2'] = '(GMT +2 &oacute;ra) Budapest ny&aacute;ri isz., Ath&eacute;n, Isztambul, Minszk, Helsinki';
$lang['tz']['3'] = '(GMT +3 &oacute;ra) Bagdad, Kuvait, Rij&aacute;d, Moszkva, Szentp&eacute;terv&aacute;r';
$lang['tz']['3.5'] = '(GMT +3.5 &oacute;ra) Teher&aacute;n';
$lang['tz']['4'] = '(GMT +4 &oacute;ra) Baku, Tbiliszi';
$lang['tz']['4.5'] = '(GMT +4.5 &oacute;ra) Kabul';
$lang['tz']['5'] = '(GMT +5 &oacute;ra) Iszl&aacute;mb&aacute;d, Karacsi, Taskent, Jekatyerinburg';
$lang['tz']['5.5'] = '(GMT +5.5 &oacute;ra) Chennai, Kalkutta, Mumbai, &Uacute;j-Delhi';
$lang['tz']['6'] = '(GMT +6 &oacute;ra) Almaty, Novoszibirszk, Astana, Dhaka';
$lang['tz']['6.5'] = '(GMT +6.5 &oacute;ra) Rangun';
$lang['tz']['7'] = '(GMT +7 &oacute;ra) Bangkok, Dzsakarta, Hanoi, Krasznojarszk';
$lang['tz']['8'] = '(GMT +8 &oacute;ra) Hongkong, Peking, Irkutszk, Ul&aacute;nb&aacute;tor, Perth';
$lang['tz']['9'] = '(GMT +9 &oacute;ra) Jakutszk, Oszkara, Szapporo, Toki&oacute;, Sz&ouml;ul';
$lang['tz']['9.5'] = '(GMT +9.5 &oacute;ra) Adelaide, Darwin';
$lang['tz']['10'] = '(GMT +10 &oacute;ra) Brisbane, Canberra, Melbourne, Sydney, Guam';
$lang['tz']['11'] = '(GMT +11 &oacute;ra) Magad&aacute;n, Salamon-szigetek, &Uacute;j Kaled&oacute;nia';
$lang['tz']['12'] = '(GMT +12 &oacute;ra) Auckland, Wellington, Fidzsi-szigetek, Kamcsatka';

$lang['datetime']['Sunday'] = 'Vas&aacute;rnap';
$lang['datetime']['Monday'] = 'H&eacute;tf&otilde;';
$lang['datetime']['Tuesday'] = 'Kedd';
$lang['datetime']['Wednesday'] = 'Szerda';
$lang['datetime']['Thursday'] = 'Cs&uuml;t&ouml;rt&ouml;k';
$lang['datetime']['Friday'] = 'P&eacute;ntek';
$lang['datetime']['Saturday'] = 'Szombat';
$lang['datetime']['Sun'] = 'Vas.';
$lang['datetime']['Mon'] = 'H&eacute;tf.';
$lang['datetime']['Tue'] = 'Kedd.';
$lang['datetime']['Wed'] = 'Szer.';
$lang['datetime']['Thu'] = 'Cs&uuml;t.';
$lang['datetime']['Fri'] = 'P&eacute;nt.';
$lang['datetime']['Sat'] = 'Szomb.';
$lang['datetime']['January'] = 'Janu&aacute;r';
$lang['datetime']['February'] = 'Febru&aacute;r';
$lang['datetime']['March'] = 'M&aacute;rcius';
$lang['datetime']['April'] = '&Aacute;prilis';
$lang['datetime']['May'] = 'M&aacute;jus';
$lang['datetime']['June'] = 'J&uacute;nius';
$lang['datetime']['July'] = 'J&uacute;lius';
$lang['datetime']['August'] = 'Augusztus';
$lang['datetime']['September'] = 'Szeptember';
$lang['datetime']['October'] = 'Okt&oacute;ber';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan.';
$lang['datetime']['Feb'] = 'Feb.';
$lang['datetime']['Mar'] = 'M&aacute;rc.';
$lang['datetime']['Apr'] = '&Aacute;pr.';
$lang['datetime']['May'] = 'M&aacute;j.';
$lang['datetime']['Jun'] = 'J&uacute;n.';
$lang['datetime']['Jul'] = 'J&uacute;l.';
$lang['datetime']['Aug'] = 'Aug.';
$lang['datetime']['Sep'] = 'Szept.';
$lang['datetime']['Oct'] = 'Okt.';
$lang['datetime']['Nov'] = 'Nov.';
$lang['datetime']['Dec'] = 'Dec.';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Inform&aacute;ci&oacute;';
$lang['Critical_Information'] = 'Kritikus inform&aacute;ci&oacute;';

$lang['General_Error'] = '&Aacute;ltal&aacute;nos hiba';
$lang['Critical_Error'] = 'Kritikus hiba';
$lang['An_error_occured'] = 'Hiba ad&oacute;dott';
$lang['A_critical_error'] = 'Kritikus hiba ad&oacute;dott';

$lang['Admin_reauthenticate'] = 'A f&oacute;rum adminisztr&aacute;ci&oacute;j&aacute;hoz &uacute;jra azonos&iacute;tania kell mag&aacute;t.';
$lang['Login_attempts_exceeded'] = 'T&uacute;ll&eacute;pte a %s enged&eacute;lyezett bel&eacute;p&eacute;si k&iacute;s&eacute;rletet. A k&ouml;vetkez&otilde; %s percben nem l&eacute;phet be.';
$lang['Please_remove_install_contrib'] = 'K&eacute;rj&uuml;k t&ouml;r&ouml;lje az install/ &eacute;s a contrib/ k&ouml;nyvt&aacute;rat.';
$lang['Session_invalid'] = '&Eacute;rv&eacute;nytelen munkamenet. K&eacute;rj&uuml;k k&uuml;ldje el &uacute;jra az &ucirc;rlapot.';

// Profile modal pop-up about using YA to edit profile
$lang['Attention'] = 'Attention';
$lang['Continue'] = 'Continue';
$lang['Go_Your_Account'] = 'Go to Your Account';
$lang['YA_Warning'] = 'Unless you are uploading an avatar you should be using %s to edit your profile';

//+MOD: Start Advanced BBCode Box MOD vRN2.5.2
$lang['BBcode_box_view'] = 'Click to View Content';
//-MOD: Advanced BBCode Box MOD vRN2.5.2
//+MOD: Select Expand BBcodes MOD
$lang['Select'] = 'Select';
$lang['Expand'] = 'Expand';
$lang['Contract'] = 'Contract';
//-MOD: Select Expand BBcodes MOD

//
// That's all, Folks!
// -------------------------------------------------

// Added by Attached Forums MOD
$lang['Attached_forum'] = 'SubForum';
$lang['Attached_forums'] = 'SubForums';
// End Added by Attached Forums MOD

?>
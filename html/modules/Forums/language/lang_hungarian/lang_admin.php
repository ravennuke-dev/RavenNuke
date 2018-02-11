<?php

/***************************************************************************
 *                            lang_admin.php [Magyar]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin.php,v 1.35.2.11 2005/10/04 21:45:02 grahamje Exp $
 *
 *     translated by   :  Szilard Andai
 *     web             :  http://iranon.ezustkep.hu
 *     version         : 2.0.20
 *     completed by    : Fodor Bertalan - http://phpbb.hu and László Miklós
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/* CONTRIBUTORS
        2002-12-15        Philip M. White (pwhite@mailhaven.com)
                Fixed many minor grammatical mistakes
*/

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = '&Aacute;ltal&aacute;nos';
$lang['Users'] = 'Felhaszn&aacute;l&oacute;k';
$lang['Groups'] = 'Csoportok';
$lang['Forums'] = 'F&oacute;rumok';
$lang['Styles'] = 'Sablonok';

$lang['Configuration'] = 'Be&aacute;ll&iacute;t&aacute;s';
$lang['Permissions'] = 'Jogosults&aacute;g';
$lang['Manage'] = 'Be&aacute;ll&iacute;t&aacute;s';
$lang['Disallow'] = 'Tiltott nevek';
$lang['Prune'] = 'Karbantart&aacute;s';
$lang['Mass_Email'] = 'Csoportos email';
$lang['Ranks'] = 'Rangok';
$lang['Smilies'] = 'Emotikonok';
$lang['Ban_Management'] = 'Kitilt&aacute;sok';
$lang['Word_Censor'] = 'Cenz&uacute;ra';
$lang['Export'] = 'Export&aacute;l&aacute;s';
$lang['Create_new'] = 'K&eacute;sz&iacute;t&eacute;s';
$lang['Add_new'] = 'Hozz&aacute;ad&aacute;s';
$lang['Backup_DB'] = 'Adatb&aacute;zis kiment&eacute;se';
$lang['Restore_DB'] = 'Adatb&aacute;zis vissza&aacute;ll&iacute;t&aacute;sa';


//
// Index
//
$lang['Admin'] = 'Adminisztr&aacute;ci&oacute;';
$lang['Not_admin'] = 'Nincs jogosults&aacute;god az adminisztr&aacute;ci&oacute;hoz!';
$lang['Welcome_phpBB'] = '&Uuml;dv&ouml;zl&uuml;nk a phpBB-ben!';
$lang['Admin_intro'] = 'K&ouml;sz&ouml;nj&uuml;k, hogy a phpBB-t v&aacute;lasztottad a f&oacute;rumod megval&oacute;s&iacute;t&aacute;s&aacute;hoz. Ebben az ablakban egy gyors &aacute;ttekint&eacute;st l&aacute;thatsz a F&oacute;rum n&eacute;h&aacute;ny adat&aacute;r&oacute;l. Erre az oldalra mindig visszat&eacute;rhetsz, ha a bal oldali men&uuml;pontban r&aacute;kattintasz az <span class="italic">Admin kezd&otilde;lap</span> linkre. A F&oacute;rumba val&oacute; visszat&eacute;r&eacute;shez kattints a phpBB ikonra, mely szint&eacute;n a bal oldali men&uuml; tetej&eacute;n tal&aacute;lhat&oacute; meg. A t&ouml;bbi hivatkoz&aacute;ssal a F&oacute;rum be&aacute;ll&iacute;t&aacute;sait v&aacute;ltoztathatod meg, a legapr&oacute;bb r&eacute;szletbe men&otilde;en. Minden oldalhoz egy k&uuml;l&ouml;n kis le&iacute;r&aacute;s tartozik, mely seg&iacute;t a be&aacute;ll&iacute;t&aacute;sokban.';
$lang['Main_index'] = 'F&oacute;rum kezd&otilde;lap';
$lang['Forum_stats'] = 'F&oacute;rum statisztika';
$lang['Admin_Index'] = 'Admin kezd&otilde;lap';
$lang['Preview_forum'] = 'F&oacute;rum el&otilde;n&eacute;zet';

$lang['Click_return_admin_index'] = 'Kattints %side%s, hogy visszat&eacute;rj az Admin kezd&otilde;lapra';

$lang['Statistic'] = 'Statisztika';
$lang['Value'] = '&Eacute;rt&eacute;k';
$lang['Number_posts'] = 'Hozz&aacute;sz&oacute;l&aacute;sok sz&aacute;ma';
$lang['Posts_per_day'] = 'Hozz&aacute;sz&oacute;l&aacute;sok sz&aacute;ma naponta';
$lang['Number_topics'] = 'T&eacute;m&aacute;k sz&aacute;ma';
$lang['Topics_per_day'] = 'T&eacute;m&aacute;k sz&aacute;ma naponta';
$lang['Number_users'] = 'Felhaszn&aacute;l&oacute;k sz&aacute;ma';
$lang['Users_per_day'] = 'Felhaszn&aacute;l&oacute;k sz&aacute;ma naponta';
$lang['Board_started'] = 'F&oacute;rum indul&aacute;sa';
$lang['Avatar_dir_size'] = 'Avatar k&ouml;nyvt&aacute;r m&eacute;rete';
$lang['Database_size'] = 'Adatb&aacute;zis m&eacute;rete';
$lang['Gzip_compression'] ='Gzip t&ouml;m&ouml;r&iacute;t&eacute;s';
$lang['Not_available'] = 'Nem el&eacute;rhet&otilde;';

$lang['ON'] = 'Bekapcsolva'; // This is for GZip compression
$lang['OFF'] = 'Kikapcsolva';


//
// DB Utils
//
$lang['Database_Utilities'] = 'Adatb&aacute;zis eszk&ouml;z&ouml;k';

$lang['Restore'] = 'Vissza&aacute;ll&iacute;t&aacute;s';
$lang['Backup'] = 'Kiment&eacute;s';
$lang['Restore_explain'] = 'Ezzel a funkci&oacute;val a phpBB f&oacute;rum adatb&aacute;zis&aacute;nak &ouml;sszes t&aacute;bl&aacute;j&aacute;t vissza lehet t&ouml;lteni egy kimentett f&aacute;jlb&oacute;l. Ha a szerver t&aacute;mogatja a kicsomagol&aacute;st, akkor egy GZIP-pel t&ouml;m&ouml;r&iacute;tett sz&ouml;veges f&aacute;jlb&oacute;l is be lehet t&ouml;lteni. <span class="thick">FIGYELEM!</span> Ez fel&uuml;l&iacute;rja az &eacute;ppen haszn&aacute;lt adatb&aacute;zist! Az adatb&aacute;zis vissza&aacute;ll&iacute;t&aacute;sa eltarthat egy ideig, ez&eacute;rt ne menj el addig err&otilde;l az oldalr&oacute;l, m&iacute;g nem jelzi, hogy k&eacute;sz van.';
$lang['Backup_explain'] = 'Ezzel a funkci&oacute;val a phpBB f&oacute;rum adatb&aacute;zis&aacute;nak &ouml;sszes t&aacute;bl&aacute;j&aacute;t ki lehet menteni egy k&uuml;ls&otilde; f&aacute;jlba. Ha van m&aacute;s, egy&eacute;ni phpBB-hez tartoz&oacute; t&aacute;bla is az adatb&aacute;zisban, akkor add meg azoknak a neveit is, vessz&otilde;vel elv&aacute;lasztva - az al&aacute;bbi Egy&eacute;b t&aacute;bl&aacute;k mez&otilde;be. Ha t&aacute;mogatja a szerver, akkor haszn&aacute;lhatsz GZIP t&ouml;m&ouml;r&iacute;t&eacute;st is, hogy kisebb legyen a let&ouml;ltend&otilde; f&aacute;jl m&eacute;rete.';

$lang['Backup_options'] = 'Kiment&eacute;si be&aacute;ll&iacute;t&aacute;sok';
$lang['Start_backup'] = 'Kiment&eacute;s ind&iacute;t&aacute;sa';
$lang['Full_backup'] = 'Teljes kiment&eacute;s';
$lang['Structure_backup'] = 'Csak az adatb&aacute;zis fel&eacute;p&iacute;t&eacute;s&eacute;nek kiment&eacute;se';
$lang['Data_backup'] = 'Csak az adatok kiment&eacute;se';
$lang['Additional_tables'] = 'Egy&eacute;b t&aacute;bl&aacute;k';
$lang['Gzip_compress'] = 'Gzip t&ouml;m&ouml;r&iacute;t&eacute;s';
$lang['Select_file'] = 'F&aacute;jl kiv&aacute;laszt&aacute;sa';
$lang['Start_Restore'] = 'Vissza&aacute;ll&iacute;t&aacute;s ind&iacute;t&aacute;sa';

$lang['Restore_success'] = 'Az adatb&aacute;zist sikeresen vissza&aacute;ll&iacute;tottam!<br /><br />A F&oacute;rum visszaker&uuml;lt a kiment&eacute;s el&otilde;tti &aacute;llapotba.';
$lang['Backup_download'] = 'A let&ouml;lt&eacute;s hamarosan elindul, v&aacute;rj a megkezd&eacute;s&eacute;ig.';
$lang['Backups_not_supported'] = 'Az adatb&aacute;zis kiment&eacute;se nem lehets&eacute;ges, mivel ez nincsen t&aacute;mogatva ebben az adatb&aacute;zis rendszerben.';

$lang['Restore_Error_uploading'] = 'Hiba, a kimentett f&aacute;jl felt&ouml;lt&eacute;se k&ouml;zben.';
$lang['Restore_Error_filename'] = 'Hib&aacute;s f&aacute;jln&eacute;v, v&aacute;lassz egy m&aacute;sik f&aacute;jlt.';
$lang['Restore_Error_decompress'] = 'A GZIP kit&ouml;m&ouml;r&iacute;t&eacute;s nem lehets&eacute;ges, adj meg egy sima sz&ouml;veges f&aacute;jlt.';
$lang['Restore_Error_no_file'] = 'A felt&ouml;lt&eacute;s sikertelen volt.';


//
// Auth pages
//
$lang['Select_a_User'] = 'V&aacute;lassz egy felhaszn&aacute;l&oacute;t';
$lang['Select_a_Group'] = 'V&aacute;lassz egy csoportot';
$lang['Select_a_Forum'] = 'V&aacute;lassz egy f&oacute;rumot';
$lang['Auth_Control_User'] = 'Felhaszn&aacute;l&oacute;i enged&eacute;lyek be&aacute;ll&iacute;t&aacute;sa';
$lang['Auth_Control_Group'] = 'Csoportenged&eacute;lyek be&aacute;ll&iacute;t&aacute;sa';
$lang['Auth_Control_Forum'] = 'F&oacute;rumhoz tartoz&oacute; jogosults&aacute;gok be&aacute;ll&iacute;t&aacute;sa';
$lang['Look_up_User'] = 'Felhaszn&aacute;l&oacute; keres&eacute;se';
$lang['Look_up_Group'] = 'Csoport keres&eacute;se';
$lang['Look_up_Forum'] = 'F&oacute;rum keres&eacute;se';

$lang['Group_auth_explain'] = 'Itt &aacute;ll&iacute;thatsz be jogosults&aacute;gokat &eacute;s moder&aacute;tor jogokat az egyes csoportokhoz. Ne felejtsd el, hogy a csoport jogosults&aacute;g megv&aacute;ltoztat&aacute;s&aacute;val egyes felhaszn&aacute;l&oacute;k m&eacute;g hozz&aacute;f&eacute;rhetnek a csoporthoz. Ebben az esetben egy figyelmezet&otilde; &uuml;zenetet fogsz kapni.';
$lang['User_auth_explain'] = 'Itt &aacute;ll&iacute;thatsz be jogosults&aacute;gokat &eacute;s moder&aacute;tor jogokat az egyes felhaszn&aacute;l&oacute;khoz. Ne felejtsd el, hogy a felhaszn&aacute;l&oacute;i jogosults&aacute;g megv&aacute;ltoztat&aacute;s&aacute;val egyes felhaszn&aacute;l&oacute;k m&eacute;g hozz&aacute;f&eacute;rhetnek egyes f&oacute;rumokhoz, stb. Ebben az esetben egy figyelmezet&otilde; &uuml;zenetet fogsz kapni.';
$lang['Forum_auth_explain'] = 'Itt &aacute;ll&iacute;thatod be a hozz&aacute;f&eacute;r&eacute;si jogosults&aacute;gokat az egyes f&oacute;rumokhoz, az Egyszer&ucirc; vagy B&otilde;v&iacute;tett lehet&otilde;s&eacute;get haszn&aacute;lva. Ne feledd, hogy a jogosults&aacute;gok megv&aacute;ltoztat&aacute;s&aacute;val a felhaszn&aacute;l&oacute;k &uacute;jabb opci&oacute;kat, &eacute;s v&aacute;ltoztat&aacute;si lehet&otilde;s&eacute;get &eacute;rhetnek el.';

$lang['Simple_mode'] = 'Egyszer&ucirc; m&oacute;d';
$lang['Advanced_mode'] = 'B&otilde;v&iacute;tett m&oacute;d';
$lang['Moderator_status'] = 'Moder&aacute;tori st&aacute;tusz';

$lang['Allowed_Access'] = 'Hozz&aacute;f&eacute;r&eacute;s enged&eacute;lyezve';
$lang['Disallowed_Access'] = 'Hozz&aacute;f&eacute;r&eacute;s megtagadva';
$lang['Is_Moderator'] = 'Moder&aacute;tor';
$lang['Not_Moderator'] = 'Nem moder&aacute;tor';

$lang['Conflict_warning'] = 'Jogosults&aacute;g-&uuml;tk&ouml;z&eacute;s';
$lang['Conflict_access_userauth'] = 'Ennek a felhaszn&aacute;l&oacute;nak m&aacute;r van f&oacute;rum jogosults&aacute;ga, a csoporttags&aacute;gon kereszt&uuml;l. Ha ezt meg akarod sz&uuml;ntetni vagy meg akarod v&aacute;ltoztatni, akkor a felhaszn&aacute;l&oacute; egy&eacute;ni jogosults&aacute;gaiban v&aacute;ltoztasd meg. A felhaszn&aacute;l&oacute;nak az al&aacute;bbi jogosults&aacute;gai vannak:';
$lang['Conflict_mod_userauth'] = 'Ennek a felhaszn&aacute;l&oacute;nak m&aacute;r van moder&aacute;tori joga ehhez a f&oacute;rumhoz a csoporttags&aacute;gon kereszt&uuml;l. Ha ezt meg akarod sz&uuml;ntetni, akkor a felhaszn&aacute;l&oacute; egy&eacute;ni jogosults&aacute;gaiban v&aacute;ltoztasd meg. A felhaszn&aacute;l&oacute;nak az al&aacute;bbi jogosults&aacute;gai vannak:';

$lang['Conflict_access_groupauth'] = 'Az egy&eacute;ni jogosults&aacute;gok be&aacute;ll&iacute;t&aacute;s&aacute;ban ennek a felhaszn&aacute;l&oacute;nak m&aacute;r van jogosults&aacute;ga ehhez a f&oacute;rumhoz. Ha ezt meg akarod v&aacute;ltoztatni, akkor a felhaszn&aacute;l&oacute; egy&eacute;ni jogosults&aacute;gaiban tedd meg. A felhaszn&aacute;l&oacute;nak az al&aacute;bbi jogosults&aacute;gai vannak:';
$lang['Conflict_mod_groupauth'] = 'Az egy&eacute;ni jogosults&aacute;gok be&aacute;ll&iacute;t&aacute;s&aacute;ban ennek a felhaszn&aacute;l&oacute;nak m&aacute;r van moder&aacute;tori joga ehhez a f&oacute;rumhoz. Ha ezt meg akarod sz&uuml;ntetni, akkor a felhaszn&aacute;l&oacute; egy&eacute;ni jogosults&aacute;gaiban v&aacute;ltoztasd meg. A felhaszn&aacute;l&oacute;nak az al&aacute;bbi jogosults&aacute;gai vannak:';

$lang['Public'] = 'Nyilv&aacute;nos';
$lang['Private'] = 'Priv&aacute;t';
$lang['Registered'] = 'Regisztr&aacute;lt';
$lang['Administrators'] = 'Adminisztr&aacute;tor';
$lang['Hidden'] = 'Rejtett';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'MINDENKI';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIV&Aacute;T';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'Megn&eacute;z';
$lang['Read'] = 'Olvas&aacute;s';
$lang['Post'] = 'T&eacute;manyit&aacute;s';
$lang['Reply'] = 'Hozz&aacute;sz&oacute;l&aacute;s';
$lang['Edit'] = 'Szerkeszt&eacute;s';
$lang['Delete'] = 'T&ouml;rl&eacute;s';
$lang['Sticky'] = 'Kiemelt';
$lang['Announce'] = 'K&ouml;zlem&eacute;ny';
$lang['Vote'] = 'Szavaz&aacute;s';
$lang['Pollcreate'] = 'Szavaz&aacute;s k&eacute;sz&iacute;t&eacute;se';

$lang['Permissions'] = 'Jogosults&aacute;gok';
$lang['Simple_Permission'] = 'Egyszer&ucirc; jogosults&aacute;g';

$lang['User_Level'] = 'Felhaszn&aacute;l&oacute;szint';
$lang['Auth_User'] = 'Felhaszn&aacute;l&oacute;';
$lang['Auth_Admin'] = 'Adminisztr&aacute;tor';
$lang['Group_memberships'] = 'Csoporttags&aacute;gok';
$lang['Usergroup_members'] = 'A k&ouml;vetkez&otilde; felhaszn&aacute;l&oacute;k tartoznak ebbe a csoportba:';

$lang['Forum_auth_updated'] = 'F&oacute;rum enged&eacute;lyek friss&iacute;tve.';
$lang['User_auth_updated'] = 'Felhaszn&aacute;l&oacute;i enged&eacute;lyek friss&iacute;tve.';
$lang['Group_auth_updated'] = 'Csoport-jogosults&aacute;gok friss&iacute;tve.';

$lang['Auth_updated'] = 'A Jogosults&aacute;gok sikeresen megv&aacute;ltoztak!';
$lang['Click_return_userauth'] = 'Kattints %side%s, hogy visszat&eacute;rj a Felhaszn&aacute;l&oacute;i jogosults&aacute;g be&aacute;ll&iacute;t&aacute;saihoz.';
$lang['Click_return_groupauth'] = 'Kattints %side%s hogy visszat&eacute;rj a Csoport jogosults&aacute;g be&aacute;ll&iacute;t&aacute;saihoz.';
$lang['Click_return_forumauth'] = 'Kattints %side%s hogy visszat&eacute;rj a F&oacute;rum jogosults&aacute;g be&aacute;ll&iacute;t&aacute;saihoz.';


//
// Banning
//
$lang['Ban_control'] = 'Kitilt&aacute;s';
$lang['Ban_explain'] = 'Ezen az oldalon lehet kitiltani egy vagy t&ouml;bb felhaszn&aacute;l&oacute;t, &iacute;gy azok nem tudj&aacute;k bet&ouml;lteni a F&oacute;rum kezd&otilde;oldal&aacute;t. Ezt vagy felhaszn&aacute;l&oacute;n&eacute;v, vagy IP-c&iacute;m (vagy IP-tartom&aacute;ny), vagy hosztn&eacute;v megad&aacute;s&aacute;val &eacute;rheted el. Az email-c&iacute;met is letilthatod, ekkor a felhaszn&aacute;l&oacute; nem tudja &uacute;j n&eacute;ven regisztr&aacute;lni mag&aacute;t. Figyelem, egy email-c&iacute;m letilt&aacute;s&aacute;val m&eacute;g nem biztos, hogy a felhaszn&aacute;l&oacute; ki lett tiltva a F&oacute;rumr&oacute;l; ehhez a felhaszn&aacute;l&oacute;n&eacute;v, az IP-c&iacute;m, &eacute;s az email-c&iacute;m egyidej&ucirc; letilt&aacute;s&aacute;t haszn&aacute;ld.';
$lang['Ban_explain_warn'] = 'Figyelem! Az IP-tartom&aacute;ny megad&aacute;s&aacute;val a kezd&otilde;, &eacute;s az utols&oacute; IP k&ouml;z&ouml;tt az &ouml;sszes c&iacute;m le lesz tiltva. Lehet&otilde;s&eacute;g szerint min&eacute;l kisebb tartom&aacute;nyt adj meg, hogy ne legyen t&uacute;l nagy az adatb&aacute;zis m&eacute;rete, illetve ha t&uacute;l nagy tartom&aacute;nyt adsz meg, el&otilde;fordulhat, hogy v&eacute;tlen felhaszn&aacute;l&oacute;k sem fogj&aacute;k tudni haszn&aacute;lni a f&oacute;rumot. Ha musz&aacute;j tartom&aacute;nyt megadni, akkor lehet&otilde;leg min&eacute;l kisebbet adj meg, de jobb, ha csak az IP-c&iacute;meket hat&aacute;rozol meg.';

$lang['Select_username'] = 'Felhaszn&aacute;l&oacute;n&eacute;v kiv&aacute;laszt&aacute;sa';
$lang['Select_ip'] = 'IP-c&iacute;m kiv&aacute;laszt&aacute;sa';
$lang['Select_email'] = 'Email-c&iacute;m kiv&aacute;laszt&aacute;sa';

$lang['Ban_username'] = 'Felhaszn&aacute;l&oacute; kitilt&aacute;sa';
$lang['Ban_username_explain'] = 'A haszn&aacute;lt oper&aacute;ci&oacute;s rendszert&otilde;l &eacute;s b&ouml;ng&eacute;sz&otilde;t&otilde;l f&uuml;gg&otilde;en egyszerre t&ouml;bb felhaszn&aacute;l&oacute;t is ki lehet tiltani (kijel&ouml;l&eacute;ssel, a CTRL &eacute;s a SHIFT gomb haszn&aacute;lat&aacute;val).';

$lang['Ban_IP'] = 'IP-c&iacute;m, vagy hosztn&eacute;v letilt&aacute;sa';
$lang['IP_hostname'] = 'IP-c&iacute;mek vagy hosztnevek';
$lang['Ban_IP_explain'] = 'T&ouml;bb IP-c&iacute;m, vagy hosztn&eacute;v megad&aacute;s&aacute;hoz vessz&otilde;vel v&aacute;laszd el &otilde;ket. IP-tartom&aacute;ny megad&aacute;s&aacute;hoz az els&otilde; &eacute;s az utols&oacute; sz&aacute;m el&eacute; tegy&eacute;l egy k&ouml;t&otilde;jelet. Jokerkaraktert (*) is haszn&aacute;lhatsz.';

$lang['Ban_email'] = 'Email-c&iacute;m letilt&aacute;sa';
$lang['Ban_email_explain'] = 'T&ouml;bb email-c&iacute;m kitilt&aacute;s&aacute;hoz vessz&otilde;vel v&aacute;laszd el a c&iacute;meket. Jokerkaraktert (*) is haszn&aacute;lhatsz, pld. *@hotmail.com';

$lang['Unban_username'] = 'Felhaszn&aacute;l&oacute;(k) enged&eacute;lyez&eacute;se';
$lang['Unban_username_explain'] = 'A haszn&aacute;lt oper&aacute;ci&oacute;s rendszert&otilde;l &eacute;s b&ouml;ng&eacute;sz&otilde;t&otilde;l f&uuml;gg&otilde;en egyszerre t&ouml;bb felhaszn&aacute;l&oacute;t is lehet &uacute;jraenged&eacute;lyezni (kijel&ouml;l&eacute;ssel, a CTRL &eacute;s a SHIFT gomb haszn&aacute;lat&aacute;val).';

$lang['Unban_IP'] = 'IP-c&iacute;m(ek) vagy hosztn&eacute;v(ek) enged&eacute;lyez&eacute;se';
$lang['Unban_IP_explain'] = 'A haszn&aacute;lt oper&aacute;ci&oacute;s rendszert&otilde;l &eacute;s b&ouml;ng&eacute;sz&otilde;t&otilde;l f&uuml;gg&otilde;en egyszerre t&ouml;bb IP-c&iacute;met is lehet enged&eacute;lyezni (kijel&ouml;l&eacute;ssel, a CTRL &eacute;s a SHIFT gomb haszn&aacute;lat&aacute;val).';

$lang['Unban_email'] = 'Email-c&iacute;m(ek) enged&eacute;lyez&eacute;se';
$lang['Unban_email_explain'] = 'A haszn&aacute;lt oper&aacute;ci&oacute;s rendszert&otilde;l &eacute;s b&ouml;ng&eacute;sz&otilde;t&otilde;l f&uuml;gg&otilde;en egyszerre t&ouml;bb email-c&iacute;met is lehet enged&eacute;lyezni (kijel&ouml;l&eacute;ssel, a CTRL &eacute;s a SHIFT gomb haszn&aacute;lat&aacute;val).';

$lang['No_banned_users'] = 'Nincsen kitiltott felhaszn&aacute;l&oacute;.';
$lang['No_banned_ip'] = 'Nincsen letiltott IP-c&iacute;m';
$lang['No_banned_email'] = 'Nincsen letiltott email-c&iacute;m';

$lang['Ban_update_sucessful'] = 'A kitilt&aacute;sok list&aacute;ja sikeresen megv&aacute;ltozott!';
$lang['Click_return_banadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a Kitilt&aacute;s be&aacute;ll&iacute;t&aacute;saihoz.';


//
// Configuration
//
$lang['General_Config'] = '&Aacute;ltal&aacute;nos be&aacute;ll&iacute;t&aacute;sok';
$lang['Config_explain'] = 'A F&oacute;rum alapvet&otilde; be&aacute;ll&iacute;t&aacute;sait adhatod meg itt.';

$lang['Click_return_config'] = 'Kattints %side%s, hogy visszat&eacute;rj az &Aacute;ltal&aacute;nos be&aacute;ll&iacute;t&aacute;sokhoz';

$lang['General_settings'] = '&Aacute;ltal&aacute;nos be&aacute;ll&iacute;t&aacute;sok';
$lang['Server_name'] = 'Domain n&eacute;v:';
$lang['Server_name_explain'] = 'A domain n&eacute;v, melyen a F&oacute;rum fut';
$lang['Script_path'] = 'F&oacute;rum el&eacute;r&eacute;si &uacute;tvonal:';
$lang['Script_path_explain'] = 'A phpBB relat&iacute;v el&eacute;r&eacute;si &uacute;tvonala, a domain n&eacute;vhez k&eacute;pest';
$lang['Server_port'] = 'Szerver port:';
$lang['Server_port_explain'] = 'A haszn&aacute;lt port, szinte mindig a 80-as.';
$lang['Site_name'] = 'Oldal neve:';
$lang['Site_desc'] = 'Oldal le&iacute;r&aacute;sa:';
$lang['Board_disable'] = 'F&oacute;rum kikapcsol&aacute;sa:';
$lang['Board_disable_explain'] = 'Ha igenre &aacute;ll&iacute;tod, a felhaszn&aacute;l&oacute;k nem &eacute;rhetik el a f&oacute;rumot. Az Adminsztr&aacute;torok ett&otilde;l f&uuml;ggetlen&uuml;l bel&eacute;phetnek az Adminisztr&aacute;ci&oacute;s panelbe.';
$lang['Acct_activation'] = 'Azonos&iacute;t&oacute; aktiv&aacute;l&aacute;sa:';
$lang['Acc_None'] = 'Nincs'; // These three entries are the type of activation
$lang['Acc_User'] = 'Felhaszn&aacute;l&oacute;i';
$lang['Acc_Admin'] = 'Adminisztr&aacute;tori';

$lang['Abilities_settings'] = 'Felhaszn&aacute;l&oacute; &eacute;s f&oacute;rum be&aacute;ll&iacute;t&aacute;sok';
$lang['Max_poll_options'] = 'V&aacute;laszt&aacute;si lehet&otilde;s&eacute;gek maxim&aacute;lis sz&aacute;ma a szavaz&aacute;sokban:';
$lang['Flood_Interval'] = 'Flood id&otilde;k&ouml;z:';
$lang['Flood_Interval_explain'] = 'Ennyi m&aacute;sodpercet kell v&aacute;rni a k&eacute;t hozz&aacute;sz&oacute;l&aacute;s elk&uuml;ld&eacute;se k&ouml;z&ouml;tt.';
$lang['Board_email_form'] = 'Felhaszn&aacute;l&oacute;i levelez&eacute;s enged&eacute;lyez&eacute;se az oldalon kereszt&uuml;l:';
$lang['Board_email_form_explain'] = 'A felhaszn&aacute;l&oacute;k email &uuml;zeneteket k&uuml;ldhetnek egym&aacute;snak az oldalon kereszt&uuml;l.';
$lang['Topics_per_page'] = 'T&eacute;m&aacute;k oldalak&eacute;nt:';
$lang['Posts_per_page'] = 'Hozz&aacute;sz&oacute;l&aacute;sok oldalank&eacute;nt:';
$lang['Hot_threshold'] = 'Hozz&aacute;sz&oacute;l&aacute;sok sz&aacute;ma t&eacute;ma n&eacute;pszer&ucirc;k&eacute;nt megjel&ouml;l&eacute;s&eacute;hez:';
$lang['Default_style'] = 'Kezd&otilde;sablon:';
$lang['Override_style'] = 'Felhaszn&aacute;l&oacute; sablonj&aacute;nak fel&uuml;l&iacute;r&aacute;sa:';
$lang['Override_style_explain'] = 'Ez esetben mindenki csak a kezd&otilde;sablont haszn&aacute;lhatja.';
$lang['Default_language'] = 'Alapbe&aacute;ll&iacute;t&aacute;s&uacute; nyelv:';
$lang['Date_format'] = 'D&aacute;tum form&aacute;tum:';
$lang['System_timezone'] = 'Rendszer id&otilde;z&oacute;na:';
$lang['Enable_gzip'] = 'GZIP t&ouml;m&ouml;r&iacute;t&eacute;s bekapcsol&aacute;sa:';
$lang['Enable_prune'] = 'Automatikus karbantart&aacute;s bekapcsol&aacute;sa:';
$lang['Allow_HTML'] = 'HTML enged&eacute;lyez&eacute;se:';
$lang['Allow_BBCode'] = 'BBCode enged&eacute;lyez&eacute;se:';
$lang['Allowed_tags'] = 'Enged&eacute;lyezett HTML tagek:';
$lang['Allowed_tags_explain'] = 'A tageket vessz&otilde;vel kell elv&aacute;lasztani.';
$lang['Allow_smilies'] = 'Emotikonok enged&eacute;lyez&eacute;se:';
$lang['Smilies_path'] = 'Emotikonok el&eacute;r&eacute;si &uacute;tvonala:';
$lang['Smilies_path_explain'] = 'A phpBB-n bel&uuml;li el&eacute;r&eacute;si &uacute;t, &aacute;ltal&aacute;ban: images/smiles';
$lang['Allow_sig'] = 'Al&aacute;&iacute;r&aacute;s enged&eacute;lyez&eacute;se:';
$lang['Max_sig_length'] = 'Al&aacute;&iacute;r&aacute;s maximum hossza:';
$lang['Max_sig_length_explain'] = 'Az al&aacute;&iacute;r&aacute;sok maximum hossza karakterben';
$lang['Allow_name_change'] = 'Felhaszn&aacute;l&oacute;n&eacute;v-v&aacute;lt&aacute;s enged&eacute;lyez&eacute;se:';

$lang['Avatar_settings'] = 'Avatar be&aacute;ll&iacute;t&aacute;sok';
$lang['Allow_local'] = 'Avatar gal&eacute;ria bekapcsol&aacute;sa:';
$lang['Allow_remote'] = 'T&aacute;voli avatar enged&eacute;lyez&eacute;se:';
$lang['Allow_remote_explain'] = 'M&aacute;s weboldalr&oacute;l belinkelt avatarok enged&eacute;lyez&eacute;se';
$lang['Allow_upload'] = 'Avatar felt&ouml;lt&eacute;s enged&eacute;lyez&eacute;se:';
$lang['Max_filesize'] = 'Maximum avatar k&eacute;pm&eacute;ret:';
$lang['Max_filesize_explain'] = 'A felt&ouml;lt&ouml;tt avatar k&eacute;pek legfeljebb ilyen nagys&aacute;g&uacute;ak lehetnek.';
$lang['Max_avatar_size'] = 'Maximum avatar felbont&aacute;s:';
$lang['Max_avatar_size_explain'] = 'Sz&eacute;less&eacute;g x Magass&aacute;g pixelben';
$lang['Avatar_storage_path'] = 'Avatarok el&eacute;r&eacute;si &uacute;tvonala:';
$lang['Avatar_storage_path_explain'] = 'A phpBB-n bel&uuml;li el&eacute;r&eacute;si &uacute;t, &aacute;ltal&aacute;ban: images/avatars';
$lang['Avatar_gallery_path'] = 'Avatar gal&eacute;ria helye:';
$lang['Avatar_gallery_path_explain'] = 'A phpBB-n bel&uuml;li el&eacute;r&eacute;si &uacute;t, &aacute;ltal&aacute;ban: images/avatars/gallery';

$lang['COPPA_settings'] = 'COPPA be&aacute;ll&iacute;t&aacute;sok';
$lang['COPPA_fax'] = 'COPPA fax-sz&aacute;m:';
$lang['COPPA_mail'] = 'COPPA levelez&eacute;si c&iacute;m:';
$lang['COPPA_mail_explain'] = 'Az a lev&eacute;lc&iacute;m, ahova a sz&uuml;l&otilde;knek a COPPA regisztr&aacute;ci&oacute;s k&eacute;relmeket kell k&uuml;ldeni&uuml;k.<br />A COPPA-t az Amerikai Egyes&uuml;lt &Aacute;llamokban haszn&aacute;lj&aacute;k. L&eacute;nyege, hogy csak a sz&uuml;l&otilde; enged&eacute;ly&eacute;vel regisztr&aacute;lhat a F&oacute;rumon a 13 &eacute;ven aluli gyerek (a sz&uuml;l&otilde;nek j&oacute;v&aacute; kell hagynia gyermeke regisztr&aacute;ci&oacute;j&aacute;t a megadott c&iacute;mre vagy fax-sz&aacute;mra k&uuml;ld&ouml;tt nyilatkozattal).';

$lang['Email_settings'] = 'Email be&aacute;ll&iacute;t&aacute;sok';
$lang['Admin_email'] = 'Az Adminisztr&aacute;tor email-c&iacute;me:';
$lang['Email_sig'] = 'Email al&aacute;&iacute;r&aacute;s:';
$lang['Email_sig_explain'] = 'A f&oacute;rum &aacute;ltal kik&uuml;ld&ouml;tt levelek v&eacute;g&eacute;hez csatolt sz&ouml;veg';
$lang['Use_SMTP'] = 'SMTP szerver haszn&aacute;lata emailk&uuml;ld&eacute;shez:';
$lang['Use_SMTP_explain'] = 'Kapcsold be, ha egy k&uuml;ls&otilde; email-szervert akarsz haszn&aacute;lni.';
$lang['SMTP_server'] = 'SMTP szerver c&iacute;me:';
$lang['SMTP_username'] = 'SMTP felhaszn&aacute;l&oacute;n&eacute;v:';
$lang['SMTP_username_explain'] = 'Csak akkor t&ouml;ltsd ki, ha sz&uuml;ks&eacute;ges.';
$lang['SMTP_password'] = 'SMTP jelsz&oacute;:';
$lang['SMTP_password_explain'] = 'Csak akkor t&ouml;ltsd ki, ha sz&uuml;ks&eacute;ges.';

$lang['Disable_privmsg'] = 'Priv&aacute;t &uuml;zenetk&uuml;ld&eacute;s:';
$lang['Inbox_limits'] = '&Uuml;zenetek maxim&aacute;lis sz&aacute;ma az &Eacute;rkezett fi&oacute;kban:';
$lang['Sentbox_limits'] = '&Uuml;zenetek maxim&aacute;lis sz&aacute;ma az Elk&uuml;ld&ouml;tt fi&oacute;kban:';
$lang['Savebox_limits'] = '&Uuml;zenetek maxim&aacute;lis sz&aacute;ma az Ment&eacute;s fi&oacute;kban:';

$lang['Cookie_settings'] = 'Cookie be&aacute;ll&iacute;t&aacute;sok';
$lang['Cookie_settings_explain'] = 'Itt &aacute;ll&iacute;thatod be a felhaszn&aacute;l&oacute;k b&ouml;ng&eacute;sz&otilde;inek kik&uuml;ld&ouml;tt cookie-kat. A legt&ouml;bb esetben elegend&otilde;ek az alapbe&aacute;ll&iacute;t&aacute;sok, &iacute;gy csak &oacute;vatosan v&aacute;ltoztass rajtuk, mert el&otilde;fordulhat, hogy a felhaszn&aacute;l&oacute;k nem fognak tudni bel&eacute;pni';
$lang['Cookie_domain'] = 'Cookie domain:';
$lang['Cookie_name'] = 'Cookie neve:';
$lang['Cookie_path'] = 'Cookie el&eacute;r&eacute;si &uacute;t:';
$lang['Cookie_secure'] = 'Cookie titkos&iacute;t&aacute;sa:';
$lang['Cookie_secure_explain'] = 'Ha a szerver SSL titkos&iacute;t&aacute;ssal fut, akkor kapcsold be ezt az opci&oacute;t, k&uuml;l&ouml;nben hagyd kikapcsolva.';
$lang['Session_length'] = 'Session hossz [ m&aacute;sodperc ]:';

// Visual Confirmation
$lang['Visual_confirm'] = 'Regisztr&aacute;ci&oacute; vizu&aacute;lis meger&otilde;s&iacute;t&eacute;se:';
$lang['Visual_confirm_explain'] = 'A regisztr&aacute;ci&oacute;n&aacute;l a felhaszn&aacute;l&oacute;nak be kell &iacute;rnia egy automatikusan gener&aacute;lt vizu&aacute;lis k&oacute;dot, amivel megeros&iacute;ti a regisztr&aacute;ci&oacute;t (robotok regisztr&aacute;ci&oacute;ja ellen).';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Automatikus bejelentkez&eacute;s enged&eacute;lyez&eacute;se:';
$lang['Allow_autologin_explain'] = 'A felhaszn&aacute;l&oacute;k kiv&aacute;laszthatj&aacute;k-e, hogy automatikusan bejelentkeztesse &otilde;ket a rendszer a f&oacute;rum megl&aacute;togat&aacute;skor.';
$lang['Autologin_time'] = 'Automatkus bejelentkez&eacute;s lej&aacute;rata:';
$lang['Autologin_time_explain'] = 'H&aacute;ny napig &eacute;rv&eacute;nyes az automatikus bejelentkez&eacute;shez sz&uuml;ks&eacute;ges kulcs, ha a felhaszn&aacute;l&oacute; nem l&aacute;togatja meg a f&oacute;rumot. &Aacute;ll&iacute;tsd 0-ra, hogy soha ne j&aacute;rjon le.';

// Search Flood Control - added 2.0.20 
$lang['Search_Flood_Interval'] = 'Keres&eacute;s flood id&otilde;k&ouml;z'; 
$lang['Search_Flood_Interval_explain'] = 'Ennyi m&aacute;sodpercet kell v&aacute;rni a k&eacute;t keres&eacute;s k&ouml;z&ouml;tt.';

//
// Forum Management
//
$lang['Forum_admin'] = 'F&oacute;rum adminisztr&aacute;ci&oacute;';
$lang['Forum_admin_explain'] = 'Innen tudsz &uacute;j f&oacute;rumot nyitni, t&ouml;r&ouml;lni, szerkeszteni, &aacute;trendezni, kategoriz&aacute;lni &eacute;s szinkroniz&aacute;lni.';
$lang['Edit_forum'] = 'F&oacute;rum szerkeszt&eacute;se';
$lang['Create_forum'] = '&Uacute;j f&oacute;rum';
$lang['Create_category'] = '&Uacute;j t&eacute;mak&ouml;r';
$lang['Remove'] = 'Elt&aacute;vol&iacute;t';
$lang['Action'] = 'Utas&iacute;t&aacute;s';
$lang['Update_order'] = 'Friss&iacute;t&eacute;si sorrend';
$lang['Config_updated'] = 'A F&oacute;rum be&aacute;ll&iacute;t&aacute;sai sikeresen friss&uuml;ltek!';
$lang['Edit'] = 'Szerkeszt';
$lang['Delete'] = 'T&ouml;r&ouml;l';
$lang['Move_up'] = 'Feljebb';
$lang['Move_down'] = 'Lejjebb';
$lang['Resync'] = 'Szinkroniz&aacute;l';
$lang['No_mode'] = 'Nem lett m&oacute;d kiv&aacute;lasztva!';
$lang['Forum_edit_delete_explain'] = 'Az al&aacute;bbi oldallal be&aacute;ll&iacute;thatod a f&oacute;rum legfontosabb tulajdons&aacute;gait. A F&oacute;rum &eacute;s a Felhaszn&aacute;l&oacute;k be&aacute;ll&iacute;t&aacute;s&aacute;hoz haszn&aacute;ld a baloldali men&uuml;t.';

$lang['Move_contents'] = '&Ouml;sszes tartalom &aacute;tmozgat&aacute;sa';
$lang['Forum_delete'] = 'F&oacute;rum t&ouml;rl&eacute;se';
$lang['Forum_delete_explain'] = 'Az al&aacute;bbi oldal seg&iacute;ts&eacute;g&eacute;vel t&ouml;r&ouml;lhetsz egy f&oacute;rumot, (vagy kateg&oacute;ri&aacute;t), megadva, hogy a tartalmazott f&oacute;rumok (vagy t&eacute;m&aacute;k) hova ker&uuml;ljenek &aacute;t.';

$lang['Status_locked'] = 'Lez&aacute;rt';
$lang['Status_unlocked'] = 'Nyitott';
$lang['Forum_settings'] = '&Aacute;ltal&aacute;nos f&oacute;rum be&aacute;ll&iacute;t&aacute;sok';
$lang['Forum_name'] = 'F&oacute;rum neve';
$lang['Forum_desc'] = 'Le&iacute;r&aacute;s';
$lang['Forum_status'] = 'F&oacute;rum st&aacute;tusz';
$lang['Forum_pruning'] = 'Automatikus karbantart&aacute;s';

$lang['prune_freq'] = 'T&eacute;m&aacute;k ellen&otilde;rz&eacute;se (ennyi naponta):';
$lang['prune_days'] = 'T&eacute;m&aacute;k t&ouml;rl&eacute;se, melyekbe ennyi napig nem &eacute;rkezett hozz&aacute;sz&oacute;l&aacute;s:';
$lang['Set_prune_data'] = 'Az automatikus karbantart&aacute;s be van kapcsolva, de ehhez a f&oacute;rumhoz nincsen megadva a karbantart&aacute;s gyakoris&aacute;ga. L&eacute;pj vissza, &eacute;s &aacute;ll&iacute;tsd be.';

$lang['Move_and_Delete'] = '&Aacute;tmozgat&aacute;s &eacute;s t&ouml;rl&eacute;s';

$lang['Delete_all_posts'] = '&Ouml;sszes hozz&aacute;sz&oacute;l&aacute;s t&ouml;rl&eacute;se';
$lang['Nowhere_to_move'] = 'Sehova sem lehet &aacute;thelyezni.';

$lang['Edit_Category'] = 'T&eacute;mak&ouml;r szerkeszt&eacute;se';
$lang['Edit_Category_explain'] = 'Ezzel a t&eacute;mak&ouml;r nev&eacute;t v&aacute;ltoztathatod meg.';

$lang['Forums_updated'] = 'A f&oacute;rum &eacute;s t&eacute;mak&ouml;r be&aacute;ll&iacute;t&aacute;sai sikeresen friss&uuml;ltek!';

$lang['Must_delete_forums'] = 'El&otilde;bb az &ouml;sszes f&oacute;rumot t&ouml;r&ouml;ln&ouml;d kell, hogy t&ouml;r&ouml;lhesd ezt a kateg&oacute;ri&aacute;t.';

$lang['Click_return_forumadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a F&oacute;rum be&aacute;ll&iacute;t&aacute;saihoz.';


//
// Smiley Management
//
$lang['smiley_title'] = 'Emotikon be&aacute;ll&iacute;t&aacute;sok';
$lang['smile_desc'] = 'Ezen az oldalon adhatsz &uacute;j emotikonokat a f&oacute;rumhoz, illetve szerkesztheted &eacute;s t&ouml;r&ouml;lheted a m&aacute;r megl&eacute;v&otilde;ket. Ha a "T&ouml;rl&eacute;s" gombra kattintasz, akkor automatikusan t&ouml;r&ouml;lni fogja, nem k&eacute;r meger&otilde;s&iacute;t&eacute;st.';

$lang['smiley_config'] = 'Emotikon be&aacute;ll&iacute;t&aacute;sa';
$lang['smiley_code'] = 'Emotikon k&oacute;d:';
$lang['smiley_url'] = 'Emotikon k&eacute;pf&aacute;jl:';
$lang['smiley_emot'] = 'Jelent&eacute;s:';
$lang['smile_add'] = '&Uacute;j emotikon hozz&aacute;ad&aacute;sa';
$lang['Smile'] = 'Smiley';
$lang['Emotion'] = 'Emotikon';

$lang['Select_pak'] = 'Emotikon csomagf&aacute;jl (.pak) kiv&aacute;laszt&aacute;sa';
$lang['replace_existing'] = 'Jelenlegi emotikonok fel&uuml;l&iacute;r&aacute;sa';
$lang['keep_existing'] = 'Jelenlegi emotikonok megtart&aacute;sa';
$lang['smiley_import_inst'] = 'T&ouml;ltsd fel az emotikonok k&ouml;nyvt&aacute;r&aacute;ba a k&eacute;peket, &eacute;s az export&aacute;l&aacute;sn&aacute;l elk&eacute;sz&iacute;tett *.pak f&aacute;jlt. Ut&aacute;na a megfelel&otilde; adatok megad&aacute;s&aacute;val import&aacute;lhat&oacute; az emotikon csomag.';
$lang['smiley_import'] = 'Emotikonok import&aacute;l&aacute;sa';
$lang['choose_smile_pak'] = 'Emotikon csomag kiv&aacute;laszt&aacute;sa (.pak f&aacute;jl)';
$lang['import'] = 'Emotikonok import&aacute;l&aacute;sa';
$lang['smile_conflicts'] = 'Aktu&aacute;lis emotikonok:';
$lang['del_existing_smileys'] = 'Telep&iacute;tett emotikonok t&ouml;rl&eacute;se import&aacute;l&aacute;s el&otilde;tt';
$lang['import_smile_pack'] = 'Emotikon csomag import&aacute;l&aacute;sa';
$lang['export_smile_pack'] = 'Emotikon csomag export&aacute;l&aacute;sa';
$lang['export_smiles'] = 'Az emotikon csomag export&aacute;l&aacute;s&aacute;hoz kattints %sIDE%s, hogy let&ouml;ltsd a smiles.pak f&aacute;jlt. Ha &aacute;t akarod nevezni, akkor figyelj arra, hogy a .pak kiterjeszt&eacute;s megmaradjon. Ut&aacute;na a .pak f&aacute;jlt &eacute;s az emotikon k&eacute;peket t&ouml;m&ouml;r&iacute;tsd be egy f&aacute;jlba.';

$lang['smiley_add_success'] = 'Az emotikon sikeresen beker&uuml;lt a list&aacute;ba!';
$lang['smiley_edit_success'] = 'Az emotikon be&aacute;ll&iacute;t&aacute;sai sikeresen megv&aacute;ltoztak!';
$lang['smiley_import_success'] = 'Az emotikon csomag import&aacute;l&aacute;sa sikeres volt!';
$lang['smiley_del_success'] = 'Az emotikon elt&aacute;vol&iacute;t&aacute;sa sikeres volt!';
$lang['Click_return_smileadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj az emotikonok be&aacute;ll&iacute;t&aacute;saihoz';

$lang['Confirm_delete_smiley'] = 'Biztosan t&ouml;r&ouml;lni akarod ezt az emotikont?';

//
// User Management
//
$lang['User_admin'] = 'Felhaszn&aacute;l&oacute;i be&aacute;ll&iacute;t&aacute;sok';
$lang['User_admin_explain'] = 'Ezen az oldalon megadhatod, megv&aacute;ltoztathatod a felhaszn&aacute;l&oacute;k adatait, &eacute;s n&eacute;h&aacute;ny &aacute;ltal&aacute;nos tulajdons&aacute;got &aacute;ll&iacute;thatsz be. A jogosults&aacute;gok kioszt&aacute;s&aacute;hoz haszn&aacute;ld az egy&eacute;ni- &eacute;s csoportjogosults&aacute;g-kezel&otilde; rendszert.';

$lang['Look_up_user'] = 'Felhaszn&aacute;l&oacute; keres&eacute;se';

$lang['Admin_user_fail'] = 'A felhaszn&aacute;l&oacute; profilj&aacute;nak friss&iacute;t&eacute;se sikertelen volt.';
$lang['Admin_user_updated'] = 'A felhaszn&aacute;l&oacute; profilja sikeresen m&oacute;dosult!';
$lang['Click_return_useradmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a Felhaszn&aacute;l&oacute; be&aacute;ll&iacute;t&aacute;sokhoz';

$lang['User_delete'] = 'Felhaszn&aacute;l&oacute; t&ouml;rl&eacute;se';
$lang['User_delete_explain'] = 'Jel&ouml;ld be, ha t&ouml;r&ouml;lni akarod a felhaszn&aacute;l&oacute;t. A t&ouml;rl&eacute;s ut&aacute;n nem lehet visszahozni!';
$lang['User_deleted'] = 'A felhaszn&aacute;l&oacute; sikeresen t&ouml;r&ouml;lve lett.';

$lang['User_status'] = 'Akt&iacute;v felhaszn&aacute;l&oacute;';
$lang['User_allowpm'] = 'K&uuml;ldhet priv&aacute;t &uuml;zenetet';
$lang['User_allowavatar'] = 'Be&aacute;ll&iacute;that avatart';

$lang['Admin_avatar_explain'] = 'Itt n&eacute;zheted meg, &eacute;s t&ouml;r&ouml;lheted a felhaszn&aacute;l&oacute; avatarj&aacute;t.';

$lang['User_special'] = 'Speci&aacute;lis be&aacute;l&iacute;lt&aacute;sok';
$lang['User_special_explain'] = 'A felhaszn&aacute;l&oacute;k nem m&oacute;dos&iacute;thatj&aacute;k ezeket a mez&otilde;ket.';


//
// Group Management
//
$lang['Group_administration'] = 'Csoportok be&aacute;ll&iacute;t&aacute;sa';
$lang['Group_admin_explain'] = 'Ezzel az oldallal kezelni tudod a Csoportokat, t&ouml;r&ouml;lheted, m&oacute;dos&iacute;thatod &otilde;ket, &eacute;s &uacute;jakat k&eacute;sz&iacute;thetsz. V&aacute;laszhatsz moder&aacute;tort a csoporthoz, megadhatod, hogy ny&iacute;lt vagy z&aacute;rt csoport legyen-e, megadhatod a csoport nev&eacute;t &eacute;s le&iacute;r&aacute;s&aacute;t.';
$lang['Error_updating_groups'] = 'A friss&iacute;t&eacute;s k&ouml;zben hiba t&ouml;rt&eacute;nt.';
$lang['Updated_group'] = 'A csoport sikeresen friss&uuml;lt!';
$lang['Added_new_group'] = 'A csoport sikeresen elk&eacute;sz&uuml;lt!';
$lang['Deleted_group'] = 'A csoport sikeresen t&ouml;r&ouml;lve lett!';
$lang['New_group'] = '&Uacute;j csoport';
$lang['Edit_group'] = 'Csoport szerkeszt&eacute;se';
$lang['group_name'] = 'Csoport neve';
$lang['group_description'] = 'Csoport le&iacute;r&aacute;sa';
$lang['group_moderator'] = 'Csoport moder&aacute;tor';
$lang['group_status'] = 'Csoport st&aacute;tusz';
$lang['group_open'] = 'Nyitott csoport';
$lang['group_closed'] = 'Z&aacute;rt csoport';
$lang['group_hidden'] = 'Rejtett csoport';
$lang['group_delete'] = 'Csoport t&ouml;rl&eacute;se';
$lang['group_delete_check'] = 'Csoport t&ouml;rl&eacute;se';
$lang['submit_group_changes'] = 'V&aacute;ltoz&aacute;sok elk&uuml;ld&eacute;se';
$lang['reset_group_changes'] = 'V&aacute;ltoz&aacute;sok t&ouml;rl&eacute;se';
$lang['No_group_name'] = 'Meg kell adnod egy csoportnevet.';
$lang['No_group_moderator'] = 'Adj meg egy Moder&aacute;tort a csoportnak!';
$lang['No_group_mode'] = 'Meg kell hat&aacute;roznod, hogy nyitott vagy z&aacute;rt csoport legyen-e.';
$lang['No_group_action'] = 'Nem hat&aacute;rozt&aacute;l meg utas&iacute;t&aacute;st.';
$lang['delete_group_moderator'] = 'R&eacute;gi moder&aacute;tor t&ouml;rl&eacute;se?';
$lang['delete_moderator_explain'] = 'Ha meg akarod v&aacute;ltoztatni a csoport moder&aacute;tor&aacute;t, &eacute;s t&ouml;r&ouml;lni akarod a r&eacute;git, akkor jel&ouml;ld be. Ha nem jel&ouml;l&ouml;d be, akkor a felhaszn&aacute;l&oacute; sima tag lesz a csoportban.';
$lang['Click_return_groupsadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a Csoportok be&aacute;ll&iacute;t&aacute;saihoz.';
$lang['Select_group'] = 'Csoport kiv&aacute;laszt&aacute;sa';
$lang['Look_up_group'] = 'Csoport keres&eacute;se';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'F&oacute;rum karbantart&aacute;s';
$lang['Forum_Prune_explain'] = 'A F&oacute;rum karbantart&aacute;s minden olyan t&eacute;m&aacute;t automatikusan t&ouml;r&ouml;l, ahova a megadott id&otilde;n bel&uuml;l nem &eacute;rkezik hozz&aacute;sz&oacute;l&aacute;s. Ha nem adsz meg id&otilde;t. akkor az &ouml;sszes t&eacute;ma t&ouml;rl&otilde;dik. Ezzel nem lehet t&ouml;r&ouml;lni azokat a t&eacute;m&aacute;kat, ahol akt&iacute;v szavaz&aacute;s van &eacute;rv&eacute;nyben, vagy azokat, melyek a kiemelt k&ouml;zlem&eacute;nyek kateg&oacute;ri&aacute;ba tartoznak. Ezeket k&eacute;zzel kell t&ouml;r&ouml;ln&ouml;d.';
$lang['Do_Prune'] = 'Karbantart&aacute;s ind&iacute;t&aacute;sa';
$lang['All_Forums'] = '&Ouml;sszes f&oacute;rum';
$lang['Prune_topics_not_posted'] = 'T&eacute;m&aacute;k karbantart&aacute;sa, ahova ennyi ideig nem &eacute;rkezett &uacute;j hozz&aacute;sz&oacute;l&aacute;s.';
$lang['Topics_pruned'] = 'A t&eacute;m&aacute;k karbantart&aacute;sa befejez&otilde;dtt.';
$lang['Posts_pruned'] = 'A hozz&aacute;sz&oacute;l&aacute;sok karbantart&aacute;sa befejez&otilde;dtt.';
$lang['Prune_success'] = 'A F&oacute;rum karbantart&aacute;sa sikeresen befejez&otilde;d&ouml;tt!';


//
// Word censor
//
$lang['Words_title'] = 'Cenz&uacute;ra';
$lang['Words_explain'] = 'Ezzel az oldallal olyan szavakat adhatsz meg (szerkeszthetsz, vehetsz el), melyeket automatikusan cenz&uacute;r&aacute;z a f&oacute;rum. Ezekkel a szavakkal (vagy ilyen szavakat tartalmaz&oacute; szavakkal) nem regisztr&aacute;lhatnak &uacute;j fehaszn&aacute;l&oacute;t. A * jokerkarakter haszn&aacute;lhat&oacute;, pld. az *lap*-ra az alaplap sz&oacute; is cenz&uacute;r&aacute;zva lesz, a lap*-ra a lapsz&aacute;m, &eacute;s a *lap-ra a f&otilde;lap szavak is.';
$lang['Word'] = 'Sz&oacute;';
$lang['Edit_word_censor'] = 'Cenz&uacute;r&aacute;z&aacute;si szab&aacute;ly szerkeszt&eacute;se';
$lang['Replacement'] = 'Helyettes';
$lang['Add_new_word'] = '&Uacute;j sz&oacute; hozz&aacute;ad&aacute;sa';
$lang['Update_word'] = 'Cenz&uacute;r&aacute;z&aacute;si szab&aacute;ly friss&iacute;t&eacute;se';

$lang['Must_enter_word'] = 'Meg kell adnod egy szavat &eacute;s a helyettes&iacute;t&eacute;s&eacute;t.';
$lang['No_word_selected'] = 'Nem v&aacute;lasztott&aacute;l ki sz&oacute;t.';

$lang['Word_updated'] = 'A kiv&aacute;laszott cenz&uacute;r&aacute;z&aacute;si szab&aacute;ly sikeresen friss&uuml;lt!';
$lang['Word_added'] = 'Cenz&uacute;r&aacute;z&aacute;si szab&aacute;ly sikeresen felv&eacute;ve!';
$lang['Word_removed'] = 'A kiv&aacute;lasztott cenz&uacute;r&aacute;z&aacute;si szab&aacute;ly sikeresen t&ouml;r&ouml;lve lett!';

$lang['Click_return_wordadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a Cenz&uacute;ra be&aacute;ll&iacute;t&aacute;saihoz.';

$lang['Confirm_delete_word'] = 'Biztosan t&ouml;r&ouml;lni akarod ezt a cenz&uacute;r&aacute;z&aacute;si szab&aacute;lyt?';

//
// Mass Email
//
$lang['Mass_email_explain'] = 'A Csoportos lev&eacute;l opci&oacute;val egy emailt k&uuml;ldhetsz minden felhaszn&aacute;l&oacute;nak, vagy egy adott csoport &ouml;sszes felhaszn&aacute;l&oacute;j&aacute;nak. Az email az adminisztr&aacute;tori c&iacute;mre post&aacute;z&oacute;dik, &eacute;s egy titkos m&aacute;solatot kap az &ouml;sszes felhaszn&aacute;l&oacute;. Ha sok emberr&otilde;l van sz&oacute;, akkor a lev&eacute;lk&uuml;ld&eacute;s eltarthat egy darabig, ne szak&iacute;tsd meg a program fut&aacute;s&aacute;t k&ouml;zben. Amint v&eacute;gzett, az oldal &eacute;rtes&iacute;t err&otilde;l.';
$lang['Compose'] = 'Lev&eacute;l&iacute;r&aacute;s';

$lang['Recipients'] = 'C&iacute;mzett';
$lang['All_users'] = '&Ouml;sszes felhaszn&aacute;l&oacute;';

$lang['Email_successfull'] = '&Uuml;zenet elk&uuml;ldve!';
$lang['Click_return_massemail'] = 'Kattints %side%s, hogy visszat&eacute;rj a Csoportos email men&uuml;ponthoz.';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Rangok be&aacute;ll&iacute;t&aacute;sa';
$lang['Ranks_explain'] = 'Itt &aacute;ll&iacute;thatod be a rangokat; hozz&aacute;ad&aacute;s, szerkeszt&eacute;s, megtekint&eacute;s &eacute;s t&ouml;rl&eacute;s. Ezenk&iacute;v&uuml;l saj&aacute;t rangsort is k&eacute;sz&iacute;thetsz, melyeket a felhaszn&aacute;l&oacute;k be&aacute;ll&iacute;t&aacute;s&aacute;n&aacute;l hozz&aacute;rendelhetsz egyes felhaszn&aacute;l&oacute;khoz.';

$lang['Add_new_rank'] = '&Uacute;j rang hozz&aacute;ad&aacute;sa';

$lang['Rank_title'] = 'Rang neve';
$lang['Rank_special'] = 'Speci&aacute;lis rang';
$lang['Rank_minimum'] = 'Minimum hozz&aacute;sz&oacute;l&aacute;sok sz&aacute;ma';
$lang['Rank_maximum'] = 'Maximum hozz&aacute;sz&oacute;l&aacute;sok sz&aacute;ma';
$lang['Rank_image'] = 'Rang k&eacute;p&eacute;nek el&eacute;r&eacute;si &uacute;tvonala (relat&iacute;v el&eacute;r&eacute;si &uacute;t, a phpBB gy&ouml;k&eacute;rk&ouml;nyvt&aacute;r&aacute;t&oacute;l)';
$lang['Rank_image_explain'] = 'A rangot reprezent&aacute;l&oacute; k&eacute;p';

$lang['Must_select_rank'] = 'Ki kell v&aacute;lasztanod egy rangot.';
$lang['No_assigned_rank'] = 'Nincsen speci&aacute;lis rang.';

$lang['Rank_updated'] = 'A rang sikeresen megv&aacute;ltozott!';
$lang['Rank_added'] = 'Rang sikeresen felv&eacute;ve!';
$lang['Rank_removed'] = 'Rang sikeresen t&ouml;r&ouml;lve!';
$lang['No_update_ranks'] = 'A rang sikeresen t&ouml;r&ouml;lve lett, b&aacute;r a felhaszn&aacute;l&oacute;i azonos&iacute;t&oacute;k nem friss&uuml;ltek. Ezt k&eacute;zzel kell megtenned ezeken az azonos&iacute;t&oacute;kon';

$lang['Click_return_rankadmin'] = 'Kattints %side%s hogy vissza&eacute;rj a Rangok be&aacute;ll&iacute;t&aacute;saihoz.';

$lang['Confirm_delete_rank'] = 'Biztosan t&ouml;r&ouml;lni akarod ezt a rangot?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Tiltott felhaszn&aacute;l&oacute;nevek be&aacute;ll&iacute;t&aacute;sa';
$lang['Disallow_explain'] = 'Itt &aacute;ll&iacute;thatod be azokat a felhaszn&aacute;l&oacute;neveket, melyek nem regisztr&aacute;lhat&oacute;ak. Haszn&aacute;lhat&oacute; a * jokerkarakter. Nem adhatsz meg olyan sz&oacute;t, amelyet m&aacute;r haszn&aacute;l valaki, ehhez el&otilde;sz&ouml;r ki kell t&ouml;r&ouml;ln&ouml;d a felhaszn&aacute;l&oacute;t, &eacute;s ut&aacute;na tilthatod le.';

$lang['Delete_disallow'] = 'T&ouml;rl&eacute;s';
$lang['Delete_disallow_title'] = 'Tiltott felhaszn&aacute;l&oacute;n&eacute;v t&ouml;rl&eacute;se:';
$lang['Delete_disallow_explain'] = 'Tiltott felhaszn&aacute;l&oacute;n&eacute;v t&ouml;rl&eacute;se. Jel&ouml;ld ki &eacute;s kattints a T&ouml;rl&eacute;s gombra.';

$lang['Add_disallow'] = 'Hozz&aacute;ad&aacute;s';
$lang['Add_disallow_title'] = 'Tiltott felhaszn&aacute;l&oacute;n&eacute;v hozz&aacute;ad&aacute;sa:';
$lang['Add_disallow_explain'] = 'Haszn&aacute;lhatod a * jokerkaraktert.';

$lang['No_disallowed'] = 'Nincsenek letiltott felhaszn&aacute;l&oacute;nevek.';

$lang['Disallowed_deleted'] = 'A letiltott felhaszn&aacute;l&oacute;nevet t&ouml;r&ouml;ltem!';
$lang['Disallow_successful'] = 'A letiltott felhaszn&aacute;l&oacute;n&eacute;v hozz&aacute;ad&aacute;sa siker&uuml;lt!';
$lang['Disallowed_already'] = 'A be&iacute;rt felhaszn&aacute;l&oacute;nevet nem lehet letiltani; vagy m&aacute;r l&eacute;tezik a list&aacute;ban, vagy l&eacute;tezik a cenz&uacute;r&aacute;zott szavak k&ouml;z&ouml;tt, esetleg van ilyen nev&ucirc; felhaszn&aacute;l&oacute;.';

$lang['Click_return_disallowadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a Tiltott felhaszn&aacute;l&oacute;nevek be&aacute;ll&iacute;t&aacute;saihoz';


//
// Styles Admin
//

$lang['Styles_admin'] = 'St&iacute;lus be&aacute;ll&iacute;t&aacute;sok';
$lang['Styles_explain'] = 'Ezen az oldalon felvehetsz, t&ouml;r&ouml;lhetsz, be&aacute;ll&iacute;thatsz st&iacute;lusokat (sablonokat &eacute;s t&eacute;m&aacute;kat).';
$lang['Styles_addnew_explain'] = 'A k&ouml;vetkez&otilde; lista a m&eacute;g nem telep&iacute;tett t&eacute;m&aacute;kat tartalmazza a jelenlegi sablonaidhoz. A telep&iacute;t&eacute;shez kattints a n&eacute;v melletti "&Uacute;j telep&iacute;t&eacute;s" linkre';

$lang['Select_template'] = 'V&aacute;lassz egy sablont';

$lang['Style'] = 'St&iacute;lus';
$lang['Template'] = 'Sablon';
$lang['Install'] = 'Telep&iacute;t';
$lang['Download'] = 'Let&ouml;lt';

$lang['Edit_theme'] = 'T&eacute;ma szerkeszt&eacute;se';
$lang['Edit_theme_explain'] = 'Az al&aacute;bbi &ucirc;rlap seg&iacute;ts&eacute;g&eacute;vel a kiv&aacute;lasztott t&eacute;ma be&aacute;ll&iacute;t&aacute;sait v&aacute;ltoztathatod meg.';

$lang['Create_theme'] = 'T&eacute;ma k&eacute;sz&iacute;t&eacute;se';
$lang['Create_theme_explain'] = 'Az al&aacute;bbi &ucirc;rlap seg&iacute;ts&eacute;g&eacute;vel &uacute;j t&eacute;m&aacute;kat k&eacute;sz&iacute;thetsz a jelenlegi sablonaidhoz. A sz&iacute;n megad&aacute;s&aacute;n&aacute;l ne haszn&aacute;ld a # karaktert. A CCCCCC helyes, a #CCCCCC hib&aacute;s.';

$lang['Export_themes'] = 'T&eacute;m&aacute;k export&aacute;l&aacute;sa';
$lang['Export_explain'] = 'Ennek az oldalnak a seg&iacute;ts&eacute;g&eacute;vel egy sablonhoz tartoz&oacute; t&eacute;ma adatait export&aacute;lhatod ki. V&aacute;laszd ki a sablont az al&aacute;bbi list&aacute;b&oacute;l, &eacute;s az oldal elk&eacute;sz&iacute;ti a t&eacute;ma konfigur&aacute;ci&oacute;s f&aacute;jlj&aacute;t, &eacute;s megpr&oacute;b&aacute;lja elmenteni a kiv&aacute;lasztott sablon k&ouml;nyvt&aacute;rba. Ha nem lehet elmenteni (nem &iacute;rhat&oacute; a k&ouml;nyvt&aacute;r, ezt a webszerveren tudod be&aacute;ll&iacute;tani), akkor t&ouml;ltsd le, &eacute;s k&eacute;zzel m&aacute;sold be.';

$lang['Theme_installed'] = 'A kiv&aacute;lasztott t&eacute;ma telep&iacute;t&eacute;se sikeresen megt&ouml;rt&eacute;nt.';
$lang['Style_removed'] = 'A kiv&aacute;laszott st&iacute;lus sikeresen t&ouml;r&ouml;lve lett az adatb&aacute;zisb&oacute;l. A teljes t&ouml;rl&eacute;shez a phpBB templates/ k&ouml;nyvt&aacute;r&aacute;b&oacute;l is t&aacute;vol&iacute;tsd el.';
$lang['Theme_info_saved'] = 'A kiv&aacute;lasztott sablonhoz tart&oacute;z&oacute; t&eacute;ma inform&aacute;ci&oacute; sikeresen el lett mentve. V&aacute;ltoztasd meg a theme_info.cfg jogosults&aacute;gait csak olvashat&oacute;ra (aj&aacute;nlott az eg&eacute;sz sablon k&ouml;nyvt&aacute;r&aacute;t is csak olvashat&oacute;ra &aacute;t&aacute;ll&iacute;tani).';
$lang['Theme_updated'] = 'A kiv&aacute;laszott t&eacute;ma friss&uuml;lt. Most m&aacute;r export&aacute;lhatod az &uacute;j t&eacute;ma be&aacute;ll&iacute;t&aacute;sait.';
$lang['Theme_created'] = 'A t&eacute;ma elk&eacute;sz&uuml;lt. Most m&aacute;r export&aacute;lhatod a konfigur&aacute;ci&oacute;s f&aacute;jlba, hogy biztons&aacute;gosan legyen t&aacute;rolva.';

$lang['Confirm_delete_style'] = 'Biztosan t&ouml;r&ouml;lni akarod ezt a st&iacute;lust?';

$lang['Download_theme_cfg'] = 'A t&eacute;ma inform&aacute;ci&oacute; f&aacute;jlt nem lehet &iacute;rni. Kattints az al&aacute;bbi gombra, hogy let&ouml;ltsd, &eacute;s ut&aacute;na m&aacute;sold be abba a k&ouml;nyvt&aacute;rba, ahol a sablon f&aacute;jlok vannak.';
$lang['No_themes'] = 'A kiv&aacute;lasztott sablonhoz nem tartozik t&eacute;ma. &Uacute;j t&eacute;ma k&eacute;sz&iacute;t&eacute;s&eacute;hez kattints a Hozz&aacute;ad&aacute;sra a bal oldalon.';
$lang['No_template_dir'] = 'Nem lehet megnyitni a sablon k&ouml;nyvt&aacute;rat. Vagy nem olvashat&oacute;, vagy nem l&eacute;tezik.';
$lang['Cannot_remove_style'] = 'Nem t&ouml;r&ouml;lheted ezt a st&iacute;lust, mivel ez az alapbe&aacute;ll&iacute;t&aacute;s&uacute;. Menj vissza &eacute;s v&aacute;lassz egy m&aacute;sikat.';
$lang['Style_exists'] = 'A kiv&aacute;lasztott st&iacute;lus neve m&aacute;r l&eacute;tezik, menj vissza &eacute;s adj meg egy m&aacute;sik nevet.';

$lang['Click_return_styleadmin'] = 'Kattints %side%s, hogy visszat&eacute;rj a St&iacute;lus be&aacute;ll&iacute;t&aacute;sokhoz.';

$lang['Theme_settings'] = 'T&eacute;ma be&aacute;ll&iacute;t&aacute;sok';
$lang['Theme_element'] = 'T&eacute;ma elem';
$lang['Simple_name'] = 'Magyar&aacute;zat';
$lang['Value'] = '&Eacute;rt&eacute;k';
$lang['Save_Settings'] = 'Be&aacute;ll&iacute;t&aacute;sok elment&eacute;se';

$lang['Stylesheet'] = 'CSS st&iacute;luslap';
$lang['Stylesheet_explain'] = 'A t&eacute;m&aacute;hoz haszn&aacute;lt CSS st&iacute;luslap f&aacute;jlneve.';
$lang['Background_image'] = 'H&aacute;tt&eacute;rk&eacute;p';
$lang['Background_color'] = 'H&aacute;tt&eacute;rsz&iacute;n';
$lang['Theme_name'] = 'T&eacute;ma neve';
$lang['Link_color'] = 'Linkek sz&iacute;ne';
$lang['Text_color'] = 'Sz&ouml;vegsz&iacute;n';
$lang['VLink_color'] = 'Megl&aacute;togatott linkek sz&iacute;ne';
$lang['ALink_color'] = 'Akt&iacute;v linkek sz&iacute;ne';
$lang['HLink_color'] = 'Link sz&iacute;ne, ha felette van az eg&eacute;r';
$lang['Tr_color1'] = 'T&aacute;bl&aacute;zat sor els&otilde; sz&iacute;ne';
$lang['Tr_color2'] = 'T&aacute;bl&aacute;zat sor m&aacute;sodik sz&iacute;ne';
$lang['Tr_color3'] = 'T&aacute;bl&aacute;zat sor harmadik sz&iacute;ne';
$lang['Tr_class1'] = 'T&aacute;bl&aacute;zat sor els&otilde; oszt&aacute;lya';
$lang['Tr_class2'] = 'T&aacute;bl&aacute;zat sor m&aacute;sodik oszt&aacute;lya';
$lang['Tr_class3'] = 'T&aacute;bl&aacute;zat sor harmadik oszt&aacute;lya';
$lang['Th_color1'] = 'T&aacute;bl&aacute;zat fejl&eacute;c els&otilde; sz&iacute;ne';
$lang['Th_color2'] = 'T&aacute;bl&aacute;zat fejl&eacute;c m&aacute;sodik sz&iacute;ne';
$lang['Th_color3'] = 'T&aacute;bl&aacute;zat fejl&eacute;c harmadik sz&iacute;ne';
$lang['Th_class1'] = 'T&aacute;bl&aacute;zat fejl&eacute;c els&otilde; oszt&aacute;lya';
$lang['Th_class2'] = 'T&aacute;bl&aacute;zat fejl&eacute;c m&aacute;sodik oszt&aacute;lya';
$lang['Th_class3'] = 'T&aacute;bl&aacute;zat fejl&eacute;c harmadik oszt&aacute;lya';
$lang['Td_color1'] = 'Els&otilde; cellasz&iacute;n';
$lang['Td_color2'] = 'M&aacute;sodik cellasz&iacute;n';
$lang['Td_color3'] = 'Harmadik cellasz&iacute;n';
$lang['Td_class1'] = 'Els&otilde; cellaoszt&aacute;ly';
$lang['Td_class2'] = 'M&aacute;sodik cellaoszt&aacute;ly';
$lang['Td_class3'] = 'Harmadik cellaoszt&aacute;ly';
$lang['fontface1'] = 'Els&otilde; bet&ucirc;t&iacute;pus';
$lang['fontface2'] = 'M&aacute;sodik bet&ucirc;t&iacute;pus';
$lang['fontface3'] = 'Harmadik bet&ucirc;t&iacute;pus';
$lang['fontsize1'] = 'Els&otilde; bet&ucirc;m&eacute;ret';
$lang['fontsize2'] = 'M&aacute;sodik bet&ucirc;m&eacute;ret';
$lang['fontsize3'] = 'Harmadik bet&ucirc;m&eacute;ret';
$lang['fontcolor1'] = 'Els&otilde; bet&ucirc;sz&iacute;n';
$lang['fontcolor2'] = 'M&aacute;sodik bet&ucirc;sz&iacute;n';
$lang['fontcolor3'] = 'Harmadik bet&ucirc;sz&iacute;n';
$lang['span_class1'] = 'Els&otilde; span oszt&aacute;ly';
$lang['span_class2'] = 'M&aacute;sodik span oszt&aacute;ly';
$lang['span_class3'] = 'Harmadik span oszt&aacute;ly';
$lang['img_poll_size'] = 'Szavaz&aacute;s k&eacute;pe [px]';
$lang['img_pm_size'] = 'Priv&aacute;t &uuml;zenet st&aacute;tuszk&eacute;p&eacute;nek m&eacute;rete [px]';


//
// Install Process
//
$lang['Welcome_install'] = '&Uuml;dv&ouml;zl&uuml;nk a phpBB 2 telep&iacute;t&otilde;j&eacute;ben!';
$lang['Initial_config'] = 'Alap konfigur&aacute;ci&oacute;';
$lang['DB_config'] = 'Adatb&aacute;zis konfigur&aacute;ci&oacute;';
$lang['Admin_config'] = 'Adminisztr&aacute;tor konfigur&aacute;ci&oacute;';
$lang['continue_upgrade'] = 'Miut&aacute;n let&ouml;lt&ouml;tted a konfigur&aacute;ci&oacute;s f&aacute;jlt, kattints a \'Telep&iacute;t&eacute;s folytat&aacute;sa\' gombra, hogy tov&aacute;bbl&eacute;phess a friss&iacute;t&eacute;sben. A konfigur&aacute;ci&oacute;s f&aacute;jl felt&ouml;lt&eacute;s&eacute;vel v&aacute;rj a friss&iacute;t&eacute;s befejez&eacute;s&eacute;ig.';
$lang['upgrade_submit'] = 'Friss&iacute;t&eacute;s folytat&aacute;sa';

$lang['Installer_Error'] = 'Hiba mer&uuml;lt fel a telep&iacute;t&eacute;s k&ouml;zben.';
$lang['Previous_Install'] = 'Egy el&otilde;z&otilde; verzi&oacute; m&aacute;r telep&iacute;tve van.';
$lang['Install_db_error'] = 'Hiba t&ouml;rt&eacute;nt az adatb&aacute;zis friss&iacute;t&eacute;s&eacute;nek pr&oacute;b&aacute;l&aacute;sa k&ouml;zben (feltehet&otilde;leg m&aacute;r egyszer megpr&oacute;b&aacute;ltad telep&iacute;teni a phpBB-t - gy&otilde;z&otilde;dj meg arr&oacute;l, hogy nincsenek t&aacute;bl&aacute;k az adatb&aacute;zisban megadott el&otilde;taggal, ha vannak t&ouml;r&ouml;ld &otilde;ket, vagy v&aacute;ltoztasd meg a t&aacute;bla el&otilde;tagot).';

$lang['Re_install'] = 'Egy r&eacute;gebben telep&iacute;tett phpBB f&oacute;rum m&eacute;g akt&iacute;v.<br /><br />Ha &uacute;jra akarod telep&iacute;teni a phpBB 2-t, kattints az al&aacute;bbi gombra. Figyelem! Ezzel a jelenlegi adatb&aacute;zis elveszik, nem k&eacute;sz&uuml;l r&oacute;la m&aacute;solat. Az el&otilde;z&otilde; f&oacute;rumhoz tartoz&oacute; adminisztr&aacute;tori felhaszn&aacute;l&oacute;n&eacute;v &eacute;s jelsz&oacute; is elveszik!<br /><br />Gondold &aacute;t, miel&otilde;tt az Igen gombra kattintasz!';

$lang['Inst_Step_0'] = 'K&ouml;sz&ouml;nj&uuml;k, hogy a phpBB-t v&aacute;lasztottad. A telep&iacute;t&eacute;s megkezd&eacute;s&eacute;hez t&ouml;ltsd ki az al&aacute;bbi mez&otilde;ket. Eml&eacute;keztet&otilde;&uuml;l, figyelj arra, hogy a megadott adatb&aacute;zis m&aacute;r l&eacute;tezhet a szerveren, vigy&aacute;zz, hogy ne &iacute;rd fel&uuml;l. Ha ODBC-t vagy MS Access-t haszn&aacute;l&oacute; adatb&aacute;zist haszn&aacute;lsz, akkor el&otilde;bb k&eacute;sz&iacute;ts egy DSN-t, miel&otilde;tt folytatn&aacute;d a telep&iacute;t&eacute;st.';

$lang['Start_Install'] = 'Telep&iacute;t&eacute;s megkezd&eacute;se';
$lang['Finish_Install'] = 'Telep&iacute;t&eacute;s befejez&eacute;se';

$lang['Default_lang'] = 'A f&oacute;rum nyelve';
$lang['DB_Host'] = 'Az adatb&aacute;zis szerver hosztneve / DSN';
$lang['DB_Name'] = 'Az adatb&aacute;zis neve';
$lang['DB_Username'] = 'Adatb&aacute;zis felhaszn&aacute;l&oacute;n&eacute;v';
$lang['DB_Password'] = 'Adatb&aacute;zis jelsz&oacute;';
$lang['Database'] = 'Az adatb&aacute;zis';
$lang['Install_lang'] = 'A telep&iacute;t&eacute;s nyelve';
$lang['dbms'] = 'Az adatb&aacute;zis t&iacute;pusa';
$lang['Table_Prefix'] = 'A t&aacute;bl&aacute;k el&otilde;tagja';
$lang['Admin_Username'] = 'Adminisztr&aacute;tor felhaszn&aacute;l&oacute;n&eacute;v';
$lang['Admin_Password'] = 'Adminisztr&aacute;tor jelsz&oacute;';
$lang['Admin_Password_confirm'] = 'Adminisztr&aacute;tor jelsz&oacute; [ Meger&otilde;s&iacute;t&eacute;s ]';

$lang['Inst_Step_2'] = 'A telep&iacute;t&eacute;s sikeresen befejez&otilde;d&ouml;tt, &eacute;s az adminisztr&aacute;tor azonos&iacute;t&oacute; is elk&eacute;sz&uuml;lt. Miut&aacute;n a Telep&iacute;t&eacute;s befejez&eacute;se gombra kattintott&aacute;l, t&ouml;r&ouml;ld le a phpBB k&ouml;nyvt&aacute;rb&oacute;l a "contrib" &eacute;s az "install" k&ouml;nyvt&aacute;rakat. Ind&iacute;tsd a f&oacute;rumot, ahol a bel&eacute;p&eacute;s ut&aacute;n az Adminisztr&aacute;ci&oacute;s fel&uuml;leten kereszt&uuml;l be&aacute;ll&iacute;thatod a f&oacute;rumot, els&otilde;sorban az &Aacute;ltal&aacute;nos be&aacute;ll&iacute;t&aacute;sokra &uuml;gyelve. K&ouml;sz&ouml;nj&uuml;k, hogy a phpBB 2-t v&aacute;lasztottad.';

$lang['Unwriteable_config'] = 'A konfigur&aacute;ci&oacute;s f&aacute;jlt jelenleg nem lehet &iacute;rni, val&oacute;sz&iacute;n&ucirc;leg &iacute;r&aacute;s-olvas&aacute;si jogosults&aacute;g probl&eacute;ma miatt. A f&aacute;jl egy m&aacute;solata let&ouml;lthet&otilde;, ha az al&aacute;bbi linkre kattintasz. Ezt k&eacute;zzel t&ouml;ltsd fel a phpBB 2 gy&ouml;k&eacute;rk&ouml;nyvt&aacute;r&aacute;ba. Ezut&aacute;n l&eacute;pj be az el&otilde;bb megadott adminisztr&aacute;tor felhaszn&aacute;l&oacute;n&eacute;vvel &eacute;s jelsz&oacute;val a F&oacute;rumba, ahol a F&oacute;rum adminisztr&aacute;ci&oacute;ra kattintva be&aacute;ll&iacute;thatod a F&oacute;rum t&ouml;bbi fontos elem&eacute;t, els&otilde;sorban az &Aacute;ltal&aacute;nos be&aacute;ll&iacute;t&aacute;st. K&ouml;sz&ouml;nj&uuml;k, hogy a phpBB 2-t v&aacute;lasztottad.';
$lang['Download_config'] = 'Be&aacute;ll&iacute;t&aacute;s let&ouml;lt&eacute;se';

$lang['ftp_choose'] = 'V&aacute;lassz let&ouml;lt&eacute;si m&oacute;dot';
$lang['ftp_option'] = '<br />Mivel a PHP ezen verzi&oacute;ja m&aacute;r k&eacute;pes kezelni az FTP-ket, &iacute;gy lehet&otilde;s&eacute;g van a konfigur&aacute;ci&oacute;s f&aacute;jl FTP-n kereszt&uuml;li felt&ouml;lt&eacute;s&eacute;re.';
$lang['ftp_instructs'] = 'FTP-n kereszt&uuml;li phpBB felt&ouml;lt&eacute;st v&aacute;lasztott&aacute;l. Ehhez add meg az al&aacute;bbi mez&otilde;kbe az FTP hozz&aacute;f&eacute;r&eacute;s&eacute;nek adatait.';
$lang['ftp_info'] = 'FTP inform&aacute;ci&oacute;k bevitele';
$lang['Attempt_ftp'] = 'Konfigur&aacute;ci&oacute;s f&aacute;jl FTP-n kereszt&uuml;li felt&ouml;lt&eacute;se';
$lang['Send_file'] = 'phpBB felt&ouml;lt&eacute;se k&eacute;zzel';
$lang['ftp_path'] = 'phpBB 2 FTP el&eacute;r&eacute;si &uacute;tja';
$lang['ftp_username'] = 'FTP felhaszn&aacute;l&oacute;n&eacute;v';
$lang['ftp_password'] = 'FTP jelsz&oacute;';
$lang['Transfer_config'] = 'Adat&aacute;tvitel megkezd&eacute;se';
$lang['NoFTP_config'] = 'A konfigur&aacute;ci&oacute;s f&aacute;jl FTP-n kereszt&uuml;li &aacute;tvitele sikertelen volt. T&ouml;ltsd le innen a f&aacute;jlt, &eacute;s k&eacute;zzel kelyezd el az FTP-re.';

$lang['Install'] = '&Uacute;j telep&iacute;t&eacute;s';
$lang['Upgrade'] = 'Friss&iacute;t&eacute;s';


$lang['Install_Method'] = 'Telep&iacute;t&eacute;s m&oacute;dja';

$lang['Install_No_Ext'] = 'A szerveren fut&oacute; PHP be&aacute;ll&iacute;t&aacute;s nem t&aacute;mogatja a kiv&aacute;lasztott adatb&aacute;zis t&iacute;pust.';

$lang['Install_No_PCRE'] = 'A phpBB2-h&ouml;z PCRE (Perl-Compatible Regular Expressions) modul sz&uuml;ks&eacute;ges, mely nem tal&aacute;lhat&oacute; meg a PHP ezen verzi&oacute;j&aacute;ban!';

//
// Version Check
//
$lang['Version_up_to_date'] = 'A phpBB-d a legfrissebb, nem &eacute;rhet&otilde; el &uacute;jabb verzi&oacute;.';
$lang['Version_not_up_to_date'] = 'A phpBB-d <span class="thick">nem</span> a legfrissebb verzi&oacute;j&uacute;! A friss&iacute;t&eacute;s el&eacute;rhet&otilde; a <a href="http://www.phpbb.com/downloads.php" target="_phpBB">phpBB</a>, vagy a <a href="http://download.phpbb.hu" target="_hunphpBB">Magyar phpBB k&ouml;z&ouml;ss&eacute;g</a> oldal&aacute;n.';
$lang['Latest_version_info'] = 'A phpBB legfrissebb el&eacute;rhet&otilde; verzi&oacute;ja a <span class="thick">phpBB %s</span>.';
$lang['Current_version_info'] = 'Jelenlegi f&oacute;rumod verzi&oacute;ja: <span class="thick">phpBB %s</span>.';
$lang['Connect_socket_error'] = 'Nem siker&uuml;lt csatlakozni a phpBB szerverhez, a k&ouml;vetkez&otilde; hiba l&eacute;pett fel:<br />%s';
$lang['Socket_functions_disabled'] = 'A socket funkci&oacute;k nem enged&eacute;lyezettek.';
$lang['Mailing_list_subscribe_reminder'] = 'Hogy mindig azonnal &eacute;rtes&uuml;lj a phpBB friss&iacute;t&eacute;seir&otilde;l, <a href="http://www.phpbb.com/support/" target="_maillist">iratkozz fel a h&iacute;rlevel&uuml;nkre</a>.';
$lang['Version_information'] = 'Verzi&oacute; inform&aacute;ci&oacute;';

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Enged&eacute;lyezett bel&eacute;p&eacute;si k&iacute;s&eacute;rletek sz&aacute;ma';
$lang['Max_login_attempts_explain'] = 'Legfeljebb ennyiszer pr&oacute;b&aacute;lkozhat bel&eacute;pni a felhaszn&aacute;l&oacute;.';
$lang['Login_reset_time'] = 'Bel&eacute;p&eacute;s z&aacute;rol&aacute;s&aacute;nak ideje';
$lang['Login_reset_time_explain'] = 'Ennyi percet kell v&aacute;rnia a felhaszn&aacute;l&oacute;nak, hogy bel&eacute;phessen, miut&aacute;n t&uacute;ll&eacute;pte az enged&eacute;lyezett bel&eacute;p&eacute;si k&iacute;s&eacute;rletek sz&aacute;m&aacute;t.';

//
// That's all Folks!
// -------------------------------------------------

// Added by Attached Forums MOD
$lang['Attached_Field_Title'] = 'Attached to forum';
$lang['Attached_Description'] = "This field has been added by sub-forums mod.
It will display all attachable forums (if available) in this category";
$lang['Detach_Description'] = 'Detach all forums';
$lang['Has_attachments'] = 'This forum has other forums attached to it. If you assign new category to this forum it will move all it\'s subforums to new category unless you select detach checkbox';
$lang['No_attach_forums'] = 'No attachable forums in this category';
// End Added by Attached Forums MOD

?>
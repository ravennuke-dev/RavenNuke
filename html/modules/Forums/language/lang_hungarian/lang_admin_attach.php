<?php
/***************************************************************************
 *                            lang_admin_attach.php [English]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_admin_attach.php,v 1.36 2003/08/30 15:47:39 acydburn Exp $
 *
 *     translated by	: Fodor Bertalan           and László Miklós
 *     web		: http://fodorb.uw.hu
 *     email		: phpbb@fberci.tk
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

//
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
$lang['Control_Panel'] = 'Vez&eacute;rl&otilde;pult';
$lang['Shadow_attachments'] = '&Aacute;rny&eacute;k csatolm&aacute;nyok';
$lang['Forbidden_extensions'] = 'Tiltott kiterjeszt&eacute;sek';
$lang['Extension_control'] = 'Kiterjeszt&eacute;sek be&aacute;ll&iacute;t&aacute;sai';
$lang['Extension_group_manage'] = 'Kiterjeszt&eacute;s csoportok be&aacute;ll&iacute;t&aacute;sai';
$lang['Special_categories'] = 'Speci&aacute;lis kateg&oacute;ri&aacute;k';
$lang['Sync_attachments'] = 'Csatolm&aacute;nyok szinkroniz&aacute;l&aacute;sa';
$lang['Quota_limits'] = 'Kv&oacute;ta limit';

// Attachments -> Management
$lang['Attach_settings'] = 'Csatolm&aacute;nyok be&aacute;ll&iacute;t&aacute;sa';
$lang['Manage_attachments_explain'] = 'Itt a Csatolm&aacute;ny MOD f&otilde;bb be&aacute;ll&iacute;t&aacute;sait v&aacute;ltoztathatod meg. Ha a Be&aacute;ll&iacute;t&aacute;sok tesztel&eacute;se gombra kattintasz, lefut egy teszt, mely teszteli a MOD m&ucirc;k&ouml;d&eacute;s&eacute;t. Ha gondjaid lenn&eacute;nek a f&aacute;jlok felt&ouml;lt&eacute;s&eacute;vel, futtast le ezt a tesztet, hogy megtudjad a hiba ok&aacute;t.';
$lang['Attach_filesize_settings'] = 'Csatolm&aacute;nyok m&eacute;reteinek be&aacute;ll&iacute;t&aacute;sai';
$lang['Attach_number_settings'] = 'Csatolm&aacute;nyok darabsz&aacute;m&aacute;nak be&aacute;ll&iacute;t&aacute;sa';
$lang['Attach_options_settings'] = 'F&otilde;bb be&aacute;ll&iacute;t&aacute;sok';

$lang['Upload_directory'] = 'Felt&ouml;lt&eacute;si k&ouml;nyvt&aacute;r:';
$lang['Upload_directory_explain'] = 'A phpBB2 k&ouml;nyvt&aacute;radt&oacute;l a relat&iacute;v el&eacute;r&eacute;si &uacute;t. Pl. ha \'files\'-t &iacute;rsz be, &eacute;s a phpBB2 k&ouml;nyvt&aacute;rad a http://www.yourdomain.com/phpBB2 c&iacute;men tal&aacute;lhat&oacute;, akkor a felt&ouml;lt&eacute;si k&ouml;nyvt&aacute;r teljes c&iacute;me http://www.yourdomain.com/phpBB2/files.';
$lang['Attach_img_path'] = 'Csatolm&aacute;ny ikonja hozz&aacute;sz&oacute;l&aacute;sokn&aacute;l:';
$lang['Attach_img_path_explain'] = 'Ez a k&eacute;p jelenik meg a csatolm&aacute;ny mellett a hozz&aacute;sz&oacute;l&aacute;sban. Hagyd &uuml;resen ezt a rubrik&aacute;t, ha nem akarsz semmilyen ikont megjelen&iacute;teni. Ezt a be&aacute;ll&iacute;t&aacute;st fel&uuml;l&iacute;rhatja a Kiterjeszt&eacute;s csoportok be&aacute;ll&iacute;t&aacute;sa.';
$lang['Attach_topic_icon'] = 'Csatolm&aacute;ny ikonja t&eacute;m&aacute;n&aacute;l:';
$lang['Attach_topic_icon_explain'] = 'Ez a k&eacute;p jelenik meg a csatolm&aacute;nnyal rendelkez&otilde; t&eacute;m&aacute;k mellett. Hagyd &uuml;resen ezt a rubrik&aacute;t, ha nem akarsz semmilyen ikont megjelen&iacute;teni.';
$lang['Attach_display_order'] = 'Csatolm&aacute;nyok rendez&eacute;se:';
$lang['Attach_display_order_explain'] = 'Itt v&aacute;laszthatod ki, hogy a hozz&aacute;sz&oacute;l&aacute;sban/priv&aacute;t &uuml;zenetben a f&aacute;jlok cs&ouml;kken&otilde; (el&otilde;sz&ouml;r a leg&uacute;jabb), vagy n&ouml;vekv&otilde; (el&otilde;sz&ouml;r a legk&eacute;s&otilde;bbi csatolm&aacute;ny) sorrendben legyenek.';
$lang['Show_apcp'] = '&Uacute;j Csatolm&aacute;ny k&uuml;ld&eacute;se fel&uuml;let (Csatolm&aacute;nyok vez&eacute;rl&otilde;pult):';
$lang['Show_apcp_explain'] = 'Itt v&aacute;laszthatod ki, hogy a Csatolm&aacute;nyok Vez&eacute;rl&otilde;pult (igen), vagy a r&eacute;gi k&eacute;t rubrika (nem) jelenjen meg hozz&aacute;sz&oacute;l&aacute;s/P&Uuml; &iacute;r&aacute;s&aacute;n&aacute;l/szerkeszt&eacute;s&eacute;n&eacute;l. A kin&eacute;zet&eacute;t neh&eacute;z le&iacute;rni, legegyszer&ucirc;bb ha kipr&oacute;b&aacute;lod.';

$lang['Max_filesize_attach'] = 'Maximum f&aacute;jlm&eacute;ret';
$lang['Max_filesize_attach_explain'] = 'A felt&ouml;lthet&otilde; f&aacute;jlok m&eacute;ret&eacute;nek fels&otilde; hat&aacute;ra. A 0 korl&aacute;tlant jelent. Ez a be&aacute;ll&iacute;t&aacute;s a szerver konfigur&aacute;ci&oacute;t&oacute;l is f&uuml;gg! Ha pl. a php konfigur&aacute;ci&oacute;d csak 2 MB-os felt&ouml;lt&eacute;st enged&eacute;lyez, ezt nem tudja fel&uuml;l&iacute;rni ez a MOD.';
$lang['Attach_quota'] = 'Csatolm&aacute;nyok t&aacute;rhelye';
$lang['Attach_quota_explain'] = 'Ennyi t&aacute;rhelyet foglalhatnak el &Ouml;SSZESEN a csatolm&aacute;nyok a t&aacute;rhelyeden. A 0 korl&aacute;tlant jelent.';
$lang['Max_filesize_pm'] = 'Maximum t&aacute;rhely a priv&aacute;t &uuml;zenet mapp&aacute;ban';
$lang['Max_filesize_pm_explain'] = 'Ennyi t&aacute;rhelyet foglalhatnak el egy felhaszn&aacute;l csatolm&aacute;nyai a priv&aacute;t &uuml;zenet mapp&aacute;j&aacute;ban. A 0 korl&aacute;tlant jelent.';
$lang['Default_quota_limit'] = 'Alap&eacute;rtelmezett kv&oacute;ta limit';
$lang['Default_quota_limit_explain'] = 'Itt adhatod meg az &uacute;jonnan regisztr&aacute;l&oacute;k csatolm&aacute;nyainak t&aacute;rhely&eacute;nek alap&eacute;rtelmezett fels&otilde; hat&aacute;r&aacute;t. A \'Nincs kv&oacute;ta limit\' opci&oacute; kikapcsolja a kv&oacute;t&aacute;kat, ehelyett az ezen az oldalon l&eacute;v&otilde; m&aacute;s be&aacute;ll&iacute;t&aacute;sok lesznek haszn&aacute;lva.';

$lang['Max_attachments'] = 'Csatolm&aacute;nyok maximum darabsz&aacute;ma egy hozz&aacute;sz&oacute;l&aacute;sban:';
$lang['Max_attachments_explain'] = 'Ennyi csatolm&aacute;ny lehet legfeljebb egy hozz&aacute;sz&oacute;l&aacute;sban.';
$lang['Max_attachments_pm'] = 'Csatolm&aacute;nyok maximum darabsz&aacute;ma egy priv&aacute;t &uuml;zenetben:';
$lang['Max_attachments_pm_explain'] = 'Ennyi csatolm&aacute;ny lehet legfeljebb egy priv&aacute;t &uuml;zenetben.';

$lang['Disable_mod'] = 'A Csatolm&aacute;ny MOD kikapcsol&aacute;sa';
$lang['Disable_mod_explain'] = 'Ez f&otilde;leg &uacute;j sablonok tesztel&eacute;s&eacute;re val&oacute;. Ilyenkor a f&oacute;rum -az admin panel kiv&eacute;tel&eacute;vel- &uacute;gy n&eacute;z ki, mintha nem is lenne ez a MOD telep&iacute;tve.';
$lang['PM_Attachments'] = 'Csatolm&aacute;nyok enged&eacute;lyez&eacute;se priv&aacute;t &uuml;zenetben:';
$lang['PM_Attachments_explain'] = 'Enged&eacute;lyezi/megtiltja csatolm&aacute;nyok hozz&aacute;ad&aacute;s&aacute;t a priv&aacute;t &uuml;zenetekhez';
$lang['Ftp_upload'] = 'FTP felt&ouml;lt&eacute;s bekapcsol&aacute;sa:';
$lang['Ftp_upload_explain'] = 'Enged&eacute;lyezi/megtiltja az FTP felt&ouml;lt&eacute;st. Ha igenre &aacute;ll&iacute;tod, meg kell hat&aacute;roznod a Csatolm&aacute;nyok FTP be&aacute;ll&iacute;t&aacute;sait, valamint a felt&ouml;lt&eacute;si k&ouml;nyvt&aacute;r nem lesz haszn&aacute;lva.';
$lang['Attachment_topic_review'] = 'Csatolm&aacute;nyok megjelen&iacute;t&eacute;se a T&eacute;ma el&otilde;n&eacute;zetben';
$lang['Attachment_topic_review_explain'] = 'Ha igenre &aacute;ll&iacute;tod, minden csatolt f&aacute;jlt meg fog jelen&iacute;teni a T&eacute;ma el&otilde;n&eacute;zetben &uacute;j hozz&aacute;sz&oacute;l&aacute;s k&uuml;ld&eacute;sekor.';

$lang['Ftp_server'] = 'FTP felt&ouml;lt&eacute;si szerver';
$lang['Ftp_server_explain'] = 'Itt adhatod meg az IP c&iacute;m&eacute;t vagy FTP-hosztnev&eacute;t a szerverednek, melyen a felt&ouml;lt&ouml;tt f&aacute;jljaid vannak. Ha ezt a rubrik&aacute;t &uuml;resen hagyod, az a szerver lesz haszn&aacute;lva melyre a phpBB2-t install&aacute;ltad. Nem megengedett a c&iacute;mhez ftp://, vagy b&aacute;rmi m&aacute;s hozz&aacute;ad&aacute;sa, csak egyszer&ucirc;en pl. ftp.foo.com, vagy ami enn&eacute;l gyorsabb: az IP c&iacute;m.';

$lang['Attach_ftp_path'] = 'FTP el&eacute;r&eacute;si &uacute;t a felt&ouml;tl&eacute;si k&ouml;nyvt&aacute;rhoz';
$lang['Attach_ftp_path_explain'] = 'Ebbe a k&ouml;nyvt&aacute;rba ker&uuml;lnek a csatolm&aacute;nyok. Nem kell chmodozva lennie. Ne az IP-, vagy FTP-c&iacute;met &iacute;rd ide.<br />P&eacute;ld&aacute;ul: /home/web/uploads';
$lang['Ftp_download_path'] = 'Let&ouml;lt&eacute;si link az FTP-hez';
$lang['Ftp_download_path_explain'] = 'Ide azt az URL-t &iacute;rd, mely az FTP el&eacute;r&eacute;si &uacute;thoz vonatkozik, melyen a csatolm&aacute;nyok vannak.<br /Ha egy k&uuml;ls&otilde; FTP szervert haszn&aacute;lsz a teljes c&iacute;met &iacute;rd be, pl. http://www.mystorage.com/phpBB2/upload.<br />Ha a helyi szervert haszn&aacute;lod, melyen a phpBB-d is van, akkor a phpBB k&ouml;nyvt&aacute;radhoz viszony&iacute;tott relat&iacute;v el&eacute;r&eacute;si utat is megadhatod, pl. \'upload\'.<br />Hagyd &uuml;resen ezt a rubrik&aacute;t, ha az FTP-n l&eacute;v&otilde; k&ouml;nyvt&aacute;r nem &eacute;rhet&otilde; el az Internetr&otilde;l. Ekkor viszont nem tudod a fizik&aacute;lis let&ouml;lt&eacute;si m&oacute;dot haszn&aacute;lni.';
$lang['Ftp_passive_mode'] = 'FTP passz&iacute;v m&oacute;d bekapcsol&aacute;sa';
$lang['Ftp_passive_mode_explain'] = 'A PASV parancsnak sz&uuml;ks&eacute;ge van r&aacute;, hogy az FTP szerver megnyisson egy portot a kapcsol&oacute;d&aacute;shoz &eacute;s ennek a c&iacute;m&eacute;t visszak&uuml;ldje. A felhaszn&aacute;l&oacute; csatlakozik ehhez a porthoz &eacute;s az FTP szerver ezen v&aacute;rja a k&eacute;r&eacute;seket.';

$lang['No_ftp_extensions_installed'] = 'Nem tudod haszn&aacute;lni az FTP felt&ouml;lt&eacute;si m&oacute;dot, mivel az FTP kib&otilde;v&iacute;t&eacute;s nincs benne a PHP install&aacute;ci&oacute;dban.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Itt tudod t&ouml;r&ouml;lni azokat a csatolm&aacute;nyokat, melyek f&aacute;jljai m&aacute;r nem l&eacute;teznek, vagy azokat a f&aacute;jlokat, melyek m&aacute;r nincsenek egy hozz&aacute;sz&oacute;l&aacute;shoz se csatolva. Ha r&aacute;klikkelsz egy f&aacute;jlra let&ouml;tlheted, vagy megn&eacute;zheted azt, vagy ha nincs link akkor a f&aacute;jl m&aacute;r nem l&eacute;tezik.';
$lang['Shadow_attachments_file_explain'] = 'L&eacute;tez&otilde;, de hozz&aacute;sz&oacute;l&aacute;shoz nem csatolt &aacute;llom&aacute;nyok t&ouml;rl&eacute;se';
$lang['Shadow_attachments_row_explain'] = 'Elk&uuml;ld&ouml;tt csatolm&aacute;nyok t&ouml;rl&eacute;se, melyek f&aacute;jlai nem l&eacute;teznek';
$lang['Empty_file_entry'] = 'Nincs adat';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Kis k&eacute;p helyrehoz&aacute;sa a k&ouml;vetkez&otilde; csatolm&aacute;nyokn&aacute;l: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'A csatolm&aacute;nyk szinkroniz&aacute;ci&oacute;ja befejez&otilde;d&ouml;tt.';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Kiterjeszt&eacute;sek be&aacute;ll&iacute;t&aacute;sa';
$lang['Manage_extensions_explain'] = 'Ezen az oldalon a kiterjeszt&eacute;seket m&oacute;dos&iacute;thatod. Ha szeretn&eacute;d egy kiterjeszt&eacute;s felt&ouml;lt&eacute;s&eacute;t enged&eacute;lyezni/letiltani, k&eacute;rlek haszn&aacute;ld a Kiterjeszt&eacute;s csoportok be&aacute;ll&iacute;t&aacute;sa oldalt.';
$lang['Explanation'] = 'Magyar&aacute;zat';
$lang['Extension_group'] = 'Kiterjeszt&eacute;s csoport';
$lang['Invalid_extension'] = 'Hib&aacute;s kiterjeszt&eacute;s';
$lang['Extension_exist'] = 'A %s kiterjeszt&eacute;s m&aacute;r l&eacute;tezik'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'A %s kiterjeszt&eacute;s meg van tiltva, ez&eacute;rt nem tudod felvenni az enged&eacute;lyezett kiterjeszt&eacute;sek k&ouml;z&eacute;.'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Kiterjeszt&eacute;s csoportok be&aacute;ll&iacute;t&aacute;sa';
$lang['Manage_extension_groups_explain'] = 'Ezen az oldalon felvehetsz, t&ouml;r&ouml;lhetsz, szerkeszthetsz kiterjeszt&eacute;s csoportokat, le is tilthatod &otilde;ket, be&aacute;ll&iacute;thatsz nekik egy szpeci&aacute;lis kateg&oacute;ri&aacute;t, valamint a let&ouml;lt&eacute;s m&oacute;dj&aacute;t is megv&aacute;ltoztathatod. Ezen fel&uuml;l megadhatsz egy ikont (kis k&eacute;pet) mely a kiterjeszt&eacute;s csoporthoz tartoz&oacute; csatolm&aacute;nyok el&otilde;tt fog megjelenni.';
$lang['Special_category'] = 'Speci&aacute;lis kateg&oacute;ria';
$lang['Category_images'] = 'K&eacute;p';
$lang['Category_stream_files'] = 'Stream';
$lang['Category_swf_files'] = 'Flash';
$lang['Allowed'] = 'Enged&eacute;lyezve';
$lang['Allowed_forums'] = 'Enged&eacute;lyezett f&oacute;rumok';
$lang['Ext_group_permissions'] = 'Csoport enged&eacute;lyei';
$lang['Download_mode'] = 'Let&ouml;lt&eacute;si m&oacute;d';
$lang['Upload_icon'] = 'Ikon';
$lang['Max_groups_filesize'] = 'Maximum m&eacute;ret';
$lang['Extension_group_exist'] = 'A %s kiterjeszt&eacute;s csoport m&aacute;r l&eacute;tezik.'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Speci&aacute;lis kateg&oacute;ri&aacute;k be&aacute;ll&iacute;t&aacute;sa';
$lang['Manage_categories_explain'] = 'Ezen az oldalon a speci&aacute;lis kateg&oacute;ri&aacute;kat szerkesztheted. Speci&aacute;lis param&eacute;tereket adhatsz meg egy kiterjeszt&eacute;s csoporthoz rendelt speci&aacute;lis kateg&oacute;ri&aacute;nak.';
$lang['Settings_cat_images'] = 'Speci&aacute;lis kateg&oacute;ri&aacute;k be&aacute;ll&iacute;t&aacute;sa: K&eacute;pek';
$lang['Settings_cat_streams'] = 'Speci&aacute;lis kateg&oacute;ri&aacute;k be&aacute;ll&iacute;t&aacute;sa: Stream f&aacute;jlok';
$lang['Settings_cat_flash'] = 'Speci&aacute;lis kateg&oacute;ri&aacute;k be&aacute;ll&iacute;t&aacute;sa: Flash f&aacute;jlok';
$lang['Display_inlined'] = 'K&eacute;pek direkt megjelen&iacute;t&eacute;se';
$lang['Display_inlined_explain'] = 'A k&eacute;pek a hozz&aacute;sz&oacute;l&aacute;sban jelenjenek meg (igen), vagy csak egy link mutasson r&aacute; (nem).';
$lang['Max_image_size'] = 'Maximum k&eacute;p m&eacute;ret';
$lang['Max_image_size_explain'] = 'Itt a csatolt k&eacute;pek maximum nagys&aacute;g&aacute;t tudod megadni pixelben (sz&eacute;less&eacute;g x magass&aacute;g).<br />Ha 0x0-ra &aacute;ll&iacute;tod, a funkci&oacute; ki lesz kapcsolva. N&eacute;h&aacute;ny k&eacute;pn&eacute;l ez a funkci&oacute; nem m&ucirc;k&ouml;dik a PHP korl&aacute;tai miatt.';
$lang['Image_link_size'] = 'Linkelt k&eacute;p m&eacute;rete';
$lang['Image_link_size_explain'] = 'Ha a k&eacute;p el&eacute;ri ezt a m&eacute;retet, akkor csak egy link fog megjelenni hozz&aacute;.<br />Ha 0x0-ra &aacute;ll&iacute;tod, a funkci&oacute; ki lesz kapcsolva. N&eacute;h&aacute;ny k&eacute;pn&eacute;l ez a funkci&oacute; nem m&ucirc;k&ouml;dik a PHP korl&aacute;tai miatt.';
$lang['Assigned_group'] = 'Kijel&ouml;lt csoport';

$lang['Image_create_thumbnail'] = 'Kis k&eacute;p k&eacute;sz&iacute;t&eacute;se';
$lang['Image_create_thumbnail_explain'] = 'Mindig k&eacute;sz&iacute;tsen egy kis k&eacute;pet. Ez a funkci&oacute; majdnem az &ouml;sszes be&aacute;ll&iacute;t&aacute;st fel&uuml;l&iacute;rja ebben a speci&aacute;lis kateg&oacute;ri&aacute;ban, kiv&eacute;ve a maximum k&eacute;p m&eacute;retet. Ha bekapcsolod ezt a funkci&otilde;t, a hozz&aacute;sz&oacute;l&aacute;sban a nagy k&eacute;p helyett egy kis k&eacute;p fog megjelenni, de a felhaszn&aacute;l&oacute; ezt megn&eacute;zheti nagyban is a kis k&eacute;pre kattintva.<br />A funkci&oacute;nak sz&uuml;ks&eacute;ge van egy install&aacute;lt Imagick programra. Ha ez nincs &iacute;gy, vagy a biztons&aacute;gos &uuml;zemm&oacute;d be van kapcsolva, a PHP GD kiterjeszt&eacute;se lesz haszn&aacute;lva. Ha a k&eacute;pt&iacute;pust nem t&aacute;mogatja a PHP, a funkci&oacute; nem lesz bekapcsolva.';
$lang['Image_min_thumb_filesize'] = 'Minimum m&eacute;ret kis k&eacute;phez';
$lang['Image_min_thumb_filesize_explain'] = 'Ha a k&eacute;p kisebb mint ez, nem k&eacute;sz&uuml;l kis k&eacute;p, mivel az eredeti is el&eacute;g kicsi.';
$lang['Image_imagick_path'] = 'Imagick program (teljes el&eacute;r&eacute;si &uacute;t)';
$lang['Image_imagick_path_explain'] = 'A konvert&aacute;l&oacute; program teljes el&eacute;r&eacute;si &uacute;tja, norm&aacute;lisan /usr/bin/convert (windows-on: c:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Imagick keres&eacute;se';

$lang['Use_gd2'] = 'GD2 kiterjeszt&eacute;s haszn&aacute;lata';
$lang['Use_gd2_explain'] = 'A PHP k&eacute;pes alkalmazni a GD1 &eacute;s GD2 kiterjeszt&eacute;seket. Hiba n&eacute;lk&uuml;li kis k&eacute;p k&eacute;sz&iacute;t&eacute;s&eacute;re Imagemagick n&eacute;lk&uuml;l a Csatolm&aacute;ny MOD k&eacute;t elj&aacute;r&aacute;st alkalmaz, az itteni v&aacute;laszt&aacute;s alapj&aacute;n. Ha kis k&eacute;peid rossz min&otilde;s&eacute;g&ucirc;ek, pr&oacute;b&aacute;ld meg megv&aacute;ltoztatni ezt a be&aacute;ll&iacute;t&aacute;st.';
$lang['Attachment_version'] = 'Csatolm&aacute;ny Modul verzi&oacute; %s<br />Modul magyar ford&iacute;t&aacute;sa &copy; <a class="copyright" href="http://fodorb.uw.hu">Fodor Bertalan</a> &eacute;s L&aacute;szl&oacute; Mikl&oacute;s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Tiltott kiterjeszt&eacute;sek be&aacute;ll&iacute;t&aacute;sa';
$lang['Manage_forbidden_extensions_explain'] = 'Ezen az oldalon b&otilde;v&iacute;theted, vagy sz&ucirc;k&iacute;theted a tiltott kiterjeszt&eacute;sek list&aacute;j&aacute;t. A php, php3, php4 kiterjeszt&eacute;sek alap&eacute;rtelmezetten tiltva vannak biztons&aacute;gi okok miatt, nem is tudod t&ouml;r&ouml;lni &otilde;ket.';
$lang['Forbidden_extension_exist'] = 'A %s kiterjeszt&eacute;s m&aacute;r meg van tiltva.'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'A %s kiterjeszt&eacute;s defini&aacute;lva van az enged&eacute;lyezett kiterjeszt&eacute;sek k&ouml;z&ouml;tt, k&eacute;rlek el&otilde;sz&ouml;r t&ouml;r&ouml;ld onnan.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Kiterjeszt&eacute;s csoport enged&eacute;lyei -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Ezen az oldalon korl&aacute;tozni tudod az egyes kiterjeszt&eacute;s csoportokat f&oacute;rumokhoz d&ouml;t&eacute;sed szerint (Enged&eacute;lyezett f&oacute;rumok). Az alap&eacute;rtelmezett be&aacute;ll&iacute;t&aacute;sban az &ouml;sszes kiterjeszt&eacute;s csoport enged&eacute;lyezve van &ouml;sszes f&oacute;rumban. Ha egy kiterjeszt&eacute;s csoportot korl&aacute;tozni szeretn&eacute;l egy bizonyos f&oacute;rumra, akkor v&aacute;laszd ki a megfel&otilde; enged&eacute;lyezett kiterjeszt&eacute;s csoportot (alul), majd v&aacute;laszd ki melyik f&oacute;rumra vonatkoznak a be&aacute;ll&iacute;t&aacute;sok &eacute;s kattints a Kijel&ouml;lt(ek) hozz&aacute;ad&aacute;s&aacute;ra. Minden egyes alkalommal ki tudod terjeszteni a be&aacute;ll&iacute;t&aacute;sokat az &ouml;sszes f&oacute;rumra. Ha egy be&aacute;ll&iacute;t&aacute;s csak bizonyos f&oacute;rumokra vonatkozik, akkor ha &uacute;j f&oacute;rumot hozol l&eacute;tre &uacute;jra el kell l&aacute;togatnod ide.';
$lang['Note_admin_empty_group_permissions'] = 'Megjegyz&eacute;s:<br />Az a al&aacute;bb felsorolt f&oacute;rumokban norm&aacute;lisan a felhaszn&aacute;l&oacute;k csatolhatnak f&aacute;jlokat, de mi&oacute;ta egyetlen egy kiterjeszt&eacute;s sem enged&eacute;lyezett, a felhaszn&aacute;l&oacute;k nem tudnak csatolni semmit. Ha megpr&oacute;b&aacute;lj&aacute;k, egy hiba&uuml;zenetet kapnak. Ha ez a sz&aacute;nd&eacute;kod a \'Csatolm&aacute;ny k&uuml;ld&eacute;se\' jogot &aacute;ll&iacute;tsd &aacute;t ADMINra ezekn&eacute;l a f&oacute;rumokn&aacute;l.<br /><br />';
$lang['Add_forums'] = 'F&oacute;rumok hozz&aacute;ad&aacute;sa';
$lang['Add_selected'] = 'Kijel&ouml;lt(ek) hozz&aacute;ad&aacute;sa';
$lang['Perm_all_forums'] = '&Ouml;SSZES F&Oacute;RUM';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Csatolm&aacute;ny kv&oacute;t&aacute;k be&aacute;ll&iacute;t&aacute;sa';
$lang['Manage_quotas_explain'] = 'Itt felvehetsz/szerkesztheted/t&ouml;r&ouml;lheted a kv&oacute;t&aacute;kat. Ezeket k&eacute;s&otilde;bb hozz&aacute;rendelheted egyes felhaszn&aacute;l&oacute;khoz, csoportokhoz. Ha egy felhaszn&aacute;l&oacute;nak akarsz be&aacute;ll&iacute;tani egy kv&oacute;t&aacute;t, kattints a Felhaszn&aacute;l&oacute;k men&uuml;pontban a Be&aacute;ll&iacute;t&aacute;sra, v&aacute;laszd ki a felhaszn&aacute;l&oacute;t, az adatlap alj&aacute;n megtal&aacute;lod az opci&oacute;kat. Ha egy csoporthoz rendeln&eacute;l hat&aacute;rozn&aacute;l meg egy kv&oacute;t&aacute;t kattints a Csoportokn&aacute;l a Be&aacute;ll&iacute;t&aacute;sra, v&aacute;laszd ki a csoportot, &eacute;s ugyancsak alul megtal&aacute;lod ezeket a be&aacute;ll&iacute;t&aacute;sokat. Ha meg szeretn&eacute;d n&eacute;zni, hogy egy kv&oacute;t&aacute;hoz mely felhaszn&aacute;l&oacute;k, csoportok tartoznak, kattints a kv&oacute;ta mellett l&eacute;v&otilde; \'Megtekint&eacute;s\'-re.';
$lang['Assigned_users'] = 'Kijel&ouml;lt felhaszn&aacute;l&oacute;k';
$lang['Assigned_groups'] = 'Kijel&ouml;lt csoportok';
$lang['Quota_limit_exist'] = 'A %s kv&oacute;ta m&aacute;r l&eacute;tezik.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Csatolm&aacute;nyok Vez&eacute;rl&otilde;pult';
$lang['Control_panel_explain'] = 'Ezen az oldalon a csatolm&aacute;nyok statisztik&aacute;it n&eacute;zheted meg, r&aacute;juk kereshetsz, stb...';
$lang['File_comment_cp'] = 'C&iacute;m';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Haszn&aacute;lj *-ot a r&eacute;szleges szavakhoz';
$lang['Size_smaller_than'] = 'Csatolm&aacute;ny m&eacute;rete kisebb mint (byteban)';
$lang['Size_greater_than'] = 'Csatolm&aacute;ny m&eacute;rete nagyobb mint (byteban)';
$lang['Count_smaller_than'] = 'Let&ouml;ltve kevesebbszer mint';
$lang['Count_greater_than'] = 'Let&ouml;ltve t&ouml;bbsz&ouml;r mint';
$lang['More_days_old'] = 'R&eacute;gebbi mint (nap)';
$lang['No_attach_search_match'] = 'Egy csatolm&aacute;ny se felelt meg a keres&eacute;si krit&eacute;riumoknak.';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Csatolm&aacute;nyok sz&aacute;ma';
$lang['Total_filesize'] = 'Csatolm&aacute;nyok &ouml;sszes m&eacute;rete';
$lang['Number_posts_attach'] = 'Hozz&aacute;sz&oacute;l&aacute;sok csatolm&aacute;nnyal';
$lang['Number_topics_attach'] = 'T&eacute;m&aacute;k csatolm&aacute;nnyal';
$lang['Number_users_attach'] = 'F&uuml;ggetlen felhaszn&aacute;l&oacute;k &aacute;ltal k&uuml;ld&ouml;tt csatolm&aacute;nyok';
$lang['Number_pms_attach'] = 'Csatolm&aacute;nyok teljes darabsz&aacute;ma priv&aacute;t &uuml;zenetekben';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = '%s csatolm&aacute;ny statisztik&aacute;ja'; // replace %s with username
$lang['Size_in_kb'] = 'M&eacute;ret (KB)';
$lang['Downloads'] = 'Let&ouml;ltve';
$lang['Post_time'] = 'Felt&ouml;ltve';
$lang['Posted_in_topic'] = 'T&eacute;ma';
$lang['Submit_changes'] = 'V&aacute;ltoztat&aacute;sok j&oacute;v&aacute;hagy&aacute;sa';

// Sort Types
$lang['Sort_Attachments'] = 'Csatolm&aacute;nyok';
$lang['Sort_Size'] = 'M&eacute;ret';
$lang['Sort_Filename'] = 'F&aacute;jl neve';
$lang['Sort_Comment'] = 'C&iacute;m';
$lang['Sort_Extension'] = 'Kiterjeszt&eacute;s';
$lang['Sort_Downloads'] = 'Let&ouml;lt&eacute;sek sz&aacute;ma';
$lang['Sort_Posttime'] = 'Elk&uuml;ld&eacute;s ideje';
$lang['Sort_Posts'] = 'Hozz&aacute;sz&oacute;l&aacute;sok';

// View Types
$lang['View_Statistic'] = 'Statisztika';
$lang['View_Search'] = 'Keres&eacute;s';
$lang['View_Username'] = 'Felhaszn&aacute;l&oacute;k';
$lang['View_Attachments'] = 'Csatolm&aacute;nyok';

// Successfully updated
$lang['Attach_config_updated'] = 'A csatolm&aacute;nyok be&aacute;ll&iacute;t&aacute;sai sikeresen friss&iacute;tve lettek.';
$lang['Click_return_attach_config'] = 'Kattints %side%s, hogy visszat&eacute;rj a Csatolm&aacute;nyok be&aacute;ll&iacute;t&aacute;s&aacute;hoz.';
$lang['Test_settings_successful'] = 'A be&aacute;ll&iacute;t&aacute;sok tesztel&eacute;se befejez&otilde;d&ouml;tt, minden j&oacute;nak t&ucirc;nik.';

// Some basic definitions
$lang['Attachments'] = 'Csatolm&aacute;nyok';
$lang['Attachment'] = 'Csatolm&aacute;ny';
$lang['Extensions'] = 'Kiterjeszt&eacute;sek';
$lang['Extension'] = 'Kiterjeszt&eacute;s';

// Auth pages
$lang['Auth_attach'] = 'Csatolm&aacute;ny k&uuml;ld&eacute;se';
$lang['Auth_download'] = 'Csatolm&aacute;ny let&ouml;lt&eacute;se';

?>
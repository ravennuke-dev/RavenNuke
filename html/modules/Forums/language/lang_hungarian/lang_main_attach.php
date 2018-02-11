<?php
/***************************************************************************
 *                            lang_main_attach.php [Hungarian]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_main_attach.php,v 1.27 2003/01/16 11:11:56 acydburn Exp $
 *
 *     translated	: Fodor Bertalan
 *     web			: http://fodorb.uw.hu
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
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$lang['Rules_attach_can'] = '<span class="thick">Csatolhat</span> f&aacute;jlokat ebben a f&oacute;rumban';
$lang['Rules_attach_cannot'] = '<span class="thick">Nem</span> csatolhat f&aacute;jlokat ebben a f&oacute;rumban';
$lang['Rules_download_can'] = '<span class="thick">Let&ouml;lthet</span> f&aacute;jlokat ebb&otilde;l a f&oacute;rumb&oacute;l';
$lang['Rules_download_cannot'] = '<span class="thick">Nem</span> t&ouml;lthet le f&aacute;jlokat ebb&otilde;l a f&oacute;rumb&oacute;l';
$lang['Sorry_auth_view_attach'] = 'Sajnos az &Ouml;n sz&aacute;m&aacute;ra nem enged&eacute;lyezett a csatolm&aacute;ny megtekint&eacute;se vagy let&ouml;lt&eacute;se.';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'C&iacute;m'; // used in Administration Panel too...
$lang['Downloaded'] = 'Let&ouml;ltve';
$lang['Download'] = 'Let&ouml;lt&eacute;s'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'F&aacute;jl m&eacute;rete';
$lang['Viewed'] = 'Megtekintve';
$lang['Download_number'] = '%d alkalommal'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'A \'%s\' kiterjeszt&eacute;st az Adminisztr&aacute;tor nem enged&eacute;lyezte, enn&eacute;l fogva a csatolm&aacute;ny nem lesz megjelen&iacute;tve.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Csatolm&aacute;nyok Vez&eacute;rl&otilde;pult';
$lang['Attach_posting_cp_explain'] = 'Ha a Csatolm&aacute;ny Hozz&aacute;ad&aacute;s&aacute;ra kattint, megjelenik egy r&eacute;sz mely seg&iacute;ts&eacute;g&eacute;vel csatolhat dolgokat.<br />Ha az Csatolt &Aacute;llom&aacute;nyokra kattint, a m&aacute;r csatolt f&aacute;jlok list&aacute;j&aacute;t tekintheti meg &eacute;s szerkesztheti.<br />Ha friss&iacute;teni akar egy csatolm&aacute;nyt mindk&eacute;t linkre kattintson r&aacute;. V&aacute;lassza ki a csatolm&aacute;nyt, mint egy&eacute;bk&eacute;nt, de ezut&aacute;n ne a Csatol gombra, hanem az &Uacute;j Verzi&oacute; Felt&ouml;lt&eacute;s&eacute;re kattintson a Csatolt &Aacute;llom&aacute;nyok list&aacute;j&aacute;ban a megfelel&otilde; f&aacute;jln&aacute;l.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Csatol';
$lang['Add_attachment_title'] = 'Csatolm&aacute;ny hozz&aacute;ad&aacute;sa';
$lang['Add_attachment_explain'] = 'Ha nem akar semmit se csatolni a hozz&aacute;sz&oacute;l&aacute;s&aacute;hoz, hagyja &uuml;resen ezt a r&eacute;szt.';
$lang['File_name'] = 'F&aacute;jl neve';
$lang['File_comment'] = 'C&iacute;m';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Csatolt &aacute;llom&aacute;nyok';
$lang['Options'] = 'Be&aacute;ll&iacute;t&aacute;sok';
$lang['Update_comment'] = 'C&iacute;m friss&iacute;t&eacute;se';
$lang['Delete_attachments'] = 'Csatolm&aacute;nyok t&ouml;rl&eacute;se';
$lang['Delete_attachment'] = 'Csatolm&aacute;ny t&ouml;rl&eacute;se';
$lang['Delete_thumbnail'] = 'Kis k&eacute;p t&ouml;rl&eacute;se';
$lang['Upload_new_version'] = '&Uacute;j verzi&oacute; felt&ouml;lt&eacute;se';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s egy hib&aacute;s f&aacute;jln&eacute;v.'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'A csatolm&aacute;ny t&uacute;l nagy.<br />Nem hat&aacute;rozhat&oacute; meg a PHP-ben defini&aacute;lt maximum f&aacute;jlm&eacute;ret.<br />A Csatolm&aacute;ny Modul nem tudja fel&uuml;l&iacute;rni a php.ini-ben meghat&aacute;rozott maximum felt&ouml;lt&eacute;si m&eacute;retet.';
$lang['Attachment_php_size_overrun'] = 'A csatolm&aacute;ny t&uacute;l nagy.<br />Maximum F&aacute;jl M&eacute;ret: %d MB.<br />Ez a php.ini-ben van meghat&aacute;rozva, ez&eacute;rt a Csatolm&aacute;ny Modul se tudja fel&uuml;l&iacute;rni.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'A %s kiterjeszt&eacute;s nem enged&eacute;lyezett'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'Az &Ouml;n sz&aacute;m&aacute;ra nem enged&eacute;lyezett %s kiterjeszt&eacute;s&ucirc; f&aacute;jlok csatol&aacute;sa ebbe a f&oacute;urmba.'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'A csatolm&aacute;ny t&uacute;l nagy.<br />Maximum M&eacute;ret: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Sajnos a csatolm&aacute;nyoknak sz&aacute;nt hely betelt. L&eacute;pjen kapcsolatba az Adminisztr&aacute;torral.';
$lang['Too_many_attachments'] = 'Az &aacute;llom&aacute;ny nem csatolhat&oacute;, t&uacute;l sok (%d db.) csatolm&aacute;ny van a hozz&aacute;sz&oacute;l&aacute;sban.'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'A csatolm&aacute;nynak/k&eacute;pnek %d pixeln&eacute;l keskenyebbnek, &eacute;s %d pixeln&eacute;l alacsonyabbnak kell lennie.'; 
$lang['General_upload_error'] = 'Felt&ouml;lt&eacute;si hiba: Nem siker&uuml;lt felt&ouml;lteni a csatolm&aacute;ny a k&ouml;vetkez&otilde; helyre: %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Nem hagyhatja &uuml;resen a Csatolm&aacute;ny Hozz&aacute;ad&aacute;sa mez&otilde;t.';
$lang['Error_missing_old_entry'] = 'Nem siker&uuml;lt friss&iacute;teni a csatolm&aacute;nyt, nem tal&aacute;lhat&oacute; a r&eacute;gi csatolm&aacute;nyok jegyz&eacute;ke.';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'A priv&aacute;t &uuml;zenet mapp&aacute;j&aacute;ban l&eacute;v&otilde; csatolm&aacute;nyok m&eacute;rete el&eacute;rte az enged&eacute;lyezettet. K&eacute;rj&uuml;k t&ouml;r&ouml;lj&ouml;n n&eacute;h&aacute;ny &eacute;rkezett/elk&uuml;ld&ouml;tt csatolm&aacute;nyt.';
$lang['Attach_quota_receiver_pm_reached'] = '\'%s\' priv&aacute;t &uuml;zenet mapp&aacute;j&aacute;ban l&eacute;v&otilde; csatolm&aacute;nyok m&eacute;rete el&eacute;rte az enged&eacute;lyezettet. K&eacute;rj&uuml;k tudassa ezt vele, vagy v&aacute;rjon m&iacute;g nem t&ouml;rli ki n&eacute;h&aacute;ny csatolm&aacute;ny&aacute;t.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Nem v&aacute;lasztott ki csatolm&aacute;nyt, hogy let&ouml;ltse vagy megn&eacute;zze.';
$lang['Error_no_attachment'] = 'A kiv&aacute;lasztott csatolm&aacute;ny nem l&eacute;tezik.';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Biztos, hogy t&ouml;r&ouml;lni akarja a kiv&aacute;lasztott csatolm&aacute;nyokat?';
$lang['Deleted_attachments'] = 'A kiv&aacute;lasztott csatolm&aacute;nyok sikeresen t&ouml;r&ouml;lve lettek.';
$lang['Error_deleted_attachments'] = 'Nem siker&uuml;lt a csatolm&aacute;nyok t&ouml;rl&eacute;se.';
$lang['Confirm_delete_pm_attachments'] = 'Biztos, hogy az ebben a priv&aacute;t &uuml;zenetben l&eacute;v&otilde; &ouml;sszes csatolm&aacute;nyt t&ouml;r&ouml;lni akarja?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'A csatol&aacute;si funkci&oacute; ki van kapcsolva.';

$lang['Directory_does_not_exist'] = 'A \'%s\' k&ouml;nyvt&aacute;r nem l&eacute;tezik, vagy nem tal&aacute;lhat&oacute;.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'K&eacute;rj&uuml;k ellen&otilde;rizze, hogy \'%s\' egy k&ouml;nyvt&aacute;r-e.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Meg kell hat&aacute;roznia a felt&ouml;lt&eacute;si k&ouml;nyvt&aacute;r el&eacute;r&eacute;si &uacute;tj&aacute;t &eacute;s ezt 777-re chmod-ozni (vagy a http szervere tulajdons&aacute;gait megv&aacute;ltoztatni), hogy fel tudjon t&ouml;lteni f&aacute;jlokat.<br />Ha ftp hozz&aacute;f&eacute;r&eacute;ssel rendelkezik &aacute;ll&iacute;tsa &aacute;t a k&ouml;nyvt&aacute;r jogosults&aacute;gait (Change Attributes) rwxrwxrwx-re.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'Nem siker&uuml;lt csatlakozni az FTP szerverhez: \'%s\'. K&eacute;rj&uuml;k ellen&otilde;rizze az FTP be&aacute;ll&iacute;t&aacute;sait.';
$lang['Ftp_error_login'] = 'Nem siker&uuml;lt bel&eacute;pni az FTP szerverre. A \'%s\' felhaszn&aacute;l&oacute;n&eacute;v, vagy a jelsz&oacute; rossz. K&eacute;rj&uuml;k ellen&otilde;rizze az FTP be&aacute;ll&iacute;t&aacute;sait.';
$lang['Ftp_error_path'] = 'Nem siker&uuml;lt hozz&aacute;f&eacute;rni az ftp k&ouml;nyvt&aacute;rhoz: \'%s\'. K&eacute;rj&uuml;k ellen&otilde;rizze az FTP be&aacute;ll&iacute;t&aacute;sait.';
$lang['Ftp_error_upload'] = 'Nem siker&uuml;lt felt&ouml;lteni a f&aacute;jlokat az ftp k&ouml;nyvt&aacute;rba: \'%s\'. K&eacute;rj&uuml;k ellen&otilde;rizze az FTP be&aacute;ll&iacute;t&aacute;sait.';
$lang['Ftp_error_delete'] = 'Nem siker&uuml;lt t&ouml;r&ouml;lni a f&aacute;jlokat az ftp k&ouml;nyvt&aacute;rban: \'%s\'. K&eacute;rj&uuml;k ellen&otilde;rizze az FTP be&aacute;ll&iacute;t&aacute;sait.<br />A hiba m&aacute;sik oka a csatolm&aacute;ny nem l&eacute;tez&eacute;se lehet, k&eacute;rj&uuml;k ezt ellen&otilde;rizze az &aacute;rny&eacute;k csatolm&aacute;nyokban.';
$lang['Ftp_error_pasv_mode'] = 'Nem siker&uuml;lt ki-/bekapcsolni az FTP passz&iacute;v m&oacute;dot.';

// Attach Rules Window
$lang['Rules_page'] = 'Csatolm&aacute;ny szab&aacute;lyok';
$lang['Attach_rules_title'] = 'Enged&eacute;lyezett kiterjeszt&eacute;sek csoportjai &eacute;s m&eacute;reteik';
$lang['Group_rule_header'] = '%s -> Maximum m&eacute;ret: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Enged&eacute;lyezett kiterjeszt&eacute;sek &eacute;s m&eacute;reteik';
$lang['Note_user_empty_group_permissions'] = 'Megjegyz&eacute;s:<br />Norm&aacute;l esetben csatolhat f&aacute;jlokat ebbe a f&oacute;rumba, <br />de mi&oacute;ta egyetlen egy kiterjeszt&eacute;s sem enged&eacute;lyezett, <br />nem tud csatolni semmit. Ha megpr&oacute;b&aacute;lja,  <br />egy hiba&uuml;zenetet kap.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Felt&ouml;lt&eacute;si kv&oacute;ta';
$lang['Pm_quota'] = 'P&Uuml; kv&oacute;ta';
$lang['User_upload_quota_reached'] = 'El&eacute;rte a %d %s-os felt&ouml;lt&eacute;si kv&oacute;t&aacute;t.'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Felhaszn&aacute;l&oacute;i Csatolm&aacute;nyok Vez&eacute;rl&otilde;pult';
$lang['UACP'] = 'Felhaszn&aacute;l&oacute;i Csatolm&aacute;nyok Vez&eacute;rl&otilde;pult';
$lang['User_uploaded_profile'] = 'Felt&ouml;ltve: %s';
$lang['User_quota_profile'] = 'Kv&oacute;ta: %s';
$lang['Upload_percent_profile'] = '%d%%';

// Common Variables
$lang['Bytes'] = 'Byte';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Csatolm&aacute;ny keres&eacute;se';
$lang['Test_settings'] = 'Be&aacute;ll&iacute;t&aacute;sok tesztel&eacute;se';
$lang['Not_assigned'] = 'Nincs kijel&ouml;lve';
$lang['No_file_comment_available'] = 'A f&aacute;jlnak nincs c&iacute;me.';
$lang['Attachbox_limit'] = 'A csatolm&aacute;nyai t&aacute;rhely&eacute;nek %d%%-a telt be.';
$lang['No_quota_limit'] = 'Nincs kv&oacute;ta limit';
$lang['Unlimited'] = 'Korl&aacute;tlan';

?>
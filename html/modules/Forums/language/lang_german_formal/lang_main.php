<?php

/***************************************************************************
 *                          lang_main.php [German formal]
 *                              -------------------
 *     begin                : Sun May 19 2002
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
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

/***************************************************************************
 * German translation by the translation team of phpBB.de:
 *   http://www.phpbb.de/groupcp.php?g=13086
 * Team Lead: Philipp Kordowich (PhilippK [at] phpbb.de)
 * Special Thanks to:
 *   Joel Ricardo Zick (Rici)
 *   Manfred Hoffmann, Ingo Köhler, Ingo Migliarina, Christian Wunsch
 * and all others for their comments and suggestions
 *
 * Release date: 2006-04-08
 ***************************************************************************/

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'iso-8859-1';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] = 'd.m.Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = 'Deutsche Übersetzung von <a href="http://www.phpbb.de/" target="_blank" class="copyright">phpBB.de</a>';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Kategorie';
$lang['Topic'] = 'Thema';
$lang['Topics'] = 'Themen';
$lang['Replies'] = 'Antworten';
$lang['Views'] = 'Aufrufe';
$lang['Post'] = 'Beitrag';
$lang['Posts'] = 'Beiträge';
$lang['Posted'] = 'Verfasst am';
$lang['Username'] = 'Benutzername';
$lang['Password'] = 'Passwort';
$lang['Email'] = 'E-Mail';
$lang['Poster'] = 'Poster';
$lang['Author'] = 'Autor';
$lang['Time'] = 'Zeit';
$lang['Hours'] = 'Stunden';
$lang['Message'] = 'Nachricht';

$lang['1_Day'] = '1 Tag';
$lang['7_Days'] = '7 Tage';
$lang['2_Weeks'] = '2 Wochen';
$lang['1_Month'] = '1 Monat';
$lang['3_Months'] = '3 Monate';
$lang['6_Months'] = '6 Monate';
$lang['1_Year'] = '1 Jahr';

$lang['Go'] = 'Los';
$lang['Jump_to'] = 'Gehe zu';
$lang['Submit'] = 'Absenden';
$lang['Reset'] = 'Zurücksetzen';
$lang['Cancel'] = 'Abbrechen';
$lang['Preview'] = 'Vorschau';
$lang['Confirm'] = 'Bestätigen';
$lang['Spellcheck'] = 'Rechtschreibprüfung';
$lang['Yes'] = 'Ja';
$lang['No'] = 'Nein';
$lang['Enabled'] = 'Aktiviert';
$lang['Disabled'] = 'Deaktiviert';
$lang['Error'] = 'Fehler';

$lang['Next'] = 'Weiter';
$lang['Previous'] = 'Zurück';
$lang['Goto_page'] = 'Gehe zu Seite';
$lang['Joined'] = 'Anmeldedatum';
$lang['IP_Address'] = 'IP-Adresse';

$lang['Select_forum'] = 'Forum auswählen';
$lang['View_latest_post'] = 'Letzten Beitrag anzeigen';
$lang['View_newest_post'] = 'Neuesten Beitrag anzeigen';
$lang['Page_of'] = 'Seite <span class="thick">%d</span> von <span class="thick">%d</span>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ-Nummer';
$lang['AIM'] = 'AIM-Name';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Foren-Übersicht'; // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Neues Thema eröffnen';
$lang['Reply_to_topic'] = 'Neue Antwort erstellen';
$lang['Reply_with_quote'] = 'Antworten mit Zitat';

$lang['Click_return_topic'] = '%sKlicken Sie hier%s, um zum Thema zurückzukehren'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = '%sKlicken Sie hier%s, um es noch einmal zu versuchen';
$lang['Click_return_forum'] = '%sKlicken Sie hier%s, um zum Forum zurückzukehren';
$lang['Click_view_message'] = '%sKlicken Sie hier%s, um Ihre Nachricht anzuzeigen';
$lang['Click_return_modcp'] = '%sKlicken Sie hier%s, um zur Moderatorenkontrolle zurückzukehren';
$lang['Click_return_group'] = '%sKlicken Sie hier%s, um zur Gruppeninfo zurückzukehren';

$lang['Admin_panel'] = 'Administrations-Bereich';

$lang['Board_disable'] = 'Dieses Board ist im Moment leider nicht verfügbar. Probieren Sie es bitte später nocheinmal.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Registrierte Benutzer:';
$lang['Browsing_forum'] = 'Benutzer in diesem Forum:';
$lang['Online_users_zero_total'] = 'Insgesamt sind <span class="thick">0</span> Benutzer online: ';
$lang['Online_users_total'] = 'Insgesamt sind <span class="thick">%d</span> Benutzer online: ';
$lang['Online_user_total'] = 'Insgesamt ist <span class="thick">ein</span> Benutzer online: ';
$lang['Reg_users_zero_total'] = 'Kein registrierter, ';
$lang['Reg_users_total'] = '%d registrierte, ';
$lang['Reg_user_total'] = 'Ein registrierter, ';
$lang['Hidden_users_zero_total'] = 'kein versteckter und ';
$lang['Hidden_users_total'] = '%d versteckte und ';
$lang['Hidden_user_total'] = 'ein versteckter und ';
$lang['Guest_users_zero_total'] = 'kein Gast.';
$lang['Guest_users_total'] = '%d Gäste.';
$lang['Guest_user_total'] = 'ein Gast.';
$lang['Record_online_users'] = 'Der Rekord liegt bei <span class="thick">%s</span> Benutzern am %s.'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'Ihr letzter Besuch war am: %s'; // %s replaced by date/time
$lang['Current_time'] = 'Aktuelles Datum und Uhrzeit: %s'; // %s replaced by time

$lang['Search_new'] = 'Beiträge seit dem letzten Besuch anzeigen';
$lang['Search_your_posts'] = 'Eigene Beiträge anzeigen';
$lang['Search_unanswered'] = 'Unbeantwortete Beiträge anzeigen';

$lang['Register'] = 'Registrieren';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Profil bearbeiten';
$lang['Search'] = 'Suchen';
$lang['Memberlist'] = 'Mitgliederliste';
$lang['FAQ'] = 'FAQ';
$lang['BBCode_guide'] = 'BBCode-Hilfe';
$lang['Usergroups'] = 'Benutzergruppen';
$lang['Last_Post'] = 'Letzter&nbsp;Beitrag';
$lang['Moderator'] = '<span class="thick">Moderator</span>';
$lang['Moderators'] = '<span class="thick">Moderatoren</span>';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Die Benutzer haben <span class="thick">noch keine</span> Beiträge geschrieben.'; // Number of posts
$lang['Posted_articles_total'] = 'Die Benutzer haben insgesamt <span class="thick">%d</span> Beiträge geschrieben.'; // Number of posts
$lang['Posted_article_total'] = 'Die Benutzer haben <span class="thick">einen</span> Beitrag geschrieben.'; // Number of posts
$lang['Registered_users_zero_total'] = 'Das Board hat <span class="thick">keine</span> registrierten Benutzer.'; // # registered users
$lang['Registered_users_total'] = 'Das Board hat <span class="thick">%d</span> registrierte Benutzer.'; // # registered users
$lang['Registered_user_total'] = 'Das Board hat <span class="thick">einen</span> registrierten Benutzer.'; // # registered users
$lang['Newest_user'] = 'Der neueste Benutzer ist <span class="thick">%s%s%s</span>.'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Es gibt keine neuen Beiträge seit Ihrem letzten Besuch';
$lang['No_new_posts'] = 'Keine neuen Beiträge';
$lang['New_posts'] = 'Neue Beiträge';
$lang['New_post'] = 'Neuer Beitrag';
$lang['No_new_posts_hot'] = 'Keine neuen Beiträge [ Top-Thema ]';
$lang['New_posts_hot'] = 'Neue Beiträge [ Top-Thema ]';
$lang['No_new_posts_locked'] = 'Keine neuen Beiträge [ Gesperrt ]';
$lang['New_posts_locked'] = 'Neue Beiträge [ Gesperrt ]';
$lang['Forum_is_locked'] = 'Forum ist gesperrt';


//
// Login
//
$lang['Enter_password'] = 'Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein, um sich einzuloggen!';
$lang['Login'] = 'Login';
$lang['Logout'] = 'Logout';

$lang['Forgotten_password'] = 'Ich habe mein Passwort vergessen!';

$lang['Log_me_in'] = 'Bei jedem Besuch automatisch einloggen';

$lang['Error_login'] = 'Sie haben einen falschen oder inaktiven Benutzernamen oder ein falsches Passwort eingegeben.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Keine Beiträge';
$lang['No_forums'] = 'Dieses Board hat keine Foren.';

$lang['Private_Message'] = 'Private Nachricht';
$lang['Private_Messages'] = 'Private Nachrichten';
$lang['Who_is_Online'] = 'Wer ist online?';

$lang['Mark_all_forums'] = 'Alle Foren als gelesen markieren';
$lang['Forums_marked_read'] = 'Alle Foren wurden als gelesen markiert.';


//
// Viewforum
//
$lang['View_forum'] = 'Forum anzeigen';

$lang['Forum_not_exist'] = 'Das ausgewählte Forum existiert nicht.';
$lang['Reached_on_error'] = 'Fehler auf dieser Seite!';

$lang['Display_topics'] = 'Siehe Beiträge der letzten';
$lang['All_Topics'] = 'Alle Themen anzeigen';

$lang['Topic_Announcement'] = '<span class="thick">Ankündigungen:</span>';
$lang['Topic_Sticky'] = '<span class="thick">Wichtig:</span>';
$lang['Topic_Moved'] = '<span class="thick">Verschoben:</span>';
$lang['Topic_Poll'] = '<span class="thick">[Umfrage]</span>';

$lang['Mark_all_topics'] = 'Alle Themen als gelesen markieren';
$lang['Topics_marked_read'] = 'Alle Themen wurden als gelesen markiert.';

$lang['Rules_post_can'] = 'Sie <span class="thick">können</span> Beiträge in dieses Forum schreiben.';
$lang['Rules_post_cannot'] = 'Sie <span class="thick">können keine</span> Beiträge in dieses Forum schreiben.';
$lang['Rules_reply_can'] = 'Sie <span class="thick">können</span> auf Beiträge in diesem Forum antworten.';
$lang['Rules_reply_cannot'] = 'Sie <span class="thick">können</span> auf Beiträge in diesem Forum <span class="thick">nicht</span> antworten.';
$lang['Rules_edit_can'] = 'Sie <span class="thick">können</span> Ihre Beiträge in diesem Forum bearbeiten.';
$lang['Rules_edit_cannot'] = 'Sie <span class="thick">können</span> Ihre Beiträge in diesem Forum <span class="thick">nicht</span> bearbeiten.';
$lang['Rules_delete_can'] = 'Sie <span class="thick">können</span> Ihre Beiträge in diesem Forum löschen.';
$lang['Rules_delete_cannot'] = 'Sie <span class="thick">können</span> Ihre Beiträge in diesem Forum <span class="thick">nicht</span> löschen.';
$lang['Rules_vote_can'] = 'Sie <span class="thick">können</span> an Umfragen in diesem Forum teilnehmen.';
$lang['Rules_vote_cannot'] = 'Sie <span class="thick">können</span> an Umfragen in diesem Forum <span class="thick">nicht</span> teilnehmen.';
$lang['Rules_moderate'] = 'Sie <span class="thick">können</span> %sdieses Forum moderieren%s.'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'In diesem Forum sind keine Beiträge vorhanden.<br />Klicken Sie auf <span class="thick">Neues Thema</span>, um den ersten Beitrag zu erstellen.';


//
// Viewtopic
//
$lang['View_topic'] = 'Thema anzeigen';

$lang['Guest'] = 'Gast';
$lang['Post_subject'] = 'Titel';
$lang['View_next_topic'] = 'Nächstes Thema anzeigen';
$lang['View_previous_topic'] = 'Vorheriges Thema anzeigen';
$lang['Submit_vote'] = 'Stimme absenden';
$lang['View_results'] = 'Ergebnis anzeigen';

$lang['No_newer_topics'] = 'Es gibt keine neueren Themen in diesem Forum.';
$lang['No_older_topics'] = 'Es gibt keine älteren Themen in diesem Forum.';
$lang['Topic_post_not_exist'] = 'Das gewählte Thema oder der Beitrag existiert nicht.';
$lang['No_posts_topic'] = 'Es existieren keine Beiträge zu diesem Thema.';

$lang['Display_posts'] = 'Beiträge der letzten Zeit anzeigen';
$lang['All_Posts'] = 'Alle Beiträge';
$lang['Newest_First'] = 'Die neusten zuerst';
$lang['Oldest_First'] = 'Die ältesten zuerst';

$lang['Back_to_top'] = 'Nach oben';

$lang['Read_profile'] = 'Benutzer-Profile anzeigen';
$lang['Visit_website'] = 'Website dieses Benutzers besuchen';
$lang['ICQ_status'] = 'ICQ-Status';
$lang['Edit_delete_post'] = 'Beitrag bearbeiten oder löschen';
$lang['View_IP'] = 'IP-Adresse zeigen';
$lang['Delete_post'] = 'Beitrag löschen';

$lang['wrote'] = 'hat Folgendes geschrieben'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Zitat'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt einmal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt %d-mal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 2 times in total

$lang['Lock_topic'] = 'Thema sperren';
$lang['Unlock_topic'] = 'Thema entsperren';
$lang['Move_topic'] = 'Thema verschieben';
$lang['Delete_topic'] = 'Thema löschen';
$lang['Split_topic'] = 'Thema teilen';

$lang['Stop_watching_topic'] = 'Bei Antworten zu diesem Thema nicht mehr benachrichtigen';
$lang['Start_watching_topic'] = 'Bei Antworten zu diesem Thema benachrichtigen';
$lang['No_longer_watching'] = 'Das Thema wird nicht mehr von Ihnen beobachtet.';
$lang['You_are_watching'] = 'Sie beobachten nun das Thema.';

$lang['Total_votes'] = 'Stimmen insgesamt';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Nachrichtentext';
$lang['Topic_review'] = 'Thema-Überblick';

$lang['No_post_mode'] = 'Kein Eintrags-Modus ausgewählt'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Neues Thema schreiben';
$lang['Post_a_reply'] = 'Antwort schreiben';
$lang['Post_topic_as'] = 'Thema schreiben als';
$lang['Edit_Post'] = 'Beitrag editieren';
$lang['Options'] = 'Optionen';

$lang['Post_Announcement'] = 'Ankündigung';
$lang['Post_Sticky'] = 'Wichtig';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Sind Sie sicher, dass dieser Beitrag gelöscht werden soll?';
$lang['Confirm_delete_poll'] = 'Sind Sie sicher, dass diese Umfrage gelöscht werden soll?';

$lang['Flood_Error'] = 'Sie können einen Beitrag nicht so schnell nach Ihrem letzten absenden, bitte warten Sie einen Augenblick.';
$lang['Empty_subject'] = 'Bei einem neuen Thema müssen Sie einen Titel angeben.';
$lang['Empty_message'] = 'Sie müssen zu Ihrem Beitrag einen Text eingeben.';
$lang['Forum_locked'] = 'Dieses Forum ist gesperrt, Sie können keine Beiträge editieren, schreiben oder beantworten.';
$lang['Topic_locked'] = 'Dieses Thema ist gesperrt, Sie können keine Beiträge editieren oder beantworten.';
$lang['No_post_id'] = 'Sie müssen einen Beitrag zum Editieren auswählen.';
$lang['No_topic_id'] = 'Sie müssen ein Thema für Ihre Antwort auswählen.';
$lang['No_valid_mode'] = 'Beiträge können nur geschrieben, bearbeitet, beantwortet und zitiert werden. Versuchen Sie es bitte noch einmal.';
$lang['No_such_post'] = 'Es existiert kein solcher Beitrag. Versuchen Sie es bitte noch einmal.';
$lang['Edit_own_posts'] = 'Sie können nur Ihre eigenen Beiträge bearbeiten.';
$lang['Delete_own_posts'] = 'Sie können nur Ihre eigenen Beiträge löschen.';
$lang['Cannot_delete_replied'] = 'Sie können keine Beiträge löschen, die schon beantwortet wurden.';
$lang['Cannot_delete_poll'] = 'Sie können keine aktiven Umfrage löschen.';
$lang['Empty_poll_title'] = 'Sie müssen einen Titel für die Umfrage eingeben.';
$lang['To_few_poll_options'] = 'Sie müssen mindestens zwei Antworten für die Umfrage angeben.';
$lang['To_many_poll_options'] = 'Sie haben zu viele Antworten für die Umfrage angegeben';
$lang['Post_has_no_poll'] = 'Dieser Beitrag hat keine Umfrage.';
$lang['Already_voted'] = 'Sie haben an dieser Umfrage schon teilgenommen.';
$lang['No_vote_option'] = 'Sie müssen eine Auswahl treffen, um abzustimmen.';

$lang['Add_poll'] = 'Umfrage hinzufügen';
$lang['Add_poll_explain'] = 'Wenn Sie keine Umfrage zum Thema hinzufügen wollen, lassen Sie das Feld bitte leer.';
$lang['Poll_question'] = 'Frage';
$lang['Poll_option'] = 'Antwort';
$lang['Add_option'] = 'Antwort hinzufügen';
$lang['Update'] = 'Aktualisieren';
$lang['Delete'] = 'Löschen';
$lang['Poll_for'] = 'Dauer der Umfrage:';
$lang['Days'] = 'Tage'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Geben Sie 0 ein oder lassen Sie dieses Feld leer, um die Umfrage auf unbeschränkte Zeit durchzuführen ]';
$lang['Delete_poll'] = 'Umfrage löschen';

$lang['Disable_HTML_post'] = 'HTML in diesem Beitrag deaktivieren';
$lang['Disable_BBCode_post'] = 'BBCode in diesem Beitrag deaktivieren';
$lang['Disable_Smilies_post'] = 'Smilies in diesem Beitrag deaktivieren';

$lang['HTML_is_ON'] = 'HTML ist <span class="underline">an</span>';
$lang['HTML_is_OFF'] = 'HTML ist <span class="underline">aus</span>';
$lang['BBCode_is_ON'] = '%sBBCode%s ist <span class="underline">an</span>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s ist <span class="underline">aus</span>';
$lang['Smilies_are_ON'] = 'Smilies sind <span class="underline">an</span>';
$lang['Smilies_are_OFF'] = 'Smilies sind <span class="underline">aus</span>';

$lang['Attach_signature'] = 'Signatur anhängen (Signatur kann im Profil geändert werden)';
$lang['Notify'] = 'Benachrichtigen Sie mich, wenn eine Antwort geschrieben wurde';

$lang['Stored'] = 'Ihre Nachricht wurde erfolgreich eingetragen.';
$lang['Deleted'] = 'Ihre Nachricht wurde erfolgreich gelöscht.';
$lang['Poll_delete'] = 'Ihre Umfrage wurde erfolgreich gelöscht.';
$lang['Vote_cast'] = 'Ihre Stimme wurde gezählt.';

$lang['Topic_reply_notification'] = 'Benachrichtigen bei Antworten';

$lang['bbcode_b_help'] = 'Text in fett: [b]Text[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Text in kursiv: [i]Text[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Unterstrichener Text: [u]Text[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Zitat: [quote]Text[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Code anzeigen: [code]Code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste: [list]Text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Geordnete Liste: [list=]Text[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Bild einfügen: [img]http://URL_des_Bildes[/img] (alt+p)';
$lang['bbcode_w_help'] = 'URL einfügen: [url]http://URL[/url] oder [url=http://url]URL Text[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Alle offenen BBCodes schließen';
$lang['bbcode_s_help'] = 'Schriftfarbe: [color=red]Text[/color] Tipp: Du kannst ebenfalls color=#FF0000 benutzen';
$lang['bbcode_f_help'] = 'Schriftgröße: [size=x-small]Kleiner Text[/size]';

$lang['Emoticons'] = 'Smilies';
$lang['More_emoticons'] = 'Weitere Smilies ansehen';

$lang['Font_color'] = 'Schriftfarbe';
$lang['color_default'] = 'Standard';
$lang['color_dark_red'] = 'Dunkelrot';
$lang['color_red'] = 'Rot';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Braun';
$lang['color_yellow'] = 'Gelb';
$lang['color_green'] = 'Grün';
$lang['color_olive'] = 'Oliv';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Blau';
$lang['color_dark_blue'] = 'Dunkelblau';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violett';
$lang['color_white'] = 'Weiß';
$lang['color_black'] = 'Schwarz';

$lang['Font_size'] = 'Schriftgröße';
$lang['font_tiny'] = 'Winzig';
$lang['font_small'] = 'Klein';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Groß';
$lang['font_huge'] = 'Riesig';

$lang['Close_Tags'] = 'Tags schließen';
$lang['Styles_tip'] = 'Tipp: Styles können schnell zum markierten Text hinzugefügt werden.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Private Nachrichten';

$lang['Login_check_pm'] = 'Einloggen, um private Nachrichten zu lesen';
$lang['New_pms'] = 'Sie haben %d neue Nachrichten'; // You have 2 new messages
$lang['New_pm'] = 'Sie haben 1 neue Nachricht'; // You have 1 new message
$lang['No_new_pm'] = 'Sie haben keine neuen Nachrichten';
$lang['Unread_pms'] = 'Sie haben %d ungelesene Nachrichten';
$lang['Unread_pm'] = 'Sie haben 1 ungelesene Nachricht';
$lang['No_unread_pm'] = 'Sie haben keine ungelesenen Nachrichten';
$lang['You_new_pm'] = 'Eine neue private Nachricht befindet sich in Ihrem Posteingang';
$lang['You_new_pms'] = 'Es befinden sich neue private Nachrichten in Ihrem Posteingang';
$lang['You_no_new_pm'] = 'Es sind keine neuen privaten Nachrichten vorhanden';

$lang['Unread_message'] = 'Ungelesene Nachricht';
$lang['Read_message'] = 'Gelesene Nachricht';

$lang['Read_pm'] = 'Nachricht lesen';
$lang['Post_new_pm'] = 'Nachricht schreiben';
$lang['Post_reply_pm'] = 'Auf Nachricht antworten';
$lang['Post_quote_pm'] = 'Nachricht zitieren';
$lang['Edit_pm'] = 'Nachricht bearbeiten';

$lang['Inbox'] = 'Posteingang';
$lang['Outbox'] = 'Postausgang';
$lang['Savebox'] = 'Archiv';
$lang['Sentbox'] = 'Gesendete Nachrichten';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Titel';
$lang['From'] = 'Von';
$lang['To'] = 'An';
$lang['Date'] = 'Datum';
$lang['Mark'] = 'Markiert';
$lang['Sent'] = 'Gesendet';
$lang['Saved'] = 'Gespeichert';
$lang['Delete_marked'] = 'Markierte löschen';
$lang['Delete_all'] = 'Alle löschen';
$lang['Save_marked'] = 'Markierte speichern';
$lang['Save_message'] = 'Nachricht speichern';
$lang['Delete_message'] = 'Nachricht löschen';

$lang['Display_messages'] = 'Nachrichten anzeigen der letzten'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Alle Nachrichten';

$lang['No_messages_folder'] = 'Es sind keine weiteren Nachrichten in diesem Ordner.';

$lang['PM_disabled'] = 'Private Nachrichten wurden in diesem Board deaktiviert.';
$lang['Cannot_send_privmsg'] = 'Der Administrator hat private Nachrichten für Sie gesperrt.';
$lang['No_to_user'] = 'Sie müssen einen Benutzernamen angeben, um diese Nachricht zu senden.';
$lang['No_such_user'] = 'Es existiert kein Benutzer mit diesem Namen.';

$lang['Disable_HTML_pm'] = 'HTML in dieser Nachricht deaktivieren';
$lang['Disable_BBCode_pm'] = 'BBCode in dieser Nachricht deaktivieren';
$lang['Disable_Smilies_pm'] = 'Smilies in dieser Nachricht deaktivieren';

$lang['Message_sent'] = 'Ihre Nachricht wurde gesendet.';

$lang['Click_return_inbox'] = 'Klicken Sie %shier%s, um zum Posteingang zurückzukehren';
$lang['Click_return_index'] = 'Klicken Sie %shier%s, um zum Index zurückzukehren';

$lang['Send_a_new_message'] = 'Neue Nachricht senden';
$lang['Send_a_reply'] = 'Auf private Nachricht antworten';
$lang['Edit_message'] = 'Private Nachricht bearbeiten';

$lang['Notification_subject'] = 'Eine neue private Nachricht ist eingetroffen!';

$lang['Find_username'] = 'Benutzernamen finden';
$lang['Find'] = 'Finden';
$lang['No_match'] = 'Keine Ergebnisse gefunden.';

$lang['No_post_id'] = 'Es wurde keine Beitrags-ID angegeben.';
$lang['No_such_folder'] = 'Es existiert kein solcher Ordner.';
$lang['No_folder'] = 'Kein Ordner ausgewählt';

$lang['Mark_all'] = 'Alle markieren';
$lang['Unmark_all'] = 'Markierungen aufheben';

$lang['Confirm_delete_pm'] = 'Diese Nachricht wirklich löschen?';
$lang['Confirm_delete_pms'] = 'Diese Nachrichten wirklich löschen?';

$lang['Inbox_size'] = 'Ihr Posteingang ist zu %d%% voll'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Ihre gesendeten Nachrichten sind zu %d%% voll';
$lang['Savebox_size'] = 'Ihr Archiv ist zu %d%% voll';

$lang['Click_view_privmsg'] = 'Klick Sie %shier%s, um Ihren Posteingang aufzurufen';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profil anzeigen: %s'; // %s is username
$lang['About_user'] = 'Weitere Informationen über %s';

$lang['Preferences'] = 'Einstellungen';
$lang['Items_required'] = 'Mit * markierte Felder sind erforderlich';
$lang['Registration_info'] = 'Registrierungs-Informationen';
$lang['Profile_info'] = 'Profil-Informationen';
$lang['Profile_info_warn'] = 'Diese Informationen sind öffentlich abrufbar!';
$lang['Avatar_panel'] = 'Avatar-Steuerung';
$lang['Avatar_gallery'] = 'Avatar-Galerie';

$lang['Website'] = 'Website';
$lang['Location'] = 'Wohnort';
$lang['Contact'] = 'Kontakt';
$lang['Email_address'] = 'E-Mail-Adresse';
$lang['Send_private_message'] = 'Private Nachricht senden';
$lang['Hidden_email'] = '[ Versteckt ]';
$lang['Interests'] = 'Interessen';
$lang['Occupation'] = 'Beruf';
$lang['Poster_rank'] = 'Rang';

$lang['Total_posts'] = 'Beiträge insgesamt';
$lang['User_post_pct_stats'] = '%.2f%% aller Beiträge'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f Beiträge pro Tag'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Alle Beiträge von %s anzeigen'; // Find all posts by username

$lang['No_user_id_specified'] = 'Dieser Benutzer existiert nicht.';
$lang['Wrong_Profile'] = 'Sie können nur Ihr eigenes Profil bearbeiten.';

$lang['Only_one_avatar'] = 'Es kann nur ein Avatar ausgewählt werden';
$lang['File_no_data'] = 'Die angegebene Datei enthält keine Daten';
$lang['No_connection_URL'] = 'Es konnte keine Verbindung zur angegebenen Datei hergestellt werden';
$lang['Incomplete_URL'] = 'Die angegebene URL ist unvollständig';
$lang['Wrong_remote_avatar_format'] = 'Das Format des Avatars ist nicht gültig';
$lang['No_send_account_inactive'] = 'Ein neues Passwort kann derzeit nicht angefordert werden, da Ihr Account noch inaktiv ist. Bitte kontaktieren Sie den Administrator, um weitere Information zu erhalten.';

$lang['Always_smile'] = 'Smilies immer aktivieren';
$lang['Always_html'] = 'HTML immer aktivieren';
$lang['Always_bbcode'] = 'BBCode immer aktivieren';
$lang['Always_add_sig'] = 'Signatur immer anhängen';
$lang['Always_notify'] = 'Bei Antworten immer benachrichtigen';
$lang['Always_notify_explain'] = 'Sendet Ihnen eine E-Mail, wenn jemand auf einen Ihrer Beiträge antwortet. Kann für jeden Beitrag geändert werden.';

$lang['Board_style'] = 'Board-Style';
$lang['Board_lang'] = 'Board-Sprache';
$lang['No_themes'] = 'Keine Themes in der Datenbank';
$lang['Timezone'] = 'Zeitzone';
$lang['Date_format'] = 'Datums-Format';
$lang['Date_format_explain'] = 'Die Syntax ist identisch mit der PHP-Funktion <a href="http://www.php.net/date" target="_blank">date()</a>';
$lang['Signature'] = 'Signatur';
$lang['Signature_explain'] = 'Dies ist ein Text, der an jeden Ihrer Beiträge angehangen werden kann. Es besteht ein Limit von %d Buchstaben.';
$lang['Public_view_email'] = 'Zeige meine E-Mail-Adresse immer an';

$lang['Current_password'] = 'Altes Passwort';
$lang['New_password'] = 'Neues Passwort';
$lang['Confirm_password'] = 'Passwort bestätigen';
$lang['Confirm_password_explain'] = 'Sie müssen Ihr Passwort angeben, wenn Sie Ihr Passwort oder Ihre Mailadresse ändern möchten.';
$lang['password_if_changed'] = 'Sie müssen nur dann ein neues Passwort angeben, wenn Sie es ändern wollen';
$lang['password_confirm_if_changed'] = 'Sie müssen Ihr neues Passwort bestätigen, wenn Sie es ändern wollen';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Zeigt eine kleine Grafik neben jedem Ihrer Beiträge an. Es kann immer nur ein Avatar angezeigt werden, seine Breite darf nicht größer als %d Pixel sein, die Höhe nicht größer als %d Pixel, und die Dateigröße darf maximal %d KB betragen.';
$lang['Upload_Avatar_file'] = 'Avatar von Ihrem Computer hochladen';
$lang['Upload_Avatar_URL'] = 'Avatar von URL hochladen';
$lang['Upload_Avatar_URL_explain'] = 'Geben Sie die URL des gewünschten Avatars an, dieser wird dann kopiert';
$lang['Pick_local_Avatar'] = 'Avatar aus der Galerie auswählen';
$lang['Link_remote_Avatar'] = 'Zu einem externen Avatar verlinken';
$lang['Link_remote_Avatar_explain'] = 'Geben Sie die URL des Avatars ein, der verlinkt werden soll';
$lang['Avatar_URL'] = 'URL des Avatars';
$lang['Select_from_gallery'] = 'Avatar aus der Galerie auswählen';
$lang['View_avatar_gallery'] = 'Galerie anzeigen';

$lang['Select_avatar'] = 'Avatar auswählen';
$lang['Return_profile'] = 'Avatar abbrechen';
$lang['Select_category'] = 'Kategorie auswählen';

$lang['Delete_Image'] = 'Bild löschen';
$lang['Current_Image'] = 'Aktuelles Bild';

$lang['Notify_on_privmsg'] = 'Bei neuen Privaten Nachrichten benachrichtigen';
$lang['Popup_on_privmsg'] = 'PopUp-Fenster bei neuen Privaten Nachrichten';
$lang['Popup_on_privmsg_explain'] = 'Einige Templates öffnen neue Fenster, um Sie über neue private Nachrichten zu benachrichtigen.';
$lang['Hide_user'] = 'Online-Status verstecken';

$lang['Profile_updated'] = 'Ihr Profil wurde aktualisiert.';
$lang['Profile_updated_inactive'] = 'Ihr Profil wurde aktualisiert. Sie haben jedoch wesentliche Details geändert, weswegen Ihr Account jetzt inaktiv ist. Sie wurden per E-Mail informiert, wie Sie Ihren Account reaktivieren können. Falls eine Aktivierung durch den Administrator erforderlich ist, haben Sie bitte etwas Geduld, bis die Reaktivierung erfolgt ist.';

$lang['Password_mismatch'] = 'Sie müssen zweimal das gleiche Passwort eingeben.';
$lang['Current_password_mismatch'] = 'Das aktuelle Passwort stimmt nicht mit dem in der Datenbank überein.';
$lang['Password_long'] = 'Ihr Passwort darf nicht länger als 32 Zeichen sein.';
$lang['Username_taken'] = 'Der gewünschte Benutzername ist leider bereits belegt.';
$lang['Username_invalid'] = 'Der gewünschte Benutzername enthält ein ungültiges Sonderzeichen (z. B. \').';
$lang['Username_disallowed'] = 'Der gewünschte Benutzername wurde vom Administrator gesperrt.';
$lang['Email_taken'] = 'Die angegebene Mailadresse wird bereits von einem anderen Benutzer verwendet.';
$lang['Email_banned'] = 'Die angegebene Mailadresse wurde vom Administrator gesperrt.';
$lang['Email_invalid'] = 'Die angegebene Mailadresse ist ungültig.';
$lang['Signature_too_long'] = 'Ihre Signatur ist zu lang.';
$lang['Fields_empty'] = 'Sie müssen alle benötigten Felder ausfüllen.';
$lang['Avatar_filetype'] = 'Der Avatar muss im GIF-, JPG- oder PNG-Format sein.';
$lang['Avatar_filesize'] = 'Die Dateigröße muss kleiner als %d KB sein.'; // followed by xx kB, xx being the size
$lang['Avatar_imagesize'] = 'Der Avatar muss weniger als %d Pixel breit und %d Pixel hoch sein.';

$lang['Welcome_subject'] = 'Willkommen auf %s';
$lang['New_account_subject'] = 'Neuer Benutzeraccount';
$lang['Account_activated_subject'] = 'Account aktiviert';

$lang['Account_added'] = 'Danke für Ihre Registrierung, Ihr Account wurde erstellt. Sie können sich jetzt mit Ihrem Benutzernamen und Ihrem Passwort einloggen.';
$lang['Account_inactive'] = 'Ihr Account wurde erstellt. Dieses Forum benötigt aber eine Aktivierung, daher wurde ein Activation-Key an Ihre E-Mail-Adresse gesendet. Bitte überprüfen Sie Ihre Mailbox für weitere Informationen.';
$lang['Account_inactive_admin'] = 'Ihr Account wurde erstellt. Dieser muss noch durch den Administrator freigeschaltet werden. Sie werden benachrichtigt, sobald dies erfolgt ist.';
$lang['Account_active'] = 'Ihr Account wurde aktiviert. Danke für die Registrierung.';
$lang['Account_active_admin'] = 'Ihr Account wurde jetzt aktiviert.';
$lang['Reactivate'] = 'Account wieder aktivieren!';
$lang['Already_activated'] = 'Ihr Account ist bereits aktiv';
$lang['COPPA'] = 'Ihr Account wurde erstellt, muss aber zuerst überprüft werden. Mehr Details dazu wurden Ihnen per E-Mail gesendet.';

$lang['Registration'] = 'Einverständniserklärung';
$lang['Reg_agreement'] = 'Die Administratoren und Moderatoren dieses Forums bemühen sich, Beiträge mit fragwürdigem Inhalt so schnell wie möglich zu bearbeiten oder ganz zu löschen; aber es ist nicht möglich, jede einzelne Nachricht zu überprüfen. Sie bestätigen mit Absenden dieser Einverständniserklärung, dass Sie akzeptieren, dass jeder Beitrag in diesem Forum die Meinung seines Urhebers wiedergibt und dass die Administratoren, Moderatoren und Betreiber dieses Forums nur für ihre eigenen Beiträge verantwortlich sind.<br /><br />Sie verpflichten sich, keine beleidigenden, obszönen, vulgären, verleumderischen, gewaltverherrlichenden oder aus anderen Gründen strafbare Inhalte in diesem Forum zu veröffentlichen. Verstöße gegen diese Regel führen zu sofortiger und permanenter Sperrung. Die Betreiber behalten sich vor, Verbindungsdaten u. ä. an die strafverfolgenden Behörden weiterzugeben. Sie räumen den Betreibern, Administratoren und Moderatoren dieses Forums das Recht ein, Beiträge nach eigenem Ermessen zu entfernen, zu bearbeiten, zu verschieben oder zu sperren. Sie stimmen zu, dass die im Rahmen der Registrierung erhobenen Daten in einer Datenbank gespeichert werden.<br /><br />Dieses System verwendet Cookies, um Informationen auf Ihrem Computer zu speichern. Diese Cookies enthalten keine der oben angegebenen Informationen, sondern dienen ausschließlich dem Bedienungskomfort. Ihre Mail-Adresse wird nur zur Bestätigung der Registrierung und ggf. zum Versand eines neuen Passwortes verwendet.<br /><br />Durch das Abschließen der Registrierung stimmen Sie diesen Nutzungsbedingungen zu.';

$lang['Agree_under_13'] = 'Ich bin mit den Konditionen dieses Forums einverstanden und <span class="thick">unter</span> 12 Jahre alt.';
$lang['Agree_over_13'] = 'Ich bin mit den Konditionen dieses Forums einverstanden und <span class="thick">über</span> oder <span class="thick">exakt</span> 12 Jahre alt.';
$lang['Agree_not'] = 'Ich bin mit den Konditionen nicht einverstanden.';

$lang['Wrong_activation'] = 'Der Aktivierungsschlüssel aus dem Link stimmt nicht mit dem in der Datenbank gespeicherten überein. Bitte überprüfen Sie die URL, und versuchen Sie es erneut.';
$lang['Send_password'] = 'Schicken Sie mir bitte ein neues Passwort.';
$lang['Password_updated'] = 'Ein neues Passwort wurde erstellt. Es wurde Ihnen eine E-Mail mit weiteren Anweisungen gesendet.';
$lang['No_email_match'] = 'Die angegebene E-Mail-Adresse stimmt nicht mit der für den Benutzernamen gespeicherten überein.';
$lang['New_password_activation'] = 'Aktivierung des neuen Passwortes';
$lang['Password_activated'] = 'Ihr Account wurde wieder aktiviert. Um sich einzuloggen, benutzen Sie bitte das Passwort, welches Sie per E-Mail erhalten haben.';

$lang['Send_email_msg'] = 'E-Mail senden';
$lang['No_user_specified'] = 'Es wurde kein Benutzer ausgewählt';
$lang['User_prevent_email'] = 'Dieser Benutzer hat den E-Mail-Empfang deaktiviert. Bitte versuchen Sie es mit einer privaten Nachricht.';
$lang['User_not_exist'] = 'Dieser Benutzer existiert nicht.';
$lang['CC_email'] = 'Ich möchte eine Kopie dieser E-Mail erhalten';
$lang['Email_message_desc'] = 'Diese Nachricht wird als Text versendet. Bitte verwenden Sie deshalb kein HTML oder BBCode. Als Antwort-Adresse der E-Mail wird Ihre E-Mail-Adresse angegeben.';
$lang['Flood_email_limit'] = 'Im Moment können Sie keine weiteren E-Mails versenden. Versuchen Sie es später noch einmal.';
$lang['Recipient'] = 'Empfänger';
$lang['Email_sent'] = 'E-Mail wurde gesendet';
$lang['Send_email'] = 'E-Mail senden';
$lang['Empty_subject_email'] = 'Sie müssen einen Titel für diese E-Mail angeben.';
$lang['Empty_message_email'] = 'Sie müssen einen Text zur E-Mail angeben.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Der eingegebene Bestätigungs-Code war nicht richtig';
$lang['Too_many_registers'] = 'Sie haben die zulässige Zahl von Registrierungs-Versuchen für diese Sitzung überschritten. Bitte versuchen Sie es später erneut.';
$lang['Confirm_code_impaired'] = 'Wenn Sie eine Sehschwäche haben oder aus einem anderen Grund den Code nicht lesen können, kontaktieren Sie bitte den %sAdministrator%s für Hilfe.';
$lang['Confirm_code'] = 'Bestätigungs-Code';
$lang['Confirm_code_explain'] = 'Gebe Sie den Code exakt so ein, wie Sie ihn sehen. Der Code unterscheidet zwischen Groß- und Kleinschreibung, die Null hat im Inneren einen schrägen Strich.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Sortierungs-Methode auswählen';
$lang['Sort'] = 'Sortieren';
$lang['Sort_Top_Ten'] = 'Top-Ten-Autoren';
$lang['Sort_Joined'] = 'Anmeldedatum';
$lang['Sort_Username'] = 'Benutzername';
$lang['Sort_Location'] = 'Ort';
$lang['Sort_Posts'] = 'Beiträge total';
$lang['Sort_Email'] = 'E-Mail';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Aufsteigend';
$lang['Sort_Descending'] = 'Absteigend';
$lang['Order'] = 'Ordnung';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Gruppen-Kontrolle';
$lang['Group_member_details'] = 'Details zur Gruppen-Mitgliedschaft';
$lang['Group_member_join'] = 'Der Gruppe beitreten';

$lang['Group_Information'] = 'Information';
$lang['Group_name'] = 'Name';
$lang['Group_description'] = 'Beschreibung';
$lang['Group_membership'] = 'Gruppen-Mitgliedschaft';
$lang['Group_Members'] = 'Gruppen-Mitglieder';
$lang['Group_Moderator'] = 'Gruppen-Moderatoren';
$lang['Pending_members'] = 'Wartende Mitglieder';

$lang['Group_type'] = 'Gruppentyp';
$lang['Group_open'] = 'Offene Gruppe';
$lang['Group_closed'] = 'Geschlossene Gruppe';
$lang['Group_hidden'] = 'Versteckte Gruppe';

$lang['Current_memberships'] = 'Aktuelle Mitgliedschaften';
$lang['Non_member_groups'] = 'Gruppen, in denen Sie nicht Mitglied sind';
$lang['Memberships_pending'] = 'Warten auf Mitgliedschaft';

$lang['No_groups_exist'] = 'Es existieren keine Gruppen';
$lang['Group_not_exist'] = 'Diese Gruppe existiert nicht';

$lang['Join_group'] = 'Gruppe beitreten';
$lang['No_group_members'] = 'Diese Gruppe hat keine Mitglieder.';
$lang['Group_hidden_members'] = 'Diese Gruppe ist versteckt, Sie können keine Mitgliedschaften anzeigen.';
$lang['No_pending_group_members'] = 'Diese Gruppe hat keine wartenden Mitglieder.';
$lang['Group_joined'] = 'Sie wurden erfolgreich bei dieser Gruppe angemeldet.<br />Sie werden benachrichtigt, sobald der Gruppenmoderator Ihre Mitgliedschaft akzeptiert hat.';
$lang['Group_request'] = 'Eine Anfrage zum Beitritt in diese Gruppe wurde erstellt.';
$lang['Group_approved'] = 'Ihre Anfrage wurde akzeptiert.';
$lang['Group_added'] = 'Sie sind dieser Gruppe beigetreten.';
$lang['Already_member_group'] = 'Sie sind bereits Mitglied dieser Gruppe.';
$lang['User_is_member_group'] = 'Dieser Benutzer ist bereits ein Mitglied dieser Gruppe.';
$lang['Group_type_updated'] = 'Der Gruppentyp wurde erfolgreich aktualisiert.';

$lang['Could_not_add_user'] = 'Die gewählte Gruppe existiert nicht.';
$lang['Could_not_anon_user'] = 'Ein anonymer Benutzer kann kein Gruppenmitglied werden.';

$lang['Confirm_unsub'] = 'Sind Sie sicher, dass Sie die Mitgliedschaft in dieser Gruppe beenden möchten?';
$lang['Confirm_unsub_pending'] = 'Ihre Anmeldung bei der Gruppe wurde noch nicht bestätigt. Möchten Sie wirklich austreten?';

$lang['Unsub_success'] = 'Sie wurden aus dieser Gruppe abgemeldet.';

$lang['Approve_selected'] = 'Ausgewählte akzeptieren';
$lang['Deny_selected'] = 'Ausgewählte löschen';
$lang['Not_logged_in'] = 'Sie müssen eingeloggt sein, um einer Gruppe beizutreten.';
$lang['Remove_selected'] = 'Ausgewählte entfernen';
$lang['Add_member'] = 'Mitglied hinzufügen';
$lang['Not_group_moderator'] = 'Sie sind nicht der Moderator dieser Gruppe. Daher können Sie diese Aktion nicht durchführen.';

$lang['Login_to_join'] = 'Einloggen, um Gruppe zu verwalten';
$lang['This_open_group'] = 'Dies ist eine offene Gruppe. Sie können eine Mitgliedschaft beantragen.';
$lang['This_closed_group'] = 'Dies ist eine geschlossene Gruppe. Es werden keine weiteren Mitglieder akzeptiert.';
$lang['This_hidden_group'] = 'Dies ist eine versteckte Gruppe, automatische Anmeldungen werden nicht akzeptiert.';
$lang['Member_this_group'] = 'Sie sind ein Mitglied dieser Gruppe.';
$lang['Pending_this_group'] = 'Sie warten auf eine Mitgliedschaft in dieser Gruppe.';
$lang['Are_group_moderator'] = 'Sie sind der Moderator dieser Gruppe.';
$lang['None'] = 'Keine';

$lang['Subscribe'] = 'Anmelden';
$lang['Unsubscribe'] = 'Abmelden';
$lang['View_Information'] = 'Information anzeigen';


//
// Search
//
$lang['Search_query'] = 'Suchabfrage';
$lang['Search_options'] = 'Suchoptionen';

$lang['Search_keywords'] = 'Nach Begriffen suchen';
$lang['Search_keywords_explain'] = 'Sie können <span class="underline">AND</span> benutzen, um Wörter zu definieren, die vorkommen müssen; <span class="underline">OR</span> können Sie benutzen für Wörter, die im Resultat sein können und <span class="underline">NOT</span> für Wörter, die im Ergebnis nicht vorkommen sollen. Das *-Zeichen können Sie als Platzhalter benutzen.';
$lang['Search_author'] = 'Nach Autor suchen';
$lang['Search_author_explain'] = 'Benutzen Sie das *-Zeichen als Platzhalter';

$lang['Search_for_any'] = 'Nach irgendeinem Wort suchen';
$lang['Search_for_all'] = 'Nach allen Wörtern suchen';
$lang['Search_title_msg'] = 'Titel und Text durchsuchen';
$lang['Search_msg_only'] = 'Nur Nachrichtentext durchsuchen';

$lang['Return_first'] = 'Die ersten '; // followed by xxx characters in a select box
$lang['characters_posts'] = 'Zeichen des Beitrags anzeigen';

$lang['Search_previous'] = 'Durchsuchen'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Sortieren nach';
$lang['Sort_Time'] = 'Zeit';
$lang['Sort_Post_Subject'] = 'Titel des Beitrags';
$lang['Sort_Topic_Title'] = 'Titel des Themas';
$lang['Sort_Author'] = 'Autor';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Ergebnis anzeigen als';
$lang['All_available'] = 'Alle';
$lang['No_searchable_forums'] = 'Sie haben nicht die Berechtigung, dieses Forum zu durchsuchen.';

$lang['No_search_match'] = 'Keine Beiträge entsprechen Ihren Kriterien.';
$lang['Found_search_match'] = 'Die Suche hat %d Ergebnis ergeben.'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Die Suche hat %d Ergebnisse ergeben.'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Sie können keine weitere Suche so schnell nach Ihrer letzten durchführen. Bitte versuchen Sie es in Kürze erneut.';

$lang['Close_window'] = 'Fenster schließen';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Ankündigungen können in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_sticky'] = 'Wichtige Nachrichten können in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_read'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu lesen.';
$lang['Sorry_auth_post'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu erstellen.';
$lang['Sorry_auth_reply'] = 'Nur %s haben die Berechtigung, in diesem Forum auf Beiträge zu antworten.';
$lang['Sorry_auth_edit'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu bearbeiten.';
$lang['Sorry_auth_delete'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu löschen.';
$lang['Sorry_auth_vote'] = 'In diesem Forum können sich nur %s an Abstimmungen beteiligen.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<span class="thick">anonyme Benutzer</span>';
$lang['Auth_Registered_Users'] = '<span class="thick">registrierte Benutzer</span>';
$lang['Auth_Users_granted_access'] = '<span class="thick">Benutzer mit speziellen Rechten</span>';
$lang['Auth_Moderators'] = '<span class="thick">Moderatoren</span>';
$lang['Auth_Administrators'] = '<span class="thick">Administratoren</span>';

$lang['Not_Moderator'] = 'Sie sind nicht Moderator dieses Forums.';
$lang['Not_Authorised'] = 'Nicht berechtigt';

$lang['You_been_banned'] = 'Sie wurden von diesem Forum verbannt.<br />Kontaktieren Sie den Administrator, um mehr Informationen zu erhalten.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Es sind kein registrierter und '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Es sind %d registrierte und ';
$lang['Reg_user_online'] = 'Es ist ein registrierter und '; // There are 5 Registered and
$lang['Hidden_users_zero_online'] = 'kein versteckter Benutzer online.'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d versteckte Benutzer online.'; // 6 Hidden users online
$lang['Hidden_user_online'] = 'ein versteckter Benutzer online.'; // 6 Hidden users online
$lang['Guest_users_online'] = 'Es sind %d Gäste online.';
$lang['Guest_users_zero_online'] = 'Es sind keine Gäste online.'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Es ist ein Gast online.';
$lang['No_users_browsing'] = 'Im Moment sind keine Benutzer im Forum.';

$lang['Online_explain'] = 'Diese Daten zeigen an, wer in den letzten 5 Minuten online war.';

$lang['Forum_Location'] = 'Welche Seite';
$lang['Last_updated'] = 'Zuletzt aktualisiert';

$lang['Forum_index'] = 'Forum-Index';
$lang['Logging_on'] = 'Einloggen';
$lang['Posting_message'] = 'Nachricht schreiben';
$lang['Searching_forums'] = 'Foren durchsuchen';
$lang['Viewing_profile'] = 'Profil anzeigen';
$lang['Viewing_online'] = 'Anzeigen, wer online ist';
$lang['Viewing_member_list'] = 'Mitgliederliste anzeigen';
$lang['Viewing_priv_msgs'] = 'Private Nachrichten anzeigen';
$lang['Viewing_FAQ'] = 'FAQ anzeigen';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Moderator Control Panel';
$lang['Mod_CP_explain'] = 'Mit dem unteren Menü können Sie mehrere Moderatoren-Operationen gleichzeitig ausführen. Sie können Beiträge öffnen, schließen, löschen oder verschieben.';

$lang['Select'] = 'Auswählen';
$lang['Delete'] = 'Löschen';
$lang['Move'] = 'Verschieben';
$lang['Lock'] = 'Sperren';
$lang['Unlock'] = 'Entsperren';

$lang['Topics_Removed'] = 'Die gewählten Themen wurden erfolgreich gelöscht.';
$lang['Topics_Locked'] = 'Die gewählten Themen wurden erfolgreich gesperrt.';
$lang['Topics_Moved'] = 'Die gewählten Themen wurden verschoben.';
$lang['Topics_Unlocked'] = 'Die gewählten Themen wurden entsperrt.';
$lang['No_Topics_Moved'] = 'Es wurden keine Themen verschoben.';

$lang['Confirm_delete_topic'] = 'Sind Sie sicher, dass die gewählten Themen entfernt werden sollen?';
$lang['Confirm_lock_topic'] = 'Sind Sie sicher, dass die gewählten Themen gesperrt werden sollen?';
$lang['Confirm_unlock_topic'] = 'Sind Sie sicher, dass die gewählten Themen entsperrt werden sollen?';
$lang['Confirm_move_topic'] = 'Sind Sie sicher, dass die gewählten Themen verschoben werden sollen?';

$lang['Move_to_forum'] = 'Verschieben nach';
$lang['Leave_shadow_topic'] = 'Shadow Topic im alten Forum lassen';

$lang['Split_Topic'] = 'Split Topic Control Panel';
$lang['Split_Topic_explain'] = 'Mit den Eingabefeldern unten können Sie ein Thema in zwei teilen, indem Sie entweder die Beiträge manuell auswählen oder ab einem gewählten Beitrag teilen';
$lang['Split_title'] = 'Titel des neuen Themas';
$lang['Split_forum'] = 'Forum des neuen Themas';
$lang['Split_posts'] = 'Gewählte Beiträge teilen';
$lang['Split_after'] = 'Ab gewähltem Beitrag teilen';
$lang['Topic_split'] = 'Das gewählte Thema wurde erfolgreich geteilt';

$lang['Too_many_error'] = 'Sie haben zu viele Beiträge ausgewählt. Sie können nur einen Beitrag auswählen, ab dem geteilt werden soll!';

$lang['None_selected'] = 'Sie haben keine Themen ausgewählt, auf denen diese Aktion ausgeführt werden soll. Bitte wählen Sie mindestens eines aus.';
$lang['New_forum'] = 'Neues Forum';

$lang['This_posts_IP'] = 'IP-Adresse für diesen Beitrag';
$lang['Other_IP_this_user'] = 'Andere IP-Adressen, von denen dieser Benutzer geschrieben hat';
$lang['Users_this_IP'] = 'Beiträge von dieser IP-Adresse';
$lang['IP_info'] = 'IP-Information';
$lang['Lookup_IP'] = 'IP nachschlagen';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Alle Zeiten sind %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Stunden';
$lang['-11'] = 'GMT - 11 Stunden';
$lang['-10'] = 'GMT - 10 Stunden';
$lang['-9'] = 'GMT - 9 Stunden';
$lang['-8'] = 'GMT - 8 Stunden';
$lang['-7'] = 'GMT - 7 Stunden';
$lang['-6'] = 'GMT - 6 Stunden';
$lang['-5'] = 'GMT - 5 Stunden';
$lang['-4'] = 'GMT - 4 Stunden';
$lang['-3.5'] = 'GMT - 3.5 Stunden';
$lang['-3'] = 'GMT - 3 Stunden';
$lang['-2'] = 'GMT - 2 Stunden';
$lang['-1'] = 'GMT - 1 Stunden';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Stunde';
$lang['2'] = 'GMT + 2 Stunden';
$lang['3'] = 'GMT + 3 Stunden';
$lang['3.5'] = 'GMT + 3.5 Stunden';
$lang['4'] = 'GMT + 4 Stunden';
$lang['4.5'] = 'GMT + 4.5 Stunden';
$lang['5'] = 'GMT + 5 Stunden';
$lang['5.5'] = 'GMT + 5.5 Stunden';
$lang['6'] = 'GMT + 6 Stunden';
$lang['6.5'] = 'GMT + 6.5 Stunden';
$lang['7'] = 'GMT + 7 Stunden';
$lang['8'] = 'GMT + 8 Stunden';
$lang['9'] = 'GMT + 9 Stunden';
$lang['9.5'] = 'GMT + 9.5 Stunden';
$lang['10'] = 'GMT + 10 Stunden';
$lang['11'] = 'GMT + 11 Stunden';
$lang['12'] = 'GMT + 12 Stunden';
$lang['13'] = 'GMT + 13 Stunden';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Stunden';
$lang['tz']['-11'] = 'GMT - 11 Stunden';
$lang['tz']['-10'] = 'GMT - 10 Stunden';
$lang['tz']['-9'] = 'GMT - 9 Stunden';
$lang['tz']['-8'] = 'GMT - 8 Stunden';
$lang['tz']['-7'] = 'GMT - 7 Stunden';
$lang['tz']['-6'] = 'GMT - 6 Stunden';
$lang['tz']['-5'] = 'GMT - 5 Stunden';
$lang['tz']['-4'] = 'GMT - 4 Stunden';
$lang['tz']['-3.5'] = 'GMT - 3.5 Stunden';
$lang['tz']['-3'] = 'GMT - 3 Stunden';
$lang['tz']['-2'] = 'GMT - 2 Stunden';
$lang['tz']['-1'] = 'GMT - 1 Stunden';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Stunde';
$lang['tz']['2'] = 'GMT + 2 Stunden';
$lang['tz']['3'] = 'GMT + 3 Stunden';
$lang['tz']['3.5'] = 'GMT + 3.5 Stunden';
$lang['tz']['4'] = 'GMT + 4 Stunden';
$lang['tz']['4.5'] = 'GMT + 4.5 Stunden';
$lang['tz']['5'] = 'GMT + 5 Stunden';
$lang['tz']['5.5'] = 'GMT + 5.5 Stunden';
$lang['tz']['6'] = 'GMT + 6 Stunden';
$lang['tz']['6.5'] = 'GMT + 6.5 Stunden';
$lang['tz']['7'] = 'GMT + 7 Stunden';
$lang['tz']['8'] = 'GMT + 8 Stunden';
$lang['tz']['9'] = 'GMT + 9 Stunden';
$lang['tz']['9.5'] = 'GMT + 9.5 Stunden';
$lang['tz']['10'] = 'GMT + 10 Stunden';
$lang['tz']['11'] = 'GMT + 11 Stunden';
$lang['tz']['12'] = 'GMT + 12 Stunden';
$lang['tz']['13'] = 'GMT + 13 Stunden';

$lang['datetime']['Sunday'] = 'Sonntag';
$lang['datetime']['Monday'] = 'Montag';
$lang['datetime']['Tuesday'] = 'Dienstag';
$lang['datetime']['Wednesday'] = 'Mittwoch';
$lang['datetime']['Thursday'] = 'Donnerstag';
$lang['datetime']['Friday'] = 'Freitag';
$lang['datetime']['Saturday'] = 'Samstag';
$lang['datetime']['Sun'] = 'So';
$lang['datetime']['Mon'] = 'Mo';
$lang['datetime']['Tue'] = 'Di';
$lang['datetime']['Wed'] = 'Mi';
$lang['datetime']['Thu'] = 'Do';
$lang['datetime']['Fri'] = 'Fr';
$lang['datetime']['Sat'] = 'Sa';
$lang['datetime']['January'] = 'Januar';
$lang['datetime']['February'] = 'Februar';
$lang['datetime']['March'] = 'März';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juni';
$lang['datetime']['July'] = 'Juli';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'Oktober';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'Dezember';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'März';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Okt';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dez';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Information';
$lang['Critical_Information'] = 'Kritische Information';

$lang['General_Error'] = 'Allgemeiner Fehler';
$lang['Critical_Error'] = 'Kritischer Fehler';
$lang['An_error_occured'] = 'Ein Fehler ist aufgetreten.';
$lang['A_critical_error'] = 'Ein kritischer Fehler ist aufgetreten.';

$lang['Admin_reauthenticate'] = 'Für den Zugriff auf den Administrations-Bereich müssen Sie Ihren Benutzernamen und Ihr Passwort erneut eingeben.';
$lang['Login_attempts_exceeded'] = 'Die maximale Anzahl von %s zulässigen Login-Versuchen wurde überschritten. Sie können sich in den nächsten %s Minuten nicht einloggen.';
$lang['Please_remove_install_contrib'] = 'Bitte stellen Sie sicher, dass Sie die Verzeichnisse install/ und contrib/ gelöscht haben.';
$lang['Session_invalid'] = 'Ungültige Session. Bitte das Formular nochmals übermitteln.';

// Quick Reply Mod
$lang['Quick_Reply'] = 'Quick Reply';
$lang['Quick_quote'] = 'Quote the last message';

// Profile modal pop-up about using YA to edit profile
$lang['Attention'] = 'Achtung';
$lang['Continue'] = 'Fortsetzen';
$lang['Go_Your_Account'] = 'Gehen Sie zu Ihrem Account';
$lang['YA_Warning'] = 'Ausser Sie laden ein Avatar hoch, sollten Sie %s benutzen, um ihr Profil zu editieren';

//+MOD: Start Advanced BBCode Box MOD vRN2.5.2
$lang['BBcode_box_view'] = 'Click to View Content';
//-MOD: Advanced BBCode Box MOD vRN2.5.2
//+MOD: Select Expand BBcodes MOD
$lang['Select'] = 'Select';
$lang['Expand'] = 'Expand';
$lang['Contract'] = 'Contract';
//-MOD: Select Expand BBcodes MOD

//
// That's all Folks!
// -------------------------------------------------

// Added by Attached Forums MOD
$lang['Attached_forum'] = 'SubForum';
$lang['Attached_forums'] = 'SubForums';
// End Added by Attached Forums MOD

?>
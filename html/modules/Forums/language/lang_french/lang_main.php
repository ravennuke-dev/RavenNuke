<?php
/***************************************************************************
 *                            lang_main.php [French]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php 6772 2006-12-16 13:11:28Z acydburn $
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
 *                         Translation: Informations
 *
 *   Version: 1.0.2
 *   Date: 05/04/2008 18:08:53
 *   Author: Xaphos (Maël Soucaze)
 *   Website: http://www.phpbb.fr/
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'utf-8';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'gauche';
$lang['RIGHT'] = 'droite';
$lang['DATE_FORMAT'] =  'D j M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = 'Translated by <a href="http://www.phpbb.fr/" class="copyright">phpBB.fr</a> © 2007, 2008 <a href="http://www.phpbb.fr/" class="copyright">phpBB.fr</a>';	// You can delete this line to remove the visible copyright of the translation, but the copyright localised in the files MUST BE preserved, according the General Public License!

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Catégorie';
$lang['Topic'] = 'Sujet';
$lang['Topics'] = 'Sujets';
$lang['Replies'] = 'Réponses';
$lang['Views'] = 'Vus';
$lang['Post'] = 'Message';
$lang['Posts'] = 'Messages';
$lang['Posted'] = 'Publié le';
$lang['Username'] = 'Nom d’utilisateur';
$lang['Password'] = 'Mot de passe';
$lang['Email'] = 'E-mail';
$lang['Poster'] = 'Rédacteur';
$lang['Author'] = 'Auteur';
$lang['Time'] = 'Temps';
$lang['Hours'] = 'Heures';
$lang['Message'] = 'Message';

$lang['1_Day'] = '1 jour';
$lang['7_Days'] = '7 jours';
$lang['2_Weeks'] = '2 semaines';
$lang['1_Month'] = '1 mois';
$lang['3_Months'] = '3 mois';
$lang['6_Months'] = '6 mois';
$lang['1_Year'] = '1 an';

$lang['Go'] = 'Aller';
$lang['Jump_to'] = 'Sauter vers';
$lang['Submit'] = 'Envoyer';
$lang['Reset'] = 'Réinitialiser';
$lang['Cancel'] = 'Annuler';
$lang['Preview'] = 'Aperçu';
$lang['Confirm'] = 'Confirmer';
$lang['Spellcheck'] = 'Vérification orthographique';
$lang['Yes'] = 'Oui';
$lang['No'] = 'Non';
$lang['Enabled'] = 'Activé';
$lang['Disabled'] = 'Désactivé';
$lang['Error'] = 'Erreur';

$lang['Next'] = 'Suivant';
$lang['Previous'] = 'Précédent';
$lang['Goto_page'] = 'Aller à la page';
$lang['Joined'] = 'Inscrit le';
$lang['IP_Address'] = 'Adresse IP';

$lang['Select_forum'] = 'Sélectionner un forum';
$lang['View_latest_post'] = 'Voir le dernier message';
$lang['View_newest_post'] = 'Voir le message le plus récent';
$lang['Page_of'] = 'Page <span class="thick">%d</span> sur <span class="thick">%d</span>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'Numéro ICQ';
$lang['AIM'] = 'Adresse AIM';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Index du forum';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Publier un nouveau sujet';
$lang['Reply_to_topic'] = 'Répondre au sujet';
$lang['Reply_with_quote'] = 'Répondre en citant';

$lang['Click_return_topic'] = 'Cliquez %sici%s afin de retourner au sujet'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Cliquez %sici%s afin de recommencer';
$lang['Click_return_forum'] = 'Cliquez %sici%s afin de retourner au forum';
$lang['Click_view_message'] = 'Cliquez %sici%s afin de voir le message que vous avez publié';
$lang['Click_return_modcp'] = 'Cliquez %sici%s afin de retourner au panneau de contrôle du modérateur';
$lang['Click_return_group'] = 'Cliquez %sici%s afin de retourner aux informations du groupe';

$lang['Admin_panel'] = 'Aller au panneau de contrôle de l’administrateur';

$lang['Board_disable'] = 'Désolé mais ce forum est actuellement indisponible, veuillez réessayer ultérieurement.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Utilisateurs inscrits :';
$lang['Browsing_forum'] = 'Utilisateurs parcourant actuellement ce forum :';
$lang['Online_users_zero_total'] = 'Au total, il y a <span class="thick">0</span> utilisateur en ligne :: ';
$lang['Online_users_total'] = 'Au total, il y a <span class="thick">%d</span> utilisateurs en ligne :: ';
$lang['Online_user_total'] = 'Au total, il y a <span class="thick">%d</span> utilisateur en ligne :: ';
$lang['Reg_users_zero_total'] = '0 inscrit, ';
$lang['Reg_users_total'] = '%d inscrits, ';
$lang['Reg_user_total'] = '%d inscrit, ';
$lang['Hidden_users_zero_total'] = '0 invisible et ';
$lang['Hidden_user_total'] = '%d invisible et ';
$lang['Hidden_users_total'] = '%d invisibles et ';
$lang['Guest_users_zero_total'] = '0 invité';
$lang['Guest_users_total'] = '%d invités';
$lang['Guest_user_total'] = '%d invité';
$lang['Record_online_users'] = 'Le nombre maximum d’utilisateurs en ligne simultanément a été de <span class="thick">%s</span> le %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrateur%s';
$lang['Mod_online_color'] = '%sModérateur%s';

$lang['You_last_visit'] = 'Dernière visite le : %s'; // %s replaced by date/time
$lang['Current_time'] = 'Nous sommes actuellement le %s'; // %s replaced by time

$lang['Search_new'] = 'Voir les messages depuis votre dernière visite';
$lang['Search_your_posts'] = 'Voir vos messages';
$lang['Search_unanswered'] = 'Voir les messages sans réponse';

$lang['Register'] = 'Inscription';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Éditer votre profil';
$lang['Search'] = 'Rechercher';
$lang['Memberlist'] = 'Liste des membres';
$lang['FAQ'] = 'FAQ';
$lang['BBCode_guide'] = 'Guide du BBCode';
$lang['Usergroups'] = 'Groupes d’utilisateurs';
$lang['Last_Post'] = 'Dernier message';
$lang['Moderator'] = 'Modérateur';
$lang['Moderators'] = 'Modérateurs';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Nos utilisateurs ont publiés un total de <span class="thick">0</span> message'; // Number of posts
$lang['Posted_articles_total'] = 'Nos utilisateurs ont publiés un total de <span class="thick">%d</span> messages'; // Number of posts
$lang['Posted_article_total'] = 'Nos utilisateurs ont publiés un total de <span class="thick">%d</span> message'; // Number of posts
$lang['Registered_users_zero_total'] = 'Nous avons <span class="thick">0</span> utilisateur inscrit'; // # registered users
$lang['Registered_users_total'] = 'Nous avons <span class="thick">%d</span> utilisateurs inscrits'; // # registered users
$lang['Registered_user_total'] = 'Nous avons <span class="thick">%d</span> utilisateur inscrit'; // # registered users
$lang['Newest_user'] = 'Le membre le plus récent est <span class="thick">%s%s%s</span>'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Il n’y a eu aucun nouveau message depuis votre dernière visite';
$lang['No_new_posts'] = 'Aucun nouveau message';
$lang['New_posts'] = 'Nouveaux messages';
$lang['New_post'] = 'Nouveau message';
$lang['No_new_posts_hot'] = 'Aucun nouveau message [ Populaire ]';
$lang['New_posts_hot'] = 'Nouveaux messages [ Populaire ]';
$lang['No_new_posts_locked'] = 'Aucun nouveau message [ Verrouillé ]';
$lang['New_posts_locked'] = 'Nouveaux messages [ Verrouillés ]';
$lang['Forum_is_locked'] = 'Le forum est verrouillé';


//
// Login
//
$lang['Enter_password'] = 'Veuillez saisir votre nom d’utilisateur et votre mot de passe afin de vous connecter.';
$lang['Login'] = 'Connexion';
$lang['Logout'] = 'Déconnexion';

$lang['Forgotten_password'] = 'J’ai perdu mon mot de passe';

$lang['Log_me_in'] = 'Me connecter automatiquement lors de chaque visite';

$lang['Error_login'] = 'Le nom d’utilisateur ou le mot de passe que vous avez spécifié est incorrect ou inactif.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Aucun message';
$lang['No_forums'] = 'Aucun forum';

$lang['Private_Message'] = 'Message privé';
$lang['Private_Messages'] = 'Messages privés';
$lang['Who_is_Online'] = 'Qui est en ligne ?';

$lang['Mark_all_forums'] = 'Marquer tous les forums comme lus';
$lang['Forums_marked_read'] = 'Tous les forums sont à présent marqués comme lus';


//
// Viewforum
//
$lang['View_forum'] = 'Voir le forum';

$lang['Forum_not_exist'] = 'Le forum que vous avez sélectionné n’existe pas.';
$lang['Reached_on_error'] = 'Vous avez atteint cette page par erreur.';

$lang['Display_topics'] = 'Afficher les sujets depuis';
$lang['All_Topics'] = 'Tous les sujets';

$lang['Topic_Announcement'] = '<span class="thick">Annonce :</span>';
$lang['Topic_Sticky'] = '<span class="thick">Note :</span>';
$lang['Topic_Moved'] = '<span class="thick">Déplacé :</span>';
$lang['Topic_Poll'] = '<span class="thick">[ Sondage ]</span>';

$lang['Mark_all_topics'] = 'Marquer tous les sujets comme lus';
$lang['Topics_marked_read'] = 'Tous les sujets de ce forum sont à présent marqués comme lus';

$lang['Rules_post_can'] = 'Vous <span class="thick">pouvez</span> publier de nouveaux messages dans ce forum';
$lang['Rules_post_cannot'] = 'Vous <span class="thick">ne pouvez pas</span> publier de nouveaux messages dans ce forum';
$lang['Rules_reply_can'] = 'Vous <span class="thick">pouvez</span> répondre aux sujets dans ce forum';
$lang['Rules_reply_cannot'] = 'Vous <span class="thick">ne pouvez pas</span> répondre aux sujets dans ce forum';
$lang['Rules_edit_can'] = 'Vous <span class="thick">pouvez</span> éditer vos messages dans ce forum';
$lang['Rules_edit_cannot'] = 'Vous <span class="thick">ne pouvez pas</span> éditer vos messages dans ce forum';
$lang['Rules_delete_can'] = 'Vous <span class="thick">pouvez</span> supprimer vos messages dans ce forum';
$lang['Rules_delete_cannot'] = 'Vous <span class="thick">ne pouvez pas</span> supprimer vos messages dans ce forum';
$lang['Rules_vote_can'] = 'Vous <span class="thick">pouvez</span> voter dans les sondages de ce forum';
$lang['Rules_vote_cannot'] = 'Vous <span class="thick">ne pouvez pas</span> voter dans les sondages de ce forum';
$lang['Rules_moderate'] = 'Vous <span class="thick">pouvez</span> %smodérer ce forum%s'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'Il n’y a aucun message dans ce forum.<br />Cliquez sur le bouton <span class="thick">Publier un nouveau sujet</span> afin d’en publier un.';


//
// Viewtopic
//
$lang['View_topic'] = 'Voir le sujet';

$lang['Guest'] = 'Invité';
$lang['Post_subject'] = 'Titre du sujet';
$lang['View_next_topic'] = 'Voir le sujet suivant';
$lang['View_previous_topic'] = 'Voir le sujet précédent';
$lang['Submit_vote'] = 'Envoyer le vote';
$lang['View_results'] = 'Voir les résultats';

$lang['No_newer_topics'] = 'Il n’y a aucun nouveau sujet dans ce forum';
$lang['No_older_topics'] = 'Il n’y a aucun ancien sujet dans ce forum';
$lang['Topic_post_not_exist'] = 'Le sujet ou le message que vous recherchez n’existe pas';
$lang['No_posts_topic'] = 'Il n’y a aucun message dans ce sujet';

$lang['Display_posts'] = 'Afficher les messages depuis';
$lang['All_Posts'] = 'Tous les messages';
$lang['Newest_First'] = 'Le plus récent d’abord';
$lang['Oldest_First'] = 'Le plus récent d’abord';

$lang['Back_to_top'] = 'Revenir en haut';

$lang['Read_profile'] = 'Voir le profil de l’utilisateur';
$lang['Visit_website'] = 'Visiter le site Internet du rédacteur';
$lang['ICQ_status'] = 'Statut ICQ';
$lang['Edit_delete_post'] = 'Éditer/Supprimer ce message';
$lang['View_IP'] = 'Voir l’adresse IP du rédacteur';
$lang['Delete_post'] = 'Supprimer ce message';

$lang['wrote'] = 'a écrit'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Citer'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'Dernière édition par %s le %s ; édité %d fois au total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Dernière édition par %s le %s ; édité %d fois au total'; // Last edited by me on 12 Oct 2001; edited 2 times in total

$lang['Lock_topic'] = 'Verrouiller ce sujet';
$lang['Unlock_topic'] = 'Déverrouiller ce sujet';
$lang['Move_topic'] = 'Déplacer ce sujet';
$lang['Delete_topic'] = 'Supprimer ce sujet';
$lang['Split_topic'] = 'Diviser ce sujet';

$lang['Stop_watching_topic'] = 'Ne plus surveiller ce sujet';
$lang['Start_watching_topic'] = 'Surveiller les réponses de ce sujet';
$lang['No_longer_watching'] = 'Vous ne surveillez plus ce sujet';
$lang['You_are_watching'] = 'Vous surveillez à présent ce sujet';

$lang['Total_votes'] = 'Total des votes';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Corps du message';
$lang['Topic_review'] = 'Aperçu du sujet';

$lang['No_post_mode'] = 'Aucun mode n’a été spécifié pour ce message'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Publier un nouveau sujet';
$lang['Post_a_reply'] = 'Publier une réponse';
$lang['Post_topic_as'] = 'Publier le sujet en tant que';
$lang['Edit_Post'] = 'Éditer le message';
$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Annonce';
$lang['Post_Sticky'] = 'Note';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Êtes-vous sûr de vouloir supprimer ce message ?';
$lang['Confirm_delete_poll'] = 'Êtes-vous sûr de vouloir supprimer ce sondage ?';

$lang['Flood_Error'] = 'Vous ne pouvez pas publier un message aussitôt après en avoir publié un. Veuillez réessayer dans un court moment.';
$lang['Empty_subject'] = 'Vous devez spécifier un titre lorsque vous souhaitez publier un sujet.';
$lang['Empty_message'] = 'Vous devez saisir un message lorsque vous souhaitez publier.';
$lang['Forum_locked'] = 'Ce forum est verrouillé : vous ne pouvez ni publier de messages, ni publier de réponses et ni éditer de sujets.';
$lang['Topic_locked'] = 'Ce sujet est verrouillé : vous ne pouvez ni éditer de messages et ni publier de réponses.';
$lang['No_post_id'] = 'Vous devez sélectionner un message à éditer';
$lang['No_topic_id'] = 'Vous devez sélectionner un sujet afin d’y répondre';
$lang['No_valid_mode'] = 'Vous ne pouvez que publier, répondre, éditer ou citer des messages. Veuillez essayer à nouveau.';
$lang['No_such_post'] = 'Il n’y a aucun message de ce type. Veuillez essayer à nouveau.';
$lang['Edit_own_posts'] = 'Désolé mais vous ne pouvez éditer que vos propres messages.';
$lang['Delete_own_posts'] = 'Désolé mais vous ne pouvez supprimer que vos propres messages.';
$lang['Cannot_delete_replied'] = 'Désolé mais vous ne pouvez pas supprimer des messages ayant eu des réponses.';
$lang['Cannot_delete_poll'] = 'Désolé mais vous ne pouvez pas supprimer un sondage en cours.';
$lang['Empty_poll_title'] = 'Vous devez saisir le titre du sondage.';
$lang['To_few_poll_options'] = 'Vous devez spécifier au moins deux options afin d’ajouter un sondage.';
$lang['To_many_poll_options'] = 'Vous avez spécifié un trop grand nombre d’options.';
$lang['Post_has_no_poll'] = 'Ce message ne contient aucun sondage.';
$lang['Already_voted'] = 'Vous avez déjà voté dans ce sondage.';
$lang['No_vote_option'] = 'Vous devez spécifier une option afin de voter.';

$lang['Add_poll'] = 'Ajouter un sondage';
$lang['Add_poll_explain'] = 'Laissez ces champs vides si vous ne souhaitez pas créer de sondage.';
$lang['Poll_question'] = 'Question du sondage';
$lang['Poll_option'] = 'Option du sondage';
$lang['Add_option'] = 'Ajouter l’option';
$lang['Update'] = 'Mettre à jour';
$lang['Delete'] = 'Supprimer';
$lang['Poll_for'] = 'Durée du sondage';
$lang['Days'] = 'jours'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Saisissez 0 ou laissez vide afin de ne jamais terminer le sondage ]';
$lang['Delete_poll'] = 'Supprimer le sondage';

$lang['Disable_HTML_post'] = 'Désactiver l’HTML dans ce message';
$lang['Disable_BBCode_post'] = 'Désactiver le BBCode dans ce message';
$lang['Disable_Smilies_post'] = 'Désactiver les émoticônes dans ce message';

$lang['HTML_is_ON'] = 'L’HTML est <span class="underline">activé</span>';
$lang['HTML_is_OFF'] = 'L’HTML est <span class="underline">désactivé</span>';
$lang['BBCode_is_ON'] = 'Le %sBBCode%s est <span class="underline">activé</span>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = 'Le %sBBCode%s est <span class="underline">désactivé</span>';
$lang['Smilies_are_ON'] = 'Les émoticônes sont <span class="underline">activées</span>';
$lang['Smilies_are_OFF'] = 'Les émoticônes sont <span class="underline">désactivées</span>';

$lang['Attach_signature'] = 'Insérer une signature (la signature peut être modifiée dans le profil)';
$lang['Notify'] = 'M’avertir lorsque des réponses ont été publiées';

$lang['Stored'] = 'Votre message a été saisi avec succès.';
$lang['Deleted'] = 'Votre message a été supprimé avec succès.';
$lang['Poll_delete'] = 'Votre sondage a été supprimé avec succès.';
$lang['Vote_cast'] = 'Votre vote a bien été pris en compte.';

$lang['Topic_reply_notification'] = 'Avertissement des réponses du sujet';

$lang['bbcode_b_help'] = 'Texte en gras : [b]texte[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Texte en italique : [i]texte[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Souligner un texte : [u]texte[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Citer un texte : [quote]texte[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Affichage de code : [code]code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste : [list]texte[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Liste ordonnée : [list=]texte[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Insérer une image : [img]http://lien_de_l_image[/img] (alt+p)';
$lang['bbcode_w_help'] = 'Insérer un lien : [url]http://lien[/url] ou [url=http://url]texte du lien[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Fermer toutes les balises BBCode ouvertes';
$lang['bbcode_s_help'] = 'Couleur du texte : [color=red]texte[/color] ou [color=#FF0000]texte[/color]';
$lang['bbcode_f_help'] = 'Taille du texte : [size=x-small]petit texte[/size]';

$lang['Emoticons'] = 'Émoticônes';
$lang['More_emoticons'] = 'Voir plus d’émoticônes';

$lang['Font_color'] = 'Couleur du texte';
$lang['color_default'] = 'Défaut';
$lang['color_dark_red'] = 'Rouge foncé';
$lang['color_red'] = 'Rouge';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Marron';
$lang['color_yellow'] = 'Jaune';
$lang['color_green'] = 'Vert';
$lang['color_olive'] = 'Vert olive';
$lang['color_cyan'] = 'Bleu cyan';
$lang['color_blue'] = 'Bleu';
$lang['color_dark_blue'] = 'Bleu foncé';
$lang['color_indigo'] = 'Violet indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'Blanc';
$lang['color_black'] = 'Noir';

$lang['Font_size'] = 'Taille du texte';
$lang['font_tiny'] = 'Minuscule';
$lang['font_small'] = 'Petite';
$lang['font_normal'] = 'Normale';
$lang['font_large'] = 'Grande';
$lang['font_huge'] = 'Énorme';

$lang['Close_Tags'] = 'Fermer les balises';
$lang['Styles_tip'] = 'Astuce : des styles peut être rapidement appliqués au texte sélectionné.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Messagerie privée';

$lang['Login_check_pm'] = 'Se connecter afin de vérifier vos messages privés';
$lang['New_pms'] = 'Vous avez %d nouveaux messages'; // You have 2 new messages
$lang['New_pm'] = 'Vous avez %d nouveau message'; // You have 1 new message
$lang['No_new_pm'] = 'Vous n’avez aucun nouveau message';
$lang['Unread_pms'] = 'Vous avez %d messages non-lus';
$lang['Unread_pm'] = 'Vous avez %d message non-lu';
$lang['No_unread_pm'] = 'Vous n’avez aucun message non-lu';
$lang['You_new_pm'] = 'Un nouveau message vous attend dans votre boîte de réception';
$lang['You_new_pms'] = 'De nouveaux messages vous attendent dans votre boîte de réception';
$lang['You_no_new_pm'] = 'Aucun nouveau message ne vous attend dans votre boîte de réception';

$lang['Unread_message'] = 'Message non-lu';
$lang['Read_message'] = 'Message lu';

$lang['Read_pm'] = 'Lire le message';
$lang['Post_new_pm'] = 'Publier le message';
$lang['Post_reply_pm'] = 'Répondre au message';
$lang['Post_quote_pm'] = 'Citer le message';
$lang['Edit_pm'] = 'Éditer le message';

$lang['Inbox'] = 'Boîte de réception';
$lang['Outbox'] = 'Boîte d’envoi';
$lang['Savebox'] = 'Archives';
$lang['Sentbox'] = 'Messages envoyés';
$lang['Flag'] = 'Drapeau';
$lang['Subject'] = 'Sujet';
$lang['From'] = 'De';
$lang['To'] = 'À';
$lang['Date'] = 'Date';
$lang['Mark'] = 'Sélectionner';
$lang['Sent'] = 'Envoyer';
$lang['Saved'] = 'Archivé';
$lang['Delete_marked'] = 'Supprimer la sélection';
$lang['Delete_all'] = 'Tout supprimer';
$lang['Save_marked'] = 'Archiver la sélection';
$lang['Save_message'] = 'Archiver le message';
$lang['Delete_message'] = 'Supprimer le message';

$lang['Display_messages'] = 'Afficher les messages depuis'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Tous les messages';

$lang['No_messages_folder'] = 'Vous n’avez aucun message dans ce dossier';

$lang['PM_disabled'] = 'La messagerie privée a été désactivée sur ce forum.';
$lang['Cannot_send_privmsg'] = 'Désolé mais l’administrateur vous empêche d’envoyer des messages privés.';
$lang['No_to_user'] = 'Vous devez spécifier un nom d’utilisateur à qui envoyer le message.';
$lang['No_such_user'] = 'Désolé mais cet utilisateur n’existe pas.';

$lang['Disable_HTML_pm'] = 'Désactiver l’HTML dans ce message';
$lang['Disable_BBCode_pm'] = 'Désactiver le BBCode dans ce message';
$lang['Disable_Smilies_pm'] = 'Désactiver les émoticônes dans ce message';

$lang['Message_sent'] = 'Votre message a été envoyé avec succès.';

$lang['Click_return_inbox'] = 'Cliquez %sici%s afin de retourner à votre boîte de réception';
$lang['Click_return_index'] = 'Cliquez %sici%s afin de retourner à l’index';

$lang['Send_a_new_message'] = 'Envoyer un nouveau message privé';
$lang['Send_a_reply'] = 'Répondre au message privé';
$lang['Edit_message'] = 'Éditer le message privé';

$lang['Notification_subject'] = 'Un nouveau message privé est arrivé !';

$lang['Find_username'] = 'Trouver un nom d’utilisateur';
$lang['Find'] = 'Trouver';
$lang['No_match'] = 'Aucun résultat n’a été trouvé.';

$lang['No_post_id'] = 'L’identification du message n’a pas été spécifiée';
$lang['No_such_folder'] = 'Le dossier n’existe pas';
$lang['No_folder'] = 'Aucun dossier n’a été spécifié';

$lang['Mark_all'] = 'Tout sélectionner';
$lang['Unmark_all'] = 'Tout désélectionner';

$lang['Confirm_delete_pm'] = 'Êtes-vous sûr de vouloir ce message ?';
$lang['Confirm_delete_pms'] = 'Êtes-vous sûr de supprimer ces messages ?';

$lang['Inbox_size'] = 'Votre boîte de réception est pleine à %d%%'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Votre boîte d’envoi est pleine à %d%%';
$lang['Savebox_size'] = 'Vos archives sont pleines à %d%%';

$lang['Click_view_privmsg'] = 'Cliquez %sici%s afin d’atteindre votre boîte de réception';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Consulte le profil :: %s'; // %s is username
$lang['About_user'] = 'Tout à propos de %s'; // %s is username

$lang['Preferences'] = 'Préférences';
$lang['Items_required'] = 'Les champs marqués par * sont obligatoires.';
$lang['Registration_info'] = 'Inscription';
$lang['Profile_info'] = 'Profil';
$lang['Profile_info_warn'] = 'Ces informations seront visibles publiquement';
$lang['Avatar_panel'] = 'Panneau de contrôle des avatars';
$lang['Avatar_gallery'] = 'Galerie d’avatars';

$lang['Website'] = 'Site Internet';
$lang['Location'] = 'Localisation';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'Adresse e-mail';
$lang['Send_private_message'] = 'Envoyer un message privé';
$lang['Hidden_email'] = '[ Invisible ]';
$lang['Interests'] = 'Loisirs';
$lang['Occupation'] = 'Emploi';
$lang['Poster_rank'] = 'Rang du rédacteur';

$lang['Total_posts'] = 'Messages au total';
$lang['User_post_pct_stats'] = '%.2f%% du total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f messages par jour'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Trouver tous les messages de %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'Désolé mais cet utilisateur n’existe pas.';
$lang['Wrong_Profile'] = 'Vous ne pouvez pas modifier un profil qui n’est pas le vôtre.';

$lang['Only_one_avatar'] = 'Seul un type d’avatar peut être spécifié';
$lang['File_no_data'] = 'Le fichier du lien que vous avez spécifié ne contient aucune donnée';
$lang['No_connection_URL'] = 'Une connexion ne peut être établie avec le lien que vous avez spécifié';
$lang['Incomplete_URL'] = 'Le lien que vous avez spécifié est incomplet';
$lang['Wrong_remote_avatar_format'] = 'Le lien de l’avatar à distance que vous avez spécifié est incorrect';
$lang['No_send_account_inactive'] = 'Désolé mais votre mot de passe ne peut être renouvelé car votre compte est actuellement inactif. Pour plus d’informations, veuillez contacter l’administrateur du forum.';

$lang['Always_smile'] = 'Toujours activer les émoticônes';
$lang['Always_html'] = 'Toujours activer l’HTML';
$lang['Always_bbcode'] = 'Toujours activer le BBCode';
$lang['Always_add_sig'] = 'Toujours insérer ma signature';
$lang['Always_notify'] = 'Toujours m’avertir toujours des réponses';
$lang['Always_notify_explain'] = 'Envoie un e-mail lorsque quelqu’un répond à un sujet que vous avez publié. Cela peut être modifié à chaque fois que vous publiez un message.';

$lang['Board_style'] = 'Style du forum';
$lang['Board_lang'] = 'Langue du forum';
$lang['No_themes'] = 'Aucun thème n’est présent dans la base de données';
$lang['Timezone'] = 'Fuseau horaire';
$lang['Date_format'] = 'Format de la date';
$lang['Date_format_explain'] = 'La syntaxe utilisée est identique à la fonction PHP <a href=\'http://www.php.net/date\' target=\'_blank\'>date()</a>.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'Ceci est un bloc de texte qui peut être ajouté aux messages que vous publiez. Il est limité à %d caractères';
$lang['Public_view_email'] = 'Toujours afficher mon adresse e-mail';

$lang['Current_password'] = 'Mot de passe actuel';
$lang['New_password'] = 'Nouveau mot de passe';
$lang['Confirm_password'] = 'Confirmer le mot de passe';
$lang['Confirm_password_explain'] = 'Vous devez confirmer votre mot de passe actuel si vous souhaitez modifiez votre adresse e-mail ou votre mot de passe';
$lang['password_if_changed'] = 'Vous ne devez fournir un mot de passe que si vous souhaitez le modifier';
$lang['password_confirm_if_changed'] = 'Vous ne devez confirmer le mot de passe que si vous l’avez modifié ci-dessus';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Affiche une petite image sous les informations relatives aux messages. Seule une image peut être affichée. Sa largeur ne doit pas dépasser %d pixels, sa hauteur ne soit pas dépasser %d pixels et la taille du fichier ne doit pas dépasser %d Ko.';
$lang['Upload_Avatar_file'] = 'Transférer un avatar à partir de votre ordinateur';
$lang['Upload_Avatar_URL'] = 'Transférer un avatar à partir d’un lien';
$lang['Upload_Avatar_URL_explain'] = 'Saisissez le lien de l’endroit contenant l’image. Elle sera copiée sur ce site.';
$lang['Pick_local_Avatar'] = 'Sélectionner un avatar à partir de la galerie';
$lang['Link_remote_Avatar'] = 'Lien vers l’image à distance';
$lang['Link_remote_Avatar_explain'] = 'Saisissez le lien de l’endroit contenant l’image que vous souhaitez utiliser.';
$lang['Avatar_URL'] = 'Lien de l’image';
$lang['Select_from_gallery'] = 'Sélectionner un avatar à partir de la galerie';
$lang['View_avatar_gallery'] = 'Afficher la galerie';

$lang['Select_avatar'] = 'Sélectionner l’avatar';
$lang['Return_profile'] = 'Annuler l’avatar';
$lang['Select_category'] = 'Sélectionner la catégorie';

$lang['Delete_Image'] = 'Supprimer l’image';
$lang['Current_Image'] = 'Image actuelle';

$lang['Notify_on_privmsg'] = 'M’avertir des nouveaux messages privés';
$lang['Popup_on_privmsg'] = 'Afficher une fenêtre pop-up lors de nouveaux messages privés';
$lang['Popup_on_privmsg_explain'] = 'Certains templates peuvent ouvrir une nouvelle fenêtre afin de vous informer de l’arrivée d’un nouveau message privé.';
$lang['Hide_user'] = 'Masquer mon statut en ligne';

$lang['Profile_updated'] = 'Votre profil a été mis à jour avec succès';
$lang['Profile_updated_inactive'] = 'Votre profil a été mis à jour avec succès. Cependant, vous avez modifié des informations importantes. Par conséquence, votre compte est à présent inactif. Vérifiez vos e-mail et réactivez votre compte. Si une activation par l’administrateur est exigée, veuillez patienter le temps qu’il le réactive.';

$lang['Password_mismatch'] = 'Les mots de passe que vous avez spécifiés ne concordent pas.';
$lang['Current_password_mismatch'] = 'Le mot de passe actuel que vous avez spécifié ne correspond pas à celui qui est stocké dans la base de données.';
$lang['Password_long'] = 'Votre mot de passe ne doit pas dépasser 32 caractères.';
$lang['Username_taken'] = 'Désolé mais ce nom d’utilisateur est déjà utilisé.';
$lang['Username_invalid'] = 'Désolé mais ce nom d’utilisateur contient un ou des caractères incorrects.';
$lang['Username_disallowed'] = 'Désolé mais ce nom d’utilisateur a été interdit.';
$lang['Email_taken'] = 'Désolé mais cette adresse e-mail est déjà utilisée par un autre utilisateur.';
$lang['Email_banned'] = 'Désolé mais cette adresse e-mail a été bannie.';
$lang['Email_invalid'] = 'Désolé mais cette adresse e-mail est incorrecte.';
$lang['Signature_too_long'] = 'Votre signature est trop longue.';
$lang['Fields_empty'] = 'Vous devez remplir les champs obligatoires.';
$lang['Avatar_filetype'] = 'Le type de fichier de l’avatar doit être JPEG, GIF ou PNG';
$lang['Avatar_filesize'] = 'La taille de l’avatar ne doit pas dépasser %d Ko'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'Les dimensions de l’avatar ne doivent pas dépasser %d pixels de large et %d pixels de haut';

$lang['Welcome_subject'] = 'Bienvenue sur les forums de %s'; // Welcome to my.com forums
$lang['New_account_subject'] = 'Nouveau compte utilisateur';
$lang['Account_activated_subject'] = 'Compte activé';

$lang['Account_added'] = 'Nous vous remercions de votre inscription. Votre compte a été créé avec succès. Vous pouvez dès à présent vous connecter en utilisant votre nom d’utilisateur et votre mot de passe';
$lang['Account_inactive'] = 'Votre compte a été créé avec succès. Cependant, vous devez activer votre compte. Une clé d’activation a été envoyée à l’adresse e-mail que vous avez fournie. Pour plus d’informations, veuillez vérifier vos e-mail';
$lang['Account_inactive_admin'] = 'Votre compte a été créé avec succès. Cependant, l’administrateur du forum doit activer votre compte. Un e-mail vous sera envoyé lorsque l’activation de votre compte sera effective';
$lang['Account_active'] = 'Votre compte est à présent activé. Nous vous remercions de votre inscription';
$lang['Account_active_admin'] = 'Le compte est à présent activé';
$lang['Reactivate'] = 'Réactivez votre compte !';
$lang['Already_activated'] = 'Vous avez déjà activé votre compte';
$lang['COPPA'] = 'Votre compte a été créé avec succès mais il nécessite d’être approuvé. Pour plus d’informations, veuillez vérifier vos e-mail.';

$lang['Registration'] = 'Conditions d’inscription';
$lang['Reg_agreement'] = 'Lorsque les administrateurs et les modérateurs de ce forum essaieront de supprimer ou d’éditer des messages répréhensibles aussi rapidement que possible, il faut être conscient qu’il sera impossible de vérifier tous les messages. Vous devez accepter alors le fait que l’administrateur et les modérateurs de ce forum ne peuvent être tenus comme responsables, mis à part de leurs propres messages.<br /><br />Vous consentez au fait de ne publier aucun contenu à caractère abusif, obscène, vulgaire, scandaleux, diffamatoire, menaçant, pornographique ou tout autre message qui violeraient les lois appliquées à votre pays. Si cela n’est pas respecté, vous serez alors banni immédiatement et définitivement. Votre Fournisseur d’Accès à Internet en sera également informé. Les adresses IP de tous les messages publiés sont enregistrées afin de lutter contre ce genre d’abus. Vous consentez au fait que l’administrateur et les modérateurs du forum puissent supprimer, éditer, déplacer ou verrouiller chaque sujet et message en toute liberté. En tant qu’utilisateur vous acceptez le fait que toutes les informations saisies ci-dessus sont stockées dans une base de données. Cependant, ces informations sont strictement réservées à ce site et elles ne seront pas dévoilées à un site de tierce-partie sans votre consentement. L’administrateur et les modérateurs du forum ne peuvent être tenus comme responsables si une tentative ou un acte de piratage a lieu sur votre compte, ce qui rendra les informations compromises.<br /><br />Ce système de forum utilise des cookies afin de stocker des informations sur votre ordinateur. Ces cookies ne contiennent pas les informations que vous avez saisies ci-dessus ; ils ne servent qu’à améliorer votre navigation. L’adresse e-mail n’est utilisée que pour confirmer les informations de votre inscription et pour votre mot de passe (l’envoi d’un nouveau mot de passe, par exemple).<br /><br />En vous inscrivant, vous acceptez de respecter toutes ces conditions.';

$lang['Agree_under_13'] = 'J’accepte ces conditions et j’ai <span class="thick">moins</span> de 13 ans';
$lang['Agree_over_13'] = 'J’accepte ces conditions et j’ai <span class="thick">plus</span> de 13 ans';
$lang['Agree_not'] = 'Je refuse ces conditions';

$lang['Wrong_activation'] = 'La clé d’activation que vous avez fournie n’existe pas dans la base de données.';
$lang['Send_password'] = 'M’envoyer un nouveau mot de passe';
$lang['Password_updated'] = 'Un nouveau mot de passe a été créé avec succès. Pour plus d’informations, veuillez consulter vos e-mail.';
$lang['No_email_match'] = 'L’adresse e-mail que vous avez fournie ne correspond pas à ce nom d’utilisateur.';
$lang['New_password_activation'] = 'Activation du nouveau mot de passe';
$lang['Password_activated'] = 'Votre compte a été réactivé avec succès. Pour vous connecter, veuillez utiliser le mot de passe fourni dans l’e-mail que vous avez reçu.';

$lang['Send_email_msg'] = 'Envoyer un e-mail';
$lang['No_user_specified'] = 'Aucun utilisateur n’a été spécifié';
$lang['User_prevent_email'] = 'Cet utilisateur ne souhaite recevoir aucun e-mail. Veuillez essayer de lui envoyer un message privé.';
$lang['User_not_exist'] = 'Cet utilisateur n’existe pas';
$lang['CC_email'] = 'M’envoyer une copie de cet e-mail';
$lang['Email_message_desc'] = 'Ce message sera envoyé en texte brut, veuillez n’y inclure aucun HTML ou BBCode. L’adresse de retour de ce message sera votre adresse e-mail.';
$lang['Flood_email_limit'] = 'Vous ne pouvez pas envoyer d’e-mail actuellement. Veuillez réessayer ultérieurement.';
$lang['Recipient'] = 'Destinataire';
$lang['Email_sent'] = 'L’e-mail a été envoyé avec succès.';
$lang['Send_email'] = 'Envoyer un e-mail';
$lang['Empty_subject_email'] = 'Vous devez spécifier le titre de l’e-mail.';
$lang['Empty_message_email'] = 'Vous devez saisir un message afin d’envoyer un e-mail.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Le code de confirmation que vous avez saisi est incorrect';
$lang['Too_many_registers'] = 'Vous avez dépassé le nombre de tentative d’inscription pour cette session. Veuillez réessayer ultérieurement.';
$lang['Confirm_code_impaired'] = 'Veuillez contacter l’%sadministrateur du forum%s si vous êtes visuellement déficient ou que vous éprouvez des difficultés à lire ce code correctement.';
$lang['Confirm_code'] = 'Code de confirmation';
$lang['Confirm_code_explain'] = 'Veuillez saisir le code exactement comme il apparaît. Celui-ci n’est pas sensible à la casse et le zéro comporte une barre diagonale.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Sélectionner une méthode de tri';
$lang['Sort'] = 'Tri';
$lang['Sort_Top_Ten'] = 'Dix meilleurs rédacteurs';
$lang['Sort_Joined'] = 'Date d’inscription';
$lang['Sort_Username'] = 'Nom d’utilisateur';
$lang['Sort_Location'] = 'Localisation';
$lang['Sort_Posts'] = 'Messages au total';
$lang['Sort_Email'] = 'E-mail';
$lang['Sort_Website'] = 'Site Internet';
$lang['Sort_Ascending'] = 'Croissant';
$lang['Sort_Descending'] = 'Décroissant';
$lang['Order'] = 'Ordre';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Panneau de contrôle des groupes';
$lang['Group_member_details'] = 'Informations sur les adhérents du groupe';
$lang['Group_member_join'] = 'Adhérer à un groupe';

$lang['Group_Information'] = 'Informations sur le groupe';
$lang['Group_name'] = 'Nom du groupe';
$lang['Group_description'] = 'Description du groupe';
$lang['Group_membership'] = 'Adhérer au groupe';
$lang['Group_Members'] = 'Membres du groupe';
$lang['Group_Moderator'] = 'Responsable du groupe';
$lang['Pending_members'] = 'Membres en attente';

$lang['Group_type'] = 'Type du groupe';
$lang['Group_open'] = 'Groupe ouvert';
$lang['Group_closed'] = 'Groupe fermé';
$lang['Group_hidden'] = 'Groupe invisible';

$lang['Current_memberships'] = 'Adhérents actuels';
$lang['Non_member_groups'] = 'Non-membre du groupe';
$lang['Memberships_pending'] = 'Adhérents en attente';

$lang['No_groups_exist'] = 'Aucun groupe n’existe';
$lang['Group_not_exist'] = 'Ce groupe d’utilisateurs n’existe pas';

$lang['Join_group'] = 'Adhérer au groupe';
$lang['No_group_members'] = 'Ce groupe d’utilisateurs n’a aucun membre';
$lang['Group_hidden_members'] = 'Ceci est un groupe invisible ; vous ne pouvez pas voir ses adhérents';
$lang['No_pending_group_members'] = 'Ce groupe d’utilisateurs n’a aucun membre en attente';
$lang['Group_joined'] = 'Votre demande à adhérer ce groupe d’utilisateurs a bien été prise en compte.<br />Vous serez averti lorsque votre adhésion sera approuvée par le responsable du groupe.';
$lang['Group_request'] = 'Votre demande à adhérer ce groupe d’utilisateurs a bien été prise en compte.';
$lang['Group_approved'] = 'Votre demande a été approuvée.';
$lang['Group_added'] = 'Vous avez été ajouté à ce groupe d’utilisateurs avec succès.';
$lang['Already_member_group'] = 'Vous êtes déjà un membre de ce groupe d’utilisateurs';
$lang['User_is_member_group'] = 'L’utilisateur est déjà un membre de ce groupe d’utilisateurs';
$lang['Group_type_updated'] = 'Le type du groupe d’utilisateurs a été mis à jour avec succès.';

$lang['Could_not_add_user'] = 'L’utilisateur que vous avez sélectionné n’existe pas.';
$lang['Could_not_anon_user'] = 'Un utilisateur anonyme ne peut pas adhérer à un groupe d’utilisateurs.';

$lang['Confirm_unsub'] = 'Êtes-vous sûr de vouloir vous désinscrire de ce groupe d’utilisateurs ?';
$lang['Confirm_unsub_pending'] = 'Votre inscription à ce groupe d’utilisateurs n’a pas encore été approuvée. Êtes-vous sûr de vouloir vous désinscrire ?';

$lang['Unsub_success'] = 'Vous avez été désinscrit de ce groupe d’utilisateurs avec succès.';

$lang['Approve_selected'] = 'Approuver la sélection';
$lang['Deny_selected'] = 'Désapprouver la sélection';
$lang['Not_logged_in'] = 'Vous devez être inscrit afin d’adhérer à ce groupe d’utilisateurs.';
$lang['Remove_selected'] = 'Supprimer la sélection';
$lang['Add_member'] = 'Ajouter le membre';
$lang['Not_group_moderator'] = 'Vous n’êtes pas le responsable de ce groupe d’utilisateurs. Par conséquence, vous ne pouvez pas réaliser cette action.';

$lang['Login_to_join'] = 'Vous connecter afin d’adhérer ou de gérer ce groupe d’utilisateurs';
$lang['This_open_group'] = 'Ceci est un groupe ouvert ; cliquez afin de réaliser une demande d’adhésion';
$lang['This_closed_group'] = 'Ceci est un groupe fermé ; aucun utilisateur ne peut le rejoindre';
$lang['This_hidden_group'] = 'Ceci est un groupe invisible ; seul le responsable du groupe peut ajouter des membres';
$lang['Member_this_group'] = 'Vous n’êtes pas un membre de ce groupe';
$lang['Pending_this_group'] = 'Votre adhésion à ce groupe d’utilisateurs est en attente';
$lang['Are_group_moderator'] = 'Vous êtes le responsable de ce groupe d’utilisateurs';
$lang['None'] = 'Aucun';

$lang['Subscribe'] = 'Inscription';
$lang['Unsubscribe'] = 'Désinscription';
$lang['View_Information'] = 'Voir les informations';


//
// Search
//
$lang['Search_query'] = 'Rechercher';
$lang['Search_options'] = 'Options de la recherche';

$lang['Search_keywords'] = 'Rechercher par mot-clé';
$lang['Search_keywords_explain'] = 'Vous pouvez utiliser <span class="underline">AND</span> afin de déterminer les mots qui doivent apparaître dans les résultats, <span class="underline">OR</span> afin de déterminer les mots qui peuvent apparaître dans les résultats et <span class="underline">NOT</span> afin de déterminer les mots qui ne doivent pas apparaître dans les résultats. Utilisez * comme joker pour des recherches partielles';
$lang['Search_author'] = 'Rechercher par auteur';
$lang['Search_author_explain'] = 'Utilisez * comme joker pour des recherches partielles';

$lang['Search_for_any'] = 'Rechercher n’importe quels de ces termes ou utiliser une question comme entrée';
$lang['Search_for_all'] = 'Rechercher pour tous les termes';
$lang['Search_title_msg'] = 'Rechercher dans les titres des sujets et les messages';
$lang['Search_msg_only'] = 'Rechercher dans les messages uniquement';

$lang['Return_first'] = 'Retourner les'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'caractères de messages';

$lang['Search_previous'] = 'Rechercher depuis'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Trier par';
$lang['Sort_Time'] = 'Heure du message';
$lang['Sort_Post_Subject'] = 'Sujet du message';
$lang['Sort_Topic_Title'] = 'Titre du sujet';
$lang['Sort_Author'] = 'Auteur';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Afficher les résultats sous forme de';
$lang['All_available'] = 'Tous disponibles';
$lang['No_searchable_forums'] = 'Vous ne pouvez pas rechercher un forum sur ce site.';

$lang['No_search_match'] = 'Aucun sujet ou message ne correspond à votre critère de recherche';
$lang['Found_search_match'] = 'La recherche a retourné %d résultat'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'La recherche a retourné %d résultats'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Vous ne pouvez pas effectuer une recherche aussitôt après en avoir effectué une. Veuillez réessayer ultérieurement.';

$lang['Close_window'] = 'Fermer la fenêtre';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Désolé mais seul %s peut publier des annonces dans ce forum.';
$lang['Sorry_auth_sticky'] = 'Désolé mais seul %s peut publier des notes dans ce forum.';
$lang['Sorry_auth_read'] = 'Désolé mais seul %s peut lire les sujets de ce forum.';
$lang['Sorry_auth_post'] = 'Désolé mais seul %s peut publier des sujets dans ce forum.';
$lang['Sorry_auth_reply'] = 'Désolé mais seul %s peut répondre aux messages de ce forum.';
$lang['Sorry_auth_edit'] = 'Désolé mais seul %s peut éditer des messages de ce forum.';
$lang['Sorry_auth_delete'] = 'Désolé mais seul %s peut supprimer des messages de ce forum.';
$lang['Sorry_auth_vote'] = 'Désolé mais seul %s peut voter aux sondages de ce forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<span class="thick">utilisateurs anonymes</span>';
$lang['Auth_Registered_Users'] = '<span class="thick">utilisateurs inscrits</span>';
$lang['Auth_Users_granted_access'] = '<span class="thick">utilisateurs ayant un accès spécial</span>';
$lang['Auth_Moderators'] = '<span class="thick">modérateurs</span>';
$lang['Auth_Administrators'] = '<span class="thick">administrateurs</span>';

$lang['Not_Moderator'] = 'Vous n’êtes pas un modérateur de ce forum.';
$lang['Not_Authorised'] = 'Accès interdit';

$lang['You_been_banned'] = 'Vous avez été banni de ce forum.<br />Pour plus d’informations, veuillez contacter l’administrateur du forum.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Il y a 0 utilisateur inscrit et '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Il y a %d utilisateurs inscrits et '; // There are 5 Registered and
$lang['Reg_user_online'] = 'Il y a %d utilisateur inscrit et '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d utilisateurs invisibles en ligne'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Guest_users_online'] = 'Il y a %d invités en ligne'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'Il y a 0 invité en ligne'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Il y a %d invité en ligne'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'Il n’y a aucun utilisateur parcourant actuellement le forum';

$lang['Online_explain'] = 'Ces données sont basées sur les utilisateurs actifs des cinq dernières minutes';

$lang['Forum_Location'] = 'Localisation du forum';
$lang['Last_updated'] = 'Dernière mise à jour';

$lang['Forum_index'] = 'Index du forum';
$lang['Logging_on'] = 'Se connecter';
$lang['Posting_message'] = 'Publie un message';
$lang['Searching_forums'] = 'Effectue une recherche';
$lang['Viewing_profile'] = 'Consulte un profil';
$lang['Viewing_online'] = 'Consulte qui est en ligne';
$lang['Viewing_member_list'] = 'Consulte la liste des membres';
$lang['Viewing_priv_msgs'] = 'Consulter ses messages privés';
$lang['Viewing_FAQ'] = 'Consulte la FAQ';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Panneau de contrôle du modérateur';
$lang['Mod_CP_explain'] = 'En utilisant ce formulaire, vous pouvez réaliser de nombreuses opérations de modération sur ce forum. Vous pouvez verrouiller, déverrouiller, déplacer ou supprimer les sujets et les messages.';

$lang['Select'] = 'Sélectionner';
$lang['Delete'] = 'Supprimer';
$lang['Move'] = 'Déplacer';
$lang['Lock'] = 'Verrouiller';
$lang['Unlock'] = 'Déverrouiller';

$lang['Topics_Removed'] = 'Les sujets que vous avez sélectionnés ont été supprimés de la base de données avec succès.';
$lang['Topics_Locked'] = 'Les sujets que vous avez sélectionnés ont été verrouillés avec succès.';
$lang['Topics_Moved'] = 'Les sujets que vous avez sélectionnés ont été déplacés avec succès.';
$lang['Topics_Unlocked'] = 'Les sujets que vous avez sélectionnés ont été déverrouillés avec succès.';
$lang['No_Topics_Moved'] = 'Aucun sujet n’a été déplacé.';

$lang['Confirm_delete_topic'] = 'Êtes-vous sûr de vouloir supprimer le(s) sujet(s) sélectionné(s) ?';
$lang['Confirm_lock_topic'] = 'Êtes-vous sûr de vouloir verrouiller le(s) sujet(s) sélectionné(s) ?';
$lang['Confirm_unlock_topic'] = 'Êtes-vous sûr de vouloir déverrouiller le(s) sujet(s) sélectionné(s) ?';
$lang['Confirm_move_topic'] = 'Êtes-vous sûr de vouloir déplacer le(s) sujet(s) sélectionné(s) ?';

$lang['Move_to_forum'] = 'Déplacer dans le forum';
$lang['Leave_shadow_topic'] = 'Laisser un clone sur place.';

$lang['Split_Topic'] = 'Panneau de contrôle de division de sujets';
$lang['Split_Topic_explain'] = 'En utilisant le formulaire ci-dessous, vous pouvez diviser un sujet en deux en sélectionnant individuellement les messages à diviser ou en divisant à partir d’un message sélectionné';
$lang['Split_title'] = 'Titre du nouveau sujet';
$lang['Split_forum'] = 'Forum du nouveau sujet';
$lang['Split_posts'] = 'Diviser les messages sélectionnés';
$lang['Split_after'] = 'Diviser à partir d’un message sélectionné';
$lang['Topic_split'] = 'Le sujet que vous avez sélectionné a été divisé avec succès';

$lang['Too_many_error'] = 'Vous avez sélectionné un trop grand nombre de sujets. Vous ne pouvez sélectionner qu’un seul message de ce sujet à diviser !';

$lang['None_selected'] = 'Vous n’avez sélectionné aucun message à diviser. Veuillez en sélectionner au moins un.';
$lang['New_forum'] = 'Nouveau forum';

$lang['This_posts_IP'] = 'Adresse IP de ce message';
$lang['Other_IP_this_user'] = 'Autres adresses IP utilisées par le rédacteur';
$lang['Users_this_IP'] = 'Utilisateurs ayant publiés à partir de cette adresse IP';
$lang['IP_info'] = 'Informations sur l’IP';
$lang['Lookup_IP'] = 'Rechercher une adresse IP';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Heures au format %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 heures';
$lang['-11'] = 'GMT - 11 heures';
$lang['-10'] = 'GMT - 10 heures';
$lang['-9'] = 'GMT - 9 heures';
$lang['-8'] = 'GMT - 8 heures';
$lang['-7'] = 'GMT - 7 heures';
$lang['-6'] = 'GMT - 6 heures';
$lang['-5'] = 'GMT - 5 heures';
$lang['-4'] = 'GMT - 4 heures';
$lang['-3.5'] = 'GMT - 3.5 heures';
$lang['-3'] = 'GMT - 3 heures';
$lang['-2'] = 'GMT - 2 heures';
$lang['-1'] = 'GMT - 1 heure';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 heure';
$lang['2'] = 'GMT + 2 heures';
$lang['3'] = 'GMT + 3 heures';
$lang['3.5'] = 'GMT + 3.5 heures';
$lang['4'] = 'GMT + 4 heures';
$lang['4.5'] = 'GMT + 4.5 heures';
$lang['5'] = 'GMT + 5 heures';
$lang['5.5'] = 'GMT + 5.5 heures';
$lang['6'] = 'GMT + 6 heures';
$lang['6.5'] = 'GMT + 6.5 heures';
$lang['7'] = 'GMT + 7 heures';
$lang['8'] = 'GMT + 8 heures';
$lang['9'] = 'GMT + 9 heures';
$lang['9.5'] = 'GMT + 9.5 heures';
$lang['10'] = 'GMT + 10 heures';
$lang['11'] = 'GMT + 11 heures';
$lang['12'] = 'GMT + 12 heures';
$lang['13'] = 'GMT + 13 heures';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 heures';
$lang['tz']['-11'] = 'GMT - 11 heures';
$lang['tz']['-10'] = 'GMT - 10 heures';
$lang['tz']['-9'] = 'GMT - 9 heures';
$lang['tz']['-8'] = 'GMT - 8 heures';
$lang['tz']['-7'] = 'GMT - 7 heures';
$lang['tz']['-6'] = 'GMT - 6 heures';
$lang['tz']['-5'] = 'GMT - 5 heures';
$lang['tz']['-4'] = 'GMT - 4 heures';
$lang['tz']['-3.5'] = 'GMT - 3.5 heures';
$lang['tz']['-3'] = 'GMT - 3 heures';
$lang['tz']['-2'] = 'GMT - 2 heures';
$lang['tz']['-1'] = 'GMT - 1 heure';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 heure';
$lang['tz']['2'] = 'GMT + 2 heures';
$lang['tz']['3'] = 'GMT + 3 heures';
$lang['tz']['3.5'] = 'GMT + 3.5 heures';
$lang['tz']['4'] = 'GMT + 4 heures';
$lang['tz']['4.5'] = 'GMT + 4.5 heures';
$lang['tz']['5'] = 'GMT + 5 heures';
$lang['tz']['5.5'] = 'GMT + 5.5 heures';
$lang['tz']['6'] = 'GMT + 6 heures';
$lang['tz']['6.5'] = 'GMT + 6.5 heures';
$lang['tz']['7'] = 'GMT + 7 heures';
$lang['tz']['8'] = 'GMT + 8 heures';
$lang['tz']['9'] = 'GMT + 9 heures';
$lang['tz']['9.5'] = 'GMT + 9.5 heures';
$lang['tz']['10'] = 'GMT + 10 heures';
$lang['tz']['11'] = 'GMT + 11 heures';
$lang['tz']['12'] = 'GMT + 12 heures';
$lang['tz']['13'] = 'GMT + 13 heures';

$lang['datetime']['Sunday'] = 'Dimanche';
$lang['datetime']['Monday'] = 'Lundi';
$lang['datetime']['Tuesday'] = 'Mardi';
$lang['datetime']['Wednesday'] = 'Mercredi';
$lang['datetime']['Thursday'] = 'Jeudi';
$lang['datetime']['Friday'] = 'Vendredi';
$lang['datetime']['Saturday'] = 'Samedi';
$lang['datetime']['Sun'] = 'Dim';
$lang['datetime']['Mon'] = 'Lun';
$lang['datetime']['Tue'] = 'Mar';
$lang['datetime']['Wed'] = 'Mer';
$lang['datetime']['Thu'] = 'Jeu';
$lang['datetime']['Fri'] = 'Ven';
$lang['datetime']['Sat'] = 'Sam';
$lang['datetime']['January'] = 'Janvier';
$lang['datetime']['February'] = 'Février';
$lang['datetime']['March'] = 'Mars';
$lang['datetime']['April'] = 'Avril';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juin';
$lang['datetime']['July'] = 'Juillet';
$lang['datetime']['August'] = 'Août';
$lang['datetime']['September'] = 'Septembre';
$lang['datetime']['October'] = 'Octobre';
$lang['datetime']['November'] = 'Novembre';
$lang['datetime']['December'] = 'Décembre';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Fev';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Avr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Juin';
$lang['datetime']['Jul'] = 'Juil';
$lang['datetime']['Aug'] = 'Aoû';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Déc';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Informations';
$lang['Critical_Information'] = 'Informations critiques';

$lang['General_Error'] = 'Erreur générale';
$lang['Critical_Error'] = 'Erreur critique';
$lang['An_error_occured'] = 'Une erreur est survenue';
$lang['A_critical_error'] = 'Une erreur critique est survenue';

$lang['Admin_reauthenticate'] = 'Pour administrer le forum, vous devez vous authentifier de nouveau.';
$lang['Login_attempts_exceeded'] = 'Vous avez dépassé le nombre maximum de tentative de connexion réglé à %s. Vous n’êtes plus autorisé à vous connecter durant les %s prochaines minutes.';
$lang['Please_remove_install_contrib'] = 'Veuillez vous assurer de supprimer les répertoires install/ et contrib/';
$lang['Session_invalid'] = 'Session incorrecte. Veuillez renvoyer le formulaire.';

// Quick Reply Mod
$lang['Quick_Reply'] = 'Quick Reply';
$lang['Quick_quote'] = 'Quote the last message';

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

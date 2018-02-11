<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Traduction française : Stefvar
* http://www.stefvar.com
************************************************************************/
/*************************************************************************
* All attempts are made to place defines into the Function and Section
* on the screen where it is used as well as in the order of placement on
* the screen reading left-to-right and then top-down.  In cases where a
* define is used on multiple screens, it may only be defined once, so the
* first Function/Section: will have the define in it.
************************************************************************/
/************************************************************************
* Function: Common Use Defines
************************************************************************/
define('_MSNL_COM_LAB_SQL', 'SQL');
define('_MSNL_COM_LAB_GOBACK', 'RETOUR');
define('_MSNL_COM_LAB_ERRMSG', 'MESSAGE D\'ERREUR');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Passez votre curseur sur l\'icône pour plus de détails '
	. 'help text');
define('_MSNL_COM_LNK_GOBACK', 'Cliquer pour retourner à la page précédente');
define('_MSNL_COM_ERR_SQL', 'ERREUR PRODUITE DANS LE SQL ');
define('_MSNL_COM_ERR_MODULE', 'ERREUR DANS LE MODULE');
define('_MSNL_COM_ERR_VALMSG', 'LES CHAMPS SUIVANTS ONT ECHOUE A LA VALIDATION ');
define('_MSNL_COM_ERR_VALWARNMSG', 'LES CHAMPS SUIVANTS ONT EU DES AVERTISSEMENTS ');
define('_MSNL_COM_ERR_DBGETCFG', 'N\'a pu obtenir les informations de configuration du module!');
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Oui, c\'est comme il est fait!');
/************************************************************************
* Function: General Use Defines
************************************************************************/
define('_MSNL_COM_LAB_MODULENAME', 'HTML Newsletter');
define('_MSNL_LAB_ADMIN', 'Administration');
//Module Menu Labels and Link Titles
define('_MSNL_LAB_CREATENL', 'Créer un lettre');
define('_MSNL_LAB_MAINCFG', 'Configuration');
define('_MSNL_LAB_CATEGORYCFG', 'Configuration des catégories');
define('_MSNL_LAB_MAINTAINNLS', 'Maintenance');
define('_MSNL_LAB_SENDTESTED', 'Envoyer le test');
define('_MSNL_LAB_SITEADMIN', 'Administration du site');
define('_MSNL_LAB_NLARCHIVES', 'Archives');
define('_MSNL_LAB_NLDOCS', 'Documentation en ligne');
define('_MSNL_LNK_CREATENL', 'Créer un lettre d\'information');
define('_MSNL_LNK_MAINCFG', 'Configuration des options');
define('_MSNL_LNK_CATEGORYCFG', 'Gestion des catégories de lettre d\'information');
define('_MSNL_LNK_MAINTAINNLS', 'Gestion des lettres d\'information existantes');
define('_MSNL_LNK_SENDTESTED', 'Envoyer le dernier test de lettre d\'information');
define('_MSNL_LNK_SITEADMIN', 'Aller à l\'administration du site');
define('_MSNL_LNK_NLARCHIVES', 'Aller aux archives de lettres d\'information');
define('_MSNL_LNK_NLDOCS', 'Aller à la documentation en ligne du module');
define('_MSNL_ERR_NOTAUTHORIZED', 'Vous n\'avez pas l\'autorisation nécessaire pour administrer ce module');
//Common use Defines
define('_MSNL_COM_LAB_ACTIONS', 'Actions');
define('_MSNL_COM_LAB_ACTIVE', 'Active');
define('_MSNL_COM_LAB_ADD', 'AJOUTER');
define('_MSNL_COM_LAB_ALL', 'TOUT');
define('_MSNL_COM_LAB_GO', 'VALIDER');
define('_MSNL_COM_LAB_INACTIVE', 'Inactive');
define('_MSNL_COM_LAB_LANG', 'Language');
define('_MSNL_COM_LAB_NO', 'Non');
define('_MSNL_COM_LAB_PREVIEW', 'Prévisualisation');
define('_MSNL_COM_LAB_SAVE', 'SAUVEGARDER');
define('_MSNL_COM_LAB_SHOW_ALL', '**Tout afficher**');
define('_MSNL_COM_LAB_SEND', 'Envoyer');
define('_MSNL_COM_LAB_VERSION', 'Version');
define('_MSNL_COM_LAB_YES', 'Oui');
define('_MSNL_COM_LNK_ADD', 'Cliquer pour ajouter les données ci-dessus ');
define('_MSNL_COM_LNK_CANCEL', 'Annuler la transaction');
define('_MSNL_COM_LNK_CONTINUE', 'Continuer la transaction ');
define('_MSNL_COM_LNK_SAVE', 'Cliquer pour sauvegarder tous les changements');
define('_MSNL_COM_LNK_SEND', 'Envoyer la lettre d\'information');
define('_MSNL_COM_LNK_PREVIEW', 'Valider et prévisualiser le lettre');
define('_MSNL_COM_ERR_MSG', 'ERREUR MSG');
define('_MSNL_COM_ERR_DBGETCATS', 'Echec d\'obtention des catégories de lettre d\'information');
define('_MSNL_COM_ERR_FILENOTEXIST', 'Ce fichier n\'existe pas');
define('_MSNL_COM_ERR_FILENOTWRITEABLE', 'Was unable to write the newsletter file - Check that permissions on the archive directory are set to 777');
define('_MSNL_COM_ERR_DBGETPHPBB', 'Impossible d\'obtenir les information de configuration du forum PHPBB');
define('_MSNL_COM_ERR_DBGETRECIPIENTS', 'Impossible d\'obtenir le nombre de destinataire pour :');
define('_MSNL_COM_MSG_WARNING', 'Attention !');
define('_MSNL_COM_MSG_UPDSUCCESS', 'Mise à jour effectuée !');
define('_MSNL_COM_MSG_ADDSUCCESS', 'Ajout effectué !');
define('_MSNL_COM_MSG_DELSUCCESS', 'Supression effectuée!');
define('_MSNL_COM_MSG_REQUIRED', 'Ce champ exige une valeur');
define('_MSNL_COM_MSG_POSNONZEROINT', 'Requier une valeur différente de zéro');
define('_MSNL_COM_HLP_ACTIONS', 'Passez le curseur sur les icônes ci-dessous pour voir ce que l\'action va donner.');
// For the visual copyright
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'Voir copyright et credits');
/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/
//Section: Letter
define('_MSNL_ADM_LAB_LETTER', 'Lettre');
define('_MSNL_ADM_LAB_TOPIC', 'Sujet');
define('_MSNL_ADM_LAB_SENDER', 'Nom de l\'expéditeur');
define('_MSNL_ADM_LAB_NLSCAT', 'Categorie');
define('_MSNL_ADM_LAB_TEXTBODY', 'Texte de la lettre');
define('_MSNL_ADM_LAB_HTMLOK', '(Les tags HTML sont autorisés)');
define('_MSNL_ADM_HLP_TOPIC', 'Ce texte remplace le tag {EMAILTOPIC} dans le template choisi.  Ce tag est habituellement sur une seule ligne, il est souhaitable qu\'il ne soit pas trop long - 40 caractères ou moins.');
define('_MSNL_ADM_HLP_SENDER', 'Ce texte remplace le tag {SENDER} dans le template choisi.  Ce tag est habituellement sur une seule ligne, il est recommandé qu\'il soit cout et personnel - moins de 20 caractères.');
define('_MSNL_ADM_HLP_NLSCAT', 'Choisissez simplement la catégorie où placer la lettre d\'information.  Les catégories de lettres d\'information peuvent être utilisées pour organiser des sujets spécifiques.  Les lettres d\'information inscritent dans des catégories spécifiques via le menu d\'administration.');
define('_MSNL_ADM_HLP_TEXTBODY', 'C\'est l\'emplacement principal du texte de votre lettre d\'information. Il peut être préférable d\'écrire au préalable votre texte dans un éditeur HTML afin d\'avoir une prévisualisation, puis de le copier ensuite dans cet emplacement. Ce texte remplacera le tag {TEXTBODY} dans le template choisi.<br /><br /> Les tags HTML sont généralement laissés, mais il est préférable de n\'utiliser que les plus courant pour une meilleure compatibilité avec les lecteurs de courriel des destinatiares de la lettre. Pour de long texte vous pouvez marquer des sections en <span class="thick">gras</span> pour plus de lisibilité. <br /><br />Les tags HTML les plus courant emplyés sont : & lt;br& gt; & lt;b& gt; & lt;i& gt; & lt;u& gt;.');
//Section: Templates
define('_MSNL_ADM_LAB_TEMPLATES', 'Mises en page');
define('_MSNL_ADM_LAB_CHOOSETMPLT', 'Choisissez une mise en page');
define('_MSNL_ADM_LNK_SHOWTEMPLATE', 'Cliquez pour voir un apperçu de la mise en page');
define('_MSNL_ADM_HLP_TEMPLATES', 'La liste ci-dessous correspond à l\'ensemble de mises en page présentent dans le répertoire modules/HTML_Newsletter/templates/. Si vous choisissez d\'envoyer votre lettre d\'information en choisissant <span class="thick">no template</span>, seul le texte écrit plus haut apparaîtra dans votre lettre.<br /><br />Pour créer une lettre avec une mise en forme, sélectionnez en une parmis la liste ci-dessous. Vous pouvez avoir un apperçu de cette mise en page en cliquant sur le petit icône citué à droite du nom de la mise en page.<br /><br />Vous pouvez créer vos propre mise en page en choisissant comme modèle <span class="thick">Fancy_Content</span> ce dernier étant le seul modèle créé par le créateur du module.');
//Section: Stats and Newsletter Contents
define('_MSNL_ADM_LAB_STATS', 'Statistiques et contenu');
define('_MSNL_ADM_LAB_INCLSTATS', 'Inclure les statistiques du site');
define('_MSNL_ADM_LAB_INCLTOC', 'Inclure le menu du contenu');
define('_MSNL_ADM_HLP_INCLSTATS', 'La validation de cette option inclura les statistiques principales de votre site. Elle remplacera le tag {STATS} dans la mise en page choisie. Voir les échantillons de mise en page ci-dessus pour vous donner une idée des statistiques affichés.');
define('_MSNL_ADM_HLP_INCLTOC', 'La validation de cette option inclura un menu sous forme de bloc avec des liens pour les différentes rubriques de votre lettre d\'information. Voir les échantillons de mise en page ci-dessus pour vous donner une idée du menu affiché.');
//Section: Include Latest Items
define('_MSNL_ADM_LAB_INCLLATEST', 'Inclure les derniers :');
define('_MSNL_ADM_LAB_INCLLATESTDLS', 'Derniers téléchargements');
define('_MSNL_ADM_LAB_INCLLATESTWLS', 'Derniers liens');
define('_MSNL_ADM_LAB_INCLLATESTFORS', 'Derniers messages');
define('_MSNL_ADM_LAB_INCLLATESTNEWS', 'Derniers articles');
define('_MSNL_ADM_LAB_INCLLATESTREVS', 'Derniers comptes rendus');
define('_MSNL_ADM_HLP_INCLLATESTNEWS', 'Définit le nombre des derniers articles à afficher dans votre lettre d\'information. Les articles seront classés du plus récent au plus ancien. Utilisez une valeur <span class="thick">0</span> pour ne pas inclure les derniers articles dans votre lettre d\'information. Vous pourrez modifier cette option à tout moment lors de la prévisualisation de votre lettre.');
define('_MSNL_ADM_HLP_INCLLATESTDLS', 'Définit le nombre des derniers téléchargements à afficher dans votre lettre d\'information. Les téléchargements seront classés du plus récent au plus ancien. Utilisez une valeur <span class="thick">0</span> pour ne pas inclure les derniers téléchargements dans votre lettre d\'information. Vous pourrez modifier cette option à tout moment lors de la prévisualisation de votre lettre.');
define('_MSNL_ADM_HLP_INCLLATESTWLS', 'Définit le nombre des derniers liens à afficher dans votre lettre d\'information. Les liens seront classés du plus récent au plus ancien. Utilisez une valeur <span class="thick">0</span> pour ne pas inclure les derniers liens dans votre lettre d\'information. Vous pourrez modifier cette option à tout moment lors de la prévisualisation de votre lettre.');
define('_MSNL_ADM_HLP_INCLLATESTFORS', 'Définit le nombre des derniers messages des forums à afficher dans votre lettre d\'information. Les messages seront classés du plus récent au plus ancien. Utilisez une valeur <span class="thick">0</span> pour ne pas inclure les derniers messages des forums dans votre lettre d\'information. Vous pourrez modifier cette option à tout moment lors de la prévisualisation de votre lettre. En outre, seuls les messages autorisés en lecture aux visiteurs seront affichés');
define('_MSNL_ADM_HLP_INCLLATESTREVS', 'Définit le nombre des derniers comptes rendus à afficher dans votre lettre d\'information. Les comptes rendus seront classés du plus récent au plus ancien. Utilisez une valeur <span class="thick">0</span> pour ne pas inclure les derniers comptes rendus dans votre lettre d\'information. Vous pourrez modifier cette option à tout moment lors de la prévisualisation de votre lettre.');
//Section: Sponsors
define('_MSNL_ADM_LAB_SPONSORS', 'Sponsors');
define('_MSNL_ADM_LAB_CHOOSESPONSOR', 'Choisissez un sponsor');
define('_MSNL_ADM_LAB_NOSPONSOR', 'Pas de sponsor');
define('_MSNL_ADM_HLP_CHOOSESPONSOR', 'Le choix d\'un sponsor remplacera la bannière du site par celle choisie. Ce choix remplacera le tag {BANNER} dans la mise en page choisie.');
define('_MSNL_ADM_ERR_DBGETBANNERS', 'Echec de l\'obtention d\'information sur la bannière du commanditaire');
//Section: Who to Send the Newsletter To
define('_MSNL_ADM_LAB_WHOSNDTO', 'A qui voulez vous envoyer la lettre ?');
define('_MSNL_ADM_LAB_CHOOSESENDTO', 'Choisissez l\'option correspondante :');
define('_MSNL_ADM_LAB_WHOSNDTONLSUBS', 'Aux abonnés de la lettre seulement');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG', 'Tous les membres enregistrés');
define('_MSNL_ADM_LAB_WHOSNDTOPAID', 'Abonnés payants seulement');
define('_MSNL_ADM_LAB_WHOSNDTOANONY', 'Tous les visiteurs du site - Pas de mail envoyé mais tous les visiteurs pourront voir la lettre');
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS', 'Un ou plusieurs NSN Groups - choisissez le(s) groupe(s) plus bas');
define('_MSNL_ADM_LAB_WHOSNDTOADM', 'Test email (à l\'Admin seulement)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS', 'utilistaeurs abonnés');
define('_MSNL_ADM_LAB_USERS', 'Utilisateurs');
define('_MSNL_ADM_LAB_PAIDUSRS', 'abonnés payants');
define('_MSNL_ADM_LAB_NSNGRPUSRS', 'Utilisateur NSN Group');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC', 'Liste de distributeur de mails');
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)');
define('_MSNL_ADM_LAB_WHOSNDTOANONYV', 'Tous les visiteurs du site');
define('_MSNL_ADM_HLP_WHOSNDTONLSUBS', 'Le choix de cette option enverra la lettre d\'information à tous les utilisateurs qui ont souscrit à la lettre d\'information de votre site.');
define('_MSNL_ADM_HLP_WHOSNDTOALLREG', 'Le choix de cette option enverra la lettre d\'informations à tous les utilisateurs inscrit sur votre site. Attention en utilisant cette option car certains de vos utilisateurs risquent de ne pas apprécier recevoir une lettre pour laquelle ils n\'ont pas souscrit.');
define('_MSNL_ADM_HLP_WHOSNDTOPAID', 'Le choix de cette option enverra la lettre d\'information à tous les abonnés payant. C\'est à dire à tous ceux qui ont un abonnement actif sur votre site.');
define('_MSNL_ADM_HLP_NSNGRPUSRS', 'Le choix de cette option permettra d\'envoyer la lettre d\'information à un ou plusieurs groupes NSN à choisir ci-dessous');
define('_MSNL_ADM_HLP_WHOSNDTOANONYV', 'Le choix de cette option n\'enverra pas la lettre d\'information mais montrera cette dernière dans le bloc des archives de lettre. Cependant, prendre garde à ce que le bloc et module soient accéssible aux utilisateurs.');
define('_MSNL_ADM_HLP_WHOSNDTOADM', 'Le choix de cette option enverra la lettre d\'information à l\'administrateur seulement.C\'est en quelque sorte une lettre de test. Vous pourrez par la suite modifier cette option pour diffuser votre lettre.');
define('_MSNL_ADM_HLP_WHOSNDTOADHOC', 'Le choix de cette option enverra la lettre d\'information à une ou plusieurs adresses courriels séparées par une virgule. Assurez vous que les adresses soient bien valides.');
//Section: NSN Groups
define('_MSNL_ADM_LAB_CHOOSENSNGRP', 'A quel NSN Group vouslez envoyer ?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1', '(la sélection sera ignoré si l\'option n\'a pas été cochée plus haut)');
define('_MSNL_ADM_LAB_WHONSNGRP', 'Choisissez un ou plusieurs groupes');
define('_MSNL_ADM_ERR_DBGETNSNGRPS', 'Impossible d\'optenir les information de NSN Groups');
define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS', 'Sélectionnez un ou plusieurs groupes auxquels vous souhaitez envoyer une lettre d\'information.');
/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/
define('_MSNL_ADM_PREV_LAB_VALPREVNL', 'Créer une nouvelle lettre - Validation et prévisualisation');
define('_MSNL_ADM_PREV_LAB_PREVNL', 'Prévisualisation de la lettre');
define('_MSNL_ADM_PREV_MSG_SUCCESS', 'La lettre a passé toutes les valisation et est prête pour la prévisualisation ci-dessous');
/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/
define('_MSNL_ADM_LAB_NSNGRPS', 'NSN Groups');
define('_MSNL_ADM_VAL_NONSNGRP', 'Vous avez choisi d\'envoyer à un groupe de NSN Groups mais have not selected a group to send to');
define('_MSNL_ADM_ERR_NOTEMPLATE', 'Erreur : aucune mise en page choisie');
define('_MSNL_ADM_VAL_NOSENDTO', 'Aucune option d\'envoie choisie');
define('_MSNL_ADM_ERR_DBUPDLATEST', 'Une erreur c\'est produite pour mettre à jour la configuration de \'Dernier _____\'');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/
define('_MSNL_ADM_SEND_LAB_SENDNL', 'Create Newsletter - Send Mail');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM', 'Lettre d\'information de TEST de');
define('_MSNL_ADM_SEND_LAB_NLFROM', 'Lettre d\'information de');
define('_MSNL_ADM_SEND_MSG_ANONYMOUS', 'La lettre d\'information a été ajoutée à la vue de tous les visiteurs.');
define('_MSNL_ADM_SEND_MSG_LOTSSENT', 'Plus de 500 utilisateurs recevront la lettre d\'information, ceci peut prendre 10 minutes ou plus et peut générer un arrêt de PHP.');
define('_MSNL_ADM_SEND_MSG_TOTALSENT', 'Total Emails to Send');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS', 'Le lettre d\'information a été envoyée avec succès');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE', 'Newsletter email sends failed');
define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL', 'N\'a pu trouver le fichier testemail.php');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW', 'Option de vue fournie invalide');
define('_MSNL_ADM_SEND_ERR_CREATENL', 'N\'a pas pu copier testemail au '
	. 'newsletter file');
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT', 'Ne peut insérer la lettre d\'information dans '
	. 'the database');
define('_MSNL_ADM_SEND_ERR_DBNLSNID', 'Ne peut pas obtenir le bon NID '
	. 'inserted newsletter');
define('_MSNL_ADM_SEND_ERR_MAIL', 'La fonction PHP mail a échoué - ne peut pas envoyer '
	. 'newsletter to:');
define('_MSNL_ADM_SEND_ERR_DELFILETEST', 'L\'effacement du fichier testemail.php a échoué ');
define('_MSNL_ADM_SEND_ERR_DELFILETMP', 'L\'effacement du fichier tmp.php a échoué ');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR', 'Incapable de rechercher des statistiques pour le nombre d\'utilisateurs ');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS', 'Incapable de rechercher des statistiques pour le nombre de visite du site');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS', 'Incapable de rechercher des statistiques pour le nombre des derniers articles');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT', 'Incapable de rechercher des statistiques pour le nombre des nouvelles catégories d\'articles');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS', 'Incapable de rechercher des statistiques pour le nombre des derniers téléchargements');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT', 'Incapable de rechercher des statistiques pour le nombre des dernières catégories de téléchargement');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS', 'Incapable de rechercher des statistiques pour le nombre des derniers liens');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT', 'Incapable de rechercher des statistiques pour le nombre des dernières catégories de liens');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS', 'Incapable de rechercher des statistiques pour le nombre des forums');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS', 'Incapable de rechercher des statistiques pour le nombre des messages des forums');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS', 'Incapable de rechercher des statistiques pour le nombre des derniers comptes rendus');
define('_MSNL_ADM_SEND_ERR_DBGETNEWS', 'Incapable de rechercher les derniers articles');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS', 'Incapable de rechercher les derniers téléchargements');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS', 'Incapable de rechercher les derniers liens');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS', 'Incapable de rechercher les derniers messages des forums');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS', 'Incapable de rechercher les derniers comptes rendus');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER', 'Incapable de rechercher les dernières bannières');
/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/
define('_MSNL_ADM_TEST_LAB_PREVNL', 'Prévisualiser et valider la lettre de test');
/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/
define('_MSNL_CFG_LAB_MAINCFG', 'Menu de configuration du module');
//Module Options
define('_MSNL_CFG_LAB_MODULEOPT', 'Options du module');
define('_MSNL_CFG_LAB_DEBUGMODE', 'Mode de débugage');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF', 'INACTIF');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR', 'ERREUR');
define('_MSNL_CFG_LAB_DEBUGMODE_VER', 'COMPLET');
define('_MSNL_CFG_LAB_DEBUGOUTPUT', 'Debug Output');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS', 'DISPLAY');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG', 'LOG FILE');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH', 'TOUT');
define('_MSNL_CFG_LAB_SHOWBLOCKS', 'Afficher les blocs de droite');
define('_MSNL_CFG_LAB_NSNGRPS', 'Utilisation de NSN Groups');
define('_MSNL_CFG_LAB_DLMODULE', 'Nom du module de téléchargement');
define('_MSNL_CFG_LAB_WYSIWYGON', 'Utilisation d\'un éditeur WYSIWYG');
define('_MSNL_CFG_LAB_WYSIWYGROWS', 'Nombre de lignes');
define('_MSNL_CFG_HLP_DEBUGMODE', 'Cette option permet à l\'administrateur de placer sur diverse position les retours d\'erreurs. Elles correspondent à :<br /><strong>INACTIF</strong> = seuls les messages d\'erreurs de l\'application sans les détails seront affichés.<br /><strong>ERREUR</strong> = les erreurs d\'application seront affichés avec un message éventuel de correction. Les erreurs SQL affichront également l\'erreur réelle produite.<br /><strong>COMPLET</strong> = des messages très détaillés seront affichés dans toute l\'application, y compris dans le module visible par tous. Faire attention de ne pas laisser cette option sur cette position pour un site à fort traffic, car elle pourrait donner des indications utiles à une personne malveillante. <span class="thick">NOTE : aucune lettre d\'information ne pourra être envoyée avec cette option.</span> Elle est seulement utile pour la correction');
define('_MSNL_CFG_HLP_DEBUGOUTPUT', 'Cette option n\'est pas utilisée actuellement. A l\'avenir permettra de montrer les erreurs produites sur le module.');
define('_MSNL_CFG_HLP_SHOWBLOCKS', 'Cocher cette option affichera les blocs de droites dans le module. L\'option par défaut est non coché.');
define('_MSNL_CFG_HLP_NSNGRPS', 'Cette option ne peut être emplyée que si vous avez installé le module NSN Groups. Si le module est installé, elle permet d\'envoyer des lettres d\'information à un ou plusieurs groupes dans les options d\'envoie de la lettre d\'information.');
define('_MSNL_CFG_HLP_DLMODULE', 'Insérez ici l\'extension appropriée du module. La table par défaut des téléchargements est nuke_<strong>downloads</strong>_downloads, il vous faut donc insérer \'downloads\'. Si vous utilisez le module NSN Groups Downloads la table est nuke_<strong>nsngd</strong>_downloads. Dans ce cas il vous faut insérer \'nsngd\'.');
define('_MSNL_CFG_HLP_WYSIWYGON', 'Cochez cette option si vous utilisez un éditeur WYSIWYG. <strong>NOTE :</strong> cette option nécessite obligatoirement l\'installation effective d\'un WYSIWYG');
define('_MSNL_CFG_HLP_WYSIWYGROWS', 'Ceci définit le nombre de lignes qui sont rendues disponibles pour la rédaction du texte de la lettre d\'information {TEXTBODY}. Fonctionne avec et sans WYSIWYG.');
//Show Options
define('_MSNL_CFG_LAB_SHOWOPT', 'Options d\'affichage');
define('_MSNL_CFG_LAB_SHOWCATS', 'Afficher les catégories');
define('_MSNL_CFG_LAB_SHOWHITS', 'Afficher les hits');
define('_MSNL_CFG_LAB_SHOWDATES', 'Afficher les dates d\'envoie');
define('_MSNL_CFG_LAB_SHOWSENDER', 'Afficher l\'expéditeur');
define('_MSNL_CFG_HLP_SHOWCATS', 'Si coché, affichera les catégories dans la lettre d\'information. Les catégories seront aussi montrées dans les archives du module');
define('_MSNL_CFG_HLP_SHOWHITS', 'Si coché, affichera le nombre de vue d\'une lettre d\'information dans le bloc et dans les archives.');
define('_MSNL_CFG_HLP_SHOWDATES', 'Si coché, affichera la date d\'envoie de chaque lettre d\'information dans le bloc et dans les archives.');
define('_MSNL_CFG_HLP_SHOWSENDER', 'Si coché, affichera le nom de l\'expéditeur de la lettre d\'information dans le bloc et dans les archives.');
//Block Options
define('_MSNL_CFG_LAB_BLKOPT', 'Options du bloc');
define('_MSNL_CFG_LAB_BLKLMT', 'Nombre de lettres affichées dans le bloc');
define('_MSNL_CFG_LAB_SCROLL', 'Utiliser le mode défilant du bloc');
define('_MSNL_CFG_LAB_SCROLLHEIGHT', 'Hauteur du bloc défilant');
define('_MSNL_CFG_LAB_SCROLLAMT', 'Pas de défilement');
define('_MSNL_CFG_LAB_SCROLLDELAY', 'Délais de défilement');
define('_MSNL_CFG_HLP_BLKLMT', 'Limite le nombre de lettres d\'information à afficher dans le bloc. Si l\'affichage des catégories est coché, cette option est à définir en éditant les catégories concernées.');
define('_MSNL_CFG_HLP_SCROLL', 'Cette option permet de faire défiler vers le haut le contenu du bloc.');
define('_MSNL_CFG_HLP_SCROLLHEIGHT', 'Définit la hauteur en pixel du bloc, par défaut la taille est de 180. Faire attention de ne pas le mettre trop petit sous peine de visibilité réduite.');
define('_MSNL_CFG_HLP_SCROLLAMT', 'Définit le pas de défilement en pixel du bloc. Par défaut la valeur est de 2.');
define('_MSNL_CFG_HLP_SCROLLDELAY', 'Définit en millisecondes le temps d\'attente entre chaque défilement du bloc. La valeur par défaut est de 25.');
/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/
define('_MSNL_CFG_APPLY_ERR_DBFAILED', 'La mise à jour d\'information de configuration a échoué ');
define('_MSNL_CFG_APPLY_VAL_DEBUGMODE', 'Un invalide mode de débugage a été fournit - pourrait provenir d\'une mauvaise installation du module.');
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT', 'Un message invalide de débugage a été fournit - pourrait provenir d\'une mauvaise installation du module.');
define('_MSNL_CFG_APPLY_MSG_BACK', 'Retour au menu de configuration');
/************************************************************************
* Function: msnl_cat	(Maintain Newsletter Categories)
************************************************************************/
define('_MSNL_CAT_LAB_CATCFG', 'Configuration des catégories de lettre');
define('_MSNL_CAT_LAB_ADDCAT', 'Ajouter une catégorie');
define('_MSNL_CAT_LAB_CATTITLE', 'Titre de la catégorie');
define('_MSNL_CAT_LAB_CATDESC', 'Description de la catégorie');
define('_MSNL_CAT_LAB_CATBLOCKLMT', 'Limite du bloc');
define('_MSNL_CAT_LNK_ADDCAT', 'Add a new newsletter category');
define('_MSNL_CAT_LNK_CATCHG', 'Editer une catégorie de lettre');
define('_MSNL_CAT_LNK_CATDEL', 'Supprimer une catégorie de lettre');
define('_MSNL_CAT_MSG_CATBACK', 'Retour à la liste des catégories');
define('_MSNL_CAT_ERR_DBGETCAT', 'N\'a pu obtenir l\'information sur la catégorie de la lettre d\'information');
define('_MSNL_CAT_ERR_DBGETCATS', 'N\'a pu obtenir les informations sur les catégories des lettres d\'information.');
define('_MSNL_CAT_ERR_NOCATS', 'No categories found - Major problem with installation');
define('_MSNL_CAT_ERR_INVALIDCID', 'Une ID de catégorie de lettre d\'information a été fournie');
define('_MSNL_CAT_ERR_DBGETCNT', 'Echec dans le comptage des lettres d\'information.');
define('_MSNL_CAT_HLP_CATTITLE', 'Ce champ est le titre de la catégorie qui s\'affichera dans le bloc (si permis dans les options de configuration) et dans les archives de lettre d\'information. Comme cette information est emplyée dans le bloc pour grouper les lettres, il est préférable de ne pas dépasser 30 caractères.');
define('_MSNL_CAT_HLP_CATDESC', 'Ceci est la description détaillée de la catégorie.');
define('_MSNL_CAT_HLP_CATBLOCKLMT', 'Ce champ n\'est utilisé seulement si le champ <span class="thick">afficher les catégories</span> est activé et doit être supérieure à zéro. Entrez le nombre de lettre d\'information à afficher dans le bloc pour cette catégorie. Si aucune valeur n\'est fournie, elle sera par défaut de ');
/************************************************************************
* Function: msnl_cat_add
************************************************************************/
define('_MSNL_CAT_ADD_LAB_CATADD', 'Configuration des catégories de lettre - Ajouter une catégorie');
/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/
define('_MSNL_CAT_ADD_APPLY_DBCATADD', 'Echec de l\'ajout de la catégorie de lettre d\'information.');
/************************************************************************
* Function: msnl_cat_chg
************************************************************************/
define('_MSNL_CAT_CHG_LAB_CATCHG', 'Configuration des catégories de lettre - Modifier la catégorie');
define('_MSNL_CAT_CHG_MSG_CHGIMPACT', 'Lettre(s) affectée(s) par le changement');
/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/
define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG', 'La mise à jour de la catégorie de lattre d\'information a échoué.');
/************************************************************************
* Function: msnl_cat_del
************************************************************************/
define('_MSNL_CAT_DEL_MSG_DELIMPACT', 'Lettres d\'information seront impactées par cette suppression');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1', 'Les lettres impactées par cette suppressions seront assignées par défaut à la cétégorie \'non assignée\'. Souhaitez vous continuer cette suppression ?');
/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/
define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN', 'La rattribution des lettres d\'information a échoué.');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE', 'La suppression de la catégorie de lettre d\'information a échoué.');
/************************************************************************
* Function: msnl_nls
************************************************************************/
define('_MSNL_NLS_LAB_NLSCFG', 'Maintenance des lettres');
define('_MSNL_NLS_LAB_CURRENTCAT', 'Catégories actuelles');
define('_MSNL_NLS_LAB_DATESENT', 'Date d\'envoi');
define('_MSNL_NLS_LAB_CATEGORY', 'Catégorie');
define('_MSNL_NLS_LNK_GETNLS', 'Obtenir la lmettre d\'information demandée');
define('_MSNL_NLS_LNK_VIEWNL', 'Voir la lettre d\'information - s\'ouvre dans une nouvelle fenêtre');
define('_MSNL_NLS_LNK_NLSCHG', 'Editer les information de la lettre');
define('_MSNL_NLS_LNK_NLSDEL', 'Supprimer la lettre');
define('_MSNL_NLS_MSG_NONLSS', 'Pas de lettre(s) trouvée(s) pour cette catégorie');
define('_MSNL_NLS_MSG_NLSBACK', 'Retour à la liste des lettres');
define('_MSNL_NLS_ERR_DBGETNLSS', 'Echec de l\'obtention de la lettre d\'information');
define('_MSNL_NLS_ERR_DBGETNLS', 'Echec de l\'obtention des informations de la lettre d\'information');
define('_MSNL_NLS_ERR_INVALIDNID', 'Une ID invalide de lettre d\'information a été fournie');
define('_MSNL_NLS_ERR_NONLSS', 'Pas de lettres dinformations trouvées - Problème majeur avec l\'installation du module.');
/************************************************************************
* Function: msnl_nls_chg
************************************************************************/
define('_MSNL_NLS_CHG_LAB_NLSCHG', 'Maintenance des lettres d\'informations - Changer les informations des lettres');
define('_MSNL_NLS_CHG_LAB_DATESENT', 'Date d\'envoie');
define('_MSNL_NLS_CHG_LAB_WHOVIEW', 'Qui peut voir la lettre d\'information');
define('_MSNL_NLS_CHG_LAB_NSNGRPS', 'Quel groupe NSN peut voir la lettre d\'information');
define('_MSNL_NLS_CHG_LAB_NBRHITS', 'Nombre de vues');
define('_MSNL_NLS_CHG_LAB_FILENAME', 'Nom du fichier de la lettre d\'information');
define('_MSNL_NLS_CHG_LAB_CAUTION', 'Ne changer les valeurs ci-dessous SEULEMENT si vous savez ce que vous faites.');
define('_MSNL_NLS_CHG_HLP_DATESENT', 'Actuellement la date doit être écrite dans le format AAAA-MM-JJ comme affiché ci-contre. Lorsque la lettre d\'information a été créée et envoyée, ce champ a été complété avec la date courante du système. Les lettres d\'informations sont toujours énumérées dans l\'ordre des dates avec la plus récente au-dessus.');
define('_MSNL_NLS_CHG_HLP_WHOVIEW', 'Ce champ est assigné au système, faire attention en le changeant. Les valeurs valides sont : <br /><strong>0</strong> = anonymes - tout le monde peut la voir<br /><strong>1</strong> = tous les utilisateurs enregistrés<br /><strong>2</strong> = seulement ceux qui ont souscrit à la lettre<br /><strong>3</strong> = seulement aux membres abonnés<br /><strong>4</strong> = seulement aux groupes NSN sélectionnés<br /><strong>5</strong> = seulement à la liste de distribution<br /><strong>99</strong> = seulement à l\'administrateur.');
define('_MSNL_NLS_CHG_HLP_NSNGRPS', 'Requier que l\'option ci-dessus soit placé sur 4 pour \'groupe NSN seulemenr\'. Chaque groupe NSN à un champ spécifique d\'identification. Au moment de créer et d\'envoyer une lettre d\'information, il est possible de choisir un ou plusieurs groupes NSN destinataire de la lettre. Pour seulement un groupe ce champ ne devrait avoir qu\'un seul ID de groupe. Pour plus d\'un groupe, chaque ID identifiant les groupes doivent être séparé par un tiret, par exemple : <span class="thick">1-2-3</span>');
define('_MSNL_NLS_CHG_HLP_NBRHITS', 'Lorsqu\'une lettre d\'information est visualisé en utilsant le lien du bloc ou des archives, chaque vue est comptabilisée. Seules les vues de l\'administrateur ne sont pas comptabilisées');
define('_MSNL_NLS_CHG_HLP_FILENAME', 'Ce champ est assigné au système. Si vous le changez, assurez vous que le nom du fichier existe et qu\'il fonctionne correctement.');
/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/
define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW', 'La valeur doit être de 0, 4 ou 99');
define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG', 'La mise à jour de la lettre d\'information a échoué');
/************************************************************************
* Function: msnl_nls_del
************************************************************************/
define('_MSNL_NLS_DEL_MSG_DELIMPACT', 'Vous êtes sur le point de supprimer de manière permanente cette lettre d\'information.');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1', 'Toutes les informations liées à cette lettre d\'information seront supprimées de la base de données et du répertoire des archives. Souhaitez vous continuer la suppression ?');
/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/
define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL', 'Impossible de supprimer la lettre d\'information du répertoire des archives - vérifiez les permissions de ce répertoire');
define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL', 'La suppression de la lettre d\'information a échoué.');


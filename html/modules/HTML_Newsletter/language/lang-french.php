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
* Function: Common use defines between module and block
************************************************************************/
define('_MSNL_NLS_LAB_MORENLS', 'D\'autres lettres...');
define('_MSNL_NLS_LAB_HIT', 'vue');
define('_MSNL_NLS_LAB_HITS', 'vues');
define('_MSNL_NLS_LAB_SENTON', 'envoyé le ');
define('_MSNL_NLS_LAB_SENDER', 'expéditeur');
define('_MSNL_NLS_LNK_VIEWNL', 'Voir la lettre d\'information - s\'ouvre dans une nouvelle fenêtre');
define('_MSNL_NLS_LNK_VIEWNLARCHS', 'Voir les archives de lettres d\'information');
/************************************************************************
* Function: msnl_nls_list
************************************************************************/
define('_MSNL_NLS_LST_LAB_ARCHTITL', 'Archive des lettres d\'information');
define('_MSNL_NLS_LST_LAB_ADMNLS', 'Administrer Newsletter');
define('_MSNL_NLS_LST_LNK_ADMNLS', 'Aller à l\'administration du module');
define('_MSNL_NLS_LST_MSG_NONLS', 'Il n\'y a pas de lettres d\'information à voir');
/************************************************************************
* Function: msnl_nls_view
************************************************************************/
define('_MSNL_NLS_VIEW_ERR_DBGETNL', 'Echec d\'obtention de la lettre d\'information');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND', 'La lettre d\'information n\'a pas été trouvée');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH', 'Vous n\'êtes pas autorisé à voir cette lettre d\'information ou cette dernière n\'existe pas');
/************************************************************************
* Function: msnl_copyright_view
************************************************************************/
define('_MSNL_CPY_LAB_COPYTITLE', 'Module Copyright &copy; and Credits');
define('_MSNL_CPY_LAB_MODULEFOR', 'module pour');
define('_MSNL_CPY_LAB_COPY', 'Copyright Information');
define('_MSNL_CPY_LAB_CREDITS', 'Credit Information');
define('_MSNL_CPY_LAB_MODNAME', 'Nom du module');
define('_MSNL_CPY_LAB_MODVER', 'Version du module');
define('_MSNL_CPY_LAB_MODDESC', 'Description du module');
define('_MSNL_CPY_LAB_LICENSE', 'License');
define('_MSNL_CPY_LAB_AUTHORNM', 'Nom de l\'auteur');
define('_MSNL_CPY_LAB_AUTHOREMAIL', 'Courriel de l\'auteur');
define('_MSNL_CPY_LAB_AUTHORWEB', 'Site de l\'auteur');
define('_MSNL_CPY_LAB_MODDL', 'Téléchargement du module');
define('_MSNL_CPY_LAB_DOCS', 'Support/Aide Documentation');
define('_MSNL_CPY_LAB_ORIGAUTHOR', 'Auteurs originaux');
define('_MSNL_CPY_LAB_CURRENTAUTHOR', 'Auteurs actuels');
define('_MSNL_CPY_LAB_TRANSLATIONS', 'Auteurs des traductions');
define('_MSNL_CPY_LAB_OTHER', 'Remerciement additionnel');
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'Voir copyright et credits');
define('_MSNL_CPY_LNK_PHPNUKE', 'Aller sur le site de PHP-Nuke - vous quitterez ce site');
define('_MSNL_CPY_LNK_AUTHORHOME', 'Aller sur le site de l\'auteur - vous quitterez ce site');
define('_MSNL_CPY_LNK_DOWNLOAD', 'Aller à l\'espace de téléchargement - vous quitterez ce site');
define('_MSNL_CPY_LNK_DOCS', 'Aller à l\'espace de documentation - vous quitterez ce site');


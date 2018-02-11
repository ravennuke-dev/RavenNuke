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
* Function: Common Use Defines
************************************************************************/
define('_MSNL_COM_LAB_SQL', 'SQL');
define('_MSNL_COM_LAB_GOBACK', 'ÅÐÉÓÔÑÏÖÇ');
define('_MSNL_COM_LAB_ERRMSG', 'MHNYMA/TA ËÁÈÏÕÓ/ÙÍ');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Áéùñåßóôå ôïí êÝñóïñá ðÜíù áðü áõôÜ ôá åéêïíßäéá ãéá íá äåßôå '
	. 'êåßìåíï âïÞèåéáò');
define('_MSNL_COM_LNK_GOBACK', 'ÐéÝóôå ãéá åððéóôñïöÞ óôçí ðñïçãïýìåíç óåëßäá');
define('_MSNL_COM_ERR_SQL', 'ÁÍÔÉÌÅÔÙÐÉÓÔÇÊÅ ËÁÈÏÓ ÓÔÇÍ SQL');
define('_MSNL_COM_ERR_MODULE', 'ËÁÈÏÓ ÓÔÏ MODULE');
define('_MSNL_COM_ERR_VALMSG', 'ÔÁ ÐÁÑÁÊÁÔÙ ÐÅÄÉÁ ÁÐÅÔÕ×ÁÍ ÊÁÔÁ ÔÇÍ ÅÐÉÂÅÂÁÉÙÓÇ');
define('_MSNL_COM_ERR_VALWARNMSG', 'ÔÁ ÐÁÑÁÊÁÔÙ ÐÅÄÉÁ  Å×ÏÕÍ ÐÑÏÅÉÄÏÐÏÉÇÓÅÉÓ');
define('_MSNL_COM_ERR_DBGETCFG', 'Áðïôõ÷ßá êáôÜ ôïí Ýëåã÷ï ðëçñïöïñéþí ôùí ñõèìßóåùí ôïõ module!');
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Íáé, Ýôóé ãßíåôáé !');
/************************************************************************
* Function: Common use defines between module and block
************************************************************************/
define('_MSNL_NLS_LAB_MORENLS', 'Ðåñéóóüôåñá ÅíçìåñùôéêÜ Äåëôßá ...');
define('_MSNL_NLS_LAB_HIT', 'hit');
define('_MSNL_NLS_LAB_HITS', 'hits');
define('_MSNL_NLS_LAB_SENTON', 'ðáñáëÞðôçò');
define('_MSNL_NLS_LAB_SENDER', 'áðïóôïëÝáò');
define('_MSNL_NLS_LNK_VIEWNL', 'ðñïåðéóêüðçóç åíçìåñùôéêïý äåëôßïõ - èá áíïßîåé íÝï ðáñÜèõñï');
define('_MSNL_NLS_LNK_VIEWNLARCHS', 'ÅìöÜíéóç áñ÷åßùí åíçìåñùôéêþí äåëôßùí');
/************************************************************************
* Function: msnl_nls_list
************************************************************************/
define('_MSNL_NLS_LST_LAB_ARCHTITL', 'Áñ÷åéïèåôçìÝíá ÅíçìåñùôéêÜ äåëôßá');
define('_MSNL_NLS_LST_LAB_ADMNLS', 'Äçìéïõñãßá Åíçìåñùôéêïý äåëôßïõ');
define('_MSNL_NLS_LST_LNK_ADMNLS', 'ÐÜíå óôç äéá÷åßñéóç ôïõ module');
define('_MSNL_NLS_LST_MSG_NONLS', 'Äåí õðÜñ÷ïõí åíçìåñùôéêÜ äåëôßá ðñïò åìöÜíéóç');
/************************************************************************
* Function: msnl_nls_view
************************************************************************/
define('_MSNL_NLS_VIEW_ERR_DBGETNL', 'ÁðÝôõ÷å ç ëÞøç ðëçñïöïñéþí åíçìåñùôéêþí äåëôßùí');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND', 'Äåí ìðïñåß íá âñåèåß ôï åðéëåãìÝíï áñ÷åßï åíçìåñùôéêþí äåëôßùí');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH', 'Äåí åßóôå åîïõóéïäïôçìÝíïò/ç ãéá íá äåßôå áõôü ôï åíçìåñùôéêü äåëôßï '
	. 'or this newsletter does not exist!');
/************************************************************************
* Function: msnl_copyright_view
************************************************************************/
define('_MSNL_CPY_LAB_COPYTITLE', 'ÐíåõìáôéêÜ äéêáéþìáôá Module &copy; êáé Åõ÷áñéóôßåò');
define('_MSNL_CPY_LAB_MODULEFOR', 'module ãéá');
define('_MSNL_CPY_LAB_COPY', 'Ðëçñïöïñßåò Ðíåõìáôéêþí äéêáéùìÜôùí');
define('_MSNL_CPY_LAB_CREDITS', 'Ðëçñïöïñßåò');
define('_MSNL_CPY_LAB_MODNAME', '¼íïìá Module');
define('_MSNL_CPY_LAB_MODVER', '¸êäïóç Module');
define('_MSNL_CPY_LAB_MODDESC', 'ÐåñéãñáöÞ Module');
define('_MSNL_CPY_LAB_LICENSE', '¢äåéá');
define('_MSNL_CPY_LAB_AUTHORNM', '¼íïìá ÓõíôÜêôç');
define('_MSNL_CPY_LAB_AUTHOREMAIL', 'Email ÓõíôÜêôç');
define('_MSNL_CPY_LAB_AUTHORWEB', 'Éóôïóåëßäá ÓõíôÜêôç');
define('_MSNL_CPY_LAB_MODDL', 'ÁíÜêôçóç Module');
define('_MSNL_CPY_LAB_DOCS', 'ÕðïóôÞñéîç/ÂïÞèåéá Ôåêìçñßùóç');
define('_MSNL_CPY_LAB_ORIGAUTHOR', 'Áñ÷éêüò(ïß) óõíôÜêôçò(åò)');
define('_MSNL_CPY_LAB_CURRENTAUTHOR', 'ÔñÝ÷ùí óõíôÜêôçò(åò) ');
define('_MSNL_CPY_LAB_TRANSLATIONS', 'ÓõíôÜêôçò(åò) ÌåôÜöñáóçò');
define('_MSNL_CPY_LAB_OTHER', 'Ðñüóèåôåò åõ÷áñéóôßåò');
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'ÅìöÜíéóç Ðíåõìáôéêþí äéêáéùìÜôùí êáé Åõ÷áñéóôéþí');
define('_MSNL_CPY_LNK_PHPNUKE', 'Ðçãáßíïôáò óôï äéêôõáêü ôüðï ôïõ PHP-Nuke - èá áöÞóåôå áõôüí ôï äéêôõáêü ôüðï');
define('_MSNL_CPY_LNK_AUTHORHOME', 'Ðçãáßíïôáò óôï äéêôõáêü ôüðï ôïõ ÓõíôÜ÷ôç - èá áöÞóåôå áõôüí ôï äéêôõáêü ôüðï');
define('_MSNL_CPY_LNK_DOWNLOAD', 'Ðçãáßíïôáò óôï äéêôõáêü ôüðï üðïõ âñßóêåôáé ç áíÜêôçóç ôïõ module - èá áöÞóåôå áõôüí ôï äéêôõáêü ôüðï');
define('_MSNL_CPY_LNK_DOCS', 'Ðçãáßíïôáò to Documentation website - èá áöÞóåôå áõôüí ôï äéêôõáêü ôüðï');


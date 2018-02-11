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
* Function: General Use Defines
************************************************************************/
define('_MSNL_COM_LAB_MODULENAME', 'HTML Newsletter');
define('_MSNL_LAB_ADMIN', 'Äéá÷åßñéóç');
//Module Menu Labels and Link Titles
define('_MSNL_LAB_CREATENL', 'Äçìéïõñãßá&nbsp;Å.Ä.');
define('_MSNL_LAB_MAINCFG', 'ÂáóéêÝò&nbsp;Ñõèìßóåéò');
define('_MSNL_LAB_CATEGORYCFG', 'Ñõèìßóåéò&nbsp;Êáôçãïñéþí');
define('_MSNL_LAB_MAINTAINNLS', 'Äéá÷åßñéóç&nbsp;Õðáñ÷üíôùí Å.Ä.');
define('_MSNL_LAB_SENDTESTED', 'ÁðïóôïëÞ&nbsp;äïêéìáóôéêþí Å.Ä.');
define('_MSNL_LAB_SITEADMIN', 'Êïíôñïë&nbsp;ÐÜíåë');
define('_MSNL_LAB_NLARCHIVES', 'Áñ÷åéïèåôçìÝíá Å.Ä.');
define('_MSNL_LAB_NLDOCS', 'On-Line&nbsp;ÕðïóôÞñéîç');
define('_MSNL_LNK_CREATENL', 'Äçìéïõñãßá åíüò åíçìåñùôéêïý äåëôßïõ');
define('_MSNL_LNK_MAINCFG', 'Ïñßóôå ðùò èá äïõëåýåé ôï module');
define('_MSNL_LNK_CATEGORYCFG', 'Äéá÷åéñéóôåßôå ôéò ëÝóôåò ôùí êáôçãïñéþí ôùí åíçìåñùôéêþí äåëôßùí');
define('_MSNL_LNK_MAINTAINNLS', 'Äåßôå, åðåîåñãáóôåßôå Þ äéáãñÜøôå Å.Ä.');
define('_MSNL_LNK_SENDTESTED', 'Óôåßëôå ôï ôåëåõôáßï åíçìåñùôéêü äåëôßï ðïõ ôåóôÜñáôå');
define('_MSNL_LNK_SITEADMIN', 'ÐÜíôå óôï ìåíïý ôçò êåíôñéêÞò - âáóéêÞò äéá÷åßñéóçò ôïõ óÜéô');
define('_MSNL_LNK_NLARCHIVES', 'Äåßôå ôç ëßóôá ôùí áðåóôáëìÝíùí Å.Ä.');
define('_MSNL_LNK_NLDOCS', 'ÐÜíôå óôçí on-line HTML Newsletter õðïóôÞñéîç');
define('_MSNL_ERR_NOTAUTHORIZED', 'Äåí åßóôå åîïõóéïäïôçìÝíïò/ç ãéá íá äéá÷åéñéóôåßôå áõôü ôï module');
//Common use Defines
define('_MSNL_COM_LAB_ACTIONS', 'ÅíÝñãåéá');
define('_MSNL_COM_LAB_ACTIVE', 'Åíåñãü/Ü');
define('_MSNL_COM_LAB_ADD', 'ÐÑÏÓÈÇÊÇ');
define('_MSNL_COM_LAB_ALL', 'ÏËÁ');
define('_MSNL_COM_LAB_GO', 'ÐÁÍÅ');
define('_MSNL_COM_LAB_INACTIVE', 'Áíåíåñãü/á');
define('_MSNL_COM_LAB_LANG', 'Ãëþóóá');
define('_MSNL_COM_LAB_NO', '¼÷é');
define('_MSNL_COM_LAB_PREVIEW', 'Ðñïåðéóêüðçóç');
define('_MSNL_COM_LAB_SAVE', 'ÁÐÏÈÇÊÅÕÓÇ');
define('_MSNL_COM_LAB_SHOW_ALL', '**ÅìöÜíéóç ¼ëùí**');
define('_MSNL_COM_LAB_SEND', 'ÁðïóôïëÞ');
define('_MSNL_COM_LAB_VERSION', '¸êäïóç');
define('_MSNL_COM_LAB_YES', 'Íáé');
define('_MSNL_COM_LNK_ADD', 'ÐéÝóôå ãéá íá ðñïóèÝôå ôá ðáñáðÜíù óôïé÷åßá');
define('_MSNL_COM_LNK_CANCEL', 'Áêýñùóç óõíáëëáãÞò');
define('_MSNL_COM_LNK_CONTINUE', 'ÓõíÝ÷åéá óôçí óõíáëëáãÞ');
define('_MSNL_COM_LNK_SAVE', 'ÐéÝóôå ãéá áðïèÞêåõóç ôùí áëëáãþí óôá ðáñáðÜíù óôïé÷åßá');
define('_MSNL_COM_LNK_SEND', 'ÁðïóôïëÞ åíçìåñùôéêïý äåëôßïõ');
define('_MSNL_COM_LNK_PREVIEW', 'Åðéêýñùóç êáé Ðñïåðéóêüðçóç åíçìåñùôéêïý äåëôßïõ');
define('_MSNL_COM_ERR_MSG', 'ÌÇÍÕÌÁ/ÔÁ ËÁÈÏÕÓ/ÙÍ');
define('_MSNL_COM_ERR_DBGETCATS', 'Áðïôõ÷ßá êáôÜ ôç ëÞøç ôùí êáôçãïñéþí ôïõ åíçìåñùôéêïý äåëôßïõ');
define('_MSNL_COM_ERR_FILENOTEXIST', 'Ôï áñ÷åßï äåí õðÜñ÷åé');
define('_MSNL_COM_ERR_FILENOTWRITEABLE', 'Áäýíáôï íá åããáöåß ôï åíçìåñùôéêü äåëôßï - ÅëÝîôå ôá äéêáéþìáôá óôï öÜêåëï archive ðñÝðåé íá åßíáé 777');
define('_MSNL_COM_ERR_DBGETPHPBB', 'Áäõíáìßá êáôÜ ôç ëÞøç ðëçñïöïñéþí ãéá ôéò ñõè,ßóåéò ôïõ phpBB board');
define('_MSNL_COM_ERR_DBGETRECIPIENTS', 'Unable to get number of recipients for:');
define('_MSNL_COM_MSG_WARNING', 'Ðñïåéäïðïßçóç!');
define('_MSNL_COM_MSG_UPDSUCCESS', 'Ç áíáâÜèìéóç Ýãéíå åðéôõ÷þò!');
define('_MSNL_COM_MSG_ADDSUCCESS', 'Ç ðñïóèÞêç Ýãéíå åðéôõ÷þò!');
define('_MSNL_COM_MSG_DELSUCCESS', 'Ç äéáãñáöÞ Ýãéíå åðéôõ÷þò!');
define('_MSNL_COM_MSG_REQUIRED', 'Ðåäßï ðïõ áðáéôåßôáé ç óõìðëÞñùóÞ ôïõ');
define('_MSNL_COM_MSG_POSNONZEROINT', 'Áðáéôåßôáé áêÝñáéïò áñéèìüò, èåôéêüò, äéáöïñåôéêüò áðü ôï ìçäÝí');
define('_MSNL_COM_HLP_ACTIONS', 'Áéùñåßóôå ôïí êÝñóïñá '
	. 'ðÜíù áðü êÜèå åéêüíá ãéá íá äåéôå ðëçñïöïñßåò ãéá ôï ôé êÜíåé ôï êáèÝíá áðü áõôÜ.');
// For the visual copyright
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'ÅìöÜíéóç Ðíåõìáôéêþí äéêáéùìÜôùí êáé Åõ÷áñéóôéþí');
/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/
//Section: Letter
define('_MSNL_ADM_LAB_LETTER', 'Åíçìåñùôéêü Äåëôßï');
define('_MSNL_ADM_LAB_TOPIC', 'ÈÝìá');
define('_MSNL_ADM_LAB_SENDER', 'ÁðïóôïëÝáò');
define('_MSNL_ADM_LAB_NLSCAT', 'Êáôçãïñßá');
define('_MSNL_ADM_LAB_TEXTBODY', 'Êåßìåíï Åíçìåñùôéêïý Äåëôßïõ');
define('_MSNL_ADM_LAB_HTMLOK', '(HTML Tags åðéôñÝðïíôáé)');
define('_MSNL_ADM_HLP_TOPIC', 'Áõôü ôï êåßìåíï áíôéêáèéóôÜ ôçí {EMAILTOPIC} åôéêÝôôá  óôï '
	. 'åðéëåãìÝíï ðñüôõðï.  ÄåäïìÝíïõ üôé áõôÞ ç åôéêÝôôá åßíáé óõíÞèùò óå ìéá ãñáììÞ ìå Üëëåò åôéêÝôôåò , èá Þôáí '
	. 'êáëü íá åßíáé óýíôïìç êáé ìå áêñßâåéá óôï íüçìá- 40 ÷áñáêôÞñåò ôï ðïëý.');
define('_MSNL_ADM_HLP_SENDER', 'Áõôü ôï êåßìåíï áíôéêáèéóôÜ ôçí {SENDER} åôéêÝôôá  óôï '
	. 'åðéëåãìÝíï ðñüôõðï.  ÄåäïìÝíïõ üôé áõôÞ ç åôéêÝôôá åßíáé óõíÞèùò óå ìéá ãñáììÞ ìå Üëëåò åôéêÝôôåò , èá Þôáí '
	. 'êáëü íá åßíáé óýíôïìç êáé ðñïóùðéêü- 20 ÷áñáêôÞñåò ôï ðïëý.');
define('_MSNL_ADM_HLP_NLSCAT', 'ÁðëÜ åðéëÝîôå ôçí êáôçãïñßá ôïõ Å.Ä. ãéá íá ðñïóôåèåß '
	. 'ìÝóá áõôü ôï Å.Ä..  Ïé êáôçãïñßåò ôùí Å.Ä. ÷ñçóéìïðïéïýíôáé ãéá ôçí êáëýôåñç ïñãÜíùóç ôùí Å.Ä. ôïõ óÜéô '
	. 'óå óõãêåêñéìÝíåò ðåñéï÷Ýò êáé èÝìáôá. Ôá Å.Ä. ôáîéíïìïýíôáé ìå âÜóç áõôÝò ôéò '
	. 'êáôçãïñßåò ÷ñçóéìïðïéþíôáò ó÷åôéêÝò ñõèìßóåéò áðü ôï ìåíïý äéá÷åßñéóçò ôïùí Å.Ä..');
define('_MSNL_ADM_HLP_TEXTBODY', 'Áõôü åßíáé ôï êýñéï êåßìåíï ôïõ Å.Ä. '
	. 'ðïõ èá óôáëåß. Èá Þôáí êáëü íá ãñÜøåôå ôï HTML ðåñéå÷üìåíï ìå Ýíáí êáëü WYSIWYG '
	. 'êåéìåíïãñÜöï ãéá íá ãßíåé Ýôóé üðùò èá Þèåëåò, êáé ìåôÜ êÜíå áíôéãñáöÞ êáé åðéêïëëçóç ôçí HTML óå áõôü ôï ðëáßóéï.'
	. 'Áõôü ôï HTML êåßìåíï áíôéêáèéóôÜ ôçí {TEXTBODY} åôéêÝôôá óôï åðéëåãìÝíï ðñüôõðï.<br /><br />'
	. 'HTML tags åðéôñÝðïíôáé, áëëÜ èá Þôáí óïöü íá õðïëïãßóåôå ôá ðñïãñÜììáôá áíÜãíùóçò çëåêôñïíéêïý ôá÷õäñïìåßïõ ôùí ðáñáëçðôþí óáò '
	. 'êáé ôïõò öõëëïìåôñçôÝò ôïõò (ãéá ôï áñ÷åßï ôùí Å.Ä.) ãéá íá åîáóöáëßóôïõí ôá êáëýôåñá äõíáôÜ áðïôåëÝóìáôá ãéá üëïõò.  <br /><br /> '
	. 'Ãéá ôá Å.Ä. ìå ìåãÜëï êåßìåíï, ìðïñåßôå íá ÷ñçóéìïðïéÞóåôå Üëëåò åôéêÝôôåò ãéá íá <span class="thick">óçìáäÝøåôå</span> '
	. 'ïñéóìÝíá ôìÞìáôá .  Äþóôå óå áõôÝò ðåñéãñáöéêÜ ïíüìáôá êáé êáôüðéí åðéëÝîôå <span class="thick">Íá óõìðåñéëçöèïýí '
	. 'ôá Ðåñéå÷üìåíá</span> ôï ôåôñáãùíßäéï êáôùôÝñù êáé áõôÝò ïé Üãêõñåò èá ãßíïõí óõíäÝóåéò ìÝóá óôïí ðßíáêá '
	. 'ôá Ðåñéå÷üìåíá ìå ôï Å.Ä. óáò! <br /><br />Ãéá ðáñÜäåéãìá, äåßôå: '
	. '<span class="thick">& lt;a name=\'ÈÝìá ðñþôï\'& gt;& lt;/a& gt;</span>. <span class="thick">ÓÇÌÅÉÙÓÇ:</span> ÐñÝðåé íá åßíáé áêñéâþò üðùò öáßíåôáé '
	. 'ìå äéðëÜ åéóáãùãéêÜ êáé ôï tag êëåéóßìáôüò ôïõ! Áõôü ôï ðáñÜäåéãìá èá äçìéïõñãÞóåé ìéá óýíäåóç áðïêáëïýìåíç '
	. '<span class="thick">ÈÝìá ðñþôï</span> ìÝóá óôï ÐÅÑÉÅ×ÏÌÅÍÁ êáé üôáí êÜðïéïò/á ôï ðéÝóåé, èá ìðïñÝóåé '
	. 'íá äåé ôï êåßìåíï ôçò åôéêÝôôáò óáò.');
//Section: Templates
define('_MSNL_ADM_LAB_TEMPLATES', 'Ðñüôõðá');
define('_MSNL_ADM_LAB_CHOOSETMPLT', 'ÅðéëïãÞ Ðñüôõðïõ');
define('_MSNL_ADM_LNK_SHOWTEMPLATE', 'ÐéÝóôå ãéá íá åìöáíéóôåß åéêïíßäéï - ðáñÜäåéãìá ôïõ ðñüôõðïõ');
define('_MSNL_ADM_HLP_TEMPLATES', 'Ï êáôÜëïãïò ðáñáêÜôù ðáñÜãåôáé áðü ôï ôñÝ÷ïí '
	. 'óýíïëï ðñïôýðùí ðïõ âñßóêïíôáé óôï öÜêåëï modules/HTML_Newsletter/templates/ directory. '
	. 'ÅÜí åðéëÝîåôå ôï <span class="thick">×ùñßò ðñüôõðï</span>, èá óôáëåß Ýíá åìáéë ìå ôï êåßìåíï ðïõ âñßóêåôáé '
	. 'óôï ðëáßóéï ìå ôçí åôéêÝôôá <span class="thick"> Êåßìåíï Åíçìåñùôéêïý Äåëôßïõ</span> .<br /><br />'
	. 'Ãéá íá äçìéïõñãÞóåôå Ýíá Å.Ä. ìå ÷ñÞóç ðñïôýðïõ, åðéëÝîôå Ýíá áðü ôç ëßóôá.  Ãéá íá äåßôå ðùò èá öáßíåôáé '
	. 'Å.Ä. ìå ôï ðñüôõðï, ðéÝóôå óôï åéêïíßäéï <span class="thick">Äåò</span> ðïõ âñßóêåôáé äåîéÜ áðü ôï üíïìá '
	. 'ôïõ ðñüôõðïý óáò.<br /><br /> ');
//Section: Stats and Newsletter Contents
define('_MSNL_ADM_LAB_STATS', 'ÓôáôéóôéêÜ êáé ðåñéå÷üìåíá ôïõ åíçìåñùôéêïý äåëôßïõ');
define('_MSNL_ADM_LAB_INCLSTATS', 'Íá óõìðåñéëçöèïýí ÓôáôéóôéêÜ ôïõ óÜéô');
define('_MSNL_ADM_LAB_INCLTOC', 'Íá óõìðåñéëçöèïýí ôá Ðåñéå÷üìåíá');
define('_MSNL_ADM_HLP_INCLSTATS', 'ÅðéëÝãïíôáò áõôü èá óõìðåñéëçöèïýí óôáôéóôéêÜ ôïõ óÜéô óáò ');
define('_MSNL_ADM_HLP_INCLTOC', 'ÅðéëÝãïíôáò áõôü  èá óõìðåñéëÜâåôå ÐÅÑÉÅ×ÏÌÅÍÁ '
	. 'óôï ðñüôõðï ôï ïðïßï Ý÷åé ôçí åôéêÝôôá {TOC} - ð.÷., äåò ðáñáäåßãìáôá ðñïôýðïõ  '
	. 'óôï Fancy_Content.  Áõôü ôï TOC èá Ý÷åé links áðü üëá ôá <span class="thick">Ôåëåõôáßá xxxxxx</span> '
	. 'êáé ôáõôü÷ñïíá links óå êÜèå <span class="thick">Üãêõñá</span> ðïõ óõìðåñéëáìâÜíåôáé óôï <span class="thick">Êåßìåíï Åíçìåñùôéêïý Äåëôßïõ</span>.');
//Section: Include Latest Items
define('_MSNL_ADM_LAB_INCLLATEST', 'Íá óõìðåñéëçöèïýí ôåëåõôáßåò åéóáãùãÝò ôùí');
define('_MSNL_ADM_LAB_INCLLATESTDLS', 'ÁíáêôÞóåùí');
define('_MSNL_ADM_LAB_INCLLATESTWLS', 'ÓõíäÝóìùí äéáäéêôýïõ');
define('_MSNL_ADM_LAB_INCLLATESTFORS', 'ÌçíõìÜôùí ôïõ öüñïõì');
define('_MSNL_ADM_LAB_INCLLATESTNEWS', '¢ñèñùí');
define('_MSNL_ADM_LAB_INCLLATESTREVS', 'ÁíáèåùñÞóåéò');
define('_MSNL_ADM_HLP_INCLLATESTNEWS', 'Êáèïñßæåé ôùí áñéèìü ôùí ôåëåõôáßùí Üñèñùí ðïõ èá åìöáíéóôïýí '
	. 'newsletter.  Ôá Üñèñá èá ôáîéíïìçèïýí ÷ñïíïëïãéêÜ. '
	. '×ñçóéìïðïéåßóôå ôï 0 (ìçäÝí) åÜí äåí åðéèõìåßôáé íá åìöáíéóôïýí óôï Å.Ä. óáò. '
	. 'Ïé ôéìÝò ðïõ åéóÜãïíôáé åäþ äéáôçñïýíôáé áðü ôï Ýíá Å. Ä. óôï åðüìåíï Å. Ä., ðïõ èá îáíáöôéÜîåôå , áëëÜ ìðïñåßôå íá ôéò áëëÜîåôå '
	. 'ïðïéáäÞðïôå óôéãìÞ ãéá ïðïéïäÞðïôå Üëëï Å.Ä..');
define('_MSNL_ADM_HLP_INCLLATESTDLS', 'Êáèïñßæåé ôùí áñéèìü ôùí ôåëåõôáßùí áíáêôÞóåùí ðïõ èá åìöáíéóôïýí '
	. 'óôï Å.Ä..  Ïé áíáêôÞóåéò èá ôáîéíïìçèïýí ÷ñïíïëïãéêÜ. '
	. '×ñçóéìïðïéåßóôå ôï 0 (ìçäÝí) åÜí äåí åðéèõìåßôáé íá åìöáíéóôïýí óôï Å.Ä. óáò. '
	. 'Ïé ôéìÝò ðïõ åéóÜãïíôáé åäþ äéáôçñïýíôáé áðü ôï Ýíá Å. Ä. óôï åðüìåíï Å. Ä., ðïõ èá îáíáöôéÜîåôå , áëëÜ ìðïñåßôå íá ôéò áëëÜîåôå '
	. 'ïðïéáäÞðïôå óôéãìÞ ãéá ïðïéïäÞðïôå Üëëï Å.Ä..');
define('_MSNL_ADM_HLP_INCLLATESTWLS', 'Êáèïñßæåé ôùí áñéèìü ôùí ôåëåõôáßùí óõíäÝóìùí ðïõ èá åìöáíéóôïýí '
	. 'óôï Å.Ä..  Ïé óýíäåóìïé èá ôáîéíïìçèïýí ÷ñïíïëïãéêÜ. '
	. '×ñçóéìïðïéåßóôå ôï 0 (ìçäÝí) åÜí äåí åðéèõìåßôáé íá åìöáíéóôïýí óôï Å.Ä. óáò. '
	. 'Ïé ôéìÝò ðïõ åéóÜãïíôáé åäþ äéáôçñïýíôáé áðü ôï Ýíá Å. Ä. óôï åðüìåíï Å. Ä., ðïõ èá îáíáöôéÜîåôå , áëëÜ ìðïñåßôå íá ôéò áëëÜîåôå '
	. 'ïðïéáäÞðïôå óôéãìÞ ãéá ïðïéïäÞðïôå Üëëï Å.Ä..');
define('_MSNL_ADM_HLP_INCLLATESTFORS', 'Êáèïñßæåé ôùí áñéèìü ôùí ôåëåõôáßùí äçìïóéåýóåùí óôï öüñïõì ðïõ èá åìöáíéóôïýí '
	. 'óôï Å.Ä..  Ïé äçìóïéåýóåéò óôï öüñïõì èá ôáîéíïìçèïýí ÷ñïíïëïãéêÜ. '
	. '×ñçóéìïðïéåßóôå ôï 0 (ìçäÝí) åÜí äåí åðéèõìåßôáé íá åìöáíéóôïýí óôï Å.Ä. óáò. '
	. 'Ïé ôéìÝò ðïõ åéóÜãïíôáé åäþ äéáôçñïýíôáé áðü ôï Ýíá Å. Ä. óôï åðüìåíï Å. Ä., ðïõ èá îáíáöôéÜîåôå , áëëÜ ìðïñåßôå íá ôéò áëëÜîåôå '
	. 'ïðïéáäÞðïôå óôéãìÞ ãéá ïðïéïäÞðïôå Üëëï Å.Ä.. ÅðéðëÝïí, ìüíï ôá äçìüóéá äéáèÝóéìá (ðñïò áíÜãíùóç) ìçíýìáôá ôïõ öüñïõì '
	. 'èá åìáíßæïíôáé.');
define('_MSNL_ADM_HLP_INCLLATESTREVS', 'Êáèïñßæåé ôùí áñéèìü ôùí ôåëåõôáßùí áíáèåùñÞóåùí ðïõ èá åìöáíéóôïýí '
	. 'óôï Å.Ä..  Ïé áíáèåùñÞóåéò èá ôáîéíïìçèïýí ÷ñïíïëïãéêÜ. '
	. '×ñçóéìïðïéåßóôå ôï 0 (ìçäÝí) åÜí äåí åðéèõìåßôáé íá åìöáíéóôïýí óôï Å.Ä. óáò. '
	. 'Ïé ôéìÝò ðïõ åéóÜãïíôáé åäþ äéáôçñïýíôáé áðü ôï Ýíá Å. Ä. óôï åðüìåíï Å. Ä., ðïõ èá îáíáöôéÜîåôå , áëëÜ ìðïñåßôå íá ôéò áëëÜîåôå '
	. 'ïðïéáäÞðïôå óôéãìÞ ãéá ïðïéïäÞðïôå Üëëï Å.Ä..');
//Section: Sponsors
define('_MSNL_ADM_LAB_SPONSORS', 'Óðüíóïñáò/åò');
define('_MSNL_ADM_LAB_CHOOSESPONSOR', 'ÅðéëïãÞ åíüò Óðüíóïñá');
define('_MSNL_ADM_LAB_NOSPONSOR', '×ùñßò Óðüíóïñá');
define('_MSNL_ADM_HLP_CHOOSESPONSOR', 'ÅðéëÝãïíôáò Ýíá óðüíóïñá èá áíôéêáôáóôáèåß ç  {BANNER} åôéêÝôôá'
	. 'ôïõ ðñüôõðïõ áñ÷åßïõ ôïõ Å.Ä. ìå åðéëåãìÝíï åéêïíßäéï, link êáé åíáëëáêôéêü êåßìåíï áðü '
	. 'ôï óýóôçìá ôùí ìðÜíåñò');
define('_MSNL_ADM_ERR_DBGETBANNERS', 'Áðïôõ÷ßá êáôÜ ôç ëÞøç ðëçñïöïñéþí ãéá ôï ìðÜíåñ ôïõ óðüíóïñá');
//Section: Who to Send the Newsletter To
define('_MSNL_ADM_LAB_WHOSNDTO', 'Óå ðïéïí/á èá èÝëáôå íá ðÜíå ôá åíçìåñùôéêÜ äåëôßá?');
define('_MSNL_ADM_LAB_CHOOSESENDTO', 'ÅðéëÝîôå ìéá áðü ôéò ðáñáêÜôù êáôçãïñßåò');
define('_MSNL_ADM_LAB_WHOSNDTONLSUBS', 'Óå ðñïóûðïãñáììÝíá ìÝëç, óôï Åíçìåñùôéêü Äåëôßï ôïõ Nuke, ìüíï');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG', 'Óå üëá ôá åããåãñáììÝíá ìÝëç ôïõ óÜéô');
define('_MSNL_ADM_LAB_WHOSNDTOPAID', 'Óå ðñïóûðïãñáììÝíá ìÝëç, ðïõ ðëÞñùóáí, ìüíï');
define('_MSNL_ADM_LAB_WHOSNDTOANONY', 'Óå ÏËÏÕÓ ôïõò ÅÐÉÓÊÅÐÔÅÓ ôïõ óÜéô'
	. '');
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS', 'Ìéá Þ ðåñéóóüôåñåò NSN ïìÜäåò - åðéëÝîôå ïìÜäá(åò) ðáñáêÜôù');
define('_MSNL_ADM_LAB_WHOSNDTOADM', 'Äïêéìáóôéêü email (óôï Äéá÷åéñéóôÞ ÌÏÍÏ)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS', 'ðñïóûðïãñáììÝíá ìÝëç');
define('_MSNL_ADM_LAB_USERS', 'ÌÝëç');
define('_MSNL_ADM_LAB_PAIDUSRS', 'ÌÝëç ðïõ ðëÞñùóáí');
define('_MSNL_ADM_LAB_NSNGRPUSRS', '×ñÞóôçò(åò) óôçí ïìÜäá NSN GR');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC', 'Ad-Hoc êáôÜëïãïò äéáíïìÞò åìáéë');
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)');
define('_MSNL_ADM_LAB_WHOSNDTOANONYV', 'ÏËÏÕÓ ÔÏÕÓ ÅÐÉÓÊÅÐÔÅÓ ÔÏÕ ÓÁÉÔ');
define('_MSNL_ADM_HLP_WHOSNDTONLSUBS', 'Ìå áõôÞí ôçí åðéëïãÞ èá óôáëåß Å.Ä. '
	. 'óå üëïõò ôïõò ÷ñÞóôåò ôïõ Nuke ðïõ Ý÷ïõí ðñïûðïãñÜøåé óå áõôï ôï äéêôõáêü ôüðï íá äÝ÷ïíôáé Å.Ä., ìÝóù ôùí '
	. 'äõíáôïôÞñôùí åããñáöÞò ôïõò.');
define('_MSNL_ADM_HLP_WHOSNDTOALLREG', 'Ìå áõôÞí ôçí åðéëïãÞ èá óôáëåß Å.Ä. '
	. 'óå üëïõò ôïõò åããåãñáììÝíïõò ÷ñÞóôåò .  Íá åßóôå ðïëý ðñïóå÷ôéêïßêáôÜ ôç ÷ñÞóç áõôÞò ôçò åðéëïãÞò äéüôé ìðïñåß ïé ÷ñÞóôåò óáò '
	. 'íá äõóáñåóôçèïýí óôÝëíïíôÜò ôïõò Ýíá Å.Ä. ðïõ äå æÞôçóáí.');
define('_MSNL_ADM_HLP_WHOSNDTOPAID', 'Ìå áõôÞí ôçí åðéëïãÞ èá óôáëåß Å.Ä. '
	. 'óå üëïõò ôïõò ÷ñÞóôåò ðïõ åßíáé óõíäñïìçôÝò Ýíáíôé ðëçñùìÞò  - ð.÷., óå åêåßíïõò ìå ôéò åíåñãÝò óõíäñïìÝò.');
define('_MSNL_ADM_HLP_NSNGRPUSRS', 'Ìå áõôÞí ôçí åðéëïãÞ èá óáò åðéôñáðåß íá åðéëÝîåôå '
	. 'Ýíá Þ ðåñéóóüôåñá NSN Groups áðü ðáñáêÜôù, ãéá íá óôáëåß ôï Å.Ä..');
define('_MSNL_ADM_HLP_WHOSNDTOANONYV', 'ÄÅ ÈÁ ËÁÂÏÕÍ ÅÌÁÉË, áëëÜ èá ìðïñåß ï êÜèå åðéóêÝðôçò'
	. 'íá äåé áõôü ôï åíçìåñùôéêü äåëôßï óôï block êáé óôçí áñ÷åéïèÝôçóç. ÐÜíôùò, íá '
	. 'èõìÜóôå ðùò ôá äéêáéþìáôá Üäåéáò óôï block êáé óôï module permissions ðñÝðåé íá ñõèìéóôïýí üðùò Ý÷åé êáèïñéóôåß.');
define('_MSNL_ADM_HLP_WHOSNDTOADM', 'Ìå áõôÞí ôçí åðéëïãÞ èá óôáëåß Å.Ä. '
	. 'óå ÅÓÁÓ - ôï äéá÷åéñéóôÞ - ÌÏÍÏ. Ìüëéò åðéêõñùèåß áõôü ôï Å.Ä. èá åßíáé Ýôïéìï ãéá '
	. 'óôáëåß óôïõò ðñïïñéæüìåíïõò ðáñáëÞðôåò óáò, ÷ñçóéìïðïéþíôáò ôï link <span class="thick">ÁðïóôïëÞ Äïêéìáóôéêïý</span> ðïõ âñßóêåôáé '
	. 'óôçí êïñõöÞ áõôÞò ôçò óåëßäáò.');
define('_MSNL_ADM_HLP_WHOSNDTOADHOC', 'Ìå áõôÞí ôçí åðéëïãÞ èá ìðïñÝóåôå íá óôåßëåôå Å.Ä. '
	. 'óå ìéá Þ ðåñéóóüôåñåò  email äéåõèýíóåéò åðéëïãÞò óáò.  ÐñÝðåé áðëÜ íá ÷ùñßóåôå  '
	. 'êÜèå email äéåýèõíóç ìå êüììá ÊÁÉ íá åßóôå ÓÉÃÏÕÑÏÉ ãéá ôçí åãêõñüôçôá ôçò/ôùí email äéåýèõíóçò/äéåõèýíóåùí.');
//Section: NSN Groups
define('_MSNL_ADM_LAB_CHOOSENSNGRP', 'Óå ðïéá(åò) NSN ïìÜäá(åò) íá óôáëåß?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1', '(ç åðéëïãÞ èá áãíïçèåß åÜí êÜðïéá NSN ïìÜäá '
	. 'äåí åðéëå÷èåß ðáñáêÜôù)');
define('_MSNL_ADM_LAB_WHONSNGRP', 'ÅðéëÝîôå ìéá ïìÜäá Þ êáé ðåñéóóüôåñåò ïìÜäåò');
define('_MSNL_ADM_ERR_DBGETNSNGRPS', 'Áäõíáìßá êáôÜ ôç ëÞøç ðëçñïöïñéþí áðü ôï NSN Groups');
define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS', 'ÅðéëÝîôå ìéá Þ ðåñéóóüôåñåò ïìÜäåò ðáñáêÜôù. Ôï Å.Ä. '
	. 'èá óôáëåß óå üëïõò ôïõò nuke ÷ñÞóôåò  ðïõ åßíáé óôçí(åò) ïìÜäá(åò) ôçò åðéëïãÞò óáò.  Óôçí ðåñßðôùóç ðïõ '
	. 'Ýíáò ÷ñÞóôçò åßíáé ãñáììÝíïò óå ðåñéóóüôåñåò áðü ìéá ïìÜäåò, ôï Å.Ä. èá ôïõ óôáëåß ìüíï ìéá öïñÜ.');
/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/
define('_MSNL_ADM_PREV_LAB_VALPREVNL', 'ÄçìéïõñãÞóôå ôï åíçìåñùôéêü äåëôßï - åëÝîôå êáé äåßôå ôï');
define('_MSNL_ADM_PREV_LAB_PREVNL', 'Ðñïåðéóêüðçóç Åíçìåñùôéêïý Äåëôßïõ');
define('_MSNL_ADM_PREV_MSG_SUCCESS', 'Ôï åíçìåñùôéêü äåëôßï ðÝñáóå üëïõò ôïõò åëÝã÷ïõò êáé åßíáé Ýôïéìï '
	. 'for previewing below');
/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/
define('_MSNL_ADM_LAB_NSNGRPS', 'NSN ÏìÜäåò');
define('_MSNL_ADM_VAL_NONSNGRP', 'ÅðéëÝîáôå íá ôï óôåßëåôå óå ïìÜäá ôïõ NSN áëëÜ '
	. 'äåí åðéëÝîáôå ôçí ïìÜäá ðïõ èá óôáëåß');
define('_MSNL_ADM_ERR_NOTEMPLATE', 'ÐéèáíÞ Ýëëåéøç ðñïóðÜèåéáò  - äåí Ýãéíå åðéëïãÞ ðñüôõðïõ');
define('_MSNL_ADM_VAL_NOSENDTO', 'äåí Ýãéíå ç áðïóôïëÞ ðñïò ôïõò åðéëåãìÝíïõò ðáñáëÞðôåò');
define('_MSNL_ADM_ERR_DBUPDLATEST', 'Had error on updating \'Latest _____\' configuration information');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/
define('_MSNL_ADM_SEND_LAB_SENDNL', 'Äçìéïõñãßá åíçìåñùôéêïý äåëôßïõ - ÁðïóôïëÞ åìáéë');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM', 'Äïêéìáóôéêü Åíçìåñùôéêü Äåëôßï áðü');
define('_MSNL_ADM_SEND_LAB_NLFROM', 'Åíçìåñùôéêü Äåëôßï áðü');
define('_MSNL_ADM_SEND_MSG_ANONYMOUS', 'Ôï Å.Ä. ðñïóôÝèçêå ãéá íá ôï âëÝðïõí ÏËÏÉ ïé åðéóêÝðôåò ');
define('_MSNL_ADM_SEND_MSG_LOTSSENT', 'Ðåñéóóüôåñïé áðü 500 ÷ñÞóôåò èá ëÜâïõí áõôü '
	. 'ôï Å.Ä., áõôü èá ðÜñåé 10 ëåðôÜ Þ ðåñéóóüôåñï êáé ç PHP ìðïñåß íá êïëëÞóåé.');
define('_MSNL_ADM_SEND_MSG_TOTALSENT', 'Total Emails to Send');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS', 'ÓôÜëèçêáí åðéôõ÷þò ôá emails ìå ôï Å.Ä.');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE', 'ÁðÝôõ÷å ç áðïóôïëÞ email ìå ôï Å.Ä.');
define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL', 'Áäõíáìßá óôçí Ýâñåóç ôïõ áñ÷åßïõ testemail.php');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW', '¢êõñç åðéëïãÞ åìöÜíéóçò ðáñå÷ïìÝíïõ');
define('_MSNL_ADM_SEND_ERR_CREATENL', 'Áäõíáìßá êáôÜ ôçí áíôéãñáöÞ áðü ôï testemail óôï '
	. 'áñ÷åßï ôïõ Å.Ä.');
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT', 'Áäõíáìßá êáôÜ ôç êáôáãñáöÞ ôïõ Å.Ä. '
	. 'óôç âÜóç äåäïìÝíùí');
define('_MSNL_ADM_SEND_ERR_DBNLSNID', 'Áäõíáìßá óôçí Ýâñåóç ôïõ NID ôïõ Å.Ä. '
	. 'ðïõ ìüëéò äçìéïõñãÞèçêå êáé åéóÞ÷èåé óôç âÜóç');
define('_MSNL_ADM_SEND_ERR_MAIL', 'Áðïôõ÷ßá óôç PHP mail function - Þôáí áäýíáôç ç áðïóôïëÞ '
	. 'ôïõ Å.Ä. óå:');
define('_MSNL_ADM_SEND_ERR_DELFILETEST', 'Ç äéáãñáöÞ ôïõ áñ÷åßïõ testemail.php , áðÝôõ÷å');
define('_MSNL_ADM_SEND_ERR_DELFILETMP', 'Ç äéáãñáöÞ ôïõ áñ÷åßïõ tmp.php, áðÝôõ÷å');
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá ôïí áñéèìü ÷ñçóôþí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá ôá óõíïëéêÜ hits ôïõ äéêôõáêïý ôüðïõ');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá ôïí áñéèìü ôùí Üñèñùí åéäÞóåùí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí êáôçãïñéþí åéäÞóåùí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí áíáêôÞóåùí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí êáôçãïñéþí ôùí áíáêôÞóåùí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí óõíäÝóìùí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí êáôçãïñéþí ôùí óõíäÝóìùí');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí forums');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí äçìïóéåýóåùí óôï forum ');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç óôáôéóôéêþí ãéá  ôïí áñéèìü ôùí áíáèåùñÞóåùí');
define('_MSNL_ADM_SEND_ERR_DBGETNEWS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç ôùí ðñüóöáôùí Üñèñùí');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç ôùí ðñüóöáôùí áíáêôÞóåùí');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç ôùí ðñüóöáôùí óõíäÝóìùí');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç ôùí ðñüóöáôùí äçìïóéåýóåùí óôï forum');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç ôùí ðñüóöáôùí áíáèåùñÞóåùí');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER', 'Áäõíáìßá êáôÜ ôçí åìöÜíéóç ôïõ ìðÜíåñ');
/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/
define('_MSNL_ADM_TEST_LAB_PREVNL', 'Ðñïåðéóêüðçóç Äïêéìáóôéêïý Å.Ä. ðñïò áðïóôïëÞ');
/************************************************************************
* Function: msnl_cfg        (Main Configuration Options)
************************************************************************/
define('_MSNL_CFG_LAB_MAINCFG', 'ÂáóéêÝò Ñõèìßóåéò ôïõ Module');
//Module Options
define('_MSNL_CFG_LAB_MODULEOPT', 'Ñõèìßóåéò Module');
define('_MSNL_CFG_LAB_DEBUGMODE', 'Ñýèìéóç Ëáèþí');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF', '×ÙÑÉÓ');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR', 'ÌÏÍÏ ËÁÈÇ');
define('_MSNL_CFG_LAB_DEBUGMODE_VER', 'ËÁÈÇ ËÅÐÔÏÌÅÑÙÓ');
define('_MSNL_CFG_LAB_DEBUGOUTPUT', 'ÅìöÜíéóç äéïñèþóåùí');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS', 'ÅÌÖÁÍÉÓÇ');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG', 'LOG ÁÑ×ÅÉÏ');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH', 'ÌÁÆÉ');
define('_MSNL_CFG_LAB_SHOWBLOCKS', 'ÅìöÜíéóç Äåîéþí Blocks');
define('_MSNL_CFG_LAB_NSNGRPS', '×ñÞóç NSN ÏìÜäùí');
define('_MSNL_CFG_LAB_DLMODULE', '¼íïìá Module ôïõ Download');
define('_MSNL_CFG_LAB_WYSIWYGON', '×ñÞóç WYSIWYG åðåîåñãáóôÞ');
define('_MSNL_CFG_LAB_WYSIWYGROWS', 'ÓåéñÝò ãéá ðåñéå÷üìåíï');
define('_MSNL_CFG_HLP_DEBUGMODE', 'Áõôü åðéôñÝðåé óôï äéá÷åéñéóôÞ ôïõ Å.Ä. íá ñõèìßóåé äéÜöïñá åðßðåäá áðü '
	. 'ìçíýìáôá ëáèþí üðùò ðáñáêÜôù:<br /><strong>OFF</strong> = Only application level error '
	. 'messages, with no details will be displayed.<br /><strong>ERROR</strong> = Application '
	. 'errors will be displayed, along with useful debug message text.  SQL errors will also '
	. 'show the actual SQL error message and generated SQL.<br /> <strong>VERBOSE</strong> '
	. '= Very detailed messages will be displayed throughout the application, including path '
	. 'names (be careful with not leaving this setting on for very long or on a very active '
	. 'web site as it could provide alot of useful information to a hacker!). <span class="thick">NOTE: emails '
	. 'will NOT be sent using this option</span> - very useful for debugging purposes.');
define('_MSNL_CFG_HLP_DEBUGOUTPUT', 'This option is not used at this time.  In the future '
	. 'will provide ability to display the above debug messages to either the browser, a log '
	. 'file, or both.');
define('_MSNL_CFG_HLP_SHOWBLOCKS', 'Having this <strong>checked</strong> will show the '
	. 'right-hand blocks when in the module.  Having this <strong>unchecked</strong> will hide '
	. 'the right-hand blocks.  The default for this is <strong>unchecked</strong>.');
define('_MSNL_CFG_HLP_NSNGRPS', 'This option can only be used if you have '
	. 'NSN Groups add-on installed.  If you would like to be able to send newsletters '
	. 'to one or more NSN Groups, check this option.');
define('_MSNL_CFG_HLP_DLMODULE', 'Replace this with the proper module '
	. 'extension, i.e. the default module is \'downloads\' from nuke_'
	. '<strong>downloads</strong>_downloads. For NSN Groups module, it is \'nsngd\' '
	. 'from nuke_<strong>nsngd</strong>_downloads.');
define('_MSNL_CFG_HLP_WYSIWYGON', 'Check this if you wish to use the WYSIWYG '
	. 'editor for editing the newsletter content (textbody).  <strong>NOTE:</strong> this '
	. 'option requires that the nukeWYSIWYG add-on is pre-installed.');
define('_MSNL_CFG_HLP_WYSIWYGROWS', 'This controls the number of rows that are '
	. 'made available on the Create Newsletter page within the Newsletter Content '
	. '(textbody).  It works with WYSIWYG and without.');
//Show Options
define('_MSNL_CFG_LAB_SHOWOPT', 'ÅìöÜíéóç Ñõèìßóåéùí');
define('_MSNL_CFG_LAB_SHOWCATS', 'ÅìöÜíéóç Êáôçãïñéþí');
define('_MSNL_CFG_LAB_SHOWHITS', 'ÅìöÜíéóç hits');
define('_MSNL_CFG_LAB_SHOWDATES', 'ÅìöÜíéóç çìåñïìçíßáò áðïóôïëÞò');
define('_MSNL_CFG_LAB_SHOWSENDER', 'ÅìöÜíéóç ÁðïóôïëÝá');
define('_MSNL_CFG_HLP_SHOWCATS', 'Åáí ôóåêáñéóôåß, èá åìöáíßóåé ôá Å.Ä. êÜôù áðü  '
	. 'ôéò áíôßóôïé÷åò êáôçãïñßåò ôïõò ìÝóá óôï block.  Ïé êáôçãïñßåò ðÜíôïôå èá åìöáíßæïíôáé '
	. 'óôï öÜêåëï (áñ÷åéïèåôçìÝíùí) Archives (ôïõ module).');
define('_MSNL_CFG_HLP_SHOWHITS', 'Åáí ôóåêáñéóôåß, èá åìöáíßóåé ôïí áñéèìü '
	. 'ôùí åìöáíßóåùí (hits) ðïõ Ýãéíå óå Ýíá Å.Ä. êáé ìÝóá óôï block êáé áðü ôï öÜêåëï Archives (module).');
define('_MSNL_CFG_HLP_SHOWDATES', 'Åáí ôóåêáñéóôåß, èá åìöáíßóåé ôçí çìåñïìçíßá üðïõ '
	. 'êÜèå Å.Ä. Ý÷åé óôáëåß êáé ìÝóá óôï block êáé óôï öÜêåëï Archives (module).');
define('_MSNL_CFG_HLP_SHOWSENDER', 'Åáí ôóåêáñéóôåß, èá åìöáíßóåé ôïí/çí áðïóôïëÝò ðïõ '
	. 'Ýóôåéëå êÜèå Å.Ä. êáé ìÝóá óôï block êáé óôï öÜêåëï Archives (module).');
//Block Options
define('_MSNL_CFG_LAB_BLKOPT', 'Ñõèìßóåéò Block');
define('_MSNL_CFG_LAB_BLKLMT', 'Å.Ä. ðñïò åìöÜíéóç ìÝóá óôï block');
define('_MSNL_CFG_LAB_SCROLL', '×ñÞóç Êþäéêá ãéá êõëéüìåíï block code');
define('_MSNL_CFG_LAB_SCROLLHEIGHT', '¾øïò Êõëéüìåíïõ ðëáéóßïõ');
define('_MSNL_CFG_LAB_SCROLLAMT', 'Ðïóü êýëçóçò');
define('_MSNL_CFG_LAB_SCROLLDELAY', 'ÊáèõóôÝñçóç Êõëéüìåíïõ ðëáéóßïõ');
define('_MSNL_CFG_HLP_BLKLMT', '¼ñéï, óôï óõíïëéêü áñéèìü ôùí Å.Ä. '
	. 'ðñïò åìöÜíéóç óôï block.  ÅÜí ïé êáôçãïñßåò åßíáé åíåñãÝò, ï áñéèìüò ôùí Å.Ä. '
	. 'èá åìöáíéóôåß óå ìéá éäéáßôåñç êáôçãïñßá êáé åßíáé ìéá ÷ùñéóôÞ ñýèìéóç.');
define('_MSNL_CFG_HLP_SCROLL', 'Êáèïñßæåé ðùò èá åìöáíßæïíôáé ôá äåäïìÝíá óôï block, '
	. 'ôç äõíáôüôçôá íá êõëÞóåé ðñïò ôá ðÜíù ôï block');
define('_MSNL_CFG_HLP_SCROLLHEIGHT', 'Ñõèìßæåé ôï ýøïò ôçò êõëéüìåíçò ðåñéï÷Þò óå '
	. 'pixels, ùò ðñïåðéëïãÞ åßíáé 180. ÐÑÏÓÏ×Ç, ÅÜí ôï ïñßóåôå ðïëý ìéêñü ìðïñåß íá öáßíåôáé ôßðïôá.');
define('_MSNL_CFG_HLP_SCROLLAMT', 'Ñõèìßæåé ôï ðïóü êýëçóçò, '
	. 'áõôü êáèïñßæåé ôçí áðüóôáóç ðïõ èá Ý÷ïõí ìåôáîý ôïõò ôá äåäïìÝíá ðïõ êõëïýí . '
	. 'Ùò ðñïåðéëïãÞ åßíáé 2.');
define('_MSNL_CFG_HLP_SCROLLDELAY', 'Ñõèìßæåé ôçí êáèõóôÝñçóç êýëçóçò, '
	. 'áõôü êáèïñßæåé ðüóï èá êáèõóôåñÞóïõí íá åìöáíéóôïýí ôá äåäïìÝíá îáíÜ óå mil-sec. Ùò ðñïåðéëïãÞ åßíáé 25.');
/************************************************************************
* Function: msnl_cfg_apply        (Apply Changes to Main Configuration)
************************************************************************/
define('_MSNL_CFG_APPLY_ERR_DBFAILED', 'Ç áíáâÜèìéóç ôùí ñõèìßóåùí áðÝôõ÷å');
define('_MSNL_CFG_APPLY_VAL_DEBUGMODE', 'Ìç åðéôñåðôüò ôýðïò åëÝã÷ïõ ëáèþí, åìöáíßóôçêå - ìÜëëïí õðÜñ÷åé '
	. 'ðñüâëçìá ìå ôçí åãêáôÜóôáóç ôïõ module');
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT', 'Ìç åðéôñåðôÞ Ýêäïóç ëáèþí, åìöáíßóôçêå - ìÜëëïí õðÜñ÷åé '
	. 'ðñüâëçìá ìå ôçí åãêáôÜóôáóç ôïõ module');
define('_MSNL_CFG_APPLY_MSG_BACK', 'ÅðéóôñïöÞ óôéò âáóéêÝò ñõèìßóåéò');
/************************************************************************
* Function: msnl_cat        (Maintain Newsletter Categories)
************************************************************************/
define('_MSNL_CAT_LAB_CATCFG', 'Ñõèìßóåéò Êáôçãïñéþí Åíçìåñùôéêþí Äåëôßùí');
define('_MSNL_CAT_LAB_ADDCAT', 'ÐÑÏÓÈÇÊÇ ÊÁÔÇÃÏÑÉÁÓ');
define('_MSNL_CAT_LAB_CATTITLE', 'Ôßôëïò Êáôçãïñßáò');
define('_MSNL_CAT_LAB_CATDESC', 'ÐåñéãñáöÞ Êáôçãïñßáò');
define('_MSNL_CAT_LAB_CATBLOCKLMT', 'Block üñéï');
define('_MSNL_CAT_LNK_ADDCAT', 'ÐñïóèÞêç íÝáò êáôçãïñßáò åíçìåñùôéêþí äåëôßùí');
define('_MSNL_CAT_LNK_CATCHG', 'Åðåîåñãáóßá êáôçãïñßáò åíçìåñùôéêþí äåëôßùí');
define('_MSNL_CAT_LNK_CATDEL', 'ÄéáãñáöÞ êáôçãïñßáò åíçìåñùôéêþí äåëôßùí');
define('_MSNL_CAT_MSG_CATBACK', 'ÅðéóôñïöÞ óôéò Ñõèìßóåéò Êáôçãïñéþí Åíçìåñùôéêþí Äåëôßùí');
define('_MSNL_CAT_ERR_DBGETCAT', 'Áðïôõ÷ßá êáôÜ ôç ëÞøç ðëçñïöïñéþí ãéá ôçí/éò êáôçãïñßá/åò');
define('_MSNL_CAT_ERR_DBGETCATS', 'Áðïôõ÷ßá óôéò êáôçãïñßåò ôïõ Å.Ä.');
define('_MSNL_CAT_ERR_NOCATS', 'Äå âñÝèçêáí êáôçãïñßåò - Óçìáíôéêü ðñüâëçìá ìå ôçí åãêáôÜóôáóç ');
define('_MSNL_CAT_ERR_INVALIDCID', 'Ìç åðéôñåðôü ID êáôçãïñßáò Å.Ä., åìöáíßóôçêå ');
define('_MSNL_CAT_ERR_DBGETCNT', 'Get count of impacted newsletters failed');
define('_MSNL_CAT_HLP_CATTITLE', 'Áõôü ôï ðåäßï åßíáé ï ôßôëïò ôçò êáôçãïñßáò ðïõ èá '
	. 'åìöáíéóôåß êáé óôï block (Åáí åßíáé åíåñãïðïéçìÝíï - áðü ôéò ñõèìßóåéò) êáé óôï öÜêåëùí ôùí Å.Ä. '
	. '(archives).  Ìéáò êáé áõôüò èá ÷ñçóéìïðïéçèåß êáé ìÝóá óôï block ìå ôá Å.Ä. ìáæß '
	. 'èá ðñÝðåé ï ôßëôïò íá Ý÷åé 30 ÷áñáêôÞñåò ôï ðïëý , Ýôóé ôï block èá åìöáíéóôåß '
	. 'óùóôÜ.');
define('_MSNL_CAT_HLP_CATDESC', 'Áõôü åßíáé Ýíá ðïëý ìåãÜëï óå ìÞêïò ðåäßï. Ï ìüíïò ðåñéïñéóìüò '
	. 'åßíáé íá ìçí åéóá÷èïýí HTML tags óå áõôü.  Èá óå áöÞóåé íá ôï êÜíåéò, áëëÜ áõôÜ èá áðïìáêñõíèïýí '
	. 'áñãüôåñá.  Äþóôå ìéá êáëÞ êáé ïõóéáóôéêÞ ðåñéãñáöÞ áõôÞò ôçò êáôçãïñßáò Å.Ä..');
define('_MSNL_CAT_HLP_CATBLOCKLMT', 'Áõôü ôï ðåäßï ÷ñçóéìïðïéåßôáé ìüíïí áí ôï <span class="thick">åìöÜíéóç êáôçãïñéþí</span> '
	. 'óôéò åðéëïãÝò ôùí ñõèìßóåùí åßíá éôóåêáñéóìÝíï êáé ðñÝðåé íá åßíáé ìåãáëýôåñï ôïõ ìçäÝí.  ÅéóÜãåôå åäþ ôïí áñéèìü ôùí Å.Ä. '
	. 'ðïõ èá åìöáíßæïíôáé êÜôù áðü áõôÞí ôçí êáôçãïñßá óôï block. <span class="thick">ÅÜí äå äùèåß ìéá áîßá '
	. ', èá ïñéóôåß ùò ðñïåðéëïãÞ ôï ');
/************************************************************************
* Function: msnl_cat_add
************************************************************************/
define('_MSNL_CAT_ADD_LAB_CATADD', 'Ñõèìßóåéò Êáôçãïñéþí Å.Ä. - ÐñïóèÞêç Êáôçãïñßáò');
/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/
define('_MSNL_CAT_ADD_APPLY_DBCATADD', 'Áðïôõ÷ßá óôçí ðñïóèÞêç Êáôçãïñßáò');
/************************************************************************
* Function: msnl_cat_chg
************************************************************************/
define('_MSNL_CAT_CHG_LAB_CATCHG', 'Ñõèìßóåéò Êáôçãïñéþí Å.Ä. - ÁëëáãÞ Êáôçãïñßáò');
define('_MSNL_CAT_CHG_MSG_CHGIMPACT', 'Newsletter(s) will be impacted by this change');
/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/
define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG', 'Áðïôõ÷ßá êáôÜ ôçí áíáâÜèìéóç ôçò êáôçãïñßáò');
/************************************************************************
* Function: msnl_cat_del
************************************************************************/
define('_MSNL_CAT_DEL_MSG_DELIMPACT', 'Newsletter(s) will be impacted by this delete.');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1', 'Impacted newsletters will be re-assigned to the '
	. 'default unassigned newsletter category.  Do you wish to continue with this delete?');
/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/
define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN', 'Re-assignment of newsletters failed');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE', 'Delete of newsletter category failed');
/************************************************************************
* Function: msnl_nls
************************************************************************/
define('_MSNL_NLS_LAB_NLSCFG', 'Maintain Newsletters');
define('_MSNL_NLS_LAB_CURRENTCAT', 'ÔñÝ÷ïõóá Êáôçãïñßá');
define('_MSNL_NLS_LAB_DATESENT', 'Çìåñïìçíßá');
define('_MSNL_NLS_LAB_CATEGORY', 'Êáôçãïñßá');
define('_MSNL_NLS_LNK_GETNLS', 'Get requested newsletters');
define('_MSNL_NLS_LNK_VIEWNL', 'View newsletter - may open new window');
define('_MSNL_NLS_LNK_NLSCHG', 'Edit newsletter information');
define('_MSNL_NLS_LNK_NLSDEL', 'Delete newsletter');
define('_MSNL_NLS_MSG_NONLSS', 'No newsletters for category found');
define('_MSNL_NLS_MSG_NLSBACK', 'Back to Newsletter list');
define('_MSNL_NLS_ERR_DBGETNLSS', 'Failed to get newsletters');
define('_MSNL_NLS_ERR_DBGETNLS', 'Failed to get newsletter information');
define('_MSNL_NLS_ERR_INVALIDNID', 'Invalid Newsletter ID was provided');
define('_MSNL_NLS_ERR_NONLSS', 'No newsletters found - Major problem with installation');
/************************************************************************
* Function: msnl_nls_chg
************************************************************************/
define('_MSNL_NLS_CHG_LAB_NLSCHG', 'Maintain Newsletters - Change Newsletter Information');
define('_MSNL_NLS_CHG_LAB_DATESENT', 'Çìåñïìçíßá ÁðïóôïëÞò');
define('_MSNL_NLS_CHG_LAB_WHOVIEW', 'Ðïéïò âëÝðåé ôá Å.Ä.');
define('_MSNL_NLS_CHG_LAB_NSNGRPS', 'NSN Groups ìðïñïýí íá äïõí Å.Ä.');
define('_MSNL_NLS_CHG_LAB_NBRHITS', 'Áñéèìüò Hits');
define('_MSNL_NLS_CHG_LAB_FILENAME', '¼íïìá áñ÷åßïõ Å.Ä.');
define('_MSNL_NLS_CHG_LAB_CAUTION', 'Áëëáîôå êÜôé áðü ôá ðáñáêÜôù ÌÏÍÏ åÜí îÝñåôå êáëÜ ôé êÜíåôå');
define('_MSNL_NLS_CHG_HLP_DATESENT', 'ÓõãêåêñéìÝíá, ç çìåñïìçíßá ðñ´ðåé íá åéóá÷èåß ìå ôç ìïñöÞ '
	. 'YYYY-MM-DD üðùò åìöáíßæåôáé óå áõôü ôï ðåäßï.  ¼ôáí äçìéïõñãåßôáé êáé áðïóôÝëåôáé Ýíá Å.Ä., '
	. 'áõôü ôï ðåäßï åíçìåñþíåôáé ìå ôçí çìåñïìçíßá ôïõ óõóôÞìáôïò.  Ôá Å.Ä. ðÜíôïôå åìöáíßæïíôáé '
	. 'ìå çìåñïìçíéáêÞ ôáîéíüìçóç êáé óôçí êïñõöÞ ôçò ëßóôáò åìöáíßæåôáé ôï ðéï ðñüóöáôï Å.Ä..');
define('_MSNL_NLS_CHG_HLP_WHOVIEW', 'Áõôü ôï ðåäßï ñõèìßæåé ôï óýóôçìá - Ðñïóï÷Þ óôéò '
	. 'ÁëëáãÝò ÅÄÙ!  ÅðéëïãÝò:'
	. '<br /><strong>0</strong> = áíþíõìïò - üëïé ìðïñïýí íá äïõí'
	. '<br /><strong>1</strong> = üëïé ïé åããåãñáììÝíïé ÷ñÞóôåò'
	. '<br /><strong>2</strong> = ðñïûðïãñáììÝíïé óôï Å.Ä. ìüíï'
	. '<br /><strong>3</strong> = óõíäñïìéôÝò åðß ðëçñùìÞ ìüíï'
	. '<br /><strong>4</strong> = ÅðéëåãìÝíåò ïìÜäåò ôïõ NSN Groups ìüíï'
	. '<br /><strong>5</strong> = adhoc distribution list'
	. '<br /><strong>99</strong> = äéá÷åéñéóôÝò ìüíï.');
define('_MSNL_NLS_CHG_HLP_NSNGRPS', 'Áðáéôåß üôé ç ðáñáðÜíù ñýèìéóç <span class="thick">åìöÜíéóç</span> '
	. 'íá Ý÷åé ïñéóôåß óôï 4 ãéá ôï *NSN Groups ìüíï*. ÊÜèå NSN Group Ý÷åé Ýíá óõãêåêñéìÝíï áñéèìü ID ðïõ óõíäåäåìÝíïò '
	. 'ìå áõôü(NSN Group).  At newsletter create/send time, one can choose one or more NSN Groups to '
	. 'send to.  For only one group, this field should just have the associated group ID. '
	. 'For more than one group, each group ID should be separated by a dash, e.g. <span class="thick">1-2-3</span>.');
define('_MSNL_NLS_CHG_HLP_NBRHITS', 'When a newsletter is viewed from the web site using '
	. 'either a block link or an archives link, the newsletter\'s hit count is incremented.  '
	. 'The hit counter is NOT incremented if the user is logged in as admin.');
define('_MSNL_NLS_CHG_HLP_FILENAME', 'This field is system assigned.  If you change it, '
	. 'make sure the file name exists and it is formatted properly for viewing by this system.');
/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/
define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW', 'Ç áîßá ðñÝðåé íá åßíáé ìéá áðü ôï 0 - 4, Þ 99');
define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG', 'Update of Newsletter information failed');
/************************************************************************
* Function: msnl_nls_del
************************************************************************/
define('_MSNL_NLS_DEL_MSG_DELIMPACT', 'You are about to permanently delete this newsletter.');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1', 'All information related to this newsletter will be '
	. 'deleted from the database as well as the newsletter file within the archive directory. '
	. 'Do you wish to continue with this delete?');
/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/
define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL', 'Was unable to delete newsletter file - check '
	. 'file permissions');
define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL', 'Áðïôõ÷ßá êáôÜ ôç äéáãñáöÞ ôùí äåäïìÝíùí ôùí Å.Ä.');


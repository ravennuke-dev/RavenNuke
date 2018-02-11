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
define("_MSNL_COM_LAB_SQL", "SQL");
define("_MSNL_COM_LAB_GOBACK", "بازگشت");
define("_MSNL_COM_LAB_ERRMSG", "پیام خطا");
define("_MSNL_COM_LAB_HELPLEGENDTXT", "نشانگر خود را روی این آیکونها ببرید تا توضیح مربوطه را ببینید "
	.""
	);
define("_MSNL_COM_LNK_GOBACK", "اینجا کلیک کنید تا به صفحه قبلی بروید");
define("_MSNL_COM_ERR_SQL", "در دیتابیس با خطا مواجه شد");
define("_MSNL_COM_ERR_MODULE", "خطا در ماژول");
define("_MSNL_COM_ERR_VALMSG", "فیلدهای زیر درست تنظیم نشده اند");
define("_MSNL_COM_ERR_VALWARNMSG", "فیلدهای زیر با خطا مواجه شدند");
define("_MSNL_COM_ERR_DBGETCFG", "اطلاعات مربوط به ماژول دریافت نشد!");
define("_MSNL_COM_HLP_HELPLEGENDTXT", "بله, همینجوری درست شده!");
/************************************************************************
* Function: Common use defines between module and block
************************************************************************/
define("_MSNL_NLS_LAB_MORENLS", "خبرنامه های بیشتر...");
define("_MSNL_NLS_LAB_HIT", "دیدار");
define("_MSNL_NLS_LAB_HITS", "دیدار");
define("_MSNL_NLS_LAB_SENTON", "تاریخ ارسال");
define("_MSNL_NLS_LAB_SENDER", "فرستنده");
define("_MSNL_NLS_LNK_VIEWNL", "دیدن خبرنامه - در پنجره جدید باز میشود");
define("_MSNL_NLS_LNK_VIEWNLARCHS", "آرشیو خبرنامه");
/************************************************************************
* Function: msnl_nls_list
************************************************************************/
define("_MSNL_NLS_LST_LAB_ARCHTITL", "خبرنامه های آرشیو شده");
define("_MSNL_NLS_LST_LAB_ADMNLS", "مدیریت خبرنامه");
define("_MSNL_NLS_LST_LNK_ADMNLS", "رفتن به مدیریت خبرنامه");
define("_MSNL_NLS_LST_MSG_NONLS", "خبرنامه ای برای دیدن وجود ندارد");
/************************************************************************
* Function: msnl_nls_view
************************************************************************/
define("_MSNL_NLS_VIEW_ERR_DBGETNL", "امکان دسترسی به خبرنامه را نداریم");
define("_MSNL_NLS_VIEW_ERR_CANNOTFIND", "فایل خبرنامه درخواستی را پیدا نمیکنیم");
define("_MSNL_NLS_VIEW_ERR_NOTAUTH", "شما اجازه دیدن این خبرنامه را ندارید "
	."یا این خبرنامه وجود ندارد!");
/************************************************************************
* Function: msnl_copyright_view
************************************************************************/
define("_MSNL_CPY_LAB_COPYTITLE", "کپی رایت ماژول");
define("_MSNL_CPY_LAB_MODULEFOR", "module for");
define("_MSNL_CPY_LAB_COPY", "Copyright Information");
define("_MSNL_CPY_LAB_CREDITS", "Credit Information");
define("_MSNL_CPY_LAB_MODNAME", "Module Name");
define("_MSNL_CPY_LAB_MODVER", "Module Version");
define("_MSNL_CPY_LAB_MODDESC", "Module Description");
define("_MSNL_CPY_LAB_LICENSE", "License");
define("_MSNL_CPY_LAB_AUTHORNM", "Author Name");
define("_MSNL_CPY_LAB_AUTHOREMAIL", "Author Email");
define("_MSNL_CPY_LAB_AUTHORWEB", "Author Home Page");
define("_MSNL_CPY_LAB_PERSIAN", "پشتیبانی ماژول به فارسی");
define("_MSNL_CPY_LAB_MODDL", "Module Download");
define("_MSNL_CPY_LAB_DOCS", "Support/Help Documentation");
define("_MSNL_CPY_LAB_ORIGAUTHOR", "Original Author(s)");
define("_MSNL_CPY_LAB_CURRENTAUTHOR", "Current Author(s)");
define("_MSNL_CPY_LAB_TRANSLATIONS", "Translation Author(s)");
define("_MSNL_CPY_LAB_OTHER", "Additional Thanks");
define("_MSNL_CPY_LNK_VIEWCOPYRIGHT", "View copyright and credits");
define("_MSNL_CPY_LNK_PHPNUKE", "Go to PHP-Nuke website - will leave this site");
define("_MSNL_CPY_LNK_AUTHORHOME", "Go to Author's website - will leave this site");
define("_MSNL_CPY_LNK_DOWNLOAD", "Go to Downloads website - will leave this site");
define("_MSNL_CPY_LNK_DOCS", "Go to Documentation website - will leave this site");
define("_MSNL_CPY_LNK_PERSIANSUPPORT", "Go to Support site in Persian/Farsi - will leave this site");


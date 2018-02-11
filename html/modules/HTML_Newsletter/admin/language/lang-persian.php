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
define("_MSNL_COM_LAB_HELPLEGENDTXT", "نشانگر خود را روی این آیکونها ببرید تا توضیح مربوطه را ببینید ");
define("_MSNL_COM_LNK_GOBACK", "اینجا کلیک کنید تا به صفحه قبلی بروید");
define("_MSNL_COM_ERR_SQL", "در دیتابیس با خطا مواجه شد");
define("_MSNL_COM_ERR_MODULE", "خطا در ماژول");
define("_MSNL_COM_ERR_VALMSG", "فیلدهای زیرین درست تنظیم نشده اند");
define("_MSNL_COM_ERR_VALWARNMSG", "فیلدهای زیرین دارای اخطار هستند");
define("_MSNL_COM_ERR_DBGETCFG", "امکان گرفتن اطلاعات این ماژول نیست!");
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Yes, that is how it is done!');
/************************************************************************
* Function: General Use Defines
************************************************************************/
define("_MSNL_COM_LAB_MODULENAME", "خبرنامه HTML");
define("_MSNL_LAB_ADMIN", "مدیریت");
//Module Menu Labels and Link Titles
define("_MSNL_LAB_CREATENL", "ایجاد خبرنامه جدید");
define("_MSNL_LAB_MAINCFG", "تنظیمات عمومی");
define("_MSNL_LAB_CATEGORYCFG", "تنظیمات شاخه ها");
define("_MSNL_LAB_MAINTAINNLS", "تنظیم خبرنامه کنونی");
define("_MSNL_LAB_SENDTESTED", "فرستادن خبرنامه آماده");
define("_MSNL_LAB_SITEADMIN", "مدیریت تارنما");
define("_MSNL_LAB_NLARCHIVES", "آرشیو");
define("_MSNL_LAB_NLDOCS", "دستور استفاده آنلاین");
define("_MSNL_LNK_CREATENL", "ایجاد خبرنامه");
define("_MSNL_LNK_MAINCFG", "تنظیمات مربوط به ماژول");
define("_MSNL_LNK_CATEGORYCFG", "تنظیات فهرست خبرنامه");
define("_MSNL_LNK_MAINTAINNLS", "تنظیمات خبرنامه های کنونی");
define("_MSNL_LNK_SENDTESTED", "فرستادن آخرین خبرنامه آماده");
define("_MSNL_LNK_SITEADMIN", "رفتن به مدیریت تارنما");
define("_MSNL_LNK_NLARCHIVES", "رفتن به آرشیو خبرنامه");
define("_MSNL_LNK_NLDOCS", "گرفتن اطلاعات بیشتر آنلاین");
define("_MSNL_ERR_NOTAUTHORIZED", "شما اجازه دسترسی به بخش ماژول را ندارید");
//Common use Defines
define("_MSNL_COM_LAB_ACTIONS", "امکانات");
define("_MSNL_COM_LAB_ACTIVE", "فعال");
define("_MSNL_COM_LAB_ADD", "افزودن");
define("_MSNL_COM_LAB_ALL", "همه");
define("_MSNL_COM_LAB_GO", "برو");
define("_MSNL_COM_LAB_INACTIVE", "غیر فعال");
define("_MSNL_COM_LAB_LANG", "زبان");
define("_MSNL_COM_LAB_NO", "خیر");
define("_MSNL_COM_LAB_PREVIEW", "پیش نمایش");
define("_MSNL_COM_LAB_SAVE", "ذخیره کردن");
define("_MSNL_COM_LAB_SHOW_ALL", "**نمایش همه**");
define("_MSNL_COM_LAB_SEND", "فرستادن ");
define("_MSNL_COM_LAB_VERSION", "ورژن");
define("_MSNL_COM_LAB_YES", "بله");
define("_MSNL_COM_LNK_ADD", "اینجا کلیک کنید تا اطلاعات افزوده شود");
define("_MSNL_COM_LNK_CANCEL", "قطع کردن");
define("_MSNL_COM_LNK_CONTINUE", "ادامه دادن");
define("_MSNL_COM_LNK_SAVE", "اینجا کلیک کنید تا همه اطلاعات داده شده ذخیره شوند");
define("_MSNL_COM_LNK_SEND", "فرستادن خبرنامه");
define("_MSNL_COM_LNK_PREVIEW", "تایید کردن و نمایش خبرنامه");
define("_MSNL_COM_ERR_MSG", "پیام خطا");
define("_MSNL_COM_ERR_DBGETCATS", "شاخه های خبرنامه را بدست نیاوردیم");
define("_MSNL_COM_ERR_FILENOTEXIST", "این فایل وجود ندارد");
define("_MSNL_COM_ERR_FILENOTWRITEABLE", "امکان نوشتن و ذخیره فایل خبرنامه نیست - سطح دسترسی پوشه archive را کنترل کنید که روی 777 باشد");
define("_MSNL_COM_ERR_DBGETPHPBB", "امکان دریافت اطلاعات تالار نیست");
define("_MSNL_COM_ERR_DBGETRECIPIENTS", "خطا در بدست آوردن تعداد گیرنده برای:");
define("_MSNL_COM_MSG_WARNING", "اخطار!");
define("_MSNL_COM_MSG_UPDSUCCESS", "با موفقیت بروز شد!");
define("_MSNL_COM_MSG_ADDSUCCESS", "با موفقیت افزوده شد!");
define("_MSNL_COM_MSG_DELSUCCESS", "با موفقیت پاک شد!");
define("_MSNL_COM_MSG_REQUIRED", "فیلدهای اجباری باید پر شوند");
define("_MSNL_COM_MSG_POSNONZEROINT", "باید با یک عدد مثبت بیشتر از صفر پر شود");
define("_MSNL_COM_HLP_ACTIONS", "نشانگر ماوس را "
	."روی هر آیکون بگیرید تا اثر آن را در صورت انتخاب ببینید"
	);
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'View copyright and credits');
/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/
//Section: Letter
define("_MSNL_ADM_LAB_LETTER", "خبرنامه");
define("_MSNL_ADM_LAB_TOPIC", "عنوان");
define("_MSNL_ADM_LAB_SENDER", "نام فرستنده");
define("_MSNL_ADM_LAB_NLSCAT", "شاخه");
define("_MSNL_ADM_LAB_TEXTBODY", "متن خبرنامه");
define("_MSNL_ADM_LAB_HTMLOK", "(میتوانید از HTML استفاده کنید)");
define("_MSNL_ADM_HLP_TOPIC", "این عنوان خبرنامه شما خواهد بود در  "
	."قالب خبرنامه.  برای اینکه دچار اشکال نشوید "
	."بهتر است که عنوان کوتاه باشد - حدود 40 حرف یا کمتر.  فقط میتوانید از تگهای  "
	."HTML زیر در این فیلد استفاده کنید: & lt;b& gt; & lt;i& gt; & lt;u& gt;."
	);
define("_MSNL_ADM_HLP_SENDER", "این نام فرستنده خبرنامه در "
	."قالب خبرنامه خواهد بود.  برای اینکه این نوشته با نوشته های دیگر نمایش داده خواهد شد "
	."بهتر است که کوتاه باشد - کمتر از 20 حرف.  فقط میتوانید از تگهای "
	."HTML زیر در این فیلد استفاده کنید: & lt;b& gt; & lt;i& gt; & lt;u& gt;."
	);
define("_MSNL_ADM_HLP_NLSCAT", "شما میتوانید یک شاخه را انتخاب کنید "
	."تا این خبرنامه را در آن قرار دهید."
	);
define("_MSNL_ADM_HLP_TEXTBODY", "متن اصلی خبرنامه."
	."شما می توانید متن خود را در هر ویراشگر مناسبی بنویسید و سپس"
	."کدها را در این بخش وارد کنید."
	."استفاده از کدهای HTML مجاز است اما ممکن است"
	."نتیجه مورد نظر شما در مرورگر کاربر حاصل نشود."
	."در خبرنامه های طولانی ممکن است بخواهید به قسمت های مختلف خبرنامه لینک بدهید.در این صورت نام مناسب را برای"
	."لینک خود انتخاب و گزینه ی استفاده از جداول را در زیر فعال کنید. "
	." <br /><br />به عنوان مثال:"
	."<span class="thick">& lt;a name=\"بخش اول\"& gt;& lt;/a& gt;</span>."
	."لینک فوق کاربران شما را به قسمتی با عنوان <span class="thick">بخش اول</span> هدایت می کند."
	);
//Section: Templates
define("_MSNL_ADM_LAB_TEMPLATES", "قالب");
define("_MSNL_ADM_LAB_CHOOSETMPLT", "یک قالب را انتخاب کنید");
define("_MSNL_ADM_LNK_SHOWTEMPLATE", "برای دیدن نمونه قالب روی تصویر آن کلیک کنید");
define("_MSNL_ADM_HLP_TEMPLATES", "لیستی که مشاهده می کنید "
	."قالب هایی است که در شاخه ی modules/HTML_Newsletter/templates/ موجود هستند."
	."اگر تمایل به استفاده از قالب ندارید سیستم یک ایمیل ساده ."
	."را با متنی که در قسمت متن خبرنامه نوشته اید برای مخاطبین شما می فرستد."
	."برای ارسال خبرنامه همراه با قالب یکی از قالب ها را از لیست انتخاب کنید.برای اینکه پیش نمایشی از خبرنامه خود ببینید"
	."در سمت راست نام قالب کلیک کنید. <span class="thick">پیش نمایش</span> روی آیکون  "
	."همچنین شما می توانید قالب خود را طراحی و در شاخه ی قالب ها کپی کنید. "
	."توجه کنید Fancy_Content تنها قالبی است که "
	."نویسنده ی این ماژول آن را همراه با نسخه ی جدید ماژول"
	."ارتقا خواهد داد!"
	);
//Section: Stats and Newsletter Contents
define("_MSNL_ADM_LAB_STATS", "آمار در خبرنامه");
define("_MSNL_ADM_LAB_INCLSTATS", "آمار تارنما را نمایش بده");
define("_MSNL_ADM_LAB_INCLTOC", "نمایش لینک و اطلاعات دیگر در خبرنامه");
define("_MSNL_ADM_HLP_INCLSTATS", "انتخاب این گزینه آمار سایت شما را "
	."در قالب هایی که تگ {STATS} را داشته باشند نمایش می دهد."
	);
define("_MSNL_ADM_HLP_INCLTOC", "Checking this option will include a Table of "
	."Contents 'block' in templates which have the {TOC} tag in them - e.g., see template sample "
	."for Fancy_Content.  The TOC block will have links to each of the blocks of <span class="thick">Latest xxxxxx</span> "
	."as well as links to any <span class="thick">anchors</span> included within the <span class="thick">Newsletter Text</span> text area."
	);
//Section: Include Latest Items
define("_MSNL_ADM_LAB_INCLLATEST", "نمایش آخرینها");
define("_MSNL_ADM_LAB_INCLLATESTDLS", "تعداد آخرین فایلها در دریافت فایل");
define("_MSNL_ADM_LAB_INCLLATESTWLS", "تعداد آخرین پیوستها");
define("_MSNL_ADM_LAB_INCLLATESTFORS", "تعداد آخرین تاپیکهای انجمن");
define("_MSNL_ADM_LAB_INCLLATESTNEWS", "تعداد خبرهای تارنما");
define("_MSNL_ADM_LAB_INCLLATESTREVS", "تعداد آخرین نقد و بررسی");
define("_MSNL_ADM_HLP_INCLLATESTNEWS", "تنظیم تعداد خبرها برای نمایش در خبرنامه"
	."خبرها بر اساس تاریخ مرتب می شوند و آخرین خبر در ابتدا قرار خواهد گرفت."
	."اگر می خواهید خبرها نمایش داده نشوند از مقدار صفر (0) استفاده کنید."
	."این مقدار برای تمام خبرنامه ها ثابت خواهد بود اما شما هر زمان که اراده کنید"
	."می توانید آنرا برای هر خبرنامه ای تغییر دهید."
	);
define("_MSNL_ADM_HLP_INCLLATESTDLS", "تنظیم تعداد دانلودها برای نمایش در خبرنامه"
	."دانلودها بر اساس تاریخ مرتب می شوند و آخرین دانلود در ابتدا قرار خواهد گرفت."
	."اگر می خواهید دانلودها نمایش داده نشوند از مقدار صفر (0) استفاده کنید."
	."این مقدار برای تمام خبرنامه ها ثابت خواهد بود اما شما هر زمان که اراده کنید"
	."می توانید آنرا برای هر خبرنامه ای تغییر دهید."
	);
define("_MSNL_ADM_HLP_INCLLATESTWLS", "تنظیم تعداد لینک ها برای نمایش در خبرنامه"
	."لینک ها بر اساس تاریخ مرتب می شوند و آخرین لینک در ابتدا قرار خواهد گرفت. "
	."اگر می خواهید دانلودها نمایش داده نشوند از مقدار صفر (0) استفاده کنید."
	."این مقدار برای تمام خبرنامه ها ثابت خواهد بود اما شما هر زمان که اراده کنید "
	."می توانید آنرا برای هر خبرنامه ای تغییر دهید."
	);
define("_MSNL_ADM_HLP_INCLLATESTFORS", "تنظیم تعداد آخرین پست های انجمن برای نمایش در خبرنامه"
	."پست ها بر اساس تاریخ مرتب می شوند و آخرین پست در ابتدا قرار خواهد گرفت"
	."اگر می خواهید آخرین پست ها نمایش داده نشوند از مقدار صفر (0) استفاده کنید "
	."این مقدار برای تمام خبرنامه ها ثابت خواهد بود اما شما هر زمان که اراده کنید"
	."می توانید آنرا برای هر خبرنامه ای تغییر دهید.بعلاوه فقط پست های عمومی در خبر نامه "
	."نمایش داده خواهند شد."
	);
define("_MSNL_ADM_HLP_INCLLATESTREVS", "تنظیم تعداد نقد و بررسی ها برای نمایش در خبرنامه"
	."نقد ها بر اساس تاریخ مرتب می شوند و آخرین نقد در ابتدا قرار خواهد گرفت "
	."اگر می خواهید نقدها نمایش داده نشوند از مقدار صفر (0) استفاده کنید"
	."این مقدار برای تمام خبرنامه ها ثابت خواهد بود اما شما هر زمان که اراده کنید "
	."می توانید آنرا برای هر خبرنامه ای تغییر دهید."
	);
//Section: Sponsors
define("_MSNL_ADM_LAB_SPONSORS", "پشتیبانها (اسپانسرها)");
define("_MSNL_ADM_LAB_CHOOSESPONSOR", "یک بنر را انتخاب کنید");
define("_MSNL_ADM_LAB_NOSPONSOR", "بدون بنر");
define("_MSNL_ADM_HLP_CHOOSESPONSOR", "با انتخاب یک بنر  "
	."شما میتوانید یک بنر از اسپانسر خود در خبرنامه به نمایش بگذارید. این بنر باید در سیستم تبلیغاتی "
	."ابتدا موجود باشد"
	);
define("_MSNL_ADM_ERR_DBGETBANNERS", "اطلاعات مربوط به بنر بدست نیامد");
//Section: Who to Send the Newsletter To
define("_MSNL_ADM_LAB_WHOSNDTO", "این خبرنامه را به چه کسانی میخواهید بفرستید؟");
define("_MSNL_ADM_LAB_CHOOSESENDTO", "انتخاب گیرندگان خبرنامه");
define("_MSNL_ADM_LAB_WHOSNDTONLSUBS", "فقط کاربران عضو خبرنامه");
define("_MSNL_ADM_LAB_WHOSNDTOALLREG", "همه کاربران عضو تارنما");
define("_MSNL_ADM_LAB_WHOSNDTOPAID", "فقط کاربران که مشتری هستند");
define("_MSNL_ADM_LAB_WHOSNDTOANONY", "به همه دیدارکنندگان تارنما - هیچ ایمیلی فرستاده نخواهد شد, ول بازدیدکنندگان "
	."میتوانند خبرنامه را در بلوک مربوطه ببینند"
	);
define("_MSNL_ADM_LAB_WHOSNDTONSNGRPS", "یک یا چند گروه ساخته شده - گروه را در زیر انتخاب کنید");
define("_MSNL_ADM_LAB_WHOSNDTOADM", "ایمیل آزمایشی(فقط به مدیر تارنما)");
define("_MSNL_ADM_LAB_SUBSCRIBEDUSRS", "اعضای خبرنامه");
define("_MSNL_ADM_LAB_USERS", "کاربران");
define("_MSNL_ADM_LAB_PAIDUSRS", "مشتریان");
define("_MSNL_ADM_LAB_NSNGRPUSRS", "NSN Group users");
define("_MSNL_ADM_LAB_WHOSNDTOADHOC", "ایمیل مشخص شده");
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)');
define("_MSNL_ADM_LAB_WHOSNDTOANONYV", "همه دیدارکنندگان");
define("_MSNL_ADM_HLP_WHOSNDTONLSUBS", "انتخاب این گزینه خبرنامه را "
	."برای تمام کاربرانی که در تنظیمات کاربری برای خبرنامه ثبت نام کرده اند  "
	."می فرستد"
	);
define("_MSNL_ADM_HLP_WHOSNDTOALLREG", "انتخاب این گزینه خبرنامه را "
	."برای تمام کاربران ثبت شده شما می فرستد.دقت کنید ممکن است کاربران شما "
	." از دریافت خبرنامه ای که برای آن ثبت نام نکرده اند ناراحت شوند"
	);
define("_MSNL_ADM_HLP_WHOSNDTOPAID", "Choosing this option will send the newsletter "
	."to all of your site's paid subscribers - i.e., those with active subscriptions."
	);
define("_MSNL_ADM_HLP_NSNGRPUSRS", "Choosing this option will allow you to select "
	."one or more NSN Groups below to have the newsletter sent to."
	);
define("_MSNL_ADM_HLP_WHOSNDTOANONYV", "انتخاب این گزینه خبرنامه ای را نخواهد فرستاد"
	."اما این خبرنامه در آرشیو و بلوک نمایش داده می شوند."
	."به خاطر داشته باشید که مجوزهای ماژول و بلوک باید تنظیم باشند."
	);
define("_MSNL_ADM_HLP_WHOSNDTOADM", "انتخاب این گزینه یک خبرنامه آزمایشی برای شما(مدیر سایت) خواهد فرستاد."
	."وقتی که شما از آماده بودن خبرنامه برای ارسال اطمینان پیدا کردید"
	."از لینک <span class="thick">ارسال خبرنامه ی تست شده</span> در بالای صفحه ."
	."استفاده کنید."
	);
define("_MSNL_ADM_HLP_WHOSNDTOADHOC", "انتخاب این گزینه امکان ارسال خبرنامه را به یک یا چند"
	." ایمیلی که انتخاب کرده اید فراهم می کند.شما باید ایمیل ها را با کاما"
	."جدا کنید و از درست بودن آن ها اطمینان داشته باشید."
	);
//Section: NSN Groups
define("_MSNL_ADM_LAB_CHOOSENSNGRP", "Which NSN Group(s) to send to?");
define("_MSNL_ADM_LAB_CHOOSENSNGRP1", "(selection will be ignored if NSN Group option "
	."not chosen above)"
	);
define("_MSNL_ADM_LAB_WHONSNGRP", "انتخاب یک یا چند گروه");
define("_MSNL_ADM_ERR_DBGETNSNGRPS", "Unable to get NSN Groups information");
define("_MSNL_ADM_HLP_CHOOSENSNGRPUSRS", "یک یا چند گروه را انتخاب کنید.خبرنامه "
	."برای تمام گروه های انتخاب شده ارسال می شود.در صورتی که یک کاربر "
	."در بیش از یک گروه عضو باشد خبرنامه فقط یک بار برای او ارسال می شود "
	);
/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/
define("_MSNL_ADM_PREV_LAB_VALPREVNL", "ایجاد خبرنامه جدید - تایید و پیش نمایش");
define("_MSNL_ADM_PREV_LAB_PREVNL", "پیش نمایش خبرنامه");
define("_MSNL_ADM_PREV_MSG_SUCCESS", "خبرنامه آماده فرستادن میباشد "
	."نمونه آن را در زیر میتوانید ببینید");
/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/
define("_MSNL_ADM_LAB_NSNGRPS", "NSN Groups");
define("_MSNL_ADM_VAL_NONSNGRP", "You have chosen to send to a NSN Group but "
	."have not selected a group to send to"
	);
define("_MSNL_ADM_ERR_NOTEMPLATE", "قالبی انتخاب نشده است!");
define("_MSNL_ADM_VAL_NOSENDTO", "آماده نشده اند!");
define("_MSNL_ADM_ERR_DBUPDLATEST", "Had error on updating 'Latest _____' configuration information");
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/
define("_MSNL_ADM_SEND_LAB_SENDNL", "ایجاد خبرنامه-ارسال ایمیل");
define("_MSNL_ADM_SEND_LAB_TESTNLFROM", "Test Newsletter from");
define("_MSNL_ADM_SEND_LAB_NLFROM", "Newsletter from");
define("_MSNL_ADM_SEND_MSG_ANONYMOUS", "خبرنامه برای نمایش بوسیله تمام کاربران اضافه شد.");
define("_MSNL_ADM_SEND_MSG_LOTSSENT", "بیش از 500 کاربر این خبرنامه را دریافت خواهند کرد "
	."این عمل ممکن است بیش از 10 دقیقه طول بکشد یا اینکه با پیام خطای PHP روبرو شوید"
	);
define('_MSNL_ADM_SEND_MSG_TOTALSENT', 'Total Emails to Send');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define("_MSNL_ADM_SEND_MSG_SENDSUCCESS", "خبرنامه ها با موفقیت ارسال شدند.");
define("_MSNL_ADM_SEND_MSG_SENDFAILURE", "ارسال خبرنامه ها با مشکل مواجه شد.");
define("_MSNL_ADM_SEND_ERR_NOTESTEMAIL", "فایل testemail.php پیدا نشد.");
define("_MSNL_ADM_SEND_ERR_INVALIDVIEW", "تنظیمات اشتباه!");
define("_MSNL_ADM_SEND_ERR_CREATENL", "کپی کردن از ایمیل تست شده به فایل خبرنامه"
	."با مشکل مواجه شد!"
	);
define("_MSNL_ADM_SEND_ERR_DBNLSINSERT", "ثبت خبرنامه در دیتابیس با مشکل"
	."مواجه شد"
	);
define("_MSNL_ADM_SEND_ERR_DBNLSNID", "Was not able to get the NID of the just "
	."inserted newsletter"
	);
define("_MSNL_ADM_SEND_ERR_MAIL", "خطا در"
	."ارسال خبرنامه"
	);
define("_MSNL_ADM_SEND_ERR_DELFILETEST", "پاک کردن فایل testemail.php با مشکل مواجه شد! ");
define("_MSNL_ADM_SEND_ERR_DELFILETMP", "پاک کردن tmp.php با مشکل مواجه شد");
/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR", "دریافت آمار کاربران ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS", "دریافت آمار بازدیدهای کلی سایت ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS", " دریافت آمار خبرها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT", "دریافت آمار شاخه های خبرها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS", "دریافت آمار تعداد دانلودها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT", "دریافت آمار شاخه های دانلودها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS", "دریافت آمار لینک ها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT", "دریافت آمار شاخه های لینک ها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS", "دریافت آمار انجمن ها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS", "دریافت آمار پست های انجمن ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS", "دریافت آمار نقدها ممکن نیست");
define("_MSNL_ADM_SEND_ERR_DBGETNEWS", "دریافت عنوان آخرین خبرها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETDLS", "دریافت اطلاعات آخرین دانلودها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETWLS", "دریافت اطلاعات آخرین لینک ها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETPOSTS", "دریافت آخرین پست های انجمن ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETREVIEWS", "دریافت آخرین نقد ها ممکن نیست");
define("_MSNL_ADM_MAKE_ERR_DBGETBANNER", "دریافت بنر ممکن نیست");
/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/
define("_MSNL_ADM_TEST_LAB_PREVNL", "پیش نمایش خبرنامه های تایید شده برای فرستادن");
/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/
define("_MSNL_CFG_LAB_MAINCFG", "تنظیمات عمومی ماژول");
//Module Options
define("_MSNL_CFG_LAB_MODULEOPT", "امکانات ماژول");
define("_MSNL_CFG_LAB_DEBUGMODE", "مود رفع اشکال");
define("_MSNL_CFG_LAB_DEBUGMODE_OFF", "خاموش");
define("_MSNL_CFG_LAB_DEBUGMODE_ERR", "خطا");
define("_MSNL_CFG_LAB_DEBUGMODE_VER", "توضیحات کامل");
define("_MSNL_CFG_LAB_DEBUGOUTPUT", "خروجی مود رفع اشکال");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_DIS", "نمایش");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_LOG", "LOG FILE");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_BTH", "هر دو");
define("_MSNL_CFG_LAB_SHOWBLOCKS", "نمایش بلوک های سمت راست");
define("_MSNL_CFG_LAB_NSNGRPS", "Use NSN Groups");
define("_MSNL_CFG_LAB_DLMODULE", "دریافت نام ماژول");
define("_MSNL_CFG_LAB_WYSIWYGON", "استفاده از ویرایشگر");
define("_MSNL_CFG_LAB_WYSIWYGROWS", "ردیف های موجود در متن خبرنامه");
define("_MSNL_CFG_HLP_DEBUGMODE", "این گزینه به مدیر امکان تنظیم مقادیر مختلف برای نمایش خطای مود رفع اشکال را می دهد.به صورت زیر:"
	."<br /><strong>خاموش</strong> = فقط نمایش خطا بدون توضیحات"
	.".<br /><strong>خطا</strong> = نمایش خطا همراه با توضیحات مفید.در این حالت خطاهای دیتابیس هم نمایش داده می شوند. "
	."<br /> <strong>توضیحات کامل</strong>=توضیحات کامل همراه با نام فایل ها و آدرس آن ها. "
	."فعال بود این گزینه امنیت سایت شما را به خطر می اندازد.پس برای مدت زیادی از آن استفاده نکنید."
	);
define("_MSNL_CFG_HLP_DEBUGOUTPUT", "این گزینه در حال حاضر کاربردی ندارد.در آینده"
	."امکان نمایش خطا در مرورگر،LOG FILE و یا هر دو فراهم می شود."
	."file, or both."
	);
define("_MSNL_CFG_HLP_SHOWBLOCKS", "اگر این گزینه را انتخاب کنید"
	."بلوک های سمت راست در ماژول نمایش داده می شوند.این گزینه به صورت پیشفرض انتخاب نشده است."
	);
define("_MSNL_CFG_HLP_NSNGRPS", "This option can only be used if you have "
	."NSN Groups add-on installed.  If you would like to be able to send newsletters "
	."to one or more NSN Groups, check this option."
	);
define("_MSNL_CFG_HLP_DLMODULE", "Replace this with the proper module "
	."extension, i.e. the default module is 'downloads' from nuke_"
	."<strong>downloads</strong>_downloads. For NSN Groups module, it is 'nsngd' "
	."from nuke_<strong>nsngd</strong>_downloads."
	);
define("_MSNL_CFG_HLP_WYSIWYGON", " این گزینه را در صورتی انتخاب کنید که تصمیم به"
	."استفاده از ویرایشگر دارید."
	."توجه:ویرایشگر نیوک باید از قبل نصب شده باشد."
	);
define("_MSNL_CFG_HLP_WYSIWYGROWS", "تعداد ردیف هایی که "
	."در صفحه ی ایجاد خبرنامه در قسمت متن خبرنامه تنظیم شده اند."
	."این گزینه هم با ویرایشگر و هم بدون آن کار خواهد کرد."
	);
//Show Options
define("_MSNL_CFG_LAB_SHOWOPT", "نمایش تنظیمات");
define("_MSNL_CFG_LAB_SHOWCATS", "نمایش شاخه ها");
define("_MSNL_CFG_LAB_SHOWHITS", "نمایش تعداد بازدیدها");
define("_MSNL_CFG_LAB_SHOWDATES", "تاریخ ارسال");
define("_MSNL_CFG_LAB_SHOWSENDER", "نمایش فرستنده");
define("_MSNL_CFG_HLP_SHOWCATS", "انتخاب این گزینه خبرنامه ها را"
	."به ترتیب شاخه ها در بلوک مرتب خواهد کرد!شاخه ها همیشه در آرشیو"
	."نمایش داده می شوند!"
	);
define("_MSNL_CFG_HLP_SHOWHITS", "انتخاب این گزینه تعداد نمایش های خبرنامه ها را"
	."در بلوک و آرشیو نمایش می دهد."
	);
define("_MSNL_CFG_HLP_SHOWDATES", "انتخاب این گزینه تاریخ ارسال خبرنامه ها را "
	."در بلوک و آرشیو نمایش می دهد."
	);
define("_MSNL_CFG_HLP_SHOWSENDER", "انتخاب این گزینه فرستنده خبرنامه ها را"
	."در بلوک و آرشیو نمایش می دهد."
	);
//Block Options
define("_MSNL_CFG_LAB_BLKOPT", "تنظیمات بلوک");
define("_MSNL_CFG_LAB_BLKLMT", "خبرنامه های مورد نظر برای نمایش در بلوک");
define("_MSNL_CFG_LAB_SCROLL", "نمایش بلوک به صورت رونده");
define("_MSNL_CFG_LAB_SCROLLHEIGHT", "ارتفاع بلوک رونده");
define("_MSNL_CFG_LAB_SCROLLAMT", "Scrolling code amount");
define("_MSNL_CFG_LAB_SCROLLDELAY", "تاخیر نمایش اطلاعات در بلوک رونده");
define("_MSNL_CFG_HLP_BLKLMT", "محدود کردن تعداد نمایش خبرنامه ها در بلوک"
	."اگر شاخه ها فعال هستند تعداد خبرنامه ها برای نمایش در شاخه ی خاص"
	."از بخش دیگری تنظیم می شود."
	);
define("_MSNL_CFG_HLP_SCROLL", "این گزینه بلوک را به حالت رونده "
	."در خواهد آورد."
	);
define("_MSNL_CFG_HLP_SCROLLHEIGHT", "تنظیم ارتفاع بلوک رونده در واحد پیکسل."
	."مقدار پیشفرض:180"
	);
define("_MSNL_CFG_HLP_SCROLLAMT", "Set the scroll amount on the scrolling, "
	."this in affect is the distance the Info will move in-between the Scroll delay. "
	."Default is 2."
	);
define("_MSNL_CFG_HLP_SCROLLDELAY", "تنظیم مقدار تاخیر در نمایش اطلاعات"
	."دربلوک به میلی ثانیه.مقدار پیشفرض:25"
	);
/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/
define("_MSNL_CFG_APPLY_ERR_DBFAILED", "بروز رسانی تنظیمات با مشکل مواجه شد!");
define("_MSNL_CFG_APPLY_VAL_DEBUGMODE", "Invalid Debug Mode was provided - might have "
	."problem with module installation"
	);
define("_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT", "Invalid Debug Output was provided - might have "
	."problem with module installation"
	);
define("_MSNL_CFG_APPLY_MSG_BACK", "بازگشت به تنظیمات اصلی");
/************************************************************************
* Function: msnl_cat	(Maintain Newsletter Categories)
************************************************************************/
define("_MSNL_CAT_LAB_CATCFG", "تنظیمات شاخه های خبرنامه");
define("_MSNL_CAT_LAB_ADDCAT", "افزودن شاخه");
define("_MSNL_CAT_LAB_CATTITLE", "عنوان شاخه");
define("_MSNL_CAT_LAB_CATDESC", "توضیح شاخه");
define("_MSNL_CAT_LAB_CATBLOCKLMT", "Block Limit");
define("_MSNL_CAT_LNK_ADDCAT", "افزودن یک شاخه ی جدید");
define("_MSNL_CAT_LNK_CATCHG", " ویرایش شاخه خبرنامه");
define("_MSNL_CAT_LNK_CATDEL", "پاک کردن شاخه خبرنامه");
define("_MSNL_CAT_MSG_CATBACK", "بازگشت به لیست خبرنامه");
define("_MSNL_CAT_ERR_DBGETCAT", "دریافت اطلاعات شاخه ها با مشکل مواجه شد");
define("_MSNL_CAT_ERR_DBGETCATS", "دریافت شاخه ها با مشکل مواجه شد");
define("_MSNL_CAT_ERR_NOCATS", "شاخه ای پیدا نشد!مشکل در نصب!");
define("_MSNL_CAT_ERR_INVALIDCID", "نام غیر قابل قبول برای شاخه!");
define("_MSNL_CAT_ERR_DBGETCNT", "دریافت تعداد خبرنامه های ادغام شده با مشکل مواجه شد!");
define("_MSNL_CAT_HLP_CATTITLE", "این فیلد عنوان شاخه است که  "
	."در بلوک و آرشیو نمایش داده می شود."
	."به دلیل اینکه این عنوان در بلوک نمایش داده می شود "
	."شما باید این فیلد را با 30 کاراکتر(یا کمتر) پر کنید تا بلوک "
	."درست نمایش داده شود."
	);
define("_MSNL_CAT_HLP_CATDESC", "استفاده از کدهای HTML در این"
	."ممنوع است.سعی کنید یک شرح مناسب برای شاخه اتخاب کنید."
	);
define("_MSNL_CAT_HLP_CATBLOCKLMT", "این فیلد فقط وقتی مورد استفاده قرار می گیرد که گزینه ی"
	."نمایش شاخه ها انتخاب شده باشد."
	."تعداد خبرنامه هایی را که می خواهید زیر این شاخه در بلوک نمایش داده شوند اینجا وارد کنید."
	."این مقدار باید بیشتر از صفر باشد."
	);
/************************************************************************
* Function: msnl_cat_add
************************************************************************/
define("_MSNL_CAT_ADD_LAB_CATADD", "تنظیمات شاخه های خبرنامه-افزودن یک شاخه");
/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/
define("_MSNL_CAT_ADD_APPLY_DBCATADD", "افزودن شاخه خبرنامه با مشکل مواجه شد ");
/************************************************************************
* Function: msnl_cat_chg
************************************************************************/
define("_MSNL_CAT_CHG_LAB_CATCHG", "تنظیمان شاخه های خبرنامه-تغییر شاخه");
define("_MSNL_CAT_CHG_MSG_CHGIMPACT", "خبرنامه(ها) با این تغییر ادغام خواهند شد.");
/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/
define("_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG", "بروز رسانی شاخه با مشکل مواجه شد");
/************************************************************************
* Function: msnl_cat_del
************************************************************************/
define("_MSNL_CAT_DEL_MSG_DELIMPACT", "با این پاک کردن خبرنامه(ها) ادغام خواهند شد.");
define("_MSNL_CAT_DEL_MSG_DELIMPACT1", "Impacted newsletters will be re-assigned to the "
	."default unassigned newsletter category.  Do you wish to continue with this delete?"
	);
/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/
define("_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN", "جایگزین کردن خبرنامه ها با مشکل مواجه شد!");
define("_MSNL_CAT_DEL_APPLY_ERR_DBDELETE", "پاک کردن شاخه خبرنامه با مشکل مواجه شد");
/************************************************************************
* Function: msnl_nls
************************************************************************/
define("_MSNL_NLS_LAB_NLSCFG", "خبرنامه های ذخیره شده");
define("_MSNL_NLS_LAB_CURRENTCAT", "شاخه فعلی");
define("_MSNL_NLS_LAB_DATESENT", "تاریخ ارسال");
define("_MSNL_NLS_LAB_CATEGORY", "شاخه");
define("_MSNL_NLS_LNK_GETNLS", "دریافت خبرنامه ی درخواست شده");
define("_MSNL_NLS_LNK_VIEWNL", "نمایش خبرنامه-ممکن است در پنجره جدید باز شود");
define("_MSNL_NLS_LNK_NLSCHG", "ویرایش اطلاعات خبرنامه");
define("_MSNL_NLS_LNK_NLSDEL", "پاک کردن خبرنامه");
define("_MSNL_NLS_MSG_NONLSS", "خبرنامه ای در این شاخه پیدا نشد");
define("_MSNL_NLS_MSG_NLSBACK", "بازگشت به لیست خبرنامه");
define("_MSNL_NLS_ERR_DBGETNLSS", "دریافت خبرنامه ها با مشکل مواجه شد");
define("_MSNL_NLS_ERR_DBGETNLS", "دریافت اطلاعات خبرنامه با مشکل مواجه شد");
define("_MSNL_NLS_ERR_INVALIDNID", "نام غیرقابل قبول برای خبرنامه!");
define("_MSNL_NLS_ERR_NONLSS", "خبرنامه ای پیدا نشد-مشکل در نصب!");
/************************************************************************
* Function: msnl_nls_chg
************************************************************************/
define("_MSNL_NLS_CHG_LAB_NLSCHG", "تغییر اطلاعات خبرنامه");
define("_MSNL_NLS_CHG_LAB_DATESENT", "تاریخ ارسال");
define("_MSNL_NLS_CHG_LAB_WHOVIEW", "کسانی که می توانند خبرنامه را مشاهده کنند.");
define("_MSNL_NLS_CHG_LAB_NSNGRPS", "NSN Groups Can View Newsletter");
define("_MSNL_NLS_CHG_LAB_NBRHITS", "تعداد نمایش");
define("_MSNL_NLS_CHG_LAB_FILENAME", "نام خبرنامه");
define("_MSNL_NLS_CHG_LAB_CAUTION", "فقط اگر از کار خود اطمینان دارید مقادیر زیر را تغییر دهید");
define("_MSNL_NLS_CHG_HLP_DATESENT", "تاریخ باید در فرمت YYYY-MM-DD وارد شود"
	."وقتی یک خبرنامه ایجاد و ارسال می وشد این فیلد"
	."با تاریخ سایت تنظیم می شود.خبرنامه ها بر اساس تاریخ تنظیم می شوند و "
	."جدیدترین خبرنامه در ابتدای لیست قرار خواهد گرفت."
	);
define("_MSNL_NLS_CHG_HLP_WHOVIEW", "این فیلد مربوط به سیستم است.در تغییر آن "
	."دقت کنید.مقادیر قابل قبول عبارتند از:"
	."<br /><strong>0</strong> = مهمان-قابل نمایش برای همه"
	."<br /><strong>1</strong> = .تمام کاربران ثبت نام شده"
	."<br /><strong>2</strong> = .فقط اعضایی که برای خبرنامه ثبت نام کرده اند"
	."<br /><strong>3</strong> = .فقط اعضای رسمی سایت"
	."<br /><strong>4</strong> = selected NSN Groups only"
	."<br /><strong>5</strong> = adhoc distribution list"
	."<br /><strong>99</strong> = .فقط مدیر سایت"
	);
define("_MSNL_NLS_CHG_HLP_NSNGRPS", "Requires that the above <span class="thick">view</span> option "
	."be set to 4 for *NSN Groups only*. Each NSN Group has a specific ID number associated "
	."with it.  At newsletter create/send time, one can choose one or more NSN Groups to "
	."send to.  For only one group, this field should just have the associated group ID. "
	."For more than one group, each group ID should be separated by a dash, e.g. <span class="thick">1-2-3</span>."
	);
define("_MSNL_NLS_CHG_HLP_NBRHITS", "وقتی خبرنامه در سایت نمایش پیدا می کند"
	." تعداد نمایش بالا می رود."
	."البته این مقدار با بازید مدیر تغییری نمی کند."
	);
define("_MSNL_NLS_CHG_HLP_FILENAME", "این فیلد مربوط به سیستم است.قبل از تغییر آن "
	." از وجود نام فایل و سازگاری این نام با سیستم اطمینان حاصل کنید. "
	);
/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/
define("_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW", "این مقدار باید یکی از مقادیر 0 تا 4 یا 99 باشد.");
define("_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG", "بروز رسانی اطلاعات خبرنامه با مشکل مواجه شد");
/************************************************************************
* Function: msnl_nls_del
************************************************************************/
define("_MSNL_NLS_DEL_MSG_DELIMPACT", "شما می خواهید این خبرنامه را پاک کنید.");
define("_MSNL_NLS_DEL_MSG_DELIMPACT1", "تمام اطلاعات مربوط به این خبرنامه "
	." از دیتابیس و آرشیو پاک خواهد شد! "
	."آیا از این کار اطمینان دارید؟"
	);
/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/
define("_MSNL_NLS_DEL_APPLY_ERR_FILEDEL", "پاک کردن خبرنامه ممکن نیست.مجوزهای دسترسی را "
	."بررسی کنید"
	);
define("_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL", "پاک کردن اطلاعات خبرنامه با مشکل مواجه شد");


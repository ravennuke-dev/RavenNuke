<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007-2008 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// gcal_install.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
//
// Installer/Upgrade script for GCalendar.
// This is a version with all collate information removed.
// Also removed are the CREATE TABLE options.
//
///////////////////////////////////////////////////////////////////////

require 'mainfile.php';
include 'header.php';
OpenTable();

$gcalCurVer = '1.7.1';
title('GCalendar ' . $gcalCurVer . ' Installer');

function gcalNewInstall()
{
   global $db, $prefix, $adminmail;

   $sql = ' CREATE TABLE ' . $prefix . '_gcal_category ( `id` int( 11 ) NOT NULL auto_increment ,'
           . ' `name` varchar( 128 ) NOT NULL ,'
           . ' PRIMARY KEY ( `id` ) ) ;';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem creating category table!');
   }

   $sql = 'INSERT INTO ' . $prefix . '_gcal_category VALUES (1, \'Unfiled\');';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into category table!');
   }
   $sql = 'INSERT INTO ' . $prefix . '_gcal_category VALUES (2, \'Show\');';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into category table!');
   }
   $sql = 'INSERT INTO ' . $prefix . '_gcal_category VALUES (3, \'Birthday\');';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into category table!');
   }
   $sql = 'INSERT INTO ' . $prefix . '_gcal_category VALUES (4, \'Release Date\');';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into category table!');
   }
   $sql = 'INSERT INTO ' . $prefix . '_gcal_category VALUES (5, \'Anniversary\');';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into category table!');
   }
   $sql = 'INSERT INTO ' . $prefix . '_gcal_category VALUES (6, \'Site Event\');';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into category table!');
   }

   $sql = ' CREATE TABLE ' . $prefix . '_gcal_config ('
           . ' `id` int(11) NOT NULL auto_increment,'
           . ' `title` varchar(128) NOT NULL default \'Calendar of Events\','
           . ' `image` varchar(255) NOT NULL,'
           . ' `min_year` int(10) unsigned NOT NULL default \'2006\','
           . ' `max_year` int(10) unsigned NOT NULL default \'2037\','
           . ' `user_submit` enum(\'off\',\'members\',\'anyone\',\'groups\') NOT NULL default \'off\','
           . ' `req_approval` tinyint(1) NOT NULL default \'1\','
           . ' `allowed_tags` text NOT NULL,'
           . ' `allowed_attrs` text NOT NULL,'
           . ' `version` varchar(16) NOT NULL,'
           . ' `time_in_24` tinyint(1) NOT NULL default \'0\','
           . ' `short_date_format` varchar(16) NOT NULL,'
           . ' `reg_date_format` varchar(16) NOT NULL,'
           . ' `long_date_format` varchar(16) NOT NULL,'
           . ' `first_day_of_week` tinyint(1) NOT NULL default \'0\','
           . ' `auto_link` tinyint(1) NOT NULL default \'0\','
           . ' `location_required` tinyint(1) NOT NULL default \'0\','
           . ' `details_required` tinyint(1) NOT NULL default \'0\','
           . ' `email_notify` tinyint(1) NOT NULL default \'0\','
           . ' `email_to` varchar(255) NOT NULL,'
           . ' `email_subject` varchar(255) NOT NULL,'
           . ' `email_msg` varchar(255) NOT NULL,'
           . ' `email_from` varchar(255) NOT NULL,'
           . ' `show_cat_legend` tinyint(1) NOT NULL default \'1\','
           . ' `wysiwyg` tinyint(1) NOT NULL DEFAULT \'0\','
           . ' `user_update` tinyint(1) NOT NULL DEFAULT \'0\','
           . ' `weekends` SET( \'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\' ) NOT NULL DEFAULT \'0,6\','
           . ' `rsvp` ENUM( \'off\', \'on\', \'email\' ) NOT NULL DEFAULT \'off\','
           . ' `rsvp_email_subject` VARCHAR( 255 ) NOT NULL DEFAULT \'Event RSVP Notification\','
           . ' `groups_submit` TEXT NOT NULL,'
           . ' `groups_no_approval` TEXT NOT NULL,'
           . ' PRIMARY KEY (`id`)'
           . ' ) ;';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem creating config table!');
   }

   $sql = 'INSERT INTO ' . $prefix . '_gcal_config VALUES (1, \'Calendar of Events\', \'images/admin/gcalendar.gif\', ' .
      '2006, 2037, \'members\', 1, \'a,b,i,img\', \'href,src,border,alt,title\', \'\', 0, \'\', \'\', \'\', 0, ' .
      "0, 0, 0, 0, '$adminmail', 'New GCalender Event', 'A new GCalendar event was submitted.', '$adminmail', 1, 0, 0, " .
      "'0,6', 'off', 'Event RSVP Notification', '', '');";
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem inserting values into config table!');
   }

   updateConfig1_1_0();

   $sql = ' CREATE TABLE ' . $prefix . '_gcal_event ('
           . ' `id` int(11) NOT NULL auto_increment,'
           . ' `title` varchar(255) NOT NULL,'
           . ' `no_time` tinyint(1) NOT NULL default \'1\','
           . ' `start_time` time NOT NULL default \'00:00:00\','
           . ' `end_time` time NOT NULL default \'00:00:00\','
           . ' `location` text NOT NULL,'
           . ' `category` int(11) NOT NULL,'
           . ' `repeat_type` enum(\'none\',\'daily\',\'weekly\',\'monthly\',\'yearly\') NOT NULL default \'none\','
           . ' `details` text NOT NULL,'
           . ' `interval_val` int(11) NOT NULL,'
           . ' `no_end_date` tinyint(1) NOT NULL default \'1\','
           . ' `start_date` date NOT NULL,'
           . ' `end_date` date NOT NULL,'
           . ' `weekly_days` set(\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\') NOT NULL,'
           . ' `monthly_by_day` tinyint(1) NOT NULL,'
           . ' `submitted_by` varchar(25) NOT NULL,'
           . ' `approved` tinyint(1) NOT NULL default \'0\','
           . ' `rsvp` ENUM( \'off\', \'on\', \'email\' ) NOT NULL DEFAULT \'off\','
           . ' PRIMARY KEY (`id`),'
           . ' KEY `approved` (`approved`),'
           . ' KEY `start_date` (`start_date`),'
           . ' KEY `repeat_type` (`repeat_type`)'
           . ' ) ;';
   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem creating event table!');
   }

   createRsvpTable();
   createExceptionTable();
   createCatGroupTable();
}

function updateConfig1_1_0()
{
   global $db, $prefix, $language, $gcalCurVer;

   if ($language == 'english')
   {
      // assume USA...does UK have same?
      $time24        = 0;
      $shortDateFmt  = '%m/%d';
      $regDateFmt    = '%B %d, %Y';
      $longDateFmt   = '%A, %B %d, %Y';
      $fdotw         = 0;
   }
   else if ($language == 'dutch')
   {
      $time24        = 1;
      $shortDateFmt  = '%d.%m';
      $regDateFmt    = '%d %B %Y';
      $longDateFmt   = '%A %d %B %Y';     // I'm guessing here...
      $fdotw         = 0;
   }
   else  // give European (????) defaults
   {
      $time24        = 1;
      $shortDateFmt  = '%d.%m';
      $regDateFmt    = '%d. %B %Y';
      $longDateFmt   = '%A %d. %B %Y';    // I'm guessing here
      $fdotw         = 1;
   }

   $sql = 'UPDATE ' . $prefix . '_gcal_config SET' .
      " version = '$gcalCurVer'," .
      " time_in_24 = '$time24'," .
      " short_date_format = '$shortDateFmt'," .
      " reg_date_format = '$regDateFmt'," .
      " long_date_format = '$longDateFmt'," .
      " first_day_of_week = '$fdotw'" .
      ' WHERE id = 1 LIMIT 1';

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem updating config table for 1.1.0 changes');
   }
}

function updateVersionLatest()
{
   global $db, $prefix, $gcalCurVer;

   $sql = 'UPDATE ' . $prefix . '_gcal_config SET' .
      " version = '$gcalCurVer'" .
      ' WHERE id = 1 LIMIT 1';

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die("Problem updating config table for $gcalCurVer");
   }
}

function update1_0_0()
{
   global $db, $prefix;

   $sql =
      "ALTER TABLE `{$prefix}_gcal_config` ADD `version` VARCHAR( 16 ) NOT NULL, " .
      "ADD `time_in_24` TINYINT( 1 ) NOT NULL DEFAULT '0', " .
      "ADD `short_date_format` VARCHAR( 16 ) NOT NULL, " .
      "ADD `reg_date_format` VARCHAR( 16 ) NOT NULL, " .
      "ADD `long_date_format` VARCHAR( 16 ) NOT NULL, " .
      "DROP `date_format`, " .
      "ADD `first_day_of_week` TINYINT( 1 ) NOT NULL DEFAULT '0'";

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem altering config table!');
   }

   updateConfig1_1_0();
}

function update1_2_0()
{
   global $db, $prefix, $adminmail, $gcalCurVer;

   $sql =
      "ALTER TABLE `{$prefix}_gcal_config` " .
      "ADD `auto_link` TINYINT( 1 ) NOT NULL DEFAULT '0', " .
      "ADD `location_required` TINYINT( 1 ) NOT NULL DEFAULT '0', " .
      "ADD `details_required` TINYINT( 1 ) NOT NULL DEFAULT '0', " .
      "ADD `email_notify` TINYINT( 1 ) NOT NULL DEFAULT '0', " .
      "ADD `email_to` VARCHAR( 255 ) NOT NULL , " .
      "ADD `email_subject` VARCHAR( 255 ) NOT NULL , " .
      "ADD `email_msg` VARCHAR( 255 ) NOT NULL , " .
      "ADD `email_from` VARCHAR( 255 ) NOT NULL , " .
      "ADD `show_cat_legend` TINYINT( 1 ) NOT NULL DEFAULT '1'";

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem altering config table (1.2.0)!');
   }

   $sql = 'UPDATE ' . $prefix . '_gcal_config SET' .
      " version = '$gcalCurVer'," .
      " email_to = '$adminmail'," .
      " email_subject = 'New GCalendar Event'," .
      " email_msg = 'A new GCalendar event was submitted.'," .
      " email_from = '$adminmail'" .
      ' WHERE id = 1 LIMIT 1';

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem updating config table for 1.2.0 changes');
   }
}

function update1_4_0()
{
   global $db, $prefix, $gcalCurVer;

   $sql =
      "ALTER TABLE `{$prefix}_gcal_config` " .
      "ADD `wysiwyg` TINYINT( 1 ) NOT NULL DEFAULT '0', " .
      "ADD `user_update` TINYINT( 1 ) NOT NULL DEFAULT '0'";

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem altering config table (1.4.0)!');
   }

   $sql = 'UPDATE ' . $prefix . '_gcal_config SET' .
      " version = '$gcalCurVer'" .
      ' WHERE id = 1 LIMIT 1';

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem updating config table for 1.4.0 changes');
   }
}

function createRsvpTable()
{
   global $db, $prefix;

   $sql = <<<END_RSVP_SQL
CREATE TABLE `{$prefix}_gcal_rsvp` (
  `id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `event_id` (`event_id`,`user_id`)
);
END_RSVP_SQL;

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem creating RSVP table!');
   }

}

function createExceptionTable()
{
   global $db, $prefix;

   $sql = <<<END_SQL
CREATE TABLE `{$prefix}_gcal_exception` (
  `id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `event_id` (`event_id`),
  KEY `date` (`date`)
);
END_SQL;

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem creating Exception table!');
   }
}

function update1_5_0()
{
   global $db, $prefix, $gcalCurVer;

   $sql =
      "ALTER TABLE `{$prefix}_gcal_config` " .
      "ADD `weekends` SET( '0', '1', '2', '3', '4', '5', '6' ) NOT NULL DEFAULT '0,6', " .
      "ADD `rsvp` ENUM( 'off', 'on', 'email' ) NOT NULL DEFAULT 'off', " .
      "ADD `rsvp_email_subject` VARCHAR( 255 ) NOT NULL DEFAULT 'Event RSVP Notification'";

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem altering config table (1.5.0)!');
   }

   $sql = "ALTER TABLE `{$prefix}_gcal_event` ADD `rsvp` ENUM( 'off', 'on', 'email' ) NOT NULL DEFAULT 'off'";

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem altering event table (1.5.0)!');
   }

   createRsvpTable();
}

function update1_6_0()
{
   createExceptionTable();
   updateVersionLatest();
}

function createCatGroupTable()
{
   global $db, $prefix;

   $sql =
      "CREATE TABLE `{$prefix}_gcal_cat_group` (" .
      '`id` int(11) NOT NULL auto_increment,' .
      '`cat_id` int(11) NOT NULL,' .
      '`group_id` int(11) NOT NULL,' .
      'PRIMARY KEY  (`id`),' .
      'KEY `cat_id` (`cat_id`),' .
      'KEY `group_id` (`group_id`)' .
      ') ;';

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem creating cat_group table (1.7.0)!');
   }

   // populate it

   $sql = "SELECT `id` FROM {$prefix}_gcal_category ORDER BY `id`";
   $result = $db->sql_query($sql);
   $cats = array();
   while ($row = $db->sql_fetchrow($result))
   {
      $cats[] = intval($row['id']);
   }

   foreach ($cats as $cat)
   {
      $sql = 'INSERT INTO ' . $prefix . "_gcal_cat_group VALUES (NULL, $cat, -1)";
      $db->sql_query($sql);
   }
}

function update1_7_0()
{
   global $db, $prefix;

   $sql = "ALTER TABLE `{$prefix}_gcal_config` " .
      "CHANGE `user_submit` `user_submit` ENUM( 'off', 'members', 'anyone', 'groups' ) NOT NULL DEFAULT 'off', " .
      "ADD `groups_submit` TEXT NOT NULL, " .
      "ADD `groups_no_approval` TEXT NOT NULL";

   $result = $db->sql_query($sql);
   if (!$result)
   {
      die('Problem altering config table (1.7.0)!');
   }

   createCatGroupTable();
   updateVersionLatest();
}

function installStatus()
{
   echo <<<END_INSTALL
<center><b>Looks like everything went OK!</b>
<br/><br/>
<blink>Don't forget to delete the file '{$_SERVER['SCRIPT_NAME']}' now!</blink></center>
<br/><br/>
END_INSTALL;
}

function installForm()
{
   global $db, $prefix, $gcalCurVer;

   $sql = 'SELECT * FROM ' . $prefix . '_gcal_config LIMIT 1';
   $result = $db->sql_query($sql);
   $current = '?';
   $currentInfo = 'GCalendar is not detected on your system';
   if ($db->sql_numrows($result) >= 1)
   {
      $row = $db->sql_fetchrow($result);
      if (isset($row['version']))
      {
         $current = $row['version'];
         $currentInfo = 'Your version of GCalendar is ' . $current;
      }
      else
      {
         $current = '1.0.0';
         $currentInfo = 'Your version of GCalendar is 1.0.0';
      }
   }
   if ($current == $gcalCurVer)
   {
      $currentInfo .= '<br /><br /><b>Your version is up to date!</b><br />';
      echo '<center>' . $currentInfo;
      echo '<br /><br />';
      echo '<blink>Don\'t forget to delete the file ' . $_SERVER['SCRIPT_NAME'] . ' now!</blink></center>';
      echo '<br /><br />';
      die();
   }

   $chkNew = $current == '?' ? 'checked="checked"' : '';
   $chk100 = $current == '1.0.0' ? 'checked="checked"' : '';
   $chk11x = ($current == '1.1.0' ||
              $current == '1.1.1' ||
              $current == '1.1.2' ||
              $current == '1.1.3') ? 'checked="checked"' : '';
   $chk120 = $current == '1.2.0' ? 'checked="checked"' : '';
   $chk13x = ($current == '1.3.0' ||
              $current == '1.3.1' ||
              $current == '1.3.2') ? 'checked="checked"' : '';
   $chk14x = ($current == '1.4.0' ||
              $current == '1.4.1') ? 'checked="checked"' : '';
   $chk150 = $current == '1.5.0' ? 'checked="checked"' : '';
   $chk16x = ($current == '1.6.0' ||
              $current == '1.6.1') ? 'checked="checked"' : '';
   $chk170 = ($current == '1.7.0') ? 'checked="checked"' : '';

   echo <<<END_FORM
<center>
$currentInfo<br /><br />
<form action="gcal_install.php" method="post">
<table border="0" cellpadding="2" cellspacing="1">
<tr><td><input type="radio" name="op" value="new_install" $chkNew /></td><td>New Install of GCalendar $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_0_0" $chk100 /></td><td>Upgrade GCalendar from 1.0.0 to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_1_x" $chk11x /></td><td>Upgrade GCalendar from 1.1.x to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_2_0" $chk120 /></td><td>Upgrade GCalendar from 1.2.0 to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_3_x" $chk13x /></td><td>Upgrade GCalendar from 1.3.x to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_4_x" $chk14x /></td><td>Upgrade GCalendar from 1.4.x to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_5_0" $chk150 /></td><td>Upgrade GCalendar from 1.5.0 to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_6_0" $chk16x /></td><td>Upgrade GCalendar from 1.6.x to $gcalCurVer</td></tr>
<tr><td><input type="radio" name="op" value="upgrade1_7_0" $chk170 /></td><td>Upgrade GCalendar from 1.7.0 to $gcalCurVer</td></tr>
</table><br /><br />
<input type="submit" name="submit" value="GO" />
</form></center><br /><br />
END_FORM;
}

$op = 'default';
if (isset($_POST['op']))
{
   $op = $_POST['op'];
}

switch ($op)
{
   case 'new_install':
      gcalNewInstall();
      installStatus();
      break;

   case 'upgrade1_0_0':
      update1_0_0();
      update1_2_0();
      update1_4_0();
      update1_5_0();
      update1_6_0();
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_1_x':
      update1_2_0();
      update1_4_0();
      update1_5_0();
      update1_6_0();
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_2_0':
      update1_4_0();
      update1_5_0();
      update1_6_0();
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_3_x':
      update1_4_0();
      update1_5_0();
      update1_6_0();
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_4_x':
      update1_5_0();
      update1_6_0();
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_5_0':
      update1_6_0();
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_6_0':
      update1_7_0();
      installStatus();
      break;

   case 'upgrade1_7_0':
      updateVersionLatest();
      installStatus();
      break;

   default:
      installForm();
      break;
}

CloseTable();
include 'footer.php';
?>
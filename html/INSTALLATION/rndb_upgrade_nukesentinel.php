<?php
/**  This script updates Nuke Sentinel tables from 2.4.x to 2.5.05 based on initial value of configuration.
November 3, added logic for NS 2.5.03 from the up2503-2503.php file provided in the NS distribution email from Bob Marion, modified it to include echoes for "successful conditions"
January 23, looking into Sentinel 2.5.05
April 2007:  updated for version 2.5.07 in conjunction with release of RN 2.10.01
May 2007:  updated for version 2.5.08 in conjunction with release of RN 2.10.01
May 2007:  took out "intermediate" updates of nsnst_config table to intermediate
versions.  No point in this, we will do 2.5.08 at the end only.
August 2008 ... added logic to go to 2.6.01
February 2009 ... added logic to go to 2.6.02
December 2007 ... updated the above to have the end result be 2.5.14 ... there are no added table
changes since 2.5.08 so the only thing we are really concerned about is updating the version number
Late December 2007 added ns2.5.15
February 5, 2008 added ns2.5.16
September 2009 ... prepared for RN2.4 and NS 2.6.03  took ip2country updates out.  They will be handled by installSQL.php
February 2010: RN v2.40.01 - Dropped all COUNTRIES table logic as that is now handled in the INSTALLATIONIP2C process.
-------------: Reformatted most all conditional logic to our standards.
-------------: Tweaked some verbiage.
*/

session_start();

/**
*  Using this to return to update script when updating RN
*/
if (!isset($_SESSION['upgradeRN'])) $_SESSION['upgradeRN'] = FALSE;
if (!empty($_POST['upgradeRN'])) $_SESSION['upgradeRN'] = TRUE;

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
RavenNuke&trade; NukeSentinel&trade; Data Base Upgrade Script
</title>
<style type="text/css">
	.button {
		cursor: pointer;
		border: solid 1px #6688BB;
		background-color: #E9ECEF;
		color: #6688BB;
		font-weight: bold;
		font-size: 8pt;
		padding: 4px;
		width: 350px;
	}
	.button2 {
		cursor: pointer;
		border: solid 1px #0000FF;
		background-color: #E9ECEF;
		color: #0000FF;
		font-weight: bold;
		font-size: 8pt;
		padding: 4px;
		width: 350px;
	}
	span.c1 {color: blue}
	span.c2 {color: red}
	span.c3 {color: red}
	div.c2 {text-align: center}
	td.c1 {color:blue;font-weight:bold;}
	ul.c1 {color: blue}
</style>
</head>
<body>
<br />
<br />
<div class="c2">
	<a href="http://www.ravenphpscripts.com" title="Raven Web Services, LLC : Quality Web Hosting And Web Support"><img src="../images/RavenWebServices_Banner.gif" alt="" border="0" /></a>&trade;<br />
	<br />
</div><br />';

define('INSIDE_INSTALL', true);
if (!defined('INCLUDE_PATH')) define('INCLUDE_PATH', '../');

require_once 'ravenstallerConfigFile.php';
require_once INCLUDE_PATH . 'config.php';

$phpok = (version_compare(PHP_VERSION, '5.2.0', '>=')) ? TRUE : FALSE;
if ($phpok) {
	require_once INCLUDE_PATH . '/db/mysqli.php';
	$db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);
}
if (!$phpok) {
	die('<br />This Sentinel upgrade script requires PHP version 5.2 or greater.  It appears that your version of PHP is ' . PHP_VERSION . '.  Please upgrade your version of PHP before continuing.<br />');
} elseif ($db->connectionError) {
	 die('<br />The connection to database ==> <strong>' . $dbname . '</strong> <== has failed.  This usually means there is a mismatch between the settings in your config.php file and/or your database setup/configuration settings.<br />');
}

// variables used by Bob in 2.6.01 updated
$mess1 = '<span style="color:#AA0000;"><strong>FAILED</strong></span><br />' . "\n";
$mess2 = '<span style="color:#00AA00;"><strong>OK</strong></span><br />' . "\n";
$mess3 = '<span style="color:#0000AA;"><strong>N/A</strong></span><br />' . "\n";
$mess4 = '<span style="color:#0000AA;"><strong>ERROR</strong></span><br />' . "\n";

$config_value = (isset($_POST['config_value'])) ? $_POST['config_value'] : '';

if (!empty($_POST['update'])) {
	doupdate($config_value);
} else {
	init($config_value);
}
echo '</body></html>';

/**
* Only functions beyond this point.
*/

function init($config_value) {
	global $prefix, $db, $user_prefix;
	$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_config` WHERE `config_name`='version_number'");
	$row = $db->sql_fetchrow($result);
	$config_value = $row['config_value'];
	echo 'Your Sentinel configuration value was detected as ' . $config_value . '<br />(This is the value that is in the "config_value" field of your nsnst_config table.)<br /><br />';
	if ($config_value == NUKESENTINEL_VERSION) {
		echo '<span class="c1">Congratulations.  It appears that your NukeSentinel&trade; configuration value has been updated to ' , NUKESENTINEL_VERSION , '.</span>';
		if ($_SESSION['upgradeRN']) {
			echo '<form name="rndb" action="rndb_upgrade.php" method="post">'
				, '<input class="button2" type="submit" name="submit" value="Continue with Update" />'
				, '</form>';
		}
		echo '<br /><br />';
	} elseif ($config_value == '2.4.2pl5' ||
	$config_value == '2.4.2pl6' ||
	$config_value == '2.4.2pl7' ||
	$config_value == '2.4.2pl8' ||
	$config_value == '2.4.2pl9' ||
	$config_value == '2.5.00' ||
	$config_value == '2.5.01' ||
	$config_value == '2.5.02' ||
	$config_value == '2.5.03' ||
	$config_value == '2.5.04' ||
	$config_value == '2.5.05' ||
	$config_value == '2.5.06' ||
	$config_value == '2.5.07' ||
	$config_value == '2.5.08' ||
	$config_value == '2.5.09' ||
	$config_value == '2.5.10' ||
	$config_value == '2.5.11' ||
	$config_value == '2.5.12' ||
	$config_value == '2.5.13' ||
	$config_value == '2.5.14' ||
	$config_value == '2.5.15' ||
	$config_value == '2.5.16' ||
	$config_value == '2.5.17' ||
	$config_value == '2.5.18' ||
	$config_value == '2.6.00' ||
	$config_value == '2.6.01' ||
	$config_value == '2.6.02') {
		echo '<span class="c1">This configuration value is legitimate and the update can proceed.<br /><br />As stated in the installation guide, we highly recommend that you capture and/or print the output of this program for future reference purposes.  Note that there may be some circumstances where you will get a &quot;failure&quot; or an &quot;error&quot; message. This is not necessarily &quot;a bad thing&quot;.  For instance if your previous version did not have an index on a certain field and the update tries to drop it, you will get a failure message but have no need to be concerned.  This is one reason we recommend that you retain the output for future reference.</span><br /><br />';
		echo '<span class="c1">The update proceeds <em>sequentially</em> from whatever version number you are starting with up to NukeSentinel&trade; '.NUKESENTINEL_VERSION.'. Below version 2.5.08 there are a number of table changes that are required for most version updates. Therefore you will see more update messages if you are starting from an earlier version.</span><br /><br />';
		echo '<form name="rn_nsnst" action ="rndb_upgrade_nukesentinel.php" method = "post">';
		echo '<input name="config_value" type="hidden" value="'.$config_value.'" />';
		echo 'Please use the update button to complete the updating process. <br />';
		echo '<input type="hidden" name = "update" value = "1" /><br />';
		echo '<input type="submit" name = "submit" value = "Update" /></form><br /><br />';
	} else {
		echo '<span class="c1">This is not a legitimate configuration value for this update... please correct it or post the issue in our forums... execution is being terminated to avoid further issues.<br /><br />The valid values for the configuration setting of Nukesentinel&trade; for this update are:</span><ul class="c1"><li>2.4.2pl5</li><li>2.4.2pl6</li><li>2.4.2pl7</li><li>2.4.2pl8</li><li>2.4.2pl9</li><li>2.5.00</li><li>2.5.01</li><li>2.5.02</li><li>2.5.03</li><li>2.5.04</li><li>2.5.05</li><li>2.5.06</li><li>2.5.07</li><li>2.5.08</li><li>2.5.09</li><li>2.5.10</li><li>2.5.11</li><li>2.5.12</li><li>2.5.13</li><li>2.5.14</li><li>2.5.15</li><li>2.5.16</li><li>2.5.17</li><li>2.5.18</li><li>2.6.00</li><li>2.6.01</li><li>2.6.02</li></ul><span class="c1">These are the only versions that we are able to upgrade from.  If you have a much older version, it might be best to get the latest full install from <a href="http://www.ravenphpscripts.com/modules.php?name=Downloads&d_op=viewdownload&cid=14#cat">Ravenphpscripts</a> and perform a re-installation of the tables and files.<br /><br />If you have already upgraded to '.NUKESENTINEL_VERSION.' then you do not need to run this.<br /><br />If you are ABSOLUTELY SURE of your version number, you may correct it using phpMyAdmin or another tool and rerun this script.  Just BE SURE of yourself before you take this approach.</span>';
		echo '<form name="rn_nsnst" action ="rndb_upgrade_nukesentinel.php" method = "post">';
		echo '<input name="config_value" type="hidden" value="'.$config_value.'" />';
		echo '<input type="hidden" name = "update" value = "0" /><br />';
		echo '<a href="rndb_upgrade_nukesentinel.php">Re Run this program after Correction of Configuration Values</a></form><br /><br />';
	}
	echo '<a href="http://rnwiki.ravennuke.com/wiki/RavenNuke2:Installation">Return to the How to Install Documentation</a>';
}

function doupdate($config_value) {
	global $prefix, $db, $user_prefix, $mess1, $mess2, $mess3, $mess4;

	echo '<span class="c1">Do not forget to capture or print these messages before you dismiss the screen </span><br /><br />';
	if ($config_value < '2.5.00') {
		echo 'updating based on Sentinel config value < 2.5.00 <br />';

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_config` WHERE `config_name` = 'flood_del'");
		if ($result) {
			echo 'deleted record with config_name = flood_del from nsnst_config <br />';
		} else {
			echo 'could not delete record with config_name = flood_del from nsnst_config <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_config` WHERE `config_name` = 'flood_delay_get'");
		if ($result) {
			echo 'deleted record with config_name = flood_del_get from nsnst_config <br />';
		} else {
			echo 'could not delete record with config_name = flood_del_get from nsnst_config <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_config` WHERE `config_name` = 'flood_delay_post'");
		if ($result) {
			echo 'deleted record with config_name = flood_del_post from nsnst_config <br />';
		} else {
			echo 'could not delete record with config_name = flood_del_post from nsnst_config <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_config` WHERE `config_name` = 'flood_max'");
		if ($result) {
			echo 'deleted record with config_name = flood_del_max from nsnst_config <br />';
		} else {
			echo 'could not delete record with config_name = flood_del_max from nsnst_config <br />';
		}

		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('ftaccess_path', '')");
		if(!$result) {
			echo "- ftaccess_path insert into ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo 'ftaccess_path inserted into nsnst_config <br />';
		}

		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('flood_delay', '2')");
		if(!$result) {
			echo "- Flood_delay insert into ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo 'flood_delay inserted into nsnst_config <br />';
		}

		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('disable_switch', '0')");
		if(!$result) {
			echo "- Disable switch insert into ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo 'disable switch inserted into nsnst_config <br />';
		}

		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('track_clear', '0')");
		if(!$result) {
			echo "- track_clear insert into ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo 'track_clear inserted into nsnst_config <br />';
		}

		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('blocked_clear', '0')");
		if(!$result) {
			echo "-blocked_clear insert into ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo 'blocked_clear inserted into nsnst_config <br />';
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX (`date`)");
		if(!$result) {
			echo "- Add index date to ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo 'date index added to nsnst_tracked_ips <br />';
		}

		// UPDATE TABLE nsnst_tracked_ips
		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `page` LIKE '%&new_pass%'");
		if (!result) {
			echo 'tracked ips table like new pass not deleted <br />';
		} else {
			echo 'tracked ips table like new pass deleted <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `page` LIKE '%&pass=%'");
		if (!result) {
			echo 'tracked ips table like pass not deleted <br />';
		} else {
			echo 'tracked ips table like pass deleted <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `page` LIKE '%&password=%'");
		if (!result) {
			echo 'tracked ips table like password pass not deleted <br />';
		} else {
			echo 'tracked ips table like password deleted <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `page` LIKE '%&pwd=%'");
		if (!result) {
			echo 'tracked ips table like pwd not deleted <br />';
		} else {
			echo 'tracked ips table like pwd deleted <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `page` LIKE '%&user_password%'");
		if (!result) {
			echo 'tracked ips table like user_password not deleted <br />';
		} else {
			echo 'tracked ips table like user_password deleted <br />';
		}

		$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `page` LIKE '%&vpass=%'");
		if (!result) {
			echo 'tracked ips table like vpass not deleted <br />';
		} else {
			echo 'tracked ips table like vpass deleted <br />';
		}

		$result = $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
		if (!result) {
			echo 'problem optimizing tracked ips table <br />';
		} else {
			echo 'tracked ips table optimized <br />';
		}

		// DROP TABLE nsnst_flood
		if($db->sql_numrows($db->sql_query("SHOW TABLES LIKE '".$prefix."_nsnst_flood'")) > 0) {
			$result = $db->sql_query("DROP TABLE `".$prefix."_nsnst_flood`");
			if(!$result) {
				echo "- Drop ".$prefix."_nsnst_flood failed<br />\n";
			} else {
				echo "- ".$prefix."_nsnst_flood dropped <br />\n";
			}
		}

		// UPDATE TABLE nsnst_blocked_ips
		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_blocked_ips` ADD `ip_long` INT(10) unsigned NOT NULL default '0' AFTER `ip_addr`");
		if(!$result) {
			echo "- ALTER TABLE ".$prefix."_nsnst_blocked_ips add ip long failed<br />\n";
		} else {
			echo "- ALTER TABLE ".$prefix."_nsnst_blocked_ips add ip long succeeded<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_blocked_ips` ADD INDEX (`ip_long`)");
		if(!$result) {
			echo "- ADD Index ip_long".$prefix."_nsnst_blocked_ips<br />\n";
		} else {
			echo "- ADD INDEX ".$prefix."_nsnst_blocked_ips ip long succeeded<br />\n";
		}

		// UPDATE TABLE nsnst_tracked_ips
		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` CHANGE `hostname` `ip_long` INT(10) unsigned NOT NULL default '0'");
		if(!$result) {
			echo "- ALTER TABLE ".$prefix."_nsnst_tracked_ips hostname NOT changed <br />\n";
		} else {
			echo "- Hostname changed ".$prefix."_nsnst_tracked_ips<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX (`ip_long`)");
		if(!$result) {
			echo "- ADD INDEX ".$prefix."_nsnst_tracked_ips ip_long FAILED <br />\n";
		} else {
			echo "- ADD INDEX ".$prefix."_nsnst_tracked_ips succeeded <br />\n";
		}

		// UPDATE TABLE nsnst_blocked_ips
		$importad = $db->sql_query("SELECT `ip_addr` FROM `".$prefix."_nsnst_blocked_ips`");
		echo 'What follows are any old banned IPs from your site carried forward <br />';
		while(list($b_ip) = $db->sql_fetchrow($importad)) {
			$bantemp = str_replace("*", "0", $b_ip);
			$xIPl = sprintf("%u", ip2long($bantemp));
			$result = $db->sql_query("UPDATE `".$prefix."_nsnst_blocked_ips` SET `ip_long`='$xIPl' WHERE `ip_addr`='$b_ip'");
			if ($result) {
				echo "- $b_ip updated in blocked_ips table <br />";
			} else {
				echo "= $b_ip not updated in blocked_ips table <br />";
			}
		}

		// UPDATE TABLE nsnst_tracked_ips
		$importad = $db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips`");
		echo 'What follows are any tracked ips carried forward <br />';
		while(list($b_ip) = $db->sql_fetchrow($importad)) {
			$bantemp = str_replace("*", "0", $b_ip);
			$xIPl = sprintf("%u", ip2long($bantemp));
			$result = $db->sql_query("UPDATE `".$prefix."_nsnst_tracked_ips` SET `ip_long`='$xIPl' WHERE `ip_addr`='$b_ip'");
			if ($result) {
				echo "- $b_ip updated in tracked_ips table <br />";
			} else {
				echo "= $b_ip not updated in tracked_ips table <br />";
			}
		}
	} // end that version is less than 2.5.00

	if ($config_value < '2.5.03') {
		echo 'updating based on config value < 2.5.03 <br />';

		// ALTER nsnst_tracked_ips
		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD `refered_from` TEXT NOT NULL AFTER `user_agent`");
		if(!$result) {
			echo "- Alter add referred from  ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added refered from<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `ip_addr`");
		if(!$result) {
			echo "- Alter drop index ip_addr ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index ip_addr<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `ip_long`");
		if(!$result) {
			echo "- Alter drop index ip_long ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index ip_long<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `user_id`");
		if(!$result) {
			echo "- Alter drop index user_id ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index user_id<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `username`");
		if(!$result) {
			echo "- Alter drop index username ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index username<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `user_agent`");
		if(!$result) {
			echo "- Alter drop index user_agent ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index user_agent<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `refered_from`");
		if(!$result) {
			echo "- Alter drop index refered_from ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index refered from<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `date`");
		if(!$result) {
			echo "- Alter drop index date ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index date<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `page`");
		if(!$result) {
			echo "- Alter drop index page ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index page<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` DROP INDEX `c2c`");
		if(!$result) {
			echo "- Alter drop index c2c ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, dropped index c2c<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `ip_addr` (`ip_addr`)");
		if(!$result) {
			echo "- Alter ".$prefix."_nsnst_tracked_ips failed add index ip_addr<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index ip_addr<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `ip_long` (`ip_long`)");
		if(!$result) {
			echo "- Alter ".$prefix."_nsnst_tracked_ips failed ip long<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index ip_long<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `user_id` (`user_id`)");
		if(!$result) {
			echo "- Alter  add index user_id ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index user_id<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `username` (`username`)");
		if(!$result) {
			echo "- Alter add index username ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index username<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `user_agent` (`user_agent`(255))");
		if(!$result) {
			echo "- Alter add index user_agent ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index user_agent<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `refered_from` (`refered_from`(255))");
		if(!$result) {
			echo "- Alter add index refered from ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index refered from<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `date` (`date`)");
		if(!$result) {
			echo "- Alter add index date".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index date<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `page` (`page`(255))");
		if(!$result) {
			echo "- Alter add index page ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added page<br />\n";
		}

		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_tracked_ips` ADD INDEX `c2c` (`c2c`)");
		if(!$result) {
			echo "- Alter add index c2c".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, added index c2c<br />\n";
		}

		$result = $db->sql_query("UPDATE `".$prefix."_nsnst_tracked_ips` SET `refered_from`='Before NukeSentinel(tm)'");
		if(!$result) {
			echo "- Alter set refered from ".$prefix."_nsnst_tracked_ips failed<br />\n";
		} else {
			echo "- Alter ".$prefix."_nsnst_tracked_ips succeeded, set refered from<br />\n";
		}
	} // end that config value is < 2.5.03

	//==========================================================================================
	// up through the 2.6.01 upgrade all the stuff below was executing ... for 2.6.02 we just need to change config_version and versio
	// newest so I am going to put this in an if condition  (fkelly ... February 2009)
	//============================================================
	if ($config_value < '2.6.01') {
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('dump_directory', 'cache/')");
		if (!result)	{
			echo "- Insert of dump directory failed <br />\n";
		} else {
			echo "- Insert of dump directory succeeded <br />\n";
		}

		echo 'Insert list harverster into '.$prefix.'_nsnst_config: ';
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('list_harvester', '')");
		if(!$result) {
			echo 'list harvester insert failed <br />';
		} else {
			echo 'list harverster insert succeeded <br />';
		}

		echo 'Insert list referer into '.$prefix.'_nsnst_config: ';
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('list_referer', '')");
		if(!$result) {
			echo 'list referer insert failed <br />';
		} else {
			echo 'list referer insert succeeded <br />';
		}

		echo 'Insert list string into '.$prefix.'_nsnst_config: ';
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('list_string', '')");
		if(!$result) {
			echo 'list string insert failed <br />';
		} else {
			echo 'list string insert succeeded <br />';
		}

		/**
		 * this section is from the 2.6.00 upgrade
		 */
		echo 'Create '.$prefix.'_nsnst_harvesters: ';
		$result = $db->sql_query("CREATE TABLE `".$prefix."_nsnst_harvesters` (`hid` int(2) NOT NULL auto_increment, `harvester` varchar(255) NOT NULL default '', PRIMARY KEY (`harvester`), KEY `hid` (`hid`))");
		if(!$result) {
			echo 'harvester table creation failed <br />';
		} else {
			echo 'harvester table creation succeeded <br />';
		}

		if($result) {
			// POPULATE TABLE nsnst_harvesters
			$hvmess = $mess2;
			echo 'Populate '.$prefix.'_nsnst_harvesters: ';
			list($hvlist) = $db->sql_fetchrow($db->sql_query("SELECT `list` FROM `".$prefix."_nsnst_blockers` WHERE `block_name`='harvester'"));
			if($hvlist) {
				$harvesterlist = explode("\r\n", $hvlist);
				sort($harvesterlist);
				$i = 0;
				while($i < count($harvesterlist)) {
					if($harvesterlist[$i] == $harvesterlist[$i+1]) {
						$harvesterlist[$i+1] = "";
					}
					if($harvesterlist[$i] > "") {
						if(!get_magic_quotes_runtime()) {
							$harvesterlist[$i] = addslashes($harvesterlist[$i]);
						}
						$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_harvesters` (`harvester`) VALUES ('".$harvesterlist[$i]."')");
						if(!$result) {
							$hvmess = $mess4;
						}
					}
					$i++;
				}
				$list_harvester = implode("\r\n", $harvesterlist);
				$db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='".$list_harvester."' WHERE `config_name`='list_harvester'");
				$db->sql_query("UPDATE `".$prefix."_nsnst_blockers` SET `list`='' WHERE `block_name`='harvester'");
			} else {
				$hvmess = $mess3;
			}
			echo $hvmess;
		}

		echo 'Create '.$prefix.'_nsnst_referers: ';
		$result = $db->sql_query("CREATE TABLE `".$prefix."_nsnst_referers` (`rid` int(2) NOT NULL auto_increment, `referer` varchar(255) NOT NULL default '', PRIMARY KEY (`referer`), KEY `rid` (`rid`))");
		if(!$result) {
			echo $mess1 .'<br />';
		} else {
			echo $mess2 .'<br />';
		}
		if($result) {
			// POPULATE TABLE nsnst_referers
			$rfmess = $mess2;
			echo 'Populate '.$prefix.'_nsnst_referers: ';
			list($rflist) = $db->sql_fetchrow($db->sql_query("SELECT `list` FROM `".$prefix."_nsnst_blockers` WHERE `block_name`='referer'"));
			if($rflist) {
				$refererlist = explode("\r\n", $rflist);
				sort($refererlist);
				$i = 0;
				while($i < count($refererlist)) {
					if($refererlist[$i] == $refererlist[$i+1]) {
						$refererlist[$i+1] = "";
					}
					if($refererlist[$i] > "") {
						if(!get_magic_quotes_runtime()) {
							$refererlist[$i] = addslashes($refererlist[$i]);
						}
						$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_referers` (`referer`) VALUES ('".$refererlist[$i]."')");
						if(!$result) {
							$rfmess = $mess4;
						}
					}
					$i++;
				}
				$list_referer = implode("\r\n", $refererlist);
				$db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='".$list_referer."' WHERE `config_name`='list_referer'");
				$db->sql_query("UPDATE `".$prefix."_nsnst_blockers` SET `list`='' WHERE `block_name`='referer'");
			} else {
				$rfmess = $mess3;
			}
			echo $rfmess;
		}

		// CREATE TABLE nsnst_strings
		echo 'Create '.$prefix.'_nsnst_strings: ';
		$result = $db->sql_query("CREATE TABLE `".$prefix."_nsnst_strings` (`sid` int(2) NOT NULL auto_increment, `string` varchar(255) NOT NULL default '', PRIMARY KEY (`string`), KEY `sid` (`sid`))");
		if(!$result) {
			echo $mess1 . '<br />';
		} else {
			echo $mess2. '<br />';
		}
		if($result) {
			// POPULATE TABLE nsnst_strings
			$sgmess = $mess2;
			echo 'Populate '.$prefix.'_nsnst_strings: <br />';
			list($sglist) = $db->sql_fetchrow($db->sql_query("SELECT `list` FROM `".$prefix."_nsnst_blockers` WHERE `block_name`='string'"));
			if($sglist) {
				$stringlist = explode("\r\n", $sglist);
				sort($stringlist);
				$i = 0;
				while($i < count($stringlist)) {
					if($stringlist[$i] == $stringlist[$i+1]) {
						$stringlist[$i+1] = "";
					}
					if($stringlist[$i] > "") {
						if(!get_magic_quotes_runtime()) {
							$stringlist[$i] = addslashes($stringlist[$i]);
						}
						$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_strings` (`string`) VALUES ('".$stringlist[$i]."')");
						if(!$result) {
							$sgmess = $mess4;
						}
					}
					$i++;
				}
				$list_string = implode("\r\n", $stringlist);
				$db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='".$list_string."' WHERE `config_name`='list_string'");
				$db->sql_query("UPDATE `".$prefix."_nsnst_blockers` SET `list`='' WHERE `block_name`='string'");
			} else {
				$sgmess = $mess3;
			}
			echo $sgmess .'<br />';
		}

		// this section is from the 2.6.01 upgrade
		// INSERT INTO TABLE nsnst_config
		echo 'Insert into '.$prefix.'_nsnst_config: ';
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('show_right', '0')");
		if(!$result) {
			echo 'show right ' .$mess1 .'<br />';
		} else {
			echo 'show right '. $mess2 .'<br />';
		}

		echo 'Insert into '.$prefix.'_nsnst_config: ';
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('test_switch', '0')");
		if(!$result) {
			echo 'test switch ' . $mess1 .'<br />';
		} else {
			echo 'test switch ' . $mess2 .'<br />';
		}

		echo 'Insert into '.$prefix.'_nsnst_config: ';
		$result = $db->sql_query("INSERT INTO `".$prefix."_nsnst_config` VALUES ('ip2c_version', '0')");
		if(!$result) {
			echo 'ip2c_version ' . $mess1 . '<br />';
		} else {
			echo 'ip2c version '. $mess2 .'<br />';
		}

		// this section does the version update to the latest version ...
		$result = $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='$tms' WHERE `config_name`='version_check'");
		if(!$result) {
			echo "- Version Check Update ".$prefix."_nsnst_config failed<br />\n";
		}

		// update of version number moved from here feb. 2009 .. now below in all inclusive area
		// Added by montego to get the tables to match between an upgrade and fresh install
		$result = $db->sql_query("ALTER TABLE `".$prefix."_nsnst_cidrs` MODIFY cidr int(2) NOT NULL DEFAULT '0'");
		if(!$result) {
			echo "- Removal of auto-increment on cidr field within ".$prefix."_nsnst_cidrs failed<br />\n";
		} else {
			echo "- Removal of auto-increment on cidr field within ".$prefix."_nsnst_cidrs succeeded<br />\n";
		}

		$db->sql_query("ALTER TABLE `".$prefix."_nsnst_config` ORDER BY `config_name`");
		if (!result)	{
			echo "- ORDER ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo "- ORDER ".$prefix."_nsnst_config succeeded<br />\n";
		}

		$result = $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_config`");
		if (!result)	{
			echo "- OPTIMIZE ".$prefix."_nsnst_config failed<br />\n";
		} else {
			echo "- OPTIMIZE ".$prefix."_nsnst_config succeeded<br />\n";
		}

		$result = $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
		if (!result) {
			echo "- OPTIMIZE ".$prefix."_tracked_ips failed<br />\n";
		} else {
			echo "- OPTIMIZE ".$prefix."_tracked_ips succeeded<br />\n";
		}

		echo '<br />Remove the following files from your server:<br />'."\n";
		echo 'admin/modules/nukesentinel/ABDBDownload.php<br />'."\n";
		echo 'admin/modules/nukesentinel/ABDBDownloadCompress.php<br />'."\n";
		echo 'admin/modules/nukesentinel/ABDBDownloadDelete.php<br />'."\n";
		echo 'admin/modules/nukesentinel/ABDBDownloadGet.php<br />'."\n";
		echo 'admin/modules/nukesentinel/ABDBMaintence.php<br />'."\n";
		echo 'images/nukesentinel/countries/xe.png<br />'."\n";
		echo 'images/nukesentinel/countries/xs.png<br />'."\n";
		echo 'images/nukesentinel/countries/xw.png<br />'."\n";
		echo '<hr />'."\n";
	} // this is the end of config_value being < 2.6.01

	// all inclusive section ... this is done for all updates
	$result = $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='".NUKESENTINEL_VERSION."' WHERE `config_name`='version_newest'");
	if(!$result) {
		echo "- Version newest Update ".$prefix."_nsnst_config failed<br />\n";
	}

	$result = $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='".NUKESENTINEL_VERSION."' WHERE `config_name`='version_number'");
	if(!$result) {
		echo "- Version Number Update ".$prefix."_nsnst_config failed<br />\n";
	} else {
		echo 'update of nsnst_config table succeeded <br />'."\n";
	}

	echo '<hr /><br />'
		, '<div class="c1">';
	if ($_SESSION['upgradeRN']) {
		echo '<form name="rndb" action="rndb_upgrade.php" method="post">'
			, '<input class="button2" type="submit" name="submit" value="Continue with Update" />'
			, '</form>'
			, '<br /><br />';
	}
	echo '<a href="http://rnwiki.ravennuke.com/wiki/RavenNuke2:Installation">Return to Documentation</a>'
		, '</div><br /><br />';

	session_destroy();
}

?>
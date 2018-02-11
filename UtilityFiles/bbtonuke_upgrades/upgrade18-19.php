<?php

######################################################
# After you used this file, you can safely delete it.
######################################################
#            -= WARNING: PLEASE READ =-
#
# NOTE: This file uses config.php to retrieve needed
# variables values. So, to do the upgrade PLEASE copy
# this file in your server root directory and execute
# it from your browser.
######################################################

include("mainfile.php");

global $prefix, $db, $user_prefix;
// Forums Table Update
$db->sql_query("INSERT INTO ".$prefix."_bbconfig (config_name, config_value) VALUES ('max_login_attempts', '5')"); 
$db->sql_query("INSERT INTO ".$prefix."_bbconfig (config_name, config_value) VALUES ('login_reset_time', '30')"); 
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.19' where config_name='version'");
// Users Table Update
$db->sql_query("ALTER TABLE ".$prefix."_users ADD COLUMN user_login_tries smallint(5) UNSIGNED DEFAULT '0' NOT NULL");
$db->sql_query("ALTER TABLE ".$prefix."_users ADD COLUMN user_last_login_try int(11) DEFAULT '0' NOT NULL");
echo "BBtoNuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>

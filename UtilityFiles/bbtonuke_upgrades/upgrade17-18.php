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
$db->sql_query("CREATE TABLE ".$prefix."_bbsessions_keys (key_id varchar(32) DEFAULT '0' NOT NULL, user_id mediumint(8) DEFAULT '0' NOT NULL, last_ip varchar(8) DEFAULT '0' NOT NULL, last_login int(11) DEFAULT '0' NOT NULL, PRIMARY KEY (key_id, user_id), KEY last_login (last_login))");
$db->sql_query("UPDATE ".$user_prefix."_users SET user_active = 0 WHERE user_id = 'Anonymous'");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig (config_name, config_value) VALUES ('allow_autologin', '1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig (config_name, config_value) VALUES ('max_autologin_time', '0')");
$db->sql_query("DELETE FROM ".$prefix."_bbsessions");
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.18' where config_name='version'");
echo "BBtoNuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
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
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.21' where config_name='version'");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig (config_name, config_value) VALUES ('search_min_chars', '3')");
$db->sql_query("DELETE FROM ".$prefix."_bbsessions");
$db->sql_query("DELETE FROM ".$prefix."_bbsessions_keys");
echo "BBtoNuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
<?php
/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 *
 * Based on "SpamBot Search Tool" version v0.52 by MysteryFCM
 */

# General
# DataTables - move to another langugae file?? Languages are here: http://www.datatables.net/plug-ins/i18n
define('_DT_COLUMNS','Choose Columns');
define('_DT_COPY','Copy');
define('_DT_EXPORT','Export');
define('_DT_PRINT','Print');
define('_DT_RESTORE','Reset Columns');
if (!defined('_DATATABLES')) define('_DATATABLES','
    "sProcessing":   "Processing...",
    "sLengthMenu":   "Show _MENU_ entries",
    "sZeroRecords":  "No matching records found",
    "sInfo":         "Showing _START_ to _END_ of _TOTAL_ entries",
    "sInfoEmpty":    "Showing 0 to 0 of 0 entries",
    "sInfoFiltered": "(filtered from _MAX_ total entries)",
    "sInfoPostFix":  "",
    "sSearch":       "Search:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "First",
        "sPrevious": "Previous",
        "sNext":     "Next",
        "sLast":     "Last"
    }
');
# Admin Menu
define('_SPAM_CONFIG','nukeSPAM&trade; Configuration');
define('_SPAM_CHECK','Check Username, Email and / or IP');
define('_SPAM_SITEADMIN','Site Administration');
define('_SPAM_DB','Use Spam Database');
define('_SPAM_DB_KEY','Spam Database Key');
define('_SPAM_DB_LINK','Where to obtain Spam Database Key');
define('_SPAM_SAVE','Save');
define('_SPAM_WL','Whitelist Maintenance');

# Log
define('_SPAM_ADDED','Date');
define('_SPAM_TYPE','Request');
define('_SPAM_MATCHED','Matched');
define('_SPAM_COUNT','Count');
define('_SPAM_LOADING','Loading data from server');

# Whitelist
define('_SPAM_WLTYPE','Whitelist Type');
define('_SPAM_WLVALUE','Whitelist Value');

# Configuration
define('_SPAM_OPERATIONS', 'Operations');
define('_SPAM_BASEMATCH', 'Identify as spam if');
define('_SPAM_DNSBL', 'DNS Blacklists');
define('_SPAM_DEBUG', 'Debug Mode');
define('_SPAM_LOGTODB', 'Log spam results to database');
define('_SPAM_LOGTOTEXTFILE', 'Log spam results to text file');
define('_SPAM_USE_REG', 'Use nukeSPAM&trade; to block spammer registration');
define('_SPAM_THEME', 'jQuery UI Theme');
define('_SPAM_DISABLE', 'Disable');
define('_SPAM_ENABLE', 'Enable');
define('_SPAM_MATCH_ANY', 'Any one of username, IP, Email is listed');
define('_SPAM_MATCH_2OR3', 'IP OR Email is listed');
define('_SPAM_MATCH_23', 'IP and Email are listed');
define('_SPAM_MATCH_12', 'Username and IP are listed');
define('_SPAM_MATCH_13', 'Username and Email are listed');
define('_SPAM_MATCH_12OR13', 'Username and IP OR Username and Email are listed');
define('_SPAM_MATCH_12OR13OR23', 'Username and IP OR Username and Email OR IP and Email are listed');
define('_SPAM_MATCH_12OR23', 'Username and IP OR IP and Email are listed');
define('_SPAM_MATCH_13OR23', 'Username and Email OR IP and Email are listed');
define('_SPAM_MATCH_123', 'All 3 are listed');
define('_SPAM_DATABASES', 'Spam Databases');
define('_SPAM_FSL', 'fSpamList');
define('_SPAM_FSL_LINK', 'http://www.fspamlist.com/index.php?c=register');
define('_SPAM_SFS', 'StopForumSpam');
define('_SPAM_SFS_LINK', 'http://www.stopforumspam.com');
define('_SPAM_BS', 'BotScout');
define('_SPAM_BS_LINK', 'http://www.botscout.com/getkey.htm');
define('_SPAM_USE_DBL', 'Use DNS Blacklists');
define('_SPAM_DBL', 'DNS Blacklists');
define('_SPAM_DACH', 'ACH (Drone)');
define('_SPAM_HACH', 'ACH (HTTPBL)');
define('_SPAM_SACH', 'ACH (Spam)');
define('_SPAM_ZACH', 'ACH (Zeus)');
define('_SPAM_AHBL', 'AHBL');
define('_SPAM_BLDE', 'Blocklist.de');
define('_SPAM_DRONE', 'DroneBL');
define('_SPAM_EFN', 'EFNet');
define('_SPAM_PHP', 'Project Honey Pot');
define('_SPAM_PHP_LINK', 'http://www.projecthoneypot.org/httpbl_configure.php');
define('_SPAM_SB', 'Sorbs');
define('_SPAM_SH', 'SpamHaus');
define('_SPAM_SC', 'SpamCop');
define('_SPAM_TVO', 'Tornevall');
define('_SPAM_TOR', 'Tor');
define('_SPAM_1', 'Enable');
define('_SPAM_2', 'Enable');

// nukeSPAM Messages
if (!defined('_SPAM_BS')) define('_SPAM_BS','BotScout ');
if (!defined('_SPAM_DBMATCH')) define('_SPAM_DBMATCH','Database match ');
if (!defined('_SPAM_FSL')) define('_SPAM_FSL','fSpamlist ');
if (!defined('_SPAM_SFS')) define('_SPAM_SFS','StopForumSpam ');
if (!defined('_SPAM_SENT')) define('_SPAM_SENT','SENT: ');
if (!defined('_SPAM_RECEIVED')) define('_SPAM_RECEIVED','<br />RECEIVED: ');
// nukeSPAM Error messages
if (!defined('_SPAM_ERR_FSL_CONNECT')) define('_SPAM_ERR_FSL_CONNECT','ERROR: could not connect to fSpamlist server ');
if (!defined('_SPAM_ERR_FSL_EMPTY')) define('_SPAM_ERR_FSL_EMPTY','FSL_EMPTY: Bad Request OR EMPTY TRUE');
if (!defined('_SPAM_SFS_EMPTY')) define('_SPAM_SFS_EMPTY','SFS_EMPTY: Bad Request OR EMPTY TRUE');
if (!defined('_SPAM_ERROR')) define('_SPAM_ERROR','Error: ');
if (!defined('_SPAM_SFS_LIMITEXCEEDED')) define('_SPAM_SFS_LIMITEXCEEDED','StopForumSpam informed me your daily query limit has been exceeded<br />');
if (!defined('_SPAM_BS_EMPTY')) define('_SPAM_BS_EMPTY','BotScout_EMPTY: Bad Request OR EMPTY TRUE');
// nukeSPAM - Administration
if (!defined('_SPAM_USERNAME')) define('_SPAM_USERNAME','Username');
if (!defined('_SPAM_EMAIL')) define('_SPAM_EMAIL','Email address');
if (!defined('_SPAM_IP')) define('_SPAM_IP','IP Address');
if (!defined('_SPAM_7')) define('_SPAM_7','');

# Errors
define('_SPAM_BLOCKED', 'ERROR: Your registration has been blocked by our spam filter. If you feel this is incorrect, please contact the site administrator for resolution');
if (!defined('_SPAM_NOSCRIPT')) define('_SPAM_NOSCRIPT','Please enable JavaScript to contact us.');
define('_SPAM_NO_ISSUES', 'Nothing was found for this username, email address and / or IP address.');

# Help - Menu
define('_SPAM_CONFIG_HLP', 'Configure nukeSPAM and spam database settings.');
define('_SPAM_CHECK_HLP','Test nukeSPAM&trade; using specified username, email address, and / or IP address.');
define('_SPAM_SITEADMIN_HLP', 'Return to RavenNuke(tm) site administration.');
define('_SPAM_WL_HLP','Maintain protected usernames, email and / or IP address that will NOT be checked by nukeSPAM&trade;.<br /><br />NOTE: Use this with <strong>extreme caution</strong> since doing so allows spammers to spoof their way past nukeSPAM&trade;.');
# Help - Configuration
define('_SPAM_BASEMATCH_HLP', 'Specify the combinations of username, IP address and email address used to identify spammers by checking databases of known spammers. Including the username might lead to false positives.<br /><br /><strong>Recommended setting:  IP or Email is listed</strong>');
define('_SPAM_DEBUG_HLP', 'Use debug to show specific messages when checking spam databases.');
define('_SPAM_LOGTODB_HLP', 'Logs blocked requests for reference in the nukeSPAM&trade; module. This is useful for researching false positive rejections.');
define('_SPAM_LOGTOTEXTFILE_HLP', 'Log to text file help text goes here.');
define('_SPAM_USE_REG_HLP', 'This controls whether nukeSPAM&trade; is used to block spammers. Individual databases are controlled on the <strong>' . _SPAM_DATABASES . '</strong> and <strong>' . _SPAM_DNSBL . '</strong> tabs.');
define('_SPAM_THEME_HLP', 'The name of the jQuery UI theme, which must be loaded in <strong>/includes/jquery/css/</strong>&lt;theme&gt; folder and have the CSS named <strong>jquery-ui.css</strong> in that folder.');
define('_SPAM_DISABLE_HLP', 'Disabling a module simply removes it from the list of available
                           content types. Active feeds defined for content types before
                           disabling a content type will remain active.');
define('_SPAM_FSL_HLP', 'fSpamList requires an API key. Each key can make 5,000 queries a day. Multiple domains can share a key.');
define('_SPAM_SFS_HLP', 'To obtain a StopForumSpam API key, register for forum access, then request an API key.');
define('_SPAM_BS_HLP', 'BotScout requires a key and allows 300 queries per day. Multiple domains can share a key.');
define('_SPAM_USE_DBL_HLP', 'This overrides the individual settings for DNS blacklists below.  DNS blacklists only check the IP address. If you do not include IP address to identify spam, this should not be checked.');
#define('_SPAM_DACH_HLP', 'Drone ACH help text goes here.');
#define('_SPAM_HACH_HLP', 'HTTPBL ACH help text goes here.');
#define('_SPAM_SACH_HLP', 'Spam ACH help text goes here.');
#define('_SPAM_ZACH_HLP', 'Zeus ACH help text goes here.');
#define('_SPAM_AHBL_HLP', 'AHBL help text goes here.');
define('_SPAM_PHP_HLP', 'Project Honey Pot requires a key, but has no posted limit on the number of queries.  Multiple domains can share a key.');
#define('_SPAM_SB_HLP', 'EnableSorbs help text goes here.');
#define('_SPAM_SH_HLP', 'SpamHaus help text goes here.');
#define('_SPAM_SC_HLP', 'SpamCop help text goes here.');
#define('_SPAM_DRONE_HLP', 'DroneBL help text goes here.');
#define('_SPAM_TVO_HLP', 'Tornevall help text goes here.');
#define('_SPAM_EFN_HLP', 'EFNet help text goes here.');
#define('_SPAM_TOR_HLP', 'Tor help text goes here.');

?>
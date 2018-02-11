<?php
/*********************************************************************************
* RavenNuke(tm) Table Installer - Settings currently used in installSQL.php
* See the installSQLREADME file for usage help
**********************************************************************************/
$useLanguageFile = 'lang-english';
$byPassTableLock = true;
$debugShowPathSettings = false;
$debugSetupScriptShowAllErors = true;

/*********************************************************************************
* If the BELOW 2 settings are greater than zero then the individual settings will be ignored
* See the installSQLREADME file for usage help
**********************************************************************************/
define('_rnMINIMUM_PASSWORD_LENGTH',0); //Ignore and use individual settings
define('_rnMAXIMUM_PASSWORD_LENGTH',0); //Ignore and use individual settings

/*********************************************************************************
* If the ABOVE 2 settings are greater than zero then these 6 INDIVIDUAL SETTINGS will be ignored
* See the installSQLREADME file for usage help
**********************************************************************************/
define('_rnADMIN_MINIMUM_PASSWORD_LENGTH',8);
define('_rnADMIN_MAXIMUM_PASSWORD_LENGTH',40); //From admin.php
define('_rnUSER_MINIMUM_PASSWORD_LENGTH',4); //From RNYA
define('_rnUSER_MAXIMUM_PASSWORD_LENGTH',20); //From RNYA
define('_rnNSADMIN_MINIMUM_PASSWORD_LENGTH',8);
define('_rnNSADMIN_MAXIMUM_PASSWORD_LENGTH',40); //From admin.php

/*********************************************************************************
* If the BELOW setting is NOT empty (set to '*') then the individual settings will be ignored
* See the installSQLREADME file for usage help
**********************************************************************************/
define('_rnALLOWED_USERID_CHARACTERS','*'); //Ignore and use individual settings

/*********************************************************************************
* If the ABOVE setting is not empty (set to '*') then these 3 INDIVIDUAL settings will be ignored
* See the installSQLREADME file for usage help
**********************************************************************************/
define('_rnADMIN_ALLOWED_USERID_CHARACTERS','[a-zA-Z0-9@_\.]*'); //From admin.php
define('_rnUSER_ALLOWED_USERID_CHARACTERS','[a-zA-Z0-9_\-\*]*'); //From RNYA
define('_rnNSADMIN_ALLOWED_USERID_CHARACTERS','[a-zA-Z0-9@_.]*'); //From admin.php

/*********************************************************************************
* ABSOLUTELY! Do NOT change these settings unless advised to do so by the RavenNuke(tm) Team!
**********************************************************************************/
if (!defined('RAVENNUKE_VERSION_FRIENDLY')) define('RAVENNUKE_VERSION_FRIENDLY', '2.52.00');
define('RAVENNUKE_VERSION_CONFIG', 'rn'.RAVENNUKE_VERSION_FRIENDLY);
define('NUKESENTINEL_VERSION', '2.6.03');
define('PHPBB_VERSION', '.0.23');
/**
* This value is used to determine if the IP2County table is up to date.
*/
define('_nsIP2C', 1345676597);
$byPassSqlErrors = array(1065 /*Query was empty*/,1146 /*Table doesn't exist*/);
$sqlFolder = 'sql/';
$comment[0]='#';
$comment[1]='--';
$comment[2]='-- ';
$comment[3]='---';
$comment[4]='--- ';
// note ... the valid versions array stops one short of the version we are updating to
// the function that is called in rndb_upgrade is determined by what is on the right side of the => below
// so for example when we are updating to 2.40.00 we will be calling function rn23002
$rndb_valid_versions = array(
	'rn2.02.00' =>  'rn20200',
	'rn76v2.02' =>  'rn20200',
	'rnv2.02.02' => 'rn20202',
	'rn2.10.00' =>  'rn21000',
	'rn2.10.01' =>  'rn21001',
	'rn2.20.00' =>  'rn22000',
	'rn2.20.01' =>  'rn22001',
	'rn2.30.00' =>  'rn23000',
	'rn2.30.01' =>  'rn23001',
	'rn2.30.02' =>  'rn23002',
	'rn2.40.00' =>  'rn24000',
	'rn2.40.01' =>  'rn24001',
	'rn2.50.00' =>  'rn25000',
	'rn2.51.00' =>  'rn25100');
?>
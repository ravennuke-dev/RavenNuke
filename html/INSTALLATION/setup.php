<?php
/**
Written and solely owned by Raven Web Services, LLC
Not for distribution other than by Raven Web Services, LLC
Copyright 2005-2013
**/
if (!defined('INCLUDE_PATH')) define('INCLUDE_PATH', '../');
@require_once INCLUDE_PATH . 'includes/mimetype.php';
$nukeConfigFile = INCLUDE_PATH . 'config.php';;
if (!file_exists($nukeConfigFile)) {rnInstallErr(1); die();}
require_once INCLUDE_PATH . 'config.php';
@require_once 'ravenstallerConfigFile.php';
$pattern = '/([^[]*)([\]])/i';
$rnADMIN_ALLOWED_USERID_CHARACTERS = (defined('_rnADMIN_ALLOWED_USERID_CHARACTERS') && _rnALLOWED_USERID_CHARACTERS=='*') ? _rnADMIN_ALLOWED_USERID_CHARACTERS : _rnALLOWED_USERID_CHARACTERS;
preg_match($pattern, $rnADMIN_ALLOWED_USERID_CHARACTERS, $matches);
$rnADMIN_ALLOWED_USERID_CHARACTERS = str_replace('\\','',$matches[1]);

$rnUSER_ALLOWED_USERID_CHARACTERS = (defined('_rnUSER_ALLOWED_USERID_CHARACTERS') && _rnALLOWED_USERID_CHARACTERS=='*') ? _rnUSER_ALLOWED_USERID_CHARACTERS : _rnALLOWED_USERID_CHARACTERS;
preg_match($pattern, $rnUSER_ALLOWED_USERID_CHARACTERS, $matches);
$rnUSER_ALLOWED_USERID_CHARACTERS = str_replace('\\','',$matches[1]);

$rnNSADMIN_ALLOWED_USERID_CHARACTERS = (defined('_rnNSADMIN_ALLOWED_USERID_CHARACTERS') && _rnALLOWED_USERID_CHARACTERS=='*') ? _rnNSADMIN_ALLOWED_USERID_CHARACTERS : _rnALLOWED_USERID_CHARACTERS;
preg_match($pattern, $rnNSADMIN_ALLOWED_USERID_CHARACTERS, $matches);
$rnNSADMIN_ALLOWED_USERID_CHARACTERS = str_replace('\\','',$matches[1]);


if ($debugSetupScriptShowAllErors) {
	ini_set('display_errors',1);
	error_reporting(E_ALL);
}
?>
<meta name="rating" content="general" />
<meta name="generator" content="PHP Web Host - Quality Web Hosting For All PHP Applications - Copyright (c) 2002-2013 by http://www.ravenphpscripts.com" />
<link rel="StyleSheet" href="css/ravenstaller.css" type="text/css" />
<link rel="stylesheet" href="windowfiles/dhtmlwindow.css" type="text/css" />
<link rel="stylesheet" href="modalfiles/modal.css" type="text/css" />
<script type="text/javascript" src="windowfiles/dhtmlwindow.js"></script>
<script type="text/javascript" src="modalfiles/modal.js"></script>
<script type="text/javascript" src="js/ravenstaller.js"></script>
<title>RavenNuke&trade; v<?php echo RAVENNUKE_VERSION_FRIENDLY;?> Setup/Configuration Tool</title>
<script type="text/javascript">
/* <![CDATA[ */
function validateInput(formName) {
  formName.bbconfig_server_name.value = formName.config_nukeurl.value.replace('http://','');
  var cookie_domain = formName.config_nukeurl.value.replace('http://','');
  cookie_domain = cookie_domain.replace('www.','');
  var dots = cookie_domain.match(/\./g).length;
  if (dots < 2) {
	  cookie_domain = '.' + cookie_domain;
  }
  formName.bbconfig_cookie_domain.value = cookie_domain.replace(/\/.*$/,"");
  formName.bbconfig_cookie_path.value = cookie_domain.replace(formName.bbconfig_cookie_domain.value,"");
  if (formName.bbconfig_cookie_path.value == "") formName.bbconfig_cookie_path.value = "/";
  if (!emptyCheck(formName)) return false;
  var myVar = '';
  for(i=0; i<formName.elements.length; i++) {
		myVar += (formName.elements[i].name + " = " + formName.elements[i].value + "\n");
  }
  /* Email format check */
  if (!emailCheck (formName.config_adminmail.value)) return false;
  if (!emailCheck (formName.nsnst_config_admin_contact.value)) return false;
  if (!emailCheck (formName.users_user_email.value)) return false;
  if (!emailCheck (formName.bbconfig_board_email.value)) return false;
	/* Usernames enforced */
	/* *GOD* Administrator UserName */
	var allowedUserIdContent=<?php echo _rnALLOWED_USERID_CHARACTERS!='*' ? '/^('._rnALLOWED_USERID_CHARACTERS.')$/' : '\'*\'';?>;
	if (allowedUserIdContent!='*') {
		var rnAdminNameContent=allowedUserIdContent;
		var rnUserNameContent=allowedUserIdContent;
		var rnNsAdminNameContent=allowedUserIdContent;
	}
	else {
		var rnAdminNameContent=<?php echo '/^('._rnADMIN_ALLOWED_USERID_CHARACTERS.')$/'; ?>;
		var rnUserNameContent=<?php echo '/^('._rnUSER_ALLOWED_USERID_CHARACTERS.')$/'; ?>;
		var rnNsAdminNameContent=<?php echo '/^('._rnNSADMIN_ALLOWED_USERID_CHARACTERS.')$/'; ?>;
	}
	if (!nameCheck('*GOD* Administrator UserName',formName.authors_aid.value,rnAdminNameContent)) return false;
	if (!nameCheck('Regular Member UserName',formName.users_username.value,rnUserNameContent)) return false;
	if (!nameCheck('*GOD* Administrator NukeSentinel™ UserName',formName.nsnst_admins_login.value,rnNsAdminNameContent)) return false;
	/* Password length enforced */
	var minPwdLength=<?php echo _rnMINIMUM_PASSWORD_LENGTH;?>;
	var maxPwdLength=<?php echo _rnMAXIMUM_PASSWORD_LENGTH;?>;
	if (minPwdLength>0 || maxPwdLength>0) {
		var minRnAdminPwdLength=minPwdLength;
		var maxRnAdminPwdLength=maxPwdLength;
		var minRnUserPwdLength=minPwdLength;
		var maxRnUserPwdLength=maxPwdLength;
		var minRnNsPwdLength=minPwdLength;
		var maxRnNsPwdLength=maxPwdLength;
	}
	else {
		var minRnAdminPwdLength=<?php echo _rnADMIN_MINIMUM_PASSWORD_LENGTH;?>;
		var maxRnAdminPwdLength=<?php echo _rnADMIN_MAXIMUM_PASSWORD_LENGTH;?>;
		var minRnUserPwdLength=<?php echo _rnUSER_MINIMUM_PASSWORD_LENGTH;?>;
		var maxRnUserPwdLength=<?php echo _rnUSER_MAXIMUM_PASSWORD_LENGTH;?>;
		var minRnNsPwdLength=<?php echo _rnNSADMIN_MINIMUM_PASSWORD_LENGTH;?>;
		var maxRnNsPwdLength=<?php echo _rnNSADMIN_MAXIMUM_PASSWORD_LENGTH;?>;
	}
	if (!lengthCheck('*God* Admin Password',formName.authors_pwd.value,minRnAdminPwdLength,'min')) return false;
	if (!lengthCheck('*God* Admin Password',formName.authors_pwd.value,maxRnAdminPwdLength,'max')) return false;
	if (!lengthCheck('Member User Password',formName.users_user_password.value,minRnUserPwdLength,'min')) return false;
	if (!lengthCheck('Member User Password',formName.users_user_password.value,maxRnUserPwdLength,'max')) return false;
	if (!lengthCheck('NukeSentinel(tm) Admin Password',formName.nsnst_admins_password.value,minRnNsPwdLength,'min')) return false;
	if (!lengthCheck('NukeSentinel(tm) Admin Password',formName.nsnst_admins_password.value,maxRnNsPwdLength,'max')) return false;
	return true;
}
/* ]]> */
</script>
</head>
<body class="c1">
<div class="c1">
	<img style="float:left;" src="images/logo.gif" border="0" alt="" />
	<span class="c5">
		RavenNuke&trade; v<?php echo RAVENNUKE_VERSION_FRIENDLY;?> Setup/Configuration Tool &copy;2005-2013
	</span>
</div>
<br /><br /><br />
<div align="center">
	<p class="c2">This will help you configure your most critical settings to get your site running.  The other settings can then be changed through the Admin Control Panels.</p>
</div>
	<hr />
	<p class="sectiontitle">
		MySQL Database Connectivity Test Results
	</p>
<?php
ini_set('mysql.connect_timeout',120);
$dbCheck = array();
// $nukeConfigFile = "../config.php";
// if (!file_exists($nukeConfigFile)) {rnInstallErr(1); die();}
echo '<span class="msg">config.php file found!</span><br />';
require_once INCLUDE_PATH . 'config.php';
$conn = @mysqli_connect($dbhost,$dbuname,$dbpass);
if (!$conn)  {rnInstallErr(2); die();}
echo '<span class="msg">Successfully connected to '.$dbhost.' as user '.$dbuname.' and assigned password!</span><br />';
$db = mysqli_select_db($conn, $dbname);
if (!$db)  {rnInstallErr(3); die();}
echo '<span class="msg">Database '.$dbname.' found!</span><br />';
?>
<form name="mysql" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	<p class="c3">
		<input type="button"  name="btnCheckMysqlUserPermissions" class="button2" id="btnCheckMysqlUserPermissions" readonly="readonly" size="75" onfocus="blur()" onclick="browserWindowSize(1.07,.7);dhtmlmodal.open('mysqlCheck', 'iframe', 'serverMysqlUserPermissionsCheck.php', 'Ravenstaller™ MySQL User Permissions Check', 'width='+bwW+',height='+bwH+',center=1,resize=1,scrolling=1');" value="Run Ravenstaller™ MySQL User Permissions Check" />
	</p>
</form>
<?php
function rnInstallErr($errNum) {
	if ($errNum==1) die('<span class="c2">It appears that your nuke config.php file is either missing or the permissions are not allowing it to be accessed.  Please verify the config.php is in your root folder where your mainfile.php is located and has permissions of at least 644.  Then try running the Install script again.</span>');
	elseif ($errNum==2) die('<span class="c2">I was unable to reach your MySQL server using the MySQL connection settings in your nuke config.php file.  The exact error message that your MySQL server reported is <span style="font-weight:bold;">'.mysqli_error($conn).'</span>.</span>');
	elseif ($errNum==3) die('<span class="c2">I was able to reach your MySQL server using the MySQL connection settings in your nuke config.php file, but I was unable to reach/locate the database <span style="font-weight:bold;">'.$dbname.'</span>. The exact error message that your MySQL server reported is <span style="font-weight:bold;">'.mysqli_error($conn).'</span>.</span>');
	elseif ($errNum==4) die('<span class="c2">ERROR!  The exact error message that your MySQL server reported is <span style="font-weight:bold;">'.mysqli_error($conn).'</span>.</span>');
	elseif ($errNum==90) die('<span class="c2">You have attempted to crack the Installer Script.  All pertinent information for this session has been saved and will be reviewed by the System Administrator and appropriate action will be taken.</span>');
	elseif ($errNum==91) die('<span class="c2">It does not appear that there are any tables to be loaded.  Installation stopped.</span>');
	elseif ($errNum==80) die('<span class="c2">Unable to update AUTHORS table with random password.  MySQL server reported: '.mysqli_error($conn).'. Installation stopped.</span>');
	elseif ($errNum==81) die('<span class="c2">Unable to update NukeSentinel&trade; Admin table with random password.  MySQL server reported: '.mysqli_error($conn).'. Installation stopped.</span>');
}
// Mantis: 0001262: setup.php is adding an extra "\" on the Site URL
$_POST['config_nukeurl'] = (empty($_POST['config_nukeurl'])?'http://'.$_SERVER['SERVER_NAME'].dirname(dirname($_SERVER['REQUEST_URI'])):$_POST['config_nukeurl']);
$_POST['config_nukeurl'] = trim($_POST['config_nukeurl'],'/');
$_POST['config_nukeurl'] = trim($_POST['config_nukeurl'],'\\');
?>
<hr />
	<p class="msg">
		For detailed help consult the forums at http://www.ravenphpscripts.com and the included documentation.  All fields need to be filled in as some fields will be populated based on other field values, but can be over-written. <?php if (_rnMINIMUM_PASSWORD_LENGTH>0 || _rnMAXIMUM_PASSWORD_LENGTH>0) {?><span class="c2">All passwords must be between <span style="color:#0000ff;"><?php echo _rnMINIMUM_PASSWORD_LENGTH . ' and ' . _rnMAXIMUM_PASSWORD_LENGTH;?></span> long.</span><?php }?>
	</p>
	<hr />
	<table width="100%">
		<tr>
			<td>
				<form onsubmit="return validateInput(configform)" name="configform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<p class="sectiontitle">Configuration Settings For RavenNuke&trade; Core Functionality</p>
					<table>
						<tr>
							<td>Site Name:</td><td><input class="inputbox" onblur="configform.bbconfig_sitename.value=this.value" size="60" name="config_sitename" value="<?php echo $_POST['config_sitename']=isset($_POST['config_sitename'])?stripslashes($_POST['config_sitename']):'';?>" /></td>
						</tr>
						<tr>
							<td>Site URL (With http://):</td><td><input class="inputbox" size="60" name="config_nukeurl" value="<?php echo $_POST['config_nukeurl']; ?>" />
							</td>
						</tr>
						<tr>
							<td>Site Slogan:</td><td><input class="inputbox" size="60" name="config_slogan" value="<?php echo $_POST['config_slogan']=isset($_POST['config_slogan'])?stripslashes($_POST['config_slogan']):'';?>" /></td>
						</tr>
						<tr>
							<td>Site Start Date (Freeform):</td><td><input class="inputbox" size="60" name="config_startdate" value="<?php echo $_POST['config_startdate'] = (empty($_POST['config_startdate'])?date('F d, Y'):$_POST['config_startdate']);?>" /></td>
						</tr>
						<tr>
							<td>Administrator Email:</td><td><input onblur="configform.bbconfig_board_email.value=this.value;configform.authors_email.value=this.value;configform.nsnst_config_admin_contact.value=this.value;configform.users_user_email.value=this.value" class="inputbox" size="60" name="config_adminmail" value="<?php echo $_POST['config_adminmail']=isset($_POST['config_adminmail'])?$_POST['config_adminmail']:'';?>" /></td>
						</tr>
						<tr>
							<td>*GOD* Administrator UserName:</td><td><input onblur="configform.nsnst_admins_login.value=this.value;configform.users_username.value=this.value;configform.nsnst_admins_aid.value=this.value" class="inputbox" size="60" name="authors_aid" value="<?php echo $_POST['authors_aid']=isset($_POST['authors_aid'])?stripslashes($_POST['authors_aid']):'';?>" />&nbsp; <span class="c2">Allowed Characters: <?php echo $rnADMIN_ALLOWED_USERID_CHARACTERS; ?></span></td>
						</tr>
						<tr>
							<td>*GOD* Administrator Password:</td><td><input class="inputbox" size="60" name="authors_pwd" value="<?php echo $_POST['authors_pwd']=isset($_POST['authors_pwd'])?$_POST['authors_pwd']:'';?>" />&nbsp; <span class="c2">Must be between <?php echo (_rnMINIMUM_PASSWORD_LENGTH)>0?_rnMINIMUM_PASSWORD_LENGTH:_rnADMIN_MINIMUM_PASSWORD_LENGTH;?> and <?php echo (_rnMAXIMUM_PASSWORD_LENGTH)>0?_rnMAXIMUM_PASSWORD_LENGTH:_rnADMIN_MAXIMUM_PASSWORD_LENGTH;?> bytes</span></td>
						</tr>
						<tr>
							<td>Your Regular Member UserName:</td><td><input class="inputbox" size="60" name="users_username" value="<?php echo $_POST['users_username']=isset($_POST['users_username'])?stripslashes($_POST['users_username']):'';?>" />&nbsp; <span class="c2">Allowed Characters: <?php echo $rnUSER_ALLOWED_USERID_CHARACTERS; ?></span></td>
						</tr>
						<tr>
							<td>Your Regular Member Password:</td><td><input class="inputbox" size="60" name="users_user_password" value="<?php echo $_POST['users_user_password']=isset($_POST['users_user_password'])?$_POST['users_user_password']:'';?>" />&nbsp; <span class="c2">Must be between <?php echo (_rnMINIMUM_PASSWORD_LENGTH)>0?_rnMINIMUM_PASSWORD_LENGTH:_rnUSER_MINIMUM_PASSWORD_LENGTH;?> and <?php echo (_rnMAXIMUM_PASSWORD_LENGTH)>0?_rnMAXIMUM_PASSWORD_LENGTH:_rnUSER_MAXIMUM_PASSWORD_LENGTH;?> bytes</span></td>
						</tr>
						<tr>
							<td>Your Regular Member Email:</td><td><input class="inputbox" size="60" name="users_user_email" value="<?php echo $_POST['users_user_email']=isset($_POST['users_user_email'])?$_POST['users_user_email']:'';?>" /></td>
						</tr>
					</table>
					<hr />
					<p class="sectiontitle">Configuration Settings For NukeSentinel&trade; v<?php echo NUKESENTINEL_VERSION;?> Core Functionality</p>
					<span class="c2">Note that the admin name/password can be the same as the Core Admin name/password but for better security you should change them.</span>
					<table>
						<tr>
							<td>Administrator Email:</td><td><input class="inputbox" size="60" name="nsnst_config_admin_contact" value="<?php echo $_POST['nsnst_config_admin_contact']=isset($_POST['nsnst_config_admin_contact'])?$_POST['nsnst_config_admin_contact']:'';?>" /></td>
						</tr>
						<tr>
							<td>*GOD* Administrator NukeSentinel&trade; UserName:</td><td><input class="inputbox" size="60" name="nsnst_admins_login" value="<?php echo $_POST['nsnst_admins_login']=isset($_POST['nsnst_admins_login'])?stripslashes($_POST['nsnst_admins_login']):'';?>" />&nbsp; <span class="c2">Allowed Characters: <?php echo $rnNSADMIN_ALLOWED_USERID_CHARACTERS; ?></span></td>
						</tr>
						<tr>
							<td>*GOD* Administrator NukeSentinel&trade; Password:</td><td><input class="inputbox" size="60" name="nsnst_admins_password" value="<?php echo $_POST['nsnst_admins_password']=isset($_POST['nsnst_admins_password'])?$_POST['nsnst_admins_password']:'';?>" />&nbsp; <span class="c2">Must be between <?php echo (_rnMINIMUM_PASSWORD_LENGTH)>0?_rnMINIMUM_PASSWORD_LENGTH:_rnNSADMIN_MINIMUM_PASSWORD_LENGTH;?> and <?php echo (_rnMAXIMUM_PASSWORD_LENGTH)>0?_rnMAXIMUM_PASSWORD_LENGTH:_rnNSADMIN_MAXIMUM_PASSWORD_LENGTH;?> bytes</span></td>
						</tr>
					</table>
					<!-- nuke_authors begin -->
					<input type="hidden" name="authors_email" value="<?php echo $_POST['authors_email']=isset($_POST['authors_email'])?$_POST['authors_email']:'';?>" />
					<input type="hidden" name="authors_radminsuper" value="1" />
					<!-- nuke_authors end   -->
					<!-- nuke_bbconfig begin -->
					<input type="hidden" name="bbconfig_server_name" value="<?php echo $_POST['bbconfig_server_name']=isset($_POST['bbconfig_server_name'])?$_POST['bbconfig_server_name']:'';?>" />
					<input type="hidden" name="bbconfig_sitename" value="<?php echo $_POST['bbconfig_sitename']=isset($_POST['bbconfig_sitename'])?stripcslashes($_POST['bbconfig_sitename']):'';?>" />
					<input type="hidden" name="bbconfig_cookie_domain" value="" />
					<input type="hidden" name="bbconfig_cookie_path" value="" />
					<input type="hidden" name="bbconfig_board_email" value="<?php echo $_POST['bbconfig_board_email']=isset($_POST['bbconfig_board_email'])?$_POST['bbconfig_board_email']:'';?>" />
					<input type="hidden" name="bbconfig_board_email_sig" value="Thanks, <?php echo $_POST['bbconfig_board_email_sig']=isset($_POST['bbconfig_board_email_sig'])?$_POST['bbconfig_board_email_sig']:'';?>" />
					<!-- nuke_bbconfig end   -->
					<!-- nuke_nsnst_admins begin -->
					<input type="hidden" name="nsnst_admins_protected" value="1" />
					<input type="hidden" name="nsnst_admins_aid" value="<?php echo $_POST['nsnst_admins_aid']=isset($_POST['nsnst_admins_aid'])?$_POST['nsnst_admins_aid']:'';?>" />
					<!-- nuke_nsnst_admins end   -->
					<!-- nuke_nsnst_config begin -->
					<!-- nuke_nsnst_config end   -->
					<!-- nuke_users begin -->
					<input type="hidden" name="users_user_avatar" value="blank.gif" />
					<input type="hidden" name="users_user_regdate" value="<?php echo date('M d, Y');?>" />
					<input type="hidden" name="users_user_level" value="2" />
					<!-- nuke_users end   -->
					<hr />
					<div class="c1"><p id="proceed"><input class="buttonsmall" type="submit" name="updateconfig" value="Save Settings" /></p></div>
				</form>
			</td>
		</tr>
	</table>
	<hr />
	<div align="center" class="msg">
		Copyright 2005-2013 &copy;Raven Web Services<span class="c1"><sup>&trade;</sup></span>, LLC -- All Rights reserved --<br />
		No portion of this document/code may be copied, changed, redistributed, nor reproduced without the written permission of Raven Web Services<span class="c1"><sup>&trade;</sup></span>, LLC
	</div>
	<hr />

<?php
/* Validate $_POST Data */
if (isset($_POST['updateconfig']) AND $_POST['updateconfig']=='Save Settings') {
	extract($_POST);

	/* Posting data to nuke_config table */
	$sql = "UPDATE ".$prefix."_config set sitename='".mysqli_real_escape_string($conn, stripslashes($config_sitename))."', nukeurl='$config_nukeurl', slogan='".mysqli_real_escape_string($conn, stripslashes($config_slogan))."', startdate='$config_startdate', adminmail='$config_adminmail'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_config table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Posting data to nuke_authors table */
	$sql = 'TRUNCATE TABLE '.$prefix.'_authors';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to truncate '.$prefix.'_authors table. MySQL reported: '.mysqli_error($conn));
	$sql = "INSERT INTO ".$prefix."_authors (name,aid,pwd,email,radminsuper) values('God','$authors_aid','".md5($authors_pwd)."','$authors_email','$authors_radminsuper')";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Insert into '.$prefix.'_authors table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Posting data to nuke_bbconfig table */
	$sql = "UPDATE ".$prefix."_bbconfig set config_value='".mysqli_real_escape_string($conn, stripslashes($bbconfig_server_name))."' WHERE config_name='server_name'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_bbconfig table (server_name). MySQL reported: '.mysqli_error($conn)."<br />$sql");
	$sql = "UPDATE ".$prefix."_bbconfig set config_value='".mysqli_real_escape_string($conn, stripslashes($bbconfig_cookie_domain))."' WHERE config_name='cookie_domain'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_bbconfig table (cookie_domain). MySQL reported: '.mysqli_error($conn)."<br />$sql");
	if (trim($bbconfig_cookie_path, '/') == '') $bbconfig_cookie_path = '/';
	else $bbconfig_cookie_path = '/'.trim($bbconfig_cookie_path, '/').'/';
	$sql = "UPDATE ".$prefix."_bbconfig set config_value='".mysqli_real_escape_string($conn, stripslashes($bbconfig_cookie_path))."' WHERE config_name='cookie_path'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_bbconfig table (cookie_path). MySQL reported: '.mysqli_error($conn)."<br />$sql");
	$sql = "UPDATE ".$prefix."_bbconfig set config_value='".mysqli_real_escape_string($conn, stripslashes($bbconfig_sitename))."' WHERE config_name='sitename'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_bbconfig table (sitename). MySQL reported: '.mysqli_error($conn)."<br />$sql");
	$sql = "UPDATE ".$prefix."_bbconfig set config_value='".mysqli_real_escape_string($conn, stripslashes($bbconfig_board_email))."' WHERE config_name='board_email'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_bbconfig table (board_email). MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Posting data to nuke_nsnst_config table */
	$sql = "UPDATE ".$prefix."_nsnst_config set config_value='".mysqli_real_escape_string($conn, stripslashes($nsnst_config_admin_contact))."' WHERE config_name='admin_contact'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_nsnst_config table. MySQL reported: '.mysqli_error($conn)."<br />$sql");
	$sql = "UPDATE ".$prefix."_nsnst_config set config_value='1' WHERE config_name='track_active'";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update '.$prefix.'_nsnst_config table. MySQL reported: '.mysqli_error($conn)."<br />$sql");
	$sql = 'UPDATE `' . $prefix . '_nsnst_config` SET `config_value`="' . _nsIP2C . '" WHERE `config_name`="ip2c_version"';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Update ' . $prefix . '_nsnst_config table.  MySQL reported: ' . mysqli_error($conn) . '<br />' . $sql);

	/* Posting data to nuke_nsnst_admins table */
	$sql = 'TRUNCATE TABLE '.$prefix.'_nsnst_admins';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to truncate '.$prefix.'_nsnst_admins table. MySQL reported: '.mysqli_error($conn));
	$sql = "INSERT INTO ".$prefix."_nsnst_admins (login, password, protected, aid, password_md5, password_crypt) values('$nsnst_admins_login','$nsnst_admins_password','$nsnst_admins_protected','$nsnst_admins_aid','".md5($nsnst_admins_password)."', '".crypt($nsnst_admins_password, '')."')";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Insert into '.$prefix.'_nsnst_admins table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Protecting admins IP */
	$ip = $_SERVER['REMOTE_ADDR'];
	$long_ip = sprintf("%u", ip2long($ip));
	$time = time();
	$sql = 'TRUNCATE TABLE '.$prefix.'_nsnst_excluded_ranges';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to truncate '.$prefix.'_nsnst_excluded_ranges table. MySQL reported: '.mysqli_error($conn));
	$sql = "INSERT INTO `".$prefix."_nsnst_excluded_ranges` (`ip_lo`, `ip_hi`, `date`, `notes`, `c2c`) VALUES ('".$long_ip."', '".$long_ip."', '".$time."', '".$authors_aid."\'s personal ip', '00')";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Insert into '.$prefix.'_nsnst_excluded_ranges table. MySQL reported: '.mysqli_error($conn)."<br />$sql");
	$sql = 'TRUNCATE TABLE '.$prefix.'_nsnst_protected_ranges';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to truncate '.$prefix.'_nsnst_protected_ranges table. MySQL reported: '.mysqli_error($conn));
	$sql = "INSERT INTO `".$prefix."_nsnst_protected_ranges` (`ip_lo`, `ip_hi`, `date`, `notes`, `c2c`) VALUES ('".$long_ip."', '".$long_ip."', '".$time."', '".$authors_aid."\'s personal ip', '00')";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Insert into '.$prefix.'_nsnst_protected_ranges table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Posting data to nuke_users table */
	$sql = 'TRUNCATE TABLE '.$user_prefix.'_users';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to truncate '.$user_prefix.'_users table. MySQL reported: '.mysqli_error($conn));
	$sql = "INSERT INTO ".$user_prefix."_users VALUES (1, '', 'Anonymous', '', '', '', 'blank.gif', 'Oct 10, 2008', '', '', '', '', '', 0, 0, '', '', '', '', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 10, NULL, 'english', 'D M d, Y g:i a', 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 0, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0)";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Insert into '.$user_prefix.'_users table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Raven added user_level=2 per Mantis 0001175 */
	$sql = "INSERT INTO ".$user_prefix."_users (user_id, user_avatar, user_regdate, username, user_email, user_password, name, user_level) values(2, '$users_user_avatar', '$users_user_regdate', '".mysqli_real_escape_string($conn, stripslashes($users_username))."','$users_user_email','".md5($users_user_password)."', '".mysqli_real_escape_string($conn, stripslashes($users_username))."', 2)";
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to Insert into '.$user_prefix.'_users table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/*Added by montego for NSN Group fix 0000291 */
	//$sql = "UPDATE ".$prefix."_nsngr_users SET uname = '".mysqli_real_escape_string($conn, stripslashes($users_username))."'";
	// $rc = @mysqli_query($conn, $sql);
	// if (!$rc) die('Unable to update '.$prefix.'_nsngr_users table. MySQL reported: '.mysqli_error($conn)."<br />$sql");

	/* Updating the image source on block 'Information' to be absolute so will work with the FCKEditor */
	$sql = 'SELECT `content` FROM `'.$prefix.'_blocks` WHERE `title` = \'Information\'';
	$rc = @mysqli_query($conn, $sql);
	if ($rc) {
		list($content) = mysqli_fetch_row($rc);
		if ($content != '') {
			/** The next line is Fix per Mantis Issue 0001298 and is suggested by Palbin **/
			$content = preg_replace('#(' . preg_quote($config_nukeurl) . '/)?images/#i', $config_nukeurl . '/images/', $content);
			$sql = 'UPDATE `'.$prefix.'_blocks` SET `content` = \''.$content.'\' WHERE `title` = \'Information\'';
			$rc = @mysqli_query($conn, $sql);
			if (!$rc) die('Unable to update '.$prefix.'_blocks table for absolute image src URL replacement. MySQL reported: '.mysqli_error($conn).'<br />'.$sql);
		}
	}

	/* Updating the image source on message 'Welcome Message' to be absolute so will work with the FCKEditor */
	$sql = 'SELECT `content` FROM `'.$prefix.'_message` WHERE `mid` = 1';
	$rc = @mysqli_query($conn, $sql);
	if ($rc) {
		list($content) = mysqli_fetch_row($rc);
		if ($content != '') {
			/** The next line is Fix per Mantis Issue 0001298 and is suggested by Palbin **/
			$content = preg_replace('#(' . preg_quote($config_nukeurl) . '/)?images/#i', $config_nukeurl . '/images/', $content);
			$sql = 'UPDATE `'.$prefix.'_message` SET `content` = \''.$content.'\' WHERE `mid` = 1';
			$rc = @mysqli_query($conn, $sql);
			if (!$rc) die('Unable to update '.$prefix.'_message table for absolute image src URL replacement. MySQL reported: '.mysqli_error($conn).'<br />'.$sql);
		}
	}

	/**
	* Populate the themes table
	*/
	$themelist = '';
	$handle = opendir(INCLUDE_PATH . 'themes');
	while (($dir = readdir($handle)) !== false) {
		if ((!preg_match('/[.]/', $dir) && file_exists(INCLUDE_PATH . 'themes/' . $dir . '/theme.php'))) {
			$themelist .= $dir . ',';
		}
	}
	closedir($handle);
	$themelist = explode(',', $themelist);
	sort($themelist);
	natcasesort($themelist);
	reset($themelist);

	$values_add = '';
	foreach ($themelist as $id => $theme) {
		if ($theme != '') {
			$theme = addslashes($theme);
			if (!$values_add) {
				$values_add = '("' . $theme . '", "' . $theme . '", "1", "0", "0", "0", "0", "0")';
			} else {
				$values_add .= ',("' . $theme . '", "' . $theme . '", "1", "0", "0", "0", "0", "0")';
			}
		}
	}

	if ($values_add) {
		$sql = 'TRUNCATE TABLE ' . $prefix . '_themes';
		$rc = @mysqli_query($conn, $sql);
		if (!$rc) die('Unable to truncate ' . $prefix . '_themes table. MySQL reported: ' . mysqli_error($conn));
		$sql = 'INSERT INTO `' . $prefix . '_themes` (`theme`, `themename`, `active`, `default`, `guest`, `moveableblocks`, `collapsibleblocks`, `compatible`) VALUES ' . $values_add;
		$rc = @mysqli_query($conn, $sql);
		if (!$rc) die('Unable to update ' . $prefix . '_themes table to populate it with themes. MySQL reported: ' . mysqli_error($conn) . '<br />' . $sql);
	}

	$sql = 'UPDATE `' . $prefix . '_themes` SET `default`="1", `guest`="1" WHERE `theme`="RavenIce"';
	$rc = @mysqli_query($conn, $sql);
	if (!$rc) die('Unable to update ' . $prefix . '_themes table to set defaults. MySQL reported: ' . mysqli_error($conn) . '<br />' . $sql);

	echo '<script type="text/javascript">alert(\'Congratulations! Configuration has been completed. Please continue with the next step within the installation instructions.\');</script>';
}
?>
</body>
</html>
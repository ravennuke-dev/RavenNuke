<?php
error_reporting( E_ALL );
if (!defined('INCLUDE_PATH')) {
	define('INCLUDE_PATH','../');
}
$nukeConfigFile = INCLUDE_PATH . 'config.php';
$noConfigFile=FALSE;
if (!file_exists($nukeConfigFile)) {
	$dbhost = '';
	$dbuname = '';
	$dbname = '';
	$prefix = '';
	$user_prefix = '';
	//require_once _rnINSTALLATION_LANG_FILE;
	$noConfigFile = TRUE;
	echo '<title></title></head><body>';
	rnInstallErr(1);
	echo '</body></html>';
	die();
}
@require_once $nukeConfigFile;
$conn = @mysqli_connect($dbhost,$dbuname,$dbpass) or die('No Connection to MySQL Server');
include_once('functions/phpGetSetting.func.php');
include_once('functions/mysqlTest.func.php');
include_once('functions/chkFileExists.func.php');
include_once('functions/getServerAPI.func.php');
include_once('functions/cgiNote.func.php');
include_once('functions/getGDInfo.func.php');
include_once('functions/chkFile.func.php');
$version_number = "2.51.00";
$filedate = 'February 8, 2013';
//$filedate = filemtime("version.php");
//$filedate = date("F d, Y", $filedate);
$version = "RavenNuke&trade; $version_number - Scheduled Release Date: $filedate";
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
	<link rel="StyleSheet" href="css/ravenstaller.css" type="text/css" />
	<link rel="stylesheet" href="windowfiles/dhtmlwindow.css" type="text/css" />
	<link rel="stylesheet" href="modalfiles/modal.css" type="text/css" />
	<script type="text/javascript" src="js/ravenstaller.js"></script>
	<title>RavenNuke&trade; Installer</title>
</head>
<body onload="popElements()">
<div class="install">
					<h1>Configuration Settings</h1>
					<div id="step01"></div>
					<div class="form-block">
						<span class="install-note">The Ravenstaller&trade; requires JavaScript to be enabled and a browser that is capable of Document Object Model (DOM) access.  FireFox v3.x is strongly recommended and is what the installer was built upon.  Any other browser that is W3C compliant should work without issue.  Internet Explorer v7 and higher should work but is not guaranteed as Microsoft is the least standards compliant.  If any of these items are highlighted in red then you should not use this version of the installer.  Future versions may allow for more exceptions but for now this is it.</span>
<br />
					  <fieldset>
						 <legend class="toggle">Configuration Settings For Browser</legend>
							<table class="content2">
								<tr>
									<td class="item">
										Browser User Agent
									</td>
									<td id="brUserAgent" align="left">
									</td>
								</tr><tr>
									<td class="item">
										JavaScript enabled
									</td>
									<td id="jsEnabledId" align="left">
									</td>
								</tr>
								<tr>
									<td class="item">
										Cookies enabled
									</td>
									<td id="cookieEnabledId" align="left">
									</td>
								</tr>
								<tr>
									<td class="item">
										Ajax enabled
									</td>
									<td id="ajaxEnabledId" align="left">
									</td>
								</tr>
								<tr>
									<td class="item">
										DOM getElementById
									</td>
									<td id="getElementByIdFunc" align="left">
									</td>
								</tr>
							</table>
					  </fieldset>

<br />
					<div class="form-block">
						<span class="install-note">If any of these items are highlighted in red then please take actions to correct them. Failure to do so could lead to your RavenNuke&trade; installation not functioning correctly and/or not installing correctly nor at all.</span>
<br />

					  <fieldset>
						 <legend class="toggle">Platform Information</legend>
							<table class="content2">
								<tr>
									<td class="item">
										PHP version >= 5.2.0
									</td>
									<td align="left">
										<?php echo phpversion() < '5.2' ? '<span class="redbold">No : Version '.phpversion().'</span>' : '<span class="greenbold">Yes : Version '.phpversion().'</span>';?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp; - zlib compression support
									</td>
									<td align="left">
										<?php echo extension_loaded('zlib') ? '<span class="greenbold">Available</span>' : '<span class="redbold">Unavailable</span>';?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp; - GD graphics support
									</td>
									<td align="left">
										<?php echo extension_loaded('gd')||extension_loaded('gd2') ? '<span class="greenbold">Available : Version '.getGDInfo($type='GD Version').'</span>' : '<span class="redbold">Unavailable</span>';?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp; - Freetype support
									</td>
									<td align="left">
										<?php echo ((extension_loaded('gd')||extension_loaded('gd2')) && getGDInfo($type='FreeType Support')) ? '<span class="greenbold">Available : Version '.getGDInfo($type='FreeType Version').'</span>' : '<span class="redbold">Unavailable</span>';?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp; - MySQLi support
									</td>
									<td align="left">
								<?php echo function_exists( 'mysqli_connect' ) ? '<span class="greenbold">Available</span>' : '<span class="redbold">Unavailable</span>';?>
									</td>
								</tr>
						<?php if (function_exists( 'mysqli_connect' )) { ?>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp; - MySQL Server API Version
								</td>
								<td align="left">
									<?php echo '<span class="greenbold">'.mysqli_get_server_info($conn).'</span>';?>
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp; - MySQL Client API Version
								</td>
								<td align="left">
									<?php echo '<span class="greenbold">'.mysqli_get_client_info().'</span>';?>
								</td>
							</tr>
						<?php if (function_exists( 'mysqli_connect' )) { mysqli_close($conn); }} ?>
								<tr>
									<td>
										&nbsp; - Server API
									</td>
									<td align="left">
										<?php echo '<span class="greenbold">'.php_sapi_name().'</span>'; ?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp; - Allow Short Open Tags
									</td>
									<td align="left">
										<?php echo (phpGetSetting('short_open_tag')=='ON'||phpGetSetting('short_open_tag')==true||phpGetSetting('short_open_tag')==1) ? '<span class="greenbold">Yes</span>' : '<span class="redbold">No</span>';?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp; - Mbstring Extension
									</td>
									<td align="left">
										<?php echo (extension_loaded('mbstring') == true) ? '<span class="greenbold">Yes</span>' : '<span class="redbold">No</span>';?>
									</td>
								</tr>
								<?php
									// chkFile('', '../../test.php', '*');  /* For test purposes only */
									//chkFile('', INCLUDE_PATH.'config.php', '*');
									//chkFile('', INCLUDE_PATH.'rnconfig.php', '*');
									chkFile('', INCLUDE_PATH.'.htaccess', '*');
									chkFile('', INCLUDE_PATH.'.staccess', '*');
									chkFile('', INCLUDE_PATH.'cache/', '*');
									chkFile('', INCLUDE_PATH.'modules/Forums/files/', '*');
									chkFile('', INCLUDE_PATH.'modules/Forums/files/thumbs/', '*');
									chkFile('', INCLUDE_PATH.'modules/Forums/images/avatars/', '*');
									chkFile('', INCLUDE_PATH.'modules/HTML_Newsletter/archive/', '*');
									chkFile('', INCLUDE_PATH.'uploads/file/', '*');
									chkFile('', INCLUDE_PATH.'uploads/flash/', '*');
									chkFile('', INCLUDE_PATH.'uploads/image/', '*');
									chkFile('', INCLUDE_PATH.'uploads/media/', '*');
									chkFile('', INCLUDE_PATH.'rnlogs/', '*');
									chkFile('', INCLUDE_PATH.'rnlogs/dblog', '*');
								?>
							</table>
					  </fieldset>
					</div>

<br />
					<div class="form-block">
						<span class="install-note">These settings are recommended for PHP in order to ensure full compatibility with RavenNuke&trade;. However, RavenNuke&trade; <em>should</em> still operate if your settings do not quite match the recommended.</span>
<br />
					<fieldset>
					  <legend class="toggle">Recommended settings</legend>
						 <table class="content2">
								<tr>
									<td class="toggle">
										Directive
									</td>
									<td class="toggle">
										Recommended
									</td>
									<td class="toggle">
										Actual
									</td>
								</tr><tr>
								<td>
								<?php
									$php_recommended_settings = array(array ('Safe Mode','safe_mode','OFF'),
									array ('Display Errors','display_errors','ON'),
									array ('File Uploads','file_uploads','ON'),
									array ('Magic Quotes GPC','magic_quotes_gpc','ON'),
									array ('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
									array ('Register Globals','register_globals','OFF'),
									array ('Output Buffering','output_buffering','ON'),
									array ('Session auto start','session.auto_start','OFF'),
									);

									foreach ($php_recommended_settings as $phprec) {
								?>
								<tr>
									<td class="item">
										<?php echo $phprec[0]; ?>
									</td>
									<td class="toggle">
										<?php echo $phprec[2]; ?>
									</td>
									<td>
										<?php
											if ( phpGetSetting($phprec[1]) == $phprec[2] ) {
										?>
											<span style="color:green; font-weight:bold;">
										<?php
											} else {
										?>
											<span style="color:red; font-weight:bold;">
										<?php
											}
											echo phpGetSetting($phprec[1]);
										?>
										</span>
									<td>
								</tr>
								<?php
									}
								?>
							</table>
					  </fieldset>
					</div>
				</div>

						<div class="clr">
						</div>
</div>

</body>
</html>
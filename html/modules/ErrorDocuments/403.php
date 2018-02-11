<?php
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
//ERROR: 403 - Forbidden
if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}
// END: Added in v2.40.00 - Mantis Issue 0001043

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- ' . $module_name;
include_once('header.php');
/* Uncomment the following code for determining what $_SERVER array setiings are available for reporting */
/*
foreach ($_SERVER as $key => $value) {
	echo $key.' = '.$value.'<br />';
}
*/

$http_referer = isset($_SERVER['HTTP_REFERER']) ? '<br />'._ED_REFEREDFROM_403 . htmlentities($_SERVER['HTTP_REFERER']) : '';
$remote_addr = isset($_SERVER['REMOTE_ADDR']) ? '<br />'._ED_YOURIP_403 . htmlentities($_SERVER['REMOTE_ADDR']) : '';
$request_uri = isset($_SERVER['REQUEST_URI']) ? '<br />'._ED_PAGEREQUESTED_403 . htmlentities($_SERVER['REQUEST_URI']) : '';
$http_user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? '<br />'._ED_AGENT_403 . htmlentities($_SERVER['HTTP_USER_AGENT']) : '';
$redirect_status = isset($_SERVER['REDIRECT_STATUS']) ? '<br />'._ED_REDIRECTSTATUS_403 . htmlentities($_SERVER['REDIRECT_STATUS']) : '';
$edBoxTitle = _ED_BOXTITLE_403;
$edBoxShortDesc = _ED_BOXSHORTDESC_403;
$edHint = _ED_HINT;
$edHintText = _ED_HINTTEXT_403;

echo <<< ERRORPAGE
<br /><br />
      <table width="500" border="0" cellspacing="0" cellpadding="0"
      align="center">

         <tr bgcolor="#0000ff">
            <td>
               <table width="500" border="0" cellspacing="1"
               cellpadding="5" align="center">
                  <tr bgcolor="#6300ff">
                     <td colspan="2">
                        <div class="text-center thick" style="color: #FFFFFF;">$edBoxTitle</div>
                     </td>
                  </tr>

                  <tr>
                     <td bgcolor="#FFFFFF" colspan="2" valign=
                     "middle">
                        <table width="100%">
                           <tr>
                              <td width="40">
                                 <img src="http://{$_SERVER['HTTP_HOST']}/modules/$module_name/images/warning.gif"
                                 width="40" height="40" align=
                                 "middle" alt="" />
                              </td>
                              <td>
                                 <div class="text-center">
												<span class='thick'>$edBoxShortDesc</span>
												<br />
												<em>$edHint $edHintText</em>
												<br />
											   $http_referer
											   $remote_addr
											   $request_uri
												$http_user_agent
											   $redirect_status
												<br />
											</div>
                              </td>
                           </tr>
                        </table>
                     </td>

                  </tr>
               </table>
            </td>
         </tr>
      </table>
ERRORPAGE;
include_once('footer.php');
die();
?>

<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
if (!defined('MSNL_LOADED') and !defined('BLOCK_FILE') and !defined('NUKE_FILE')) {
	die('Illegal File Access');
}
/************************************************************************
* This script writes out the key Javascript functions that are used in
* the module and admin.
************************************************************************/
/************************************************************************
* Function: msnl_FormHandler()
* Inputs:   msnl_sOP = The operation to pass into the form submit
* Usage:    Used to change a page's form operation based on different
*           page links (functions).
************************************************************************/
/************************************************************************
* Function: msnl_ObjHandler()
* Inputs:   msnl_sOP = The operation to pass into the form submit
*           msnl_sVAR = The specific form variable to change the value for
*           msnl_iID = The ID value to change the variable to (integer
*             value ONLY)
* Usage:    This function is similar to msnl_FormHandler except that it
*           has further granular control over the form variable being
*           modified and is primarily used for object level maintainance
*           functions.
************************************************************************/
/************************************************************************
* Function: msnl_ObjFocus()
* Inputs:   msnl_sField	= The form field to set focus on
* Usage:    Used to set the focus on the provided form field upon
*           completing the writing of the page.
************************************************************************/
/************************************************************************
* Function: msnl_ObjFocus()
* Inputs:   msnl_sField	= The form field to set focus on
* Usage:    Used to set the focus on the provided form field upon
*           completing the writing of the page.
************************************************************************/
?>
<script type="text/javascript">
<!-- Javascript functions for HTML Newsletter Admin tools
function msnl_FormHandler(msnl_sOP) {
	document.msnl_frm.op.value = msnl_sOP;
	document.msnl_frm.submit();
}
function msnl_ObjHandler(msnl_sOP, msnl_sVAR, msnl_iID) {
	eval("document.msnl_frm." + msnl_sVAR + ".value = msnl_iID");
	msnl_FormHandler(msnl_sOP);
}
function msnl_ObjFocus(msnl_sField) {
	eval("document.msnl_frm." + msnl_sField + ".focus()");
}
function msnl_ObjVisibility(objName, sAction) {
	if (sAction == "toggle") {
		sCurrentStatus = document.getElementById(objName).style.visibility;
		if (sCurrentStatus == "visible") {
			document.getElementById(objName).style.visibility = "hidden";
			document.getElementById(objName).style.display = "none";
		} else {
			document.getElementById(objName).style.visibility = "visible";
			document.getElementById(objName).style.display = "inline";
		}
	} else if (sAction == "hide") {
			document.getElementById(objName).style.visibility = "hidden";
			document.getElementById(objName).style.display = "none";
	} else { // "Show"
		document.getElementById(objName).style.visibility = "visible";
		document.getElementById(objName).style.display = "inline";
	}
}
//-->
</script>

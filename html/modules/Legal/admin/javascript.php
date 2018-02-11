<?php

/**
 * RavenNuke(tm) Legal Module
 *
 * The Legal module from DaDaNuke was re-written to allow for additional documents
 * to be added as well as different translations for each document (i.e., multilingual).
 * Original module copyrights are still retained below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/**
 * Function descriptions:
 *
 * lgl_submitFrm - Handles this case where can have different button objects
 *     needed to submit different *nuke form ops.
 *
 * lgl_objFocus - Helper function for setting the default field focus on
 *     the page form.
 */
?>
<script type="text/javascript">
<!-- Javascript functions for Admin tools
function lgl_submitFrm(s) {
	document.lgl_frm.op.value = s;
	document.lgl_frm.submit();
}
function lgl_objFocus(s) {
	eval("document.lgl_frm." + s + ".focus()");
}
//-->
</script>

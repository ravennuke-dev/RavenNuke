<?php
/*
 * nukeSPAM(tm)
 *
 * Copyright (c) 2012, Kevin Guske  http://nukeSEO.com
 *
 * This program is free software. You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the license.
 */
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../../index.php');
	exit('Access Denied');
}
if (!isset($file)) $file='';
if (($name == 'nukeSPAM' and $file != 'log') or $op == 'nukeSPAMWL' or $op =='nukeSPAM' or $op =='nukeSPAMConfig' or $op =='nukeSPAMSaveConfig') {
	$sfile = 'includes/jquery/jquery.cookie.js';
	$dtHTML_WL = '
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() { 
	$("#nukeSPAMWL").dataTable( {
		"processing": true,
		"serverSide": true,
		"bJQueryUI": true,
		"pagingType": "full_numbers",
		"ajaxSource": "rnxhr.php?name=nukeSPAM&file=log&src=WL",
		"language": {
			' . _DATATABLES . '
		},
		colReorder: true,
		dom: \'lBfrtip\',
		buttons: [
			\'copy\', \'excel\',
			{
				extend: \'print\',
				autoPrint: false
			},
			{
				extend: \'colvis\',
				postfixButtons: [ \'colvisRestore\' ],
			},
		],
		columnDefs: [
			{
				targets: -1,
				visible: false
			}
		],
	} ).makeEditable({
		sUpdateURL: "rnxhr.php?name=nukeSPAM&file=updWL",
		sAddHttpMethod: "POST",
		sAddURL: "rnxhr.php?name=nukeSPAM&file=addWL",
		sDeleteHttpMethod: "POST",
		sDeleteURL: "rnxhr.php?name=nukeSPAM&file=delWL",
		"aoColumns": [
			{
				indicator: \'Saving WL Type...\',
				tooltip: \'Click to select WL Type\',
				loadtext: \'loading...\',
				type: \'select\',
				onblur: \'submit\',
				data: "{\'\':\'Please select...\', \'u\':\'Username\',\'e\':\'Email\',\'i\':\'IP Address\'}",
				cssclass: "required"
			},
			{
				indicator: \'Saving WL Value...\',
				tooltip: \'Click to edit WL Value\',
				submit:\'Save\',
				cssclass: "required"
			}
		],
		oAddNewRowButtonOptions: {	
			label: "Add...",
			icons: {primary:\'ui-icon-plus\'}
		},
		oDeleteRowButtonOptions: {	
			label: "Remove",
			icons: {primary:\'ui-icon-trash\'}
		},
		oAddNewRowFormOptions: {
			title: \'Add a New Whitelist Entry\',
			show: "blind",
			hide: "explode",
			modal: true
		}	,
		sAddDeleteToolbarSelector: ".dataTables_length"
	}); 
} );
//]]>
</script>
		';
	$dtHTML_Log = '
<script type="text/javascript">
$(document).ready(function() { 
	$("#nukeSPAMLog").dataTable( {
		"processing": true,
		"serverSide": true,
		bJQueryUI: true,
		"pagingType": "full_numbers",
		"ajaxSource": "rnxhr.php?name=nukeSPAM&file=log",
		"order": [[0,"desc"]],
		"language": {
		' . _DATATABLES . '
		},
		colReorder: true,
		dom: \'lBfrtip\',
		buttons: [
			\'copy\', \'excel\', \'csv\',
			{
				extend: \'print\',
				autoPrint: false
			},
			{
				extend: \'colvis\',
				postfixButtons: [ \'colvisRestore\' ],
			},
		],
		columnDefs: [
			{
				targets: -1,
				visible: false
			}
		],
	} );
} ); 
</script>
	';
	global $headJS, $headCSS;
	if (is_array($headJS) and function_exists('addJSToHead')) {
		if ($op =='nukeSPAM' or $op =='nukeSPAMConfig' or $op =='nukeSPAMSaveConfig') {
			$seo_config = seoGetConfigs('nukeSPAM');
			if (!isset($seo_config['theme']) or $seo_config['theme']== '') $seo_config['theme'] = 'smoothness';
			addCSSToHead('includes/jquery/css/' . $seo_config['theme'] . '/jquery-ui.css', 'file');
			addCSSToHead('includes/jquery/nukeSPAM/css/nukeSPAM.css', 'file');
			addJSToHead('includes/jquery/jquery.js', 'file');
			addJSToHead('includes/jquery/jquery-ui.min.js', 'file');
			addJSToHead($sfile, 'file');
		}
		if ($op =='nukeSPAMWL') {
			$seo_config = seoGetConfigs('nukeSPAM');
			if (!isset($seo_config['theme']) or $seo_config['theme']== '') $seo_config['theme'] = 'smoothness';
			addCSSToHead('includes/jquery/css/' . $seo_config['theme'] . '/jquery-ui.css', 'file');
			addCSSToHead('includes/jquery/DataTables/datatables.min.css', 'file');
			addCSSToHead('includes/jquery/nukeSPAM/css/formAddNewRow.css', 'file');
			addCSSToHead('includes/jquery/nukeSPAM/css/nukeSPAM.css', 'file');
			addJSToHead('includes/jquery/jquery.js', 'file');
			addJSToHead('includes/jquery/jquery-ui.min.js', 'file');
			addJSToHead('includes/jquery/DataTables/datatables.min.js', 'file');
			addJSToHead('includes/jquery/nukeSPAM/jquery.jeditable.mini.js', 'file');
			addJSToHead('includes/jquery/nukeSPAM/jquery.dataTables.editable.js', 'file');
			addJSToHead('includes/jquery/jquery.validate.min.js', 'file');
			addJSToHead($dtHTML_WL, 'inline');
		}
		if ($name =='nukeSPAM' and $file <> 'log') {
			$seo_config = seoGetConfigs('nukeSPAM');
			if (!isset($seo_config['theme']) or $seo_config['theme']== '') $seo_config['theme'] = 'smoothness';
			addCSSToHead('includes/jquery/css/' . $seo_config['theme'] . '/jquery-ui.css', 'file');
			addCSSToHead('includes/jquery/DataTables/datatables.min.css', 'file');
			addCSSToHead('includes/jquery/nukeSPAM/css/nukeSPAM.css', 'file');
			addJSToHead('includes/jquery/jquery.js', 'file');
			addJSToHead('includes/jquery/jquery-ui.min.js', 'file');
			addJSToHead('includes/jquery/DataTables/datatables.min.js', 'file');
			addJSToHead($dtHTML_Log, 'inline');
		}
	}
	else {
		if ($op =='nukeSPAM' or $op =='nukeSPAMConfig' or $op =='nukeSPAMSaveConfig') {
			$seo_config = seoGetConfigs('nukeSPAM');
			if (!isset($seo_config['theme']) or $seo_config['theme']== '') $seo_config['theme'] = 'smoothness';
			addCSSToHead('includes/jquery/css/' . $seo_config['theme'] . '/jquery-ui.css', 'file');
			addJSToHead('includes/jquery/jquery.js', 'file');
			addJSToHead('includes/jquery/jquery-ui.min.js', 'file');
			addJSToHead($sfile, 'file');
		}
		if ($op =='nukeSPAMWL') {
			$seo_config = seoGetConfigs('nukeSPAM');
			if (!isset($seo_config['theme']) or $seo_config['theme']== '') $seo_config['theme'] = 'smoothness';
			addCSSToHead('includes/jquery/css/' . $seo_config['theme'] . '/jquery-ui.css', 'file');
			addCSSToHead('includes/jquery/DataTables/datatables.min.css', 'file');
			addCSSToHead('includes/jquery/nukeSPAM/css/nukeSPAM.css', 'file');
			addJSToHead('includes/jquery/jquery.js', 'file');
			addJSToHead('includes/jquery/jquery-ui.min.js', 'file');
			addJSToHead('includes/jquery/DataTables/datatables.min.js', 'file');
			addJSToHead('includes/jquery/jquery.validate.min.js', 'file');
			addJSToHead($sfile, 'file');
			addJSToHead($dtHTML_WL, 'file');
		}
		if ($name =='nukeSPAM' and $file <> 'log') {
			$seo_config = seoGetConfigs('nukeSPAM');
			if (!isset($seo_config['theme']) or $seo_config['theme']== '') $seo_config['theme'] = 'smoothness';
			addCSSToHead('includes/jquery/css/' . $seo_config['theme'] . '/jquery-ui.css', 'file');
			addCSSToHead('includes/jquery/DataTables/datatables.min.css', 'file');
			addCSSToHead('includes/jquery/nukeSPAM/css/nukeSPAM.css', 'file');
			addJSToHead('includes/jquery/jquery.js', 'file');
			addJSToHead('includes/jquery/jquery-ui.min.js', 'file');
			addJSToHead('includes/jquery/DataTables/datatables.min.js', 'file');
			addJSToHead($dtHTML_Log, 'file');
		}
	}
}
?>
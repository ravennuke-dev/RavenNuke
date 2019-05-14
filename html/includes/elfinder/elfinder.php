<?php
/**
* @category RavenNuke 3.0
* @package Core
* @subpackage elFinder
* @version $Id$
* @copyright (c) 2012 Raven Web Services, LLC
* @link http://www.ravennuke.com
* @license http://www.gnu.org/licenses/gpl.html GNU/GPL 3
*/

$module = !empty($_GET['module']) ? $_GET['module'] : 'ckeditor';
$module = 'ckeditor';
$dir = 'php/modules';
$dirHandler = opendir($dir);
$plugins = array();
while ($file = readdir($dirHandler)) {
	if ($file != '.' && $file != '..') {
		$plugins[] = $file;
	}
}
closedir($dirHandler);

if (!in_array($module . '.php', $plugins)) die('ERROR: The ' . htmlspecialchars($module, ENT_QUOTES) . ' module was not found!');
?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>File Manager</title>

	<link rel="stylesheet" href="../jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" title="no title" />
	<script src="../jquery/jquery.js" type="text/javascript"></script>
	<script src="../jquery/jquery-ui.min.js" type="text/javascript"></script>

	<link rel="stylesheet" href="css/elfinder.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/theme.css" type="text/css" media="screen" />

	<script src="js/elfinder.min.js" type="text/javascript"></script>

	<style type="text/css">
		body { font-family:arial, verdana, sans-serif;}
		.button {
			width: 100px;
			position:relative;
			display: -moz-inline-stack;
			display: inline-block;
			vertical-align: top;
			zoom: 1;
			*display: inline;
			margin:0 3px 3px 0;
			padding:1px 0;
			text-align:center;
			border:1px solid #ccc;
			background-color:#eee;
			margin:1em .5em;
			padding:.3em .7em;
			border-radius:5px;
			-moz-border-radius:5px;
			-webkit-border-radius:5px;
			cursor:pointer;
		}
	</style>

	<script type="text/javascript" charset="utf-8">
		$().ready(function() {

			var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
			var langCode = window.location.search.replace(/^.*langCode=([a-z]{2}).*$/, "$1");

			$('#finder').elfinder({
				url : 'php/modules/<?PHP echo $_GET['module']; ?>.php',
				lang : langCode,
				getFileCallback : function(url) {
					url = url.url.replace('../../', '');
					window.opener.CKEDITOR.tools.callFunction(funcNum, url);
					window.close();
				},
				uiOptions : {
					toolbar : [
						['back', 'forward'],
						['reload'],
						['home', 'up'],
						['mkdir', 'mkfile', 'upload'],
						['open', 'download', 'getfile'],
						['info'],
						['quicklook'],
						['copy', 'cut', 'paste'],
						['rm'],
						['duplicate', 'rename', 'edit', 'resize'],
						['search'],
						['view', 'sort'],
						['help']
					]
				},
				contextmenu : {
					files : ['getfile', '|','open', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'edit', 'rename', 'resize', 'info']
				},
				commands : ['open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 'download', 'rm', 'duplicate', 'rename', 'mkdir', 'mkfile', 'upload', 'copy', 'cut', 'paste', 'edit', 'search', 'info', 'view', 'help', 'resize', 'sort'],
			})
		})
	</script>

</head>
<body>
	<div id="finder">finder <span>here</span></div>
</body>
</html>
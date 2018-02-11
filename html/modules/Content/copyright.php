<?php
/*      Content Plus for RavenNuke(tm): /copyright.php
 *      Copyright 2004 - 2009 Jonathan Estrella <jestrella04@gmail.com>
 * 		Join me at http://slaytanic.sourceforge.net
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

$module_name = basename(dirname(__FILE__));
$mod_name = 'Content Plus';
$author_email = 'jestrella04 (at) gmail (dot) com';
$author_homepage = 'http://slaytanic.sourceforge.net';
$author_name = '<a href="'.$author_homepage.'" target="new">Jonathan Estrella</a>';
$license = 'GNU/GPL';
$download_location = 'http://slaytanic.sourceforge.net/modules.php?name=Downloads&amp;op=getit&amp;lid=1';
$module_version = '2.2.2';
$release_date = '';
$module_description = 'Revamped Content Module';
$mod_cost = '';
if (empty($mod_name)) { $mod_name = str_replace('_', ' ', $module_name); }

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.PHP_EOL;
echo '<html xmlns="http://www.w3.org/1999/xhtml">'.PHP_EOL;
echo '<head>'.PHP_EOL;
echo '<title>'.$mod_name.': Copyright Information</title>'.PHP_EOL;
echo '<style type="text/css">'.PHP_EOL;
echo '	body{ margin: 0.5em; padding: 0; font: 70%/1.5 Verdana, Tahoma, Arial, Helvetica, sans-serif; }'.PHP_EOL;
echo '</style>'.PHP_EOL;
echo '</head>'.PHP_EOL;
$bullet = '<img src="images/icons/accepted_48.png" alt="-" border="0" width="16" style="vertical-align: middle; margin-right: 0.3em;" />';
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">'.PHP_EOL;
echo '<div style="text-align:center;"><span class="thick">Module Copyright &copy; Information</span><br />'.PHP_EOL;
echo $mod_name.' module for PHP-Nuke &amp; Derivatives</div><hr />'.PHP_EOL;
echo $bullet.'<span class="thick">Module\'s Name:</span> '.$mod_name.'<br />'.PHP_EOL;
if (!empty($module_version)) { echo $bullet.'<span class="thick">Module\'s Version:</span> '.$module_version.'<br />'.PHP_EOL; }
if (!empty($release_date)) { echo $bullet.'<span class="thick">Release Date:</span> '.$release_date.'<br />'.PHP_EOL; }
if (!empty($mod_cost)) { echo $bullet.'<span class="thick">Module\'s Cost:</span> '.$mod_cost.'<br />'.PHP_EOL; }
if (!empty($license)) { echo $bullet.'<span class="thick">License:</span> '.$license.'<br />'.PHP_EOL; }
if (!empty($author_name)) { echo $bullet.'<span class="thick">Author\'s Name:</span> '.$author_name.'<br />'.PHP_EOL; }
if (!empty($author_email)) { echo $bullet.'<span class="thick">Author\'s Email:</span> '.$author_email.'<br />'.PHP_EOL; }
if (!empty($module_description)) { echo $bullet.'<span class="thick">Module\'s Description:</span> '.$module_description.'<br />'.PHP_EOL; }
if (!empty($download_location)) { echo $bullet.'<span class="thick">Module\'s Download:</span> <a href="'.$download_location.'" target="new">Download</a><br />'.PHP_EOL; }
echo '<hr />'.PHP_EOL;
echo '<div style="text-align:center;">[ <a href="#" onclick="javascript:self.close()">Close Window</a> ]</div>'.PHP_EOL;
echo '</body>'.PHP_EOL;
echo '</html>'.PHP_EOL;
?>
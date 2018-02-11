<?php
/*      Content Plus for RavenNuke(tm): /admin/links.php
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

global $admin_file;
if (!defined('ADMIN_FILE')) { die ('Access Denied'); }
adminmenu($admin_file.'.php?op=ContentPlus', _CONTENT, 'content.png');
?>
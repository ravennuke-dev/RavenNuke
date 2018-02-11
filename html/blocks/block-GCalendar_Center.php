<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// block-GCalendar.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
// Calendar Block for GCalendar. Shows a mini-calendar for the month
// and a list of upcoming events.
///////////////////////////////////////////////////////////////////////

if (!defined('BLOCK_FILE'))
{
   Header('Location: ../index.php');
   die();
}

///////////////////////////////////////////////////////////////////////
// block configuration:

$modName = 'GCalendar';       // must match directory name under modules

$blockConfig =
   array('maxTitle'     => 45,               // maximum length of title for block (includes ...)
         'eventPrefix'  => '&bull;&nbsp;',   // This gets prefixed onto events, customize as you wish
         'maxEvents'    => 9,                // maximum # of events listed in block
         'lookahead'    => 2,                // how many months (including current one) to look for events
         'twoColumn'    => true,             // true for 2 column event display (date - title) or false for date and
                                             // title on separate lines
          // an array of category numbers to exclude from the block;
          // see the GCalendar admin panel / categories to get the numbers:
         'excludeCats'  => array(),
         'force_center' => false,            // force the block to be centered
        );

define('GCAL_CAL_RIGHT', true);     // true to display the calendar on the right; false => left

///////////////////////////////////////////////////////////////////////

require_once 'modules/' . $modName . '/language.php';
gcalGetLang($modName);
require_once 'modules/' . $modName . '/gcal.inc.php';
require_once 'modules/' . $modName . '/common.inc.php';
require_once 'modules/' . $modName . '/getMonthlyEvents.php';
require_once 'modules/' . $modName . '/gcalBlock.php';

///////////////////////////////////////////////////////////////////////

$config = getConfig();
list($year, $month, $today) = explode(',', date('Y,n,j'));
$block = new GCalBlock($year, $month, $today, $config, $blockConfig);

if (GCAL_CAL_RIGHT)
{
   $right = $block->calendar();
   $left  = $block->upcomingEvents();
}
else
{
   $right = $block->upcomingEvents();
   $left  = $block->calendar();
}

$content =<<<END_CONTENT
<div class="text-center">
<table class="centered" border="0" cellpadding="10" cellspacing="0">
<tr><td>$right</td><td valign="middle">$left</td></tr>
</table>
</div>
END_CONTENT;

?>
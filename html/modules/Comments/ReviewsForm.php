<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// ReviewsForm.php - This file is part of Comments
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
//
// ReviewsForm.php is the PHP4 class that displays comments for the
// Reviews module.
//
///////////////////////////////////////////////////////////////////////

class RNComm_ReviewsForm extends RNComm_FormBase
{
   function __construct($selModule, $modules)
   {
      parent::__construct($selModule, $modules);
   }

   // Note that there is no function in the Reviews module to display an individual comment,
   // so we'll just have to display them all. Luckily the Reviews module seems to display the
   // newest comments first.

   function _getItems($n, $user)
   {
      global $prefix, $db, $anonymous;
      $n = intval($n);

      $sql = 'SELECT c.cid, c.rid, c.userid, c.date, r.title FROM ' .
         $prefix . '_reviews_comments AS c, ' .
         $prefix . '_reviews AS r ' .
         'WHERE c.rid = r.id ';

      if (!empty($user))
      {
         $sql .= 'AND c.userid LIKE \'' . $user . '\' ';
      }

      $sql .= 'ORDER BY c.date DESC LIMIT 0,' . $n;

      $result = $db->sql_query($sql);
      $items = array();
      $title = 'View this comment';
      $img = '<img src="images/view.gif" alt="' . $title . '" title="' . $title . '" border="0" />';
      while ($row = $db->sql_fetchrow($result))
      {
         $name = trim($row['userid']);
         $name = empty($name) ? $anonymous : $name;
         $cid = intval($row['cid']);
         $rid = intval($row['rid']);
         $date = formatTimestamp(strtotime($row['date']));
         $title = $row['title'];
         $items[$cid] = $this->_reviewLink($rid, $title) . ' &bull; ' .
            $this->_userLink($name) . ' &bull; ' . $date;
      }
      return $items;
   }

   function _processDelete($del)
   {
      global $prefix, $db;
      $sql = 'DELETE FROM '. $prefix . '_reviews_comments WHERE `cid` IN (' . implode(', ', $del) . ')';
      $db->sql_query($sql);
   }

   function _reviewLink($rid, $title)
   {
      return '<a href="modules.php?name=Reviews&amp;rop=showcontent&amp;id=' . $rid .
         '" title="' . _RNC_VIEW_REVIEW . '">' . $title . '</a>';
   }

}

?>

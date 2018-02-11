<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// NewsForm.php - This file is part of Comments
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
// NewsForm.php is the PHP4 class that displays comments for the
// News module.
//
///////////////////////////////////////////////////////////////////////

class RNComm_NewsForm extends RNComm_FormBase
{
   function __construct($selModule, $modules)
   {
      parent::__construct($selModule, $modules);
   }

   function _getItems($n, $user)
   {
      global $prefix, $db, $anonymous;

      $n = intval($n);
      $sql = 'SELECT `name`,`tid`, `sid`,`date`,`subject` FROM ' . $prefix .
         '_comments ';
      if (!empty($user))
      {
         if (strtolower($user) == strtolower($anonymous))
         {
            $sql .= 'WHERE `name` = \'\' ';
         }
         else
         {
            $sql .= 'WHERE `name` LIKE \'' . $user . '\' ';
         }
      }
      $sql .= 'ORDER BY `date` DESC LIMIT 0,' . $n;

      $result = $db->sql_query($sql);
      $items = array();
      $img = '<img src="images/view.gif" alt="' . _RNC_VIEW_COMMENT . '" title="' . _RNC_VIEW_COMMENT .
         '" border="0" />';
      while ($row = $db->sql_fetchrow($result))
      {
         $name = trim($row['name']);
         $name = empty($name) ? $anonymous : $name;
         $tid = intval($row['tid']);
         $sid = intval($row['sid']);
         $date = formatTimestamp(strtotime($row['date']));
         $subject = $row['subject'];
         $items[$tid] = $this->_commentLink($sid, $tid, $img) . ' ' .
            $this->_userLink($name) .
            ' &bull; ' . $this->_articleLink($sid, $subject) . ' &bull; ' . $date;
      }
      return $items;
   }

   function _processDelete($del)
   {
      global $prefix, $db;
      $commTable = $prefix . '_comments';

      // Nuke unfortunately maintains a separate comment count in the story table for each story instead of just
      // relying on the rows in the comments table. Now we have to determine which stories will need their comment
      // counts adjusted.

      $sql = 'SELECT `sid` FROM ' . $commTable . ' WHERE `tid` IN (' . implode(', ', $del) . ') GROUP BY `sid`';
      $result = $db->sql_query($sql);
      $stories = array();
      while ($row = $db->sql_fetchrow($result))
      {
         $stories[] = intval($row['sid']);
      }

      // News comments have a hierarchy. If you delete a parent comment, all children are also deleted. Obtain
      // a list of comment ID's to delete by finding a set of children for each comment
      $comments = array();
      foreach ($del as $id)
      {
         $comments = array_merge($comments, $this->_findChildren($id));
      }
      $comments = array_unique($comments);

      // delete all comments

      $sql = 'DELETE FROM ' . $commTable . ' WHERE `tid` IN (' . implode(', ', $comments) . ')';
      $db->sql_query($sql);

      // adjust comment counts for each story

      foreach ($stories as $story)
      {
         $this->_updateCommentCount($story);
      }
   }

   function _findChildren($tid)
   {
      global $prefix, $db;
      $ret = array($tid);  // return value

      $sql = 'SELECT `tid` FROM ' . $prefix . '_comments WHERE `pid` = \'' . $tid . '\'';
      $result = $db->sql_query($sql);
      if ($db->sql_numrows($result) <= 0)
      {
         return $ret;   // no children
      }
      $children = array();
      while ($row = $db->sql_fetchrow($result))
      {
         $children[] = intval($row['tid']);
      }

      foreach ($children as $child)
      {
         $ret = array_merge($ret, $this->_findChildren($child));
      }
      return $ret;
   }

   function _updateCommentCount($story)
   {
      global $prefix, $db;

      $sql = 'SELECT * FROM ' . $prefix . '_comments WHERE `sid` = \'' . $story . '\'';
      $result = $db->sql_query($sql);
      $row = $db->sql_fetchrow($result);
      $newCount = intval($row[0]);
      $sql = 'UPDATE ' . $prefix . '_stories SET comments = \'' . $newCount . '\' WHERE sid = \'' . $story . '\'';
      $db->sql_query($sql);
   }

   // private static function to make a link to a comment from a given story ID and title
   function _commentLink($sid, $tid, $title)
   {
      return '<a href="modules.php?name=News&amp;file=comments&amp;sid=' . $sid .
         '&amp;tid=' . $tid . '">' .
         $title . '</a>';
   }

   // private static function to make a News article link from a given story ID and title
   function _articleLink($sid, $title)
   {
      return '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '" title="' . _RNC_VIEW_STORY . '">' .
         $title . '</a>';
   }

}

?>

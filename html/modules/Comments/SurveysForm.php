<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// SurveysForm.php - This file is part of Comments
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
// SurveysForm.php is the PHP4 class that displays comments for the
// Surveys module.
//
///////////////////////////////////////////////////////////////////////

class RNComm_SurveysForm extends RNComm_FormBase
{
   function __construct($selModule, $modules)
   {
      parent::__construct($selModule, $modules);
   }

   function _getItems($n, $user)
   {
      global $prefix, $db, $anonymous;
      $n = intval($n);

      $sql = 'SELECT `tid`, `pollID`, `date`, `name`, `subject` FROM ' .
         $prefix . '_pollcomments ';

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
         $pollId = intval($row['pollID']);
         $date = formatTimestamp(strtotime($row['date']));
         $subject = $row['subject'];
         $items[$tid] = $this->_commentLink($pollId, $tid, $img) . ' ' .
            $this->_userLink($name) .
            ' &bull; ' . $this->_surveyLink($pollId, $subject) . ' &bull; ' . $date;
      }
      return $items;
   }

   function _processDelete($del)
   {
      global $prefix, $db;
      $pollTable = $prefix . '_pollcomments';

      // Survey comments have a hierarchy. If you delete a parent comment, all children are also deleted. Obtain
      // a list of comment ID's to delete by finding a set of children for each comment
      $comments = array();
      foreach ($del as $id)
      {
         $comments = array_merge($comments, $this->_findChildren($id));
      }
      $comments = array_unique($comments);

      // delete all comments

      $sql = 'DELETE FROM ' . $pollTable . ' WHERE `tid` IN (' . implode(', ', $comments) . ')';
      $db->sql_query($sql);
   }

   function _findChildren($tid)
   {
      global $prefix, $db;
      $ret = array($tid);  // return value

      $sql = 'SELECT `tid` FROM ' . $prefix . '_pollcomments WHERE `pid` = \'' . $tid . '\'';
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

   // private static function to display a link to a given survey comment
   function _commentLink($pollId, $tid, $title)
   {
      return '<a href="modules.php?name=Surveys&amp;file=comments' .
         '&amp;pollID=' . $pollId .
         '&amp;tid=' . $tid .
         '">' . $title . '</a>';
   }

   // private static function to display a link to a given survey
   function _surveyLink($pollId, $title)
   {
      return '<a href="modules.php?name=Surveys&amp;op=results&amp;pollID=' . $pollId
         . '" title="' . _RNC_VIEW_SURVEY . '">' . $title . '</a>';
   }

}

?>

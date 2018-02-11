<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// ForumsForm.php - This file is part of Comments
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
// ForumsForm.php is the PHP4 class that displays comments for the
// Forums module.
//
///////////////////////////////////////////////////////////////////////

define('IN_PHPBB', true);     // to fake out functions_post.php
include_once 'modules/Forums/includes/functions_post.php';


class RNComm_ForumsForm extends RNComm_FormBase
{
   function __construct($selModule, $modules)
   {
      parent::__construct($selModule, $modules);
   }

   function _getItems($n, $user)
   {
      global $prefix, $db, $anonymous, $user_prefix;
      $n = intval($n);

      $sql = 'SELECT t.topic_title, p.post_time, p.post_id, u.username ' .
        "FROM {$prefix}_bbtopics AS t, {$prefix}_bbforums AS f, {$prefix}_bbposts AS p, {$user_prefix}_users as u " .
        'WHERE t.forum_id = f.forum_id AND f.auth_view = 0 AND p.topic_id = t.topic_id AND p.poster_id = u.user_id ';

      if (!empty($user))
      {
         $sql .= 'AND u.username LIKE \'' . $user . '\' ';
      }
      $sql .= 'ORDER BY p.post_time DESC LIMIT 0, ' . $n;

      $items = array();
      $result = $db->sql_query($sql);
      while ($row = $db->sql_fetchrow($result))
      {
         $title   = $row['topic_title'];
         $time    = formatTimestamp(intval($row['post_time']));
         $pid     = intval($row['post_id']);
         $uname   = trim($row['username']);
         $uname   = empty($uname) ? $anonymous : $uname;

         $items[$pid] = $this->_postLink($pid, $title) . ' &bull; ' .
            $this->_userLink($uname) . ' &bull; ' . $time;
      }
      return $items;
   }

   // private static function to generate a link to a given post with a given title
   function _postLink($pid, $title)
   {
      return '<a href="modules.php?name=Forums&amp;file=viewtopic&amp;p=' .
         $pid . '#' . $pid . '" title="' . _RNC_VIEW_POST . '">' . $title . '</a>';
   }

}

?>

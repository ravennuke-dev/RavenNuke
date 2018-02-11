<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// HtmlList.php - This file is part of Comments
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
// PHP 4 class for working with HTML lists (ordered and unordered).
// IMHO this class should be in the includes directory for all modules to use. :-)
//
///////////////////////////////////////////////////////////////////////

class RNComm_HtmlList
{
   var $items = array();
   var $ordered;

   function __construct($items = array(), $ordered = false)
   {
      if (is_array($items))
      {
         $this->items = $items;
      }
      else
      {
         $this->items[0] = $item;
      }
      $this->ordered = (bool) $ordered;
   }

   function add($item)
   {
      $this->items[] = $item;
   }

   function display()
   {
      echo $this->html();
   }

   function html()
   {
      $s = $this->ordered ? '<ol>' : '<ul>';

      foreach($this->items as $item)
      {
         $s .= '<li>' . $item . '</li>';
      }

      $s .= $this->ordered ? '</ol>' : '</ul>';
      return $s;
   }
}
?>

<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// Combo.php - This file is part of Comments
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
// PHP 4 class for working with SELECT HTML form elements (aka
// "combo boxes"). Code reused from GCalendar. IMHO this class should
// be in the includes directory for all modules to use. :-)
//
///////////////////////////////////////////////////////////////////////

class RNComm_Combo
{
   var $items;
   var $selKey;
   var $enabled = true;
   var $onChange = '';
   var $attrs = array();
   var $titles = array();

   function __construct($name, $items, $selKey = '')
   {
      $this->attrs['name'] = $name;
      $this->attrs['id']   = preg_replace('/^(\w+)\[\d*\]$/', '$1', $name);
      $this->items         = $items;

      if ($selKey != '')
      {
         $this->selKey = $selKey;
      }
      else  // pick first key in items array
      {
         $this->selKey = count($this->items) > 0 ? key($this->items) : '';
      }
   }

   function select($key)
   {
      $this->selKey = $key;
   }

   function enable($to = true)
   {
      $this->enabled = $to;
   }

   function setOnChange($to)
   {
      $this->attrs['onchange'] = $to;
   }

   function size($to)
   {
      $this->attrs['size'] = intval($to);
   }

   function multiple()
   {
      $this->attrs['multiple'] = 'multiple';
   }

   function html()
   {
      $dis = $this->enabled ? '' : ' disabled="disabled"';
      $s = '<select' . $dis;

      foreach ($this->attrs as $attr => $value)
      {
         $s .= ' ' . $attr . '="' . $value . '"';
      }

      $s .= ">\n";

      foreach ($this->items as $key => $value)
      {
         $sel = $this->selKey == $key ? 'selected="selected"' : '';
         $title = isset($this->titles[$key]) ? ' title="' . $this->titles[$key] . '"' : '';

         $s .= "<option value=\"$key\" $sel$title>$value</option>\n";
      }
      $s .= '</select>' . "\n";
      return $s;
   }

   function display()
   {
      echo $this->html();
   }

   function setTitles($titles)
   {
      $this->titles = $titles;
   }
}
?>

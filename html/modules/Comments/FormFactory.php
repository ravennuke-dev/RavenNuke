<?php
///////////////////////////////////////////////////////////////////////
// Comments Module for PHP-Nuke 7.6+
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// Based on ideas and code from John Haywood (aka: Guardian) of Code-Authors.com
// Developed for use in RavenNuke http://www.ravenphpscripts.com/
//
// FormFactory.php - This file is part of Comments
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
// FormFactory.php is the PHP4 class that creates the comments form for
// the requested type of comments. It respects what comment producing
// modules are marked active.
//
///////////////////////////////////////////////////////////////////////

class RNComm_FormFactory
{
   var $modPath;              // path for this module
   var $modules = array();    // array of active modules to check comments for

   // constructor:
   function __construct($path)
   {
      $this->modPath = $path;
      $this->_getModules();
      if (count($this->modules) <= 0)
      {
         die(_RNC_MODULE_ERROR);
      }
      require_once $this->modPath . 'FormBase.php';
   }

   // Creates a form based upon user requested comment source. If that module is
   // not active or unknown, we just create the first one in our list...
   // Visibility: public
   function create($source)
   {
      $source = strtolower($source);
      if (array_key_exists($source, $this->modules))
      {
         $chosen = $source;
      }
      else
      {
         $chosen = key($this->modules);
      }
      $chosen = ucfirst($chosen);
      $filePath = $this->modPath . $chosen . 'Form.php';
      require_once $filePath;
      $className = 'RNComm_' . $chosen . 'Form';
      return new $className($source, $this->modules);
   }

   // Builds the array of module names that are activated and can produce comments;
   // possible values: array('surveys', 'reviews', 'news', 'forums') or any subset
   // thereof.
   // Visibility: private
   function _getModules()
   {
      global $db, $prefix;
      $sql = 'SELECT title, custom_title FROM ' . $prefix . '_modules WHERE active = 1 AND ' .
         '(title = \'Reviews\' OR title = \'News\' OR title = \'Forums\' OR title = \'Surveys\') ' .
         'ORDER BY custom_title ASC';
      $result = $db->sql_query($sql);
      $this->modules = array();
      while ($row = $db->sql_fetchrow($result))
      {
         $this->modules[strtolower($row['title'])] = $row['custom_title'];
      }
   }

}

?>

<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
  
if ( !function_exists('getServerTime') )
{
  function getServerTime()
  {
    // Calculate posting time offset for user defined timezones
    $serverTimeZone = date("Z")/3600;
    if ($serverTimeZone >= 0) $serverTimeZone = "+".$serverTimeZone;
    if (is_user($user)) {
      $userinfo     = getusrinfo($user);
      $userTimeZone = $userinfo['user_timezone'];
    }
    else
    {
      $sql  = "SELECT config_value FROM ".$user_prefix."_bbconfig WHERE config_name='board_timezone'";
      $result = $db->sql_query($sql);
      $rows = $db->sql_fetchrow($result);
      $userTimeZone = $rows['config_value'];
    }
    $userTimeZone = ($userTimeZone - $serverTimeZone)*3600;
    if (!is_numeric($userTimeZone)) $userTimeZone = 0;
  }
}

class seocontentclass 
{
  var $query;
  var $name;
  var $sql_table_with_prefix;
  var $sql_col_id;
  var $sql_col_title;
  var $sql_col_desc;
  var $sql_col_desc2;
  var $sql_col_time;
  var $sql_col_catid;
  var $sql_col_author;
  var $sql_where_cols;
  var $activeWhere;
  var $orderArray;
  var $orderSQLArray;
  var $levelArray;
  var $levelSQLArray;

  function tablesExist()
  {
    // Returns true if the tables for this module are installed
    // Assumes one table - override if necessary to test multiple
    // 1 = TRUE, 0 = FALSE
    global $db;
    $res = $db->sql_query('SELECT "1" FROM '.$this->sql_table_with_prefix);
    return ($res ? 1 : 0);
  }

  function useme()
  {
    // Returns true if this module is to be used in the current module
    global $db, $prefix, $module_name;
    if ($this->tablesExist() and is_active($this->name)){
      $res = $db->sql_fetchrow($db->sql_query('SELECT "1" FROM '.$prefix.'_seo_disabled_modules WHERE `title`="'.$this->name.'" and `seo_module`="'.$module_name.'"'));
      return ($res ? 0 : 1);
    }
    else
    {
      return 0;
    }
  }

  function doquery(){
    // Insert any results matching the users query into the main database
    global $prefix, $tblname, $db;
    $q = $this->query[0][1];
    foreach ($q as $query){
      $wheretext = '('.$this->sql_where_cols[0].' like \'%'.$query.'%\')';
      for ($i = 1,$x=count($this->sql_where_cols);$i<$x;$i++){
        $wheretext .= ' OR (`'.$this->sql_where_cols[$i].'` like \'%'.$query.'%\')';}
      $db->sql_query('INSERT INTO '.$tblname.' 
                     (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
                     SELECT CONCAT("'.$this->name.'", `'.$this->sql_col_id.'`) AS `id`, \'1\', 
                     '.($this->sql_col_time_unix ? '' : 
                     'UNIX_TIMESTAMP(`').$this->sql_col_time.($this->sql_col_time_unix ? '' : '`)').', 
                     `'.$this->sql_col_title.'`, `'.$this->sql_col_id.'`, `'.$this->sql_col_desc.'`,
                     `'.$this->sql_col_author.'`, "'.$this->name.'" FROM '.$this->sql_table_with_prefix.' 
                     WHERE ('.$wheretext.')');}}

  function addquery($type, $query){
    // Not sure why this is here :/
    $this->query[] = array($type, $query);}

  function getresults(){
    // Not sure why this is here either, but you probably shouldn't mess with these.
    global $db;
    return $this->doquery();}

  function options($var){
    // The html code to be used when a user clicks "More Options >"
    return $var.'[\''.$this->name.'\']=" '._MSWITHINLAST.' <select name=\"when\">\\
      <option value=\"0\">'._MSANYDATE.'</option>\\
      <option value=\"'.(time() - (3 * 24 * 60 * 60)).'\">'._MSTHREEDAYS.'</option>\\
      <option value=\"'.(time() - (7 * 24 * 60 * 60)).'\">'._MSONEWEEK.'</option>\\
      <option value=\"'.(time() - (7 * 4 * 24 * 60 * 60)).'\">'._MSONEMONTH.'</option>\\
      <option value=\"'.(time() - (6 * 7 * 4 * 24 * 60 * 60)).'\">'._MSSIXMONTHS.'</option>\\
      <option value=\"'.(time() - (12 * 7 * 4 * 24 * 60 * 60)).'\">'._MSONEYEAR.'</option>\\
      </select>"';}

  function buildquery(){
    // Not sure why this is here either, but it is
  }

  function getOrders($selText)
  {
    $this->orderArray = array('' =>$selText) + $this->orderArray; 
    return $this->orderArray;
  }

  function getOrderBy($order)
  {
    $orderBy = $this->orderSQLArray[$order];
    return $orderBy;
  }

  function getLevels($selText)
  {
    $this->levelArray = array('' =>$selText, 'module' => 'module') + $this->levelArray; 
    return $this->levelArray;
  }

  function getLevelWhere($level, $lid)
  {
    $levelWhere = '';
    if ($level != 'module')
    {
      $levelWhere = $this->levelSQLArray[$level].'='.$lid;
    }
    return $levelWhere;
  }

  function getItemFields()
  {
    // Retrieve item fields (sort id?, date, content id, title, hometext, bodytext, author, module)
    $itemFields = '';
    // content ID = cid
    $itemFields .= '`'.$this->sql_col_id.'` AS `cid`, ';
    // title
    $itemFields .= '`'.$this->sql_col_title.'` AS `title`, ';
    // hometext
    $itemFields .= '`'.$this->sql_col_desc.'` AS `hometext` ';
    // bodytext
    if ($this->sql_col_desc2 > '') $itemFields .= ', `'.$this->sql_col_desc2.'` AS `bodytext` ';
    // author
    if ($this->sql_col_author > '') $itemFields .= ', `'.$this->sql_col_author.'` AS `author` ';
    // time
    if ($this->sql_col_time > '') $itemFields .= ', `'.$this->sql_col_time.'` AS `time`';
    // category ID
    if ($this->sql_col_catid > '') $itemFields .= ', `'.$this->sql_col_catid.'` AS `catid`';
    return $itemFields;
  }

#  function getFrom($level, $lid)
  function getFrom()
  {
    $from = $this->sql_table_with_prefix;
    return $from;
  }

  function getWhere($level, $lid)
  {
    $where = '';
    if ($this->activeWhere > '') $where .= ' WHERE ' . $this->activeWhere;
    $levelWhere = $this->getLevelWhere($level, $lid);
    if ($levelWhere > '')
    {
      if ($where == '') 
      {
        $where .= ' WHERE '; 
      }
      else
      {
        $where .= ' AND ';
      }
      $where .= $levelWhere;
    }
    return $where;
  }

  function getItems($level = 'module', $lid = 0, $order = 'recent', $howmany = 10)
  {
    global $db, $prefix, $nukeurl;
    // Retrieve items (sort id?, date, content id, title, hometext, bodytext, author, module)
    $sql =  'SELECT '. $this->getItemFields() .
            ' FROM '. $this->getFrom() . 
            $this->getWhere($level, $lid) . 
            ' ORDER BY '. $this->getOrderBy($order) .
            ' LIMIT '. $howmany;
    $items = array();
#    die($sql);
    $result = $db->sql_query($sql);
    while($item = $db->sql_fetchrow($result)) 
    {
      $cid = $item['cid'];
      $items[$cid] = $item;
    }
    return $items;
  }

  function getLink($id, $catid)
  {
    // Used by the individual content classes to define how a link to an item should be built
  }
}

?>
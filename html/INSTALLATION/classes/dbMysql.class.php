<?php
class dbMysql {
/* First release is in RavenNuke(tm) v2.3
 * This code is NOT GPL
 * This class is a work in progress and will be changing.
 * There is sufficient code to work with the Ravenstaller(tm).
 * There is also code that may have not been tested and may not work.
 * Code is added as needed and as ideas strike.
 */
/*   var $dbhost;
   var $dbname;
   var $dbuser;
   var $dbpass;
   var $dbtype;
   var $link;
*/
//   function dbMysql($_dbhost='localhost', $_dbuser='', $_dbpass='', $_dbname='', $_dbtype='MySQL') {
   function dbMysql() {
      error_reporting( E_ALL );
      if (!defined('INCLUDE_PATH')) {
         define('INCLUDE_PATH','../'.'/');
      }
   
      if (file_exists(INCLUDE_PATH.'config.php')) {
         include_once(INCLUDE_PATH.'config.php');
         $this->dbhost        = $dbhost;
         $this->dbname        = $dbname;
         $this->dbuser        = $dbuname;
         $this->dbpass        = $dbpass;
         $this->dbtype        = $dbtype;
         $this->prefix        = $prefix;
         $this->user_prefix   = $user_prefix;
      }
      else {
         $_msg = 'Unable to locate config.php';
         $this->xhtmlMsgWrapper($_msg);
         die();
      }
   }

   function destroy() {
      settype(&$this, 'null');
   }

   function dbServerConnect() {
      $_link = @mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
      if (!$_link) {
         $_msg = 'MySQL Server Not Connected: ' . mysql_error();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->addDefaultXhtmlTemplate('foot');
         die();
      }
      $_msg = 'MySQL Server Connected';
      $this->link=$_link;
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbServerDisconnect($_link='') {
      if (empty($_link)) $_link=$this->link;
      $_result = @mysql_close($_link);
      if (!$_result) {
         $_msg = 'Link To Server Not Active' . mysql_error();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->addDefaultXhtmlTemplate('foot');
         die();
      }
      $_msg = ('Server Disconnect');
      $this->xhtmlMsgWrapper($_msg);
      if ($this->error) {$this->addDefaultXhtmlTemplate('foot');}
   }

   function dbSelectDb($_db='') {
      if (empty($_db)) $_db=$this->dbname;
      $this->error=false;
      $_result = @mysql_select_db($_db,$this->link);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Data Base '.$_db.' Not Found: ' . mysql_error();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $_msg = ('Data Base '.$_db.' Found');
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbQueryDelete($_tbl='raventest') {
      $_sql = 'DELETE FROM '.$this->prefix.'_'.$_tbl.' WHERE field1=\'testing2\'';
      $this->error=false;
      $_result = @mysql_query($_sql);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Unable to delete record from table '.$_tbl.': ' . mysql_error();
         $this->dbTableDropSelective();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $_msg = ('Successfully deleted record from table '.$_tbl);
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbQueryInsert($_tbl='raventest') {
      $_sql = 'INSERT INTO '.$this->prefix.'_'.$_tbl.' VALUES(NULL, \'testing\')';
      $this->error=false;
      $_result = @mysql_query($_sql);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Unable to insert record into table '.$_tbl.': ' . mysql_error();
         $this->dbTableDropSelective();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $_msg = ('Successfully inserted record into table '.$_tbl);
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbQuerySelect($_tbl='raventest') {
      $_sql = 'SELECT * FROM '.$this->prefix.'_'.$_tbl;
      $this->error=false;
      $_result = @mysql_query($_sql);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Unable to select record from table '.$_tbl.': ' . mysql_error();
         $this->dbTableDropSelective();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $_msg = ('Successfully selected record from table '.$_tbl);
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbQueryUpdate($_tbl='raventest') {
      $_sql = 'UPDATE '.$this->prefix.'_'.$_tbl
            . ' SET field1=\'testing2\'';
      $this->error=false;
      $_result = @mysql_query($_sql);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Unable to update record in table '.$_tbl.': ' . mysql_error();
         $this->dbTableDropSelective();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $_msg = ('Successfully updated record in table '.$_tbl);
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbTableCreate($_tbl='raventest') {
      $_sql = 'DROP TABLE IF EXISTS '.$this->prefix.'_'.$_tbl;
      $_result = @mysql_query($_sql);
      $_sql = 'CREATE TABLE '.$this->prefix.'_'.$_tbl.' (id INT NOT NULL AUTO_INCREMENT, field1 varchar(30) NOT NULL, primary key(id))';
      $this->error=false;
      $_result = @mysql_query($_sql);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Unable to create table '.$_tbl.': ' . mysql_error();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $this->table = $_tbl;
      $_msg = ('Successfully created table '.$_tbl);
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbTableDropSelective($_tbl='raventest') {
      $_sql = 'DROP TABLE '.$this->prefix.'_'.$_tbl.';';
      $_result = @mysql_query($_sql);
      if (!$_result) {
         $this->error=true;
         $_msg = 'Unable to drop table '.$_tbl.': ' . mysql_error();
         $this->xhtmlMsgWrapper($_msg,'error');
         $this->dbServerDisconnect();
         die();
      }
      $_msg = ('Successfully dropped table '.$_tbl);
      $this->xhtmlMsgWrapper($_msg);
   }

   function dbTableDropAll() {
   }

   function dbTableEmpty($_tbl) {
   }

   function dbTableTruncate($_tbl) {
   }

   function dbColumnAdd($_col) {
   }

   function dbColumnDrop($_col) {
   }

   function dbColumnAlter($_col) {
   }

   function addDefaultXhtmlTemplate($_hf) {
      $_msg='';
      if ($_hf=='head') {
         $_msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n"
         .'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n"
         .'<html xmlns="http://www.w3.org/1999/xhtml">'."\n"
         .'<head>'."\n"
         .'<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />'."\n"
         .'<link rel="StyleSheet" href="css/ravenstaller.css" type="text/css" />'."\n"
         .'<link rel="stylesheet" href="windowfiles/dhtmlwindow.css" type="text/css" />'."\n"
         .'<link rel="stylesheet" href="modalfiles/modal.css" type="text/css" />'."\n"
         .'<script type="text/javascript" src="js/ravenstaller.js"></script>'."\n"
         .'<title></title>'."\n"
         .'</head>'."\n"
         .'<body>'."\n";
      }
      else
      if ($_hf=='foot') {
         $_msg = '</body>'."\n"
         .'</html>'."\n";
      }
      echo $_msg;
   }

   function xhtmlMsgWrapper($_msg='No Message Defined',$_type='') {
      if ($_type=='error') {
         $divclass='mysql-error';
      }
      else {
         $divclass='mysql';
      }
      $_msg = '<br />'."\n".'<center><div class="'.$divclass.'">'."\n"
            . $_msg."\n"
            . '</div></center>'."\n";
      echo $_msg;
   }

}
?>

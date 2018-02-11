<?php
///////////////////////////////////////////////////////////////////////
// content_pagebreak_convert.php by Gremmie
// This script converts content with the old <!--pagebreak--> style
// pagebreaks into the newer [--pagebreak--] style.
//
// To use:
// 1) Upload this script to the root directory of your PHP-Nuke
// site (the same directory as index.php).
// 2) Log into your site as an admin.
// 3) Execute the script from your browser, e.g.
// http://www.mysite.com/content_pagebreak_convert.php
// 4) Delete this script from your server
//
///////////////////////////////////////////////////////////////////////

require_once('mainfile.php');
$module_name = basename(dirname(dirname(__FILE__)));

define('IN_CPM', TRUE);
require_once('modules/'.$module_name.'/var/cpfunc.php');
include('header.php');
OpenTable();

if(is_admin($admin)) {
   $sql = 'SELECT pid, text FROM ' . $prefix . '_pages';
   $result = $db->sql_query($sql);
   while ($row = $db->sql_fetchrow($result)) {
      $pid = intval($row['pid']);
      $text = stripslashes($row['text']);

      $text = str_replace(array('<!--pagebreak-->', '&lt;!--pagebreak--&gt;'),
                          '[--pagebreak--]',
                          $text);
      $text = real_escape_content($text);

      $sql = "UPDATE {$prefix}_pages SET text = '$text' WHERE pid = '$pid'";
      $result2 = $db->sql_query($sql);
      if ($result2 === false) {
         echo "Oops, problem updating row #$pid!<br />";
      }
   }
   echo '<div class="thick">Conversion complete<br /><br />'.PHP_EOL;
   echo 'Please delete this script from your server now.<br /><br />'.PHP_EOL;
} else {
   echo 'You must be admin to run this script</div><br /><br />'.PHP_EOL;
}

CloseTable();
include('footer.php');
?>
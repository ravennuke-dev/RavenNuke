<?php
   function mysqlTest($dbinfo) {
      global $coreTableCount;
      ini_set('mysql.connect_timeout',120);
      require_once($dbinfo);
      $desc = 'MySQL Server Connection';
      echo '<tr>';
      echo '<td class="item">' . $desc . '</td>';
      echo '<td align="left">';
      echo @mysql_connect($dbhost,$dbuname,$dbpass) ? '<span style="color:green; font-weight:bold;">Pass</span>' : '<span style="color:red; font-weight:bold;">Fail - ' . mysql_error() . '</span>' . '</td>';
      echo '</tr>';

      $desc = 'Database Connection';
      echo '<tr>';
      echo '<td class="item">' . $desc . '</td>';
      echo '<td align="left">';
      echo @mysql_select_db($dbname) ? '<span style="color:green; font-weight:bold;">Pass</span>' : '<span style="color:red; font-weight:bold;">Fail - ' . mysql_error() . '</span>' . '</td>';
      echo '</tr>';

      $desc = 'Database Core Table Count';
      echo '<tr>';
      echo '<td class="item">' . $desc . '</td>';
      echo '<td align="left">';
      $rc = @mysql_query('SHOW TABLES');
      $cnt = 0;
      while ($row = @mysql_fetch_row($rc)) { $cnt++; }
      echo $coreTableCount==$cnt ? '<span style="color:green; font-weight:bold;">Pass</span>' : '<span style="color:red; font-weight:bold;">Fail - Expecting ' . $coreTableCount . ' - Counted ' . $cnt . '</span>' . '</td>';
      echo '</tr>';
}
?>
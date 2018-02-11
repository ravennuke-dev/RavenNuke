<?php
function chkFileExists($desc, $file, $good='Pass', $bad='Fail') {
   echo '<tr>';
   echo '<td class="item">' . $desc . '</td>';
   echo '<td align="left">';
   echo file_exists($file) ? '<span style="font-weight:bold; color: green;">'.$good.'</span>' : '<span style="font-weight:bold; color: green;">'.$bad.'</span>' . '</td>';
   echo '</tr>';
}
?>

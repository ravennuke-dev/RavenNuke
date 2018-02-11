<?php
function chkFile($desc, $file, $chkFor='*') {
   if (empty($desc)) $desc = str_replace('../','',$file);
   $chkFor = strtolower($chkFor);
   $replaceChars = array();
   $replaceChars[] = ' ';
   $replaceChars[] = '_';
   $chkFor = str_replace($replaceChars,'',$chkFor);
   $chkFor = explode(',',$chkFor);
   $chkForCnt = count($chkFor);
   $cnt = 0;
   echo '<tr>'
   .'<td class="item">' . $desc . '</td>'
   .'<td align="left">';
   for ($i=0; $i<$chkForCnt; $i++) {
      if ($chkFor[$i]=='*'||$chkFor[$i]=='file_exist'||$chkFor[$i]=='file_exists'||$chkFor[$i]=='exist'||$chkFor[$i]=='exists') {
         echo file_exists($file) ? '<span style="font-weight:bold; color: green;">Found</span>' : '<span style="font-weight:bold; color: red;">Not Found</span>';
         $cnt++;
      }
      if ($chkFor[$i]=='*'||$chkFor[$i]=='iswriteable'||$chkFor[$i]=='iswritable'||$chkFor[$i]=='write') {
         if ($cnt>0) echo ' - ';
         echo is_writable($file) ? '<span style="font-weight:bold; color: green;">Writeable</span>' : '<span style="font-weight:bold; color: red;">Not Writeable</span>';
      }
   }
   echo '</td>'
   .'</tr>';
}
?>

<?php
function phpGetSetting($val) {
   $r =  (ini_get($val) == '1' ? 1 : 0);
   return $r ? 'ON' : 'OFF';
}
?>

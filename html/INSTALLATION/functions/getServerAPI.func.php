<?php
function getServerAPI() {
   // Returns true if CGI, false if not
   return substr(php_sapi_name(), 0, 3) == 'cgi' ? true : false;
}
?>

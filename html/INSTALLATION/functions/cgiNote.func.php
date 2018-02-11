<?php
function cgiNote() {
   global $cgiNote;
   if (empty($cgiNote)) return;
   if (getServerAPI()==true) {
      echo '<div class="far-left">'
      .'<span class="alert">CGI NOTE:</span>'
      .'<span class="color-red"> These files may actually be writeable since you are running PHP as a CGI executable.'
      .' You may be using suExec/phpSuExec which does not allow permissions greater than 644 on files.'
      .' You should verify that this is the reason that the files are not writeable to ensure proper installation.'
      .'</span>'
      .'</div>'
      .'<div class="clr">'
      .'</div>'
      ;
   }
}
?>

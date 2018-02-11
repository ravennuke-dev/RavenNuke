<?php
function getGDInfo($type='all') {
   // Returns the entire associative array if no $type is specified.  Otherwise returns only the requested info.
   /**
      GD Version           string value describing the installed libgd version.
      Freetype Support     boolean value. TRUE if Freetype Support is installed.
      Freetype Linkage     string value describing the way in which Freetype was linked. Expected values are: 'with freetype', 'with TTF library', and 'with unknown library'.  This element will only be defined if Freetype Support evaluated to TRUE.
      T1Lib Support        boolean value. TRUE if T1Lib support is included.
      GIF Read Support     boolean value. TRUE if support for reading GIF images is included.
      GIF Create Support   boolean value. TRUE if support for creating GIF images is included.
      JPG Support          boolean value. TRUE if JPG support is included.
      PNG Support          boolean value. TRUE if PNG support is included.
      WBMP Support         boolean value. TRUE if WBMP support is included.
      XBM Support          boolean value. TRUE if XBM support is included.
   **/
   if ($type=='all') {
      return gd_info();
      die();
   }
   if ($type=='FreeType Version') {
		ob_start();
		phpinfo(8);
		$s = ob_get_contents();
		ob_end_clean();
		$infoArray = explode('FreeType Version',strip_tags($s));
		$infoArray = explode("\n",$infoArray[1],-1);
		return trim($infoArray[0]);
		die();
   }
   foreach (gd_info() as $key=>$value) {
      if (strtolower($type)==strtolower($key)) {
         return $value;
         die();
      }
   }
   return false;
}

<?php

if(defined('VISUAL_CAPTCHA')) return;
define('NO_DISABLE', true);

define('ROOT', dirname(dirname(__FILE__)) . '/');
define('INCLUDES', ROOT.'includes/');
require_once(INCLUDES.'class.php-captcha.php');
define('FONTS', INCLUDES.'fonts/');
// full path disclosure identified by waraxe
$aFonts = array();
if ($handle = opendir(FONTS)) {
    while (FALSE !== ($file = readdir($handle))) {
        if ($file !== "." && $file != "..") {
            $aFonts[] = FONTS.$file;
        }
    }
}

$size = (isset($_GET['size'])) ? $_GET['size'] : 'normal';

switch ($size) {
    case 'normal':
    default:
        $width = 140;
        $height = 60;
        $length = 5;
    break;
    case 'large':
        $width = 200;
        $height = 60;
        $length = 6;
    break;
    case 'small':
        $width = 100;
        $height = 30;
        $length = 4;
    break;
}

//If there is a filename to use as a background
$file = (isset($_GET['file'])) ? $_GET['file'] : '';

//Look for invalid crap
if (preg_match("/[^\w_\-]/i",$file)) {
    die();
}

if (!is_array($aFonts)) {
    die('Fonts Not Found');
}
//See http://www.ejeliot.com/pages/2 for more information and settings
$oVisualCaptcha = new PhpCaptcha($aFonts, $width, $height);
$oVisualCaptcha->SetNumChars($length);
if (!empty($file) && $file != 'default') {
    if (file_exists(dirname(__FILE__).'/captcha/'.$file.'.jpg')) {
        $oVisualCaptcha->SetBackgroundImages('captcha/'.$file.'.jpg');
    }
}

$oVisualCaptcha->Create();

?>
<?php

/************************************************************************
Nuke-Evolution: Evolution Functions
============================================
Filename      : gfx.php
Author        : The Nuke-Evolution Team
Version       : 1.0.0
Date          : 10.17.2006 (mm.dd.yyyy)

Notes         : GFX functions
************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

/***************************************************************************
 * RavenNuke76(tm) v2.10.00 Modifications                                  *
 * Raven - 10/19/2006 - Brought up to W3C standard for XHTML               *
 ***************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//includes/fonts
define('GFX_FONT', 'VeraBd');
//The Font size for the older gfx style
define('GFX_FONT_SIZE', 6);
//Use a background image for the old gfx style
define('GFX_USE_IMAGE', true);

function random_code($number) {
    $out = '';
    $letters = range('a', 'z');
    for ($i=0; $i < $number; $i++) {
        mt_srand(crc32(microtime()));
        $num = mt_rand(0,1);
        if ($num) {
            //Number 1 - 9
            $out .= mt_rand(1, 9);
        } else {
            $out .= $letters[mt_rand(0, 25)];
        }
    }
    return $out;
}


//If there is GD
if(GDSUPPORT) {
    //Check for TTF
    $font = NUKE_INCLUDE_DIR.'fonts/'.GFX_FONT.'.ttf';
    $ttf = (function_exists('imagettftext') && file_exists($font));
    $ttfsize = GFX_FONT_SIZE*2;

    //Create random code
    $code = random_code(4);
    //Start the session
    if( !isset( $_SESSION ) ) { session_start(); }
    //If there was a previous GFX remove is
    if(isset($_SESSION['GFXCHECK'])) unset($_SESSION['GFXCHECK']);
    //Set the session so we can check it later
    $_SESSION['GFXCHECK'] = $code;
    session_write_close();

    //Get the theme
    $ThemeSel = get_theme();
    include_once('themes/'.$ThemeSel.'/theme.php');

    //If we are using TTF
    if ($ttf) {
        $border = imagettfbbox($ttfsize, 0, $font, $code);
        $width = $border[2]-$border[0];
    } else {
        $width = strlen($code)*(4+GFX_FONT_SIZE);
    }

    //If we are using a background image
    if (GFX_USE_IMAGE) {
        //Get it
        if (file_exists('themes/'.$ThemeSel.'/images/code_bg.jpg')) {
            $image = ImageCreateFromJPEG('themes/'.$ThemeSel.'/images/code_bg.jpg');
        } else if (file_exists('themes/'.$ThemeSel.'/images/code_bg.png')) {
            $image = ImageCreateFromPNG('themes/'.$ThemeSel.'/images/code_bg.png');
        } else {
            $image = ImageCreateFromJPEG('images/code_bg.jpg');
        }
        if (!isset($gfxcolor)) {
            $gfxcolor = '#505050';
        }
    } else {

        if (!isset($gfxcolor)) {
            $txtclr = $textcolor1;
        }
        $bgclr  = $bgcolor1;

        $bred   = hexdec(substr($bgclr, 1, 2));
        $bgreen = hexdec(substr($bgclr, 3, 2));
        $bblue  = hexdec(substr($bgclr, -2));

        $image = ImageCreate($width+6,20);
        $background_color = ImageColorAllocate($image, $bred, $bgreen, $bblue);
        ImageFill($image, 0, 0, $background_color);

    }

    //Create colors
    $tred   = hexdec(substr($gfxcolor, 1, 2));
    $tgreen = hexdec(substr($gfxcolor, 3, 2));
    $tblue  = hexdec(substr($gfxcolor, -2));

    $left = (imagesx($image)-$width)/2;

    //If we can use alpha and TTF
    if (function_exists('imagecolorallocatealpha')) {
        $txt_color = imagecolorallocatealpha($image, $tred, $tgreen, $tblue, 50);
        if ($ttf) {
            imagettftext($image, $ttfsize, 0, $left+1, 16, $txt_color, $font, $code);
        } else {
            ImageString($image, GFX_FONT_SIZE, $left+2, 3, $code, $txt_color);
        }
    }

    //Create the text
    if ($ttf) {
        imagettftext($image, $ttfsize, 0, $left, 15, ImageColorAllocate($image, $tred, $tgreen, $tblue), $font, $code);
    } else {
        ImageString($image, GFX_FONT_SIZE, $left, 2, $code, ImageColorAllocate($image, $tred, $tgreen, $tblue));
    }
    //Display the image
    Header('Content-type: image/png');
    ImagePNG($image);
    ImageDestroy($image);
    exit;
}

?>

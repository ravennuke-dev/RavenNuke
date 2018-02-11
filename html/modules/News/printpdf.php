<?php
//============================================================+
// File name   : example_018.php
// Begin       : 2008-03-06
// Last Update : 2010-08-08
//
// Description : Example 018 for TCPDF class
//               RTL document with Persian language
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: RTL document with Persian language
 * @author Nicola Asuni
 * @since 2008-03-06
 */

if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	require_once('mainfile.php');
require_once('classes/tcpdf/config/lang/eng.php');
require_once('classes/tcpdf/tcpdf.php');
global $db, $prefix, $nukeurl, $slogan, $sitename;

$result = $db->sql_query('SELECT catid, sid, aid, time, title, hometext, bodytext, informant, notes FROM '.$prefix.'_stories where sid=\''.$id.'\'');
$numrows = $db->sql_numrows($result);
$row = $db->sql_fetchrow($result);
$catid = intval($row['catid']);
$sid = stripslashes($row['sid']);
$aaid = stripslashes($row['aid']);
$time = $row['time'];
$title = stripslashes($row['title']);
$hometext = stripslashes($row['hometext']);
$bodytext = stripslashes($row['bodytext']);
$informant = stripslashes($row['informant']);
$notes = stripslashes($row['notes']);
$articleurl = $nukeurl.'/modules.php?name=News&file=article&sid='.$sid.'';
if(empty($bodytext)) {
    $bodytext = $hometext.$notes;
} else {
    $bodytext = $hometext.$bodytext.$notes;
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($informant);
$pdf->SetTitle($title);
$pdf->SetSubject($nukeurl);
$pdf->SetKeywords($sitename);

// set default header data
$pdf->SetHeaderData('','',$sitename,$nukeurl);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'en';
$lg['w_page'] = 'page';

//set some language-dependent strings
$pdf->setLanguageArray($lg);
// add a page
$pdf->AddPage();
// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 16);
$htmlcontent4 = $title;
$pdf->WriteHTML($htmlcontent4, true, 0, true, 0);
// set font
$pdf->SetFont('helvetica', '', 8);
$htmlcontent3 = $time . ' by ' . $informant;
$pdf->WriteHTML($htmlcontent3, true, 0, true, 0);
// set font
$pdf->SetFont('helvetica', '', 12);
// print newline
$pdf->Ln();

// Arabic and English content
$htmlcontent2 = $bodytext;
$baseURL = getNukeURL();
$htmlcontent2 = reltoabs($bodytext, $baseURL);
$pdf->WriteHTML($htmlcontent2, true, 0, true, 0);


// print newline
$pdf->Ln();
// set LTR direction for english translation
// set font size
$pdf->SetFontSize(6);

$htmlcontent = $articleurl;
$pdf->WriteHTML($htmlcontent, true, 0, true, 0);


//Close and output PDF document
ob_end_clean();
$pdf->Output('articles'.$sid.'.pdf', 'I');
}else{
echo 'There was an error';
}
//============================================================+
// END OF FILE
//============================================================+
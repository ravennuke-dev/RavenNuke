<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Submit Downloads
 *
 * This module allows end-users, as configured by the admin by download category,
 * to submit new downloads for the admin to review and either accept or
 * ignore/delete.  If the download category configuration allows it, this will
 * also allow for the uploading of files along with the submitted download data.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/**
 * German translation by http://su-s.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
global $sitename;
define('_DL_ADDADOWNLOAD', 'Neuen Download hinzuf&uuml;gen');
define('_DL_ADDTHISFILE', 'Diese Datei hinzuf&uuml;gen');
define('_DL_ALWEXT', 'Erlaubte Erweiterungen');
define('_DL_BADEXT', 'Falsche Erweiterung!');
define('_DL_CANTADD', 'Sie haben nicht die entsprechende Rechte, um in dieser Kategorie hinzuzuf&uuml;gen');
define('_DL_DOWNLOADNODESC', 'FEHLER: Geben Sie eine Beschreibung f&uuml;r Ihren Eintrag an!');
define('_DL_DOWNLOADNOTITLE', 'FEHLER: Sie m&uuml;ssen einen TITEL f&uuml;r Ihren Eintrag angeben!');
define('_DL_DOWNLOADNOURL', 'FEHLER: Sie m&uuml;ssen eine URL f&uuml;r Ihren Einrag angeben!');
define('_DL_DOWNLOADRECEIVED', 'Wir haben Ihren Download Eintrag erhalten. Danke!');
define('_DL_DOWSUB', 'Download Einreichung');
define('_DL_DOWSUBREC', 'Download Einreichung erhalten');
define('_DL_DPOSTPENDING', 'Alle vorgeschlagenen Downloads werden &uuml;berpr&uuml;ft.');
define('_DL_DUSAGE1', 'Alle Einsendungen werden auf Inhalt und erforderliche Mitgliedschaft gepr&uuml;ft.');
define('_DL_DUSAGE2', 'Falls sich herausstellt, dass Mitgliedschaft erforderlich ist, wird folgendes  eingeblendet:');
define('_DL_DUSAGE3', '<span style="color:#ff0000;" class="thick">Seiten-Hinweis: Um auf diesen Link zuzugreifen, m&uuml;ssen Sie Mitglied der Website sein.</span>');
define('_DL_DUSAGE4', 'Wird festgestellt, dass es sich um fraglichen Inhalt handeln k&ouml;nnte, wird folgendes zum Eintrag hinzugef&uuml;gt:');
define('_DL_DUSAGE5', '<span style="color:#0000ff;" class="thick">Seiten-Hinweis: Diese Seite enth&auml;lt m&ouml;glicherweise fraglichen Inhalt.</span>');
define('_DL_DUSAGEUP1', 'Mit der &Uuml;bertragung einer Datei wird folgendes akzeptiert:');
define('_DL_DUSAGEUP2', 'Hiermit wird <span class="thick">' . $sitename . '</span> erlaubt, die Datei zu speichern und f&uuml;r unbestimmte Zeit zum Download anzubieten.');
define('_DL_DUSAGEUP3', 'Diese Zustimmung gilt wie eine "SCHRIFTLICHE" Vereinbarung mit <span class="thick">' . $sitename . '</span> ,den Download zu hosten und anzubieten.');
define('_DL_DUSAGEUP4', 'dass der Eigent&uuml;mer von <span class="thick">' . $sitename . '</span> keine Haftung f&uuml;r den zur Verg&uuml;gung gestellten Download &uuml;bernimmt.');
define('_DL_DUSAGEUP5', 'dass hier nicht ein fremdes Script eines anderen Entwicklers als eigenes ausgegeben wird.');
define('_DL_DUSAGEUP6', 'Sollte sich sp&auml;ter herausstellen, dass falsche Angaben gemacht wurden, werden nur Sie zur Verantwortung gezogen, falls Schadenersatzanspr&uuml;che des Entwicklers aufkommen.');
define('_DL_EMAILWHENADD', 'Sie erhalten eine E-mail, wenn der Eintrag &uuml;berpr&uuml;ft und akzepiert wurde.');
define('_DL_FILEEXIST', '<span class="thick">FEHLER:</span> Diese Datei existiert bereits in unserem Verzeichnis.');
define('_DL_GONEXT', 'Gehe zum n&auml;chsten Schritt');
define('_DL_INSTRUCTIONS', 'Anleitung');
define('_DL_NOCATEGORY', 'F&uuml;r diese Eintragung sind keine Kategorien vorhanden.');
define('_DL_NOUPLOAD', '<span class="thick">FEHLER:</span> Datei nicht hochgeladen.');
define('_DL_TOBIG', '<span class="thick">FEHLER:</span> Datei ist zu gro&szlig;.');
define('_DL_TOU', 'Nutzungsbedingungen');
define('_DL_TOUMUST', 'Sie <span class="thick">M&Uuml;SSEN</span> die Nutzungsbedingungen akzeptieren!');
define('_DL_USERANDIP', 'Benutzername und IP werden gespeichert. Bitte missbrauchen Sie das System nicht.');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Autor\'s Email');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Autor\'s Name');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'Bytes');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Kategorie');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'Sie haben keine Email angegeben, aber wir werden Ihren Link bald pr&uuml;fen.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Beschreibung');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Downloads');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Gleichen Download nur einmal mitteilen.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Dateigr&ouml;&szlig;e');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'HomePage');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'in Bytes');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'IP Einsender');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'Titel');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Version');


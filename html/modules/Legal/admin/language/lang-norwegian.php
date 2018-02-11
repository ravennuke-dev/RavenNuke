<?php

/**
 * RavenNuke(tm) Legal Module
 *
 * The Legal module from DaDaNuke was re-written to allow for additional documents
 * to be added as well as different translations for each document (i.e., multilingual).
 * Original module copyrights are still retained below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/************************************************************************/
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
/************************************************************************/

$lgl_lang['LGL_ADM_CFG_CONADDRESS'] = 'Kontaktskjema Epost-adresse';
$lgl_lang['LGL_ADM_CFG_CONEMAILSUBJ'] = 'Kontaktskjema Epost-Tittel';
$lgl_lang['LGL_ADM_CFG_COUNTRY'] = 'Ditt Lands Navn';
$lgl_lang['LGL_ADM_CFG_SAVE'] = 'Lagring av Generelle Valg i databasen var vellykket!';
$lgl_lang['LGL_ADM_COM_ADD_APPLY'] = 'Legg til';
$lgl_lang['LGL_ADM_COM_ADDDOC'] = 'Legg til Juridisk Dokument';
$lgl_lang['LGL_ADM_COM_EDITDOC'] = 'Editere Dokument/Oversettelse';
$lgl_lang['LGL_ADM_COM_SAVE'] = 'Lagre';
$lgl_lang['LGL_ADM_COM_DEL_APPLY'] = 'Slette';
$lgl_lang['LGL_ADM_COM_DOCS'] = 'Dokumenter';
$lgl_lang['LGL_ADM_COM_EDIT_APPLY'] = 'Lagre';
$lgl_lang['LGL_ADM_COM_EDITEMBED'] = '<span class="italic">Bruk teksten i hakeparentesene for &aring; inkludere: [sitename] for nettsidens navn, [country] for landets navn, og [date] for dato (hakeparentesene skal v&aelig;re med!). Verdiene vil bli erstattet av \'Legal\' modulen.</span>';
$lgl_lang['LGL_ADM_COM_GENOPTS'] = 'Generelle Valg';
$lgl_lang['LGL_ADM_COM_GOBACK'] = '[Tilbake]';
$lgl_lang['LGL_ADM_COM_LEGAL'] = 'Juridisk';
$lgl_lang['LGL_ADM_COM_MODTITLE'] = 'Administrering av Juridiske Dokumenter';
$lgl_lang['LGL_ADM_COM_PGTITLE'] = 'Juridiske Generelle Valg';
$lgl_lang['LGL_ADM_COM_SITEADMIN'] = 'ACP';
$lgl_lang['LGL_ADM_DOCS_ACTIVE'] = 'Aktivert';
$lgl_lang['LGL_ADM_DOCS_ADDNAMEHINT'] = '(Bare et navn uten mellomrom - maksimum 32 tegn (f.eks.: "betingelser")';
$lgl_lang['LGL_ADM_DOCS_CLICKTOACTIVATE'] = 'Klikk for &aring; aktivere dokumentet';
$lgl_lang['LGL_ADM_DOCS_CLICKTOADDT'] = 'Klikk for &aring; legge til en oversettelse';
$lgl_lang['LGL_ADM_DOCS_CLICKTODELETED'] = 'Klikk for &aring; slette dokumentet og alle dets oversettelser';
$lgl_lang['LGL_ADM_DOCS_CLICKTODELETET'] = 'Klikk for &aring; slette oversettelse';
$lgl_lang['LGL_ADM_DOCS_CLICKTOEDITD'] = 'Klikk for &aring; editere dokumentet';
$lgl_lang['LGL_ADM_DOCS_CLICKTOEDITT'] = 'Klikk for &aring; lage/editere oversettelse';
$lgl_lang['LGL_ADM_DOCS_CLICKTOINACTIVATE'] = 'Klikk for &aring; deaktivere dokumentet';
$lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWD'] = 'Klikk for &aring; vise/lese dokumentet';
$lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWDNOT'] = 'Kan ikke vises fordi det ikke finnes noen oversettelse';
$lgl_lang['LGL_ADM_DOCS_DBDELCONFIRM'] = 'Er du sikker p&aring; at du vil slette dokumentet/oversettelsen?';
$lgl_lang['LGL_ADM_DOCS_DBDELSUCCESS'] = 'Sletting av Documentet/Oversettelsen var vellykket';
$lgl_lang['LGL_ADM_DOCS_DBSUCCESS'] = 'Lagringen av Dokumentet var vellykket';
$lgl_lang['LGL_ADM_DOCS_DOCBODY'] = 'Dokumentets innholstekst';
$lgl_lang['LGL_ADM_DOCS_DOCNAME'] = 'Dokumentnavn';
$lgl_lang['LGL_ADM_DOCS_DOCTITLE'] = 'Dokument-tittel';
$lgl_lang['LGL_ADM_DOCS_INACTIVE'] = 'Deaktivert';
$lgl_lang['LGL_ADM_DOCS_LANG'] = 'Spr&aring;k';
$lgl_lang['LGL_ADM_DOCS_LANGS'] = 'Tilgjengelige spr&aring;k';
$lgl_lang['LGL_ADM_DOCS_NOMULTILINGUAL'] = '<span class="italic">Flerspr&aring;kelige valg er deaktivert under \'Instillinger for Nettsiden\' i ACP.</span>';
$lgl_lang['LGL_ADM_DOCS_SITELANG'] = 'Sidens foretukkede Spr&aring;k!';
$lgl_lang['LGL_ADM_DOCS_STATUS'] = 'Status';
$lgl_lang['LGL_ADM_DOCS_STATUSSUCCESS'] = 'Endringen av Status var vellykket';
$lgl_lang['LGL_ADM_ERR_DBDELETE'] = 'Slettingen fra tabellen i databasen feilet';
$lgl_lang['LGL_ADM_ERR_DBSAVE'] = 'Lagringen feilet';
$lgl_lang['LGL_ERR_FAILEDVALIDATION'] = 'Previous input is not valid - please go back and verify your input';
$lgl_lang['LGL_ERRDB_DOCEXISTS'] = 'Det Juridiske Dokumentet eksisterer allerede';
$lgl_lang['LGL_ERRDB_DOCFAILEDSTATUS'] = 'Endringen av Status feilet';
$lgl_lang['LGL_ERRDB_DOCNOTFOUND'] = 'Kunne ikke finne det foretrukkede dokumentet';
$lgl_lang['LGL_ERRDB_TRANSNOTFOUND'] = 'Kunne ikke finne noen oversettelse for ditt spr&aring;k - vennligst kontakt administrator dersom problemet vedvarer';
?>
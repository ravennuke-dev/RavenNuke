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

$lgl_lang['LGL_ADM_CFG_CONADDRESS'] = 'Correo para Formulario de Contacto';
$lgl_lang['LGL_ADM_CFG_CONEMAILSUBJ'] = 'Asunto para Formulario de Contacto';
$lgl_lang['LGL_ADM_CFG_COUNTRY'] = 'Nombre de tu Pa&iacute;s';
$lgl_lang['LGL_ADM_CFG_SAVE'] = 'Opciones Generales satisfactoriamente agregadas a la base de datos!';
$lgl_lang['LGL_ADM_COM_ADD_APPLY'] = 'AGREGAR';
$lgl_lang['LGL_ADM_COM_ADDDOC'] = 'Agregar Docuemnto';
$lgl_lang['LGL_ADM_COM_EDITDOC'] = 'Editar Documento/Traducci&oacute;n';
$lgl_lang['LGL_ADM_COM_SAVE'] = 'GUARDAR';
$lgl_lang['LGL_ADM_COM_DEL_APPLY'] = 'ELIMINAR';
$lgl_lang['LGL_ADM_COM_DOCS'] = 'Documentos';
$lgl_lang['LGL_ADM_COM_EDIT_APPLY'] = 'GUARDAR';
$lgl_lang['LGL_ADM_COM_EDITEMBED'] = '(Incruste el nombre de su sitio utilizando el texto [sitename], para el nombre de su pa&iacute;s utilice [country], y para la fecha [date] estos ser&aacute; reemplazados autom&aacute;ticamente por el m&oacute;dulo)';
$lgl_lang['LGL_ADM_COM_GENOPTS'] = 'Opciones Generales';
$lgl_lang['LGL_ADM_COM_GOBACK'] = '[Volver Atr&aacute;s]';
$lgl_lang['LGL_ADM_COM_LEGAL'] = 'Legal';
$lgl_lang['LGL_ADM_COM_MODTITLE'] = 'Administraci&oacute;n de Documentos Legales';
$lgl_lang['LGL_ADM_COM_PGTITLE'] = 'Opciones Generales del m&oacute;dulo Legal';
$lgl_lang['LGL_ADM_COM_SITEADMIN'] = 'Administraci&oacute;,n del Sitio';
$lgl_lang['LGL_ADM_DOCS_ACTIVE'] = 'Activo';
$lgl_lang['LGL_ADM_DOCS_ADDNAMEHINT'] = '(Solo un nombre, sin espacios, m&aacute;x. 32 caracteres - Por ejemplo: "t&eacute;rminos")';
$lgl_lang['LGL_ADM_DOCS_CLICKTOACTIVATE'] = 'Click para activar documento';
$lgl_lang['LGL_ADM_DOCS_CLICKTOADDT'] = 'Click para agregar una traducci&oacute;n';
$lgl_lang['LGL_ADM_DOCS_CLICKTODELETED'] = 'Click para eliminar documento y todas sus traducciones';
$lgl_lang['LGL_ADM_DOCS_CLICKTODELETET'] = 'Click para eliminar traducci&oacute;n';
$lgl_lang['LGL_ADM_DOCS_CLICKTOEDITD'] = 'Click para editar documento';
$lgl_lang['LGL_ADM_DOCS_CLICKTOEDITT'] = 'Click para editar/crear traducci&oacute;n';
$lgl_lang['LGL_ADM_DOCS_CLICKTOINACTIVATE'] = 'Click para desactivar documento';
$lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWD'] = 'Click para ver documento';
$lgl_lang['LGL_ADM_DOCS_CLICKTOVIEWDNOT'] = 'imposible visual;izar debido a que la traducci&oacute;n no ha sido creada a&uacute;n';
$lgl_lang['LGL_ADM_DOCS_DBDELCONFIRM'] = '&iquest;Est&aacute;s seguro que quiers eliminar el documento / traducci&oacute;n seleccionado?';
$lgl_lang['LGL_ADM_DOCS_DBDELSUCCESS'] = 'Documento / traducci&oacute;n eliminado exitosamente';
$lgl_lang['LGL_ADM_DOCS_DBSUCCESS'] = 'Documento guardado exitosamente';
$lgl_lang['LGL_ADM_DOCS_DOCBODY'] = 'Texto del Cuerpo del Docuemnto';
$lgl_lang['LGL_ADM_DOCS_DOCNAME'] = 'Nombre del Docuemnto';
$lgl_lang['LGL_ADM_DOCS_DOCTITLE'] = 'T&iacute;tulo del documento';
$lgl_lang['LGL_ADM_DOCS_INACTIVE'] = 'Inactivo';
$lgl_lang['LGL_ADM_DOCS_LANG'] = 'Idioma';
$lgl_lang['LGL_ADM_DOCS_LANGS'] = 'Idiomas Disponibles';
$lgl_lang['LGL_ADM_DOCS_NOMULTILINGUAL'] = 'Opci&oacute;n multilenguaje desactivada en las preferencias del sitio';
$lgl_lang['LGL_ADM_DOCS_SITELANG'] = 'Lenguaje predeterminado del sitio!';
$lgl_lang['LGL_ADM_DOCS_STATUS'] = 'Estado';
$lgl_lang['LGL_ADM_DOCS_STATUSSUCCESS'] = 'Cambio de estado exitosamente';
$lgl_lang['LGL_ADM_ERR_DBDELETE'] = 'Fall&oacute; la eliminaci&oacute;n de la tabla';
$lgl_lang['LGL_ADM_ERR_DBSAVE'] = 'imposible guardar. Intenfo fallido';
$lgl_lang['LGL_ERR_FAILEDVALIDATION'] = 'Entrada anterior inv&aacute;lida - por favor, regrese y verifique su entrada';
$lgl_lang['LGL_ERRDB_DOCEXISTS'] = 'Documento legal ya existe';
$lgl_lang['LGL_ERRDB_DOCFAILEDSTATUS'] = 'Cambio de estado fallido';
$lgl_lang['LGL_ERRDB_DOCNOTFOUND'] = 'No se ha podido encontrar el documento legal deseado';
$lgl_lang['LGL_ERRDB_TRANSNOTFOUND'] = 'No se ha podido encontrar una traducci&oacute;n para su idioma - Contacte al administrador del sitio si el problema persiste';
?>
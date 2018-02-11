<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Function: Common Use Defines
************************************************************************/

define('_MSNL_COM_LAB_SQL', 'SQL');
define('_MSNL_COM_LAB_GOBACK', 'REGRESAR');
define('_MSNL_COM_LAB_ERRMSG', 'MENSAJE DE ERROR');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Sit&uacute;e el cursor sobre estos iconos para obtener texto de ayuda detallada '
  .''
  );

define('_MSNL_COM_LNK_GOBACK', 'Presione para volver a la p&aacute;gina anterior');

define('_MSNL_COM_ERR_SQL', 'SE ENCONTR&Oacute; UN ERROR EN SQL');
define('_MSNL_COM_ERR_MODULE', 'ERROR EN EL M&Oacute;DULO');
define('_MSNL_COM_ERR_VALMSG', 'LOS SIGUIENTES CAMPOS FALLARON LA VALIDACI&Oacute;N');
define('_MSNL_COM_ERR_VALWARNMSG', 'LOS SIGUIENTES CAMPOS CONTIENEN ADVERTENCIAS');
define('_MSNL_COM_ERR_DBGETCFG',  'No se ha podido obtener informaci&oacute;n de la configuraci&oacute;n del m&oacute;dulo!');

define('_MSNL_COM_HLP_HELPLEGENDTXT', 'S&iacute;, as&iacute; es como se hace!');

/************************************************************************
* Function: Common use defines between module and block
************************************************************************/

define('_MSNL_NLS_LAB_MORENLS', 'M&aacute;s Boletines...');
define('_MSNL_NLS_LAB_HIT', 'hit');
define('_MSNL_NLS_LAB_HITS', 'hits');
define('_MSNL_NLS_LAB_SENTON', 'enviado en');
define('_MSNL_NLS_LAB_SENDER', 'remitente');

define('_MSNL_NLS_LNK_VIEWNL', 'Ver bolet&iacute;n - puede abrirse una nueva ventana');
define('_MSNL_NLS_LNK_VIEWNLARCHS', 'Ver archivos del Boletin');

/************************************************************************
* Function: msnl_nls_list
************************************************************************/

define('_MSNL_NLS_LST_LAB_ARCHTITL', 'Boletines Archivados');
define('_MSNL_NLS_LST_LAB_ADMNLS', 'Administrar Bolet&iacute;n');

define('_MSNL_NLS_LST_LNK_ADMNLS', 'Ir a la administraci&oacute;n del m&oacute;dulo');

define('_MSNL_NLS_LST_MSG_NONLS', 'No hay boletines para ver');

/************************************************************************
* Function: msnl_nls_view
************************************************************************/

define('_MSNL_NLS_VIEW_ERR_DBGETNL', 'No se ha podido obtener informaci&oacute;n del Bolet&iacute;n');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND', 'No se puede encontrar el archivo seleccionado del Bolet&iacute;n');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH', 'No est&aacute;s autorizado para ver este bolet&iacute;n '
  .'o este bolet&iacute;n no existe!');

/************************************************************************
* Function: msnl_copyright_view
************************************************************************/

define('_MSNL_CPY_LAB_COPYTITLE', 'Copyright &copy; y Cr&eacute;ditos del M&oacute;dulo');
define('_MSNL_CPY_LAB_MODULEFOR', 'm&oacute;dulo para');
define('_MSNL_CPY_LAB_COPY', 'Informaci&oacute;n de Derecho de Autor');
define('_MSNL_CPY_LAB_CREDITS', 'Informaci&oacute;n de Cr&eacute;ditos');
define('_MSNL_CPY_LAB_MODNAME', 'Nombre del M&oacute;dulo');
define('_MSNL_CPY_LAB_MODVER', 'Versi&oacute;n del M&oacute;dulo');
define('_MSNL_CPY_LAB_MODDESC', 'Descripci&oacute;n del M&oacute;dulo');
define('_MSNL_CPY_LAB_LICENSE', 'Licencia');
define('_MSNL_CPY_LAB_AUTHORNM', 'Nombre del Autor');
define('_MSNL_CPY_LAB_AUTHOREMAIL', 'Correo del Autor');
define('_MSNL_CPY_LAB_AUTHORWEB', 'Sitio Web del Autor');
define('_MSNL_CPY_LAB_MODDL', 'Descargar el M&oacute;dulo');
define('_MSNL_CPY_LAB_DOCS', 'Documentaci&oacute;n de Soporte / Ayuda');
define('_MSNL_CPY_LAB_ORIGAUTHOR', 'Autor(es) Original(es)');
define('_MSNL_CPY_LAB_CURRENTAUTHOR', 'Autor(es) Actual(es)');
define('_MSNL_CPY_LAB_TRANSLATIONS', 'Autor(es) de Traducci&oacute;n');
define('_MSNL_CPY_LAB_OTHER', 'Agradecimientos Adicionales');

define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'Ver derechos de autor y cr&eacute;ditos');
define('_MSNL_CPY_LNK_PHPNUKE', 'Ir al sitio web de PHP-Nuke - abandonar&aacute;s este sitio');
define('_MSNL_CPY_LNK_AUTHORHOME', 'Ir al sitio web del Autor - abandonar&aacute;s este sitio');
define('_MSNL_CPY_LNK_DOWNLOAD', 'Ir al sitio web de Descargas - abandonar&aacute;s este sitio');
define('_MSNL_CPY_LNK_DOCS', 'Ir al sitio web de la Documentaci&oacute;n - abandonar&aacute;s este sitio');


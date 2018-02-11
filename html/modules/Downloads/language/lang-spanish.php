<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
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
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
/*
 * Do not remove the following defined statement.  Make sure this is here
 * also within EVERY translation of this English file.
 */
define('_DL_LANG_MODULE', true);
/*
 * End of key language file define.  You may modify any text in the below
 * lines, but do not change the name of the constant that is being defined!
 */

define('_DL_1WEEK', '1 Semana');
define('_DL_2WEEKS', '2 Semanas');
define('_DL_30DAYS', '30 Dias');
define('_DL_ACCEPT', 'Aceptar');
define('_DL_ACTIVATE', 'Activar');
define('_DL_ACTIVE_N', 'Inactivo');
define('_DL_ACTIVE_Y', 'Activo');
define('_DL_ADD', 'A&ntilde;adir');
define('_DL_ADDCATEGORY', 'A&ntilde;adir Categor&iacute;a');
define('_DL_ADDDOWNLOAD', 'A&ntilde;adir Descarga');
define('_DL_ADDED', 'A&ntilde;adido');
define('_DL_ADDEDON', 'A&ntilde;adido en');
define('_DL_ADDEXTENSION', 'A&ntilde;adir Extensi&oacute;n');
define('_DL_ADMADMPERPAGE', 'N&uacute;mero de elementos en cada p&aacute;gina del administrador');
define('_DL_ADMBLOCKUNREGMODIFY', 'Los usuarios no registrados pueden sugerir cambios');
define('_DL_ADMIN', 'Solo Administradores');
define('_DL_ADMMOSTPOPULAR', 'Elementos m&aacute;s populares para mostrar');
define('_DL_ADMMOSTPOPULARTRIG', 'Mostrar M&aacute;s Populares como');
define('_DL_ADMPERPAGE', 'N&uacute;mero de elementos en cada p&aacute;gina');
define('_DL_ADMPOPULAR', 'N&uacute;mero de descargas para ser popular');
define('_DL_ADMRESULTS', 'N&uacute;mero de elementos en cada p&aacute;gina de b&uacute;squeda');
define('_DL_ADMSHOWDOWNLOAD', 'Mostrar descargas a todo el mundo');
define('_DL_ADMSHOWNUM', 'Mostrar n&uacute;mero de elementos para cada categor&iacute;a');
define('_DL_ADMUSEGFX', 'Utilizar c&oacute;digo de seguridad');
define('_DL_ALL', 'Todos los visitantes');
define('_DL_ALREADYEXIST', 'ya existe!');
define('_DL_ANON', 'Usuarios an&oacute;nimos solamente');
define('_DL_APPROVEDMSG', 'Tu pedido de descarga ha sido aprovado!');
define('_DL_AUTHOR', 'Autor');
define('_DL_BACKTO', 'Regresar a');
define('_DL_BEPATIENT', '(por favor se paciente)');
define('_DL_BROKENREP', 'Reportes de descargas rotas');
define('_DL_CANBEDOWN', 'Este archivo puede ser descargado por');
define('_DL_CANBEVIEW', 'Este archivo puede ser visto por');
define('_DL_CANUPLOAD', 'Permitir subidas');
define('_DL_CATEGORIES', 'Categor&iacute;as');
define('_DL_CATEGORIESADMIN', 'Gesti&oacute;n de categor&iacute;as');
define('_DL_CATEGORIESLIST', 'Lista de categor&iacute;as');
define('_DL_CATTRANS', 'Transferencia de categor&iacute;a');
define('_DL_CHECK', 'Revisar');
define('_DL_CHECKALLDOWNLOADS', 'Revisar todas las descargas');
define('_DL_CHECKCATEGORIES', 'Revisar categor&iacute;as');
define('_DL_DATE', 'Fecha');
define('_DL_DATEADD', 'A&ntilde;adido en');
define('_DL_DATEFORMAT', 'Formato de fecha');
define('_DL_DATEMSG', 'La sintaxis es id&eacute;ntica a la utilizada por la funci&oacute;n &lt;a href=&quot;http://www.php.net/date&quot; target=&quot;_blank&quot;&gt;date()&lt;/a&gt; en PHP');
define('_DL_DAYS', 'd&iacute;as');
define('_DL_DBCONFIG', 'Error de la base de datos. Por favor notifique al webmaster que debe ejecutar la configuraci&oacute;n de descargas!');
define('_DL_DCATLAST2WEEKS', 'Nuevas descargas a&ntilde;adidas a esta categor&iacute;a en las &uacute;ltimas dos semanas');
define('_DL_DCATLAST3DAYS', 'Nuevas descargas a&ntilde;adidas a esta categor&iacute;a en los &uacute;ltimos 3 d&iacute;as');
define('_DL_DCATNEWTODAY', 'Nuevas descargas a&ntilde;adidas a esta categor&iacute;a hoy');
define('_DL_DCATTHISWEEK', 'Nuevas descargas a&ntilde;adidas a esta categor&iacute;a esta semana');
define('_DL_DDATE1', 'Fecha (Descargas m&aacute;s antiguas primero)');
define('_DL_DDATE2', 'Fecha (Descargas m&aacute;s recientes primero)');
define('_DL_DDELETEINFO', 'Eliminar (Elimina &lt;b&gt;&lt;i&gt;descargas rotas&lt;/i&gt;&lt;/b&gt; y &lt;b&gt;&lt;i&gt;solicitudes&lt;/i&gt;&lt;/b&gt; para una descarda determinada)');
define('_DL_DEACTIVATE', 'Desactivar');
define('_DL_DELETE', 'Eliminar');
define('_DL_DELETEDOWNLOAD', 'Eliminar descarga');
define('_DL_DELEZDOWNLOADSCATWARNING', '!!!!ADVERTENCIA!!!!&lt;br /&gt;&iquest;Est&aacute;s seguro que deseas eliminar esta categor&iacute;a?&lt;br /&gt;Todas las sub-categor&iacute;as y descargas adjuntas ser&aacute;n eliminadas conjuntamente!');
define('_DL_DENIED', 'Acceso al archivo denegado');
define('_DL_DIGNOREINFO', 'Ignorar (Elimina todas las &lt;b&gt;&lt;i&gt;solicitudes&lt;/i&gt;&lt;/b&gt; para una descarga determinada)');
define('_DL_DIRECTIONS', 'DIRECCIONES:');
define('_DL_DLNOTES1', 'Para descargar el archivo &quot;');
define('_DL_DLNOTES2', '&quot;, debes volver a escribir el c&oacute;digo mostrado y hacer clic en el bot&oacute;n siguiente.');
define('_DL_DLNOTES3', '&quot;, haga clic en el bot&oacute;n siguiente.');
define('_DL_DLNOTES4', ' En breve se mostrar&aacute; el di&aacute;logo de descarga o ser&aacute; dirigido al sitio apropiado.');
define('_DL_DN', 'Descargas');
define('_DL_DNODOWNLOADSWAITINGVAL', 'No hay descargas esperando validaci&oacute;n');
define('_DL_DNOREPORTEDBROKEN', 'No hay descargas rotas reportadas.');
define('_DL_DONLYREGUSERSMODIFY', 'Solo los usuarios registrados pueden sugerir modificaciones de descargas. Por favor &lt;a href=&quot;modules.php?name=Your_Account&quot;&gt;reg&iacute;strese o inicie sesi&oacute;n&lt;/a&gt;.');
define('_DL_DOWNCONFIG', 'Configuraci&oacute;n de Descargas');
define('_DL_DOWNLOAD', 'Descarga');
define('_DL_DOWNLOADALREADYEXT', 'ERROR: Este URL ya esta presente en la base de datos!');
define('_DL_DOWNLOADAPPROVEDMSG', 'Hemos aprobado tu env&iacute;o de descarga para nuestro motor de b&uacute;squeda.');
define('_DL_DOWNLOADID', 'N&uacute;mero de archivo');
define('_DL_DOWNLOADMODREQUEST', 'Solicitudes de modificaci&oacute;n de descargas');
define('_DL_DOWNLOADNOW', 'Descarga este archivo ahora!');
define('_DL_DOWNLOADOWNER', 'Propietario de la descarga');
define('_DL_DOWNLOADPROFILE', 'Perfil de la descarga');
define('_DL_DOWNLOADSADMIN', 'Gesti&oacute;n de descargas');
define('_DL_DOWNLOADSINDB', 'Descargas en nuestra base de datos');
define('_DL_DOWNLOADSLIST', 'Lista de descargas');
define('_DL_DOWNLOADSMAIN', 'Indice de Descargas');
define('_DL_DOWNLOADSMAINCAT', 'Principales categor&iacute;as de descargas');
define('_DL_DOWNLOADSMAINTAIN', 'Mantenimiento de descargas');
define('_DL_DOWNLOADSWAITINGVAL', 'Descargas esperando validaci&oacute;n');
define('_DL_DOWNLOADVALIDATION', 'Validaci&oacute;n de descarga');
define('_DL_DSCRIPT', 'Script de descarga');
define('_DL_DTOTALFORLAST', 'Total de nuevas descargas para los &uacute;ltimos');
define('_DL_DUSERMODREQUEST', 'Solicititudes de modificaci&oacute;n de descargas reportadas por usuarios');
define('_DL_DUSERREPBROKEN', 'Descargas rotas reportadas por usuarios');
define('_DL_EDIT', 'Editar');
define('_DL_ERROR', 'Error');
define('_DL_ERRORNODESCRIPTION', 'ERROR: Necesitas escribir una descripci&oacute;n para tu URL!');
define('_DL_ERRORNOTITLE', 'ERROR: Necesitas escribir un t&iacute;tulo para tu URL!');
define('_DL_ERRORNOURL', 'ERROR: Necesitas especificar un URL!');
define('_DL_ERRORTHEEXTENSION', 'ERROR: Extensi&oacute;n ya en uso');
define('_DL_ERRORTHEEXTENSIONTYP', 'ERROR: Los tipos de extensi&oacute;n no pueden ser iguales');
define('_DL_ERRORTHEEXTENSIONVAL', 'ERROR: La extensi&oacute;n tiene un formato inv&aacute;lido');
define('_DL_ERRORTHESUBCATEGORY', 'ERROR: La sub-categor&iacute;a');
define('_DL_ERRORURLEXIST', 'ERROR: Este URL ya est&aacute; presente en la base de datos!');
define('_DL_EXT', 'Extensi&oacute;n');
define('_DL_EXTENSION', 'Extensi&oacute;n');
define('_DL_EXTENSIONS', 'Extensiones');
define('_DL_EXTENSIONSADMIN', 'Gesti&oacute;n de Extensiones');
define('_DL_EXTENSIONSLIST', 'Lista de Extensiones');
define('_DL_EZATTACHEDTOCAT', 'bajo esta categor&iacute;a');
define('_DL_EZSUBCAT', 'sub-categor&iacute;as');
define('_DL_EZTHEREIS', 'Hay');
define('_DL_EZTRANSFER', 'Transferir');
define('_DL_EZTRANSFERDOWNLOADS', 'Transferir todas las descargas desde categor&iacute;a');
define('_DL_FAILED', 'Fall&oacute;!');
define('_DL_FILE', 'archivo');
define('_DL_FILENAME', 'Nombre de archivo');
define('_DL_FILES', 'archivos');
define('_DL_FILESDL', 'archivos descargados');
define('_DL_FILESIZEVALIDATION', 'Validaci&oacute;n de tama&ntilde;o de archivo');
define('_DL_FILETYPE', 'Tipo de archivo');
define('_DL_FLAGGED', 'Esta descarga ha sido autom&aacute;ticamente marcada para ser revisada por el webmaster.');
define('_DL_FNF', 'Archivo no encontrado:');
define('_DL_FNFREASON', 'Talvez la persona alojando la descarga elimin&oacute; o renombr&oacute; el archivo.');
define('_DL_FROM', 'De');
define('_DL_FUNCTIONS', 'Funciones');
define('_DL_GB', 'Gb');
define('_DL_GOGET', 'Atr&aacute;palo');
define('_DL_HELLO', 'Hola');
define('_DL_HITS', 'Hits');
define('_DL_ID', 'ID');
define('_DL_IGNORE', 'Ignorar');
define('_DL_IMAGETYPE', 'Tipo de imagen');
define('_DL_INCLUDESUBCATEGORIES', '(incluir sub-categor&iacute;as)');
define('_DL_INVALIDDOWNLOAD', 'La identificaci&oacute;n de descarga es inv&aacute;lida.');
define('_DL_INVALIDPASS', 'Haz introducido un c&oacute;digo inv&aacute;lido.');
define('_DL_INVALIDURL', 'Un URL inv&aacute;lido ha sido recibido por el script.');
define('_DL_KB', 'Kb');
define('_DL_LAST30DAYS', '&Uacute;ltimos 30 dias');
define('_DL_LASTWEEK', '&Uacute;ltima semana');
define('_DL_LEGEND', 'Leyenda de los s&iacute;mbolos');
define('_DL_LINKSDATESTRING', '%d-%b-%Y');
define('_DL_LOOKTOREQUEST', 'Revisaremos tu solicitud a la mayor brevedad.');
define('_DL_MAIN', 'Principal');
define('_DL_MAINADMIN', 'Administraci&oacute;n del Sitio');
define('_DL_MB', 'Mb');
define('_DL_MODCATEGORY', 'Modificar una categor&iacute;a');
define('_DL_MODDOWNLOAD', 'Modificar una descarga');
define('_DL_MODEXTENSION', 'Modificar extensi&oacute;n');
define('_DL_MODIFY', 'Modificar');
define('_DL_MODREQUEST', 'Solicitudes de modificaci&oacute;n');
define('_DL_MOSTPOPULAR', 'M&aacute;s populares - Top');
define('_DL_NAME', 'Nombre');
define('_DL_NEW', 'Nuevo');
define('_DL_NEWDOWNLOADADDED', 'Nueva descarga a&ntilde;adida a la base de datos');
define('_DL_NEWDOWNLOADS', 'Nuevas descargas');
define('_DL_NEWLAST2WEEKS', 'Nuevo en las &uacute;ltimas 2 semanas');
define('_DL_NEWLAST3DAYS', 'Nuevo en los &uacute;ltimos 3 d&iacute;as');
define('_DL_NEWSIZE', 'Nuevo tama&ntilde;o');
define('_DL_NEWTHISWEEK', 'Nuevo esta semana');
define('_DL_NEWTODAY', 'Nuevo hoy');
define('_DL_NEXT', 'P&aacute;gina siguiente');
define('_DL_NO', 'No');
define('_DL_NOCATTRANS', 'No hay categor&iacute;as en la base de datos.');
define('_DL_NOMATCHES', 'No hay resultados para su  consulta');
define('_DL_NOMODREQUESTS', 'No hay solicitudes de modificaci&oacute;n en este momento');
define('_DL_NONE', 'Ninguno');
define('_DL_NONEXT', 'No hay p&aacute;gina siguiente');
define('_DL_NOPREVIOUS', 'No hay p&aacute;gina anterior');
define('_DL_NOTFOUND', 'no fue encontrado.');
define('_DL_NOTLIST', 'No figura');
define('_DL_NOTLOCAL', 'No local');
define('_DL_NUMBER', 'N&uacute;mero');
define('_DL_OF', 'de');
define('_DL_OFALL', 'de todos');
define('_DL_OK', 'OK');
define('_DL_OLDSIZE', 'Antiguo tama&ntilde;o');
define('_DL_ONLY', 'Solamente');
define('_DL_ORIGINAL', 'Original');
define('_DL_OTHERS', 'Otros');
define('_DL_OWNER', 'Propietario');
define('_DL_PAGE', 'P&aacute;gina');
define('_DL_PAGES', 'P&aacute;ginas');
define('_DL_PARENT', 'Superior');
define('_DL_PASSERR', 'Error de c&oacute;digo');
define('_DL_PATHHIDE', 'La ruta permanece oculta');
define('_DL_PERCENT', 'Porciento');
define('_DL_PERM', 'Permisos');
define('_DL_POPULAR', 'Popular');
define('_DL_POPULARDLS', 'Descargas populares');
define('_DL_POPULARITY', 'Popularidad');
define('_DL_POPULARITY1', 'Popularidad (Least to Most Hits)');
define('_DL_POPULARITY2', 'Popularidad (Most to Least Hits)');
define('_DL_PREVIOUS', 'P&aacute;gina anterior');
define('_DL_PURPOSED', 'Propuso');
define('_DL_REPORTBROKEN', 'Reportar enlace roto');
define('_DL_REQUESTDOWNLOADMOD', 'Solicitar modificaci&oacute;n de descarga');
define('_DL_RESSORTED', 'Recursos actualmente ordenados por');
define('_DL_RESTRICTED', 'Acceso a archivo restringido');
define('_DL_SAVECHANGES', 'Guardar Cambios');
define('_DL_SEARCH', 'Buscar');
define('_DL_SEARCHRESULTS4', 'Resultados de b&uacute;squeda para');
define('_DL_SECURITYBROKEN', 'Tu nombre de usuario y direcci&oacute;n IP ser&aacute;n registrados por motivos de seguridad.');
define('_DL_SELECTPAGE', 'Seleccionar p&aacute;gina');
define('_DL_SENDREQUEST', 'Enviar solicitud');
define('_DL_SHOW', 'Mostrar');
define('_DL_SHOWTOP', 'Mostrar Top');
define('_DL_SORRY', 'Disculpa');
define('_DL_SORTDOWNLOADSBY', 'Ordenar descargas por');
define('_DL_STATUS', 'Estado');
define('_DL_SUBMITTER', 'Remitente');
define('_DL_TDN', 'Total de descargas');
define('_DL_TEAM', 'Equipo.');
define('_DL_THANKS4YOURSUBMISSION', 'Gracias por tu env&iacute;o!');
define('_DL_THANKSBROKEN', 'Gracias por ayudar a mantener la integridad de este directorio.');
define('_DL_THANKSFORINFO', 'Gracias por la informaci&oacute;n.');
define('_DL_TIMES', 'veces');
define('_DL_TITLEAZ', 'T&iacute;tulo (A - Z)');
define('_DL_TITLEZA', 'T&iacute;tulo (Z - A)');
define('_DL_TO', 'Para');
define('_DL_TOTALDLCATEGORIES', 'Total de categor&iacute;as');
define('_DL_TOTALDLFILES', 'Total de archivos');
define('_DL_TOTALDLSERVED', 'Total Servido');
define('_DL_TOTALNEWDOWNLOADS', 'Total de descargas nuevas');
define('_DL_TYPEPASS', 'Escribe el c&oacute;digo');
define('_DL_UADD', 'Los usuarios pueden agregar');
define('_DL_UP', 'Subidas');
define('_DL_UPDIRECTORY', 'Ruta relativa');
define('_DL_URLERR', 'Error de URL');
define('_DL_USERS', 'Usuarios registrados solamente');
define('_DL_USEUPLOAD', 'usada para la carga de archivos');
define('_DL_USUBCATEGORIES', 'Sub-categor&iacute;as');
define('_DL_VALIDATEDOWNLOADS', 'Validar descargas');
define('_DL_VALIDATESIZES', 'Validar tama&ntilde;os de archivo');
define('_DL_VALIDATINGCAT', 'Validando categor&iacute;a');
define('_DL_VISIT', 'Visitar');
define('_DL_WAITINGDOWNLOADS', 'Descargas esperando');
define('_DL_WHOADD', 'Permisos de env&iacute;o');
define('_DL_YES', 'S&iacute;');
define('_DL_YOUCANBROWSEUS', 'Puedes navegar por nuestro motor de descargas en:');
define('_DL_YOURDOWNLOADAT', 'Tu descarga en');
define('_DL_YOURPASS', 'Tu c&oacute;digo');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Correo del autor');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Nombre del autor');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'bytes');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Categor&iacute;a');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'No proporcionaste un correo electr&oacute;nico pero revisaremos tu enlace a la mayor brevedad.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Descripci&oacute;n');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Descargas');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Env&iacute;e una descarga &uacute;nica solamente una vez.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Tama&ntilde;o de archivo');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'P&aacute;gina de Inicio');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'en bytes');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'IP del remitente');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'T&iacute;tulo');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Versi&oacute;n');

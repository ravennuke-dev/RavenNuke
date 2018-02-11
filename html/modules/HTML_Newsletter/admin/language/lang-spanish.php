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
/*************************************************************************
* All attempts are made to place defines into the Function and Section
* on the screen where it is used as well as in the order of placement on
* the screen reading left-to-right and then top-down.  In cases where a
* define is used on multiple screens, it may only be defined once, so the
* first Function/Section: will have the define in it.
************************************************************************/

/************************************************************************
* Function: Common Use Defines
************************************************************************/
define('_MSNL_COM_LAB_SQL', 'SQL');
define('_MSNL_COM_LAB_GOBACK', 'REGRESAR');
define('_MSNL_COM_LAB_ERRMSG', 'MENSAJE DE ERROR');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Sit&uacute;e el cursor sobre estos iconos para obtener texto de ayuda detallada ');
define('_MSNL_COM_LNK_GOBACK', 'Presione para volver a la p&aacute;gina anterior');
define('_MSNL_COM_ERR_SQL', 'SE ENCONTR&Oacute; UN ERROR EN SQL');
define('_MSNL_COM_ERR_MODULE', 'ERROR EN M&Oacute;DULO');
define('_MSNL_COM_ERR_VALMSG', 'LOS CAMPOS SIGUIENTES FALLARON LA VALIDACI&Oacute;N');
define('_MSNL_COM_ERR_VALWARNMSG', 'LOS CAMPOS SIGUIENTES MOSTRARON ADVERTENCIAS');
define('_MSNL_COM_ERR_DBGETCFG', '&iexcl;No se ha podido obtener LA informaci&oacute;n de configuraci&oacute;n del m&oacute;dulo!');
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Yes, that is how it is done!');
/************************************************************************
* Function: General Use Defines
************************************************************************/

define('_MSNL_COM_LAB_MODULENAME', 'HTML Newsletter');
define('_MSNL_LAB_ADMIN', 'Administraci&oacute;n');

//Module Menu Labels and Link Titles

define('_MSNL_LAB_CREATENL', 'Crear&nbsp;Bolet&iacute;n');
define('_MSNL_LAB_MAINCFG', 'Configuraci&oacute;n&nbsp;Principal');
define('_MSNL_LAB_CATEGORYCFG', 'Configuraci&oacute;n de&nbsp;Categor&iacute;as');
define('_MSNL_LAB_MAINTAINNLS', 'Mantener&nbsp;boletines');
define('_MSNL_LAB_SENDTESTED', 'Enviar&nbsp;comprobado');
define('_MSNL_LAB_SITEADMIN', 'Administraci&oacute;n del&nbsp;sitio');
define('_MSNL_LAB_NLARCHIVES', 'Archivos');
define('_MSNL_LAB_NLDOCS', 'Documentaci&oacute;n&nbsp;en l&iacute;nea');

define('_MSNL_LNK_CREATENL', 'Crear un bolet&iacute;n');
define('_MSNL_LNK_MAINCFG', 'Configurar opciones del m&oacute;dulo');
define('_MSNL_LNK_CATEGORYCFG', 'Mantener lista de categor&iacute;as de boletines');
define('_MSNL_LNK_MAINTAINNLS', 'Mantener boletines existentes');
define('_MSNL_LNK_SENDTESTED', 'Enviar el &uacute;ltimo bolet&iacute;n comprobado');
define('_MSNL_LNK_SITEADMIN', 'Ir al men&uacute; de administraci&oacute;n global');
define('_MSNL_LNK_NLARCHIVES', 'Ir a la lista de archivos de boletines');
define('_MSNL_LNK_NLDOCS', 'Ir a la documentaci&oacute;n en l&iacute;nea de HTML Newsletter');

define('_MSNL_ERR_NOTAUTHORIZED', 'No est&aacute;s autorizado para administrar este m&oacute;dulo');

//Common use Defines

define('_MSNL_COM_LAB_ACTIONS', 'Acciones');
define('_MSNL_COM_LAB_ACTIVE', 'Activo');
define('_MSNL_COM_LAB_ADD', 'AGREGAR');
define('_MSNL_COM_LAB_ALL', 'TODO');
define('_MSNL_COM_LAB_GO', 'IR');
define('_MSNL_COM_LAB_INACTIVE', 'Inactivo');
define('_MSNL_COM_LAB_LANG', 'Idioma');
define('_MSNL_COM_LAB_NO', 'No');
define('_MSNL_COM_LAB_PREVIEW', 'Previsualizar');
define('_MSNL_COM_LAB_SAVE', 'GUARDAR');
define('_MSNL_COM_LAB_SHOW_ALL', '**Mostrar todo**');
define('_MSNL_COM_LAB_SEND', 'Enviar');
define('_MSNL_COM_LAB_VERSION', 'Versi&oacute;n');
define('_MSNL_COM_LAB_YES', 's&iacute;');

define('_MSNL_COM_LNK_ADD', 'Presione para a&ntilde;adir los datos anteriores');
define('_MSNL_COM_LNK_CANCEL', 'Cancelar transacci&oacute;n');
define('_MSNL_COM_LNK_CONTINUE', 'Continuar la transacci&oacute;n');
define('_MSNL_COM_LNK_SAVE', 'Presione para guardar cualquier cambio a los datos anteriores');
define('_MSNL_COM_LNK_SEND', 'Enviar bolet&iacute;n');
define('_MSNL_COM_LNK_PREVIEW', 'Validar y previsualizar bolet&iacute;n');

define('_MSNL_COM_ERR_MSG', 'MENSAJE DE ERROR');
define('_MSNL_COM_ERR_DBGETCATS', 'No se han podido obtener las categor&iacute;as de bolet&iacute;n');
define('_MSNL_COM_ERR_FILENOTEXIST', 'El archivo no existe');
define('_MSNL_COM_ERR_FILENOTWRITEABLE', 'No se pudo escribir el archivo del bolet&iacute;n - Compruebe que los permisos sobre dicho directorio se establezcan a 777');
define('_MSNL_COM_ERR_DBGETPHPBB', 'No se pudo obtener la informaci&oacute;n de configuraci&oacute;n de phpBB');
define('_MSNL_COM_ERR_DBGETRECIPIENTS', 'No se pudo obtener el n&uacute;mero de recipientes para:');

define('_MSNL_COM_MSG_WARNING', '&iexcl;Advertencia!');
define('_MSNL_COM_MSG_UPDSUCCESS', '&iexcl;La actualizaci&oacute;n fue un &eacute;xito!');
define('_MSNL_COM_MSG_ADDSUCCESS', '&iexcl;A&ntilde;adir fue un &eacute;xito!');
define('_MSNL_COM_MSG_DELSUCCESS', '&iexcl;Eliminar fue un &eacute;xito!');
define('_MSNL_COM_MSG_REQUIRED', 'Debe asignarle un valor a los campos requeridos');
define('_MSNL_COM_MSG_POSNONZEROINT', 'Requiere un valor positivo diferente de cero');

define('_MSNL_COM_HLP_ACTIONS', 'Sit&uacute;e el cursor '
  .'sobre cada icono m&aacute;s abajo para ver qu&eacute; acciones se ejecutar&aacute;n si se hace clic en &eacute;l.'
  );
// For the visual copyright
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'View copyright and credits');
/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/

//Section: Letter

define('_MSNL_ADM_LAB_LETTER', 'Carta');
define('_MSNL_ADM_LAB_TOPIC', 'T&oacute;pico');
define('_MSNL_ADM_LAB_SENDER', 'Nombre del remitente');
define('_MSNL_ADM_LAB_NLSCAT', 'Categor&iacute;a');
define('_MSNL_ADM_LAB_TEXTBODY', 'Texto del bolet&iacute;n');
define('_MSNL_ADM_LAB_HTMLOK', '(Se permite c&oacute;digo HTML)');

define('_MSNL_ADM_HLP_TOPIC', 'Este texto rremplaza la etiqueta {EMAILTOPIC} en la '
  .'plantilla seleccionada. Como esta etiqueta normalmente en una linea con otras etiquetas, Lo mejor ser&iacute;a '
  .'mantenerla precisa y concisa - digamos unos 40 caracteres o menos.'
  );
define('_MSNL_ADM_HLP_SENDER', 'Este texto rremplaza la etiqueta {SENDER} en la '
  .'plantilla seleccionada.  Como esta etiqueta normalmente en una linea con otras etiquetas, Lo mejor ser&iacute;a '
  .'mantenerla concisa y personal - digamos, menos de 20 caracteres.'
  );
define('_MSNL_ADM_HLP_NLSCAT', 'Simplemente seleccione la categoria de bolet&iacute;n a la cual '
  .'pertenecer&aacute; este bolet&iacute;n. Las categor&iacute;as se pueden utilizar para organizar los boletines del sitio '
  .'en &aacute;reas especificas. Los boletines pueden listarse bajo sus respectivas '
  .'categor&iacute;as utilizando un interruptor bajo Configuraci&oacute;n Principal en las funciones de administrador.'
  );
define('_MSNL_ADM_HLP_TEXTBODY', 'Aqu&iacute; es donde va el texto principal de tu bolet&iacute;n. '
  .'Probablemente tenga sentido escribir tu contenido HTML an alg&uacute;n otro buen editor WYSIWYG '
  .'hasta que se muestre como realmente desea, y despu&eacute;s copie y pegue el c&oacute;digo HTML en esta &aacute;rea '
  .'de texto. Este c&oacute;digo HTML reemplazar&aacute; la etiqueta {TEXTBODY} en la plantilla seleccionada.<br /><br />'
  .'Se permite c&oacute;digo HTML, pero ser&iacute;a sabio considerar los lectores de correo de los destinatarios '
  .'y navegadores finales (Para los archivos) y asi asegurar los mejores resultados posibles para todos.<br /><br /> '
  .'Para textos de bolet&iacute;n largos, talvez desee utilizar etiquetas de anclaje para <span class="thick">marcar</span> '
  .'ciertas secciones. No olvide darles nombres descriptivos y luego seleccionar la casilla <span class="thick">Incluir Tabla de '
  .'Contenidos</span> y estos anclajes se convertir&aacute;n en enlaces dentro de la tabla de '
  .'contenidos dentro de su bolet&iacute;n! <br /><br />Por ejemplo, podriamos utilizar: '
  .'<span class="thick">& lt;a name=\'Primera Secci&oacute;n\'& gt;& lt;/a& gt;</span>. <span class="thick">NOTA:</span> Debe ser EXACTAMENTE como se muestra '
  .'con comillas dobles y el cierre de la etiqueta de anclaje! Este ejemplo producir&aacute; un enlace llamado '
  .'<span class="thick">Primer Secci&oacute;n</span> dentro de la tabla de contenidos y al presionar sobre el, llevar&aacute; '
  .'al visor hacia el anclaje dentro del texto.'
  );

//Section: Templates

define('_MSNL_ADM_LAB_TEMPLATES', 'Plantillas');
define('_MSNL_ADM_LAB_CHOOSETMPLT', 'Seleccione una plantilla');

define('_MSNL_ADM_LNK_SHOWTEMPLATE', 'Presione para visualizar una imagen de muestra de la plantilla');

define('_MSNL_ADM_HLP_TEMPLATES', 'La lista actual deriva de la actual '
  .'lista de directorios de plantillas bajo su directorio modules/HTML_Newsletter/templates/. '
  .'Si elijes trabajar <span class="thick">sin plantilla</span>, el sistema simplemente enviar&aacute; un correo a los recipientes '
  .'con el texto introducido anteriorm en el are de texto<span class="thick">Texto del bolet&iacute;n</span>.<br /><br />'
  .'Para crear un bolet&iacute;n desde una plantilla, seleccione una de la lista. Para ver un ejemplo de como '
  .'el bolet&iacute;n seleccionado se visualizar&aacute;, presione en el icono <span class="thick">Ver</span> a la derecha del '
  .'texto del nombre de la plantilla.<br /><br />Adicionalmente puede crear sus propias plantillas y col&oacute;quelas '
  .'en el directorio de plantillas.  <span class="thick">Pista:</span> Escoja como patr&oacute;n Fancy_Content ya que es la '
  .'&uacute;nica plantilla de muestra que el autor de esta herramienta continuar&aacute; actualizando con nuevos '
  .'lanzamientos del m&oacute;dulo HTML Newsletter!'
  );

//Section: Stats and Newsletter Contents

define('_MSNL_ADM_LAB_STATS', 'Estad&iacute;sticas y contenido del bolet&iacute;n');
define('_MSNL_ADM_LAB_INCLSTATS', 'Incluir estadisticas del sitio');
define('_MSNL_ADM_LAB_INCLTOC', 'Incluir Tabla de contenidos');

define('_MSNL_ADM_HLP_INCLSTATS', 'Al seleccionar esta opci&oacute;n se incluir&aacute;n las '
  .'estad&iacute;sticas clave de su sitio en las plantillas que tengan la etiqueta {STATS}. Observe las muestras de las plantillas '
  .'m&aacute;s arriba para hacerse una idea de como se mostrar&aacute;n las estad&iacute;sticas.'
  );
define('_MSNL_ADM_HLP_INCLTOC', 'Al seleccionar esta opci&oacute;n se incluir&aacute; un bloque de una Tabla de '
  .'Contenidos en las plantillas que tengan la etiqueta {TOC} - Puede ver la muestra de la plantilla '
  .'para Fancy_Content.  El bloque TOC tendr&aacute; enlaces a cada uno de los bloques de <span class="thick">&Uacute;ltimos xxxxxx</span> '
  .'as&iacute; como enlaces a alg&uacute;n otro <span class="thick">anclaje</span> inclu&iacute;do dentro del area de texto <span class="thick">Texto del bolet&iacute;n</span>.'
  );

//Section: Include Latest Items

define('_MSNL_ADM_LAB_INCLLATEST', 'Incluir &uacute;ltimos elementos');
define('_MSNL_ADM_LAB_INCLLATESTDLS', '&Uacute;ltimas descargas');
define('_MSNL_ADM_LAB_INCLLATESTWLS', '&Uacute;ltimos enlaces');
define('_MSNL_ADM_LAB_INCLLATESTFORS', '&Uacute;ltimos temas del foro');
define('_MSNL_ADM_LAB_INCLLATESTNEWS', '&Uacute;ltimos art&iacute;culos de noticias');
define('_MSNL_ADM_LAB_INCLLATESTREVS', '&Uacute;ltimas revisiones');

define('_MSNL_ADM_HLP_INCLLATESTNEWS', 'Controls the number of latest articles to show in the '
  .'newsletter.  The articles will be in chronological order starting with the most recent one '
  .'first. Use a value of 0 (zero) to not show the Latest News information in the newsletter. '
  .'Values entered here are retained from newsletter to newsletter, but you can change them '
  .'at any time for any newsletter.'
  );
define('_MSNL_ADM_HLP_INCLLATESTDLS', 'Controls the number of latest downloads to show in the '
  .'newsletter.  The downloads will be in chronological order starting with the most recent one '
  .'first. Use a value of 0 (zero) to not show the Latest Downloads information in the newsletter. '
  .'Values entered here are retained from newsletter to newsletter, but you can change them '
  .'at any time for any newsletter.'
  );
define('_MSNL_ADM_HLP_INCLLATESTWLS', 'Controls the number of latest web links to show in the '
  .'newsletter.  The web links will be in chronological order starting with the most recent one '
  .'first. Use a value of 0 (zero) to not show the Latest Web Links information in the newsletter. '
  .'Values entered here are retained from newsletter to newsletter, but you can change them '
  .'at any time for any newsletter.'
  );
define('_MSNL_ADM_HLP_INCLLATESTFORS', 'Controls the number of latest forum posts to show in the '
  .'newsletter.  The forum posts will be in chronological order starting with the most recent one '
  .'first. Use a value of 0 (zero) to not show the Latest Forum Posts information in the newsletter. '
  .'Values entered here are retained from newsletter to newsletter, but you can change them '
  .'at any time for any newsletter.  In addition, only publically available (read) forums have '
  .'their posts displayed.'
  );
define('_MSNL_ADM_HLP_INCLLATESTREVS', 'Controls the number of latest reviews to show in the '
  .'newsletter.  The reviews will be in chronological order starting with the most recent one '
  .'first. Use a value of 0 (zero) to not show the Latest Reviews information in the newsletter. '
  .'Values entered here are retained from newsletter to newsletter, but you can change them '
  .'at any time for any newsletter.'
  );

//Section: Sponsors

define('_MSNL_ADM_LAB_SPONSORS', 'Patrocinadores');
define('_MSNL_ADM_LAB_CHOOSESPONSOR', 'Escoja un patrocinador');
define('_MSNL_ADM_LAB_NOSPONSOR', 'Sin patrocinador');

define('_MSNL_ADM_HLP_CHOOSESPONSOR', 'Escojer un patrocinador reemplazar&aacute; la etiqueta {BANNER} '
  .'en la plantilla del bolet&iacute;n con la imagen seleccionada, enlace y texto alternativo desde '
  .'el sistema de banners'
  );

define('_MSNL_ADM_ERR_DBGETBANNERS', 'No se ha podido obtener la informaci&oacute;n del banner patrocinador');

//Section: Who to Send the Newsletter To

define('_MSNL_ADM_LAB_WHOSNDTO', '&iquest;A qui&eacute;n desea que el bolet&iacute;n sea enviado?');
define('_MSNL_ADM_LAB_CHOOSESENDTO', 'Escoja opci&oacute;n de recipente(s)');

define('_MSNL_ADM_LAB_WHOSNDTONLSUBS', 'Suscriptores del bolet&iacute;n solamente');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG', 'TODOS los usuarios registrados');
define('_MSNL_ADM_LAB_WHOSNDTOPAID', 'Suscriptores de pago solamente');
define('_MSNL_ADM_LAB_WHOSNDTOANONY', 'TODOS los visitantes del sitio - No se env&iacute;a ning&uacute;n correo, pero '
  .'cualquier vivitante puede ver el bolet&iacute;n'
  );
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS', 'Uno o m&aacute;s grupos NSN - Escoja los grupos a continuaci&oacute;n');
define('_MSNL_ADM_LAB_WHOSNDTOADM', 'Correo de prueba (Para el administrador solamente)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS', 'usuarios suscritos');
define('_MSNL_ADM_LAB_USERS', 'Usuarios');
define('_MSNL_ADM_LAB_PAIDUSRS', 'usuarios de pago');
define('_MSNL_ADM_LAB_NSNGRPUSRS', 'Usuarios de grupos NSN');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC', 'Lista de correo distribu&iacute;da');
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)');
define('_MSNL_ADM_LAB_WHOSNDTOANONYV', 'TODOS los visitantes del sitio');

define('_MSNL_ADM_HLP_WHOSNDTONLSUBS', 'Esta opci&oacute;n enviar&aacute; el bolet&iacute;n '
  .'a todos los usuarios que se han suscrito al bolet&iacute;n del sitio a trav&eacute;s de su '
  .'panel de preferencias de usuario.'
  );
define('_MSNL_ADM_HLP_WHOSNDTOALLREG', 'Esta opci&oacute;n enviar&aacute; el bolet&iacute;n '
  .'a todos los usuarios registrados. Sea cuidadoso al utilizar esta opci&oacute;n ya que los usuarios pueden no '
  .'apreciar que se les env&iacute;e un bolet&iacute;n al que no se han suscrito.'
  );
define('_MSNL_ADM_HLP_WHOSNDTOPAID', 'Esta opci&oacute;n enviar&aacute; el bolet&iacute;n '
  .'a todos los suscriptores de pago del sitio - Ej., Aquellos con suscripciones activas.'
  );
define('_MSNL_ADM_HLP_NSNGRPUSRS', 'Esta opci&oacute;n le permitir&aacute; seleccionar '
  .'uno o m&aacute;s grupos NSN a quienes enviar el bolet&iacute;n.'
  );
define('_MSNL_ADM_HLP_WHOSNDTOANONYV', 'Esta opci&oacute;n no enviar&aacute; un bolet&iacute;n '
  .'m&aacute;sbien mostrar&aacute; el bolet&iacute;n en el bloque y en el archivo. Sin embargo, '
  .'tenga en cuenta que los permisos del bloque y el m&oacute;dulo a&uacute;n deben establecerse en la forma deseada.'
  );
define('_MSNL_ADM_HLP_WHOSNDTOADM', 'Esta opci&oacute;n enviar&aacute; un bolet&iacute;n de prueba '
  .'a USTED - un administrador del sitio - SOLAMENTE. Una vez se haya asegurado que el bolet&iacute;n est&eacute; listo para '
  .'ser enviado a los destinatarios deseados, utilice el enlace <span class="thick">Enviar Comprobado</span> en la '
  .'parte superior de esta p&aacute;gina.'
  );
define('_MSNL_ADM_HLP_WHOSNDTOADHOC', 'Esta opci&oacute;n le permitir&aacute; enviar el '
  .'bolet&iacute;n a una o m&aacute;s direcciones de correo de su preferencia. Simplemente debe separar '
  .'cada direcci&oacute;n con una coma, igualmente debe asegurarse que las direcciones sean v&aacute;lidas.'
  );

//Section: NSN Groups

define('_MSNL_ADM_LAB_CHOOSENSNGRP', '&iquest;A Cu&aacute;les Grupos NSN enviar?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1', '(La selecci&oacute;n ser&aacute; ignorada si la opci&oacute;n Grupos NSN '
  .'no fue seleccionada m&aacute;s arriba)'
  );
define('_MSNL_ADM_LAB_WHONSNGRP', 'Escojer uno o m&aacute;s grupos');

define('_MSNL_ADM_ERR_DBGETNSNGRPS', 'No fue posible obtener la informaci&oacute;n de Grupos NSN');

define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS', 'Escoja uno o m&aacute;s grupos a continuaci&oacute;n. El bolet&iacute;n '
  .'ser&aacute; enviado a todos los usuarios pertenecientes al grupo seleccionado. Si un usuario est&aacute; '
  .'presente en m&aacute;s de un grupo, el bolet&iacute;n le ser&aacute; enviado solamente una vez.'
  );

/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/

define('_MSNL_ADM_PREV_LAB_VALPREVNL', 'Crear bolet&iacute;n, validar y previsualizar');
define('_MSNL_ADM_PREV_LAB_PREVNL', 'Previsualizar bolet&iacute;n');

define('_MSNL_ADM_PREV_MSG_SUCCESS', 'El bolet&iacute;n ha sido validado y est&aacute; listo '
  .'para ser visualizado');

/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/

define('_MSNL_ADM_LAB_NSNGRPS', 'Grupos NSN');

define('_MSNL_ADM_VAL_NONSNGRP', 'Has optado por enviar a un Grupo NSN pero '
  .'no has selecionado un grupo al cualr enviar'
  );

define('_MSNL_ADM_ERR_NOTEMPLATE', 'Posible intento de hackeo - no se ha elegido una plantilla');
define('_MSNL_ADM_ERR_NOSENDTO', 'Posible intento de hackeo - no se ha seleccionado a quien enviar');

define('_MSNL_ADM_ERR_DBUPDLATEST', 'Ha ocurrido un error actualizando la informaci&oacute;n de configuraci&oacute;n de \'&Uacute;ltimos _____\'');

/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/

define('_MSNL_ADM_SEND_LAB_SENDNL', 'Crear bolet&iacute;n - Enviar Correo');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM', 'Probar bolet&iacute;n de');
define('_MSNL_ADM_SEND_LAB_NLFROM', 'Bolet&iacute;n de');

define('_MSNL_ADM_SEND_MSG_ANONYMOUS', 'El bolet&iacute;n fue agregado para mque todos los vivitantes lo vean');
define('_MSNL_ADM_SEND_MSG_LOTSSENT', 'M&aacute;s de 500 usuarios recivir&aacute;n el '
  .'bolet&iacute;n, esto puede tardar 10 minutos o m&aacute;s y PHP puede agotar el tiempo de espera.'
  );
define('_MSNL_ADM_SEND_MSG_TOTALSENT', 'Total de correos enviados');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS', 'Los correos del bolet&iacute;n fueron enviados exitosamente');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE', 'El envio de correos del bolet&iacute;n ha fallado');

define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL', 'No se ha encontrado el archivo testemail.php');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW', 'Invalid view option provided');
define('_MSNL_ADM_SEND_ERR_CREATENL', 'No se ha podido copiar desde testemail hacia '
  .'el archivo del bolet&iacute;n'
  );
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT', 'No se ha podido insertar el bolet&iacute;n en '
  .'la base de datos'
  );
define('_MSNL_ADM_SEND_ERR_DBNLSNID', 'No se ha podido obtener el NID del bolet&iacute;n '
  .'recien insertado'
  );
define('_MSNL_ADM_SEND_ERR_MAIL', 'La funci&oacute;n PHP mail ha fallado - no se ha podido enviar '
  .'el bolet&iacute;n a:'
  );
define('_MSNL_ADM_SEND_ERR_DELFILETEST', 'No se ha podido eliminar el archivo testemail.php');
define('_MSNL_ADM_SEND_ERR_DELFILETMP', 'No se ha podido eliminar el archivo tmp.php');

/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/

define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de usuarios');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS', 'No se han pidido recuperar las estad&iacute;sticas para el total de impresiones del sitio');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de art&iacute;culos de noticias');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de categor&iacute;as de noticias');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de descargas');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de categor&iacute;as de descargas');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de enlaces');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de categor&iacute;as de enlacesnumber of web link categories');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de foros');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de mensajes en el foro');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS', 'No se han pidido recuperar las estad&iacute;sticas para el n&uacute;mero de revisiones');

define('_MSNL_ADM_SEND_ERR_DBGETNEWS', 'No es posible recuperar art&iacute;culos de noticias m&aacute;s recientes');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS', 'No es posible recuperar descargas m&aacute;s recientes');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS', 'No es posible recuperar enlaces m&aacute;s recientes');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS', 'No es posible recuperar mensajes del foro m&aacute;s recientes');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS', 'No es posible recuperar revisiones m&aacute;s recientes');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER', 'No es posible recuperar el banner');

/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/

define('_MSNL_ADM_TEST_LAB_PREVNL', 'Previsualizar bolet&iacute;n comprobado para enviar');

/************************************************************************
* Function: msnl_cfg (Main Configuration Options)
************************************************************************/

define('_MSNL_CFG_LAB_MAINCFG', 'Configuraci&oacute;n principal del m&oacute;dulo');

//Module Options

define('_MSNL_CFG_LAB_MODULEOPT', 'Opciones del M&oacute;dulo');
define('_MSNL_CFG_LAB_DEBUGMODE', 'Modo de depuraci&oacute;n');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF', 'DESACTIVADO');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR', 'ERROR');
define('_MSNL_CFG_LAB_DEBUGMODE_VER', 'VERBOSE');
define('_MSNL_CFG_LAB_DEBUGOUTPUT', 'Salida de depuraci&oacute;n');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS', 'MOSTRAR');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG', 'ARCHIVO DE REGISTRO');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH', 'AMBOS');
define('_MSNL_CFG_LAB_SHOWBLOCKS', 'Mostrar bloques derechos');
define('_MSNL_CFG_LAB_NSNGRPS', 'Usar grupos NSN');
define('_MSNL_CFG_LAB_DLMODULE', 'Nombre del m&oacute;dulo de descargas');
define('_MSNL_CFG_LAB_WYSIWYGON', 'Usar editor WYSIWYG');
define('_MSNL_CFG_LAB_WYSIWYGROWS', 'Filas de contenido');

define('_MSNL_CFG_HLP_DEBUGMODE', 'Esto le permite al administrador del m&oacute;dulo establecer varios niveles de '
  .'mensajer&iacute;a de depuraci&oacute;n del siguiente modo:<br /><strong>DESACTIVADO</strong> = Solo mensajes de error a nivel de la aplicacion'
  .', los detalles no ser&aacute;n mostrados.<br /><strong>ERROR</strong> = Los errores de aplicaci&oacute;n '
  .'ser&aacute;n mostrados, conjunto con &uacute;tiles mensajes de depuraci&oacute;n. Errores SQL tambi&eacute;n '
  .'mostrar&aacute;n el mensaje de error SQL actual y el SQL generado.<br /> <strong>VERBOSE</strong> '
  .'= Se mostrar&aacute;n mensajes muy detallados en toda la aplicaci&oacute;n, incluyendo nombres de rutas '
  .'(Aseg&uacute;rese de no activar esta opci&oacute;n por mucho tiempo en un sitio muy activo '
  .'ya que esto puede proveer mucha informacion bastante &uacute;til a un atacante!). <span class="thick">NOTA: Los correos '
  .'no ser&aacute;n enviados utilizando esta opci&oacute;n</span> - Muy &uacute;til para prop&oacute;sitos de depuraci&oacute;n.'
  );
define('_MSNL_CFG_HLP_DEBUGOUTPUT', 'Esta opci&oacute;n no se utiliza en este momento. En el futuro '
  .'proveer&aacute; la habilidad de mostrar los anteriores mensajes de depuraci&oacute;n ya sea al navegador, a un archivo '
  .'de registro, o ambos.'
  );
define('_MSNL_CFG_HLP_SHOWBLOCKS', 'Si esta opci&oacute;n est&aacute; <strong>actidava</strong> se mostrar&aacute;n los '
  .'bloques derechos en el m&oacute;dulo. Si esta opci&oacute;n est&aacute; <strong>desactivada</strong> no se mostrar&aacute;n '
  .'los bloques derechos. El valos predeterminado es <strong>desactivada</strong>.'
  );
define('_MSNL_CFG_HLP_NSNGRPS', 'Esta opci&oacute;n solo puede ser usada si tienes '
  .'instalado el agregado NSN Groups. Si quieres enviar boletines '
  .'a uno o m&aacute;s grupos NSN, seleccione esta opci&oacute;n.'
  );
define('_MSNL_CFG_HLP_DLMODULE', 'Reemplace esto con la extensi&oacute;n apropiada '
  .'del m&oacute;dulo, ej. el m&oacute;dulo predeterminado es \'downloads\' from nuke_'
  .'<strong>downloads</strong>_downloads. Para el m&oacute;dulo NSN GR Downloads, es \'nsngd\' '
  .'from nuke_<strong>nsngd</strong>_downloads.'
  );
define('_MSNL_CFG_HLP_WYSIWYGON', 'Seleccione esta opci&oacute;n si desea utilizar el editor WYSIWYG '
  .'para editar el contenido del bolet&iacute;n (textbody).  <strong>NOTA:</strong> Esta '
  .'opci&oacute;n rquiere que el agregado nukeWYSIWYG est&eacute; instalado.'
  );
define('_MSNL_CFG_HLP_WYSIWYGROWS', 'Esto cxontrola el n&uacute;mero de filas que '
  .'estar&aacute;n disponibles en la p&aacute;gina Crear Bolet&iacute;n dentro del Contenido del Bolet&iacute;n '
  .'(textbody). Esto funciona est&eacute; o no habilitado WYSIWYG.'
  );

//Show Options

define('_MSNL_CFG_LAB_SHOWOPT', 'Mostrar opciones');
define('_MSNL_CFG_LAB_SHOWCATS', 'Mostrar categor&iacute;as');
define('_MSNL_CFG_LAB_SHOWHITS', 'Mostrar hits');
define('_MSNL_CFG_LAB_SHOWDATES', 'mostrar la fecha de env&iacute;o');
define('_MSNL_CFG_LAB_SHOWSENDER', 'Mostrar remitente');

define('_MSNL_CFG_HLP_SHOWCATS', 'Si est&aacute; seleccionado, se mostrar&aacute;s los boletines bajo '
  .'sus respectivas categor&iacute;as en el bloque. las categor&iacute;as siempre ser&aacute;n mostradas '
  .'en el Archivo (m&oacute;dulo).'
  );
define('_MSNL_CFG_HLP_SHOWHITS', 'Si est&aacute; seleccionado, se mostrar&aacute; el n&uacute;mero '
  .'de lecturas (hits) que reciba eun bolet&iacute;n en el bloque o en el Archivo (m&oacute;dulo).'
  );
define('_MSNL_CFG_HLP_SHOWDATES', 'Si est&aacute; seleccionado, se mostrar&aacute; la fecha en que '
  .'cada bolet&iacute;n fue enviado tanto en el bloque como en el Archivo (m&oacute;dulo).'
  );
define('_MSNL_CFG_HLP_SHOWSENDER', 'Si est&aacute; seleccionado, se mostrar&aacute; el remitente quien '
  .'envi&oacute; cada bolet&iacute;n tanto en el bloque como en el Archivo (m&oacute;dulo).'
  );

//Block Options

define('_MSNL_CFG_LAB_BLKOPT', 'Opciones del bloque');
define('_MSNL_CFG_LAB_BLKLMT', 'Boletines a mostarr en el bloque');
define('_MSNL_CFG_LAB_SCROLL', 'Utilizar c&oacute;digo de deslizamiento en el bloque');
define('_MSNL_CFG_LAB_SCROLLHEIGHT', 'Altura del c&oacute;digo de deslizamiento');
define('_MSNL_CFG_LAB_SCROLLAMT', 'Cantidad de desplazamiento');
define('_MSNL_CFG_LAB_SCROLLDELAY', 'Demora en el desplazamiento');

define('_MSNL_CFG_HLP_BLKLMT', 'Limita el n&uacute;mero TOTAL de boletines '
  .'a mostrar en el bloque. Si las categor&iacute;as est&aacute;n activadas, el n&uacute;mero de boletines '
  .'a mostrar en un categor&iacute;a particular requiere configuraci&oacute;n por separado.'
  );
define('_MSNL_CFG_HLP_SCROLL', 'Esta caracter&iacute;stica permite que la informaci&oacute;n del bloque '
  .'se desplace hacia arriba en el bloque'
  );
define('_MSNL_CFG_HLP_SCROLLHEIGHT', 'Establece la altura del area de desplazamiento en '
  .'p&iacute;xeles, el valor predeterminado es 180. Tenga cuidado, si usa un valor muy peque&ntilde;o no podr&aacute;s ver nada.'
  );
define('_MSNL_CFG_HLP_SCROLLAMT', 'Establece la cantidad de desplazamiento, '
  .'esto es en efecto la distancia que la informaci&oacute;n se mover&aacute; en el tiempo de demora. '
  .'El valor predeterminado es 2.'
  );
define('_MSNL_CFG_HLP_SCROLLDELAY', 'establece la demora de desplazamiento, '
  .'esto se refiere al tiempo que la informaci&oacute;n espera antes de moverse nuevamente en milisegundos. El valorpredeterminado es 25.'
  );

/************************************************************************
* Function: msnl_cfg_apply (Apply Changes to Main Configuration)
************************************************************************/

define('_MSNL_CFG_APPLY_ERR_DBFAILED', 'La actualizaci&oacute;n de la informaci&oacute;n de configuraci&oacute;n ha fallado');

define('_MSNL_CFG_APPLY_VAL_DEBUGMODE', 'Se ha proporcionado un modo de depuraci&oacute;n inv&aacute;lido - Puede haber '
  .'problemas con la instalaci&oacute;n del m&oacute;dulo'
  );
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT', 'Se ha proporcionado una salida de depuraci&oacute;n inv&aacute;lida - Puede haber '
  .'problemas con la instalaci&oacute;n del m&oacute;dulo'
  );

define('_MSNL_CFG_APPLY_MSG_BACK', 'Regresar a la p&aacute;gina principal de configuraci&oacute;n');

/************************************************************************
* Function: msnl_cat (Maintain Newsletter Categories)
************************************************************************/

define('_MSNL_CAT_LAB_CATCFG', 'Configuraci&oacute;n de las categor&iacute;as de bolet&iacute;n');

define('_MSNL_CAT_LAB_ADDCAT', 'AGREGAR CATEGOR&Iacute;A');
define('_MSNL_CAT_LAB_CATTITLE', 'T&iacute;tulo de la categor&iacute;a');
define('_MSNL_CAT_LAB_CATDESC', 'Descrpci&oacute;n de la categor&iacute;a');
define('_MSNL_CAT_LAB_CATBLOCKLMT', 'L&iacute;mite del bloque');

define('_MSNL_CAT_LNK_ADDCAT', 'Agergar una nueva categor&iacute;a de bolet&iacute;n');
define('_MSNL_CAT_LNK_CATCHG', 'Editar categor&iacute;a del bolet&iacute;n');
define('_MSNL_CAT_LNK_CATDEL', 'Eliminar categor&iacute;a del bolet&iacute;n');

define('_MSNL_CAT_MSG_CATBACK', 'Regresar a la lista de categorias del bolet&iacute;n');

define('_MSNL_CAT_ERR_DBGETCAT', 'No se ha podido obtener informaci&oacute;n de las categor&iacute;as del bolet&iacute;n');
define('_MSNL_CAT_ERR_DBGETCATS', 'No se han podido obtener las categor&iacute;as del bolet&iacute;n');
define('_MSNL_CAT_ERR_NOCATS', 'No se han encontrado categor&iacute;as - gran problema con la instalaci&oacute;n');
define('_MSNL_CAT_ERR_INVALIDCID', 'Se ha proporcionado un ID inv&aacute;lido de la categor&iacute;a del bolet&iacute;n');
define('_MSNL_CAT_ERR_DBGETCNT', 'Obtener la cuenta de boletines fallidos');

define('_MSNL_CAT_HLP_CATTITLE', 'Este campo es el t&iacute;tulo de la categor&iacute;a la cual '
  .'se mostrar&aacute; tanto en el bloque (Si se ha habilitado desde las opciones de configuraci&oacute;n) y el archivo del '
  .'bolet&iacute;n. Dado que sto es lo que se utilizar&aacute; en el bloque para agrupar boletines '
  .'debe mantener el tama&ntilde;o del t&iacute;tulo sobre 30 caracteres o menos para que el bloque se muestre '
  .'apropiadamente.'
  );
define('_MSNL_CAT_HLP_CATDESC', 'Este es un campo bastante largo. La &uacute;nica restricci&oacute;n '
  .'es no agregar c&oacute;digo HTML. Se le dejar&aacute; hacerlo, pero ser&aacute;n eliminadas '
  .'m&aacute;s tarde. Inserte una buena y completa descripci&oacute;n de esta categor&iacute;a del bolet&iacute;n.'
  );
define('_MSNL_CAT_HLP_CATBLOCKLMT', 'Este campo es utilizado solamente si la opci&oacute;n <span class="thick">mostrar categor&iacute;as</span> '
  .'est&aacute; seleccionada, adem&aacute;s debe ser superior a cero. Introduzca aqu&iacute; el n&uacute;mero de '
  .'boletines que se mostrar&aacute;n bajo esta categor&iacute;a en el bloque. <span class="thick">Si no se proporciona '
  .'un valor, se prdeterminar&aacute; a '
  );

/************************************************************************
* Function: msnl_cat_add
************************************************************************/

define('_MSNL_CAT_ADD_LAB_CATADD', 'Configuraci&oacute;n de categor&iacute;as del bolet&iacute;n - Agergar categor&iacute;a');

/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/

define('_MSNL_CAT_ADD_APPLY_DBCATADD', 'No se ha podido agregar una nueva categor&iacute;a');

/************************************************************************
* Function: msnl_cat_chg
************************************************************************/

define('_MSNL_CAT_CHG_LAB_CATCHG', 'Configuraci&oacute;n de categor&iacute;as del bolet&iacute;n - Cambiar categor&iacute;a');

define('_MSNL_CAT_CHG_MSG_CHGIMPACT', 'Boletines(s) ser&aacute;n impactados por este cambio');

/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/

define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG', 'No se ha podido actualizar la categor&iacute;a del bolet&iacute;n');

/************************************************************************
* Function: msnl_cat_del
************************************************************************/

define('_MSNL_CAT_DEL_MSG_DELIMPACT', 'Boletines(s) ser&aacute;n impactados por esta eliminaci&oacute;n.');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1', 'Los boletines impactados ser&aacute;n reasignados a la '
  .'categor&iacute;a predeterminada "Boletines sin asignar". &iquest;Desea continuar con esta eliminaci&oacute;n?'
  );

/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/

define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN', 'No se han podido reasignar los boletines');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE', 'No se ha podidoeliminar la categoria del bolet&iacute;n');

/************************************************************************
* Function: msnl_nls
************************************************************************/

define('_MSNL_NLS_LAB_NLSCFG', 'Maintain Newsletters');
define('_MSNL_NLS_LAB_CURRENTCAT', 'Categor&iacute;a actual');
define('_MSNL_NLS_LAB_DATESENT', 'Fecha de env&iacute;o');
define('_MSNL_NLS_LAB_CATEGORY', 'Categor&iacute;a');

define('_MSNL_NLS_LNK_GETNLS', 'Obtener boletines solicitados');
define('_MSNL_NLS_LNK_VIEWNL', 'Ver bolet&iacute;n - mpuede abrir una nueva ventana');
define('_MSNL_NLS_LNK_NLSCHG', 'Editar informaci&oacute;n del bolet&iacute;n');
define('_MSNL_NLS_LNK_NLSDEL', 'Eliminar bolet&iacute;n');

define('_MSNL_NLS_MSG_NONLSS', 'No se han encontrado boletines bajo esta categor&iacute;a');
define('_MSNL_NLS_MSG_NLSBACK', 'Regresar a la lista de boletines');

define('_MSNL_NLS_ERR_DBGETNLSS', 'No se han podido obtener boletines');
define('_MSNL_NLS_ERR_DBGETNLS', 'No se ha podido obtener la informaci&oacute;n del bolet&iacute;n');

define('_MSNL_NLS_ERR_INVALIDNID', 'Se ha proporcionado un ID de bolet&iacute;n inv&aacute;lido');
define('_MSNL_NLS_ERR_NONLSS', 'No se han encontrado boletines - gran problema con la instalaci&oacute;n');

/************************************************************************
* Function: msnl_nls_chg
************************************************************************/

define('_MSNL_NLS_CHG_LAB_NLSCHG', 'MAntener boletines - Cambiar informaci&oacute;n del bolet&iacute;n');
define('_MSNL_NLS_CHG_LAB_DATESENT', 'Fecha de env&iacute;o');
define('_MSNL_NLS_CHG_LAB_WHOVIEW', 'Quien puede ver el bolet&iacute;n');
define('_MSNL_NLS_CHG_LAB_NSNGRPS', 'Grupos NSN pueden ver el bolet&iacute;n');
define('_MSNL_NLS_CHG_LAB_NBRHITS', 'N&uacute;mero de Hits');
define('_MSNL_NLS_CHG_LAB_FILENAME', 'Nombre de archivo del bolet&iacute;n');
define('_MSNL_NLS_CHG_LAB_CAUTION', 'Cambie los siguientes valores s&oacute;lo si sabe lo que est&aacute; haciendo');

define('_MSNL_NLS_CHG_HLP_DATESENT', 'Actualmente, la fecha debe ser introducida en este formato '
  .'YYYY-MM-DD como se muestra en este campo. Cuando un bolet&iacute;n se crea por primera vez y es enviado, '
  .'este campo es rellenado con la fecha actual del sistema. Los boletines siempre son listados '
  .'ordenados por fecha con el m&aacute;s reciente en la parte superior de la lista.'
  );
define('_MSNL_NLS_CHG_HLP_WHOVIEW', 'Este campo es asignado por el sistema - Tenga cuidado al '
  .'cambiarlo! Valores v&aacute;lidos son:'
  .'<br /><strong>0</strong> = an&oacute;nimo - todos lo pueden ver'
  .'<br /><strong>1</strong> = todos los usuarios registrados'
  .'<br /><strong>2</strong> = suscriptores del bolet&iacute;n solamente'
  .'<br /><strong>3</strong> = miembros de pago solamente'
  .'<br /><strong>4</strong> = Grupos NSN seleccionados solamente'
  .'<br /><strong>5</strong> = lista distribuida'
  .'<br /><strong>99</strong> = administrador del sistema solamente.'
  );
define('_MSNL_NLS_CHG_HLP_NSNGRPS', 'Requiere que la anterior opci&oacute;n <span class="thick">ver</span> '
  .'se establezca a 4 para *Grupos NSN solamente*. Cada grupo NSN tiene asociado un n&uacute;mero de ID espec&iacute;fico '
  .'a &eacute;l. Al momento de crear/enviar un bolet&iacute;n, se pueden escojer uno o m&aacute;s grupos NSN para '
  .'enviar. Para un solo grupo, este campo solamente debe tener el n&uacute;mero de ID asociado al grupo. '
  .'Para m&aacute;s de un grupo, cada ID de grupo debe ser separado por un gui&oacute;n, ej. <span class="thick">1-2-3</span>.'
  );
define('_MSNL_NLS_CHG_HLP_NBRHITS', 'Cuando un bolet&iacute;n es visto desde el sitio utilizando '
  .'un enlace del bloque o un enlace del archivo, el contador de lecturas es incrementado. '
  .'El contador de lecturas NO es incrementado si se ha iniciado sesi&oacute;n como administrador.'
  );
define('_MSNL_NLS_CHG_HLP_FILENAME', 'Este campo es asignado por el sistema. Si es cambiado, '
  .'aseg&uacute;rese que el archivo existe y est&aacute; formateado apropiadamente para ser visto por este sistema.'
  );

/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/

define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW', 'El valor debe estar entre 0 - 4, &oacute; 99');

define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG', 'No se ha podido actualizar la informaci&oacute;n del bolet&iacute;n');

/************************************************************************
* Function: msnl_nls_del
************************************************************************/

define('_MSNL_NLS_DEL_MSG_DELIMPACT', 'Est&aacute; a punto de eliminar definitivamente este bolet&iacute;n.');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1', 'Toda la informaci&oacute;n relacionada con este bolet&iacute;n ser&aacute; '
  .'eliminada de la base de datos as&iacute; como el archivo del bolet&iacute;n dentro del directorio del archivo. '
  .'&iquest;Desea continuar con esta eliminaci&oacute;n?'
  );

/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/

define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL', 'No se ha podido eliminar el archivo del bolet&iacute;n - Revise los '
  .'permisos del archivo'
  );

define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL', 'No se ha podido eliminar la informaci&oacute;n del bolet&iacute;n');


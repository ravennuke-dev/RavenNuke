<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to my website and send to me      */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
define('_ADCLASS','Clase de Anuncio');
define('_ADCODE','C&oacute;digo Javascript/HTML');
define('_ADDADVERTISINGPLAN','Agregar Plan de Publicidad');
define('_ADDEDDATE','Fecha Agregada');
define('_ADDNEWPLAN','Agregar Nuevo Plan');
define('_ADDNEWPOSITION','Agregar Posiciones de Publicidad');
define('_ADDPLANERROR','<span class="thick">Error:</span> uno o m&aacute;s campos est&aacute;n vac&iacute;os. Por favor, vuelva atr&aacute;s y corrija el problema.');
define('_ADDPOSITION','Agregar Posici&oacute;n');
define('_ADFLASH','Flash');
define('_ADIMAGE','Im&aacute;gen');
define('_ADINFOINCOMPLETE','<span class="thick">Error:</span> La informacion del banner est&aacute; incompleta!');
define('_ADPOSITIONS','Pisiciones de los Anuncios');
define('_ADSMODULEINACTIVE','[ ADVERTENCIA: El m&oacute;dulo Advertising est&aacute; inactivo! ]');
define('_ADSNOCLIENT','<span class="thick">Error:</span> No hay ning&uacute;n cliente de publicidad.<br />Por favor crea un nuevo cliente antes de agregar un banner.');
define('_ADVERTISINGPLANEDIT','Editar Planes de Publicidad');
define('_ADVERTISINGPLANS','Planes de Publicidad');
define('_ASSIGNEDADS','Anuncios Asignados');
define('_BANNERNAME','Nombre del Banner');
define('_CANTDELETEPOSITION','<span class="thick">Error:</span> No puedes eliminar TODAS las posiciones. Al menos una debe existir en la base de datos.<br />Edita la posici&oacute;n si necesitas cambiarla o agrega una nueva');
define('_CLASS','Clase');
define('_CLASSNOTE','Si la clase de anuncio es c&oacute;digo Javascript/HTML los siguientes 4 campos ser&aacute;n ignorados y s&oacute;lo se tomar&aacute; en cuenta el &aacute;rea de c&oacute;digo a continuaci&oacute;n. Si la clase de anuncio es Flash debes poner la UEL completa del archivo .SWF en el siguiente campo y establecer el alto y ancho de la pelicula Flash (Los campos URL del Click y Texto Alternativo ser&aacute;n ignorados).');
define('_CLIENT','Cliente');
define('_COUNTRYNAME','Nombre de Tu Pa&iacute;s');
define('_CURRENTPOSITIONS','Actuales Posiciones de Anuncios');
define('_DELETEALLADS','Eliminar Todos los Banners');
define('_DELETEPLAN','Eliminar Plan de Anuncios');
define('_DELETEPOSITION','Eliminar posici&oacute;n de Anuncios');
define('_DELIVERY','Modo de Entrega');
define('_DELIVERYQUANTITY','Cantidad de Entrega');
define('_DELIVERYTYPE','Modo de Entrega');
define('_EDITPOSITION','Editar Posici&oacute;n de Publicidad');
define('_EDITTERMS','Editar Condiciones del Servicio');
define('_FLASHFILEURL','URL del Archivo Flash');
define('_FLASHSIZE','Tama&ntilde;o de la Pel&iacute;cula Flash');
define('_HEIGHT','Alto');
define('_IMAGESIZE','Tama&ntilde;o de la Im&aacute;gen');
define('_IMAGESWFURL','URL de la Imagen o el Archivo Flash');
define('_IMPMADE','Impresiones Hechas');
define('_IMPPURCHASED','Impresiones Compradas');
define('_INITIALSTATUS','Estado Inicial');
define('_INPIXELS','(tama&ntilde;o en pixeles)');
define('_MOVEADS','Mover anuncios a');
define('_MOVEDADSSTATUS','nuevo estado de los archivos movidos');
define('_NOCHANGES','Sin Cambios');
define('_PDAYS','D&iacute;as');
define('_PLANBUYLINKS','Comprar Enlaces');
define('_PLANDESCRIPTION','Descripci&oacute;n del Plan');
define('_PLANNAME','Nombre del Plan');
define('_PLANSNOTE','Los planes son solo de referencia, se publicar&aacute;n en el m&oacute;dulo Advertising a fin de que los clientes sepan lo que se est&aacute; ofreciendo, las condiciones, los precios y un enlace para pagar sus servicios.');
define('_PLANSPRICES','Planes y Precios');
define('_PMONTHS','Meses');
define('_POSEXAMPLE','Puedes echar un vistazo al archivo <span class="italic">/blocks/block-Advertising.php</span> y al archivo <span class="italic">/header.php</span> para tener un claro ejemplo de como implementar esto en el sitio.');
define('_POSINFOINCOMPLETE','<span class="thick">Error:</span> El campo Nombde de la Posici&oacute;n de Publicidad no puede estar en blanco.');
define('_POSITIONHASADS','La posici&oacute;n de anuncios seleccionada para ser eliminada contiene banners asignados.<br />Por favor seleccione una nueva posicion hacia donde mover todos los anuncios.');
define('_POSITIONNAME','Nombre de la Posici&oacute;n');
define('_POSITIONNOTE','Pra usar esta posici&oacute;n debes incluir el c&oacute;digo: <span class="italic"> ads(position);</span> en el archivo del tema, donde \'position\' es el n&uacute;mero de la posici&oacute;n deseada.');
define('_POSITIONNUMBER','N&uacute;mero de la Posici&oacute;n');
define('_PRICE','Precio');
define('_PYEARS','A&ntilde;os');
define('_SAVEPOSITION','Guardar Cambios');
define('_SITENAMEADS','(Para incrustar el nombre del sitio en el texto utilice [sitename] y para usar el nombre de tu pa&iacute;s escriba [country] en el texto ya que estos ser&aacute;n reemplazados en el m&oacute;dulo Advertising)');
define('_SURETODELPLAN','Est&aacute;s a punto de eliminar un Plan de Publicidad. &iquest;Est&aacute;s seguro que deseas proceder?');
define('_SURETODELPOSITION','Est&aacute;s a punto de eliminar una Posici&oacute;n de Anuncios. &iquest;Est&aacute;s seguro que deseas proceder?');
if (!defined('_TERMS')) define('_TERMS','Condiciones');
define('_TERMSNOTE','Revise cuidadosamente las condiciones por defecto. Cambie cualquier cosa que desee cambiar de acuerdo con su pol&iacute;tica de publicidad. Esto ser&aacute; publicado en el m&oacute;dulo Advertising.');
define('_TERMSOFSERVICEBODY','Cuerpo de las Condiciones de Servicio');
define('_WIDTH','Ancho');
define('_XFORUNLIMITED','escriba X para ilimitado');

?>
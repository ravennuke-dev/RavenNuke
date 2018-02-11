<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to the site and send to me        */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
global $anonwaitdays, $outsidewaitdays, $sitename;
define('_1WEEK','1 Semana');
define('_2WEEKS','2 Semanas');
define('_30DAYS','30 D&iacute;as');
define('_ADDALINK','Agregar un Nuevo Enlace');
define('_ADDEDON','Agregado en');
define('_ADDITIONALDET','Detalles Adicionales');
define('_ADDLINK','Agregar Enlace');
define('_ADDURL','A&ntilde;adir esta URL');
define('_ALLOWTORATE','Permitir que otros usuarios lo valoren desde su sitio web!');
define('_AND','y');
define('_BESTRATED','Enlaces Mejores Valorados - Top');
define('_BREAKDOWNBYVAL','Desglose de las Valoraciones por Valor');
define('_BUTTONLINK','Enlace Estilo Bot&oacute;n');
define('_CATEGORIES','Categor&iacute;as');
if (!defined('_CATEGORY')) define('_CATEGORY','Categor&iacute;a');
define('_CATLAST3DAYS','Nuevos enlaces a&ntilde;adidos a esta categor&iacute;a en los &uacute;ltimos 3 d&iacute;as');
define('_CATNEWTODAY','Nuevos enlaces a&ntilde;adidos a esta categor&iacute;a hoy');
define('_CATTHISWEEK','Nuevos enlaces a&ntilde;adidos a esta categor&iacute;a en esta semana');
define('_CHECKFORIT','No has escrito un correo, pero de todas formas, revisaremos tu enlace pronto.');
define('_COMPLETEVOTE1','Tu vote es apreciado.');
define('_COMPLETEVOTE2','Ya has votado por este recurso en los pasados '."$anonwaitdays".' d&iacute;a(s).');
define('_COMPLETEVOTE3','Vote por un recurso solamente una vez.<br />Todos los votos ser&aacute;n revisados.');
define('_COMPLETEVOTE4','No puedes votar por un recurso que t&uacute; mismo enviaste.<br />Todos los votos ser&aacute;n revisados.');
define('_COMPLETEVOTE5','No has seleccionado una puntuaci&oacute;n - Voto no contabilizado');
define('_COMPLETEVOTE6','Solamente se permite un voto por direcci&oacute;n IP cada '."$outsidewaitdays".' d&iacute;a(s).');
if (!defined('_DATE')) { define('_DATE','Fecha'); }
define('_DATE1','Fecha (Enlaces Antiguos Primero)');
define('_DATE2','Fecha (Enlaces Nuevos Primero)');
define('_DAYS','d&iacute;as');
define('_DESCRIPTION','Descripci&oacute;n');
define('_DETAILS','Detalles');
define('_EDITORIAL','Editorial');
define('_EDITORIALBY','Editorial por');
define('_EDITORREVIEW','Revisi&oacute;n del Editor');
define('_EDITTHISLINK','Editar este Enlace');
define('_EMAILWHENADD','Recibir&aacute;s un correo electr&oacute;nico cuando el enlace sea aprobado.');
define('_FEELFREE2ADD','Si&eacute;ntase libre de agregar un comentario acerca de este sitio.');
define('_HIGHRATING','Alta Puntuaci&oacute;n');
define('_HITS','Impresiones');
define('_HTMLCODE1','El c&oacute;digo HTML que puedes usar en este caso, es el siguiente:');
define('_HTMLCODE2','El c&oacute;digo fuente para el bot&oacute;n anterior es:');
define('_HTMLCODE3','Este formulario permitir&aacute; a los usuarios calificar tu sitio directamente desde tu sitio y la puntuaci&oacute;n ser&aacute; grabada aqu&iacute;. El formulario anterior est&aacute; deshabilitado, pero el siguiente c&oacute;digo trabajar&aacute; simplemente copi&aacute;ndolo y peg&aacute;ndolo en tu p&aacute;gina. El c&oacute;digo se muestra a continuaci&oacute;n:');
define('_IDREFER','en el c&oacute;digo fuente HTML se hace referencia al n&uacute;mero de identificaci&oacute;n de su sitio en la base de datos de '."$sitename".'. Aseg&uacute;rese que este n&uacute;mero est&eacute; presente.');
define('_IFYOUWEREREG','Si estuvieras registrado podr&iacute;as publicar comentarios en este sitio.');
define('_INDB','en nuestra base de datos');
define('_INOTHERSENGINES','en otros Motores de B&uacute;squeda');
define('_INSTRUCTIONS','Instrucciones');
define('_ISTHISYOURSITE','&iquest;Es este tu recurso?');
define('_LAST30DAYS','&Uacute;ltimos 30 d&iacute;as');
define('_LASTWEEK','Semana Pasada');
define('_LDESCRIPTION','Descripci&oacute;n: (255 caracteres como m&aacute;ximo)');
define('_LETSDECIDE','La informaci&oacute;n de usuarios como usted ayudar&aacute; a otros visitantes a decidir mejor en cuales enlaces hacer clic.');
define('_LINKALREADYEXT','ERROR: Esta URL ya est&aacute; presente en la base de datos!');
define('_LINKCOMMENTS','Comentarios del Enlace');
define('_LINKID','ID del Enlace');
define('_LINKNODESC','ERROR: Es necesario que escriba una descripci&oacute;n para su URL!');
define('_LINKNOTITLE','ERROR: Es necesario que escriba un t&iacute;tulo para su URL!');
define('_LINKNOURL','ERROR: Es necesario que escriba una URL!');
define('_LINKPROFILE','Perfil del Enlace');
define('_LINKRATING','Puntuaci&oacute;n de los Enlaces');
define('_LINKRATINGDET','Detalles de la Puntuaci&oacute;n del Enlace');
define('_LINKRECEIVED','Hemos recibido los datos del enlace enviado. &iexcl;Gracias!');
define('_LINKS','Enlaces');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LINKSMAIN','&Iacute;ndice de Enlaces');
define('_LINKSMAINCAT','Principales Categor&iacute;as de Enlaces');
define('_LINKSNOCATS1','Debe haber al menos una categor&iacute;a de enlaces creada por'); //montego for RN0000571
define('_LINKSNOCATS2','el administrador del sitio antes de que un enlace pueda ser agregado.'); //montego for RN0000571
define('_LINKSNOTUSER1','No eres un usuario registrado o no has iniciado sesi&oacute;n.');
define('_LINKSNOTUSER2','Si estuvieras registrado podr&iacute;as a&ntilde;adir enlaces a este sitio.');
define('_LINKSNOTUSER3','Convertirse en usuario registrado es un proceso r&aacute;pido y f&aacute;cil.');
define('_LINKSNOTUSER4','&iquest;Por qu&eacute; la necesidad de registrarse para acceder a ciertas caracter&iacute;sticas?');
define('_LINKSNOTUSER5','As&iacute; podemos ofrecerle s&oacute;lo contenido de la m&aacute;s alta calidad,');
define('_LINKSNOTUSER6','Cada elemento es individualmente revisado y aprobado por nuestro personal.');
define('_LINKSNOTUSER7','Esperamos ofrecerle s&oacute;lo informaci&oacute;n valiosa.');
define('_LINKSNOTUSER8','<a href="modules.php?name=Your_Account">Obtenga una Cuenta</a>');
define('_LINKTITLE','T&iacute;tulo del Enlace');
define('_LINKVOTE','Votar!');
define('_LOOKTOREQUEST','Revisaremos su solicitud en breve.');
define('_LOWRATING','Baja Puntuaci&oacute;n');
define('_LTOTALVOTES','total de votos');
define('_LVOTES','votos');
define('_MAIN','Principal');
if(!defined('_MODIFY')) define('_MODIFY','Modificar');
define('_MOSTPOPULAR','M&aacute;s populares - Top');
define('_NEW','Nuevo');
define('_NEWLAST3DAYS','Nuevo en los &Ulacute;timos 3 d&iacute;as');
define('_NEWLINKS','Nuevos Enlaces');
define('_NEWTHISWEEK','Nuevo esta Semana');
define('_NEWTODAY','Nuevo Hoy');
define('_NEXT','Pr&oacute;xima P&aacute;gina');
define('_NOEDITORIAL','No hay ning&uacute;n editorial actualmente disponible para este sitio web.');
define('_NOMATCHES','No se encontaron resultados para su b&uacute;squeda');
define('_NOOUTSIDEVOTES','No Hay Votos For&aacute;neos');
define('_NOREGUSERSVOTES','No Hay Votos de Usuarios Registrados');
define('_NOUNREGUSERSVOTES','No Hay Votos de Usuarios No Registrados');
define('_NUMBEROFRATINGS','N&uacute;mero de Puntuaciones');
define('_NUMOFCOMMENTS','N&uacute;mero de comentarios');
define('_NUMRATINGS','# de Comentarios');
if (!defined('_OF')) { define('_OF','de'); }
define('_OFALL','de todo');
define('_ONLYREGUSERSMODIFY','S&oacute;lo los usuarios registrados pueden sugerir modificaciones de enlaces. Por favor <a href="modules.php?name=Your_Account">Reg&iacute;strese o Inicie Sesi&oacute;n</a>.');
define('_OUTSIDEVOTERS','Votantes For&aacute;neos');
define('_OVERALLRATING','Puntuaci&oacute;n Total');
define('_PAGETITLE','T&iacute;tulo de la P&aacute;gina');
define('_PAGEURL','URL de la P&aacute;gina');
define('_POPULAR','Popular');
define('_POPULARITY','Popularidad');
define('_POPULARITY1','Popularidad (Menor a Mayor N&uacute;mero de Impresiones)');
define('_POPULARITY2','Popularidad (Mayor a Menor N&uacute;mero de Impresiones)');
define('_POSTPENDING','Todos los enlaces son publicados pendientes de verificaci&oacute;n.');
define('_PREVIOUS','P&aacute;gina Anterior');
define('_PROMOTE01','Quiz&aacute;s pueda estar interesado en varias de las opciones remotas de \'Valorar un Sitio Web\' que disponemos. Estas permiten poner una imagen (o inclusive un formulario de valoraci&oacute;n) en su sitio a fin de aumentar el n&uacute;mero de votos que reciben sus recursos. Por favor elija de una de las opciones mostradas a continuaci&oacute;n:');
define('_PROMOTE02','Una forma de enlazar al formulario de valoraci&oacute;n es a trav&eacute;s de un simple enlace de texto:');
define('_PROMOTE03','Si est&aacute; buscando algo m&aacute;s que un b&aacute;sico enlace de texto, puede querer utilizar un peque&ntilde;o bot&oacute;n de enlace:');
define('_PROMOTE04','Si hace trampa, eliminaremos su v&iacute;nculo. Dicho esto, asi es como se ve el formulario de valoraci&oacute;n remota.');
define('_PROMOTE05','Gracias! y buena suerte con sus valoraciones!');
define('_PROMOTEYOURSITE','Promover Su Sitio Web');
define('_RANDOM','Aleatoeio');
define('_RATEIT','Valorar este Sitio!');
define('_RATENOTE1','Por favor no vote por el mismo recurso m&aacute;s de una vez.');
define('_RATENOTE2','La escala es de 1 - 10, siendo 1 muy pobre y 10 excelente.');
define('_RATENOTE3','Por favor, sea objetivo con su voto, si todo el mundo recibe un 1 &oacute; un 10, las valoraciones no son muy &uacute;tiles.');
define('_RATENOTE4','Puede ver una lista de los <a href="modules.php?name=Web_Links&amp;l_op=TopRated">Recursos Mejor Valorados</a>.');
define('_RATENOTE5','No vote por su propio recurso o por el de un competidor.');
define('_RATESITE','Valorar este Sitio');
define('_RATETHISSITE','Valorar este Recurso');
define('_RATING','Puntuaci&oacute;n');
define('_RATING1','Puntuaci&oacute;n (Menor a Mayor Puntuaci&oacute;n)');
define('_RATING2','Puntuaci&oacute;n (Mayor a Menor Puntuaci&oacute;n)');
define('_REGISTEREDUSERS','Usuarios Registrados');
define('_REMOTEFORM','Formulario de Valoraci&oacute;n Remoto');
define('_REPORTBROKEN','Reportar de un Enlace Roto');
define('_REQUESTLINKMOD','Solicitar Modificaci&oacute;n del Enlace');
define('_RETURNTO','Regresar a');
define('_SCOMMENTS','Comentarios');
define('_SEARCHRESULTS4','Resultados de la B&uacute;squeda de');
define('_SELECTPAGE','Seleccionar P&aacute;gina');
define('_SENDREQUEST','Enviar Solicitud');
define('_SHOW','Mostrar');
define('_SHOWTOP','Mostrar Top');
define('_SITESSORTED','Sitios actualmente ordenados por');
define('_SORTLINKSBY','Ordenar Enlaces Por');
define('_STAFF','Persdnal');
define('_SUBMITONCE','Enviar un &uacute;nico enlace solamente una vez.');
define('_TEXTLINK','Enlace de Texto');
define('_THANKSBROKEN','Gracias por ayudarnos a mantener la integridad de este directorio.');
define('_THANKSFORINFO','Gracias por la informaci&oacute;n.');
define('_THANKSTOTAKETIME','Gracias por tomarte el tiempo de valorar un sitio aqu&iacute; en');
define('_THENUMBER','El N&uacute;mero');
define('_THEREARE','Hay');
define('_TITLE','T&iacute;tulo');
define('_TITLEAZ','T&iacute;tulo (A - Z)');
define('_TITLEZA','T&iacute;tulo (Z - A)');
define('_TO','Para');
define('_TOPRATED','Mejores Valorados');
define('_TOTALFORLAST','Total de nuevos enlaces para los &uacute;ltimos');
define('_TOTALNEWLINKS','Total de Nuevos Enlaces');
define('_TOTALOF','Total de');
define('_TOTALVOTES','Total de Votos:');
define('_TRATEDLINKS','total de enlaces valorados');
define('_TRY2SEARCH','Trata de buscar');
define('_TVOTESREQ','votos requeridos como m&iacute;nimo');
define('_UNREGISTEREDUSERS','Usuarios No Registrados');
define('_URL','URL');
define('_USER','Usuario');
define('_USERANDIP','Su nombre de usuario y direcci&oacute;n IP fueron registrados, as&iacute; que por favor no abuse del sistema.');
define('_USERAVGRATING','Puntuaci&oacute;n Promedio de Usuarios');
define('_USUBCATEGORIES','Sub-Categor&iacute;as');
define('_VISITTHISSITE','Visitar este Sitio');
define('_VOTE4THISSITE','Votar por este Sitio!');
define('_WEBLINKS','Enlaces');
define('_WEIGHNOTE','* Nota: Este recurso diferencia los votos de los usuarios registrados de los no registrados');
define('_WEIGHOUTNOTE','* Nota: Este recurso diferencia los votos de los usuarios registrados de los for&aacute;neos');
define('_YOUARENOTREGGED','No eres un usuario registrado o no has iniciado sesi&oacute;n.');
define('_YOUAREREGGED','Eres un usuario registrado y has iniciado sesi&oacute;n.');
define('_YOUREMAIL','Tu Correo');
define('_YOURNAME','Tu Nombre');
?>
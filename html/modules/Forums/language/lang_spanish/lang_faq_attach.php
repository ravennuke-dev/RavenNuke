<?php
/** 
*
* attachment mod faq [Spanish]
*
* @package attachment_mod
* @version $Id: lang_faq_attach.php,v 1.1 2005/11/05 10:25:02 acydburn Exp $
* @copyright (c) 2002 torgeir andrew waterhouse
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!isset($faq) || !is_array($faq))
{
	$faq = array();
}

$faq[] = array("--","Adjuntos");

$faq[] = array("¿Como agrego un adjunto?", "Puede agregar un adjunto cuando envie un nuevo post. Deberia ver el formulario <span class='italic'>Agregar un Adjunto</span> debajo del cuadro de texto del mensaje. Cuando haga click en el boton <span class='italic'>Buscar...</span> se abrira la ventana de dialogo para buscar en su computadora. Busque el archivo que quiere adjuntar, marquelo y haga click en OK, Open o doble click segun el procedimiento correcto para su computadora. Si desea hacer un comentario en el campo <span class='italic'>Comentario</span> este comentario sera usado como un link al archivo adjuntado. Si no agrego un comentario se usara el nombre del archivo. Si el administrador lo permite usted podra adjuntar varios archivos mediante el mismo procedimiento hasta alcanzar el numero maximo de adjuntos permitidos para cada post.<br/><br/>El administrador fija un tamaño maximo para los archivos, define las extensiones permitidas para los archivos y otras cosas relacionadas con el foro. Atencion, es su responsabilidad cumplir con las normas fijadas en la politica del foro, pueden ser borrados sin aviso.<br/><br/>Por favor tome nota, los dueños, webmaster, administradores y moderadores del foro no pueden y no se haran responsables por la perdida de datos.");

$faq[] = array("¿Como agrego un adjunto despues de enviar un mensaje?", "Para agregar un adjunto despues de haber enviado el mensaje, debera editar el mismo y seguir los procedimientos antes descriptos. Los nuevos adjuntos seran agregados cuando haga click en <span class='italic'>Enviar</span> para enviar el post editado.");

$faq[] = array("¿Como borro un adjunto?", "Para borrar un adjunto debera editar el post y hacer click en <span class='italic'>Borrar Adjunto</span> junto al adjunto que quiere borrar en el cuadro <span class='italic'>Adjuntos Enviados</span> . Los nuevos adjuntos seran borrados cuando haga click en <span class='italic'>Enviar</span> para enviar el post editado.");

$faq[] = array("¿Como actualizo el comentario de un adjunto?", "Para actualizar el comentario de un adjunto debera editar el post, edite el texto en el campo <span class='italic'>Comentario</span> y haga click en el boton <span class='italic'>Actualizar Comentario</span> . Los nuevos comentarios seran actualizados cuando haga click en <span class='italic'>Enviar</span> para enviar el post editado.");

$faq[] = array("¿Porque no veo el adjunto en mi mensaje?", "Probablemente la extension del archivo no se permite en el foro, el moderador o administrador del foro lo ha deshabilitado por no cumplir con la politica del foro.");

$faq[] = array("¿Porque no puedo agregar adjuntos?", "En algunos foros el envio de adjuntos puede estar limitado a ciertos grupos de usuarios. Para agregar un adjunto podria necesitar una autorizacion especial, solo un moderador o administrador puede otorgar este permiso, deberia contactarlos.");

$faq[] = array("Obtuve los permisos necesarios, ¿porque no puedo agregar adjuntos?", "El administrador del foro fija un tamaño maximo para los archivos, extensiones y otras cosas relacionadas con los adjuntos dentro del foro. Un administrador o moderador puede haber alterado sus permisos, o discontinuado el envio de adjuntos en el respectivo foro. Deberia obtener una explicacion en el mensaje de error que se muestra cuando intenta agregar el adjunto, en caso contrario considere contactar a un administrador o moderador.");

$faq[] = array("¿Porque no puedo borrar adjuntos?", "En algunos foros borrar adjuntos puede estar limitado a ciertos grupos de usuarios. Para borrar un adjunto podria necesitar una autorizacion especial, solo un moderador o administrador puede otorgar este permiso, deberia contactarlos.");

$faq[] = array("¿Porque no puedo Ver/Bajar adjuntos?", "En algunos foros Ver/bajar adjuntos puede estar limitado a ciertos grupos de usuarios. Para Ver/Bajar un adjunto podria necesitar una autorizacion especial, solo un moderador o administrador puede otorgar este permiso, deberia contactarlos.");

$faq[] = array("¿A quien contacto en caso de un adjunto ilegal o posiblemente ilegal?", "Deberia contactar al administrador del foro. Si no puede averiguar quien es, deberia contactar primero a un moderador preguntando a quien dirigir la consulta. Si continua sin respuestas deberia contactar al dueño del dominio (haga un whois lookup) o, si el foro corre en un servicio gratuito (ej. yahoo, free.fr, f2s.com, etc.), a la administracion de ese servicio. Atencion, phpBB Group no tiene control en lo absoluto y no puede de ninguna manera ser culpado por como, donde o por quien este foro es usado. No tiene sentido en absoluto contactar al phpBB Group en relacion a cualquier asunto legal(cesar y desistir, responsablilizar, difamar, etc.) no relacionado directamente con phpbb.com website o el software of phpBB itself. Si usted envia un mail al phpBB Group acerca del uso de este software por terceros recibira una respuesta concisa o directamente ninguna .");

?>
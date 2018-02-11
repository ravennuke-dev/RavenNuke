<?php
define('_rnMYSQL_TABLE_INSTALLER','Instalador de las Tablas MySQL');
define('_rnWARNING','Este archivo es para <span class="underline">NUEVAS</span> instalaciones y <span class="underline">REEMPLAZAR&Aacute;</span> tus tablas y datos cada vez que sea ejecutado. Esto <span class="underline">NO</span> es recuperable.');
define('_rnTITLE_1','Resultados de la prueba de conectividad de la base de datos MySQL');
define('_rnCONFIG_FILE_FOUND','Se encontr&oacute; el archivo config.php!');
define('_rnSUCCESS_CONNECT_HOST','<span style="font-weight:bold;">Conectado correctamente a <span class="c3">'.$dbhost.'</span> con el usuario <span class="c3">'.$dbuname.'</span> y la contrase&ntilde;a asignada!</span><br />');
define('_rnFOUND_DB','<span style="font-weight:bold;">Se encontr&oacute; la base de datos <span class="c3">'.$dbname.'</span>!</span><br />');
define('_rnTABLE_PREFIX','<span style="font-weight:bold;">Las tablas ser&aacute;n instaladas con el prefijo <span class="c3">'.$prefix.'</span>. <br />Las tablas de usuarios ser&aacute;n instaladas con el prefijo <span class="c3">'.$user_prefix.'</span>.<br />Si esto no es correcto, edite el archivo config.php y haga los ajustes de lugar para <span class="c2">$prefix</span> y <span class="c2">$user_prefix</span>.</span><br />');
define('_rnINSTALLER_INTENT','Para informaci&oacute;n y ayuda adicional visita los foros en http://www.ravenphpscripts.com y la documentaci&oacute;n inclu&iacute;da.  Estos pasos deben ser completados en el orden mostrado. Los primeros 2 pasos son obligatorios. El paso 3 es opcional, pero muy recomendable, ya que facilitar&aacute; el rastreo de IP\'s a trav&eacute;s de NukeSentinel&trade;.');
define('_rnERR1','<span class="c2">Parece que el archivo config.php no est&aacute; presente o los permisos impiden tener acceso. Por favor verifique que el archivo config.php est&eacute; presente en la carpeta ra&iacute;z donde est&aacute; localizado el archivo mainfile.php y que al menos tenga permisos 644.  Despu&eacute;s trate de ejecutar el script otra vez.</span>');
define('_rnERR2','<span class="c2">No se pudo conectar al servidor MySQL usando las opciones de conexi&oacute;n MySQL en el archivo config.php. El error exacto que MySQL report&oacute; fue:</span>');
define('_rnERR3','<span class="c2">Fue posible conectar al servidor MySQL usando las opciones de conexi&oacute;n MySQL en el archivo config.php, pero no fue posible conectar a la base de datos <span style="font-weight:bold;">'.$dbname.'</span>. El error exacto que el servidor MySQL report&oacute; fue:</span>');
define('_rnERR4','<span class="c2">El error exacto que el servidor MySQL report&oacute; fue:</span>');
define('_rnERR90','<span class="c2">Usted ha tratado de crackear el instalador.  Toda la informaci&oacute;n pertinente a esta sesi&oacute;n ha sido guardada y ser&aacute; revisada por el administrador del sistema, adem&aacute;s se tomar&aacute;n las medidas de lugar.</span>');
define('_rnERR91','<span class="c2">No parece que se haya cargado ninguna tabla.  Instalaci&oacute;n detenida.  El error exacto que el servidor MySQL report&oacute; fue:</span>');
define('_rnERR80','<span class="c2">No se ha podido actualizar la tabla AUTHORS con una contrase&ntilde;a aleatoria.  Instalaci&oacute;n detenida.  El error exacto que el servidor MySQL report&oacute; fue:</span>');
define('_rnERR81','<span class="c2">No se ha podido actualizar la tabla de administraci&oacute;n de NukeSentinel&trade; con una contrase&ntilde;a aleatoria.  Instalaci&oacute;n detenida.  El error exacto que el servidor MySQL report&oacute; fue:</span>');
define('_rnSTEP1','Paso 1');
define('_rnSTEP2','Paso 2');
define('_rnSTEP3','Paso 3');
define('_rnSTEP3a','Paso 3a');
define('_rnSTEP3b','Paso 3b');
define('_rnSTEP3c','Paso 3c');
define('_rnSTEP3d','Paso 3d');
define('_rnSTEP3e','Paso 3e');
define('_rnSTEP3f','Paso 3f');
define('_rnSTEP3g','Paso 3g');
define('_rnSTEP3h','Paso 3h');
define('_rnSTEP3i','Paso 3i');
define('_rnSTEP3j','Paso 3j');
define('_rnSUBMIT','Enviar');
define('_rnLOAD_CORE_TABLES','Cargar Tablas Principales');
define('_rnLOAD_NUKESENTINEL_TABLES','Cargar Tablas para NukeSentinel&trade;');
define('_rnLOAD_IP2COUNTRY_DATA','Cargar Datos de IP2COUNTRY');
define('_rnLOAD_IP2COUNTRY_DATA1_10' ,'Cargar Datos de IP2COUNTRY Parte 1/8');
define('_rnLOAD_IP2COUNTRY_DATA2_10' ,'Cargar Datos de IP2COUNTRY Parte 2/8');
define('_rnLOAD_IP2COUNTRY_DATA3_10' ,'Cargar Datos de IP2COUNTRY Parte 3/8');
define('_rnLOAD_IP2COUNTRY_DATA4_10' ,'Cargar Datos de IP2COUNTRY Parte 4/8');
define('_rnLOAD_IP2COUNTRY_DATA5_10' ,'Cargar Datos de IP2COUNTRY Parte 5/8');
define('_rnLOAD_IP2COUNTRY_DATA6_10' ,'Cargar Datos de IP2COUNTRY Parte 6/8');
define('_rnLOAD_IP2COUNTRY_DATA7_10' ,'Cargar Datos de IP2COUNTRY Parte 7/8');
define('_rnLOAD_IP2COUNTRY_DATA8_10' ,'Cargar Datos de IP2COUNTRY Parte 8/8');
//define('_rnLOAD_IP2COUNTRY_DATA9_10' ,'Cargar Datos de IP2COUNTRY Parte 9/10');
//define('_rnLOAD_IP2COUNTRY_DATA10_10' ,'Cargar Datos de IP2COUNTRY Parte 10/10');
define('_rnIP2COUNTRY_NOTE','La tabla IP2Country de NukeSentinel&trade; es muy grande, por tanto fue dividida en los PASOS 3a-3h.');
define('_rnREADY_TO_PROCEED','Ahora est&aacute; listo para proceder a la configuraci&oacute;n del sistema. Por favor seleccione <a href="setup.php">Configurar</a> para proceder al pr&oacute;ximo paso de la instalaci&oacute;n.');
define('_rnALL_RIGHTS','Todos los derechos reservados.');
define('_rnNO_PORTION','Ninguna parte de este documento/c&oacute;digo podr&aacute; ser copiado, cambiado o redistribu&iacute;do sin previa autorizaci&oacute;n escrita de');
define('_rnCOPYRIGHT','Copyright');
define('_rnLOADED','Cargado!');
define('_rnPROCESSED_IN','Instrucciones procesadas en');
define('_rnS','s');
define('_rnNOT_LOADED','No fue Cargado');
define('_rnRAVENNUKE','RavenNuke');
define('_rnLOAD_SERVER_ENVIRONMENT_CHECK','Ravenstaller&trade; Chequeo del Entorno del Servidor');
define('_rnRUN','Ejecutar');
?>
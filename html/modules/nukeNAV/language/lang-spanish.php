<?php
/**************************************************************************/
/* nukeNAV(tm)
/*
/* Copyright (c) 2009, Kevin Guske  http://nukeseo.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/**************************************************************************/
// nukeSEO DH
if (!defined('_DH_COMMON')) define('_DH_COMMON','able,about,above,according,accordingly,across,act,actually,add,afraid,after,afterwards,again,against,age,ago,agree,all,allow,allows,almost,alone,along,already,also,although,always,am,among,amongst,amount,an,and,anger,angry,animal,another,answer,any,anybody,anyhow,anyone,anything,anyway,anyways,anywhere,apart,appear,apple,appreciate,appropriate,are,arrive,arm,arms,around,arrive,as,aside,asking,ask,associated,at,attempt,available,aunt,away,awfully,back,bad,bag,bay,be,became,because,become,becomes,becoming,been,before,beforehand,behind,began,begin,behind,being,believe,bell,belong,below,beside,besides,best,better,between,beyond,big,body,bone,born,borrow,both,bottom,box,boy,break,brief,bring,brought,bug,built,busy,but,buy,by,call,came,can,cannot,cant,cause,causes,certain,certainly,changes,choose,clear,clearly,close,closing,come,comes,concerning,consequently,consider,considerable,considering,contain,containing,contains,continue,correspond,corresponding,could,course,cry,current,currently,cut,dare,dark,deal,dear,decide,definitely,deep,describe,described,despite,did,different,die,do,does,dog,doing,done,doubt,down,downward,downwards,during,each,ear,early,eat,effort,eight,either,else,elsewhere,end,enjoy,enough,enter,entirely,especially,etc,even,ever,every,everybody,everyone,everything,everywhere,exactly,example,except,expect,explain,fail,fall,far,fat,favor,fear,feel,feet,fell,felt,few,fifth,fill,find,first,fit,five,fly,follow,followed,following,follows,for,forever,forget,former,formerly,forth,four,from,front,further,furthermore,gave,get,gets,getting,given,gives,go,goes,going,gone,good,got,gotten,gray,great,green,greetings,grew,grow,guess,had,half,hang,happen,happens,hardly,has,hat,have,having,he,hear,heard,held,hello,help,hence,her,here,hereafter,hereby,herein,hereupon,hers,herself,hi,high,hill,him,himself,his,hit,hither,hold,hope,hopefully,hot,how,however,if,ignore,ignored,ill,immediate,immediately,in,inasmuch,inc,indeed,indicate,indicated,indicates,inner,insofar,instead,into,inward,iron,is,it,its,itself,just,keep,keeps,kept,knew,know,knows,known,late,last,late,lately,later,latter,latterly,least,led,left,lend,less,lest,let,like,liked,likely,little,lone,long,look,looking,looks,lot,ltd,main,mainly,make,many,may,maybe,me,mean,meanwhile,merely,met,might,mile,mine,moon,more,moreover,most,mostly,move,much,must,my,myself,name,namely,near,nearly,necessary,need,needs,neither,never,nevertheless,new,next,nine,no,nobody,non,none,noone,nor,normally,not,note,nothing,novel,now,nowhere,number,obviously,of,off,often,oh,ok,okay,old,on,once,one,ones,only,onto,or,other,others,otherwise,ought,our,ours,ourselves,out,outside,over,overall,own,particular,particularly,per,perhaps,placed,please,plus,possible,prepare,presumably,presume,probable,probably,provides,pull,pure,push,put,que,quite,qv,raise,ran,rather,rd,re,reach,realize,really,reasonable,reasonably,regarding,regardless,regards,relatively,reply,require,respect,respectively,rest,right,run,said,same,sat,saw,say,saying,says,second,secondly,seconds,see,seeing,seem,seemed,seeming,seems,seen,self,sell,selves,sensible,sensibly,sent,separate,serious,seriously,set,seven,several,shall,she,should,side,sign,since,six,so,sold,some,somebody,somehow,someone,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specified,specify,specifying,stay,step,stick,still,stood,sub,such,sudden,suppose,sure,take,taken,talk,tall,tell,ten,tends,than,thank,thanks,thanx,that,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,therefore,therein,thereupon,these,they,think,third,this,thorough,thoroughly,those,though,three,through,throughout,thru,thus,till,to,today,together,told,tomorrow,too,took,tore,toward,towards,tried,tries,truly,trust,try,trying,turn,twice,two,under,unfortunate,unfortunately,unless,unlike,unlikely,until,unto,up,upon,us,use,used,useful,uses,using,usual,usually,value,various,verb,very,via,visit,want,wants,was,way,we,welcome,well,went,were,what,whatever,when,whence,whenever,where,whereafter,whereas,whereby,wherein,whereupon,wherever,whether,whic
h,while,white,whither,who,whoever,whole,whom,whose,why,will,willing,wish,with,within,without,wonder,would,yes,yet,you,young,your,yours,yourself,yourselves,zero,br,img,p,lt,gt,quot,copy');

// nukeNAV - menu
if (!defined('_NAV_NEWS')) define('_NAV_NEWS','Noticias');
if (!defined('_NAV_AUTHART')) define('_NAV_AUTHART','Autores y Art&iacute;culos');
if (!defined('_NAV_STORARCH')) define('_NAV_STORARCH','Archivo de Noticias');
if (!defined('_NAV_TOPICS')) define('_NAV_TOPICS','T&oacute;picos');
if (!defined('_NAV_SUBMITNEWS')) define('_NAV_SUBMITNEWS','Enviar Noticias');
if (!defined('_NAV_FORUMS')) define('_NAV_FORUMS','Foros');
if (!defined('_NAV_NEWPOSTS')) define('_NAV_NEWPOSTS','Nuevas Publicaciones del Foro');
if (!defined('_NAV_UNANSWERED')) define('_NAV_UNANSWERED','Publicaciones sin Respuesta');
if (!defined('_NAV_YOURPOSTS')) define('_NAV_YOURPOSTS','Tus Publicaciones del Foro');
if (!defined('_NAV_ADMINMODS')) define('_NAV_ADMINMODS','M&oacute;dulos de Administraci&oacute;n');
if (!defined('_NAV_YOURACCOUNT')) define('_NAV_YOURACCOUNT','Tu Cuenta');
if (!defined('_NAV_PM')) define('_NAV_PM','Mensajes Privados');
if (!defined('_NAV_PREFS')) define('_NAV_PREFS','Preferencias');
if (!defined('_NAV_CHGTHEME')) define('_NAV_CHGTHEME','Cambiar Tema');
if (!defined('_NAV_SITEINFO')) define('_NAV_SITEINFO','Informaci&oacute;n del Sitio');
if (!defined('_NAV_SITEMAP')) define('_NAV_SITEMAP','Mapa del Sitio');
if (!defined('_NAV_CONTACTS')) define('_NAV_CONTACTS','Contactos');
if (!defined('_NAV_FEEDBACK')) define('_NAV_FEEDBACK','Contacto');
if (!defined('_NAV_RECOMMEND')) define('_NAV_RECOMMEND','Recomiendanos');
if (!defined('_NAV_HOWTOINSTALL')) define('_NAV_HOWTOINSTALL','Como Instalar');
if (!defined('_NAV_LEGAL')) define('_NAV_LEGAL','Legal');
if (!defined('_NAV_MEMBERS')) define('_NAV_MEMBERS','Miembros');
if (!defined('_NAV_STATS')) define('_NAV_STATS','Estad&iacute;sticas');
if (!defined('_NAV_CREDITS')) define('_NAV_CREDITS','Cr&eacute;ditos');
if (!defined('_NAV_ADMIN')) define('_NAV_ADMIN','Administrador');
if (!defined('_NAV_ACP')) define('_NAV_ACP','Panel de Control del Administrador');
if (!defined('_NAV_APPEARANCE')) define('_NAV_APPEARANCE','Apariencia');
if (!defined('_NAV_BLOCKS')) define('_NAV_BLOCKS','Bloques');
if (!defined('_NAV_MSGS')) define('_NAV_MSGS','Mensajes');
if (!defined('_NAV_MODS')) define('_NAV_MODS','M&oacute;dulos');
if (!defined('_NAV_LGL')) define('_NAV_LGL','Legal');
if (!defined('_NAV_SETTINGS')) define('_NAV_SETTINGS','Preferencias del Sitio');
if (!defined('_NAV_ADMINS')) define('_NAV_ADMINS','Administradores');
if (!defined('_NAV_GROUPS')) define('_NAV_GROUPS','Grupos');
if (!defined('_NAV_POINTS')) define('_NAV_POINTS','Puntos');
if (!defined('_NAV_SECURITY')) define('_NAV_SECURITY','Seguridad');
if (!defined('_NAV_UTILS')) define('_NAV_UTILS','Utilidades');
if (!defined('_NAV_BACKUP')) define('_NAV_BACKUP','Respaldo');
if (!defined('_NAV_OPTIMIZE')) define('_NAV_OPTIMIZE','Optimizar');
if (!defined('_NAV_MAILER')) define('_NAV_MAILER','Mailer');
if (!defined('_NAV_NEWSTORY')) define('_NAV_NEWSTORY','Nueva Noticia');
if (!defined('_NAV_CHGPOLL')) define('_NAV_CHGPOLL','Cambiar Encuesta');
if (!defined('_NAV_COMMENTS')) define('_NAV_COMMENTS','Comentarios');
if (!defined('_NAV_NEWS')) define('_NAV_NEWS','Noticias');

// nukeNAV - SEO modal dialog
if (!defined('_HEAD_TAG')) define('_HEAD_TAG','Etiqueta HEAD');
if (!defined('_OVERRIDE_TAG')) define('_OVERRIDE_TAG','Redefinir Etiqueta');
if (!defined('_GENERATED_TAG')) define('_GENERATED_TAG','Etiqueta generada');
if (!defined('_TITLE')) define('_TITLE','T&iacute;tulo');
if (!defined('_TITLE_HLP')) define('_TITLE_HLP','L&iacute;mites recomendados: <strong>70 a 90 caracteres</strong><br /><br />El t&iacute;tulo de la p&aacute;gina es definido en la metaetiqueta TITLE y puede considerarse <span class="thick">el atributo m&aacute;s importante</span> para los rankings de los motores de b&uacute;squeda. El t&iacute;tulo de la p&aacute;gina debe contener un descripci&oacute;n coherente de la p&aacute;gina, as&iacute; como palabras clave presentes dentro del contenido de la p&aacute;gina.');
if (!defined('_DESCRIPTION')) define('_DESCRIPTION','Descripci&oacute;n');
if (!defined('_DESCRIPTION_HLP')) define('_DESCRIPTION_HLP','L&iacute;mites recomendados: <strong>Al menos 180-200 caracteres, con no m&aacute;s de 1000 caracteres</strong><br /><br />La metaetiqueta DESCRIPTION debe contener una descripci&oacute;n coherente de la p&aacute;gina, y debe contener palabras que aparezcan dentro del contenido de la p&aacute;gina.');
if (!defined('_KEYWORDS')) define('_KEYWORDS','Palabras clave');
if (!defined('_KEYWORDS_HLP')) define('_KEYWORDS_HLP','L&iacute;mites recomendados: <strong>12 o menos palabras / frases, hasta 255 caracteres</strong><br /><br />Para un mejor resultado con la metaetiqueta KEYWORDS, seleccione 12 de las m&aacute;s populars y relevantes palabras clave de esa p&aacute;gina en particular, idealmente frases de palabras clave de 2 a 3 palabras, separadas por una coma. Aseg&uacute;rese que las palabras clave usadas est&aacute;n presentes en el t&iacute;tulo, descripci&oacute;n y contenido de la p&aacute;gina. Si no lo est&aacute;n, NO agregue palabras adicionales, de lo contrario el tema de su p&aacute;gina ser&aacute; dilu&iacute;do. El orden tambi&eacute;n desempe&ntilde;a un papel, aseg&uacute;rese de ordenar las palabras clave por orden de importancia.');
if (!defined('_OVERRIDE_TAGS')) define('_OVERRIDE_TAGS','Redefinir Etiquetas META');
if (!defined('_OVERRIDE_META')) define('_OVERRIDE_META','Guardar Redefiniciones');
if (!defined('_NAV_VARIABLES')) define('_NAV_VARIABLES','% Variables');
if (!defined('_NAV_VARIABLES_HLP')) define('_NAV_VARIABLES_HLP','Varias variables est&aacute;n disponibles para su uso en las etiquetas HEAD:<br /><ul><li><span class="thick">%sitename%</span> - El nombre del sitio guardado en la Configuraci&oacute;n del Sitio</li><li><span class="thick">%slogan%</span> - El lema del sitio guardado en la Configuraci&oacute;n del Sitio</li><li><span class="thick">%module%</span> - El t&iacute;tulo del m&oacute;dulo actual</li><li><span class="thick">%year%</span> - El a&ntilde;o actual en formato gregoriano de 4 d&iacute;gitos (por ejemplo 2009 para Derechos de Autor)</li></ul>Estas variables van todo en min&uacute;sculas y deben ser precedidas y sucedidas por el s&iacute;mbolo %.');
if (!defined('_NAV_LEVEL')) define('_NAV_LEVEL','Nivel de la Etiqueta HEAD');
if (!defined('_NAV_LEVEL_HLP')) define('_NAV_LEVEL_HLP','Las etiquetas HEADpueden ser generadas y redefinidas en los siguientes niveles utilizando el m&aacute;s alto nivel de detalle aplicable:<br /><br />0. <span class="thick">Sitio</span> (p&aacute;gina de inicio)<br />1. <span class="thick">M&oacute;dulo</span><br />2. <span class="thick">Categor&iacute;a</span> (ej. Categor&iacute;a del Foro)<br />3. <span class="thick">Subcategor&iacute;a</span> (ej. Foro)<br />4. <span class="thick">Contenido</span> (ej. Tema del Foro, Art&iacute;culo de Noticias)<br /><br />Nota: Las redefiniciones de sitio son requeridas y no  pueden ser eliminadas.');
if (!defined('_LEVEL0')) define('_LEVEL0','Sitio');
if (!defined('_LEVEL1')) define('_LEVEL1','M&oacute;dulo');
if (!defined('_LEVEL2')) define('_LEVEL2','Categor&iacute;a');
if (!defined('_LEVEL3')) define('_LEVEL3','Subcategor&iacute;a');
if (!defined('_LEVEL4')) define('_LEVEL4','Contenido');
if (!defined('_DELETE_OVERRIDES')) define('_DELETE_OVERRIDES','Eliminar Redefiniciones');
if (!defined('_OVERRIDES_DELETED')) define('_OVERRIDES_DELETED','Las etiquetas HEAD redefinidas fueron eliminadas. Recargue la p&aacute;gina para ver los cambios.');
if (!defined('_OVERRIDES_SAVED')) define('_OVERRIDES_SAVED','Las etiquetas HEAD redefinidas fueron guardadas. Recargue la p&aacute;gina para ver los cambios.');
?>
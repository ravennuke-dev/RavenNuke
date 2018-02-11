<?php
/**************************************************************************/
/* nukeNAV(tm)
/*
/* Copyright (c) 2009, Kevin Guske  http://nukeseo.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/* German free translation by Susann http://su-s.com
/**************************************************************************/
// nukeSEO DH
if (!defined('_DH_COMMON')) define('_DH_COMMON','able,about,above,according,accordingly,across,act,actually,add,afraid,after,afterwards,again,against,age,ago,agree,all,allow,allows,almost,alone,along,already,also,although,always,am,among,amongst,amount,an,and,anger,angry,animal,another,answer,any,anybody,anyhow,anyone,anything,anyway,anyways,anywhere,apart,appear,apple,appreciate,appropriate,are,arrive,arm,arms,around,arrive,as,aside,asking,ask,associated,at,attempt,available,aunt,away,awfully,back,bad,bag,bay,be,became,because,become,becomes,becoming,been,before,beforehand,behind,began,begin,behind,being,believe,bell,belong,below,beside,besides,best,better,between,beyond,big,body,bone,born,borrow,both,bottom,box,boy,break,brief,bring,brought,bug,built,busy,but,buy,by,call,came,can,cannot,cant,cause,causes,certain,certainly,changes,choose,clear,clearly,close,closing,come,comes,concerning,consequently,consider,considerable,considering,contain,containing,contains,continue,correspond,corresponding,could,course,cry,current,currently,cut,dare,dark,deal,dear,decide,definitely,deep,describe,described,despite,did,different,die,do,does,dog,doing,done,doubt,down,downward,downwards,during,each,ear,early,eat,effort,eight,either,else,elsewhere,end,enjoy,enough,enter,entirely,especially,etc,even,ever,every,everybody,everyone,everything,everywhere,exactly,example,except,expect,explain,fail,fall,far,fat,favor,fear,feel,feet,fell,felt,few,fifth,fill,find,first,fit,five,fly,follow,followed,following,follows,for,forever,forget,former,formerly,forth,four,from,front,further,furthermore,gave,get,gets,getting,given,gives,go,goes,going,gone,good,got,gotten,gray,great,green,greetings,grew,grow,guess,had,half,hang,happen,happens,hardly,has,hat,have,having,he,hear,heard,held,hello,help,hence,her,here,hereafter,hereby,herein,hereupon,hers,herself,hi,high,hill,him,himself,his,hit,hither,hold,hope,hopefully,hot,how,however,if,ignore,ignored,ill,immediate,immediately,in,inasmuch,inc,indeed,indicate,indicated,indicates,inner,insofar,instead,into,inward,iron,is,it,its,itself,just,keep,keeps,kept,knew,know,knows,known,late,last,late,lately,later,latter,latterly,least,led,left,lend,less,lest,let,like,liked,likely,little,lone,long,look,looking,looks,lot,ltd,main,mainly,make,many,may,maybe,me,mean,meanwhile,merely,met,might,mile,mine,moon,more,moreover,most,mostly,move,much,must,my,myself,name,namely,near,nearly,necessary,need,needs,neither,never,nevertheless,new,next,nine,no,nobody,non,none,noone,nor,normally,not,note,nothing,novel,now,nowhere,number,obviously,of,off,often,oh,ok,okay,old,on,once,one,ones,only,onto,or,other,others,otherwise,ought,our,ours,ourselves,out,outside,over,overall,own,particular,particularly,per,perhaps,placed,please,plus,possible,prepare,presumably,presume,probable,probably,provides,pull,pure,push,put,que,quite,qv,raise,ran,rather,rd,re,reach,realize,really,reasonable,reasonably,regarding,regardless,regards,relatively,reply,require,respect,respectively,rest,right,run,said,same,sat,saw,say,saying,says,second,secondly,seconds,see,seeing,seem,seemed,seeming,seems,seen,self,sell,selves,sensible,sensibly,sent,separate,serious,seriously,set,seven,several,shall,she,should,side,sign,since,six,so,sold,some,somebody,somehow,someone,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specified,specify,specifying,stay,step,stick,still,stood,sub,such,sudden,suppose,sure,take,taken,talk,tall,tell,ten,tends,than,thank,thanks,thanx,that,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,therefore,therein,thereupon,these,they,think,third,this,thorough,thoroughly,those,though,three,through,throughout,thru,thus,till,to,today,together,told,tomorrow,too,took,tore,toward,towards,tried,tries,truly,trust,try,trying,turn,twice,two,under,unfortunate,unfortunately,unless,unlike,unlikely,until,unto,up,upon,us,use,used,useful,uses,using,usual,usually,value,various,verb,very,via,visit,want,wants,was,way,we,welcome,well,went,were,what,whatever,when,whence,whenever,where,whereafter,whereas,whereby,wherein,whereupon,wherever,whether,whic
h,while,white,whither,who,whoever,whole,whom,whose,why,will,willing,wish,with,within,without,wonder,would,yes,yet,you,young,your,yours,yourself,yourselves,zero,br,img,p,lt,gt,quot,copy');

// nukeNAV - menu
if (!defined('_NAV_NEWS')) define('_NAV_NEWS','News');
if (!defined('_NAV_AUTHART')) define('_NAV_AUTHART','Autoren und Artikel');
if (!defined('_NAV_STORARCH')) define('_NAV_STORARCH','Stories Archiv');
if (!defined('_NAV_TOPICS')) define('_NAV_TOPICS','Themen');
if (!defined('_NAV_SUBMITNEWS')) define('_NAV_SUBMITNEWS','News hinzuf&uuml;gen');
if (!defined('_NAV_FORUMS')) define('_NAV_FORUMS','Forum');
if (!defined('_NAV_NEWPOSTS')) define('_NAV_NEWPOSTS','Neue Forenbeitr&auml;ge');
if (!defined('_NAV_UNANSWERED')) define('_NAV_UNANSWERED','Unbeantwortete Beitr&auml;ge');
if (!defined('_NAV_YOURPOSTS')) define('_NAV_YOURPOSTS','Ihre Forenbeitr&auml;ge');
if (!defined('_NAV_ADMINMODS')) define('_NAV_ADMINMODS','Admin Module');
if (!defined('_NAV_YOURACCOUNT')) define('_NAV_YOURACCOUNT','Your Account');
if (!defined('_NAV_PM')) define('_NAV_PM','Private Nachrichten');
if (!defined('_NAV_PREFS')) define('_NAV_PREFS','Einstellungen');
if (!defined('_NAV_CHGTHEME')) define('_NAV_CHGTHEME','Themenwechsel');
if (!defined('_NAV_SITEINFO')) define('_NAV_SITEINFO','Seiten Info');
if (!defined('_NAV_SITEMAP')) define('_NAV_SITEMAP','Sitemap');
if (!defined('_NAV_CONTACTS')) define('_NAV_CONTACTS','Contacts');
if (!defined('_NAV_FEEDBACK')) define('_NAV_FEEDBACK','Feedback');
if (!defined('_NAV_RECOMMEND')) define('_NAV_RECOMMEND','Recommend Us');
if (!defined('_NAV_HOWTOINSTALL')) define('_NAV_HOWTOINSTALL','How to Install');
if (!defined('_NAV_LEGAL')) define('_NAV_LEGAL','Legal');
if (!defined('_NAV_MEMBERS')) define('_NAV_MEMBERS','Mitglieder');
if (!defined('_NAV_STATS')) define('_NAV_STATS','Statistik');
if (!defined('_NAV_CREDITS')) define('_NAV_CREDITS','Credits');
if (!defined('_NAV_ADMIN')) define('_NAV_ADMIN','Admin');
if (!defined('_NAV_ACP')) define('_NAV_ACP','Administrationsmen&uuml;');
if (!defined('_NAV_APPEARANCE')) define('_NAV_APPEARANCE','Ansicht');
if (!defined('_NAV_BLOCKS')) define('_NAV_BLOCKS','Bl&ouml;cke');
if (!defined('_NAV_MSGS')) define('_NAV_MSGS','Nachrichten');
if (!defined('_NAV_MODS')) define('_NAV_MODS','Module');
if (!defined('_NAV_LGL')) define('_NAV_LGL','Legal');
if (!defined('_NAV_SETTINGS')) define('_NAV_SETTINGS','Seiteneinstellungen');
if (!defined('_NAV_ADMINS')) define('_NAV_ADMINS','Admins');
if (!defined('_NAV_GROUPS')) define('_NAV_GROUPS','Gruppen');
if (!defined('_NAV_POINTS')) define('_NAV_POINTS','Punkte');
if (!defined('_NAV_SECURITY')) define('_NAV_SECURITY','Security');
if (!defined('_NAV_UTILS')) define('_NAV_UTILS','Utilities');
if (!defined('_NAV_BACKUP')) define('_NAV_BACKUP','Backup');
if (!defined('_NAV_OPTIMIZE')) define('_NAV_OPTIMIZE','Optimierung');
if (!defined('_NAV_MAILER')) define('_NAV_MAILER','Mailer');
if (!defined('_NAV_NEWSTORY')) define('_NAV_NEWSTORY','Neue Story');
if (!defined('_NAV_CHGPOLL')) define('_NAV_CHGPOLL','Umfrage &auml;ndern');
if (!defined('_NAV_COMMENTS')) define('_NAV_COMMENTS','Kommentare');
if (!defined('_NAV_NEWS')) define('_NAV_NEWS','News');

// nukeNAV - SEO modal dialog
if (!defined('_HEAD_TAG')) define('_HEAD_TAG','HEAD Tag');
if (!defined('_OVERRIDE_TAG')) define('_OVERRIDE_TAG','Override Tag');
if (!defined('_GENERATED_TAG')) define('_GENERATED_TAG','Generierter Tag');
if (!defined('_TITLE')) define('_TITLE','Titel');
if (!defined('_TITLE_HLP')) define('_TITLE_HLP','Empfohlene Werte: <strong>70 bis 90 Zeichen.</strong><br /><br />Der Seitentitel ist im TITLE META tag definiert und d&uuml;rfte das <span class="thick">wichtigste Merkmal</span> f&uuml;r Suchmaschinenranking sein. Der Seitentitel sollte eine schl&uuml;ssige Beschreibung der Seite beinhalten und sollte Keyw&ouml;rter enthalten, die sich innerhalb des Seiteninhalts befinden.');
if (!defined('_DESCRIPTION')) define('_DESCRIPTION','Beschreibung');
if (!defined('_DESCRIPTION_HLP')) define('_DESCRIPTION_HLP','Empfohlene Werte: <strong>Mindestens 180-200 Zeichen jedoch nicht mehr als 1000 Zeichen.</strong><br /><br />Der DESCRIPTION META tag sollte eine schl&uuml;ssige Beschreibung der Seiten beinhalten, und sollte W&ouml;rter enthalten, die sich innerhalt des Seiteninhalts befinden.');
if (!defined('_KEYWORDS')) define('_KEYWORDS','Keyw&ouml;rter');
if (!defined('_KEYWORDS_HLP')) define('_KEYWORDS_HLP','Empfohlene Werte: <strong>12 oder weniger	W&ouml;rter / Phrasen, bis zu 255 Zeichen</strong><br /><br />F&uuml;r  beste Ergebnisse mit dem KEYW&Ouml;RTER META tag, w&auml;hlen Sie 12 der meist beliebtesten und relevanten Keyw&ouml;rter auf dieser jeweiligen Seite. Idealerweise Keyw&ouml;rter, Phrasen von 2 bis 3 W&ouml;rter getrennt durch ein Komma. Stellen Sie sicher, dass die Keyw&ouml;rter, die Sie verwenden, sich im Titel, Beschreibung und Inhalt der Seite befinden. Falls nicht,  f&uuml;gen Sie NICHT extra W&ouml;rter hinzu, sonst wird das Thema Ihrer Seite eher abgeschw&auml;cht. Die Reihenfolge spielt ebenfalls eine Rolle. Stellen Sie sicher, dass Sie die Keyw&ouml;rter nach Wichtigkeit anordnen.');
if (!defined('_OVERRIDE_TAGS')) define('_OVERRIDE_TAGS','Override META Tags');
if (!defined('_OVERRIDE_META')) define('_OVERRIDE_META','Save overrides');
if (!defined('_NAV_VARIABLES')) define('_NAV_VARIABLES','% Variablen');
if (!defined('_NAV_VARIABLES_HLP')) define('_NAV_VARIABLES_HLP','Mehrere Variablen sind verf&uuml;gbar f&uuml;r die Benutzung in HEAD tags:<br /><ul><li><span class="thick">%sitename%</span> - der Seitenname eingestellt unter Admin, Einstellungen (aka Seiteneinstellungen)</li><li><span class="thick">%slogan%</span> - der Seiten Slogan eingestellt unter Admin, Einstellungen (aka Seiteneinstellungen)</li><li><span class="thick">%module%</span> - der aktuelle Moduletitel</li><li><span class="thick">%year%</span> - das aktuelle 4-digit Gregorianische Jahr (z.B. 2009 f&uuml;r Copyright)</li></ul>Diese Variablen sind in Kleinschreibung.Sie m&uuml;ssen vorangestellt und abgeschlossen werden durch %.');
if (!defined('_NAV_LEVEL')) define('_NAV_LEVEL','HEAD Tag Level');
if (!defined('_NAV_LEVEL_HLP')) define('_NAV_LEVEL_HLP','HEAD-Tags können auf folgenden Ebenen mit der höchsten Ebene des Einzelnen generiert und überschrieben werden. Gilt f&uuml;r:<br /><br />0. <span class="thick">Seite</span> (index page)<br />1. <span class="thick">Module</span><br />2. <span class="thick">Kategorie</span> (e.g. Forum Kategorie)<br />3. <span class="thick">Subkategorie</span> (e.g. Forum)<br />4. <span class="thick">Content</span> (e.g. Forum Topic, News story)<br /><br />Hinweis:site level override ist erforderlich und kann nicht gel&ouml;scht werden.');
if (!defined('_LEVEL0')) define('_LEVEL0','Seite');
if (!defined('_LEVEL1')) define('_LEVEL1','Module');
if (!defined('_LEVEL2')) define('_LEVEL2','Kategorie');
if (!defined('_LEVEL3')) define('_LEVEL3','Subkategorie');
if (!defined('_LEVEL4')) define('_LEVEL4','Content');
if (!defined('_DELETE_OVERRIDES')) define('_DELETE_OVERRIDES','L&ouml;sche &Auml;nderungen');
if (!defined('_OVERRIDES_DELETED')) define('_OVERRIDES_DELETED','Die ge&auml;nderten HEAD tags wurden gel&ouml;scht. Aktualisieren Sie die Seite, um die &Auml;nderungen zu sehen.');
if (!defined('_OVERRIDES_SAVED')) define('_OVERRIDES_SAVED','Die ge&auml;nderten HEAD tags wurden gespeichert. Aktualisieren Sie die Seite, um die &Auml;nderungen zu sehen.');
?>
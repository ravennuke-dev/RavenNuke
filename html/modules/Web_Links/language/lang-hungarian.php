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
define("_1WEEK","1 h&eacute;t");
define("_2WEEKS","2 h&eacute;t");
define("_30DAYS","30 nap");
define("_ADDALINK","&Uacute;j link hozz&aacute;ad&aacute;sa");
define("_ADDEDON","Felv&eacute;tel napja");
define("_ADDITIONALDET","Egy&eacute;b r&eacute;szletek");
define("_ADDLINK","Link hozz&aacute;ad&aacute;sa");
define("_ADDURL","Link hozz&aacute;ad&aacute;sa");
define("_ALLOWTORATE","Tegye lehet&otilde;v&eacute;, hogy m&aacute;sok is &eacute;rt&eacute;kelni tudj&aacute;k az &Ouml;n oldal&aacute;r&oacute;l!");
define("_AND","&eacute;s");
define("_BESTRATED","Legjobb &eacute;rt&eacute;ket kapott oldalak");
define("_BREAKDOWNBYVAL","&Eacute;rt&eacute;kel&eacute;s eloszl&aacute;sa");
define("_BUTTONLINK","Nyom&oacute;gomb");
define("_CATEGORIES","kateg&oacute;ria");
if (!defined('_CATEGORY')) define("_CATEGORY","Kateg&oacute;ria");
define("_CATLAST3DAYS","A kateg&oacute;ria &uacute;j linkjei az elm&uacute;lt h&aacute;rom napban");
define("_CATNEWTODAY","A kateg&oacute;ria mai &uacute;j linkjei");
define("_CATTHISWEEK","A kateg&oacute;ria &uacute;j linkjei az elm&uacute;lt h&eacute;ten");
define("_CHECKFORIT","Nem adott meg e-mail c&iacute;met. Hamarosan ellen&otilde;rizz&uuml;k a linket, &eacute;s beker&uuml;l az adatb&aacute;zisba.");
define("_COMPLETEVOTE1","Elfogadtuk a szavazat&aacute;t.");
define("_COMPLETEVOTE2","M&aacute;r szavazott az elm&uacute;lt $anonwaitdays napban.");
define("_COMPLETEVOTE3","Csak egyszer szavazzon egy linkre.<br>Minden szavazatot r&ouml;gz&iacute;t&uuml;nk &eacute;s fel&uuml;lvizsg&aacute;lunk.");
define("_COMPLETEVOTE4","Nem szavazhat a saj&aacute;t maga &aacute;ltal bek&uuml;ld&ouml;tt linkre.<br>Minden szavazatot r&ouml;gz&iacute;t&uuml;nk &eacute;s fel&uuml;lvizsg&aacute;lunk.");
define("_COMPLETEVOTE5","Nem volt kijel&ouml;lve v&aacute;laszt&aacute;si lehet&otilde;s&eacute;g, ez&eacute;rt a szavazat&aacute;t nem fogadtuk el.");
define("_COMPLETEVOTE6","$outsidewaitdays napon bel&uuml;l egy IP c&iacute;mr&otilde;l csak egyszer lehet szavazni.");
if (!defined('_DATE')) define("_DATE","D&aacute;tum");
define("_DATE1","D&aacute;tum (el&otilde;sz&ouml;r a r&eacute;gebbiek)");
define("_DATE2","D&aacute;tum (el&otilde;sz&ouml;r az &uacute;jabbak)");
define("_DAYS","napban");
define("_DESCRIPTION","Le&iacute;r&aacute;s");
define("_DETAILS","R&eacute;szletek");
define("_EDITORIAL","Szerkeszt&otilde;i v&eacute;lem&eacute;ny");
define("_EDITORIALBY","Szerkeszt&otilde;:");
define("_EDITORREVIEW","Szerkeszt&otilde;i v&eacute;lem&eacute;ny");
define("_EDITTHISLINK","Link szerkeszt&eacute;se");
define("_EMAILWHENADD","A link j&oacute;v&aacute;hagy&aacute;sakor e-mailt k&uuml;ld&uuml;nk &Ouml;nnek is.");
define("_FEELFREE2ADD","Nyugodtan k&uuml;ldje el megjegyz&eacute;s&eacute;t ezzel a weboldallal kapcsolatban.");
define('_HIGHRATING','Legmagasabb oszt&aacute;lyzat');
define('_HITS','tal&aacute;lat');
define("_HTMLCODE1","Ebben az esetben haszn&aacute;lja a k&ouml;vetkez&otilde; HTML k&oacute;dot:");
define("_HTMLCODE2","A fenti gomb forr&aacute;sk&oacute;dja:");
define("_HTMLCODE3","Ezzel az &ucirc;rlappal a l&aacute;togat&oacute;i k&ouml;zvetlen&uuml;l szavazhatnak a weboldal&aacute;ra, a szavazatokat pedig mi t&aacute;roljuk. A fenti &ucirc;rlap nem m&ucirc;k&ouml;dik, de a k&ouml;vetkez&otilde; k&oacute;d m&ucirc;k&ouml;dni fog, ha besz&uacute;rja a weboldala forr&aacute;s&aacute;ba:");
define("_IDREFER","sz&aacute;m a HTML forr&aacute;sban az &Ouml;n weboldal&aacute;nak azonos&iacute;t&oacute; sz&aacute;ma a(z) $sitename adatb&aacute;zis&aacute;ban. Vigy&aacute;zzon, nehogy kihagyja!");
define("_IFYOUWEREREG","Regisztr&aacute;lt felhaszn&aacute;l&oacute;k&eacute;nt megjegyz&eacute;seket f&ucirc;zhetne ehhez a weboldalhoz.");
define("_INDB","tal&aacute;lhat&oacute; az adatb&aacute;zisban");
define("_INOTHERSENGINES","m&aacute;s keres&otilde;kkel");
define("_INSTRUCTIONS","&Uacute;tmutat&oacute;");
define("_ISTHISYOURSITE","&Ouml;n k&uuml;ldte be ezt a linket?");
define("_LAST30DAYS","M&uacute;lt h&oacute;napban");
define("_LASTWEEK","M&uacute;lt h&eacute;ten");
define("_LDESCRIPTION","Le&iacute;r&aacute;s: (max. 255 karakter)");
define("_LETSDECIDE","A visszajelz&eacute;sek seg&iacute;tik, hogy l&aacute;togat&oacute;ink a megfelel&otilde; linkekre kattintsanak.");
define("_LINKALREADYEXT","HIBA: Ez az URL m&aacute;r benne van az adatb&aacute;zisunkban!");
define("_LINKCOMMENTS","Megjegyz&eacute;sek");
define("_LINKID","Link sz&aacute;ma");
define("_LINKNODESC","HIBA: K&eacute;rem, adja meg az URL r&ouml;vid le&iacute;r&aacute;s&aacute;t is!");
define("_LINKNOTITLE","HIBA: Az URL c&iacute;m&eacute;t is add meg!");
define("_LINKNOURL","HIBA: Elfelejtette megadni mag&aacute;t az URL-t!");
define("_LINKPROFILE","Az oldal neve");
define("_LINKRATING","Link &eacute;rt&eacute;kel&eacute;se");
define("_LINKRATINGDET","Link &eacute;rt&eacute;kel&eacute;s&eacute;nek r&eacute;szletei");
define("_LINKRECEIVED","Az &Ouml;n &aacute;ltal megadott adatokat regisztr&aacute;ltuk. K&ouml;sz&ouml;nj&uuml;k!");
define("_LINKS","link");
define('_LINKSDATESTRING','%d-%b-%Y');
define("_LINKSMAIN","Linkek kezd&otilde;oldala");
define("_LINKSMAINCAT","Linkek - f&otilde; kateg&oacute;ri&aacute;k");
define('_LINKSNOCATS1','Legal&aacute;bb egy link kateg&oacute;ri&aacute;t l&eacute;tre kell hoznia a'); //montego for RN0000571
define('_LINKSNOCATS2','webadminnak, miel&otilde;tt &uacute;j linket hozz&aacute; tud adni.'); //montego for RN0000571
define("_LINKSNOTUSER1","&Ouml;n nem regisztr&aacute;lt felhaszn&aacute;l&oacute;nk, vagy nem l&eacute;pett be.");
define("_LINKSNOTUSER2","Ha regisztr&aacute;ln&aacute; mag&aacute;t, &Ouml;n is hozz&aacute;adhatna &uacute;j linkeket.");
define("_LINKSNOTUSER3","A regisztr&aacute;ci&oacute; gyors &eacute;s igen egyszer&ucirc; folyamat.");
define("_LINKSNOTUSER4","Hogy mi&eacute;rt k&eacute;r&uuml;nk regisztr&aacute;ci&oacute;t egyes oldalakon?");
define("_LINKSNOTUSER5","Hogy a legmagasabb szint&ucirc; tartalommal szolg&aacute;lhassunk,");
define("_LINKSNOTUSER6","minden bevitt adatot egyes&eacute;vel ellen&otilde;riznek munkat&aacute;rsaink.");
define("_LINKSNOTUSER7","Rem&eacute;lj&uuml;k, mindenhol siker&uuml;l &eacute;rt&eacute;kes inform&aacute;ci&oacute;kat ny&uacute;jtanunk.");
define("_LINKSNOTUSER8","<a href=\"modules.php?name=Your_Account\">Regisztr&aacute;lja mag&aacute;t!</a>");
define("_LINKTITLE","A c&eacute;loldal neve");
define("_LINKVOTE","Szavazzon!");
define("_LOOKTOREQUEST","Hamarosan ellen&otilde;rizz&uuml;k az inform&aacute;ci&oacute;it.");
define("_LOWRATING","Legalacsonyabb &eacute;rt&eacute;k");
define("_LTOTALVOTES","szavazat");
define("_LVOTES","szavazat");
define("_MAIN","F&otilde;oldal");
if(!defined("_MODIFY")) define("_MODIFY","V&aacute;ltoztat&aacute;s");
define("_MOSTPOPULAR","Legkedveltebb");
define("_NEW","Leg&uacute;jabb");
define("_NEWLAST3DAYS","Az elm&uacute;lt h&aacute;rom nap linkjei");
define("_NEWLINKS","&Uacute;j linkek");
define("_NEWTHISWEEK","Az elm&uacute;lt h&eacute;t linkjei");
define("_NEWTODAY","Mai linkek");
define("_NEXT","K&ouml;vetkez&otilde; oldal");
define("_NOEDITORIAL","Err&otilde;l a weboldalr&oacute;l m&eacute;g nincs szerkeszt&otilde;i v&eacute;lem&eacute;ny.");
define("_NOMATCHES","A keres&eacute;s nem eredm&eacute;nyezett tal&aacute;latot");
define("_NOOUTSIDEVOTES","M&aacute;s weboldalakon m&eacute;g nem &eacute;rt&eacute;kelt&eacute;k");
define("_NOREGUSERSVOTES","Regisztr&aacute;lt felhaszn&aacute;l&oacute; m&eacute;g nem &eacute;rt&eacute;kelte");
define("_NOUNREGUSERSVOTES","Regisztr&aacute;latlan l&aacute;togat&oacute; m&eacute;g nem &eacute;rt&eacute;kelte");
define("_NUMBEROFRATINGS","&Eacute;rt&eacute;kel&eacute;sek sz&aacute;ma");
define("_NUMOFCOMMENTS","Megjegyz&eacute;sek sz&aacute;ma");
define("_NUMRATINGS","&Eacute;rtkel&eacute;sek sz&aacute;ma");
if (!defined('_OF')) define("_OF","-");
define("_OFALL","az &ouml;sszesb&otilde;l");
define("_ONLYREGUSERSMODIFY","Csak regisztr&aacute;lt felhaszn&aacute;l&oacute;k k&eacute;rhetnek linkm&oacute;dos&iacute;t&aacute;st. K&eacute;rem <a href=\"modules.php?name=Your_Account\">regisztr&aacute;lon, vagy jelentkezzen be</a>!");
define("_OUTSIDEVOTERS","Szavazatok m&aacute;s weboldalakr&oacute;l");
define("_OVERALLRATING","&Aacute;tlag");
define("_PAGETITLE","Az oldal c&iacute;me");
define("_PAGEURL","Link");
define("_POPULAR","Legn&eacute;pszer&ucirc;bb");
define("_POPULARITY","N&eacute;pszer&ucirc;s&eacute;g");
define("_POPULARITY1","N&eacute;pszer&ucirc;s&eacute;g (n&ouml;vekv&otilde; sorrend)");
define("_POPULARITY2","N&eacute;pszer&ucirc;s&eacute;g (cs&ouml;kken&otilde; sorrend)");
define("_POSTPENDING","A linkek csak ellen&otilde;rz&eacute;s ut&aacute;n ker&uuml;lnek az adatb&aacute;zisba.");
define("_PREVIOUS","El&otilde;z&otilde; oldal");
define("_PROMOTE01","Tal&aacute;n &eacute;rdekli valamelyik 'Szavazzon erre a weboldalra' lehet&otilde;s&eacute;g&uuml;nk. Ezek lehet&otilde;v&eacute; teszik egy link (vagy ak&aacute;r szavaz&oacute;&ucirc;rlap) elhelyez&eacute;s&eacute;t az &Ouml;n weboldal&aacute;n, hogy n&ouml;velje az oldala szavazatainak sz&aacute;m&aacute;t. V&aacute;lasszon a lenti lehet&otilde;s&eacute;gek k&ouml;z&uuml;l:");
define("_PROMOTE02","L&aacute;togat&oacute;i szavazhatnak egyszer&ucirc; sz&ouml;veges link seg&iacute;ts&eacute;g&eacute;vel:");
define("_PROMOTE03","Ha esetleg t&ouml;bbet szeretne, mint egy egyszer&ucirc; sz&ouml;veglink, haszn&aacute;lhat nyom&oacute;gombot:");
define("_PROMOTE04","Ha valaki csal, a linkj&eacute;t elt&aacute;vol&iacute;tjuk. &Iacute;gy fog kin&eacute;zni a k&eacute;rd&otilde;&iacute;v, amellyel az oldal&aacute;t m&aacute;s weboldalakr&oacute;l is &eacute;rt&eacute;kelhetik:");
define("_PROMOTE05","K&ouml;sz&ouml;n&ouml;m! &eacute;s sok sikert a szavazatokkal!");
define("_PROMOTEYOURSITE","N&eacute;pszer&ucirc;s&iacute;tse a weboldal&aacute;t");
define("_RANDOM","V&eacute;letlenszer&ucirc;en");
define("_RATEIT","Szavazzon erre az oldalra!");
define("_RATENOTE1","K&eacute;rem, ne szavazzon k&eacute;tszer egy linkre.");
define("_RATENOTE2","1-10-ig &eacute;rt&eacute;kelhet, az 1-es a leggyeng&eacute;bb, a 10-es a legjobb &eacute;rt&eacute;k.");
define("_RATENOTE3","K&eacute;rjem, &eacute;rt&eacute;keljen objekt&iacute;van, ha mindenki egyest vagy tizest kap, nem sok seg&iacute;ts&eacute;get ny&uacute;jtanak az &eacute;rt&eacute;kel&eacute;sek...");
define("_RATENOTE4","Megn&eacute;zheti a <a href=\"modules.php?name=Web_Links&amp;l_op=TopRated\">legjobb &eacute;rt&eacute;keket kapott oldalak</a> list&aacute;j&aacute;t.");
define("_RATENOTE5","Ha lehet, ne szavazzon saj&aacute;t, vagy k&ouml;zvetlen versenyt&aacute;rsai weboldal&aacute;ra.");
define("_RATESITE","&Eacute;rt&eacute;kelje ezt az oldalt");
define("_RATETHISSITE","&Eacute;rt&eacute;kelje ezt a weboldalt");
define("_RATING","&eacute;rt&eacute;kel&eacute;s");
define("_RATING1","&Eacute;rt&eacute;kel&eacute;sek (n&ouml;vekv&otilde; sorrend)");
define("_RATING2","&Eacute;rt&eacute;kel&eacute;sek (cs&ouml;kken&otilde; sorrend)");
define("_REGISTEREDUSERS","Regisztr&aacute;lt felhaszn&aacute;l&oacute;k");
define("_REMOTEFORM","T&aacute;voli szavaz&oacute;&ucirc;rlap");
define("_REPORTBROKEN","T&ouml;r&ouml;tt link bejelent&eacute;se");
define("_REQUESTLINKMOD","Link v&aacute;ltoztat&aacute;s&aacute;nak k&eacute;r&eacute;se");
define("_RETURNTO","Vissza az el&otilde;z&otilde; oldalra:");
define("_SCOMMENTS","Megjegyz&eacute;sek");
define("_SEARCHRESULTS4","Keres&eacute;s:");
define("_SELECTPAGE","V&aacute;lasszon oldalt");
define("_SENDREQUEST","K&eacute;r&eacute;s elk&uuml;ld&eacute;se");
define("_SHOW","Megtekint&eacute;s");
define("_SHOWTOP","Legn&eacute;zettebb");
define("_SITESSORTED","Jelenlegi sorbarendez&eacute;s:");
define("_SORTLINKSBY","Sorbarendez&eacute;s:");
define("_STAFF","Munkat&aacute;rsak");
define("_SUBMITONCE","Egy linket csak egyszer k&uuml;ldj&ouml;n el.");
define("_TEXTLINK","Sz&ouml;veges link");
define("_THANKSBROKEN","K&ouml;sz&ouml;n&ouml;m, hogy seg&iacute;t fenntartani a linkt&aacute;runk m&ucirc;k&ouml;d&eacute;s&eacute;t.");
define("_THANKSFORINFO","K&ouml;sz&ouml;nj&uuml;k az inform&aacute;ci&oacute;t.");
define("_THANKSTOTAKETIME","K&ouml;sz&ouml;n&ouml;m, hogy id&otilde;t sz&aacute;nt egy oldal &eacute;rt&eacute;kel&eacute;sere itt n&aacute;lam -");
define("_THENUMBER","A");
define("_THEREARE","Jelenleg");
define("_TITLE","C&iacute;m");
define("_TITLEAZ","C&iacute;m (A-Z)");
define("_TITLEZA","C&iacute;m (Z-A)");
define("_TO","C&iacute;mzett");
define("_TOPRATED","Legjobbra oszt&aacute;lyozott");
define("_TOTALFORLAST","&Ouml;sszes link az elm&uacute;lt");
define("_TOTALNEWLINKS","Linkek sz&aacute;ma &ouml;sszesen");
define("_TOTALOF","&Ouml;sszesen");
define("_TOTALVOTES","&Ouml;sszes szavazat:");
define("_TRATEDLINKS","&ouml;sszesen &eacute;rt&eacute;kelt oldal");
define("_TRY2SEARCH","Keres&eacute;s");
define("_TVOTESREQ","a minim&aacute;lisan sz&uuml;ks&eacute;ges szavazatok sz.");
define("_UNREGISTEREDUSERS","Nem regisztr&aacute;lt l&aacute;togat&oacute;k");
define("_URL","URL");
define("_USER","felhaszn&aacute;l&oacute;");
define("_USERANDIP","A felhaszn&aacute;l&oacute;n&eacute;v &eacute;s az IP c&iacute;m feljegyz&eacute;sre ker&uuml;l, k&eacute;rem, ne &eacute;ljen vissza a rendszerrel.");
define("_USERAVGRATING","felhaszn&aacute;l&oacute;k &aacute;tlagos &eacute;rt&eacute;kel&eacute;se");
define("_USUBCATEGORIES","Alkateg&oacute;ri&aacute;k");
define("_VISITTHISSITE","L&aacute;togassa meg ezt a weboldalt");
define("_VOTE4THISSITE","Szavazzon erre az oldalra!");
define("_WEBLINKS","Linkek");
define("_WEIGHNOTE","* Megjegyz&eacute;s: a regisztr&aacute;lt felhaszn&aacute;l&oacute;k &eacute;rt&eacute;kel&eacute;se t&ouml;bbet nyom, mint a l&aacute;togat&oacute;k&eacute;");
define("_WEIGHOUTNOTE","* Megjegyz&eacute;s: a regisztr&aacute;lt felhaszn&aacute;l&oacute;k &eacute;rt&eacute;kel&eacute;se t&ouml;bbet nyom, mint a m&aacute;s weboldalakon szavaz&oacute;k&eacute;");
define("_YOUARENOTREGGED","Nem regisztr&aacute;lt felhaszn&aacute;l&oacute;nk, vagy nem l&eacute;pett be.");
define("_YOUAREREGGED","&Ouml;n regisztr&aacute;lt felhaszn&aacute;l&oacute;, &eacute;s bel&eacute;pett.");
define("_YOUREMAIL","e-mail c&iacute;me");
define("_YOURNAME","Neve");
?>
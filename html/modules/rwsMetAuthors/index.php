<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* MetAuthors v1.0                                                      */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2004 by Heshy Shayovitz- Metcomp                       */
/* http://www.metopen.com                                               */
/*                                                                      */
/*                                                                      */
/* Based on Top module from                                             */
/*      PHPNuke-Service.de- http://www.phpnuke-service.de               */
/*      Complex-Berlin.de- http://www.complex-berlin.de                 */
/************************************************************************/


if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

// The following function is experimental and is not used
Function MetAuthorsUpdateAuthors ($articleid,$author){
   if ($articleid > ""  and $author > ""){
    global $db, $prefix;
    $sql = "UPDATE `".$prefix."_stories` SET `informant` = '$author', aid= '$author' WHERE `sid` = '$articleid' LIMIT 1 ";
    //echo $sql;
    $result = $db->sql_query($sql);
    echo ' '._MA_ARTICLEID.' '.$articleid.' '._MA_ARTICLE_AUTHOR_UPDATE.' '.$author.' .$result<br />';
   } else {
       echo '_MA_ARTICLE_UPDATE_WARNING';
   }
}
// The following function is experimental and is not used as no DB tables exist - no language defines have been created for this function
Function MetAuthorsColumnists(){
	$module_name = basename(dirname(__FILE__));
	global $db, $prefix, $cookie, $user;
	if (is_user($user)) {
		if(!is_array($user)) {
			$cookie = cookiedecode($user);
			$uname = $cookie[1];
		} else {
			$uname = $user[1];
		}
	} else {
		$uname = 'Anonymous';
	}
   include_once("header.php");
   MetAuthorsMenu();
   //Display author list
   echo "<a name=\"authorlist\">";
   OpenTable();
   echo "<tr><td colspan=\"6\"><span class='thick'>Author List:</span></td></tr>";
   echo "<tr><td><span class='thick'></span></td><td><span class='thick'>Author's Bio</span></td><td><span class='thick'>Info</span></td></tr>";
   $sql = "select ma.metauthorsid, ma.username as informant, ma.Salutation,  ma.last,  ma.first, ma.midinit, ma.suffix,  ma.img,  ma.bio,  ma.columnist,  ma.title, "
         ."count(*) as totcount, sum(st.counter) as totreads, round(avg(st.counter),0) as avgreads, round(avg( st.counter / ( TO_DAYS( NOW( ) ) - TO_DAYS( st.time ) ) ),1) AS readsperday, sum(st.ratings) as totvotes, round(sum(st.score)/sum(st.ratings),1) as avgrating "
         ."from ".$prefix."_metauthors ma, ".$prefix."_stories st where ma.username=st.informant group by ma.username order by ma.last, ma.first desc ";
   //echo $sql;
   $result = $db->sql_query($sql);

   while ($row = $db->sql_fetchrow($result)) {
     $authorname = $row['salutation']." ".$row['first']." ".$row['midinit']." ".$row['last'];
     echo (($uname == $row['informant'] && $uname != '') ? "<tr border=\"0\">" : "<tr border=\"0\">");
     echo "<td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">"
         ."<img src=\"".$row['img']."\" valign=\"top\" border =\"0\" alt=\"\" /><br />";
     echo (($uname == $row['informant'] && $uname != '') ? "<span class='italic'>".$row['informant']."</span>" : $row['informant']) ;
     echo "</a></td>"
         ."<td><span class='thick'>".$authorname."</span><br />"
         .$row['bio']."</td>"
         ."<td>Articles: <span class='thick'>".$row['totcount']."</span><br /> Reads: ".$row['totreads']."<br /> Avg Reads: ".$row['avgreads']."<br />Avg Rating: <span class='thick'>".$row['avgrating']."</span>/5.0<br />"
         ."<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">Read More From ".$authorname."</td>";
   }
   CloseTable();
   echo "<br />";

   echo "<form action=\"modules.php?name=".$module_name."\" method=\"post\">"
        ."Add a Columnist:<br />"
        ."Article Id: <input type=\"text\" name=\"articleid\" size=\"5\" value=\"\" /> "
        ."Author: <input type=\"text\" name=\"author\" size=\"15\" value=\"\" /> "
        ."<input type=\"hidden\" name=\"maction\" value=\"updateauthors\" />"
        ."<input type=\"submit\" value=\"GO\" />"
        ."</form>";
}

Function MetAuthorsMenu ($currentmenu=""){
  $module_name = basename(dirname(__FILE__));
 // echo "[ <a href=\"modules.php?name=".$module_name."&amp;op=stats\">Stats</a> | <a href=\"modules.php?name=".$module_name."&amp;op=columnists\">Columnists</a> ].";
}

Function MetAuthorsStats (){
	global $db, $admin, $prefix, $top, $cookie, $user, $sitename, $multilingual, $currentlang;
	$module_name = basename(dirname(__FILE__));
	if (is_user($user)) {
		if(!is_array($user)) {
			$cookie = cookiedecode($user);
			$uname = $cookie[1];
		} else {
			$uname = $user[1];
		}
	} else {
		$uname = 'Anonymous';
	}
   include_once("header.php");

   if ($multilingual == 1) {
     $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories which are posted to ALL languages */

     $queryalang = "WHERE (alanguage='$currentlang' OR alanguage='')"; /* top stories */
     $querya1lang = "WHERE (alanguage='$currentlang' OR alanguage='') AND"; /* top stories */
     $queryslang = "WHERE slanguage='$currentlang' "; /* top section articles */
     $queryplang = "WHERE planguage='$currentlang' "; /* top polls */
     $queryrlang = "WHERE rlanguage='$currentlang' "; /* top reviews */
   } else {
     $queryalang = "";
     $querya1lang = "WHERE";
     $queryslang = "";
     $queryplang = "";
     $queryrlang = "";
     $querylang = "";
   }

   OpenTable();
   echo '<div class="text-center thick title">' , _TOPWELCOME , ': ' , $sitename , '!</div>';
   CloseTable();
   echo "<br />\n\n";
   MetAuthorsMenu();


//   echo "<p>";
   if ($uname > "") echo _WELCOME." ".$uname.", <br /><br />";
   OpenTable();
   echo "<span class='thick underline'>"._SUBMITCONTENT."</span><br /><br />";
       echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Submit_News\">"._SUBMITARTICLE."</a><br />";
       echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Reviews&amp;rop=write_review\">"._WRITEREVIEW."</a><br />";
       echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Web_Links&amp;file=index&amp;l_op=AddLink\">"._SUBMITWEBLINK."</a><br />";
   echo "<br />";
   echo "<span class='thick underline'>"._STATISTICS."</span><br /><br />";
   echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#qstat\">"._QUICKSTATOVERVIEW."</a><br />"
       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#tstories30\">"._TOPRECENTSTORIES."</a><br />"
       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#tstoriesall\">"._TOPALLSTORIES."</a><br />"
       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#tauthors\">"._TOPAUTHORS."</a><br />"
       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#monthlyarticlesoverview\">"._MONTHLYARTICLEOVERVIEW."</a><br />"
       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#articlecountbytopic\">"._ARTICLECOUNTBYTOPIC."</a><br />"
       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#articlecountbycategory\">"._ARTICLECOUNTBYCATEGORY."</a><br />"
       ."<hr />";
// the following code is not used yet - Guardian
       //   if (is_admin($admin)){
 //    if ($maction == "updateauthors") MetAuthorsUpdateAuthors($articleid,$author);
 //    echo "<form action=\"modules.php?name=".$module_name."\" method=\"post\">"
  //        ."<span class='thick underline'>Move an Article to a different author:</span><br /><br />"
   //       ."Article Id: <input type=\"text\" name=\"articleid\" size=\"5\" value=\"\" /> "
    //      ."Author: <input type=\"text\" name=\"author\" size=\"15\" value=\"\" /> "
     //     ."<input type=\"hidden\" name=\"maction\" value=\"updateauthors\" />"
      //    ."<input type=\"submit\" value=\"GO\" />"
       //   ."</form>";
  //   echo "<hr />";
 //  }
   /* Quick Stat Overview  */
   echo "<a name=\"qstat\">";
   echo "<span class='thick underline'>"._QUICKSTATOVERVIEW."</span></a><br /><br />";
   $sql = "SELECT sum( counter ) "
       ."FROM ".$prefix."_stories ";
   $result = $db->sql_query($sql);
   if ($db->sql_numrows($result)>0) { $row = $db->sql_fetchrow($result); }
   else { $row[0] = 0; }
   $numreadso = $row[0];

   //recent stories
   $sql = "SELECT count(sid), sum( counter ) "
       ."FROM ".$prefix."_stories where  (TO_DAYS(NOW()) - TO_DAYS(time) <= 30)  ";
   $result = $db->sql_query($sql);
   if ($db->sql_numrows($result)>0) { $row = $db->sql_fetchrow($result); }
   else { $row[0] = 0; }
   $numstoriesr = $row[0];
   $numreadsr = $row[1];

   $sql = "SELECT counter FROM ".$prefix."_stories  ORDER BY counter DESC  LIMIT 9 , 1";
   $result = $db->sql_query($sql);
   if ($db->sql_numrows($result)>0) { $row = $db->sql_fetchrow($result); }
   else { $row[0] = 0; }
   $readstotop =$row[0];
   $sql = "SELECT sum( counter ) "
       ."FROM ".$prefix."_stories where counter >= $row[0] order by counter desc ";
   $result = $db->sql_query($sql);
   if ($db->sql_numrows($result)>0) { $row = $db->sql_fetchrow($result); }
   else { $row[0] = 0; }
   $numreadst = $row[0];

   $sql = "SELECT count( sid ) "
       ."FROM ".$prefix."_stories ";
   $result = $db->sql_query($sql);
   if ($db->sql_numrows($result)>0) { $row = $db->sql_fetchrow($result); }
   else { $row[0] = 0; }
   $numstorieso = $row[0];
   //echo $sql."<br />";
   $numreadso = $numreadso>0?$numreadso:0; //Raven 12/16/2005
   $numreadsr = $numreadsr>0?$numreadsr:0; //Raven 12/16/2005
   $numreadst = $numreadst>0?$numreadst:0; //Raven 12/16/2005
    $numstoriesoAvg = $numstorieso>0?round(($numreadso / $numstorieso),0):0; //Raven 12/16/2005
    $numstoriesrAvg = $numstoriesr>0?round(($numreadsr / $numstoriesr),0):0; //Raven 12/16/2005
    $topAvg = $top>0?round(($numreadst / $top),0):0; //Raven 12/16/2005
   echo "<table border=\"1\" cellpadding=\"1\">"
        ."<tr><td></td><td>"._STORYREADS."</td><td>"._STORIES."</td><td>"._STORYAVGREADS."</td></tr>"
        ."<tr><td>"._OVERALL."</td><td>".$numreadso."</td><td>".$numstorieso."</td><td>".$numstoriesoAvg."</td></tr>"
        ."<tr><td>"._RECENT."</td><td>".$numreadsr."</td><td>".$numstoriesr."</td><td>".$numstoriesrAvg."</td></tr>"
        ."<tr><td>Top $top</td><td>".$numreadst."</td><td>".$top."</td><td>".$topAvg."</td></tr>";
   echo "</table>";
   echo ""._MA_READS_TO_MAKE_TOP10." ".$readstotop.". ";
    CloseTable();
   echo " <br /> <br /> ";



   //Display the top stories in the last 30 days
//   echo "<a name=\"tstories30\">";
     OpenTable();
   echo "<table><tr><td colspan=\"6\"><a name=\"tstories30\"><span class='thick underline'>"._TOPRECENTSTORIES."</span></a></td></tr>";
   echo "<tr><td><span class='thick'>#</span></td><td><span class='thick'>"._STORYTITLE."</span></td><td><span class='thick'>"._STORYDATE."</span></td><td><span class='thick'>"._AUTHORNAME."</span></td><td><span class='thick'>"._STORYREADS."</span></td><td><span class='thick'>"._READSPERDAY."</span></td></tr>";
   $sql = "select sid, title, counter, informant, left(time,10) as sttime, counter/(TO_DAYS(NOW()) - TO_DAYS(time)) as readsperday from ".$prefix."_stories where  (TO_DAYS(NOW()) - TO_DAYS(time) <= 30) $querylang order by counter desc ";
   $result = $db->sql_query($sql);
   $whilectr=1;
   while ($row = $db->sql_fetchrow($result)) {
      echo (($uname == $row['informant'] && $uname != '') ? "<tr>" : "<tr>");
      echo "<td>$whilectr</td>"
          ."<td><a href=\"modules.php?name=News&amp;file=article&amp;sid=".$row['sid']."\">".$row['title']."</a></td> "
          ."<td>".$row['sttime']."</td><td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">";
      echo (($uname == $row['informant'] && $uname != '') ? "<span class='italic'>".$row['informant']."</span>" : $row['informant']) ;
      echo "</a></td>"
          ."<td>".$row['counter']."</td><td>".$row['readsperday']."</td></tr>";
      $whilectr++;
   }
   echo "</table>";
       CloseTable();
   echo "<br />";

   //Display the top stories all time
//   echo "<a name=\"tstoriesall\">";
   OpenTable();
   echo "<table><tr><td colspan=\"6\"><a name=\"tstoriesall\"><span class='thick underline'>$top "._READSTORIES."</span></a></td></tr>";
   echo "<tr><td><span class='thick'>#</span></td><td><span class='thick'>"._STORYTITLE."</span></td><td><span class='thick'>"._STORYDATE."</span></td><td><span class='thick'>"._AUTHORNAME."</span></td><td><span class='thick'>"._STORYREADS."</span></td><td><span class='thick'>"._READSPERDAY."</span></td></tr>";
   $sql = "select sid, title, counter, informant, left(time,10) as sttime, counter/(TO_DAYS(NOW()) - TO_DAYS(time)) as readsperday  from ".$prefix."_stories where  1=1 $querylang order by counter desc limit 0,$top";
   $result = $db->sql_query($sql);
   $whilectr=1;
   while ($row = $db->sql_fetchrow($result)) {
      echo (($uname == $row['informant'] && $uname != '') ? "<tr>" : "<tr>");
      echo "<td>$whilectr</td>"
          ."<td><a href=\"modules.php?name=News&amp;file=article&amp;sid=".$row['sid']."\">".$row['title']."</a></td> "
          ."<td>".$row['sttime']."</td><td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">";
      echo (($uname == $row['informant'] && $uname != '') ? "<span class='italic'>".$row['informant']."</span>" : $row['informant']) ;
      echo "</a></td>"
          ."<td>".$row['counter']."</td><td>".$row['readsperday']."</td></tr>";

       $whilectr++;
   }
   echo "</table>";
       CloseTable();
   echo "<br />";

   /* Top 10 authors */
//   echo "<a name=\"tauthors\">";
   $sql ="select informant, count(*) as totcount, sum(counter) as totreads, round(avg(counter),0) as avgreads, round(avg( counter / ( TO_DAYS( NOW( ) ) - TO_DAYS( time ) ) ),1) AS readsperday, sum(ratings) as totvotes, round(sum(score)/sum(ratings),1) as avgrating from ".$prefix."_stories group by informant order by totreads DESC limit 0,$top";
   //echo $sql;
   $result = $db->sql_query($sql);

   if ($db->sql_numrows($result)>0) {
   OpenTable();
   echo "<table><tr><td colspan=\"6\"><a name=\"tauthors\"><span class='thick underline'>"._TOP." $top "._AUTHORS."</span></a></td></tr>";
   echo "<tr><td><span class='thick'>#</span></td><td><span class='thick'>"._AUTHORNAME."</span></td><td><span class='thick'>"._NUMSTORIES."</span></td><td><span class='thick'>"._STORYREADS."</span></td><td><span class='thick'>"._STORYAVGREADS."</span></td><td><span class='thick'>"._READSPERDAY."</span></td><td><span class='thick'>"._TOTALRATINGS."</span></td><td><span class='thick'>"._AVGRATINGS."</span></td></tr>";
     $whilectr=1;
     while ($row = $db->sql_fetchrow($result)) {
      echo (($uname == $row['informant'] && $uname != '') ? "<tr>" : "<tr>");
      echo "<td>$whilectr</td>"
          ."<td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">";
      echo (($uname == $row['informant'] && $uname != '') ? "<span class='italic'>".$row['informant']."</span>" : $row['informant']) ;
      echo "</a></td>"
          ."<td>".$row['totcount']."</td>"
          ."<td>".$row['totreads']."</td>"
          ."<td>".$row['avgreads']."</td>"
          ."<td>".$row['readsperday']."</td>"
          ."<td>".$row['totvotes']."</td>"
          ."<td>".$row['avgrating']."</td>"
          ."</tr>";

       $whilectr++;
       }
       echo "</table>";
       CloseTable();
       echo "<br />";
   } else ''._MA_NO_AUTHORS. '';


   OpenTable();
   echo "<a name=\"monthlyarticlesoverview\">"
       ."<span class='thick underline'>"._MONTHLYARTICLEOVERVIEW."</span></a><br /><br />";

   $sql = "SELECT left(time,7) as mong, count(*) as mcount FROM `".$prefix."_stories` WHERE 1 group by mong "
       ."order by mong desc ";
   $result = $db->sql_query($sql);
   echo "<table><tr><td><span class='thick'>"._MONTH."</span></td><td><span class='thick'>"._STORYREADS."</span></td></tr>";
   $tempVar = '';
   while ($row = $db->sql_fetchrow($result)) {
     $tempVar .= "<tr><td>".$row['mong']."</td><td>".$row['mcount']."</td></tr>";
   }
   echo $tempVar."</table><br /><br /><br />";

   echo "<a name=\"articlecountbytopic\">"
       ."<span class='thick underline'>"._ARTICLECOUNTBYTOPIC."</span></a><br /><br />";

   $sql = "SELECT t.topictext AS topicname, count( * ) AS mcount, sum( s.counter ) AS `reads`, round( sum( s.counter ) / count( * ) , 0 ) AS avgreads "
         ."FROM ".$prefix."_stories s, ".$prefix."_topics t "
         ."WHERE t.topicid = s.topic "
         ."GROUP BY t.topictext "
         ."order by t.topictext asc ";
   //echo $sql;
   $result = $db->sql_query($sql);
   echo "<table><tr><td><span class='thick'>"._TOPIC."</span></td><td><span class='thick'>"._NUMSTORIES."</span></td><td><span class='thick'>"._STORYREADS."</span></td><td><span class='thick'>"._STORYAVGREADS."</span></td></tr>";
   $tempVar = '';
   while ($row = $db->sql_fetchrow($result)) {
     $tempVar .= "<tr><td>".$row['topicname']."</td><td>".$row['mcount']."</td><td>".$row['reads']."</td><td>".$row['avgreads']."</td></tr>";
   }
   echo $tempVar."</table><br /><br /><br />";

   echo "<a name=\"articlecountbycategory\">"
       ."<span class='thick underline'>"._ARTICLECOUNTBYCATEGORY."</span></a><br /><br />";


   $sql = "SELECT IF ( c.Title IS NULL , \""._MA_ARTICLE."\", c.Title) AS category, count( * ) AS mcount, sum( s.counter ) AS `reads`, round( sum( s.counter ) / count( * ) , 0 ) AS avgreads "
         ."FROM `".$prefix."_stories` s "
         ."LEFT JOIN `".$prefix."_stories_cat` c ON s.catid = c.catid "
         ."WHERE 1  "
         ."GROUP BY c.Title "
         ."ORDER BY c.Title ASC  ";
   //echo $sql;
   $result = $db->sql_query($sql);
   echo "<table><tr><td><span class='thick'>"._TOPIC."</span></td><td><span class='thick'>"._NUMSTORIES."</span></td><td><span class='thick'>"._STORYREADS."</span></td><td><span class='thick'>"._STORYAVGREADS."</span></td></tr>";
   $tempVar = '';
   while ($row = $db->sql_fetchrow($result)) {
     $tempVar .= "<tr><td>".$row['category']."</td><td>".$row['mcount']."</td><td>".$row['reads']."</td><td>".$row['avgreads']."</td></tr>";
   }
   echo $tempVar."</table><br /><br /><br />";

   CloseTable();

   echo "<br />";

   include_once("footer.php");
   }
if (!isset($op)) {$op = ""; }
switch($op) {
   case "columnists":
      MetAuthorsColumnists();
      break;
   case "stats":
   default:
   MetAuthorsStats();
}

?>
<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Save the database of a PHPNuke web site                              */
/*                                                                      */
/* Copyright (c) 2001 by Thomas Rudant (thomas.rudant@grunk.net)        */
/* http://www.grunk.net                                                 */
/* http://www.securite-internet.org                                     */
/*									*/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
global $prefix, $db, $admin_file, $name;

if (is_mod_admin('admin')) {
	switch($op) {

	case 'dobackup':
		dobackup();
		break;
	case 'backup':
		backup();
		break;
	}
} else {
	echo 'Access Denied';
}
function backup() {
	include_once('header.php');
	OpenTable();
echo _BACKUPINFO;
CloseTable();
include_once('footer.php');
}
function dobackup() {
		global $prefix, $db, $admin_file, $name, $lang, $dbhost, $dbuname, $dbpass, $dbname;
//		@set_time_limit(600);
		$crlf="\n";
		switch($lang)
		{
			case "french" :
				// French Text
				$strNoTablesFound	= "Aucune table n'a été trouvée dans cette base.";
				$strHost		= "Serveur";
				$strDatabase		= "Base de données";
				$strTableStructure	= "Structure de la table";
				$strDumpingData		= "Contenu de la table";
				$strError		= "Erreur";
				$strSQLQuery		= "requête SQL";
				$strMySQLSaid		= "MySQL a répondu:";
				$strBack		= "Retour";
				$strFileName		= "Sauvegarde BD";
				$strName		= "Sauvegarde de la base de données";
				$strDone		= "effectuée le";
				$strat			= "à";
				$strby			= "par";
				$date_jour = date ("d-m-Y");
				break;

			default :
				// English Text
				$strNoTablesFound = "No tables found in database.";
				$strHost = "Host";
				$strDatabase = "Database ";
				$strTableStructure = "Table structure for table";
				$strDumpingData = "Dumping data for table";
				$strError = "Error";
				$strSQLQuery = "SQL-query";
				$strMySQLSaid = "MySQL said: ";
				$strBack = "Back";
				$strFileName = "Save Database";
				$strName = "Database saved";
				$strDone = "On";
				$strat = "at";
				$strby = "by";
				$date_jour = date ("m-d-Y");
				break;
		}

		header("Content-disposition: filename=$strFileName $dbname $date_jour.sql");
		header("Content-type: application/octetstream");
		header("Pragma: no-cache");
		header("Expires: 0");

		// doing some DOS-CRLF magic...
		$client = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/[^(]*\((.*)\)[^)]*/', $client, $regs))
		{
		$os = $regs[1];
		// this looks better under WinX
		if (stristr($os, 'Win'))
		    $crlf = "\r\n";
		}

		mysql_pconnect($dbhost, $dbuname, $dbpass);
		@mysql_select_db($dbname) or die ('Unable to select database');

		$tables = mysql_list_tables($dbname);

		$num_tables = @mysql_numrows($tables);
		if($num_tables == 0)
		{
		    echo $strNoTablesFound;
		}
		else
		{
		    $i = 0;
		    $heure_jour = date ("H:i");
		    print "# ========================================================$crlf";
		    print "#$crlf";
		    print "# $strName : $dbname$crlf";
		    print "# $strDone $date_jour $strat $heure_jour $strby $name !$crlf";
		    print "#$crlf";
		    print "# ========================================================$crlf";
		    print "$crlf";

		    while($i < $num_tables)
		    {
		        $table = mysql_tablename($tables, $i);

		        print $crlf;
		        print "# --------------------------------------------------------$crlf";
		        print "#$crlf";
		        print "# $strTableStructure '$table'$crlf";
		        print "#$crlf";
		        print $crlf;

		        echo get_table_def($dbname, $table, $crlf).";$crlf$crlf";

			print "#$crlf";
			print "# $strDumpingData '$table'$crlf";
			print "#$crlf";
			print $crlf;

			get_table_content($dbname, $table, "my_handler");

		        $i++;
		    }
		}
		break;
	}
		function my_handler($sql_insert)
		{
		    global $crlf;
		    echo "$sql_insert;$crlf";
		}

		// Get the content of $table as a series of INSERT statements.
		// After every row, a custom callback function $handler gets called.
		// $handler must accept one parameter ($sql_insert);
		function get_table_content($db, $table, $handler)
		{
		    $result = mysql_db_query($db, "SELECT * FROM $table") or mysql_die();
		    $i = 0;
		    while($row = mysql_fetch_row($result))
		    {
		//        set_time_limit(60); // HaRa
		        $table_list = "(";

		        for($j=0; $j<mysql_num_fields($result);$j++)
		            $table_list .= mysql_field_name($result,$j).", ";

		        $table_list = substr($table_list,0,-2);
		        $table_list .= ")";

		        if(isset($GLOBALS['showcolumns']))
		            $schema_insert = "INSERT INTO $table $table_list VALUES (";
		        else
		            $schema_insert = "INSERT INTO $table VALUES (";

		        for($j=0; $j<mysql_num_fields($result);$j++)
		        {
		            if(!isset($row[$j]))
		                $schema_insert .= " NULL,";
		            elseif(!empty($row[$j]))
		                $schema_insert .= " '".addslashes($row[$j])."',";
		            else
		                $schema_insert .= " '',";
		        }
		        $schema_insert = preg_replace('/,$/', '', $schema_insert);
		        $schema_insert .= ')';
		        $handler(trim($schema_insert));
		        $i++;
		    }
		    return (true);
		}

		// Return $table's CREATE definition
		// Returns a string containing the CREATE statement on success
		function get_table_def($db, $table, $crlf)
		{
		    $schema_create = "";
		    //$schema_create .= "DROP TABLE IF EXISTS $table;$crlf";
		    $schema_create .= "CREATE TABLE $table ($crlf";

		    $result = mysql_db_query($db, "SHOW FIELDS FROM $table") or mysql_die();
		    while($row = mysql_fetch_array($result))
		    {
		        $schema_create .= "   $row[Field] $row[Type]";

		        if(isset($row['Default']) && (!empty($row['Default']) || $row['Default'] == "0"))
		            $schema_create .= " DEFAULT '$row[Default]'";
		        if($row['Null'] != "YES")
		            $schema_create .= " NOT NULL";
		        if(!empty($row['Extra']))
		            $schema_create .= " $row[Extra]";
		        $schema_create .= ",$crlf";
		    }
		    $schema_create = preg_replace(',' . $crlf . '$', '', $schema_create);
		    $result = mysql_db_query($db, "SHOW KEYS FROM $table") or mysql_die();
		    while($row = mysql_fetch_array($result))
		    {
		        $kname=$row['Key_name'];
		        if(($kname != "PRIMARY") && ($row['Non_unique'] == 0))
		            $kname="UNIQUE|$kname";
		         if(!isset($index[$kname]))
		             $index[$kname] = array();
		         $index[$kname][] = $row['Column_name'];
		    }

		    while(list($x, $columns) = @each($index))
		    {
		         $schema_create .= ",$crlf";
		         if($x == "PRIMARY")
		             $schema_create .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
		         elseif (substr($x,0,6) == "UNIQUE")
		            $schema_create .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
		         else
		            $schema_create .= "   KEY $x (" . implode($columns, ", ") . ")";
		    }

		    $schema_create .= "$crlf)";
		    return (stripslashes($schema_create));
		}

		function mysql_die($error = "")
		{
		global $strError, $sql_query, $strSQLQuery, $strBack, $strMySQLSaid;
		    echo '<span class="thick"> ' , $strError , '</span><p>';
		    if(isset($sql_query) && !empty($sql_query))
		    {
		        echo "$strSQLQuery: <pre>$sql_query</pre><p>";
		    }
		    if(empty($error))
		        echo $strMySQLSaid.mysql_error();
		    else
		        echo $strMySQLSaid.$error;
		    echo "<br /><a href=\"javascript:history.go(-1)\">$strBack</a>";
		    exit;
		}


?>

<?php
/**
This program is provided without warrantee by Frank Kelly (fkelly@nycap.rr.com).  Please send any error
reports to him.  As stated in the readme.txt documentation all you need to is fill in the variables in the
first 8 lines.  For running a comparison of your current database to RN2.40 the file fieldlist240.txt
Both this file and your compare_tables.php program must be on your system in the root directory for
RavenNuke(tm) (i.e., the same directory that you have mainfile.php in.  This fieldlist240.txt is produced
based on the official "reference" Ravennuke 2.40 distribution.  There is a more thorough discussion of the
upgrade process on the RavenNuke(tm) wiki (http://rnwiki.ravennuke.com/wiki/RavenNuke2:Upgrades_and_Migrations)
but one basic requirement is that your database correspond exactly to the Ravennuke database (although you
can have extra tables for add on modules of course).  This program will provide you with a listing of
discrepancies between your tables and the reference tables.
*/

/**
* The following is your database connection information.  You can probably copy it directly from config.php.
*/
$dbhost = 'localhost';
$dbuname = '';
$dbpass = '';
$dbname = '';
/**
* The following two variables should be the prefix of your tables in the database you are checking.  Unlike the prefixes in config.php you must add an underscore at the end.
*/
$prefix = 'nuke_';
$user_prefix = 'nuke_';
/**
* The following two variables are the prefixes of the tables listed in the text file that you are comparing against your database.  You must have an underscore at the end.
*/
$prefix_text = 'nuke_';
$user_prefix_text = 'nuke_';
/**
* This is the name of the text file that you are comparing your datbase against.
*/
$file = 'fieldlist_2_50_00.txt';

mysql_connect($dbhost, $dbuname, $dbpass);
mysql_select_db($dbname);
$tablecnt = 0;
$fieldcnt = 0;
$tablenotfoundcnt = 0;
$columnnotfoundcnt = 0;
$output = '';
$res = fopen($file, 'r');

if ($res) {
	while (!feof($res)) {
		$contents = rtrim(fgets($res));
		if (empty($contents)) continue;	// Allows empty line at end of field list file
//		$output .= $contents . '<br />';
		if ((substr($contents, 0, strlen($prefix_text)) == $prefix_text) || (substr($contents, 0, strlen($user_prefix_text)) == $user_prefix_text)) {
			$table = str_replace($prefix_text, $prefix, $contents);
			$table = str_replace($user_prefix_text, $user_prefix, $contents);
			$tablecnt++;
//			$output .= $table . '<br />';
			continue;
		}
		if ($table == 'not found') {
			continue;
		}
		$farray = explode('||', ltrim($contents));
		$sql = 'SHOW COLUMNS FROM ' . $table . ' LIKE  "' . $farray[0] . '"';
//		$output .= $sql . '<br />';
		$result2 = mysql_query($sql);
		if (!$result2) {
			$output .=  mysql_error() . ' '. $sql . '<br />';
			$table = 'not found';
			$tablenotfoundcnt++;
			continue;
		} else {
			$numof = mysql_num_rows($result2);
//			$output .= 'numof and sql: ' . $numof . $sql . '<br>';
			if ($numof ==0) {
				$output .= 'column not found in your table: ' . $table . ' ' . $farray[0]. '<br />';
				$columnnotfoundcnt++;
				continue;
			}
			while ($row2 = mysql_fetch_assoc($result2)) {
				$fieldcnt++;
				$type = $row2['Type'];
				$name = $row2['Field'];
				$null = $row2['Null'];
				$primarykey = $row2['Key'];
				$default = $row2['Default'];
				$extra = $row2['Extra'];
				if (empty($null)) {
					$null = 'NO';
				}
				if (empty($primarykey)) {
					$primarykey = 'NO';
				}
				if (empty($default)) {
					$default = 'No Default';
				}
				if (empty($extra)) {
					$extra = 'No Extra';
				}
				if ($farray[1] != $type) {
					$output .= 'field types do not match ' . $table . ' ' . $farray[0] . ' : Base ' . $farray[1] . ' Your table ' . $type . '<br />';
				}
				if ($farray[2] != $null) {
					$output .= 'null status not match ' . $table . ' ' . $farray[0] . ' : Base ' . $farray[2] .'   Your table ' . $null . '<br />';
				}
				if ($farray[3] != $primarykey) {
					$output .= 'field keys do not match ' . $table . ' ' . $farray[0] . ' : Base ' . $farray[3] . ' Your table ' . $key . '<br />';
				}
				if ($farray[4] != $default) {
					$output .= 'default values do not match ' . $table . ' ' . $farray[0] . ' : Base ' . $farray[4] . ' Your table ' . $default . '<br />';
				}
				if ($farray[5] != $extra) {
					$output .= 'extra options do not match ' . $table . ' ' . $farray[0] . ' : Base ' . $farray[5] . ' Your table ' . $extra . '<br />';
				}
			}
		}
	} // end while
}
fclose($res);

echo 'The database you are using for comparison is: ' , $dbname ,'<br />'
	, 'You are comparing this data base against the structure of the database represented in ' , $file , '<br />'
	, '<br /><br /><hr />'
	, 'tables processed: ' , $tablecnt , '<br />'
	, 'fields processed: ' , $fieldcnt , '<br />'
	, 'fields not found on your system ' , $columnnotfoundcnt , '<br />'
	, 'tables not found in your system: ' , $tablenotfoundcnt , '<br />'
	, $output
	, '<br /><br />'
	, 'when you are finished with using these files please remove them from your server <br />'
	, 'leaving them there could give a nefarious person access to your passwords <br />';

?>
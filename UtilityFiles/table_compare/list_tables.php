<?php
/*
note:
This program will create output that can be copied into a text file and saved.
This output will be a structural representation of each table and field in your current database.
For RN 2.40 we provide a "pre-created" text file that represents the structure of a standard RN 2.40 database.The name of this file is fieldlist240.txt.  So for comparing your pre RN2.40 database to RN2.40, you don't need to run this list_tables program at all.
However, if you want to use the compare tables program to compare another database you can run this program first and create a different text file for comparison.  Just change the first six lines below as needed.
*/

$dbhost = 'localhost';
$dbuname = '';
$dbpass = '';
$dbname = '';
$prefix = 'nuke';
$user_prefix = 'nuke';

mysql_connect($dbhost, $dbuname, $dbpass);
mysql_select_db($dbname);
$result= mysql_list_tables($dbname);
while ($row=mysql_fetch_row($result)) {
	echo $row[0] , '<br>';
	$tbl = $row[0];
	$result1 = mysql_query('SHOW COLUMNS FROM ' . $tbl);
//	$numof = mysql_num_fields($result1);
//	$i = 0;
	while ($row2 = mysql_fetch_assoc($result1)) {
		$type  = $row2['Type'];
		$name  = $row2['Field'];
		$null  = $row2['Null'];
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
/*
		echo ' ' . '&nbsp;&nbsp;&nbsp;' . 'Field= ' . $row2['Field'] . " Type= " . $row2['Type'] . " Null= " . $row2['Null'] . " Key= " . $row2['Key'] . ' Default= ' . $row2['Default'] . ' Extra= ' . $row2['Extra'] . '<br>';
		echo  ' &nbsp;&nbsp;&nbsp; Field: ' . $name . ', &nbsp;&nbsp;&nbsp;Type: ' . $type . ',&nbsp;&nbsp;&nbsp; Null: ' . $null . ',&nbsp;&nbsp;&nbsp; Key: ' . $primarykey . ',&nbsp;&nbsp;&nbsp; Default: ' . $default . ',&nbsp;&nbsp;&nbsp; Extra: ' . $extra . '<br>';
*/
		echo '&nbsp;&nbsp;&nbsp;' , $name , '||' , $type , '||' , $null , '||' , $primarykey , '||' , $default , '||' , $extra , '<br>';
	}
}

?>
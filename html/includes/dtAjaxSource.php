<?php
	/*
	 * Script:    DataTables server-side script for PHP and MySQL (modified for RavenNuke)
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
if (!defined('MODULE_FILE') and !defined('DT_AJAXSOURCE')) {
	header('Location: ../index.php');
	die();
}
	if (!isset($_GET['sSearch'])) $_GET['sSearch'] = '';
	if (!isset($_GET['bSearchable_0'])) $_GET['bSearchable_0'] = '';
	if (!isset($_GET['bSearchable_1'])) $_GET['bSearchable_1'] = '';
	if (!isset($_GET['bSearchable_2'])) $_GET['bSearchable_2'] = '';
	if (!isset($_GET['bSearchable_3'])) $_GET['bSearchable_3'] = '';
	if (!isset($_GET['bSearchable_4'])) $_GET['bSearchable_4'] = '';
	if (!isset($_GET['bSearchable_5'])) $_GET['bSearchable_5'] = '';
	if (!isset($_GET['bSearchable_6'])) $_GET['bSearchable_6'] = '';
	$sOrder = '';
	if (!isset($_GET['sEcho'])) $_GET['sEcho'] = '';
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables - defined in module file that includes this file
	 */
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
//	$aColumns = array( 'FROM_UNIXTIME(added)', 'request', 'username', 'email', 'INET_NTOA(ip)', 'matched', 'count' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
//	$sIndexColumn = "slid";
	
	/* DB table to use */
//	$sTable = $prefix.'_spam_log';
		
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
		$sLimit = "LIMIT ".addslashes( $_GET['iDisplayStart'] ). ", " . addslashes( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".addslashes( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".addslashes($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	$rResult = $db->sql_query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = $db->sql_query( $sQuery);
	$aResultFilterTotal = $db->sql_fetchrow($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = $db->sql_query( $sQuery);
	$aResultTotal = $db->sql_fetchrow($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = $db->sql_fetchrow( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "wltype" )
			{
				/* Special output formatting for 'wltype' column */
				if ($aRow[ $aColumns[$i] ]=="u") $row[] = _SPAM_USERNAME;
				if ($aRow[ $aColumns[$i] ]=="e") $row[] = _SPAM_EMAIL;
				if ($aRow[ $aColumns[$i] ]=="i") $row[] = _SPAM_IP;
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>
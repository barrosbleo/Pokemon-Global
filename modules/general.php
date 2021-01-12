<?php

//print header
function printHeader($str){
    echo '<div class="header"><p>'.$str.'</p></div>';
}

//redirect players
function redirect($location) {
	header('Location: '.$location.'');
	die();
}

//creates the table that shows users pokemon(I'm not sure)
function cellsToRowsProfile($cells, $numColumns) {
	$tableRows = '';
	for ( $i = 0; $i < count($cells); $i += $numColumns ) {
		$tableRows .= '<tr>';
		for ($j = $i; $j < $i + $numColumns; $j++) {
			if ( isset($cells[$j]) ) {
				$tableRows .= '<td><div class="box">'.$cells[$j].'</div></td>';
			}
		}
		$tableRows .= '</tr>';
	}
	return $tableRows;
}

//creates the table that shows users badges(I'm not sure)
function cellsToRowsBadges($cells, $numColumns) {
	$tableRows = '';
	for ( $i = 0; $i < count($cells); $i += $numColumns ) {
		$tableRows .= '';
		for ($j = $i; $j < $i + $numColumns; $j++) {
			if ( isset($cells[$j]) ) {
				$tableRows .=  $cells[$j] ;
			}
		}
		$tableRows .= '<br>';
	}
	return $tableRows;
}

//creates the table that shows register pokemons(I'm not sure)
function cellsToRows($cells, $numColumns) {
	$tableRows = '';
	
	for ( $i = 0; $i < count($cells); $i += $numColumns ) {
		$tableRows .= '<tr>';
		
		for ($j = $i; $j < $i + $numColumns; $j++) {
			if ( isset($cells[$j]) ) {
				$tableRows .= '<td>'.$cells[$j].'</td>';
			}
		}
		
		$tableRows .= '</tr>';
	}
	
	return $tableRows;
}

//I dunno what it does
function cellsToRowss($cells, $numColumns) {
	$tableColumns = '';
	for ( $i = 0; $i < count($cells); $i += $numColumns ) {
		$tableColumns .= '<td>';
		for ($j=$i; $j<$i+$numColumns; $j++) {
			if ( isset($cells[$j]) ) {
				$tableColumns .=$cells[$j];
			}
		}
		$tableColumns .= '</td>';
	}
	return $tableColumns;
}

//convert bbcodes
function convert_bbcodes($t) { 
  $search = array_keys( $GLOBALS['bb_codes'] );
  $t = str_replace( $search, $GLOBALS['bb_codes'], $t );
  
  return $t;
}

//asdd stuffz (I do not know what is this)
$exp = explode('/', $_SERVER["SCRIPT_NAME"]);
$filename = end($exp);

//study more about this
if (!function_exists('stripslashes_deep')) {
	function stripslashes_deep($value) {
	    $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	    return $value;
	}
}

//If some important updates (unfinished)
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
	/*	include 'updates.html';
	die();*/
}

//may admin access during updates
/*
if ($_SERVER['REMOTE_ADDR'] != '212.93.114.91') {
		include 'updates.html';
	die();
}*/
?>
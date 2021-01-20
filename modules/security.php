<?php


//Basic check for SQL injection
if(
stripos($_SERVER['QUERY_STRING'], 'UNION') !== false ||
stripos($_SERVER['QUERY_STRING'], 'SELECT') !== false ||
stripos($_SERVER['QUERY_STRING'], 'SCRIPT') !== false
){
	if(
		isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&
		$_SERVER['HTTP_X_FORWARDED_FOR'] != ''
	){
		$ip = cleanSql($_SERVER['HTTP_X_FORWARDED_FOR'], $conn);
	}else{
		$ip = cleanSql($_SERVER['REMOTE_ADDR'], $conn);
	}
	$fh = @fopen('sqli_attempts.txt', 'a') or die();
	fwrite($fh, $ip . ' ' . $_SERVER['SCRIPT_NAME'] . '?' . urldecode($_SERVER['QUERY_STRING']) . PHP_EOL);
	fclose($fh);
}

//Stop Magic Quotes
if (get_magic_quotes_gpc()) {
	$_POST = stripslashes_deep($_POST);
	$_GET  = stripslashes_deep($_GET);
}
?>
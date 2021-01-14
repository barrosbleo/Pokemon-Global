<?php
//php error handling functions
//this file is just for php errors
error_reporting(0);

//function what handle the errors
function errorHandler($errno, $errstr, $errfile, $errline, $errctx){
	$logFile = fopen('logs/phpErrors.txt', 'a');
	$currentLog = fread($logFile, filesize('logs/phpErrors.txt'));
	$newTxt = "Error: [".$errno."] ".$errstr.PHP_EOL."At line: ".$errline.PHP_EOL."On file: ".$errfile.PHP_EOL.">>>End<<<".PHP_EOL;
	fwrite($logFile, $newTxt);
	fclose($logFile);
}

//define the errorHandler function as php error handler
set_error_handler('errorHandler');

//creates the log path
if(!is_dir('logs')){
	mkdir('logs');
}

//creates the log file
if(!file_exists('logs/phpErrors.txt')){
	$logFile = fopen('logs/phpErrors.txt', 'a');
	fclose($logFile);
}
?>
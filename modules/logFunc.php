<?php
function commonLog($fileName, $msg){
	$logPath = $_SERVER['DOCUMENT_ROOT'] . '/logs';

	$folder = is_dir($logPath) ? is_dir($logPath) : mkdir($logPath);
	$file = file_exists($logPath.'/'.$fileName) ? $file = fopen($logPath.'/'.$fileName, 'a') : fopen($logPath.'/'.$fileName, 'w');
	//$fileSize = filesize($logPath.'/'.$fileName) > 0 ? $fileSize = filesize($logPath.'/'.$fileName) : $fileSize = 1;
	fwrite($file, $msg);
//die();
}




?>
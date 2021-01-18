<?php
$path = $_SERVER['DOCUMENT_ROOT'];
if(!is_dir($path.'/tmp')){
	mkdir($path.'/tmp');
}

session_save_path($path.'/tmp');
session_start();



?>
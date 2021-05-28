<?php
$path = $_SERVER['DOCUMENT_ROOT'];

$allowed_lang = array('en', 'pt-br', 'es', 'ph', 'lv');

if(isset($_GET['lang']) === true && in_array($_GET['lang'], $allowed_lang) === true) {
	setcookie("lang", $_GET['lang'], time() + (10 * 365 * 24 * 60 * 60), "/");
	redirect('main.php');
} else if(isset($_COOKIE['lang']) === false){
	setcookie("lang", $general['deflang'], time() + (10 * 365 * 24 * 60 * 60), "/");

}
include($path.'/lang/'.$_COOKIE['lang'].'.php');

?>
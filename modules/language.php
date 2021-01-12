<?php

$allowed_lang = array('en', 'pt-br', 'es', 'ph', 'lv');

if(isset($_GET['lang']) === true && in_array($_GET['lang'], $allowed_lang) === true) {
	$_SESSION['lang'] = $_GET['lang'];
} else if(isset($_SESSION['lang']) === false){
	$_SESSION['lang'] = 'en';
}
include 'lang/' . $_SESSION['lang'] . '.php';
?>
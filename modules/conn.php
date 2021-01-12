<?php

$connection = @mysql_connect('localhost', 'root', '12345678');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['database']);

if (!$connection) {
	include '_header.php';
	echo '<div class="error">Error connecting to the database 1!</div>';
	//if (isset($_SESSION['admin']) && $_SESSION['admin']==1) { echo mysql_error(); }
	include '_footer.php';
	die();
}

$dbSelected = mysql_select_db('pokebr');

if (!$dbSelected) {
	include '_header.php';
	echo '<div class="error">Error connecting to the database 2!</div>';
	//if (isset($_SESSION['admin']) && $_SESSION['admin']==1) { echo mysql_error(); }
	include '_footer.php';
	die();
}
?>
<?php
include('lib.php');

if(isset($_GET['id']) && isset($_GET['func']) && $_GET['func'] == "next"){
	$uid = cleanSql($_GET['id'], $conn);
	$query = "UPDATE users SET tuto = tuto + 1 WHERE id = '{$uid}'";
	$conn->query($query);
	$query = "SELECT tuto FROM users WHERE id = '{$uid}'";
	$result = $conn->query($query);
	$tutoNum = $result->fetch_assoc();
	$_SESSION['tuto'] = $tutoNum['tuto'];
	echo $tutoNum['tuto'];
	die();
}

if(isset($_GET['id']) && !empty($_GET['id'])){
	$uid = cleanSql($_GET['id'], $conn);
	$query = "SELECT tuto FROM users WHERE id = '{$uid}'";
	$result = $conn->query($query);
	$tutoNum = $result->fetch_assoc();
	echo $tutoNum['tuto'];
	die();
}

?>
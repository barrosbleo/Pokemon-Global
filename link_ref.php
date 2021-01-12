<?php
	if(isset($_GET['lref'])) {
		$lref = $_GET['lref'];
		mysql_query("UPDATE `link_ref` SET `ref` = `ref` + 1 WHERE `id` = '$lref'");
	}
	
	if(isset($linkr)) {
		mysql_query("UPDATE `link_ref` SET `ref` = `ref` + 1 WHERE `id` = '$linkr'");
	}
	
	if(isset($_GET['ref'])) {
		header('location: 5050.php');
	}
?>
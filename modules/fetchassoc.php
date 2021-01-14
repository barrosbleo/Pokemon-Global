<?php

function fetchAssoc($str, $conn){
	$query = $conn->query($str);
	$result = $query->fetch_assoc();
	return $result;
}
?>
<?php
function fetchObj($str, $conn){
	$query = $conn->query($str);
	$result = $query->fetch_object();
	return $result;
}
?>
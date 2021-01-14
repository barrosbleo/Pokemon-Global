<?php

function numRows($str, $conn){
	$query = $conn->query($str);
	$result = $query->num_rows;
	return $result;
}
?>
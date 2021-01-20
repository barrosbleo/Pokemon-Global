<?php

function fetchArray($str, $type, $conn){
	$query = $conn->query($str);
	if($type == 1){
		$result = $query->fetch_array(MYSQLI_NUM);
	}elseif($type == 2){
		$result = $query->fetch_array(MYSQLI_ASSOC);
	}else{
		//write to database log
		exit();
	}
	return $result;
}
?>
<?php

//I guess it still not working, not implemented
function logs($id, $text){

	$timesent = time();
	/*$result= mysql_query("INSERT INTO `logs` (`to`, `timesent`, `text`)".
						 "VALUES ('$id', '$timesent', '$text')");*/
}

//write players activity log(not working)
function logActivity($message, $uid, $image = '', $conn) {
	$uid     = (int) $uid;
	$message = cleanSql($message, $conn);
	$image   = cleanSql($image, $conn);
	$time    = time();

	//mysql_query("INSERT INTO `activity` (`message`, `uid`, `time`, `image`) VALUES ('{$message}', '{$uid}', '{$time}', '{$image}')");
}


?>
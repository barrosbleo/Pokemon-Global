<?php
include('lib.php');
if(isset($_GET['func']) && $_GET['func'] == "send" && isset($_GET['msg']) && isset($_GET['map'])){
	$error = 0;
	//check field
	if($_GET['msg'] == ""){
		$error = 1;
		echo "Você não digitou nada!";
		exit;
	}
	//add bad words filter
	//explode msg word by word and than search these words on badwords table
	//if num rows == 1 notice and add 1 point to user bad word usage column
	//when bad word usage reach to 3 than block user for chating during 5 minutes
	//write msg log
	//clear older 50 msgs
	if($error != 1){
		$map = cleanSql($_GET['map'], $conn);
		$msg = cleanSql($_GET['msg'], $conn);
		$uid = cleanSql($uid, $conn);
		$query = "SELECT username FROM users WHERE id='{$uid}'";
		$result = $conn->query($query);
		$username = $result->fetch_assoc();
		$query = "INSERT INTO chat (user_id, username, message, map) VALUES ('{$uid}', '{$username['username']}', '{$msg}', '{$map}')";
		$conn->query($query);
		echo "success";
	}
}
if(isset($_GET['func']) && isset($_GET['map']) && $_GET['func'] == "load"){
	$map = cleanSql($_GET['map'], $conn);
	$query = "SELECT * FROM chat WHERE  map='{$map}' ORDER BY chat_id DESC LIMIT 0,20";
	$result = $conn->query($query);
	while($msg = $result->fetch_array(MYSQLI_ASSOC)){
		echo $msg['sent_on']."</br>".$msg['username'].": ".$msg['message']."</br>";
	}
}
?>
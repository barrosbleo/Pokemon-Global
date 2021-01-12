<?php
include('../modules/lib.php');

if(isset($_GET['action']) && $_GET['action'] = 1){
	$query = "SELECT * FROM user_quests WHERE qid='".$_GET['qid']."' && uid='".$uid."'";
	$result = $conn->query($query);
	$return = $result->fetch_assoc();
	if(!isset($return)){
		$query = "INSERT INTO user_quests (uid, qid, progr) VALUES ('1','1', '1')";
		if($conn->query($query) === TRUE){
			//insert quest to user (write log)
		}
	}else{
		$query = "UPDATE user_quests SET progr='".$_GET['qprogr']."' WHERE qid='".$_GET['qid']."' && uid='".$uid."'";
		if($conn->query($query) === TRUE){
			//update user's quests (write log)
		}
	}
}
?>
<?php
include('modules/lib.php');
include '_header.php';

if (isLoggedIn()) { redirect('index.php'); }

if(isset($_GET['key']) && isset($_GET['username'])){
	$error = 0;
	$username = cleanSql($_GET['username'], $conn);
	$key = cleanSql($_GET['key'], $conn);
	$query = "SELECT * FROM users WHERE username ='{$username}'";
	$result = $conn->query($query);
	$user = $result->fetch_assoc();
	if($result->num_rows != 1){
		$error = 1;
		echo $lang['verify_err_1'];
		exit();
	}
	if($user['verify_key'] != $key){
		$error = 1;
		echo $lang['verify_err_2'];
		exit();
	}
	if($error != 1){
		$query = "UPDATE TABLE users SET verified = '1' WHERE username = '{$username}'";
		$result = $conn->query($query);
		echo '<p class="successF">'.$lang['verify_done'].'</p>';
		echo '<script>setInterval(function(){ window.location.href = "https://pkmglobal.online"; }, 3000);</script>';
	}
}	
else {
	echo '<p class="successF">'.$lang['verify_mail_access'].'</p>';
	echo '<script>setInterval(function(){ window.location.href = "https://pkmglobal.online"; }, 3000);</script>';
} ?>
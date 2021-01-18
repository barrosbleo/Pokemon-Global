<?php
//session_start();
include('lib.php');

$login = $_POST['username'];
$password = $_POST['password'];
$error = 0;

if(isset($_POST['submit']) && $_POST['submit'] == "log in"){
	if(empty($login) || empty($password)){
		$error = 1;
		echo $lang['login_empty_fields'];
		exit();
	}
	$sqlUsername = cleanSql($login, $conn);
	$query = "SELECT * FROM users WHERE username='".$sqlUsername."'";
	$userRow = fetchAssoc($query, $conn);
	
	if(numRows($query, $conn) != 1 || sha1($password) != $userRow['password']){
		$error = 1;
		echo $lang['login_incorrect'];
		exit();
	}
	if($userRow['banned'] == 1){
		$error = 1;
		echo $lang['login_banned'];
		exit();
	}
	//do login
	if($error != 1){
		$uid = $userRow['id'];
		$_SESSION['username'] = $login;
		$_SESSION['userid']   = $uid;
		$_SESSION['admin']    = $userRow['admin'];
		$_SESSION['mod']      = $userRow['mod'];
		//$_SESSION['premium']    = $userRow['premium'];
		
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != ''){
			$ip = cleanSql($_SERVER['HTTP_X_FORWARDED_FOR'], $conn);
		}else{
			$ip = cleanSql($_SERVER['REMOTE_ADDR'], $conn);
		}
		// total messages
		$query = "SELECT * FROM messages WHERE recipient_uid='{$uid}' AND deleted_by_recipient='0'";
		$totalMessages = numRows($query, $conn);

		// total unread messages
		$query = "SELECT * FROM messages WHERE recipient_uid='{$uid}' AND read='0' AND deleted_by_recipient='0'";
		$totalUnreadMessages = numRows($query, $conn);

		// total pokemon for sale
		$query = "SELECT * FROM sale_pokemon WHERE uid='{$uid}'";
		$totalSalePoke = numRows($query, $conn);

		// new sales
		$query = "SELECT * FROM sale_history WHERE uid='{$uid}' AND seen='0'";
		$newSales = numRows($query, $conn);
		
		$query = "UPDATE users SET ip='{$ip}', ip2='{$ip}', total_messages='{$totalMessages}', unread_messages='{$totalUnreadMessages}', total_sale_pokes='{$totalSalePoke}' , newly_sold_pokes='{$newSales}'  WHERE id='{$userRow['id']}' LIMIT 1";
		doQuery($query, $conn);
		$time = time();
		$query = "INSERT INTO `user_logins` (uid, username, ip, timestamp) VALUES ('{$uid}', '{$sqlUsername}', '{$ip}', '{$time}')";
		doQuery($query, $conn);
		echo "success";
	}
}
?>
<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

$uid       = (int) $_SESSION['userid'];
$userMoney = getUserMoney($uid, $conn);
$message   = isset($_SESSION['message']) ? $_SESSION['message'] : '' ;
$username  = '';
$amount    = '';

if (isset($_POST['amount']) && isset($_POST['username'])) {
	$amount        = (int) $_POST['amount'];
	$uni_username  = trim($_POST['username']);
	$sqlUsername   = cleanSql($uni_username, $conn);
	$sqlMyUsername = cleanSql($_SESSION['username'], $conn);
	
	$query = "SELECT `id` FROM `users` WHERE `username`='{$sqlUsername}' LIMIT 1";

	if (numRows($query, $conn) == 0) {
		$message = '<div class="error">'.$lang['send_money_00'].'</div>';
	} else if ($amount > $userMoney) {
		$message = '<div class="error">'.$lang['send_money_01'].'</div>';
	} else if ($amount <= 0) {
		$message = '<div class="error">'.$lang['send_money_02'].'</div>';
	} else if ($uni_username === $_SESSION['username']) {
		$message = '<div class="error">'.$lang['send_money_03'].'</div>';
	} else if (isset($_SESSION['send_money_token']) && $_SESSION['send_money_token'] != $_POST['token']) {
		$message = '<div class="error">'.$lang['send_money_04'].'</div>';
	} else {
		$recUid     = fetchAssoc($query, $conn);
		$recUid     = $recUid['id'];
		$recMoney   = getUserMoney($recUid, $conn) + $amount;
		$userMoney -= $amount;
		$time       = time();

		updateUserMoney($recUid, $recMoney, $conn);
		updateUserMoney($uid, $userMoney, $conn);
		
		$conn->query("
			INSERT INTO `send_money_history` (
				`sender_uid`, `recipient_uid`, `sender`, `recipient`, `amount`, `timestamp`
			) VALUES (
				'{$uid}', '{$recUid}', '{$sqlMyUsername}', '{$sqlUsername}', '{$amount}', '{$time}'
			)
		");

		$_SESSION['message'] = '<div class="notice">'.$lang['send_money_05'].' $' . $amount . ' '.$lang['send_money_06'].' ' . cleanHtml($uni_username) . '.</div>';
		if (isset($_GET['id'])) {
			$id = (int) $_GET['id'];
			redirect('send_money.php?id='.$id);
		} else {
			redirect('send_money.php');
		}
	}


}

include '_header.php';
printHeader($lang['send_money_title']);

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];
	$query = "SELECT `username` FROM `users` WHERE `id`='{$id}'";
	
	if (numRows($query, $conn) == 1) {
		$row = fetchAssoc($query, $conn);
		$uni_username = $row['username'];
	}
}



$token = md5( rand(10000, 99999) );
$_SESSION['send_money_token'] = $token;

echo '
	<center>
		<a href="send_money.php">'.$lang['send_money_07'].'</a> &bull; 
		<a href="send_money_history.php">'.$lang['send_money_08'].'</a><br /><br />
		
		' . $message . '
<table>
<tr>
		<td colspan="2">'.$lang['send_money_09'].' $' . number_format($userMoney) . '</td></tr>
		<form action="" method="post">

			<tr><th>'.$lang['send_money_10'].' </th><td><input type="text" name="username" value="' . cleanHtml($uni_username) . '" /><br /></td></tr>
			<tr><th>'.$lang['send_money_11'].'</th><td> <input type="text" name="amount" value="' . cleanHtml($amount) . '" /><br /></td></tr>
<tr><td>&nbsp;</td><td><input type="hidden" name="token" value="' . $token . '" /><input type="submit" class="smallbutton" value="'.$lang['send_money_12'].'" id="button"/></td></tr></table>
		</form>

</center>
';

if (isset($_SESSION['message'])) {
	unset($_SESSION['message']);
}

include '_footer.php';
?>
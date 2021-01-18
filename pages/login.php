<?php
include('modules/lib.php');

if (isLoggedIn()) { redirect('membersarea.php'); }

$username = isset($_POST['username']) ? $_POST['username'] : '' ;
$password = isset($_POST['password']) ? $_POST['password'] : '' ;
$message = '';

if (isset($_SESSION['logout'])) {
	$message = $_SESSION['logout'];
	unset($_SESSION['logout']);
}

if (isset($_SESSION['register'])) {
	$message = $_SESSION['register'];
	unset($_SESSION['register']);
}

if (isset($_POST['submit'])) {
	if (empty($username) || empty($password) ) {
		$message = '<p class="error">'.$lang['login_empty_fields'].'</p>';
	}
}

if (!empty($username) && !empty($password) ) {

		$sqlUsername = cleanSql($username);

		$query = mysql_query("
			SELECT
				`id`,`password`,`admin`,`mod`,`banned`,`ban_reason`
			FROM `users`
			WHERE
				`username`='{$sqlUsername}'
			LIMIT 1
		") or die(mysql_error());
		$userRow = mysql_fetch_array($query); 
		
		if($userRow['password'] == sha1($password) && mysql_num_rows($query) == 1) {
			if ($userRow['banned'] == 1) {
				$message = '
					<p class="banned" style="text-align: center; padding: 3px; color: #ff0000;">
						'.$lang['login_banned'].$userRow['ban_reason'].'
					</p>
				';
			} else {
				$uid = $userRow['id'];
				$_SESSION['username'] = $username;
				$_SESSION['userid']   = $uid;
				$_SESSION['admin']    = $userRow['admin'];
				$_SESSION['mod']      = $userRow['mod'];
				//$_SESSION['premium']    = $userRow['premium'];
				
				if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
				    $ip = cleanSql($_SERVER['HTTP_X_FORWARDED_FOR']);
				} else {
				    $ip = cleanSql($_SERVER['REMOTE_ADDR']);
				}
				
				// total messages
				$query = mysql_query("SELECT * FROM `messages` WHERE `recipient_uid`='{$uid}' AND `deleted_by_recipient`='0'");
				$totalMessages = mysql_num_rows($query);

				// total unread messages
				$query = mysql_query("SELECT * FROM `messages` WHERE `recipient_uid`='{$uid}' AND `read`='0' AND `deleted_by_recipient`='0'");
				$totalUnreadMessages = mysql_num_rows($query);

				// total pokemon for sale
				$query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid`='{$uid}'");
				$totalSalePoke = mysql_num_rows($query);

				// new sales
				$query = mysql_query("SELECT * FROM `sale_history` WHERE `uid`='{$uid}' AND `seen`='0'");
				$newSales = mysql_num_rows($query);


				mysql_query("UPDATE `users` SET `ip`='{$ip}', `ip2`='{$ip}', `total_messages`='{$totalMessages}', `unread_messages`='{$totalUnreadMessages}', `total_sale_pokes`='{$totalSalePoke}' , `newly_sold_pokes`='{$newSales}'  WHERE `id`='{$userRow['id']}' LIMIT 1");
				
				$time = time();
				mysql_query("INSERT INTO `user_logins` (`uid`, `username`, `ip`, `timestamp`) VALUES ('{$uid}', '{$sqlUsername}', '{$ip}', '{$time}')");
				
				redirect('membersarea.php');
			}
		} else {
			$message = '<p class="error">'.$lang['login_incorrect'].'</p>';
		}
}

include '_header.php';
?>

<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="poke one"></div>
					
					<div class="login">
					
						<?php echo $message;?>
						
						<form method="post" action="" autocomplete="off"><!--<font color="black">Unfortunately this RPG is closed.</font>-->
						<input type="text" value="<?php echo $username;?>" name="username" placeholder="<?php echo $lang['login_username'];?>" autofocus="on">
							<input type="password" name="password" placeholder="<?php echo $lang['login_password'];?>">
							<input type="submit" name="submit" value="log in" class="btn">
										
							<ul class="nav">
								<li><a href="password_forgot.php"><?php echo $lang['login_forgot'];?></a></li>
								<li><a href="register.php"><?php echo $lang['login_start'];?></a></li>
							</ul>
										
							<div class="footer">
								<?php echo $lang['login_online'];?>- <?php echo number_format($online);?>
								<?php echo $lang['login_total'];?>- <?php echo number_format($usersTotal);?>
							</div>
						</form>
					</div>
					
					<?php include '_footer.php'; ?>
				</td>
			</tr>
		</table>
	</div>
</div>

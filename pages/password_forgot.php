<?php

if (isLoggedIn()) { redirect('index.php'); }

if (isset($_POST['submit'])) {
	$username = (string) $_POST['username'];
	$email = (string) $_POST['email'];
	
	$sqlUsername = cleanSql($username, $conn);
	$htmlUsername = cleanHtml($username);
	
	$sqlEmail = cleanSql($email, $conn);
	$htmlEmail = cleanHtml($email);
	
	
	if ($username && $email) {
		$passwordlenth = 25;
		$charset = 'abcdefghijklmnoprstovwxy1234567890';
		
		for ($x = 1; $x <= $passwordlenth; $x++) {
			$rand = rand() % strlen($charset);
			$temp = substr($charset, $rand, 1);
			$key .= $temp;
		}
		
		//$key_sha1 = sha1($key);
		
		$query = "
			SELECT * 
			FROM `users`
			WHERE `username` = '{$sqlUsername}'
			AND `email` = '{$sqlEmail}'
		";
		$result = $conn->query($query);
		$row = $result->num_rows;
		
		if ($row != 0) {
			$conn->query("
				UPDATE `users`
				SET `reset_key` = '{$key}'
				WHERE `email` = '{$sqlEmail}'
			");
			
			//Send e-mail
			
			$to = $email;
			$subject = $lang['pwd_forgot_00'];
			$headers = $lang['pwd_forgot_01'];
			$body	= '
				'.$lang['pwd_forgot_02'].' '.$username.', 
				'.$lang['pwd_forgot_03'].'
				
				http://pkmglobal.online/password_reset.php?key='.$key.'&username='.urlencode($username).'
			
				'.$lang['pwd_forgot_04'].'
				    '.$key.'
					
				'.$lang['pwd_forgot_05'].'
			';		
			
			mail($to, $subject, $body, $headers);
			echo '<p class="successF">'.$lang['pwd_forgot_06'].' '.$htmlEmail.'</p>';
		} else {
			echo'<p class="errorF">'.$lang['pwd_forgot_07'].'
			<br><a href="password_forgot.php">'.$lang['pwd_forgot_08'].'</p>';
		}
	}
		else {
			echo '<p class="errorF">'.$lang['pwd_forgot_09'].'
			<br><a href="password_forgot.php">'.$lang['pwd_forgot_08'].'</p>';
		}

}  else {
?>
<div id="password_forgotPage" = style="display:none">
<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="poke three"></div>
					
					<div class="login forgot">
						
						
						<form method="POST" action="" autocomplete="off">
							<div class="title"><?php echo $lang['pwd_forgot_10'];?></div>
							
							<label><?php echo $lang['pwd_forgot_11'];?></label>
							<input type="text" name="username" autofocus="on">
							
							<label><?php echo $lang['pwd_forgot_12'];?></label>
							<input type="text" name="email">
							
							<input type="submit" name="submit" value="<?php echo $lang['pwd_forgot_13'];?>" class="btn">
						</form>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>
<?php } ?>

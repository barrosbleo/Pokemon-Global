<?php
include('modules/lib.php');
include '_header.php';

if (isLoggedIn()) { redirect('index.php'); }

$username_1 = $_GET['username'];
$key = $_GET['key'];

if (isset($_POST['submit']) && !empty($_POST['key'])) {

	
	if (isset($_POST['username'], $_POST['key'], $_POST['password'], $_POST['re_password'])) {
	
		$sqlUsername = cleanHtml($_POST['username']);
		$sqlKey = cleanHtml($_POST['key']);
		$password = $_POST['password'];
		$rePassword = $_POST['re_password'];
		$newPassword = sha1($password);
		
		$query = "
			SELECT *
			FROM `users`
			WHERE `username` = '{$sqlUsername}'
			AND `reset_key` = '{$sqlKey}'
		";

		$row = numRows($query, $conn);
		
		if ($row != 0) {
			$conn->query("
				UPDATE `users`
				SET `password` = '{$newPassword}'
				WHERE `username` = '{$sqlUsername}'
				AND `reset_key` = '{$sqlKey}'
			");			

			echo '<p class="successF">'.$lang['pwd_reset_00'].'</p>';
			echo '<script>setInterval(function(){ window.location.href = "https://pkmglobal.online"; }, 3000);</script>';
		}
		else {
			echo '<p class="errorF">'.$lang['pwd_reset_01'].'
			<br><a href="password_reset.php">'.$lang['pwd_reset_02'].'</a></p>';
		}
	}
	else {
		echo '<p class="errorF">'.$lang['pwd_reset_03'].'
		<br><a href="password_reset.php">'.$lang['pwd_reset_02'].'</a></p>';
	}
}
else {
?>
<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="poke three"></div>
					
					<div class="login forgot">
						<?php echo $msg;?>
						
						<form method="POST" action="">
							<div class="title"><?php echo $lang['pwd_reset_04'];?></div>
							
							<label><?php echo $lang['pwd_reset_05'];?></label>
							<input type="text" name="username" readonly="readonly" value="<?php echo cleanHtml($username_1); ?>">
							
							<label><?php echo $lang['pwd_reset_06'];?></label>
							<input type="text" name="key" readonly="readonly" value="<?php echo cleanHtml($key); ?>">
							
							<label><?php echo $lang['pwd_reset_07'];?></label>
							<input type="password" name="password">
							
							<label><?php echo $lang['pwd_reset_08'];?></label>
							<input type="password" name="re_password">
							
							<input type="submit" name="submit" value="<?php echo $lang['pwd_reset_09'];?>" class="btn">
						</form>
					</div>
					<?php include '_footer.php'; ?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php } ?>

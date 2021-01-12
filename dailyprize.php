<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}
include '_header.php';

printHeader($lang['dayprize_title']);

$message =  '';

$uid = $_SESSION['userid'];
$user = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'"));

$multi1 = mysql_query("SELECT * FROM `users` WHERE `ip2`='" . $user->ip2 . "' AND `dailyprize`='0'");
$multi  = mysql_num_rows($multi1);

$time = time();
$timeLeft = $user->last_dailyprize + 86400;
$next_dailyprize  = secondsToTimeSince($timeLeft - $time);

if ($timeLeft <= $time) {
	mysql_query("UPDATE `users` SET `dailyprize` = '0' WHERE `id`='$user->id'");
}

if(isset($_POST['submit'])) {

	if ($user->dailyprize >= 1 || $multi > 2) {
		if($multi < 3) {
			$message = '<p class="error">'.$lang['dayprize_00'].'</p>';
		}

		if($multi > 2) {
			$message = '<p class="error">'.$lang['dayprize_01'].'</p>';
		}
	} else {
		
		mysql_query("UPDATE `users` SET `dailyprize` = '0' WHERE `id`='$user->id'");

		$rand = rand(1,2);
		$rand2 = rand(1,100);

		if($rand2 == 50){
			$amountone = rand(1,3);
			$new_tokens = $user->token + $amountone;
			echo "<p class='success'>".$lang['dayprize_02']." <b>".number_format($amountone)." ".$lang['dayprize_03']."</b><br>".$lang['dayprize_04']."</p>";
			$result = mysql_query("UPDATE `users` SET `token` = '".$new_tokens."' WHERE `id`='$user->id'");
		}

		if($rand == 1){
			$amountone = rand(1024,124000);
			$new_trainer_exp = $user->trainer_exp + $amountone;
			$message = "<p class='success'>".$lang['dayprize_02']." <b>".number_format($amountone)." ".$lang['dayprize_05']."</b>!</p>";
			$result = mysql_query("UPDATE `users` SET `trainer_exp` = '".$new_trainer_exp."' WHERE `id`='$user->id'");
		}

		if($rand == 2){
			$amountone = rand(1000,20000);
			$new_money = $user->money + $amountone;
			$message = "<p class='success'>".$lang['dayprize_02']." <b>$".number_format($amountone)." ".$lang['dayprize_06']."</b>!</p>";
			$result = mysql_query("UPDATE `users` SET `money` = '".$new_money."' WHERE `id`='$user->id'");
		}		
		

		
		mysql_query("UPDATE `users` SET `dailyprize` = '1', `last_dailyprize`='$time' WHERE `id`='$user->id'");
	}
}
?>

<center>
<?php echo $message;?>
<br>
<br>
<img src="images/pokemon/oak.png"><br><br>
<?php echo $lang['dayprize_07'];?>
<form method="post" action="dailyprize.php">
	<input type="submit" name="submit" value="<?php echo $lang['dayprize_08'];?>" class="button">
</form>

</center>


<?php
	include '_footer.php';
?>
<?php
include('modules/lib.php');
	
if (!isLoggedIn()) {
	redirect('login.php');
}

$uid  = (int) $_SESSION['userid'];

include '_header.php';
printHeader($lang['lottery_title']);

if (isset($_POST['enter'])) {

	$query = mysql_query("SELECT `lottery` FROM `users` WHERE `id`='{$uid}'");
	$row   = mysql_fetch_assoc($query);
	$hasEntered = $row['lottery'];
	
	if ($hasEntered == 0) {
		mysql_query("UPDATE `users` SET `lottery`='1' WHERE `id`='{$uid}'");
		
		echo '<div class="notice">'.$lang['lottery_00'].'</div>';
	} else {
		echo '<div class="error">'.$lang['lottery_01'].'</div>';
	}
}

$nextDraw      = getConfigValue('lottery_next_draw');
$winnerUid     = getConfigValue('lottery_winner_uid');
$timeLeft      = secondsToTimeSince($nextDraw - $time);

$prizePokemon  = getConfigValue('lottery_pokemon');
$pokemonPrefix = getConfigValue('lottery_pokemon_prefix');
$fullPrizeName = trim($pokemonPrefix.$prizePokemon);

$winnerPrizePokemon  = getConfigValue('lottery_winner_pokemon');
$winnerPokemonPrefix = getConfigValue('lottery_winner_pokemon_prefix');
$winnerFullPrizeName = trim($winnerPokemonPrefix.$winnerPrizePokemon);

$query = mysql_query("SELECT `username` FROM `users` WHERE `id`='{$winnerUid}'");
$row   = mysql_fetch_assoc($query);
$winnerUsername = $row['username'];

$query = mysql_query("SELECT COUNT(`id`) AS `lottery_users` FROM `users` WHERE `lottery`='1'");
$row   = mysql_fetch_assoc($query);
$lotteryUsers = $row['lottery_users'];




echo '
	<div style="text-align: center;">
		'.$lang['lottery_02'].' '.$fullPrizeName.'!<br />
		<img src="images/pokemon/'.$fullPrizeName.'.png" alt="'.$fullPrizeName.'" /><br /><br />
		
		'.$lang['lottery_03'].' ' . $timeLeft . '.<br />
		'.$lotteryUsers.' '.$lang['lottery_04'].'<br /><br />
		
		<form action="" method="post">
			<input type="submit" name="enter" value="'.$lang['lottery_05'].'" />
		</form>
		
		<br /><br /><hr /><br /><br />
		
		'.$lang['lottery_06'].' <a href="profile.php?id='.$winnerUid.'">'.$winnerUsername.'</a>.<br />
		'.$lang['lottery_07'].' '.$winnerFullPrizeName.'!<br />
		<img src="images/pokemon/'.$winnerFullPrizeName.'.png" alt="'.$winnerFullPrizeName.'" /><br /><br />
	</div>
';

include'_footer.php';
?>
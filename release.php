<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['release_title']);

$uid = (int) $_SESSION['userid'];
$pid = (int) $_GET['id'];
$releaseReward = getConfigValue('release_reward');

// check that the pokemon exists and they own it
$query = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' AND `uid`='{$uid}'";

if (numRows($query, $conn) == 0) {
	echo '<div class="error">'.$lang['release_00'].'</div>';
	include '_footer.php';
	die();
}
$pokeInfo = fetchAssoc($query, $conn);
//---------------------------------

// check that it is not in their team
$teamIds = getUserTeamIds($uid);

if (in_array($pid, $teamIds)) {
	echo '<div class="error">'.$lang['release_01'].'</div>';
	include '_footer.php';
	die();
}
// --------------------------------

if (isset($_GET['sure'])) {
	if (!isset($_SESSION['releaseToken'][$pid])) {
		echo '<div class="error">'.$lang['release_02'].'</div>';
	} else if ($_SESSION['releaseToken'][$pid] != $_GET['token']) {
		echo '<div class="error">'.$lang['release_03'].'</div>';
	} else {
		echo '
			<div style="text-align: center;">
				<div class="notice">'.$lang['release_04'].' '.$pokeInfo['name'].'!</div>
				<img src="images/pokemon/'.$pokeInfo['name'].'.png" alt="'.$pokeInfo['name'].'" /><br />
				<a href="view_box.php">'.$lang['release_05'].'</a><br /><br />
			</div>
		';
		
		$conn->query("DELETE FROM `user_pokemon` WHERE `uid`='{$uid}' AND `id`='{$pid}'");
		$conn->query("UPDATE `users` SET `released`=`released`+1 WHERE `id`='{$uid}'");
		updateUserMoney($uid, getUserMoney($uid) + $releaseReward);
		
		unset($_SESSION['releaseToken'][$pid]);
	}
	
	
} else {
	$token = md5( rand(1000, 5000) );
	$_SESSION['releaseToken'][$pid] = $token;
	echo '
		<p>
			'.$lang['release_06'].' '.$pokeInfo['name'].'?<br />
			<img src="images/pokemon/'.$pokeInfo['name'].'.png" alt="'.$pokeInfo['name'].'" /><br />
			<a href="release.php?id='.$pid.'&token='.$token.'&sure">'.$lang['release_07'].'</a> &bull; 
			<a href="view_box.php">'.$lang['release_08'].'</a><br /><br />
		</p>
	';
	
	if ($releaseReward != 0) {
		echo '
			<div style="font-size: 10pt; text-align: center; color: #FFFFFF;">
				'.$lang['release_09'].' $'.number_format($releaseReward).' '.$lang['release_10'].'!
			</div><br /><br />
		';
	}
}

include '_footer.php';
?>
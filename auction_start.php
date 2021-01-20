<?php
include('modules/lib.php');

if (!isLoggedIn()) { redirect('login.php'); }

if (!isset($_GET['id'])) { redirect('membersarea.php'); }
$pid = (int) $_GET['id'];
$uid = (int) $_SESSION['userid'];
$sqlUsername = cleanSql($_SESSION['username'], $conn);

include '_header.php';
printHeader($lang['auct_a_title']);

$query = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' AND `uid`='{$uid}'";
if (numRows($query, $conn) == 0) { 
	echo '<div class="error">'.$lang['auct_a_00'].'</div>';
	include '_footer.php';
	die();
}
$pokeRow = fetchAssoc($query, $conn);

if (in_array($pokeRow['id'], getUserTeamIds($uid))) { 
	echo '<div class="error">'.$lang['auct_a_01'].'</div>';
	include '_footer.php';
	die();
}

if (isset($_POST['duration']) && in_array($_POST['duration'], range(0, 4))) {
	$costs = array(
		'0' => 200,  // 10 mins
		'1' => 1000,  // 1 hour
		'2' => 5000,  // 6 hours
		'3' => 10000, // 1 day
		'4' => 15000  // 7 days
	);
	$cost = $costs[ $_POST['duration'] ];
	if (getUserMoney($uid) < $cost) {
		echo '<div class="error">'.$lang['auct_a_02'].'</div>';
	} else {
		$times = array(
			'0' => 60*10,  // 10 mins
			'1' => 60*60, // 1 hour
			'2' => 60*60*6, // 6 hours
			'3' => 60*60*24, // 1 day
			'4' => 60*60*24*7 // 7 days
		);
		$finishTime = time() + $times[ $_POST['duration'] ];
		
		$query = $conn->query("
			INSERT INTO `auction_pokemon`
			(
				`owner_id`,
				`owner_username`,
				`bidder_id`,
				`bidder_username`,
				`current_bid`,
				`name`,
				`exp`,
				`level`,
				`move1`,
				`move2`,
				`move3`,
				`move4`,
				`num_bids`,
				`gender`,
				`finish_time`
			) VALUES (
				'{$uid}',
				'{$sqlUsername}',
				'0',
				'',
				'1',
				'{$pokeRow['name']}',
				'{$pokeRow['exp']}',
				'{$pokeRow['level']}',
				'{$pokeRow['move1']}',
				'{$pokeRow['move2']}',
				'{$pokeRow['move3']}',
				'{$pokeRow['move4']}',
				'0',
				'{$pokeRow['gender']}',
				'{$finishTime}'
			)
		");
		if ($query) {
			$conn->query("DELETE FROM `user_pokemon` WHERE `id`='{$pid}' LIMIT 1");
			updateUserMoney($uid, getUserMoney($uid)-$cost);
		}
		echo '<div class="notice">'.$lang['auct_a_03'].'</div>';
		include '_footer.php';
		die();
	}
}



echo '
	<img src="images/pokemon/'.$pokeRow['name'].'.png" /><br />
	'.$pokeRow['name'].'<br />
	Level: '.$pokeRow['level'].'<br />
	Exp: '.$pokeRow['exp'].'<br />
	<br /><hr /><br />
	<form action="" method="post">
		<h3>'.$lang['auct_a_04'].'</h3><br />
		<input type="radio" name="duration" value="0" /> '.$lang['auct_a_05'].'<br />
		<input type="radio" name="duration" value="1" /> '.$lang['auct_a_06'].'<br />
		<input type="radio" name="duration" value="2" /> '.$lang['auct_a_07'].'<br />
		<input type="radio" name="duration" value="3" checked="checked" /> '.$lang['auct_a_08'].'<br />
		<input type="radio" name="duration" value="4" /> '.$lang['auct_a_09'].'<br /><br />
		<input type="submit" name="submit" value="'.$lang['auct_a_10'].'" />
	</form>
	<br /><hr /><br />
	<h3>'.$lang['auct_a_11'].'</h3><br />
	'.$lang['auct_a_12'].'<br /><br />
	'.$lang['auct_a_13'].'.<br /><br />
	<!--'.$lang['auct_a_14'].'<br /><br />-->
	'.$lang['auct_a_15'].'<br /><br />
	'.$lang['auct_a_16'].'<br />
	
';

include '_footer.php';
?>
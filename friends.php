<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

$uid = (int) $_SESSION['userid'];
logs($uid, " accessed friends page!");

include '_header.php';
printHeader($lang['friends_title']);


$query = "SELECT * FROM `friends` WHERE `uid`='{$uid}'";

if (numRows($query, $conn) == 0) {
	echo '<div class="error">'.$lang['friends_00'].'</div>';
	include '_footer.php';
	die();
}

echo '
	<table style="width: 98%; margin-bottom: 10px;" class="pretty-table">
		<tr>
			<th>'.$lang['friends_01'].'</th>
			<th>'.$lang['friends_02'].'</th>
			<th>'.$lang['friends_03'].'</th>
			<th colspan="2">&nbsp</th>
		</tr>
';

$i=0;
$result = $conn->query($query);
while($fRow = $result->fetch_assoc()) {
	$query2 = "
		SELECT
			`users`.*,
			SUM(`user_pokemon`.`exp`) AS `total_exp`
		FROM
			`users`,
			`user_pokemon`
		WHERE
			`users`.`id` = '{$fRow['friendid']}' AND
			`users`.`id` = `user_pokemon`.`uid`
	";
	$userInfo = fetchArray($query2, 2, $conn);
	$userInfo = cleanHtml($userInfo);
	
	echo '
		<tr>
			<td><a href="profile.php?id='.$userInfo['id'].'">'.$userInfo['username'].'</a></td>
			<td>$'.number_format($userInfo['money']).'</td>
			<td>'.number_format($userInfo['total_exp']).'</td>
			<td><a href="#" onclick="if (document.getElementById(\'team'.$i.'\').style.display == \'none\') { this.textContent = \'Hide&nbsp;Team\'; document.getElementById(\'team'.$i.'\').style.display = \'table-row\'; } else { this.textContent = \'Show&nbsp;Team\'; document.getElementById(\'team'.$i.'\').style.display = \'none\'; } return false;">'.$lang['friends_04'].'</a></td>
			<td><a href="messages.php?p=new&uid='.$userInfo['id'].'">'.$lang['friends_05'].'</a></td>
		</tr>
	';
	
	$cells = array();
	for ($x=1; $x<=6; $x++) {
		$pid = $userInfo[ 'poke' . $x ];
		
		
		if ($pid == 0) {
			$cells[] = '
				<img src="images/pokemon/EMPTY.png" alt="'.$lang['friends_06'].'" /><br />
				'.$lang['friends_07'].'<br /><br />
			';
		} else {
			$query3 = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}'";
			$pokeInfo = fetchAssoc($query3, $conn);
			
			$cells[] = '
				<img src="images/pokemon/'.$pokeInfo['name'].'.png" alt="'.$pokeInfo['name'].'" /><br />
				'.$pokeInfo['name'].'<br />
				'.$lang['friends_08'].' '.number_format($pokeInfo['level']).'<br />
				'.$lang['friends_09'].' '.number_format($pokeInfo['exp']).'<br />
			';
		}
	}
	echo '
		<tr style="display: none;" id="team'.$i.'">
			<td colspan="5">
				<h1>'.$userInfo['username'].''.$lang['friends_10'].'</h1>
				<table>'.cellsToRows($cells, 3).'</table>
			</td>
		</tr>
	';
	$i++;
}

echo '
	</table>
';
include '_footer.php';
?>

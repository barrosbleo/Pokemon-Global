<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';

printHeader($lang['slots_title']);
$uid = (int) $_SESSION['userid'];
$userMoney = getUserMoney($uid, $conn);
$pokeArr = array('Bulbasaur', 'Gengar', 'Celebi', 'Cleffa', 'Mewtwo', 'Golem', 'Squirtle', 'Pichu', 'Koffing', 'Charmander');
$betAmounts = array(1, 5, 10, 25, 50, 75, 100, 1000, 10000, 100000, 1000000);

if (isset($_POST['pull'], $_POST['bet']) && in_array($_POST['bet'], $betAmounts) && $_POST['bet'] <= $userMoney) {
	$randWin = rand(1, 20);
	$bet = (int) $_POST['bet'];

	$spinTable = '
		<table style="margin: 0 auto;">
			<tr>
				<td>&nbsp;</td>
				<td><img src="images/pokemon/'.$pokeArr[ array_rand($pokeArr) ].'.png"></td>
				<td><img src="images/pokemon/'.$pokeArr[ array_rand($pokeArr) ].'.png"></td>
				<td><img src="images/pokemon/'.$pokeArr[ array_rand($pokeArr) ].'.png"></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;">'.$lang['slots_00'].'</td>
	';
	if ($randWin == 3) {
		$message = ''.$lang['slots_01'].' $'.number_format($bet*4).'.';
		$randPoke = $pokeArr[ array_rand($pokeArr) ];
		$spinTable .= '
			<td><img src="images/pokemon/'.$randPoke.'.png"></td>
			<td><img src="images/pokemon/'.$randPoke.'.png"></td>
			<td><img src="images/pokemon/'.$randPoke.'.png"></td>
		';
		$userMoney += $bet*4;
	} else {
		shuffle($pokeArr);
		$spinTable .= '
			<td><img src="images/pokemon/'.$pokeArr[0].'.png"></td>
			<td><img src="images/pokemon/'.$pokeArr[1].'.png"></td>
			<td><img src="images/pokemon/'.$pokeArr[2].'.png"></td>
		';
		$message = ''.$lang['slots_02'].'';
		$userMoney -= $bet;
	}
	$spinTable .= '
				<td style="vertical-align: middle;">'.$lang['slots_03'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><img src="images/pokemon/'.$pokeArr[ array_rand($pokeArr) ].'.png"></td>
				<td><img src="images/pokemon/'.$pokeArr[ array_rand($pokeArr) ].'.png"></td>
				<td><img src="images/pokemon/'.$pokeArr[ array_rand($pokeArr) ].'.png"></td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<br />
	';
	
	$conn->query("UPDATE `users` SET `money`='{$userMoney}' WHERE `id`='{$uid}'");
}

echo '<div style="text-align: center; margin: 20px 0px;">';
echo '<div style="margin-bottom: 20px;">You have $'.number_format($userMoney).'.</div>';

if (isset($spinTable)) {
	echo $spinTable;
}

if (isset($message)) {
	echo $message . '<br />';
}

$optionTags = '';
foreach ($betAmounts as $amount) {
	if ($userMoney >= $amount) {
		$attr = isset($_POST['bet']) && $_POST['bet'] == $amount ? ' selected="selected"' : '' ;
		$optionTags .= '<option value="'.$amount.'"'.$attr.'>$'.number_format($amount).'</option>';
	}
}

echo '
	<form action="" method="post" style="margin: 20px 0px;">
		<select name="bet">
			'.$optionTags.'
		</select>
		<input type="submit" class="smallbutton" name="pull" value="'.$lang['slots_04'].'" />
	</form>
	<br />
	<span style="font-size: 80%;">'.$lang['slots_05'].'</span>
';

echo '</div>';

echo '</div>';

include '_footer.php';
?>
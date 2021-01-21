<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	die('what?');
}

$pid = (int) $_GET['id'];
$uid = (int) $_SESSION['userid'];
$query = "SELECT * FROM `user_pokemon` WHERE `id`='$pid' LIMIT 1";
$pokemon = fetchAssoc($query, $conn);
$type = '';

if (numRows($query, $conn) == 0 || $pokemon['uid'] != $uid) {
	die('error');
}

if (strpos($pokemon['name'], 'Shiny ') === 0) {
	$pokemon['name'] = str_replace('Shiny ', '', $pokemon['name']);
	$type = 'Shiny ';
}


if (strpos($pokemon['name'], 'Possion ') === 0) {
	$pokemon['name'] = str_replace('Possion ', '', $pokemon['name']);
	$type = 'Possion ';
}
if (strpos($pokemon['name'], 'Shadow ') === 0) {
	$pokemon['name'] = str_replace('Shadow ', '', $pokemon['name']);
	$type = 'Shadow ';
}

if (strpos($pokemon['name'], 'Helios ') === 0) {
	$pokemon['name'] = str_replace('Helios ', '', $pokemon['name']);
	$type = 'Helios ';
}

if (strpos($pokemon['name'], 'Snow ') === 0) {
	$pokemon['name'] = str_replace('Snow ', '', $pokemon['name']);
	$type = 'Snow ';
}
if (strpos($pokemon['name'], 'Halloween ') === 0) {
	$pokemon['name'] = str_replace('Halloween ', '', $pokemon['name']);
	$type = 'Halloween ';
}

if (strpos($pokemon['name'], 'Enraged ') === 0) {
	$pokemon['name'] = str_replace('Enraged ', '', $pokemon['name']);
	$type = 'Enraged ';
}

if (strpos($pokemon['name'], 'Rainbow ') === 0) {
	$pokemon['name'] = str_replace('Rainbow ', '', $pokemon['name']);
	$type = 'Rainbow ';
}

include '_header.php';
printHeader($lang['evolve_title']);


if (isset($_GET['eid'])) {
	$eid = (int) $_GET['eid'];
	$query = "SELECT * FROM `evolution` WHERE `before`='{$pokemon['name']}' AND `id`='{$eid}' LIMIT 1";
	
	if (numRows($query, $conn) == 0) {
		echo '<div class="error">'.$lang['evolve_00'].'</div>';
	} else {
		$epokemon = fetchAssoc($query, $conn);
		
		$query = "SELECT * FROM `user_items` WHERE `uid`='{$uid}' LIMIT 1";
		$userItems = fetchAssoc($query, $conn);
		
		$items = array(
			'Dawn Stone'    => 'dawn_stone',
			'Dusk Stone'    => 'dusk_stone',
			'Fire Stone'    => 'fire_stone',
			'Leaf Stone'    => 'leaf_stone',
			'Moon Stone'    => 'moon_stone',
			'Oval Stone'    => 'oval_stone',
			'Shiny Stone'   => 'shiny_stone',
			'Sun Stone'     => 'sun_stone',
			'Thunder Stone' => 'thunder_stone',
			'Water Stone'   => 'water_stone'
		);

		if ($pokemon['level'] < $epokemon['level'] && $epokemon['level'] != 0) {
			echo '
				<div class="error">
					'.$type.$pokemon['name'].' '.$lang['evolve_01'].' '.$epokemon['level'].' '.$lang['evolve_02'].'
				</div>
			';
		} else if (!empty($epokemon['item']) && $userItems[ $items[ $epokemon['item'] ] ] <= 0) {
			echo '
				<div class="error">
					'.$type.$pokemon['name'].' '.$lang['evolve_03'].' '.$epokemon['item'].' '.$lang['evolve_04'].'
				</div>
			';
		} else {
			echo '
				<table style="margin: 30px auto;">
					<tr>
						<td><img src="images/pokemon/'.$type.$pokemon['name'].'.png" /></td>
						<td> -> </td>
						<td><img src="images/pokemon/'.$type.$epokemon['after'].'.png" /></td>
					</tr>
					<tr>
						<td colspan="3">'.$type.$pokemon['name'].' '.$lang['evolve_05'].' '.$type.$epokemon['after'].'</td>
					</tr>
				</table>
			';
			
			$q = "SELECT * FROM `pokemon` WHERE `name`='{$epokemon['after']}'";
			$moves = fetchAssoc($q, $conn);
			$moveSql = '';
			
			if (isset($_POST['moves'])) {
				$moveSql = ", `move1`='{$moves['move1']}', `move2`='{$moves['move2']}', `move3`='{$moves['move3']}', `move4`='{$moves['move4']}' ";
			}
			
			$conn->query("UPDATE `user_pokemon` SET `name`='{$type}{$epokemon['after']}' {$moveSql} WHERE `id`='{$pid}' LIMIT 1");
			
			if (!empty($epokemon['item'])) {
				$cname = $items[ $epokemon['item'] ];
				$conn->query("UPDATE `user_items` SET `{$cname}`=`{$cname}`-1 WHERE `uid`='{$uid}' LIMIT 1");
			}
		}
	}
} else {
	echo '
		<div style="text-align: center;">
			<img src="images/pokemon/'.$type.$pokemon['name'].'.png" /><br />
			Level: '.$pokemon['level'].'
		</div>
	';


	$query = "SELECT * FROM `evolution` WHERE `before`='{$pokemon['name']}'";

	if (numRows($query, $conn) == 0) {
		echo '<div class="error">'.$type.$pokemon['name'].' '.$lang['evolve_06'].'</div>';
	} else {
		$result = $conn->query($query);
		while ($epokemon = $result->fetch_assoc()) {
			$q = "SELECT * FROM `pokemon` WHERE `name`='{$epokemon['after']}'";
			$moves = fetchAssoc($q, $conn);
			echo '
				<hr style="width: 500px; margin: 0 auto;" />
				<form action="evolve.php?id='.$pid.'&eid='.$epokemon['id'].'" method="post" style="text-align: center;">
					<table style="margin: 30px auto; text-align: center;">
						<tr>
							<td><img src="images/pokemon/'.$type.$pokemon['name'].'.png" /></td>
							<td> -> </td>
							<td><img src="images/pokemon/'.$type.$epokemon['after'].'.png" /></td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="checkbox" checked="checked" name="moves" />
								'.$lang['evolve_07'].' '.$moves['move1'].', '.$moves['move2'].', '.$moves['move3'].' '.$lang['evolve_08'].' '.$moves['move4'].'?
							</td>
						</tr>
						<tr>
							<td colspan="3"><input type="submit" value="'.$lang['evolve_09'].' '.$type.$epokemon['after'].'" /></td>
						</tr>
					</table>
				</form>
			';
		}
	}
}

include '_footer.php';
?>
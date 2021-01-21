<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['shop_title']);

$uid = (int) $_SESSION['userid'];

$query = "SELECT * FROM `user_items` WHERE `uid`='{$uid}' LIMIT 1";
$itemAmounts = fetchAssoc($query, $conn);

$query = "SELECT `money` FROM `users` WHERE `id`='{$uid}' LIMIT 1";
$userMoney = fetchAssoc($query, $conn);
$userMoney = $userMoney['money'];

$items = array(
	'poke_ball' => array(
		'name' => 'Poke Ball',
		'price' => 100
	),
	'great_ball' => array(
		'name' => 'Great Ball',
		'price' => 300
	),
	'ultra_ball' => array(
		'name' => 'Ultra Ball',
		'price' => 500
	),
	'master_ball' => array(
		'name' => 'Master Ball',
		'price' => 2000
	),
	'potion' => array(
		'name' => 'Potion',
		'price' => 200
	),
	'super_potion' => array(
		'name' => 'Super Potion',
		'price' => 500
	),
	'hyper_potion' => array(
		'name' => 'Hyper Potion',
		'price' => 1000
	),
	'burn_heal' => array(
		'name' => 'Burn Heal',
		'price' => 300
	),
	'full_heal' => array(
		'name' => 'Full Heal',
		'price' => 1500
	),
	'parlyz_heal' => array(
		'name' => 'Parlyz Heal',
		'price' => 300
	),
	'antidote' => array(
		'name' => 'Antidote',
		'price' => 200
	),
	'awakening' => array(
		'name' => 'Awakening',
		'price' => 200
	),
	'ice_heal' => array(
		'name' => 'Ice Heal',
		'price' => 100
	),
	'dawn_stone' => array(
		'name' => 'Dawn Stone',
		'price' => 100
	),
	'dusk_stone' => array(
		'name' => 'Dusk Stone',
		'price' => 100
	),
	'fire_stone' => array(
		'name' => 'Fire Stone',
		'price' => 100
	),
	'leaf_stone' => array(
		'name' => 'Leaf Stone',
		'price' => 100
	),
	'moon_stone' => array(
		'name' => 'Moon Stone',
		'price' => 100
	),
	'oval_stone' => array(
		'name' => 'Oval Stone',
		'price' => 100
	),
	'shiny_stone' => array(
		'name' => 'Shiny Stone',
		'price' => 100
	),
	'sun_stone' => array(
		'name' => 'Sun Stone',
		'price' => 100
	),
	'thunder_stone' => array(
		'name' => 'Thunder Stone',
		'price' => 100
	),
	'water_stone' => array(
		'name' => 'Water Stone',
		'price' => 100
	)
);

if (isset($_POST['buy'])) {
	
	$totalCost = 0;
	$updateSqlArray = array();
	$newItemAmounts = $itemAmounts;
	$totalItems = 0;
	
	foreach ($_POST as $item => $amount) {
		$amount = (int) $amount;
		$amount = $amount < 1 ? 0 : $amount;
		
		if (array_key_exists($item, $items) && $amount > 0) { 
			$totalCost += $amount * $items[$item]['price'];
			$updateSqlArray[] = "`$item`=`$item`+$amount";
			$newItemAmounts[$item] += $amount;
			$totalItems += $amount;
		}
	}
	
	if ($totalItems == 0) {
		echo '<div class="error">'.$lang['shop_00'].'</div>';
	} elseif ($totalCost > $userMoney) {
		echo '<div class="error">'.$lang['shop_01'].'</div>';
	} else {
		echo'<div class="success">'.$lang['shop_02'].'</div>';
		
		$updateSql = implode(', ', $updateSqlArray);
		$conn->query("UPDATE `user_items` SET {$updateSql} WHERE `uid`='{$uid}'");
		
		$conn->query("UPDATE `users` SET `money`=`money`-$totalCost WHERE `id`='{$uid}'");
		$userMoney -= $totalCost;
		$itemAmounts = $newItemAmounts;
	}
}

$query = "SELECT * FROM `user_items` WHERE `uid`='{$uid}'";
$row = fetchAssoc($query, $conn);

echo '
	<div style="text-align: center; margin: 10px auto; ">
		'.$lang['shop_03'].' $'.number_format($userMoney).'<br /><br />
		
	</div>
	<form action="" method="post">
	<table class="pretty-table">
		<tr>
			<th style="width: 50px;">&nbsp;</th>
			<th>'.$lang['shop_04'].'</th>
			<th>'.$lang['shop_05'].'</th>
			<th>'.$lang['shop_06'].'</th>
		</tr>
';

foreach ($items as $cname => $item) {
	echo '
		<tr>
			<td><img src="images/items/'.$item['name'].'.png" title="'.$item['info'].'" align="middle"/></td>
			<td>'.$item['name'].'</td>
			<td>'.number_format($itemAmounts[$cname]).'</td>
			<td style="text-align: left; padding-left: 10px;">
				<select name="'.$cname.'">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>

				</select>&nbsp;($'.number_format($item['price']).'&nbsp;each)
			</td>
		</tr>
	';
}

echo '
		<tr>
			<td colspan="4"><input class="button" type="submit" name="buy" value="'.$lang['shop_07'].'"></td>
		</tr>
	</table>
	</form>
';

include '_footer.php';
?>
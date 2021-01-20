<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

$uid = (int) $_SESSION['userid'];
$userTokens = getUserToken($uid, $conn);

$query = "SELECT * FROM `token_shop_pokemon` ORDER BY `price` ASC";

if (numRows($query, $conn) == 0) {
    include '_header.php';
    echo '
        <div class="error">'.$lang['token_shop_00'].'</div>
    ';
    include '_footer.php';
}

$salePokemon = array();

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $salePokemon[ $row['name'] ] = $row['price'];
}

include '_header.php';
printHeader($lang['token_shop_title']);

if (isset($_POST['buyPoke'])) {

	$pokeName = $_POST['buyPoke'];
	if (in_array($pokeName, array_keys($salePokemon))) {
	
		$price = $salePokemon[$pokeName];
		if ($price > $userTokens) {
			echo '<div class="error">'.$lang['token_shop_01'].'</div>';
		} else {
			$userTokens -= $price;
			updateUserToken($uid, $userTokens, $conn);
			giveUserPokemon($uid, $pokeName, 50, levelToExp(50), 'Scratch', 'Scratch', 'Scratch', 'Scratch', $conn);
            
			echo '
				<div class="notice" style="color: #000000;">
					<img src="images/pokemon/'.$pokeName.'.png" /><br />
					'.$lang['token_shop_02'].' '.$pokeName.'.
				</div>
			';
		}
	} else {
		echo '<div class="error">'.$lang['token_shop_03'].'</div>';
	}
}

$cells = array();
foreach ($salePokemon as $name => $price) {
	$cells[] = '
		<img src="images/pokemon/'.$name.'.png" /><br />
		<input type="radio" name="buyPoke" value="'.$name.'" />
		'.$name.'<br />
		'.number_format($price).' '.$lang['token_shop_04'].'<br />
	';
}

$items = array(
	'rare_candy' => array(
		'name' => 'Rare Candy',
		'price' => 1
	)
);
$query = "SELECT * FROM `user_items` WHERE `uid`='{$uid}'";
$itemAmounts = fetchAssoc($query, $conn);

if (isset($_POST['buy_items'])) {
	
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
		echo '<div class="error">'.$lang['token_shop_05'].'</div>';
	} elseif ($totalCost > $userTokens) {
		echo '<div class="error">'.$lang['token_shop_06'].'</div>';
	} else {
		echo'<div class="success">'.$lang['token_shop_07'].'</div>';
		
		$updateSql = implode(', ', $updateSqlArray);
		$conn->query("UPDATE `user_items` SET {$updateSql} WHERE `uid`='{$uid}'");
		$conn->query("UPDATE `users` SET `token`=`token`-$totalCost WHERE `id`='{$uid}'");
		$userTokens -= $totalCost;
		$itemAmounts = $newItemAmounts;
	}
}

echo ' 

	<div style="text-align: center; margin: 30px auto; ">
		'.$lang['token_shop_08'].' '.number_format($userTokens).' '.$lang['token_shop_09'].'.<br />
        <a href="donate.php">'.$lang['token_shop_10'].'</a>
	</div>
	<form action="" method="post">
		<table class="pretty-table">
			'.cellsToRows($cells, 5).'
			<tr>
				<td colspan="5"><input type="submit" value="'.$lang['token_shop_11'].'"></td>
			</tr>
		</table>
	</form>
	<br />
	<form action="" method="post">
		<table class="pretty-table">
			<tr>
				<th>&nbsp;</th>
				<th>'.$lang['token_shop_12'].'</th>
				<th>'.$lang['token_shop_13'].'</thd>
				<th>'.$lang['token_shop_14'].'</th>
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
				</select>&nbsp;('.number_format($item['price']).'&nbsp;token&nbsp;each)
			</td>
		</tr>
	';
}
echo '
			<tr>
				<td colspan="5"><input type="submit" name="buy_items" value="'.$lang['token_shop_15'].'"></td>
			</tr>
		</table>
	</form>
';
// WTF is this?
// include 'tshop.php';
echo '</div>';

include '_footer.php';
?>
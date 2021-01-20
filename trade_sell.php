<?php
include('modules/lib.php');

if (!isLoggedIn()) { redirect('index.php'); }
if (!isset($_GET['uid'])) { redirect('membersarea.php'); }

include '_header.php';
$word = isset($_GET['sale']) ? 'sale' : 'trade' ;
printHeader($lang['trade_sell_title'].ucwords($word));

$uid = (int) $_GET['uid'];

$query = "SELECT * FROM `users` WHERE `id`='{$uid}'";
if (numRows($query, $conn) == 0) {
	echo '<div class="error">'.$lang['trade_sell_00'].'</div>';
	include '_footer.php';
	die();
}
$userRow = fetchAssoc($query, $conn);

$tablename = isset($_GET['sale']) ? 'sale_pokemon' : 'trade_pokemon' ;
$query = "SELECT * FROM `{$tablename}` WHERE `uid`='{$uid}'";
$numPokes = numRows($query, $conn);

if ($numPokes == 0) {
	
	echo '<div class="error">'.$lang['trade_sell_01'].' '.$word.'.</div>';
	include '_footer.php';
	die();
}

$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 100 ;
$limit = $limit <= 0 ? 100 : $limit ;
$limit = $limit > $numPokes ? $numPokes : $limit ;

$query = "SELECT * FROM `{$tablename}` WHERE `uid`='{$uid}' ORDER BY `id` DESC LIMIT {$limit}";

echo '
	<div style="overflow: auto;">
		'.$lang['trade_sell_02'].' '.$limit.'/'.$numPokes.' '.$lang['trade_sell_03'].' '.$word.' '.$lang['trade_sell_04'].' <a href="profile.php?id='.$userRow['id'].'">'.cleanHtml($userRow['username']).'</a>.<br /><br />
';
if ($limit < $numPokes) {
	$text = isset($_GET['sale']) ? ''.$lang['trade_sell_05'].' '.$numPokes.' '.$lang['trade_sell_06'].'' : ''.$lang['trade_sell_07'].' '.$numPokes.' '.$lang['trade_sell_08'];
	echo '
		<form action="" method="get">
			<input type="hidden" name="uid" value="'.$uid.'" /> 
			<input type="hidden" name="limit" value="'.$numPokes.'" /> 
			<input type="submit" value="'.$text.'" /> 
		</form>
	';
}


$result = $conn->query($query);
while ($poke = $result->fetch_assoc()) {
	$price = isset($_GET['sale']) ? ''.$lang['trade_sell_09'].' $'.number_format($poke['price']).'<br />' : '';
	$link = isset($_GET['sale']) ? 'sell_pokemon.php?p=buy&id='.$poke['id'] : 'trade.php?a=mao&id='.$poke['id'] ;
	echo '
		<div style="height: 200px; width: 150px; float: left;">
			<img src="images/pokemon/'.$poke['name'].'.png"><br />
			<a href="'.$link.'">'.$poke['name'].'</a><br />
			'.$lang['trade_sell_10'].' '.number_format($poke['level']).'<br />
			'.$lang['trade_sell_11'].' '.number_format($poke['exp']).'<br />
			'.$price.'
		</div>
	';		
}
echo '
	</div>
';
include '_footer.php';
?>
<?php


$uid = (int) $_SESSION['userid'];


// username, money, tokens etc
$query = "SELECT * FROM `users` WHERE `id`='{$uid}' LIMIT 1";
$userRow = fetchAssoc($query, $conn);

$username            = cleanHtml($userRow['username']);
$money               = $userRow['money'];
$tokens              = $userRow['token'];
$totalMessages       = $userRow['total_messages'];
$totalUnreadMessages = $userRow['unread_messages'];
$totalSalePoke       = $userRow['total_sale_pokes'];
$newSales            = $userRow['newly_sold_pokes'];

// total messages
//$query = mysql_query("SELECT * FROM `messages` WHERE `recipient_uid`='{$uid}' AND `deleted_by_recipient`='0'");
//$totalMessages = numRows($query, $conn);

// total unread messages
//$query = mysql_query("SELECT * FROM `messages` WHERE `recipient_uid`='{$uid}' AND `read`='0' AND `deleted_by_recipient`='0'");
//$totalUnreadMessages = numRows($query, $conn);

// total pokemon for sale
// $query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid`='{$uid}'");
// $totalSalePoke = numRows($query, $conn);

// new sales
// $query = mysql_query("SELECT * FROM `sale_history` WHERE `uid`='{$uid}' AND `seen`='0'");
// $newSales = numRows($query, $conn);

// total trade offers
$query = "SELECT `id` FROM `trade_pokemon` WHERE `uid`='{$uid}'";
$tradeIds = array();
$result = $conn->query($query);
while ($tradeId = $result->fetch_assoc()) { $tradeIds[] = $tradeId['id']; }
$tradeIdSql = '\''.implode('\', \'', $tradeIds) .'\'';

$query = "SELECT * FROM `offer_pokemon` WHERE `tid` IN ({$tradeIdSql}) GROUP BY `oid`";
$totalOffers = numRows($query, $conn);
?>

<div id="panel">
<table id="panel1">
	<tr>
		<td>
			<a href="/profile.php" style="color: #FFF; font-weight: bold;"><?php echo $username;?></a><br>
			$<?php echo number_format($money);?><br>
			<?php echo number_format($tokens);?> tokens
		</td>
		
		<td>
			<a href="/messages.php?p=inbox" style="color: #FFF; font-weight: bold;">Messages</a><br>
			<a href="/messages.php?p=inbox">Total: <?php echo $totalMessages;?></a><br>
			<a href="/messages.php?p=inbox">Unread: <?php echo $totalUnreadMessages;?></a>
		</td>
		
		<td>	
			<a href="/sell_pokemon.php" style="color: #FFF; font-weight: bold;">Pokemon For Sale</a><br>
			<a href="/sell_pokemon.php?p=mine">Total: <?php echo $totalSalePoke;?></a><br>
			<a href="/sell_pokemon.php?p=history">Newly Sold: <?php echo $newSales;?></a>
		</td>
		
		<td>
			<a href="/trade.php" style="color: #FFF; font-weight: bold;">Trades</a><br>
			<a href="/trade.php?a=vao">Total Offers: <?php echo $totalOffers;?></a>
		</td>
	<tr>
</table>
</div>
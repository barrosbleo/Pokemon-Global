<?php


$uid = (int) $_SESSION['userid'];



// username, money, tokens etc
$query = mysql_query("SELECT * FROM `users` WHERE `id`='{$uid}' LIMIT 1");
$userRow = mysql_fetch_assoc($query);

$username            = cleanHtml($userRow['username']);
$money               = $userRow['money'];
$tokens              = $userRow['token'];
$totalMessages       = $userRow['total_messages'];
$totalUnreadMessages = $userRow['unread_messages'];
$totalSalePoke       = $userRow['total_sale_pokes'];
$newSales            = $userRow['newly_sold_pokes'];

// total messages
//$query = mysql_query("SELECT * FROM `messages` WHERE `recipient_uid`='{$uid}' AND `deleted_by_recipient`='0'");
//$totalMessages = mysql_num_rows($query);

// total unread messages
//$query = mysql_query("SELECT * FROM `messages` WHERE `recipient_uid`='{$uid}' AND `read`='0' AND `deleted_by_recipient`='0'");
//$totalUnreadMessages = mysql_num_rows($query);

// total pokemon for sale
// $query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid`='{$uid}'");
// $totalSalePoke = mysql_num_rows($query);

// new sales
// $query = mysql_query("SELECT * FROM `sale_history` WHERE `uid`='{$uid}' AND `seen`='0'");
// $newSales = mysql_num_rows($query);

// total trade offers
$query = mysql_query("SELECT `id` FROM `trade_pokemon` WHERE `uid`='{$uid}'");
$tradeIds = array();
while ($tradeId = mysql_fetch_assoc($query)) { $tradeIds[] = $tradeId['id']; }
$tradeIdSql = '\''.implode('\', \'', $tradeIds) .'\'';

$query = mysql_query("SELECT * FROM `offer_pokemon` WHERE `tid` IN ({$tradeIdSql}) GROUP BY `oid`");
$totalOffers = mysql_num_rows($query);

if ($totalUnreadMessages > 0) {
	$totalUnreadMessages = '<font style="color: #e74c3c;">'.$totalUnreadMessages.'</font>';
}
if ($totalOffers > 0) {
	$totalOffers = '<font style="color: #e74c3c;">'.$totalOffers.'</font>';
}
if ($newSales > 0) {
	$newSales = '<font style="color: #e74c3c;">'.$newSales.'</font>';
}
?>

<li class="usr-inf-title"><a href="#"><?php echo $lang['side_right_title'];?></a></li>
<li>
	<div class="info-box">
		<a href="/messages.php?p=inbox"><?php echo $lang['side_right_msg_01'];?><?php echo $totalMessages;?></a>
		<a href="/messages.php?p=inbox"><?php echo $lang['side_right_msg_02'];?><?php echo $totalUnreadMessages;?></a>
		<a href="/sell_pokemon.php?p=all"><?php echo $lang['side_right_trade_01'];?><?php echo $totalSalePoke;?></a>  	
		<a href="/sell_pokemon.php?p=history"><?php echo $lang['side_right_trade_02'];?><?php echo $newSales;?></a>
		<a href="/trade.php?a=vao"><?php echo $lang['side_right_trade_03'];?><?php echo $totalOffers;?></a>
	</div>
</li>

</ul>

<?php
if($_SESSION['userid']) {	
?>

	<ul class="usr-inf left">
		<li class="usr-inf-title"><a href="/profile.php?id=<?php echo $_SESSION['userid']; ?>&amp;lref=2"><?php echo $lang['side_left_title_01'];?></a></li>	
		<li>			
			<div class="user-info">
				<p>ID: <?php echo $userRow['id'];?></p>
				<p><?php echo $username;?></p>
				<p>$<?php echo number_format($money);?></p>
				<p><?php echo number_format($tokens);?> Tokens</p>
				<p><?php echo $lang['side_left_lvl'];?><?php echo expToLevel($userRow['trainer_exp']);?></p>
			</div>
		</li>
		
		<li class="usr-inf-title"><a href="#"><?php echo $lang['side_left_title_02'];?></a></li>
		<li>
			<div class="info-box">
				<a href="/quest.php?page=active"><?php echo $lang['side_left_links_00'];?></a>
				<a href="/auction.php?lref=1"><?php echo $lang['side_left_links_01'];?></a>
				<a href="/view_box.php?lref=3"><?php echo $lang['side_left_links_02'];?></a>
				<a href="/trade.php?lref=4"><?php echo $lang['side_left_links_03'];?></a>
				<a href="/sell_pokemon.php?lref=5"><?php echo $lang['side_left_links_04'];?></a>
				<a href="/fix.php?lref=6"><?php echo $lang['side_left_links_05'];?></a>
				<a href="/chatroom.php?lref=7"><?php echo $lang['side_left_links_06'];?></a>
				<a href="http://forums.pkmnhelios.net/"><?php echo $lang['side_left_links_07'];?></a>
				<a href="/online.php?lref=9"><?php echo $lang['side_left_links_08'];?></a>
				<a href="/users.php?lref=10"><?php echo $lang['side_left_links_09'];?></a>
			</div>		
		</li>
	</ul>
<?php } ?>
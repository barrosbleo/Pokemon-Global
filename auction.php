<?php
include('modules/lib.php');

function secsToTimeAmountArray($secs) {
	if ($secs <= 0) { return array('-'); }
	
        $seconds = array(
                'days'    => 86400,
                'hours'   =>  3600,
                'minutes' =>    60,
                'seconds' =>     1,
        );
        $timeAmounts = array();
        
        foreach ($seconds as $name => $seconds) {
        	$amount = intval($secs / $seconds);
        	$secs -= $amount * $seconds;
		if ($amount > 0) {
			$timeAmounts[] = $amount.' '.($amount == 1 ? rtrim($name, 's') : $name );
		}
        }
        return $timeAmounts;
}

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['auct_title']);

$uid = (int) $_SESSION['userid'];
$sqlUsername = cleanSql($_SESSION['username']);

$query = mysql_query("SELECT * FROM `auction_pokemon` LIMIT 1");

if (mysql_num_rows($query) == 0) {
	echo '<div class="notice">'.$lang['auct_00'].'</div>';
	include '_footer.php';
	die();
}

if (isset($_POST['pid']) && isset($_POST['bid'])) {
	$errors = array();
	$pid = (int) $_POST['pid'];
	$bid = (int) $_POST['bid'];
	$query = mysql_query("SELECT * FROM `auction_pokemon` WHERE `id`='{$pid}'");
	
	if (mysql_num_rows($query) == 0) {
		$errors[] = $lang['auct_01'];
	} else {
		$auctionRow = mysql_fetch_assoc($query);
		$time = time();
		
		if ($auctionRow['finish_time'] < $time) {
			$errors[] = $lang['auct_02'];
		}
		
		if ($bid <= $auctionRow['current_bid']) {
			$errors[] = $lang['auct_03'];
		}
		
		if (getUserMoney($uid)-$bid < 0) {
			$errors[] = $lang['auct_04'];
		}
		
		if ($uid == $auctionRow['owner_id']) {
			$errors[] = $lang['auct_05'];
		}
	}
	
	if (count($errors) != 0) {
		echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
	} else {
		if ($auctionRow['bidder_id'] != 0) {
			$lastBid = $auctionRow['current_bid'];
			$bidId = $auctionRow['bidder_id'];
			
			mysql_query("UPDATE `users` SET `money`=`money`+{$lastBid} WHERE `id`='{$bidId}' LIMIT 1");
		}
		
		mysql_query("UPDATE `auction_pokemon` SET `bidder_id`='{$uid}', `bidder_username`='{$sqlUsername}', `current_bid`='{$bid}', `num_bids`=`num_bids`+1 WHERE `id`='{$pid}' LIMIT 1");
		mysql_query("UPDATE `users` SET `money`=`money`-{$bid} WHERE `id`='{$uid}' LIMIT 1");
		
		echo '<div class="notice">'.$lang['auct_06'].' $'.number_format($bid).' '.$lang['auct_07'].' '.$auctionRow['name'].'.</div>';
	}
	
}

$extraSqlArr = array(
	'1' => array(
		'sql' => 'ORDER BY `id` DESC',
		'text' => $lang['auct_08']
	),
	'2' => array(
		'sql' => 'ORDER BY `num_bids` DESC',
		'text' => $lang['auct_09']
	),
	'3' => array(
		'sql' => 'ORDER BY `exp` DESC',
		'text' => $lang['auct_10']
	),
	'4' => array(
		'sql' => "WHERE `owner_id`='{$uid}' ORDER BY `id` DESC",
		'text' => $lang['auct_11']
	),
	'5' => array(
		'sql' => 'ORDER BY `finish_time` ASC',
		'text' => $lang['auct_12']
	)
);
$key = isset($_GET['s']) && array_key_exists($_GET['s'], $extraSqlArr) ? (int) $_GET['s'] : 1 ;
$extraSql = $extraSqlArr[ $key ]['sql'];

$links = array();
foreach ($extraSqlArr as $k => $a) {
	$links[] = $key == $k ? $a['text'] : '<a href="?s='.$k.'">'.$a['text'].'</a>' ;
}

$query = mysql_query("SELECT * FROM `auction_pokemon` {$extraSql}");

echo '
	<img src="images/auction.png" /><br /><br />
	<a href="auction_history.php">'.$lang['auct_13'].'</a><br /><br />
	'.implode(' &bull; ', $links).'<br /><br />
	<table class="pretty-table">
		<tr>
			<th>'.$lang['auct_14'].'</th>
			<th>'.$lang['auct_15'].'</th>
			<th>'.$lang['auct_16'].'</th>
			<th>'.$lang['auct_17'].'</th>
			<th>'.$lang['auct_18'].'</th>
		</tr>
';
while ($auctionRow = mysql_fetch_assoc($query)) {
	$secondsLeft = $auctionRow['finish_time']-time();
	$amountArray = secsToTimeAmountArray($secondsLeft);
	echo '
		<tr>
			<td>
				<img src="images/pokemon/'.$auctionRow['name'].'.png" /><br />
				'.$auctionRow['name'].'
			</td>
			<td>
				<span title="Exp: '.number_format($auctionRow['exp']).'">
					&nbsp;'.number_format($auctionRow['level']).'&nbsp;
				</span>
			</td>
			<td>
				<a href="profile.php?id='.$auctionRow['owner_id'].'">'.cleanHtml($auctionRow['owner_username']).'</a>
			</td>
			<td>
				<span title="'. implode(', ', $amountArray) .'">
					'.$amountArray[0].'
				</span>
			</td>
			<td>
	';
	if ($auctionRow['bidder_id'] == 0) {
		echo $lang['auct_19'].'<br />';
	} else {
		echo '$'.number_format($auctionRow['current_bid']).' 
		by <a href="profile.php?id='.$auctionRow['bidder_id'].'">'.cleanHtml($auctionRow['bidder_username']).'</a><br />';
	}
	
	$time = time();
	if ($auctionRow['finish_time'] < $time) {
		echo '<br />'.$lang['auct_20'].'<br />';
	} else {
		
		echo '
			<br /><br />
			<form action="" method="post">
				<input type="hidden" name="pid" value="'.$auctionRow['id'].'" />
				Your Bid: <input type="text" name="bid" value="'.($auctionRow['current_bid']+1).'" size="5" /> <input type="submit" value="Bid" />
			</form>
		';
	}
	echo '
			</td>
		</tr>
	';
}
echo '
	</table>
';


include '_footer.php';
?>
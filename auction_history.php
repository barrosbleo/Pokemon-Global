<?php
include('modules/lib.php');

function secsToRoughTime($secs) {
        $seconds = array(
                'days'    => 86400,
                'hours'   =>  3600,
                'minutes' =>    60,
                'seconds' =>     1,
        );
        
        foreach ($seconds as $name => $seconds) {
        	$amount = intval($secs / $seconds);
		if ($amount > 0) {
			return $amount.' '.($amount == 1 ? rtrim($name, 's') : $name );
		}
        }
        return '-';
}

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['auct_h_title']);

$uid = (int) $_SESSION['userid'];

$extraSqlArr = array(
	'1' => array(
		'sql' => 'ORDER BY `finish_time` DESC',
		'text' => $lang['auct_h_00']
	),
	'2' => array(
		'sql' => 'ORDER BY `winning_bid` DESC',
		'text' => $lang['auct_h_01']
	),
	'3' => array(
		'sql' => 'ORDER BY `level` DESC',
		'text' => $lang['auct_h_02']
	),
	'4' => array(
		'sql' => "WHERE `owner_id`='{$uid}' ORDER BY `finish_time` DESC",
		'text' => $lang['auct_h_03']
	),
);
$key = isset($_GET['s']) && array_key_exists($_GET['s'], $extraSqlArr) ? (int) $_GET['s'] : 1 ;
$extraSql = $extraSqlArr[ $key ]['sql'];

$links = array();
foreach ($extraSqlArr as $k => $a) {
	$links[] = $key == $k ? $a['text'] : '<a href="?s='.$k.'">'.$a['text'].'</a>' ;
}

$query = "SELECT * FROM `auction_history` {$extraSql} LIMIT 100";

echo '
	<img src="images/auction.png" /><br /><br />
	<a href="auction.php">'.$lang['auct_h_04'].'</a><br /><br />
	'.implode(' &bull; ', $links).'<br /><br />
';

if (numRows($query, $conn) == 0) {
	echo '<div class="notice">'.$lang['auct_h_05'].'</div>';
	include '_footer.php';
	die();
}

echo '
	<table class="pretty-table">
		<tr>
			<th>'.$lang['auct_h_06'].'</th>
			<th>'.$lang['auct_h_07'].'</th>
			<th>'.$lang['auct_h_08'].'</th>
			<th>'.$lang['auct_h_09'].'</th>
			<th>'.$lang['auct_h_10'].'</th>
		</tr>
';
$conn->query($query);
while ($auctionRow = $result->fetch_assoc()) {
	
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
				'.secsToRoughTime(time()-$auctionRow['finish_time']).' ago
			</td>
			<td>
	';
	if ($auctionRow['winner_id'] == 0) {
		echo $lang['auct_h_11'].'<br />';
	} else {
		echo '
			<a href="profile.php?id='.$auctionRow['winner_id'].'">'.cleanHtml($auctionRow['winner_username']).'</a><br />
			'.$lang['auct_h_12'].' $'.number_format($auctionRow['winning_bid']).' 
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
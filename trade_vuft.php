<?php
$exp = explode('/', $_SERVER["SCRIPT_NAME"]);
$filename = end($exp);
if ($filename != 'trade.php') { die(); }

$sorts = array
(
    1 => ' ORDER BY `name` ASC',
    2 => ' ORDER BY `name` DESC',
    3 => ' ORDER BY `exp` ASC',
    4 => ' ORDER BY `exp` DESC',
    5 => ' ORDER BY `id` ASC',
    6 => ' ORDER BY `id` DESC'
);

$search    = isset($_GET['search']) ? $_GET['search'] : '' ;
$searchSql = '';

$sort      = isset($_GET['sort']);
$sortKey   = isset($sort) && in_array($sort, array_keys($sorts)) ? $sort : 1 ;
$orderSql  = $sorts[$sortKey];

if (!empty($search)) {
	$searchSqlSafe  = cleanSql($search, $conn);
	$searchHtmlSafe = cleanHtml($search);
	$searchSql      = " WHERE `name` LIKE '%{$searchSqlSafe}%' ";
}

$countQuery = "SELECT `id` FROM `trade_pokemon` {$searchSql}";
$numRows    = numRows($countQuery, $conn);
$pagination = new Pagination($numRows);

if (!empty($_GET['a'])) {
	$pagination->addQueryStringVar('a', $_GET['a']);
}

if (!empty($search)) {
	$pagination->addQueryStringVar('search', $_GET['search']);
}


$query = "SELECT * FROM `trade_pokemon` {$searchSql} {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}";




echo '
	<h2 class="text-center">'.$lang['trade_vuft_00'].'</h2>
	<form method="get" action="" style="text-align: center; margin: 20px 0px;">
		<input type="hidden" name="a" value="'.cleanHtml($_GET['a']).'" />
		<input type="hidden" name="page" value="'.cleanHtml(isset($_GET['page'])).'" />
		'.$lang['trade_vuft_01'].' <input type="text" name="search" value="'.isset($searchHtmlSafe).'" /> <input type="submit" class="smallbutton" value="'.$lang['trade_vuft_02'].'" />
	</form>
';

if (numRows($query, $conn) == 0) {
	echo '<div class="info">'.$lang['trade_vuft_03'].'</div>';
} else {

	$qs = '';

	if (!empty($search)) {
		$qs .= '&amp;search=' . urlencode($search);
	}

	if (!empty($_GET['page'])) {
		$qs .= '&amp;page=' . (int) $_GET['page'];
	}

	if (!empty($_GET['a'])) {
		$qs .= '&amp;a=' . urlencode($_GET['a']);
	}

	$nameOrder = $_GET['sort'] == 1 ? 2 : 1 ;
	$expOrder  = $_GET['sort'] == 4 ? 3 : 4 ;
	$idOrder   = $_GET['sort'] == 5 ? 6 : 5 ;

	echo '
			<table class="pretty-table" style="width:99%">
			<tr>
				<th><a href="?'.$qs.'&amp;sort='.$idOrder.'">'.$lang['trade_vuft_04'].'</a></th>
				<th><a href="?'.$qs.'&amp;sort='.$nameOrder.'">'.$lang['trade_vuft_05'].'</a></th>
				<th><a href="?'.$qs.'&amp;sort='.$expOrder.'">'.$lang['trade_vuft_07'].'</a></th>
				<th>'.$lang['trade_vuft_08'].'</th>
				<th>'.$lang['trade_vuft_09'].'</th>
				<th>'.$lang['trade_vuft_10'].'</th>
			</tr>
	';
$result = $conn->query($query);
	while ($pokemon = $result->fetch_assoc()) {
		$query2 = "SELECT * FROM `users` WHERE `id`='{$pokemon['uid']}'";
		$urow = fetchAssoc($query2, $conn);
		
		echo '

			<tr>
				<td rowspan="3">'.number_format($pokemon['id']).'</td>
				<td rowspan="3"><img style="width:60px;" src="images/pokemon/'.$pokemon['name'].'.png" /><br />
				'.$pokemon['name'].'</td>
				<td>'.number_format($pokemon['exp']).'Xp</td>
				<td rowspan="3">
					'.$pokemon['move1'].'<br />
					'.$pokemon['move2'].'<br />
					'.$pokemon['move3'].'<br />
					'.$pokemon['move4'].'
				</td>
				<td rowspan="3"><a href="profile.php?id='.$pokemon['uid'].'">'.cleanHtml($urow['username']).'</a></td>
				<td rowspan="3">
					<a href="?a=mao&id='.$pokemon['id'].'">'.$lang['trade_vuft_11'].'</a>
				</td>
			</tr>
			<tr>
			<th>'.$lang['trade_vuft_06'].'</th>
			</tr>
			<tr>
			<td>'.number_format($pokemon['level']).'</td>
			</tr>
		';
	}
	echo '
		</table>
	';
	$pagination->echoPagination();
}
?>
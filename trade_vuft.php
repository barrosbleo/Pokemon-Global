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
	$searchSqlSafe  = cleanSql($search);
	$searchHtmlSafe = cleanHtml($search);
	$searchSql      = " WHERE `name` LIKE '%{$searchSqlSafe}%' ";
}

$countQuery = mysql_query("SELECT `id` FROM `trade_pokemon` {$searchSql}");
$numRows    = mysql_num_rows($countQuery);
$pagination = new Pagination($numRows);

if (!empty($_GET['a'])) {
	$pagination->addQueryStringVar('a', $_GET['a']);
}

if (!empty($search)) {
	$pagination->addQueryStringVar('search', $_GET['search']);
}


$query = mysql_query("SELECT * FROM `trade_pokemon` {$searchSql} {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}");




echo '
	<h2 class="text-center">'.$lang['trade_vuft_00'].'</h2>
	<form method="get" action="" style="text-align: center; margin: 20px 0px;">
		<input type="hidden" name="a" value="'.cleanHtml($_GET['a']).'" />
		<input type="hidden" name="page" value="'.cleanHtml(isset($_GET['page'])).'" />
		'.$lang['trade_vuft_01'].' <input type="text" name="search" value="'.isset($searchHtmlSafe).'" /> <input type="submit" value="'.$lang['trade_vuft_02'].'" />
	</form>
';

if (mysql_num_rows($query) == 0) {
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
		<table class="pretty-table">
			<tr>
				<th><a href="?'.$qs.'&amp;sort='.$idOrder.'">'.$lang['trade_vuft_04'].'</a></th>
				<th><a href="?'.$qs.'&amp;sort='.$nameOrder.'">'.$lang['trade_vuft_05'].'</a></th>
				<th>'.$lang['trade_vuft_06'].'</th>
				<th><a href="?'.$qs.'&amp;sort='.$expOrder.'">'.$lang['trade_vuft_07'].'</a></th>
				<th>'.$lang['trade_vuft_08'].'</th>
				<th>'.$lang['trade_vuft_09'].'</th>
				<th>'.$lang['trade_vuft_10'].'</th>
			</tr>
	';
	while ($pokemon = mysql_fetch_assoc($query)) {
		$query2 = mysql_query("SELECT * FROM `users` WHERE `id`='{$pokemon['uid']}'");
		$urow = mysql_fetch_assoc($query2);
		
		echo '
			<tr>
				<td>'.number_format($pokemon['id']).'</td>
				<td><img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
				'.$pokemon['name'].'</td>
				<td>'.number_format($pokemon['level']).'</td>
				<td>'.number_format($pokemon['exp']).'</td>
				<td>
					'.$pokemon['move1'].'<br />
					'.$pokemon['move2'].'<br />
					'.$pokemon['move3'].'<br />
					'.$pokemon['move4'].'
				</td>
				<td><a href="profile.php?id='.$pokemon['uid'].'">'.cleanHtml($urow['username']).'</a></td>
				<td>
					<a href="?a=mao&id='.$pokemon['id'].'">'.$lang['trade_vuft_11'].'</a>
				</td>
			</tr>
		';
	}
	echo '
		</table>
	';
	$pagination->echoPagination();
}
?>
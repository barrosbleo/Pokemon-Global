<?php
$exp = explode('/', $_SERVER["SCRIPT_NAME"]);
$filename = end($exp);
if ($filename != 'trade.php') { die(); }


$query = mysql_query("SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}'");
$myTeam = mysql_fetch_assoc($query);
$nonInTeamSql = " `id` NOT IN ('".implode("', '", $myTeam)."') ";

$sorts = array
(
    1 => ' ORDER BY `name` ASC',
    2 => ' ORDER BY `name` DESC',
    3 => ' ORDER BY `exp` ASC',
    4 => ' ORDER BY `exp` DESC'
);
$sort      = isset($_GET['sort']);
$sortKey   = isset($sort) && in_array($sort, array_keys($sorts)) ? $sort : 1 ;
$orderSql  = $sorts[$sortKey];

if (!isset($_GET['all'])) {
	$search    = isset($_GET['search']) ? $_GET['search'] : '' ;
	$searchSql = '';
	
	
	if (!empty($search)) {
		$searchSqlSafe  = cleanSql($search);
		$searchHtmlSafe = cleanHtml($search);
		$searchSql      = " AND `name` LIKE '%{$searchSqlSafe}%' ";
	}
	
	$query = mysql_query("SELECT * FROM `user_pokemon` WHERE {$nonInTeamSql} {$searchSql} AND `uid`='{$uid}' {$orderSql}");
	$numRows = mysql_num_rows($query);
	
	$pagination = new Pagination($numRows);
	
	if (!empty($_GET['a'])) {
		$pagination->addQueryStringVar('a', $_GET['a']);
	}
	
	if (!empty($search)) {
		$pagination->addQueryStringVar('search', $_GET['search']);
	}
	
	
	$query = mysql_query("SELECT * FROM `user_pokemon` WHERE {$nonInTeamSql} {$searchSql} AND `uid`='{$uid}' {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}");
} else {
$query = mysql_query("SELECT * FROM `user_pokemon` WHERE {$nonInTeamSql} AND `uid`='{$uid}' {$orderSql}");
}

echo '
	<h2 class="text-center">'.$lang['trade_puft_00'].'</h2>
';

if (!isset($_GET['all'])) {
	echo '
		<form method="get" action="" style="text-align: center; margin: 20px 0px;">
			<input type="hidden" name="a" value="'.cleanHtml($_GET['a']).'" />
			<input type="hidden" name="page" value="'.cleanHtml(isset($_GET['page'])).'" />
			'.$lang['trade_puft_01'].' <input type="text" name="search" value="'.isset($searchHtmlSafe).'" /> <input type="submit" value="'.$lang['trade_puft_02'].'" />
		</form>
	';
}


if (mysql_num_rows($query) == 0) {
	echo '<div class="info">'.$lang['trade_puft_03'].'</div>';
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
	
	if (isset($_GET['all'])) {
		$qs .= '&amp;all';
	}
	
	$nameOrder = $_GET['sort'] == 1 ? 2 : 1 ;
	$expOrder  = $_GET['sort'] == 4 ? 3 : 4 ;
	
	echo '
		<form action="?a=puft_process" method="post">
		<table class="pretty-table">
			<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><a href="?'.$qs.'&amp;sort='.$nameOrder.'">'.$lang['trade_puft_04'].'</a></th>
				<th>'.$lang['trade_puft_05'].'</th>
				<th><a href="?'.$qs.'&amp;sort='.$expOrder.'">'.$lang['trade_puft_06'].'</a></th>
				<th>'.$lang['trade_puft_07'].'</th>
			</tr>
	';
	while ($pokemon = mysql_fetch_assoc($query)) {
		echo '
			<tr>
				<td><input type="checkbox" name="pokemon[]" value="'.$pokemon['id'].'" /></td>
				<td><img src="images/pokemon/'.$pokemon['name'].'.png" /></td>
				<td>'.$pokemon['name'].'</td>
				<td>'.number_format($pokemon['level']).'</td>
				<td>'.number_format($pokemon['exp']).'</td>
				<td>
					'.$pokemon['move1'].'<br />
					'.$pokemon['move2'].'<br />
					'.$pokemon['move3'].'<br />
					'.$pokemon['move4'].'
				</td>
			</tr>
		';
	}
	echo '
			<tr>
				<td colspan="6"><input type="submit" value="'.$lang['trade_puft_08'].'" /></td>
			</tr>
		</table>
		</form>
	';
	
	if (!isset($_GET['all'])) {
		$pagination->echoPagination();
	
		echo '
			<div style="text-align: center; margin: 80px 0 10px 0;">
				<a href="trade.php?a=puft&all" style="font-size: smaller;">
					'.$lang['trade_puft_09'].'
				</a>
			</div>
		';
	}

}

?>
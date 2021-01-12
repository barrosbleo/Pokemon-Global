<?php
include('modules/lib.php');
require_once 'pagination.class.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$gid   = (int) (isset($_GET['id']) ? $_GET['id'] : $_SESSION['userid']);
$query = mysql_query("SELECT `username` FROM `users` WHERE `id`='{$gid}' LIMIT 1");

if(mysql_num_rows($query) == 0) {
	redirect('view_box.php');
}

$boxUsername = mysql_fetch_assoc($query);
$boxUsername = $boxUsername['username'];

include '_header.php';

$headerText = isset($_GET['id']) ? $boxUsername.$lang['view_box_title'] : $lang['view_box_title_1'] ;
printHeader($headerText);

$sorts = array
(
    1 => ' ORDER BY `name` ASC',
    2 => ' ORDER BY `name` DESC',
    3 => ' ORDER BY `exp` ASC',
    4 => ' ORDER BY `exp` DESC'
);

$search    = isset($_GET['search']) ? $_GET['search'] : '' ;

$sort      = isset($_GET['sort']);
$sortKey   = isset($sort) && in_array($sort, array_keys($sorts)) ? $sort : 1 ;
$orderSql  = $sorts[$sortKey];

$searchSql = '';

if (!empty($search)) {
	$searchSqlSafe  = cleanSql($search);
	$searchHtmlSafe = cleanHtml($search);
	$searchSql      = " AND `name` LIKE '%{$searchSqlSafe}%' ";
}

$countQuery = mysql_query("SELECT `id` FROM `user_pokemon` WHERE `uid`='{$gid}' {$searchSql}");
$numRows    = mysql_num_rows($countQuery);

$pagination = new Pagination($numRows);

if (!empty($search)) {
	$pagination->addQueryStringVar('search', $search);
}

if (isset($_GET['id'])) {
	$pagination->addQueryStringVar('id', (int) $_GET['id']);
}

if ($sortKey != 1) {
	$pagination->addQueryStringVar('sort', $sortKey);
}

$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `uid`='{$gid}' {$searchSql} {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}");

	

echo '	
	<form method="get" style="text-align: center; margin: 20px 0px;">
';
if (isset($_GET['id'])) {
	$uuid = (int) $_GET['id'];
	echo '<input type="hidden" name="id" value="'.$uuid.'" />';
}
echo '
		'.$lang['view_box_00'].' <input type="text" name="search" value="'.isset($searchHtmlSafe).'" />
		<input type="submit" value="'.$lang['view_box_01'].'" />
	</form>
';

if (mysql_num_rows($query) == 0) {
	echo '<div class="info">'.$lang['view_box_02'].'</div>';
} else {
	$qs = '';
	
	if (!empty($search)) {
		$qs .= '&amp;search=' . urlencode($search);
	}
	
	if (!empty($_GET['page'])) {
		$qs .= '&amp;page=' . (int) $_GET['page'];
	}
	
	if (isset($_GET['id'])) {
		$qs .= '&amp;id=' . (int) $_GET['id'];
	}
	
	$nameOrder = isset($_GET['sort']) == 1 ? 2 : 1 ;
	$expOrder  = isset($_GET['sort']) == 4 ? 3 : 4 ;
	
	echo '		
		<table class="pretty-table">
			<tr>
				<th width=25%><a href="view_box.php?sort='.$nameOrder.'">'.$lang['view_box_03'].'</a></th>
				<th  width=25%>'.$lang['view_box_04'].'</th>
				<th  width=25%><a href="view_box.php?sort='.$expOrder.'">'.$lang['view_box_05'].'</a></th>
				<th  width=25%>'.$lang['view_box_06'].'</th>
				
	';
	
	echo isset($_GET['id']) ? '' : '<th>'.$lang['view_box_07'].'</th>' ;
	
	echo '
			</tr>
	';

	$teamIds = getUserTeamIds($uid);
	$genders = array('1' => 'Male', '2' => 'Female', '3' => 'Genderless');
	while ($pokemon = mysql_fetch_assoc($query)) {

		if (!isset($_GET['id'])) {
			if (in_array($pokemon['id'], $teamIds)) {
				$tradeHtml   = '<strike>'.$lang['view_box_08'].'</strike><br />';
				$sellHtml    = '<strike>'.$lang['view_box_09'].'</strike><br />';
				$teamHtml    = '<strike>'.$lang['view_box_10'].'</strike><br />';
				$releaseHtml = '<strike>'.$lang['view_box_11'].'</strike><br />';
				$auctionHtml = '<strike>'.$lang['view_box_12'].'</strike><br />';
			} else {
				$tradeHtml   = '<a href="trade.php?a=puft_process&amp;id='.$pokemon['id'].'">'.$lang['view_box_13'].'</a><br />';
				$sellHtml    = '<a href="sell_pokemon.php?p=sell2&amp;id='.$pokemon['id'].'">'.$lang['view_box_14'].'</a><br />';
				$teamHtml    = '<a href="change_team.php?id='.$pokemon['id'].'">'.$lang['view_box_15'].'</a><br />';
				$releaseHtml = '<a href="release.php?id='.$pokemon['id'].'">'.$lang['view_box_16'].'</a><br />';
				$auctionHtml = '<a href="auction_start.php?id='.$pokemon['id'].'">'.$lang['view_box_17'].'</a><br />';
			}
		}
		
		$genderLine = '<img src="images/gender/'.$pokemon['gender'].'.png" alt="'.$genders[$pokemon['gender']].'" title="'.$genders[$pokemon['gender']].'">';
		
		echo '
			<tr>
				<td>
					<a href="pinfo.php?id='.$pokemon['id'].'"><img src="images/pokemon/' . $pokemon['name'] . '.png" alt="' . $pokemon['name'] . '" /></a><br />
					' . $pokemon['name'] . '&nbsp;'.$genderLine.'
				</td>
				<td>' . number_format($pokemon['level']) . '</td>
				<td>' . number_format($pokemon['exp']) . '</td>
				<td>	
					' . $pokemon['move1'] . '<br />
					' . $pokemon['move2'] . '<br />
					' . $pokemon['move3'] . '<br />
					' . $pokemon['move4'] . '<br />
				</td>
		';
		
		if (!isset($_GET['id'])) {
			echo '
				<td>
					<a href="evolve.php?id='.$pokemon['id'].'">'.$lang['view_box_18'].'</a><br />
					<a href="change_attacks.php?id='.$pokemon['id'].'">'.$lang['view_box_19'].'</a><br /><br />
					'.$teamHtml.'
					'.$tradeHtml.'
					'.$sellHtml.'
					'.$releaseHtml.'
					'.$auctionHtml.'
				</td>
			';
		}
		
		echo '
			</tr>
		';
	}
	echo '</table>';

	$pagination->echoPagination();
}


include '_footer.php';
?>
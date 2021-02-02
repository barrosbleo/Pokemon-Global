<?php
include('modules/lib.php');
require_once 'pagination.class.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$gid   = (int) (isset($_GET['id']) ? $_GET['id'] : $_SESSION['userid']);
$query = "SELECT `username` FROM `users` WHERE `id`='{$gid}' LIMIT 1";

if(numRows($query, $conn) == 0) {
	redirect('view_box.php');
}

$boxUsername = fetchAssoc($query, $conn);
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

$sort      = $_GET['sort'];
$sortKey   = isset($sort) && in_array($sort, array_keys($sorts)) ? $sort : 1 ;
$orderSql  = $sorts[$sortKey];

$searchSql = '';

if (!empty($search)) {
	$searchSqlSafe  = cleanSql($search, $conn);
	$searchHtmlSafe = cleanHtml($search);
	$searchSql      = " AND `name` LIKE '%{$searchSqlSafe}%' ";
}

$countQuery = "SELECT `id` FROM `user_pokemon` WHERE `uid`='{$gid}' {$searchSql}";
$numRows    = numRows($countQuery, $conn);

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

$query = "SELECT * FROM `user_pokemon` WHERE `uid`='{$gid}' {$searchSql} {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}";

	

echo '	
	<form method="get" style="text-align: center; margin: 20px 0px;">
';
if (isset($_GET['id'])) {
	$uuid = (int) $_GET['id'];
	echo '<input type="hidden" name="id" value="'.$uuid.'" />';
}
echo '
		'.$lang['view_box_00'].' <input type="text" name="search" value="'.isset($searchHtmlSafe).'" />
		<input type="submit" class="smallbutton" value="'.$lang['view_box_01'].'" />
	</form>
';

if (numRows($query, $conn) == 0) {
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
	
	$nameOrder = $_GET['sort'] == 1 ? 2 : 1 ;
	$expOrder  = $_GET['sort'] == 4 ? 3 : 4 ;
	
	echo '		
		<table class="pretty-table">
			<tr>
				<th width=25%><a href="view_box.php?sort='.$nameOrder.'">'.$lang['view_box_03'].'</a></th>
				<th  width=25%><a href="view_box.php?sort='.$expOrder.'">'.$lang['view_box_05'].'</a></th>
	';
	
	echo isset($_GET['id']) ? '' : '<th>'.$lang['view_box_07'].'</th>' ;
	
	echo '
			</tr>
	';

	$teamIds = getUserTeamIds($uid, $conn);
	$genders = array('1' => 'Male', '2' => 'Female', '3' => 'Genderless');
	$result = $conn->query($query);
	while ($pokemon = $result->fetch_assoc()) {

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
			<td rowspan="5">
				<a href="pinfo.php?id='.$pokemon['id'].'"><img src="images/pokemon/' . $pokemon['name'] . '.png" alt="' . $pokemon['name'] . '" /></a><br />
				'.$pokemon['name'].'&nbsp;'.$genderLine.'
			</td>
			<td>'.number_format($pokemon['exp']).'Xp</td>
		';
		if (!isset($_GET['id'])) {
			echo '
				<td rowspan="5">
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
		echo'
		</tr>
		<tr>
		<th  width=25%>'.$lang['view_box_04'].'</th>
		</tr>
		<tr>
		<td>'.number_format($pokemon['level']).'</td>
		</tr>
		<tr>
		<th  width=25%>'.$lang['view_box_06'].'</th>
		</tr>
		<tr>
		<td>	
			'.$pokemon['move1'].'<br />
			'.$pokemon['move2'].'<br />
			'.$pokemon['move3'].'<br />
			'.$pokemon['move4'].'<br />
		</td>
		</tr>
			';
	}
	echo '</table>';

	$pagination->echoPagination();
}


include '_footer.php';
?>
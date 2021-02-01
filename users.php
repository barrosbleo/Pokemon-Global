<?php
include('modules/lib.php');
require_once 'pagination.class.php';

if (!isLoggedIn()) {
	redirect('index.php');
}

$sorts = array
(
    1 => ' ORDER BY `id` ASC',
    2 => ' ORDER BY `id` DESC',
    3 => ' ORDER BY `username` ASC',
    4 => ' ORDER BY `username` DESC',
    5 => ' ORDER BY `lastseen` ASC',
    6 => ' ORDER BY `lastseen` DESC'
);

$search    = isset($_GET['search']) ? $_GET['search'] : '' ;
$searchSql = '';

$sort      = isset($_GET['sort']);
$sortKey   = isset($sort) && in_array($sort, array_keys($sorts)) ? $sort : 1 ;
$orderSql  = $sorts[$sortKey];

if (!empty($search)) {
	$searchSqlSafe  = cleanSql($search, $conn);
	$searchHtmlSafe = cleanHtml($search);
	$searchSql      = " WHERE `username` LIKE '%{$searchSqlSafe}%' ";
}

$countQuery = "SELECT `id` FROM `users` {$searchSql}";
$numRows    = numRows($countQuery, $conn);
$pagination = new Pagination($numRows);

if (!empty($search)) {
	$pagination->addQueryStringVar('search', $_GET['search']);
}
include '_header.php';
printHeader($lang['users_title']);

$query = "SELECT * FROM `users` {$searchSql} {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}";



	$qs = '';
	if (!empty($search)) {
		$qs .= '&amp;search=' . urlencode($search);
	}
	
	$usernameOrder  = isset($_GET['sort']) == 3 ? 5 : 3 ;
	$lastSeenOrder  = isset($_GET['sort']) == 6 ? 5 : 6 ;
	$idOrder        = isset($_GET['sort']) == 2 ? 1 : 2 ;

echo '
		<form method="get" action="" style="text-align: center; margin: 20px 0px;">
			'.$lang['users_00'].' <input type="text" name="search" value="'.isset($searchHtmlSafe).'" /> <input type="submit" class="smallbutton" value="'.$lang['users_01'].'" />
		</form>
';

if (numRows($query, $conn) == 0) {
	echo '<div class="info">'.$lang['users_02'].'</div>';
} else {
	echo '		
	<div class="franks">
		<table class="pretty-table members">
			<tr>
				<th><a href="?'.$qs.'&amp;sort='.$idOrder.'">'.$lang['users_03'].'</a></th>
				<th><a href="?'.$qs.'&amp;sort='.$usernameOrder.'">'.$lang['users_04'].'</a></th>
				<th><a href="?'.$qs.'&amp;sort='.$lastSeenOrder.'">'.$lang['users_05'].'</a></th>
				<th>'.$lang['users_06'].'</th>
			</tr>
	';
$result = $conn->query($query);
	while($row = $result->fetch_assoc())
	{
		$row = cleanHtml($row);
		$banText = $row['banned'] == 1 ? '&nbsp;[<span style="color: #FF0000; font-size: 8pt;">'.$lang['users_07'].'</span>]' : '' ;
		$lastseen = $row['lastseen'] == 0 ? 'Never' : secondsToTimeSince(time()-$row['lastseen']) ;
		echo '
			<tr>
				<td>'.$row['id'].'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.$row['username'].'</a>'.$banText.'</td>
				<td>'.$lastseen.'</td>
				<td><a href="battle_user.php?id='.$row['id'].'">'.$lang['users_08'].'</a></td>
			</tr>
		';
	}
	
	echo '</table></div>';
	
	$pagination->echoPagination();
}


include '_footer.php';
?>
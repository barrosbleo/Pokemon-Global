<?php
include('modules/lib.php');
require 'banned.php'; 

if (!isLoggedIn()) {
redirect('login.php');
}

$uid = (int) $_GET['id'];

if ($uid == $_SESSION['userid']) {
	include '_header.php';
	printHeader($lang['battle_u_text']);
	echo '<div class="error">'.$lang['battle_u_00'].'</div>';
	include '_footer.php';
	die();
}
/*
$bannedQuery = mysql_query("SELECT `banned` FROM `users` WHERE `banned` = '1'");
$banned = mysql_fetch_row($bannedQuery);

if ($banned->banned == 1) {
	include '_header.php';
	printHeader('ERROR');
	echo '<div class="error">'.$lang['battle_u_01'].'</div>';
	include '_footer.php';
	die();
}*/

$userTeam = getUserTeamIds($uid, $conn);

if ($userTeam == false) {
	die();
}

$query = "SELECT `username` FROM `users` WHERE `id`='{$uid}'";
$row = fetchAssoc($query, $conn);
$username = $row['username'];

$x = 0;
for ($i=1; $i<=6; $i++) {
	$pid = $userTeam['poke'.$i];

	if ($pid==0) { continue; }
	
	$pokeRow = getUserPokemon($pid, $conn);

	$_SESSION['battle']['opponent'][$x]          = $pokeRow;
	$_SESSION['battle']['opponent'][$x]['maxhp'] = maxHp($pokeRow['name'], $pokeRow['level'], $conn);
	$_SESSION['battle']['opponent'][$x]['hp']    = maxHp($pokeRow['name'], $pokeRow['level'], $conn);
	$x++;
}
$_SESSION['battle']['captcha'] = time();
$_SESSION['battle']['onum'] = 0;
$_SESSION['battle']['rebattlelink'] = '<a href="battle_user.php?id='.$uid.'">'.$lang['battle_u_02'].' '.cleanHtml($username).'</a>';
$_SESSION['battle']['uid'] = $uid;

redirect('battle.php');
?>
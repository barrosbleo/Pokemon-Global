<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('../index.php');
}

include '../_header.php';

printHeader('Clans');
?>
	<center>
		<img border="0" src="">
		<h1><a href="/clans/createclan.php">Create a Clan</a></h1>
	</center>
<?

$query = mysql_query("
	SELECT
		`clans`.`id` AS `clan_id`,
		`clans`.`name` AS `clan_name`,
		`clans`.`owner` AS `clan_owner`,
		`clans`.`exp` AS `clan_exp`,
       	(SELECT COUNT(`id`) FROM `users` WHERE `clan`=`clans`.`id`) AS `num_members`,
		(SELECT SUM(`clanxp`) FROM `users` WHERE `clan`=`clans`.`id`) AS `total_xp`,
		(SELECT `id` FROM `users` WHERE `username`=`clans`.`owner` AND `clan`=`clans`.`id`) AS `owner_uid`
	FROM `clans`
	ORDER  BY `clan_exp` DESC 
");

echo '
	<table style="margin: 10px auto;" class="pretty-table">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Owner</th>
			<th>EXP</th>
			<th>Members</th>
		</tr>
';


while($result = mysql_fetch_assoc($query)) {
	$result = cleanHtml($result);

	echo '
		<tr>
			<td>' . $result['clan_id'] . '</td>
			<td><a href="vclan.php?id=' . $result['clan_id'] . '">' . $result['clan_name'] . '</a></td>
			<td>
				<a href="../profile.php?id=' . $result['owner_uid'] . '">
					' . $result['clan_owner'] . '
				</a>
			</td>
			<td>' . number_format($result['clan_exp']) . '</td>
			<td>'  .$result['num_members'] . '</td>
		</tr>
	';
}

echo '</table>';

include '../_footer.php';
?>
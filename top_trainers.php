<?php
include('modules/lib.php');

if (!isLoggedIn()) {
die();
}

include '_header.php';
printHeader($lang['top_trainers_title']);

echo '
	<table class="pretty-table">
		<tr>
			<th>#</th>
			<th>'.$lang['top_trainers_00'].'</th>
			<th>'.$lang['top_trainers_01'].'</th>
		</tr>
';
	
$query = mysql_query("
	SELECT
		`users`.`id`,
		`users`.`username`,
		SUM( `user_pokemon`.`exp` ) AS `total_exp` 
              
	FROM
		`user_pokemon`,
		`users`
                
	WHERE
		`users`.`id` = `user_pokemon`.`uid` AND
		`users`.`admin` = '0' AND `users`.`banned` = '0'
	GROUP BY `user_pokemon`.`uid`
	ORDER BY `total_exp` DESC
	LIMIT 20
");
$i=1;
while ($row = mysql_fetch_assoc($query)) {
	echo '
		<tr>
			<td >'.$i++.'</td>
			<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
			<td>'.number_format($row['total_exp']).'</td>
		</tr>
               
	';
}
echo '</table>';




echo '</div>';


include '_footer.php';
?>
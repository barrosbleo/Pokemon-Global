<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '_header.php';
printHeader($lang['membersarea_title']);


$query = "SELECT * FROM users WHERE id = '$uid'";
$info = fetchArray($query, 2, $conn);
$ck = $info['username'];
logs($uid, "$ck has accessed membersarea!");//not working i guess



$champUid = getConfigValue('champion_uid', $conn);

$query = "SELECT * FROM `users` WHERE `id`='{$champUid}'";
$champRow = fetchAssoc($query, $conn);

// stop xss
$champRow = cleanHtml($champRow);

$avatar = $champRow['avatar'];

if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
	$avatar = 'https://pkmglobal.online/'.$avatar;
	
	if (!filter_var($avatar, FILTER_VALIDATE_URL) || empty($champRow['avatar'])) {
		$avatar = 'https://pkmglobal.online/images/trainers/032.png';
	}
}

$promoName = getConfigValue('promo_pokemon_name', $conn);
?>

<?php
echo '
    <table class="pretty-table">
		<tr>
            <th>'.$lang['membersarea_currentpromo'].'</th>
			<th>'.$lang['membersarea_champion'].'</th>
		</tr>
		<tr>
            <td>
                <a href="promo.php">
                    <img src="images/pokemon/'.$promoName.'.png" alt="'.$promoName.'" /><br />
                    '.$promoName.'
                </a>
            </td>
			<td>
				'.$lang['membersarea_beat_champion'].'!<br /><br />
				
				<a href="profile.php?id='.$champRow['id'].'">
					<img src="'.$avatar.'"><br />
					'.$champRow['username'].'
				</a><br /><br />
				
				<a href="battle_user.php?id='.$champRow['id'].'">
					'.$lang['membersarea_chal_champion'].'
				</a>
			</td>
		</tr>
	</table>
';
$queryNews = "SELECT * FROM news ORDER BY `id` DESC LIMIT 5";
$result = $conn->query($queryNews);
while($fetch = $result->fetch_array(MYSQLI_ASSOC)){

	
echo '
	<table class="pretty-table news">
		<tr>
			<th>'.$fetch['title'].'</th>
		</tr>
		<tr>
			<td>
				<center>'.nl2br($fetch['news']).'</center>
			</td>
		</tr>
		<tr>
			<th>
				<center><b>By : '.$fetch['bywho'].' [<span style="color: #FFFF00;">Admin</span>]</b></center>
			</th>
		</tr>
	</table>
';
}
?>
			
<?php

include '_footer.php';
?>
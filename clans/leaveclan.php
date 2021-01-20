<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '../_header.php';
printHeader('Leave Clan');

$uid = (int) $_SESSION['userid'];

$query = "SELECT * FROM `users` WHERE `id`='{$uid}'";
$userRow = fetchAssoc($query, $conn);

$clanId = (int) $userRow['clan'];
$query = "SELECT * FROM `clans` WHERE `id`='{$clanId}'";
$clanRow = fetchAssoc($query, $conn);

if ($userRow['clan'] == '' || $userRow['clan'] == '0') {
	echo 'You are not in a clan.';
} else {
	if(isset($_SESSION['leave_clan_token']) && $_SESSION['leave_clan_token'] == $_GET['token']) {
		$clanId = (int) $clanRow['id'];

		if($clanRow['owner'] == $userRow['username']) {  
			echo 'You have closed your clan!';
			$conn->query("UPDATE `users` SET `clan`='0', `clanxp`='0' WHERE `clan`='{$clanId}'");
			$conn->query("DELETE FROM `clans` WHERE `id`= '{$clanId}' LIMIT 1");
    		} else {
        		echo 'You have left the clan.';
        		$conn->query("UPDATE `users` SET `clan`='0', `clanxp`='0' WHERE `id`='{$uid}'");	
		}
	} else {
		if ($clanRow['owner'] == $userRow['username']) {
			echo '
				Are you sure you want to close this clan?<br />
				This will force all of the members of this clan to leave!
			';
		} else {
			echo 'Are you sure you want to leave this clan?';
		}
	
		$token = md5( rand(100000, 999999) );
		$_SESSION['leave_clan_token'] = $token;
		echo '<br /><br /><a href="/clans/leaveclan.php?token='.$token.'">Yes</a> - <a href="index.php">No</a>';
	}
}

include '../_footer.php';
?>
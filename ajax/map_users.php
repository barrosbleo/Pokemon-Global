<?php
include('../modules/lib.php');

$uid = (int) $_SESSION['userid'];
$map = (int) $_GET['map'];

$time = time();
$tenMinsAgo = $time - (60*10);

$usersQuery = "SELECT * FROM `users` WHERE `map_num`='{$map}' AND `map_lastseen`>='{$tenMinsAgo}'";
$usersArray = array();
$result = $conn->query($usersQuery);
$i = 0;
while ($user = $result->fetch_assoc()) {
	if ($user['id'] == $uid) {
		continue;
	}
	$usersArray[$i]['username'] = cleanHtml($user['username']);
	$usersArray[$i]['sprite']   = (int) $user['map_sprite'];
	$usersArray[$i]['id'] = (int) $user['id'];
	$usersArray[$i]['x']  = (int) $user['map_x'];
	$usersArray[$i]['y']  = (int) $user['map_y'];
	$i++;
}

echo json_encode($usersArray);

?>
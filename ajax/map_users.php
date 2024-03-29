<?php
include('../modules/lib.php');

$uid = (int) $_SESSION['userid'];
$map = (int) base64_decode($_GET['map']);

$time = time();
$minsAgo = $time - (60*1);//60 second * 1 minute

$usersQuery = "SELECT * FROM `users` WHERE `map_num`='{$map}' AND `map_lastseen`>='{$minsAgo}'";
$usersArray = array();
$result = $conn->query($usersQuery);
$i = 0;
while ($user = $result->fetch_assoc()) {
	if ($user['id'] == $uid) {
		continue;
	}
	$usersArray[$i]['username'] = cleanHtml($user['username']);
	$usersArray[$i]['sprite']   = $user['map_sprite'];
	$usersArray[$i]['id'] = (int) $user['id'];
	$usersArray[$i]['x']  = (int) $user['map_x'];
	$usersArray[$i]['y']  = (int) $user['map_y'];
	$i++;
}

echo json_encode($usersArray);

?>
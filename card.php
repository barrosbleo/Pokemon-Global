<?php
include('modules/lib.php');
//include('config.php');

$uid = (int) $_GET['id'];
$query = "SELECT * FROM `users` WHERE `id`='{$uid}'";
if (numRows($query, $conn) == 0) { die(); }
$user_row = fetchAssoc($query, $conn);

$card = imagecreatefrompng('card_blank.png');


// add username and id
$orange = imagecolorallocate($card, 255, 165, 0);
$start_x = 235;
$start_y = 32;
$font_file = 'BRUSHSCI.ttf';
$text = $user_row['username'] . ' #' . $user_row['id'];
imagettftext($card, 18, 0, $start_x, $start_y, $orange, $font_file, $text);
die();

$positions = array(
	'1' => array('x'=>'16', 'y'=>'81'),
	'2' => array('x'=>'120', 'y'=>'81'),
	'3' => array('x'=>'226', 'y'=>'81'),
	'4' => array('x'=>'12', 'y'=>'187'),
	'5' => array('x'=>'120', 'y'=>'187'),
	'6' => array('x'=>'226', 'y'=>'187'),
);

for ($i=1; $i<=6; $i++) {
	$pid = $user_row['poke'.$i];
	$query = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}'";
	if (numRows($query, $conn) == 0) { continue; }
	$poke_row = fetchAssoc($query, $conn);
	
	$filename = 'images/pokemon/'.$poke_row['name'].'.png';
	if (!file_exists($filename)) { continue; }
	
	list($width, $height) = getimagesize($filename);
	if ($width > 95 || $height > 95) {
		$newwidth = 95;
		$newheight = 95;
		$offset_x = 0;
		$offset_y = 0;
	} else {
		$newwidth = $width;
		$newheight = $height;
		$offset_x = (95 - $width) / 2;
		$offset_y = (95 - $height) / 2;
	}
	
	$source = imagecreatefromstring(file_get_contents($filename));
	
	imagecopyresized($card, $source, $positions[$i]['x'] + $offset_x, $positions[$i]['y'] + $offset_y, 0, 0, $newwidth, $newheight, $width, $height);
}
$avatar_img = $user_row['avatar'];
$avatar = imagecreatefrompng($avatar_img);
list($width, $height) = getimagesize($avatar_img);
imagecopy($card, $avatar, 340 , 130 , 0, 0, $width, $height);

header('Content-Type: image/png');
imagepng($card);
imagedestroy($card);
?>

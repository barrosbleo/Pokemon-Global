<?php
include('../modules/lib.php');

$uid = (int) 6;
$map = (int) $_GET['map'];

$pokesQuery = mysql_query("SELECT * FROM `trade_pokemon` WHERE `uid`='{$uid}' ORDER BY `id`");
$pokesArray = array();

$i = 0;
while ($poke = mysql_fetch_assoc($pokesQuery)) {
	$pokesArray[$i]['id'] = $poke['id'];
	$pokesArray[$i]['name']  = $poke['name'];
	$pokesArray[$i]['level'] = $poke['level'];
	$pokesArray[$i]['exp'] = $poke['exp'];
	$pokesArray[$i]['price'] = $poke['price'];
	$i++;
}

echo json_encode($pokesArray);

?>
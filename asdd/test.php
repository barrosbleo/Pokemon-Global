<?php
die();
include('../modules/lib.php');



$query = mysql_query("select * from `moves` WHERE `power` > 0");
$moves = array();
while ($row = mysql_fetch_assoc($query)) {
$moves[$row['type']][] = $row['name'];
}
$moves['Dragon'][] = 'Dragon Rage';
$moves['Dark'] = $moves['Ghost'];
$moves['Steel'] = $moves['Rock'];
// print_r($moves);

$query = mysql_query("select * from `pokemon` WHERE `move1`='Scratch' AND `move2`='Scratch' AND `move3`='Scratch' AND `move4`='Scratch'");

while ($row = mysql_fetch_assoc($query)) {
	if (!empty($row['type1'])) {
		$move1 = $moves[$row['type1']][ array_rand($moves[$row['type1']]) ];
		$move2 = $moves[$row['type1']][ array_rand($moves[$row['type1']]) ];
		$move3 = $moves[$row['type1']][ array_rand($moves[$row['type1']]) ];
		$move4 = $moves[$row['type1']][ array_rand($moves[$row['type1']]) ];
	}
	
	if (!empty($row['type2'])) {
		$move3 = $moves[$row['type2']][ array_rand($moves[$row['type2']]) ];
		$move4 = $moves[$row['type2']][ array_rand($moves[$row['type2']]) ];
	}
	if ($move1!='' && $move2!='' && $move3!='' && $move4!='') {
mysql_query("update `pokemon` set `move1`='{$move1}', `move2`='{$move2}', `move3`='{$move3}', `move4`='{$move4}' WHERE `id`='{$row['id']}';");
	}
}

die();
copy('../images/pokemon/Absol.png', '../images/pokemon/Absol (Mega)).png');

die();
$objects = new RecursiveIteratorIterator( new RecursiveDirectoryIterator('../') );
foreach($objects as $name => $object){
    echo "$name\n";
}


die();
include '../config.php';

$q = mysql_query("select * from `sale_pokemon`");

while ($pokemon2 = mysql_fetch_assoc($q)) {
		$pid = $pokemon2['id'];
		
		$query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `id`='{$pid}'");
			
		$pokemon = mysql_fetch_assoc($query);
		
		mysql_query("DELETE FROM `sale_pokemon` WHERE `id`='{$pid}' LIMIT 1");
		mysql_query("INSERT INTO `user_pokemon` (
			`name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `uid`
			) VALUES (
			'{$pokemon['name']}', '{$pokemon['level']}', '{$pokemon['exp']}', '{$pokemon['move1']}', '{$pokemon['move2']}', '{$pokemon['move3']}', '{$pokemon['move4']}', '{$pokemon['uid']}'
			)
		");
}

$q = mysql_query("select * from `trade_pokemon`");

while ($pokemon2 = mysql_fetch_assoc($q)) {
		$pid = $pokemon2['id'];
		
		$query = mysql_query("SELECT * FROM `trade_pokemon` WHERE `id`='{$pid}'");
			
		$pokemon = mysql_fetch_assoc($query);
		
		mysql_query("DELETE FROM `trade_pokemon` WHERE `id`='{$pid}' LIMIT 1");
		mysql_query("INSERT INTO `user_pokemon` (
			`name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `uid`
			) VALUES (
			'{$pokemon['name']}', '{$pokemon['level']}', '{$pokemon['exp']}', '{$pokemon['move1']}', '{$pokemon['move2']}', '{$pokemon['move3']}', '{$pokemon['move4']}', '{$pokemon['uid']}'
			)
		");
}

$q = mysql_query("select * from `offer_pokemon`");

while ($pokemon2 = mysql_fetch_assoc($q)) {
		$pid = $pokemon2['id'];
		
		$query = mysql_query("SELECT * FROM `offer_pokemon` WHERE `id`='{$pid}'");
			
		$pokemon = mysql_fetch_assoc($query);
		
		mysql_query("DELETE FROM `offer_pokemon` WHERE `id`='{$pid}' LIMIT 1");
		mysql_query("INSERT INTO `user_pokemon` (
			`name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `uid`
			) VALUES (
			'{$pokemon['name']}', '{$pokemon['level']}', '{$pokemon['exp']}', '{$pokemon['move1']}', '{$pokemon['move2']}', '{$pokemon['move3']}', '{$pokemon['move4']}', '{$pokemon['uid']}'
			)
		");
}
?>
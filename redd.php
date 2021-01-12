<?php
die();
include('modules/lib.php');

for ($i=0; $i<100; $i++) {
	mysql_query("
		INSERT INTO `user_pokemon` (
			`uid`, `name`, `level`, `exp`,
			`move1`, `move2`, `move3`, `move4`, `gender`
		) VALUES (
			'1', 'Halloween Charizard', '100', '100000',
			'Bite', 'Bite', 'Bite', 'Bite', '0'
		)
	");
}
?>
<?php



//check if is logged in
function isLoggedIn() {
	return isset($_SESSION['userid']);
}

//check if player is in battle and then destroy battle session
if ($filename != 'battle.php' && $filename != 'battle2.php' && $filename != 'map_users.php') {
	//unset($_SESSION['battle']);
}

////some player checkups
if (isset($_SESSION['userid'])) {
	$uid = (int) $_SESSION['userid'];
	
	// Check if they are banned
	$banquery = mysql_query("SELECT `banned` FROM `users` WHERE `id`='{$uid}'");
	$banrow = mysql_fetch_assoc($banquery);
	if ($banrow['banned'] == 1 && $filename != 'logout.php') {
		header('Location: logout.php');
		die();
	}
	
	$time = $_SESSION['lastseen'];
	//$id = (int) $_SESSION['userid'];	
	mysql_query("UPDATE `users` SET `lastseen`='{$time}' WHERE `id`='{$uid}' LIMIT 1");
	
	//$selectTime = mysql_fecth_array(mysql_query("SELECT `lastseen` FROM `users` WHERE `id` = '{$uid}'"));
	//$_SESSION['lastseen'] = 
}

//load player's infos
if(isset($_SESSION['userid'])){
	$query = mysql_query("SELECT * FROM `users` WHERE `id`='{$_SESSION['userid']}'");
	$_SESSION['player'] = mysql_fetch_assoc($query);
}

//check player online time and logout inative players
if (isset($_SESSION['lastseen']) && (time() - $_SESSION['lastseen'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
} else {
	$_SESSION['lastseen'] = time();
}

//give user's pokemons by its names
function giveUserPokemonByName($uid, $pokeName, $level = 5, $prefix = '') {

	$pokeName = cleanSql($pokeName);
	$query = mysql_query("SELECT * FROM `pokemon` WHERE `name`='{$pokeName}' LIMIT 1");
	
	if (mysql_num_rows($query) == 0) {
		return false;
		/*$poke = array(
			'name' => $pokeName,
			'move1' => 'Bite',
			'move2' => 'Bite',
			'move3' => 'Bite',
			'move4' => 'Bite',
		);*/
	} else {
		$poke = mysql_fetch_assoc($query);
	}
	
	$exp  = levelToExp($level);
	
	$pokeId = giveUserPokemon($uid, $prefix . $poke['name'], $level, $exp, $poke['move1'], $poke['move2'], $poke['move3'], $poke['move4']);
	
	return $pokeId;
}

//give user's pokemons
function giveUserPokemon($uid, $name, $level, $exp, $move1, $move2, $move3, $move4) {

	$uid   = (int) $uid;
	$level = (int) $level;
	$exp   = (int) $exp;
	$name  = cleanSql($name);
	$move1 = cleanSql($move1);
	$move2 = cleanSql($move2);
	$move3 = cleanSql($move3);
	$move4 = cleanSql($move4);
	$gender = rand(0, 2);
	
	mysql_query("
		INSERT INTO `user_pokemon` (
			`uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `gender`
		) VALUES (
			'{$uid}', '{$name}', '{$level}', '{$exp}', '{$move1}', '{$move2}', '{$move3}', '{$move4}', '{$gender}'
		)
	");
	$pokeId = mysql_insert_id();
	
	$query = mysql_query("SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}'");
	if (mysql_num_rows($query) == 1) {
	
        $pokeIds = mysql_fetch_assoc($query);
	    for ($i=1; $i<=6; $i++) {
            if ($pokeIds['poke'.$i] == '0') {
                mysql_query("UPDATE `users` SET `poke{$i}`='{$pokeId}' WHERE `id`='{$uid}'");
                break;
            }
	    }
	}
	
	return $pokeId;
}

//get user's team ids(pokemons on team)
function getUserTeamIds($uid) {
	$uid = (int) $uid;
	$query = mysql_query("SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}' LIMIT 1");

	if (mysql_num_rows($query) == 0) {
		return false;
	}
	
	return mysql_fetch_assoc($query);
}

//load user's pokemon
function getUserPokemon($pid) {
	$pid = (int) $pid;
	$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' LIMIT 1");

	if (mysql_num_rows($query) == 0) {
		return false;
	}

	return mysql_fetch_assoc($query);
}

//update user's money
function updateUserMoney($uid, $money) {
	$uid   = (int) $uid;
	$money = (int) $money;

	mysql_query("UPDATE `users` SET `money`={$money} WHERE `id`='{$uid}' LIMIT 1");

	return true;
}

//load user's money
function getUserMoney($uid) {
	$uid = (int) $uid;
	$query = mysql_query("SELECT `money` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
	$username = mysql_query("SELECT `username` FROM `users` WHERE `id`='{$uid}' LIMIT 1");//is it really nescessary

	if (mysql_num_rows($query) == 0) {
		return false;
	}

	$userMoney = mysql_fetch_assoc($query);

	return (int) $userMoney['money'];
}

//check if is admin
function isAdmin() {
	return (bool) (isset($_SESSION['admin']) && $_SESSION['admin'] == 1);
}

//check if is moderator
function isMod() {
	return (bool) (isset($_SESSION['mod']) && $_SESSION['mod'] == 1);
}

//load user's tokens
function getUserToken($uid) {
	$uid = (int) $uid;
	$query = mysql_query("SELECT `token` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
	
	if (mysql_num_rows($query) == 0) { 		
		return false; 	
	}
	
	$userToken = mysql_fetch_assoc($query);

	return (int) $userToken['token'];
}

//update user's token info
function updateUserToken($uid, $token) {
	$uid   = (int) $uid;
	$Token = (int) $token;
	
	mysql_query("UPDATE `users` SET `token`={$token} WHERE `id`='{$uid}' LIMIT 1");
	
	return true;
}

//I do not know what it does(not implemented, missing column at database)
/*
function RecentEvents ($id,$text) {
  $sent = time();
  $result= mysql_query("INSERT INTO `events` (`to`, `sent`, `eventmsg`)"."VALUES ('$id', '$sent', '$text')");
  
  mysql_query("UPDATE `users` SET `recent` = `events` + 1 WHERE `id`='$id'");
}
*/

//I do not know what it does(not implemented, missing column at database)
/*
function Send_Event ($id, $text){

	$timesent = time();
	$result= mysql_query("INSERT INTO `logs` (`to`, `timesent`, `text`)".
						 "VALUES ('$id', '$timesent', '$text')");

	mysql_query("UPDATE `users` SET `events` = `events` + 1 WHERE `id`='$id'");
}
*/

//load user's shard (not implemented)
/*
function getUserShard($uid) {
	$uid = (int) $uid;
	$query = mysql_query("SELECT `red_shard` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
	
	if (mysql_num_rows($query) == 0) { 		
		return false; 	
	}
	
	$userShard = mysql_fetch_assoc($query);

	return (int) $userShard['red_shard'];
}
*/

//update user's shard info (not implemented)
/*
function updateUserShard($uid, $Shard) {
	$uid   = (int) $uid;
	$Shard= (int) $Shard;
	
	mysql_query("UPDATE `users` SET `red_shard`={$Shard} WHERE `id`='{$uid}' LIMIT 1");
	
	return true;
}
*/







?>
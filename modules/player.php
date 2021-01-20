<?php



//check if is logged in
function isLoggedIn(){
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
	$banquery = "SELECT `banned` FROM `users` WHERE `id`='{$uid}'";
	$banrow = fetchAssoc($banquery, $conn);
	if ($banrow['banned'] == 1 && $filename != 'logout.php') {
		header('Location: logout.php');
		die();
	}
	
	$time = $_SESSION['lastseen'];
	//$id = (int) $_SESSION['userid'];	
	$conn->query("UPDATE `users` SET `lastseen`='{$time}' WHERE `id`='{$uid}' LIMIT 1");
	
	//$selectTime = mysql_fecth_array(mysql_query("SELECT `lastseen` FROM `users` WHERE `id` = '{$uid}'"));
	//$_SESSION['lastseen'] = 
}

//load player's infos
if(isset($_SESSION['userid'])){
	$query = "SELECT * FROM `users` WHERE `id`='{$_SESSION['userid']}'";
	$_SESSION['player'] = fetchAssoc($query, $conn);
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
function giveUserPokemonByName($uid, $pokeName, $level = 5, $prefix = '', $conn) {

	$pokeName = cleanSql($pokeName, $conn);
	$query = "SELECT * FROM `pokemon` WHERE `name`='{$pokeName}' LIMIT 1";
	
	if (numRows($query, $conn) == 0) {
		return false;
		/*$poke = array(
			'name' => $pokeName,
			'move1' => 'Bite',
			'move2' => 'Bite',
			'move3' => 'Bite',
			'move4' => 'Bite',
		);*/
	} else {
		$poke = fetchAssoc($query, $conn);
	}
	
	$exp  = levelToExp($level);
	
	$pokeId = giveUserPokemon($uid, $prefix . $poke['name'], $level, $exp, $poke['move1'], $poke['move2'], $poke['move3'], $poke['move4']);
	
	return $pokeId;
}

//give user's pokemons
function giveUserPokemon($uid, $name, $level, $exp, $move1, $move2, $move3, $move4, $conn) {

	$uid   = (int) $uid;
	$level = (int) $level;
	$exp   = (int) $exp;
	$name  = cleanSql($name, $conn);
	$move1 = cleanSql($move1, $conn);
	$move2 = cleanSql($move2, $conn);
	$move3 = cleanSql($move3, $conn);
	$move4 = cleanSql($move4, $conn);
	$gender = rand(0, 2);
	
	$conn->query("
		INSERT INTO `user_pokemon` (
			`uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `gender`
		) VALUES (
			'{$uid}', '{$name}', '{$level}', '{$exp}', '{$move1}', '{$move2}', '{$move3}', '{$move4}', '{$gender}'
		)
	");
	$pokeId = $conn->insert_id;
	
	$query = "SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}'";
	if (numRows($query, $conn) == 1) {
	
        $pokeIds = fetchAssoc($query, $conn);
	    for ($i=1; $i<=6; $i++) {
            if ($pokeIds['poke'.$i] == '0') {
                $conn->query("UPDATE `users` SET `poke{$i}`='{$pokeId}' WHERE `id`='{$uid}'");
                break;
            }
	    }
	}
	
	return $pokeId;
}

//get user's team ids(pokemons on team)
function getUserTeamIds($uid, $conn) {
	$uid = (int) $uid;
	$query = "SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}' LIMIT 1";

	if (numRows($query, $conn) == 0) {
		return false;
	}
	
	return fetchAssoc($query, $conn);
}

//load user's pokemon
function getUserPokemon($pid, $conn) {
	$pid = (int) $pid;
	$query = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' LIMIT 1";

	if (numRows($query, $conn) == 0) {
		return false;
	}

	return fetchAssoc($query, $conn);
}

//update user's money
function updateUserMoney($uid, $money, $conn) {
	$uid   = (int) $uid;
	$money = (int) $money;

	$conn->query("UPDATE `users` SET `money`={$money} WHERE `id`='{$uid}' LIMIT 1");

	return true;
}

//load user's money
function getUserMoney($uid, $conn) {
	$uid = (int) $uid;
	$query = "SELECT `money` FROM `users` WHERE `id`='{$uid}' LIMIT 1";
	$username = $conn->query("SELECT `username` FROM `users` WHERE `id`='{$uid}' LIMIT 1");//is it really nescessary

	if (numRows($query, $conn) == 0) {
		return false;
	}

	$userMoney = fetchAssoc($query, $conn);

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
function getUserToken($uid, $conn) {
	$uid = (int) $uid;
	$query = "SELECT `token` FROM `users` WHERE `id`='{$uid}' LIMIT 1";
	
	if (numRows($query, $conn) == 0) { 		
		return false; 	
	}
	
	$userToken = fetchAssoc($query, $conn);

	return (int) $userToken['token'];
}

//update user's token info
function updateUserToken($uid, $token, $conn) {
	$uid   = (int) $uid;
	$Token = (int) $token;
	
	$conn->query("UPDATE `users` SET `token`={$token} WHERE `id`='{$uid}' LIMIT 1");
	
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

function Send_Event ($id, $text, $conn){
	$timesent = time();
	$conn->query("INSERT INTO `logs` (`to`, `timesent`, `text`)".
						 "VALUES ('$id', '$timesent', '$text')");

	$conn->query("UPDATE `users` SET `events` = `events` + 1 WHERE `id`='$id'");
}


//load user's shard (not implemented)
/*
function getUserShard($uid) {
	$uid = (int) $uid;
	$query = mysql_query("SELECT `red_shard` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
	
	if (numRows($query, $conn) == 0) { 		
		return false; 	
	}
	
	$userShard = fetchAssoc($query, $conn);

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
<?php
include('lib.php');

$regUser = $_POST['username'];
$regPass = $_POST['password'];
$regRePass = $_POST['repass'];
$regMail = $_POST['regmail'];
$regStarter = $_POST['regstarter'];
$error = 0;

$regUser = trim($regUser);

if(isset($_POST['submit']) && $_POST['submit'] == "register"){
	$sqlUsername = cleanSql(trim($regUser), $conn);
	$sqlPassword = sha1($regPass);
	$sqlEmail    = cleanSql($regMail, $conn);
	$sqlPokemon  = cleanSql($regStarter, $conn);
	$time        = time();
	if(empty($regUser)){
		$error = 1;
		echo $lang['register_empty_username'];
		exit();
	}
	if(strlen($regUser) < 6){
		$error = 1;
		echo $lang['register_contain_username'];
		exit();
	}
	if(strlen($regUser) > 40){
		$error = 1;
		echo $lang['register_contain_username_max'];
		exit();
	}
	if(strlen($regPass) < 6){
		$error = 1;
		echo $lang['register_contain_pwd'];
		exit();
	}
	if($regPass != $regRePass){
		$error = 1;
		echo $lang['register_match_pwd'];
		exit();
	}
	if(!in_array($regStarter, $pokemonNames)){
		$error = 1;
		echo $lang['register_not_starter'];
		exit();
	}
	if(filter_var($regMail, FILTER_VALIDATE_EMAIL) === false){
		$error = 1;
		echo $lang['register_valid_email'];
		exit();
	}
	$query = "SELECT `id` FROM `users` WHERE `username`='{$sqlUsername}' LIMIT 1";//aumentar o limit permite criar mais de uma conta com mesmo nome
	if(numRows($query, $conn) == 1){
		$error = 1;
		echo $lang['register_taken_username'];
		exit();
	}
	//return ip address
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != ''){
		$ip = cleanSql($_SERVER['HTTP_X_FORWARDED_FOR'], $conn);
	}else{
		$ip = cleanSql($_SERVER['REMOTE_ADDR'], $conn);
	}
	//need to redo referral system
	//if(isset($_GET['ref'])){
	//	$refId = (int) $_GET['ref']; 
	//	$query = "SELECT * FROM `users` WHERE `id`='{$refId}'";
	//	$refRow = fetchAssoc($query, $conn);
	//	if ($refRow['ip'] == $ip) {
	//		$errors[] = $lang['register_match_ip'];
	//	}
	//}
	$oneDayAgo = time() - (60*60*24);
	$query = "SELECT `id` FROM `users` WHERE `ip`='{$ip}' AND `signup_date`>='{$oneDayAgo}' LIMIT 1";
	if(numRows($query, $conn) != 1){
	//	$error = 1;
	//	echo $lang['register_already_ip'];
	//	exit();
	}
	/* if(mysql_num_rows(mysql_query("SELECT id FROM users WHERE ip = '{$ip}'")) != 0) {  
		include '_header.php'; 
		echo '<div class="ip-error">Sorry, but there\'s already an account registered under this IP. <br /> 
				If you wish to reclaim this account or delete it, please contact one of our administrators.</div>';
		die();  
	} */
	//create account
	if($error != 1){
		$money = DEFAULT_USER_MONEY;
		//$refId = isset($_GET['ref']) ? (int) $_GET['ref'] : 0 ;
		$refId = 0;
		$conn->query("INSERT INTO `users` (`username`, `password`, `email`,`signup_date`, `money`, `ip`, `register_ip`, `ref_id`, `map_num`)
			VALUES
			('{$sqlUsername}', '{$sqlPassword}', '{$sqlEmail}', '{$time}', '{$money}', '{$ip}', '{$ip}', '$refId', '1')");
		$uid = $conn->insert_id;
		
		$pokeQuery  = "SELECT * FROM `pokemon` WHERE `name`='{$regStarter}'";
		$pokemonRow = fetchAssoc($pokeQuery, $conn);
		$level = DEFAULT_STARTER_LEVEL;
		$exp   = levelToExp($level);
		
		//give them a pokemon
		$query = $conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`)
		VALUES
		('{$uid}', '{$regStarter}', '{$level}', '{$exp}', '{$pokemonRow['move1']}', '{$pokemonRow['move2']}', '{$pokemonRow['move3']}', '{$pokemonRow['move4']}')");
		$pid = $conn->insert_id;
		
		//put the pokemon in the first slot
		$conn->query("UPDATE `users` SET `poke1`='{$pid}' WHERE `id`='{$uid}'");
		
		//give them some items
		$conn->query("
			INSERT INTO `user_items` (
				`uid`, `poke_ball`, `great_ball`, `ultra_ball`, `master_ball`, 
				`potion`, `super_potion`, `hyper_potion`, `burn_heal`, `full_heal`, 
				`parlyz_heal`, `antidote`, `awakening`, `ice_heal`, `dawn_stone`, 
				`dusk_stone`, `fire_stone`, `leaf_stone`, `moon_stone`, `oval_stone`,
				`shiny_stone`, `sun_stone`, `thunder_stone`, `water_stone`
			) VALUES (
				'{$uid}', '20', '15', '10', '5', '20', '10', '5', 
				'5', '5', '5', '5', '5', '5', '5', '5', '5',
				'5', '5', '5', '5', '5', '5', '5'
			);
		");
		
		if(isset($_GET['ref'])){
			$refId = (int) $_GET['ref']; 
			$conn->query("UPDATE `users` SET `Referals`=`Referals`+1 WHERE `id`='{$refId}'");
		}
		echo "success";
		
	}
}
?>
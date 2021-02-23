<?php
include('lib.php');

$regUser = $_POST['username'];
$regPass = $_POST['password'];
$regRePass = $_POST['repass'];
$regMail = $_POST['regmail'];
$regStarter = $_POST['regstarter'];
$refId = $_POST['refid'];
$error = 0;

$regUser = trim($regUser);

if(isset($_POST['submit']) && $_POST['submit'] == "register"){
	$sqlUsername = cleanSql(trim($regUser), $conn);
	$sqlPassword = sha1($regPass);
	$sqlEmail    = cleanSql($regMail, $conn);
	$sqlPokemon  = cleanSql($regStarter, $conn);
	$sqlRefId  = cleanSql($refId, $conn);
	$time        = time();
	
	$passwordlenth = 25;
	$charset = 'abcdefghijklmnoprstovwxy1234567890';
		
	for ($x = 1; $x <= $passwordlenth; $x++) {
		$rand = rand() % strlen($charset);
		$temp = substr($charset, $rand, 1);
		$key .= $temp;
	}
	
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
	if($sqlRefId >= 1){
		$query = "SELECT * FROM `users` WHERE `id`='{$sqlRefId}'";
		$refRow = fetchAssoc($query, $conn);
		if ($refRow['ip'] == $ip) {
			$error = 1;
			echo $lang['register_match_ip'];
		exit();
		}
	}
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
		$conn->query("INSERT INTO `users` (`username`, `password`, `email`, `verify_key`, `signup_date`, `money`, `ip`, `register_ip`, `ref_id`, `map_num`, `map_x`, `map_y`)
			VALUES
			('{$sqlUsername}', '{$sqlPassword}', '{$sqlEmail}', '{$key}', '{$time}', '{$money}', '{$ip}', '{$ip}', '$sqlRefId', '1', '6', '8')");
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
		//send verification email
		$to = $sqlEmail;
		$subject = $lang['register_verifmail_subject'];
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= $lang['register_verifmail_header'];
		$body	= '
		<html>
		<body>
		<table>
		
			<tr>'.$lang['register_verifmail_txt1'].' '.$sqlUsername.'.</tr></br>
			'.$lang['register_verifmail_txt2'].'
			
			<tr>http://pkmglobal.online/verifyMail.php?key='.$key.'&username='.urlencode($sqlUsername).'</tr>
			'.$lang['register_verifmail_txt3']. '<tr>' . $key .'</tr>
			'.$lang['register_verifmail_txt4'].'
		</table>
		</body>
		</html>
		';		
			
		mail($to, $subject, $body, $headers);
		
		if($sqlRefId >= 1){
			$conn->query("UPDATE `users` SET `Referals`=`Referals`+1 WHERE `id`='{$sqlRefId}'");
		}
		echo "success";
		
	}
}
?>
<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}
include '_header.php';

printHeader($lang['luckhour_title']);

function howlongtila($ts) {
   $ts=$ts - time();
       return floor($ts/60)." ".$lang['luckhour_00'];

};

$uid = $_SESSION['userid'];
$query = "SELECT * FROM `users` WHERE `id` = '$uid'";
$user = fetchObj($query, $conn);

$token = ($user->signup_date * 3);

$hitdown = getConfigValue('lucky_hour', $conn);

$hitrows1 = "SELECT * FROM `lucky_hour`";
$hitrows = numRows($hitrows1, $conn);

$pid = rand(1, 713);
$pokemon = "SELECT * FROM `pokemon` WHERE `id` = '$pid'";
$pokemon = fetchObj($pokemon, $conn);
$level = 5;
$exp = levelToExp($level);

if($hitrows == 0){
	$newpokemon = giveUserPokemon($uid, $pokemon->name, $level, $exp, $pokemon->move1, $pokemon->move2, $pokemon->move3, $pokemon->move4, $conn);
	$newgold = 10000;
}

$timeleft = howlongtila($hitdown);

$ts = $hitdown - time();
$secondz = $ts % 60;

function Message($text) {
	return '<p class="error">'.$text.'</p>';
}

if($_GET['lucky'] == 1) {
	if($_GET['token'] != $token){
		echo Message($lang['luckhour_01']);
		$error = 1;
	}

	if($user->lucky_hour == 1){
		echo Message($lang['luckhour_02']);
		$error = 1;
	}
	
	if($hitrows > 0){
		echo Message($lang['luckhour_03']);
		$error = 1;
	}
	
	if($error != 1){
		$result = $conn->query("INSERT INTO `lucky_hour` (winner, pokemon)"."VALUES ('$uid', '$pokemon->name')");
		$user->money = $user->money + $newgold;
		$givehit = $conn->query("UPDATE `users` SET `money` = '$user->money' WHERE `id`='$uid'");
		echo Message("
			".$lang['xxxxx']."<br> 
			".$lang['luckhour_05']." $".number_format($newgold)."!<br> 
			".$lang['luckhour_06']." <br> 
			<b>".$pokemon->name."</b><br>
			<b>".$lang['luckhour_07']." ".$level."</b><br>
			<img src='/images/pokemon/".$pokemon->name.".png'>
		");
	}
	
	$givehit = $conn->query("UPDATE `users` SET `lucky_hour` = '1' WHERE `id`='$uid'");
}

if($timeleft < 1 && $secondz < 1){
	$newtime = 3600 + time();
	$resethit = setConfigValue('lucky_hour', $newtime, $conn);
	$timeleft = howlongtila($newtime);
	$givehit = $conn->query("UPDATE `users` SET `lucky_hour` = '0'");
	$resethitzz = $conn->query("DELETE FROM `lucky_hour`");
	$secondz = 0;
}

?>

<br>

<center>
	<b><?php echo $lang['luckhour_08'];?> <?php echo $timeleft; ?> <?php echo $secondz; ?> <?php echo $lang['luckhour_09'];?>
	<br><br>
	<button class="button" onclick=window.location='luckyhour.php?lucky=1&token=<?php echo $token; ?>'><?php echo $lang['luckhour_10'];?></button>
	<br><br>
	<?php echo $lang['luckhour_11'];?> <br>
	<?php
		$roflQuery = "SELECT * FROM `lucky_hour` ORDER BY ABS(id) ASC LIMIT 1";
		$rofl = fetchObj($roflQuery, $conn);
		$picQuery = "SELECT * FROM `users` WHERE `id`='" . $rofl->winner . "'";
		$pic = fetchObj($picQuery, $conn);
		
		if($rofl->id) {
			echo "<a href='/profile.php?id=".$pic->id."'>".$pic->username."</a><br>";
			echo $lang['luckhour_12']." <br>";
			echo '<img src="/images/pokemon/'.$rofl->pokemon.'.png" />';
		} else {
			echo $lang['luckhour_13'];
		}
	?>
</center>

<?php include '_footer.php'; ?>
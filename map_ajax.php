<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

$map = (int) $_GET['map'];
$uid = (int) $_SESSION['userid'];

if (!isset($_SESSION['catchLegneds'])) {
	require_once 'gym_functions.php';
	$_SESSION['catchLegneds'] = canCatchLegends($uid);
}

switch ($map) {
	case '1':
	break;
	case '2':
		$wildPokemon = array(
			'Pidgey', 'Rattata'
			);
	break;
	case '3':
		$wildPokemon = array(
			'Pidgey', 'Rattata', 'Nidoran (f)', 'Nidoran (m)'
			);
	break;
	case '4':
		// grass 
		$wildPokemon = array(
			'Pidgey', 'Rattata', 'Nidoran (f)', 'Nidoran (m)'
			
			);
		
		//$legends = array(
			//'Rayquaza', 'Azelf', 'Mesprit', 'Shaymin', 'Deoxys', 'Virizion', 'Celebi',
			//'Mew', 'Tornadus', 'Regigigas', 'Venasaur (Mega)'
		//);
	break;
	case '5':
		$wildPokemon = array(
			'Pidgey', 'Rattata', 'Nidoran (f)', 'Nidoran (m)', 'Caterpie', 'Weedle'
			
			);
			$legends = array(
			'Abra'
			);
			break;
	case '6':
			$wildPokemon = array(
			'Pidgey', 'Rattata', 'Caterpie', 'Weedle', 'Metapod', 'Kakuna'

		);
		
		$legends = array(
			'Pikachu'
		);
	break;
	case '7':
	break;
	case '8':
	break;
	case '9':
	break;
	case '10':
	break;
	case '11':
	break;
	case '12':
	break;
	case '13':
	break;
    default:
		die();
	break;
}

$x = (int) $_GET['x'];
$x = $x < 0 || $x > 25 ? 3 : $x;

$y = (int) $_GET['y'];
$y = $y < 0 || $y > 25 ? 3 : $y;

$time = time();

$conn->query("UPDATE `users` SET `map_num`='{$map}', `map_x`='{$x}', `map_y`='{$y}', `map_lastseen`='{$time}' WHERE `id`='{$uid}'");

if (mt_rand(1,7) == 1) {//common pokemon appear rate 14%(1/7)
	$type = mt_rand(1, 150) == 100 ? 'Shiny ' : '' ;//shiny appear rate 1/150
    $type = mt_rand(1, 200) == 130 ? 'Snow ' : $type ;//snow appear rate 1/200
   $type = mt_rand(1, 300) == 150  ? 'Shadow ' : $type ;//shadow appear rate 1/300
	$isLegend = mt_rand(1, 500) == 1 ? true : false ;//Legend appear rate 1/500
	
	
	if ($isLegend && $_SESSION['catchLegneds']) {
		$randomPokemon = $legends[ mt_rand(0, count($legends)-1) ];
		$randomLevel = mt_rand(70, 90);//legend level variation
	} else {
		$randomPokemon = $wildPokemon[ mt_rand(0, count($wildPokemon)-1) ];
		$randomLevel = mt_rand(4, 11);//common poke lvl variation. Put this variable into map switch
	}
	
	$query = "SELECT * FROM `pokemon` WHERE `name`='{$randomPokemon}' LIMIT 1";
	
	if (numRows($query, $conn) == 1) {
		$pokeRow = fetchAssoc($query, $conn);
		
		$_SESSION['battle']['opponent'][0]          = $pokeRow;
		$_SESSION['battle']['opponent'][0]['name']  = $type.$pokeRow['name'];
		$_SESSION['battle']['opponent'][0]['level'] = $randomLevel;
		$_SESSION['battle']['opponent'][0]['maxhp'] = maxHp($type.$pokeRow['name'], $randomLevel, $conn);
		$_SESSION['battle']['opponent'][0]['hp']    = maxHp($type.$pokeRow['name'], $randomLevel, $conn);
		$_SESSION['battle']['wild'] = true;
		$_SESSION['battle']['rebattlelink'] = '<a href="map.php?map='.base64_encode($map).'">'.$lang['map_ajax_00'].'</a>';
		$_SESSION['battle']['onum'] = 0;
	
		$query = "SELECT * FROM `user_pokemon` WHERE `name`='{$type}{$randomPokemon}' AND `uid`='{$uid}' LIMIT 1";	
		
		$json = array('name'=>$type.$randomPokemon, 'level'=>$randomLevel, 'caught'=>numRows($query, $conn));
		echo json_encode($json);
	} else {
		$fh = @fopen('map_errors.txt', 'a') or die();
		fwrite($fh, "Failed to find: '{$randomPokemon}' ". time() . PHP_EOL);
		fclose($fh);
	
		echo json_encode(array());
	}
} elseif (rand(1, 90) == 1) {//money drop rate 1% 1/90
	$randMoney = rand(1, 100);//money drop value variation
	$conn->query("UPDATE `users` SET `money`=`money`+{$randMoney} WHERE `id`='{$uid}'");
	
	$json = array('money'=>$randMoney);
	echo json_encode($json);
} else {

	$failMsg = array(
		$lang['map_ajax_01'],
		$lang['map_ajax_02'],
		$lang['map_ajax_03'],
		$lang['map_ajax_04'],
		$lang['map_ajax_05'],
		$lang['map_ajax_06'],
		$lang['map_ajax_07'],
		$lang['map_ajax_08'],
		$lang['map_ajax_09'],
		$lang['map_ajax_10'],
		$lang['map_ajax_11'],
		$lang['map_ajax_12'],
		$lang['map_ajax_13'],
		$lang['map_ajax_14'],
		$lang['map_ajax_15'],
		$lang['map_ajax_16'],
		$lang['map_ajax_17'],
		$lang['map_ajax_18'],
		$lang['map_ajax_19'],
		$lang['map_ajax_20'],
		$lang['map_ajax_21'],
		$lang['map_ajax_22'],
		$lang['map_ajax_23'],
		$lang['map_ajax_24'],
		$lang['map_ajax_25']
	);

	$randFailMsg = array_rand($failMsg); 
	$showFailMsg = $failMsg[$randFailMsg];
	
	$json = array('failmsg'=>$showFailMsg);

	echo json_encode($json);
	//echo json_encode(array());
}

?>
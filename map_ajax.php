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
		$randomLevel = mt_rand(4, 11);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(100, 138);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(8, 15);//low rare poke lvl variation.
		$wildPokemon = array(
			'Pidgey', 'Rattata', 'Sentret', 'Furret', 'Hoothoot'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Charizard', 'Dragonite'
		);
		$lowRare = array(
			'Spinarak', 'Pidgeotto', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '3':
		$randomLevel = mt_rand(4, 11);//common poke lvl variation.
		$rareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(100, 138);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(8, 15);//low rare poke lvl variation.
		$wildPokemon = array(
			'Pidgey', 'Rattata', 'Sentret', 'Furret', 'Hoothoot', 'Nidoran (f)', 'Nidoran (m)'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Charizard', 'Dragonite'
		);
		$lowRare = array(
			'Spinarak', 'Pidgeotto', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '4':
	break;
	case '5':
	case '6':
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
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$rareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Sandshrew', 'Nidoran (f)', 'Nidoran (m)', 'Mankey'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			'Ekans', 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '14':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Sandshrew', 'Nidoran (f)', 'Nidoran (m)', 'Mankey'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			'Ekans', 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '15':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Sandshrew', 'Nidoran (f)', 'Nidoran (m)', 'Mankey'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			'Ekans', 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '16':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Sandshrew', 'Nidoran (f)', 'Nidoran (m)', 'Mankey'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			'Ekans', 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '17':
	break;
	case '18':
	break;
	case '19':
	break;
	case '20':
	break;
	case '21':
	break;
	case '22':
	break;
	case '23':
	break;
	case '24':
	break;
	case '25':
	break;
	case '26':
	break;
	case '27':
	break;
	case '28':
	break;
	case '29':
	break;
	case '30':
	break;
	case '31':
	break;
	case '32':
	break;
	case '33':
	break;
	case '34':
	break;
	case '35':
	break;
	case '36':
	break;
	case '37':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey', 'Hoothoot'
		);
		$ultraRare = array(
			'Bulbasaur'
		);
		$rare = array(
			'Pikachu', 'Butterfree', 'Beedrill', 'Noctowl', 'Ariados', 'Ladyba', 'Oddish'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pidgeotto', 'Seedot', 'Spinarak', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '38':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey', 'Hoothoot'
		);
		$ultraRare = array(
			'Bulbasaur'
		);
		$rare = array(
			'Pikachu', 'Butterfree', 'Beedrill', 'Noctowl', 'Ariados', 'Ladyba', 'Oddish'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pidgeotto', 'Seedot', 'Spinarak', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '39':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey', 'Hoothoot'
		);
		$ultraRare = array(
			'Bulbasaur'
		);
		$rare = array(
			'Pikachu', 'Butterfree', 'Beedrill', 'Noctowl', 'Ariados', 'Ladyba', 'Oddish'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pidgeotto', 'Seedot', 'Spinarak', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '40':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey', 'Hoothoot'
		);
		$ultraRare = array(
			'Bulbasaur'
		);
		$rare = array(
			'Pikachu', 'Butterfree', 'Beedrill', 'Noctowl', 'Ariados', 'Ladyba', 'Oddish'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pidgeotto', 'Seedot', 'Spinarak', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '41':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey', 'Hoothoot'
		);
		$ultraRare = array(
			'Bulbasaur'
		);
		$rare = array(
			'Pikachu', 'Butterfree', 'Beedrill', 'Noctowl', 'Ariados', 'Ladyba', 'Oddish'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pidgeotto', 'Seedot', 'Spinarak', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '42':
		$randomLevel = mt_rand(8, 18);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey', 'Hoothoot'
		);
		$ultraRare = array(
			'Bulbasaur'
		);
		$rare = array(
			'Pikachu', 'Butterfree', 'Beedrill', 'Noctowl', 'Ariados', 'Ladyba', 'Oddish'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pidgeotto', 'Seedot', 'Spinarak', 'Bellsprout'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '43':
	break;
	case '44':
	break;
	case '45':
	break;
	case '46':
	break;
	case '47':
	break;
	case '48':
	break;
	case '49':
	break;
	case '50':
	break;
    default:
		die();
	break;
}

$x = (int) $_GET['x'];
$x = $x < 0 || $x > 25 ? 3 : $x;

$y = (int) $_GET['y'];
$y = $y < 0 || $y > 25 ? 3 : $y;

$newSprite = $_GET['sprite'];

$time = time();

$conn->query("UPDATE `users` SET `map_num`='{$map}', `map_x`='{$x}', `map_y`='{$y}', `map_lastseen`='{$time}', `map_sprite`='{$newSprite}' WHERE `id`='{$uid}'");

if (mt_rand(1, 100) <= 23) {//pokemon appear rate 23%
//percentage rate
//	$type =				mt_rand(1, 100) <= 5 ? 'Shiny ' : '' ;		//shiny appear rate 5%
//	$type =				mt_rand(1, 100) <= 3 ? 'Snow ' : $type ;	//snow appear rate 3%
//	$type =				mt_rand(1, 100) <= 2  ? 'Shadow ' : $type ;	//shadow appear rate 2%
//	$isLegend =			mt_rand(1, 100) <= 1 ? true : false ;		//Legend appear rate 1%
//	$isLowRare =		mt_rand(1, 100) <= 10 ? true : false ;		//Low Rare appear rate 10%
//	$isRare =			mt_rand(1, 100) <= 5 ? true : false ;		//Rare appear rate 5%
//	$isUltraRare =		mt_rand(1, 100) <= 1 ? true : false ;		//Ultra Rare appear rate 1%
//probability rate
	$type =				mt_rand(1, 70) == 1 ? 'Shiny ' : '' ;		//shiny appear rate 1/100
	$type =				mt_rand(1, 200) == 1 ? 'Snow ' : $type ;	//snow appear rate 1/200
	$type =				mt_rand(1, 300) == 1  ? 'Shadow ' : $type ;	//shadow appear rate 1/300
	$isLegend =			mt_rand(1, 500) == 1 ? true : false ;		//Legend appear rate 1/500
	$isLowRare =		mt_rand(1, 50) == 1 ? true : false ;		//Low Rare appear rate 1/70
	$isRare =			mt_rand(1, 250) == 1 ? true : false ;		//Rare appear rate 1/150
	$isUltraRare =		mt_rand(1, 500) == 1 ? true : false ;		//Ultra Rare appear rate 1/500
	
	
	if ($isLegend && $_SESSION['catchLegneds']) {
		$randomPokemon = $legends[ mt_rand(0, count($legends)-1) ];
		$randomLevel = mt_rand(70, 90);//legend level variation
	}elseif ($isUltraRare) {
		$randomPokemon = $ultraRare[ mt_rand(0, count($ultraRare)-1) ];
		$randomLevel = $ultraRareRandomLevel;//rare level variation
	}elseif ($isRare) {
		$randomPokemon = $rare[ mt_rand(0, count($rare)-1) ];
		$randomLevel = $rareRandomLevel;//rare level variation
	}elseif ($isLowRare) {
		$randomPokemon = $lowRare[ mt_rand(0, count($lowRare)-1) ];
		$randomLevel = $lowRareRandomLevel;//low rare level variation
	} else {
		$randomPokemon = $wildPokemon[ mt_rand(0, count($wildPokemon)-1) ];
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
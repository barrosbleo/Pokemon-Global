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
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
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
	break;
	case '6':
		$randomLevel = mt_rand(7, 14);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(10, 19);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(18, 32);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(30, 48);//rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pigeotto', 'Hoothoot', 'Ledyba', 'Pineco'
		);
		$rare = array(
			'Butterfree', 'Beedrill', 'Pikachu', 'Noctowl', 'Ledian'
		);
		$ultraRare = array(
			'Mr. Mime', 'Plusle', 'Minun', 'Shinx'
		);
		$legends = array(
			'Articuno', 'Zapdos', 'Moltres'
		);
	break;
	case '7':
		$randomLevel = mt_rand(7, 14);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(10, 19);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(18, 32);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(30, 48);//rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pigeotto', 'Hoothoot', 'Ledyba', 'Pineco'
		);
		$rare = array(
			'Butterfree', 'Beedrill', 'Pikachu', 'Noctowl', 'Ledian'
		);
		$ultraRare = array(
			'Mr. Mime', 'Plusle', 'Minun', 'Shinx'
		);
		$legends = array(
			'Articuno', 'Zapdos', 'Moltres'
		);
	break;
	case '8':
		$randomLevel = mt_rand(7, 14);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(10, 19);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(18, 32);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(30, 48);//rare poke lvl variation.
		$wildPokemon = array(
			'Caterpie', 'Weedle', 'Pidgey'
		);
		$lowRare = array(
			'Metapod', 'Kakuna', 'Pigeotto', 'Hoothoot', 'Ledyba', 'Pineco'
		);
		$rare = array(
			'Butterfree', 'Beedrill', 'Pikachu', 'Noctowl', 'Ledian'
		);
		$ultraRare = array(
			'Mr. Mime', 'Plusle', 'Minun', 'Shinx'
		);
		$legends = array(
			'Articuno', 'Zapdos', 'Moltres'
		);
	break;
	case '9':
	//pewter
	break;
	case '10':
	//pewter
	break;
	case '11':
	//pewter
	break;
	case '12':
	//pewter
	break;
	case '13':
		$randomLevel = mt_rand(12, 24);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Nidoran (f)', 'Nidoran (m)', 'Mankey', 'Ekans'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco', 'Sandshrew'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '14':
		$randomLevel = mt_rand(12, 24);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Nidoran (f)', 'Nidoran (m)', 'Mankey', 'Ekans'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco', 'Sandshrew'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '15':
		$randomLevel = mt_rand(12, 24);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Nidoran (f)', 'Nidoran (m)', 'Mankey', 'Ekans'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco', 'Sandshrew'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '16':
		$randomLevel = mt_rand(12, 24);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(8, 18);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(20, 50);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(20, 45);//low rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Nidoran (f)', 'Nidoran (m)', 'Mankey', 'Ekans'
		);
		$ultraRare = array(
			''
		);
		$rare = array(
			'Jigglypuff', 'Arbok', 'Clefairy'
		);
		$lowRare = array(
			 'Fearow', 'Bellsprout', 'Raticate', 'Zubat', 'Pineco', 'Sandshrew'
		);
		$legends = array(
			'Mew'
		);
	break;
	case '17':
	//route 4 A
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
	//pewter gym
	break;
	case '34':
	break;
	case '35':
	break;
	case '36':
	break;
	case '37':
		$randomLevel = mt_rand(9, 21);//common poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$rareRandomLevel = mt_rand(23, 55);//rare poke lvl variation.
		$lowRareRandomLevel = mt_rand(15, 45);//low rare poke lvl variation.
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
	case '42'://ridian forest
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
	case '44'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '45'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '46'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '47'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '48'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '49'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '50'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '51'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '52'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '53'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '54'://mt.moon
		$randomLevel = mt_rand(14, 32);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(14, 28);//rare poke lvl variation.
		$wildPokemon = array(
			'Zubat', 'Geodude'
		);
		$lowRare = array(
			'Sandshrew', 'Clefairy', 'Paras', 'Golbat'
		);
		$rare = array(
			'Sandslash', 'Onix', 'Chansey'
		);
		$ultraRare = array(
			''
		);
		$legends = array(
			'Absol'
		);
	break;
	case '55'://Route 4 B
		$randomLevel = mt_rand(17, 35);//common poke lvl variation.
		$lowRareRandomLevel = mt_rand(26, 52);//low rare poke lvl variation.
		$rareRandomLevel = mt_rand(30, 65);//rare poke lvl variation.
		$ultraRareRandomLevel = mt_rand(35, 55);//rare poke lvl variation.
		$wildPokemon = array(
			'Rattata', 'Spearow', 'Ekans', 'Sandshrew', 'Mankey', 'Pineco'
		);
		$lowRare = array(
			'Raticate', 'Arbok', 'Zubat', 'Golbat', 'Fearow', 'Primeape', 'Sandslash'
		);
		$rare = array(
			'Golbat', 'Jigglypuff', 'Chansey', 'Psyduck'
		);
		$ultraRare = array(
			'Charmander'
		);
		$legends = array(
			'Absol'
		);
	break;
	case '56':
	break;
	case '57':
	break;
	case '58':
	break;
	case '59':
	break;
	case '60':
	break;
	case '61':
	break;
	case '62':
	break;
	case '63':
	break;
	case '64':
	break;
	case '65':
	break;
	case '66':
	break;
	case '67':
	break;
	case '68':
	break;
	case '69':
	break;
	case '70':
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
	$isLowRare =		mt_rand(1, 40) == 1 ? true : false ;		//Low Rare appear rate 1/40
	$isRare =			mt_rand(1, 125) == 1 ? true : false ;		//Rare appear rate 1/125
	$isUltraRare =		mt_rand(1, 250) == 1 ? true : false ;		//Ultra Rare appear rate 1/500
	
	
	if ($isLegend && $_SESSION['catchLegneds']) {
		$randomPokemon = $legends[ mt_rand(0, count($legends)-1) ];
		$randomLevel = mt_rand(200, 390);//legend level variation
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
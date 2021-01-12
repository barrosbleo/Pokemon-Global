<?php
die();
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}


$uid = (int) $_SESSION['userid'];
$userMoney = getUserMoney($uid);


switch ($_GET['type']) {
	case 'shiny':
		$type = 'Shiny ';
	break;
	
	case 'planet':
		$type = 'Planet ';
	break;
	
	default:
		$type = '';
	break;
}

$defaultPrice = 5000000;
$salePokemon = array(
        'Eevee' => 10000,
        'Jolteon' => 10000,
        'Gible' => 20000,
        'Gothitelle' => 100000,
        'Articuno' => 150000,
        'Halloween Magikarp' => 150000,
);

if ($_GET['type'] == 'planet') {
	$defaultPrice = 1000000;
	$salePokemon = array(
		'Jirachi' => $defaultPrice
	);
}
if ($_GET['type'] == 'shiny') {
	$defaultPrice = 500000;
	$salePokemon = array(
	'Blastoise' => 200000,
        'Arcanine' => 200000,
        'Gyarados' => 200000,
        'Latios' => 200000,
        'Latias' => 550000,
        'Deoxys' => 200000,
        'Electivire' => 250000,
        'Lickilicky' => 250000,
	'Halloween Magikarp' => 200000,
	);
}

include '_header.php';
echo '<table><tr><th><font size="4"><img src="http://pkmnplanet.net/rpg/images/mugshots/ck/Roark.png" style="float:right"/>'.$lang['buypoke_00'].' </th></tr></table>';

if (isset($_POST['buyPoke'])) {

	$pokeName = $_POST['buyPoke'];
	if (in_array($pokeName, array_keys($salePokemon))) {
	
		$price = $salePokemon[$pokeName];
		if ($price > $userMoney) {
			echo '<div class="error">'.$lang['buypoke_01'].'</div>';
		} else {
			$userMoney -= $price;
			giveUserPokemonByName($uid, $pokeName, 5, $type);
			updateUserMoney($uid, $userMoney);
			
			echo '
				<div class="notice">
					<img src="images/pokemon/'.$type.$pokeName.'.png" /><br />
					'.$lang['buypoke_02'].' '.$type.$pokeName.'.
				</div>
			';
		}
	} else {
		echo '<div class="error">'.$lang['buypoke_03'].'</div>';
	}
}

$cells = array();
foreach ($salePokemon as $name => $price) {
	$cells[] = '
		<img src="images/pokemon/'.$type.$name.'.png" /><br />
		<input type="radio" name="buyPoke" value="'.$name.'" />
		'.$type.$name.'<br />
		$'.number_format($price).'<br />
	';
}


echo '
	<div style="text-align: center; margin: 30px auto; ">
		'.$lang['buypoke_04'].' $'.number_format($userMoney).'<br /><br />
		
		<a href="buy_pokemon.php">Normal</a> &bull;
		<a href="buy_pokemon.php?type=shiny">Shiny</a> &bull; 
		<a href="buy_pokemon.php?type=planet">Planet</a>
	</div>
	<form action="" method="post">
		<table class="pretty-table">
			'.cellsToRows($cells, 5).'
			<tr>
				<td colspan="5"><input type="submit" value="'.$lang['buypoke_05'].'"></td>
			</tr>
		</table>
	</form>
';

echo '</div>';
include '_footer.php';
?>



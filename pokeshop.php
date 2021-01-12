<?php
include('modules/lib.php');
include '_header.php';

?>
<?php

$test = off;
$uid = (int) $_SESSION['userid'];
$userCredits = getUserCredits($uid);

switch ($_GET['type']) {
	case 'shiny':
		$type = 'Shiny ';
	break;
	
	default:
		$type = '';
	break;
}

$defaultPrice = 100;
$salePokemon = array(
	'Arceus (Bug)'      => $defaultPrice,
	'Arceus (Dark)'     => $defaultPrice,
	'Arceus (Dragon)'   => $defaultPrice,
	'Arceus (Electric)' => $defaultPrice,
	'Arceus (Fighting)' => $defaultPrice,
	'Arceus (Fire)'     => $defaultPrice,
	'Arceus (Flying)'   => $defaultPrice,
	'Arceus (Ghost)'    => $defaultPrice,
	'Arceus (Grass)'    => $defaultPrice,
	'Arceus (Ground)'   => $defaultPrice,
	'Arceus (Ice)'      => $defaultPrice,
	'Arceus (Poison)'   => $defaultPrice,
	'Arceus (Psychic)'  => $defaultPrice,
	'Arceus (Rock)'     => $defaultPrice,
	'Arceus (Steel)'    => $defaultPrice,
	'Arceus (Unknown)'  => $defaultPrice,
	'Arceus (Water)'    => $defaultPrice,
	'Deoxys (Attack)'   => $defaultPrice,
	'Deoxys (Defence)'  => $defaultPrice,
	'Deoxys (Speed)'    => $defaultPrice,
	'Rotom (Cut)'       => $defaultPrice,
	'Rotom (Frost)'     => $defaultPrice,
	'Rotom (Heat)'      => $defaultPrice,
	'Rotom (Spin)'      => $defaultPrice,
	'Rotom (Wash)'      => $defaultPrice
);



if (isset($_POST['buyPoke'])) {

	$pokeName = $_POST['buyPoke'];
	if (in_array($pokeName, array_keys($salePokemon))) {
	
		$price = $salePokemon[$pokeName];
		if ($price > $userCredits) {
			echo '<div class="errorMsg">'.$lang['pokeshop_00'].'</div>';
		} else {
			$t = $userCredits -= $price;
			giveUserPokemonByName($uid, $pokeName, 100, $type);
			updateUserCredits($uid, $t);
			
			echo '
				<div class="actionMsg">
					<img src="images/pokemon/'.$type.$pokeName.'.png" /><br />
					'.$lang['pokeshop_01'].''.$type.$pokeName.'.
				</div>
			';
		}
	} else {
		echo '<div class="errorMsg">'.$lang['pokeshop_02'].'</div>';
	}
}

$cells = array();
foreach ($salePokemon as $name => $price) {
	$cells[] = '
		<img src="images/pokemon/'.$type.$name.'.png" /><br />
		<input type="radio" name="buyPoke" value="'.$name.'" />
		'.$type.$name.'<br />
		'.number_format($price).''.$lang['pokeshop_03'].'<br />
	';
}


echo '
	<div style="text-align: center; margin: 30px auto; ">
		'.$lang['pokeshop_04'].''.number_format($userCredits).' '.$lang['pokeshop_05'].'<br /><br />
		
		<a href="pokeshop.php">'.$lang['pokeshop_06'].'</a> &bull;
		<a href="pokeshop.php?type=shiny">'.$lang['pokeshop_07'].'</a>
	</div>
	<form action="" method="post">
		<table class="pretty-table">
			'.cellsToRows($cells, 5).'
			<tr>
				<td colspan="5"><input type="submit" value="'.$lang['pokeshop_08'].'"></td>
			</tr>
		</table>
	</form>
';
?>

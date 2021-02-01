<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

$uid = (int) $_SESSION['userid'];
$userMoney = getUserMoney($uid, $conn);

$query = "SELECT * FROM `shop_pokemon` ORDER BY `price` ASC";

if (numRows($query, $conn) == 0) {
    include '_header.php';
    echo '
        <div class="error">'.$lang['shop_poke_00'].'</div>
    ';
    include '_footer.php';
}

$salePokemon = array();
$categorys = array();
$defaultCat = '';

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    if (empty($defaultCat)) { $defaultCat = strtolower($row['category']); }
    if (!in_array($row['category'], $categorys)) { $categorys[] = $row['category']; }
    $salePokemon[ strtolower($row['category']) ][$row['name']] = $row['price'];
}

if (isset($_GET['cat']) && in_array(strtolower($_GET['cat']), array_keys($salePokemon))) {
    $salePokemon = $salePokemon[strtolower($_GET['cat'])];
} else {
    $salePokemon = $salePokemon[$defaultCat];
}

include '_header.php';
printHeader($lang['shop_poke_title']);

if (isset($_POST['buyPoke'])) {

	$pokeName = $_POST['buyPoke'];
	if (in_array($pokeName, array_keys($salePokemon))) {
	
		$price = $salePokemon[$pokeName];
		if ($price > $userMoney) {
			echo '<div class="error">'.$lang['shop_poke_01'].'</div>';
		} else {
			$userMoney -= $price;
			updateUserMoney($uid, $userMoney, $conn);
			giveUserPokemon($uid, $pokeName, 5, levelToExp(5), 'Scratch', 'Scratch', 'Scratch', 'Scratch', $conn);
            
			echo '
				<div class="notice">
					<img style="width:100px;" src="images/pokemon/'.$pokeName.'.png" /><br />
					'.$lang['shop_poke_02'].' '.$pokeName.'.
				</div>
			';
		}
	} else {
		echo '<div class="error">'.$lang['shop_poke_03'].'</div>';
	}
}

$cells = array();
foreach ($salePokemon as $name => $price) {
	$cells[] = '
		<img style="width:100px;" src="images/pokemon/'.$name.'.png" /><br />
		<input type="radio" name="buyPoke" value="'.$name.'" />
		'.$name.'<br />
		$'.number_format($price).'<br />
	';
}

$linksArray = array();
foreach ($categorys as $category) {
    $category = ucfirst( strtolower($category) );
    $linksArray[] = '<a href="?cat='.$category.'">'.$category.'</a>';
}
echo '
	<div style="text-align: center; margin: 10px auto; ">
		'.$lang['shop_poke_04'].' $'.number_format($userMoney).'<br /><br />
		'.implode(' &bull; ', $linksArray).'
	</div>
	<form action="" method="post">
		<table class="pretty-table">
			'.cellsToRows($cells, 3).'
			<tr>
				<td colspan="5"><input type="submit" class="smallbutton" value="'.$lang['shop_poke_05'].'"></td>
			</tr>
		</table>
	</form>
';

echo '</div>';
include '_footer.php';
?>



<?php
include('modules/lib.php');
Include '_header.php';
printHeader('Referral Centre');

$uid = $_SESSION['userid'];
$query = "SELECT * FROM `users` WHERE `id` = {$uid}";
$user = fetchArray($query, 2, $conn);
 ?>


<table align="center" class="pretty-table">
	<tr>
		<th>
<?php echo $lang['refl_maintxt'];?>
		</th>
	</tr>	
		
	<tr>
		<td>
			<?php echo $lang['refl_linktxt'];?>
		</td>
	</tr>	
	
	<tr>
		<td>
			https://pkmglobal.online/main.php?refReg=<?php echo $uid;?>
		</td>
	</tr>
</table>
<br />
<br />
<?php echo $lang['refl_points_count_01'];?> <?php echo $user['Referals'];?> <?php echo $lang['refl_points_count_02'];?>
<br />
<br />
<?php
$refPoints = $user['Referals'];

$query = "SELECT * FROM `shop_ref` ORDER BY `price` ASC";

if (numRows($query, $conn) == 0) {
    echo "<div class='error'>".$lang['refl_empty_shop']."</div>";
	die();
}

$salePokemon = array();
$categorys = array();
$defaultCat = '';

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    if (empty($defaultCat)) { $defaultCat = strtolower(isset($row['category'])); }
    if (!in_array(isset($row['category']), $categorys)) { $categorys[] = isset($row['category']); }
    $salePokemon[ strtolower(isset($row['category'])) ][$row['name']] = $row['price'];
}

if (isset($_GET['cat']) && in_array(strtolower($_GET['cat']), array_keys($salePokemon))) {
    $salePokemon = $salePokemon[strtolower($_GET['cat'])];
} else {
    $salePokemon = $salePokemon[$defaultCat];
}

if (isset($_POST['submit'])) {

	$pokeName = $_POST['submit'];
	if (in_array($pokeName, array_keys($salePokemon))) {
	
		$price = $salePokemon[$pokeName];
		if ($price > $refPoints) {
			echo "<div class='error'>".$lang['refl_no_refl']."</div>";
		} else {
			$refPoints -= $price;
			$conn->query("UPDATE `users` SET `Referals` = '{$refPoints}' WHERE `id` = '{$uid}'");
			giveUserPokemon($uid, $pokeName, 5, levelToExp(5), 'Tackle', 'Scratch', 'Ember', 'Leer');
            
			echo '
				<div class="notice">
					<img src="images/pokemon/'.$pokeName.'.png" /><br />
					You bought a '.$pokeName.'.
				</div>
			';
		}
	} else {
		echo "<div class='error'>".$lang['refl_not_sale']."</div>";
	}
}

$cells = array();
foreach ($salePokemon as $name => $price) {
	$cells[] = '
		<img style="width:100px;" src="images/pokemon/'.$name.'.png" /><br />
		<input type="radio" name="submit" value="'.$name.'" />
		'.$name.'<br />
		'.number_format($price).' Pontos<br />
	';
}
?>
	<form action="" method="post">
		<table class="pretty-table">
			<?php echo cellsToRows($cells, 3);?>
			<tr>
				<td colspan="5"><input class="smallbutton" type="submit" value="<?php echo $lang['refl_button'];?>"></td>
			</tr>
		</table>
	</form>

<?php include('_footer.php'); ?>
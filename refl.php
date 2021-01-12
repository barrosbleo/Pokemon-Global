<?php
include('modules/lib.php');
Include '_header.php';
printHeader('Referral Centre');

$uid = $_SESSION['userid'];
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = {$uid}"));
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
			http://pkmglobal.online/register.php?ref=<?php echo $uid;?>
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

$query = mysql_query("SELECT * FROM `shop_ref` ORDER BY `price` ASC");

if (mysql_num_rows($query) == 0) {
    echo "<div class='error'>".$lang['refl_empty_shop']."</div>";
	die();
}

$salePokemon = array();
$categorys = array();
$defaultCat = '';

while ($row = mysql_fetch_assoc($query)) {
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
			mysql_query("UPDATE `users` SET `Referals` = '{$refPoints}' WHERE `id` = '{$uid}'");
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
		<img src="images/pokemon/'.$name.'.png" /><br />
		<input type="radio" name="submit" value="'.$name.'" />
		'.$name.'<br />
		'.number_format($price).' Pontos<br />
	';
}
?>
	<form action="" method="post">
		<table class="pretty-table">
			<?php echo cellsToRows($cells, 5);?>
			<tr>
				<td colspan="5"><input type="submit" value="<?php echo $lang['refl_button'];?>"></td>
			</tr>
		</table>
	</form>

<?php include('_footer.php'); ?>
<?php
include('modules/lib.php');

error_reporting(-1);

if (!isLoggedIn()) {
	redirect('index.php');
}
include '_header.php';

printHeader($lang['5050_title']);

$uid = (int) $_SESSION['userid'];
$user1 = "SELECT * FROM `users` WHERE `id`='".$_SESSION['userid']."'";
$user = fetchObj($user1, $conn);

$_POST['multiple'] = abs((int) $_POST['multiple']);
$_POST['bet_id'] = $conn->real_escape_string($_POST['bet_id']);
$_POST['amount'] = abs((int) $_POST['amount']);
$_POST['amount'] = $conn->real_escape_string($_POST['amount']);
$minimum = $_POST['amount'];

if($_POST['multiple'] != "" && $_POST['multiple'] < 1){echo Message($lang['5050_00']);$error = 1;}
if($_POST['multiple'] != "" && $_POST['multiple'] > 5){echo Message($lang['5050_00']);$error = 1;}

if ($_POST['takebet'] != ""){
$_POST['bet_id'] = abs((int) $_POST['bet_id']);

$result = "SELECT * FROM `5050` WHERE `id`='".$_POST['bet_id']."'";
$worked = fetchArray($result, 2, $conn);
$amount = $worked['money'];

if ($worked['id'] < 1){echo  $lang['5050_01'];$error = 1;}

if($worked['money'] > 0){
if ($worked['uid'] == $user->id) { echo $lang['5050_02'];$error = 1;}
if ($amount > $user->money) { echo $lang['5050_03'];$error = 1;}

	if($error != 1){
		$conn->query("DELETE FROM `5050` WHERE `id`='".$worked['id']."'");
		$winner = rand(1,2);
		$win = $worked['money'];

		if($winner == 1){
			$user->money = $user->money - $amount;
			echo $lang['5050_04'];
			$conn->query("UPDATE `users` SET `money` = `money` - $amount WHERE `id`='$user->id'");
			
			$amount = $amount * 2;
			$conn->query("UPDATE `users` SET `money` = `money` + $amount WHERE `id`='".$worked['user']."'");
		} else {
			$user->money = $user->money + $amount;
			echo $lang['5050_05'];
			$conn->query("UPDATE `users` SET `money` = `money` + $amount WHERE `id`='$user->id'");
		}
	}

}
}


if ($_POST['makebet']){

$dalimit1 = "SELECT id FROM `5050` WHERE `uid` = '$user->id'";
$dalimit = numRows($dalimit1, $conn);

if($dalimit > 9){echo $lang['5050_06'] ;$error = 1;}

if($_POST['type'] == 1){
$_POST['amount'] = abs((int) $_POST['amount']);
$_POST['multiple'] = abs((int) $_POST['multiple']);

$checka = $_POST['amount'];

if($_POST['multiple'] > 1){$checka = $_POST['amount'] * $_POST['multiple'];}
if($checka > $user->money){echo  $lang['5050_07'];$error = 1;}
if($minimum < 1000){echo $lang['5050_08'];$error = 1;}
if (!preg_match('~^[a-z0-9 ]+$~i', $_POST['amount'])){echo  $lang['5050_09'];$error = 1;}
if (!preg_match('~^[a-z0-9 ]+$~i', $_POST['multiple'])){echo  $lang['5050_09'];$error = 1;}

if($error != 1){
$i = 0;
$mbid = $_POST['multiple'];

while($i<$mbid){ 
$i++;
$result = $conn_query("INSERT INTO `5050` (uid, money)"."VALUES ('$user->id', '".$_POST['amount']."')");
}

$conn->query("UPDATE `users` SET `money` = `money` - $checka WHERE `id`='$user->id'");
//".$_POST['multiple']." bets of
if($checka > 1){
echo  $lang['5050_10']." $".number_format($_POST['amount'])."";	
}else{
echo  $lang['5050_10']." $".number_format($_POST['amount'])."";	
}
}

}
}

if($_POST['remove'] != "" && $ivedisabledremovefornow == 1){
$_POST['bet_id'] = abs((int) $_POST['bet_id']);
$_POST['bet_id'] = $conn->real_escape_string($_POST['bet_id']);

$result = "SELECT * FROM `5050` WHERE `id`='".$_POST['bet_id']."' AND `uid` = '$user->id'";
$worked = fetchObj($result, $conn);

if($worked->user != $user->id){
echo  $lang['5050_11'];
$error = 1;
}

if($error != 1){
$newgold = $user->money + $worked->money;
$result = $conn->query("UPDATE `users` SET `money` = '".$newgold."' WHERE `id`='$user->id'");
$result = $conn->query("DELETE FROM `5050` WHERE `id`='".$worked->id."'");
echo $lang['5050_12'];
}
}
?>

<div class="help">
	<p><?php echo $lang['5050_13'];?></p>
	<?php echo $lang['5050_14'];?><br>
	<?php echo $lang['5050_15'];?>
</div>

<table class="pretty-table">
<form method='post' onsubmit="return addbet();">
	<tr>
		<th><?php echo $lang['5050_16'];?></th>
		<td colspan="2">
			<input type='text' class='textarea' name='amount' size='50' maxlength='15' placeholder="<?php echo $lang['5050_17'];?>">
		</td>
	</tr>

	<tr style="display:none;">
		<th><?php echo $lang['5050_18'];?></th>
		<td>
			<select name="type" onchange="checko(this.value)"> 
				<option value="1"><?php echo $lang['5050_19'];?></option>
			<select>
		</td>
		<td></td>
	</tr>

	<tr style="display: none;">
		<th><?php echo $lang['5050_20'];?></th>
		<td>
			<select name="multiple"> 
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
		</td>
		<td></td>
	</tr>

	<tr id="theform">
		<th colspan="3">
			<input type='submit' class='button' name='makebet' value='Make Bet'>

		</th>
	</tr>
	
</form>

	<tr>
		<th><?php echo $lang['5050_21'];?></th>
		<th><?php echo $lang['5050_22'];?></th>
		<th><?php echo $lang['5050_23'];?></th>
	</tr>
<?php
	$result = "SELECT * FROM `5050` WHERE `money` != 0  ORDER BY `money` DESC";
	$return = $conn->query($result);
	while($line = $return->fetch_array(MYSQLI_ASSOC)) {
		$other1 = "SELECT id, username from `users` WHERE `id`='".$line['uid']."' LIMIT 0,1";
		$other = fetchObj($other1, $conn);

		$value = "takebet";
		$value2 = $lang['5050_25'];

		if($line['user'] == $user->id){
			$value = "takebet";
			$value2 = $lang['5050_25'];
		}

		$moneyon = number_format($line['money']);
		echo "<form method='post'>";
		echo "<tr>
				<td align=center>
					<a href='profile.php?id=".$other->id."'>".$other->username."</a>
				</td>
				
				<td align=center>
					$".$moneyon." ".$lang['5050_24']."
				</td>
				
				<td align=center>
					<input type='hidden' name='bet_id' value='".$line['id']."'> 
					<input type='submit' class='button' name='".$value."' value='".$value2."'>
				</td>
			</tr>
		</form>";
}
?>
</table>



<style>
#content .adsbygoogle {
	display: none !important;
}

.help p {
	font-size: 18px;
}
.help {
	width: 50%;
	padding: 10px;
	background: #2B41A9;
	border-radius: 2px;
	margin: 10px;
	text-align: left;
}
</style>

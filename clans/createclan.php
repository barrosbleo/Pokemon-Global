<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '../_header.php';
printHeader('Create a clan');

$uid = (int) $_SESSION['userid'];
$userQuery = "SELECT * FROM users WHERE id = '$uid'";
$user = fetchArray($userQuery, 2, $conn);
$user2Query = "SELECT money FROM users WHERE id = '$uid'";
$user2 = fetchArray($user2Query, 2, $conn);
$money = $user2['money'];
$username = $user['username'];

if ($user['clan'] != 0){
echo '<div class="error">To create a clan you must leave your current one.</div>';
include '../_footer.php';
die();
}

$_POST['name'] = $_POST['name'];

if($_POST['create'] != "")
{ // if they are wanting to start a new clan
	$error .= ($money < 1000000) ? "You don't have enough coins to start a clan. You need at least 1,000,000 money.<br>" : "";
	$error .= ($user['clan'] = 0) ? "You have to leave your clan to start a new clan.<br>" : "";
	$error .= (strlen($_POST['name']) < 4) ? "Your clan's name has to be at least 4 characters long.<br>" : "";
	$error .= (strlen($_POST['name']) > 20) ? "Your clan's name can only be a max of 20 characters long.<br>" : "";

if (!preg_match('~^[a-z0-9 ]+$~i', $_POST['name']))
{
$error .= "Special characters in your clan name isn't allowed.<br>";
}

	//check if name is taken yet
	$check = "SELECT * FROM `clans` WHERE `name`='".$_POST['name']."'";
	$exist = numRows($check, $conn);
	$error .= ($exist > 0) ? "Sorry. The clan name you chose is already taken.<br>" : "";

$time = time();

	if($error == ""){ // if there are no errors, make the clan
		$result = "INSERT INTO `clans` (name, owner, owner_id, time) VALUES ('".$_POST['name']."', '$username', '$uid', '".$time."')";
		$conn->query($result);
		$newcoins = $user['money'] - 1000000; //deduct the cost of the coins
        $result = "SELECT * FROM `clans` WHERE `owner` = '$username'";
		$worked = fetchArray($result, 2, $conn);
		$clanid = $worked['id'];

		$result = "UPDATE `users` SET `clan` = '$clanid', `money` = '".$newcoins."' WHERE `id`='$uid'";
		$conn->query($result);
		echo '<div class="success">You have successfully created your clan!</div>';
    } else {
if($error != ""){
    	echo '<div class="error">'.$error.'</div>';
}
    }
}

?>
<?php echo 'Your money: '.number_format($money).''; ?>
<center>
	<br/>
	Making a clan will cost you no more then $1,000,000 if you do not have this amount I suggest you start saving up.
<form method='post'>

<form name='login' method='post' action='/clans/createclan.php'>
  <table border='0' cellpadding='0' cellspacing='0'  style="margin: 10px auto;" class="pretty-table">
        <tr> 
      <td width='35%' height='27'>Clan Name: &nbsp; </td>
      <td width='65%'>
         <input name='name' type='text' size='22'>
    	</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>
<br>
<input type='submit' name='create' value='Create' class='button'>
        </td>
    </tr>
  </table>
</form>

<br><br></center>
<?
	include '../_footer.php'; 
?>
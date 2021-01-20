<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('/index.php');
}

include '../_header.php';
printHeader('Accept Members');

$result1 = "SELECT * FROM `users` WHERE `id` = '".$_SESSION['userid']."'";
$user = fetchArray($result1, 2, $conn);
$uclan = $user['clan']; 
$clan1 = "SELECT * FROM `clans` WHERE `id`='$uclan'";
$clan = fetchArray($clan1, 2, $conn);
$cowner = $clan['owner_id'];

if ($cowner != $_SESSION['userid']){
	echo "<div class='error'>You do not have authorization to be here.</div>";
	die();
}


if ($_GET['accept'] !=""){
$_GET['accept'] = (int) $_GET['accept'];

$from_user1 = "SELECT * FROM `users` WHERE `id`='".$_GET['accept']."'";
$from_user = fetchObj($from_user1, $conn);
$from_user2 = "SELECT * FROM `applications` WHERE `userid`='".$_GET['accept']."'";
$from_users = fetchObj($from_user2, $conn);


		$checkifapp = "SELECT * from `applications` WHERE `clanid` = '$uclan' AND `userid` = '".$from_user->id."'";
		$username_exist2 = numRows($checkifapp, $conn));

		$result = $conn->query("DELETE FROM `applications` WHERE `userid`='".$from_user->id."' AND `clanid`='$uclan'");

        $to = $from_user->id;
		$clan = $uclan;

		$checkuser = "SELECT `id` FROM `users` WHERE `id`='".$from_user->id."'";
		$username_exist = numRows($checkuser, $conn);
		


		if($username_exist > 0 && $username_exist2 > 0 && $from_user->clan == 0){
		  $result = $conn->query("UPDATE `users` SET `clan`='".$from_users->clanid."', `clanxp` = '0' WHERE `id`='".$from_user->id."'");
		 echo "<a href='/profile.php?id=".$from_user->id."'>".$from_user->username."</a> has been added to the clan.";

		}
		if ($username_exist == 0 || $username_exist2 == 0){
		  echo 'Invalid user.';
		}
		if ($from_user->clan != 0){
		  echo '<div class="error">This user is already in a clan.</div>';
		}


        $conn->query("UPDATE `clans` SET `members` = `members` + 1 WHERE `id`='$uclan'");


	}
if ($_GET['deny'] !=""){
$_GET['deny'] = (int) $_GET['deny'];
$from_user1 = "SELECT * FROM `users` WHERE `id`='".$_GET['deny']."'";
$from_user = fetchObj($from_user1, $conn);


$result = $conn->query("DELETE FROM `applications` WHERE `userid`='".$from_user->id."'");
echo "<div class='success'>You have declined the users request.</div>";
}
?>
<table class='pretty-table'>
<tr>
<th>Trainer #</th>
<th>Applicant</th>
<th>Reason</th>
<th>Accept</th>
<th>Deny</th>
</tr>

<?php

$result = "SELECT * FROM `applications` WHERE `clanid` = '$uclan' ORDER BY `id` ASC";
$return = $conn->query($result);
	while($row = $return->fetch_array(MYSQLI_ASSOC)){

$from_user1 = "SELECT * FROM `users` WHERE `id`='".$row['userid']."'";
$from_user = fetchObj($from_user1, $conn);

$row['reason'] = stripslashes($row['reason']);
    echo "

						<tr>

<td>".$row['userid']."</td>

<td><a href='/profile.php?id=".$from_user->id."'>".$from_user->username."</a></td>

<td>".$row['reason']."</td>

<td>[<a href='/clans/jusers.php?accept=".$row['userid']."'>Accept</a>]</td>
<td>[<a href='/clans/jusers.php?deny=".$row['userid']."'>Deny</a>]</td>

</tr>
";

}
?>
</table>
</div>
<?php
include '../_footer.php';
?>
<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '../_header.php';
printHeader('View Clan');
include '../bbcode.php';


$query = "SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'";
$user = fetchArray($query, 2, $conn);
$myclan = $user['clan'];

$_GET['id'] = abs((int) $_GET['id']);

$_GET['id'] = $conn->real_escape_string($_GET['id']);

$clan1 = "SELECT * FROM `clans` WHERE `id`='".$_GET['id']."'";
$clan_class = fetchObj($clan1, $conn);

if($clan_class->id == ""){
	echo "<div class='error'>The clan you were looking for was not found in our database.</div>";
	include '../_footer.php';
	die();
}

$leader1 = "SELECT * FROM `users` WHERE `username`='".$clan_class->owner."'";
$leader = fetchObj($leader1, $conn);
$app1 = "SELECT * FROM `applications` WHERE `userid`='$uid'";
$app = fetchObj($app1, $conn);



if($_POST['apply'] != "" && $user->clan == 0 && $app->userid < 1) {

$_POST['reason'] = strip_tags($_POST['reason']);
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);

  $clanid = $clan_class->id;

  $userid = $user['id'];
 
  $u = $user['username'];

  $reason = ($_POST['reason']);

$time = time();

    $result= $conn->query("INSERT INTO `applications` (`clanid`, `userid`, `name`, `reason`)".

      "VALUES ('$clanid', '$uid', '$u', '$reason')");

Send_Event($leader->id, "".$user->id." has sent an request to join your clan.");

      echo "<div class='success'>Your application is pending and if accepted you will be added.</div>";

}

if($_GET['del'] == "req"){
$conn->query("DELETE FROM `applications` WHERE `userid`='$user->id'");
$text = "".$user->id." has sent an application for your clan.";
$conn->query("DELETE FROM `events` WHERE `text`='$text'");
echo "<div class='success'>Your existing request has been removed.</div>";
}
if($_GET['opt'] == "req" && $app->userid = $user->id) {
echo"<div class='error'>test2</div>";
include '../_footer.php';
die();
}
if($_GET['opt'] == "req" && $myclan != 0) {
echo"<div class='error'>You are already in a clan, please leave your existing clan in order to join a new one.</div>";
include '../_footer.php';
die();
}

if($_GET['opt'] == "req" && $_GET['del'] != "app" && $app->userid < 1){
}
?>
<center><br>
<?
if($_GET['opt'] == "req" && $user->clan <= 0 ){
?>
<form method='post'>
Reason:<br>
<textarea name='reason' cols='53' row='7'></textarea><br><br>
<input type='submit' class='longbutton' name='apply' value='Apply for clan'>
</form>
<br><br></center>
</div>
<? include'../_footer,php'; die(); } ?>
<h1><? echo $clan_class->name; ?></h1><br >
<table>
<tr><th>Clan Information</th>
</tr>
<tr><td>
<img src="<? echo $clan_class->image; ?>" style="max-height: 120px; max-width: 120px;" />
</td></tr>
<tr><td>
      <?
if ($clan_class->description !== ""){



echo bbcode($clan_class->description);

}else{
?>
Welcome to <? echo $clan_class->name; ?>.
<?
}
?>
</td></tr>
</table>
<br>
<table width="150px"><tr><th>Clan STATS</th></tr></table><table  class="pretty-table">
<tr><th>Clan Leader:</th> <td><? echo $clan_class->owner; ?></td></tr>
<tr><th> Total Money:</th><td><? echo $clan_class->money; ?> </td></tr>
<tr><th>Total Members:</th><td> <? echo $clan_class->members; ?></td></tr></table>
<br /><h1><a href="/clans/vclan.php?id=<?php echo"".$clan_class->id."";?>&opt=req">Try apply to <? echo $clan_class->name; ?></a></h1>
<br>

<table  class="pretty-table">
<tr>
<th>Trainer #</th>
<th>Username</th>
<th>Clan EXP</th>
</tr>
<?
$query = "SELECT * FROM `users` WHERE `clan` = '".$_GET['id']."' ORDER BY `clanxp` DESC";
$result = $conn->query($query);
while($line = $result->fetch_array(MYSQLI_ASSOC)) {
$clan1 = "SELECT * FROM `clans` WHERE `owner` = '".$clan_class->owner."'";
$clan = fetchArray($clan1, 2, $conn);
$cowner = $clan['owner'];

?>
<tr align=center>

<td><?= $line['id']; ?></td>
<td><a href="/profile.php?id=<?= $line['id']; ?>">
<?php 
if($clan_class->owner == $line['username']){
echo $line['username']." <font color=red>[Owner]</font>";
}else{
echo "".$line['username']."</a></td>";
}
?>
<td><?= number_format($line['clanxp']); ?></td>
<?
}
?>
</table>

</div>
<?php include '../_footer.php'; ?>
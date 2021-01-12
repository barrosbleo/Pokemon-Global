<?php
include('../modules/lib.php');
include '_header.php';

$result1 = mysql_query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'");
$user = mysql_fetch_array($result1);



$clan1 = mysql_query("SELECT * FROM `clans` WHERE `id`='$user->clan'");

$clan_class = mysql_fetch_object($clan1);

$_GET['kick'] = mysql_real_escape_string($_GET['kick']);

if($_GET['kick'] != ""){

if ($clan_class->leader != $user->username){
	echo Message("You do not have permission to kick.");
	include 'rightmenu.php';
	die();
}

$from1 = mysql_query("SELECT * FROM `users` WHERE `clan`='$user->clan' AND `id`='".$_GET['kick']."'");
$from_user = mysql_fetch_object($from1);

if($from_user->clan != $user->clan){
echo Message("Invalid User.");
$errorz = 1;
}

if($from_user->id == $user->id){
echo Message("You can't kick yourself... Silly buns...");
$errorz = 1;
}

if (!preg_match('~^[a-z0-9 ]+$~i', $_GET['kick'])){
echo Message("Please don't enter special characters.");
$errorz = 1;
}

if($errorz != 1){

$result = mysql_query("UPDATE `users` SET `clan`='0' WHERE `id`='".$from_user->id."'");

echo Message("You've just kicked <a href='prof.php?user=".$from_user->username."'>".$from_user->username."</a> out of your clan.");

send_event($from_user->id, "You have just been kicked out of [clanf]".$clan_class->id."[/clanf]!");
}

<?php
}

$_GET['leader'] == $_POST['nleader'];


if($_POST['nleader'] != "" && $_POST['nleader'] != ""){
if ($clan_class->leader != $user->username){
	echo Message("You do not have permission to appoint a new leader.");
	include 'rightmenu.php';
	die();
}

$from1 = mysql_query("SELECT * FROM `users` WHERE `clan`='$user->clan' AND `id`='".$_POST['nleader']."'");
$from_user = mysql_fetch_object($from1);

if($from_user->clan != $user->clan){
echo Message("Invalid User.");
$errorz = 1;
}

if($from_user->id == $user->id){
echo Message("You're already the leader of this clan.");
$errorz = 1;
}

if (!preg_match('~^[a-z0-9 ]+$~i', $_POST['nleader'])){
echo Message("Please don't enter special characters.");
$errorz = 1;
}

if($errorz != 1){

$result = mysql_query("UPDATE `clans` SET `leader`='".$from_user->username."' WHERE `id`='".$user->clan."'");

echo Message("You've just appointed <a href='prof.php?user=".$from_user->username."'>".$from_user->username."</a> as the new leader of your clan.");

send_event($from_user->id, "You have been promoted to the leader of the clan [clanf]".$clan_class->id."[/clanf]!");
}

}
?>
<div class="title">Manage Clan Members</div>
<div class="contentcontent">
<table class="ranks">
<tr>
<th>Trainer #</th>
<th>Username</th>
<th>Clan Rank</th>
<th>Clan XP Gained</th>
<?
if ($clan_class->leader == $user->username){
?>
<th>Kick</th>

<th>Make Leader</th>
<?
}
?>
</tr>
<?
$result = mysql_query("SELECT * FROM `users` WHERE `clan` = '".$user->clan."' ORDER BY `clanxp` DESC");

while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

$from2 = mysql_query("SELECT * FROM `clanranks` WHERE `clanid`='".$user->clan."' AND `userid`='".$line['id']."'");
$from_clan = mysql_fetch_array($from2);

if($from_clan->rank == ""){
$from_clan->rank = " -- ";

if($clan_class->rank != ""){
$from_clan->rank = $clan_class->rank;
}

}
?>
<tr align=center>
<td><?= $line['id']; ?></td>
<td><a href="prof.php?user=<?= $line['username']; ?>"><?= $line['username']; ?></a></td>
<td><?= $from_clan->rank; ?></td>
<td><?= number_format($line['clanxp']); ?></td>
<?
if ($clan_class->leader == $user->username){
?>
<td>[<a href="clanmembers.php?kick=<?= $line['id']; ?>&token=<? echo $token; ?>" onCLick="return confirm('Are you sure you want to kick <?= $line['username']; ?>?')" target="_parent">Kick</a>]</td>
<td>[<a href="clanmembers.php?leader=<?= $line['id']; ?>&token=<? echo $token; ?>" onCLick="return confirm('Are you sure you want to make <?= $line['username']; ?> the new leader of your clan?')" target="_parent">Make Leader</a>]</td>
<?
}
}
?>
</table>
<?php
include '_footer.php';
?>
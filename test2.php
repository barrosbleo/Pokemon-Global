
Apex `ip` ADDRESS
<hr>
<br>
<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}
$uid = (int) $_SESSION['userid'];

$ip = mysql_query("select * from users where ip = '123.2.235.164'");

$count = mysql_num_rows($ip);

echo 'IP: 123.2.235.164<br><br>IP count: '.$count.'<br><br>IP users:<br>';

while($see = mysql_fetch_array($ip)) {
	echo $see['username'].'<br>';
} 
?>
<br>
<br>
<br>
MY `ip2` NEW ADDRESS
<hr>
<br>
<?php
$newip = $_SERVER['REMOTE_ADDR'];

$ip2 = mysql_query("select * from users where ip = '$newip'");

$count2 = mysql_num_rows($ip2);

echo 'IP: '.$newip.'<br><br>IP count: '.$count2.'<br><br>IP users:<br>';

while($see2 = mysql_fetch_array($ip2)) {
	echo $see2['username'].'<br>';
} 
?>


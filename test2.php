
Apex `ip` ADDRESS
<hr>
<br>
<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}
$uid = (int) $_SESSION['userid'];

$ip = "select * from users where ip = '123.2.235.164'";

$count = numRows($ip, $conn);

echo 'IP: 123.2.235.164<br><br>IP count: '.$count.'<br><br>IP users:<br>';

while($see = fetchArray($ip, 2, $conn)) {
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

$ip2 = "select * from users where ip = '$newip'";

$count2 = numRows($ip2, $conn);

echo 'IP: '.$newip.'<br><br>IP count: '.$count2.'<br><br>IP users:<br>';

while($see2 = fetchArray($ip2, 2, $conn)) {
	echo $see2['username'].'<br>';
} 
?>


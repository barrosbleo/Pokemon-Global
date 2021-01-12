<?php
include('modules/lib.php');
/*
$data = mysql_query("select * from user_logins where uid = 114431 order by id DESC");

while($see = mysql_fetch_array($data)) {
	//echo $see['ip'].'<br>';
}

if(isset($_GET['update'])) {
	$pid = array(895045, 895043, 895044, 890355, 895063, 895064, 895065, 895070);
	$pid2 = implode(',',$pid);
	//mysql_query("UPDATE `user_pokemon` SET `uid` = 3 WHERE `id` IN ($pid2)") or die();
	echo '...updating now...';
}
*/

$path = dirname(__FILE__);

$file = $path.'/test2.php';

if(file_exists($file)) echo 'file exists';
<?php
include('modules/lib.php');

if (!isLoggedIn()) {
redirect('login.php');
}

$uid = (int) $_SESSION['userid'];

include '_header.php';

echo '
<center> 
<a href="notif.php?clear">'.$lang['notif_00'].'</a><br /><br />
</center>
';

$conn->query("UPDATE `events` SET `viewed`='1' WHERE `to`='{$uid}'");

if (isset($_GET['clear'])) {
$conn->query("DELETE FROM `events` WHERE `to`='$uid'");
}

$query = "SELECT * FROM `events` WHERE (`to`='{$uid}') ORDER BY `timesent` DESC";
 
if (numRows($query, $conn) == 0) {
echo '<div class="info">'.$lang['notif_01'].'</div>';
} else {
	$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
echo '<table><tr><td>'.$row['text'].' '.$lang['notif_02'].' '.date(F.' '.d.', '.Y.' '.g.':'.i.':'.sa,$row['timesent']).'.<br /></td></tr></table>';
}
}
echo '
</div>
</div>
';

include '_footer.php';
?>
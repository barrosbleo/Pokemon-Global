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

mysql_query("UPDATE `events` SET `viewed`='1' WHERE `to`='{$uid}'");

if (isset($_GET['clear'])) {
mysql_query("DELETE FROM `events` WHERE `to`='$uid'");
}

$query = mysql_query("SELECT * FROM `events` WHERE (`to`='{$uid}') ORDER BY `timesent` DESC");
 
if (mysql_num_rows($query) == 0) {
echo '<div class="info">'.$lang['notif_01'].'</div>';
} else {
while ($row = mysql_fetch_assoc($query)) {
echo '<table><tr><td>'.$row['text'].' '.$lang['notif_02'].' '.date(F.' '.d.', '.Y.' '.g.':'.i.':'.sa,$row['timesent']).'.<br /></td></tr></table>';
}
}
echo '
</div>
</div>
';

include '_footer.php';
?>
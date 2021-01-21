<?php
include('modules/lib.php');

if (!isLoggedIn()) {
redirect('login.php');
}

$uid = (int) $_SESSION['userid'];

include '_header.php';

echo '
<center>
<a href="send_money.php">'.$lang['send_money_h_00'].'</a> &bull; 
<a href="send_money_history.php?clear">'.$lang['send_money_h_01'].'</a><br /><br />
</center>
';

$conn->query("UPDATE `send_money_history` SET `seen_by_recipient`='1' WHERE `recipient_uid`='{$uid}'");

if (isset($_GET['clear'])) {
$conn->query("UPDATE `send_money_history` SET `deleted_by_recipient`='1' WHERE `recipient_uid`='{$uid}'");
$conn->query("UPDATE `send_money_history` SET `deleted_by_sender`='1' WHERE `sender_uid`='{$uid}'");
$conn->query("DELETE FROM `send_money_history` WHERE `deleted_by_sender`='1' AND `deleted_by_recipient`='1'");
}

$query = "SELECT * FROM `send_money_history` WHERE (`sender_uid`='{$uid}' AND `deleted_by_sender`='0') OR (`recipient_uid`='{$uid}' AND `deleted_by_recipient`='0') ORDER BY `timestamp` DESC";
 
if (numRows($query, $conn) == 0) {
echo '<div class="info">'.$lang['send_money_h_02'].'</div>';
} else {
	$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
if ($row['sender_uid'] == $uid) {
echo '<table><tr><td>'.$lang['send_money_h_03'].' $' . number_format($row['amount']) . ' '.$lang['send_money_h_04'].' ' . cleanHtml($row['recipient']) . '.<br /></td></tr></table>';
} else {
echo '<table><tr><td>'.$lang['send_money_h_05'].' $' . number_format($row['amount']) . ' '.$lang['send_money_h_06'].' ' . cleanHtml($row['sender']) . '.<br /></td></tr></table>';
}
}
}
echo '
</div>
</div>
';

include '_footer.php';
?>
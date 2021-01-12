<?php
include('modules/lib.php');
require 'banned.php'; 

if (!isLoggedIn()) {
redirect('login.php');
}

$pid   = (int) $_GET['id'];
$uid   = (int) $_SESSION['userid'];
$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' AND `uid`='{$uid}' LIMIT 1");

if (mysql_num_rows($query) == 0) {
die($lang['change_atk_00']);
}

$pokemon   = mysql_fetch_assoc($query);
$userMoney = getUserMoney($uid);

// function used to calculate the price of moves
function powerToPrice($power) {
return ($power*100) + 250;
}

include '_header.php';
printHeader($lang['change_atk_title']);


if (isset($_POST['sid'], $_POST['mid'])) {
$sid = (int) $_POST['sid'];
$mid = (int) $_POST['mid'];

$query = mysql_query("SELECT * FROM `moves` WHERE `id`='{$mid}' LIMIT 1");

if (!in_array($sid, range(1,4)) || mysql_num_rows($query) == 0) {
echo '<div class="error">'.$lang['change_atk_01'].'</div>';
} else {
$moveRow = mysql_fetch_assoc($query);
$price = powerToPrice($moveRow['power']);

if ($userMoney < $price) {
echo '<div class="error">'.$lang['change_atk_02'].'</div>';
} else {
$sqlMoveName = cleanSql($moveRow['name']);
mysql_query("UPDATE `user_pokemon` SET `move{$sid}`='{$sqlMoveName}' WHERE `id`='{$pid}' LIMIT 1");
mysql_query("UPDATE `users` SET `money`=`money`-{$price} WHERE `id`='{$uid}' LIMIT 1");

echo '
<div class="notice">
'.$lang['change_atk_03'].' '.$pokemon['name'].' '.$lang['change_atk_04'].' '.$pokemon['move'.$sid].' '.$lang['change_atk_05'].' '.$moveRow['name'].'!
</div>
';

$pokemon['move'.$sid] = $moveRow['name'];
$userMoney -= $price;
}
}
}


$query = mysql_query("SELECT * FROM `moves` ORDER BY `type` ASC, `power` DESC");
$allMoves = array();

// order the moves by type
while ($move = mysql_fetch_assoc($query)) {
$allMoves[$move['type']][] = $move;
}

echo '
<form action="" method="post" style="text-align: center;">
<br /><br />
'.$lang['change_atk_06'].' $'.number_format($userMoney).'.
<br /><br />
<img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
'.$pokemon['name'].'<br /><br />

<table class="padded-table" style="margin: 0 auto;">
<tr>
<td><input type="radio" name="sid" value="1" /></td>
<td>'.$pokemon['move1'].'</td>
</tr>
<tr>
<td><input type="radio" name="sid" value="2" /></td>
<td>'.$pokemon['move2'].'</td>
</tr>
<tr>
<td><input type="radio" name="sid" value="3" /></td>
<td>'.$pokemon['move3'].'</td>
</tr>
<tr>
<td><input type="radio" name="sid" value="4" /></td>
<td>'.$pokemon['move4'].'</td>
</tr>
</table>
<hr style="width: 50%; margin: 30px auto;" />
';

$jsonArray = array();
foreach ($allMoves as $type => $moves) {
$id = strtolower($type).'-table';
$jsonArray[] = array('id'=>$id, 'numMoves'=>count($moves));
echo '
<table class="no-border-table pretty-table" style="width: 300px; margin: 10px auto;" id="'.$id.'">
<tr>
<th colspan="3" class="type '.strtolower($type).'">'.$type.'</th>
</tr>
';

foreach ($moves as $move) {
$price = powerToPrice($move['power']);
echo '
<tr>
<td><input type="radio" name="mid" value="'.$move['id'].'" /></td>
<td>'.$move['name'].'</td>
<td>$'. $price .'</td>
</tr>
';
}

echo '
<tr style="display: none;">
<td colspan="3">
<a href="" style="font-size: 12px;" onclick="showMoves(\''.$id.'\'); return false;">'.$lang['change_atk_07'].' ('.  (count($moves)-10) . ' '.$lang['change_atk_08'].')</a>
</td>
</tr>
';

echo '</table>';
}
echo '
<br /><br /><input type="submit" value="'.$lang['change_atk_09'].'" /><br /><br /></form>

<script>
function showMoves(parentId) {
var rows = document.querySelectorAll(\'#\'+ parentId +\' tr\');

for (var j=0; j<rows.length; j++) {
rows[j].style.display = \'\';
}

// hide the last row
var lastTr = rows[ rows.length-1 ];
lastTr.style.display = \'none\';
}

function hideSomeMoves() {
var moveArray = '.json_encode($jsonArray).';

for (var i=0; i<moveArray.length; i++) {
if (moveArray[i].numMoves > 10) {
var rows = document.querySelectorAll(\'#\'+ moveArray[i].id +\' tr\');

// start at 11 because we have 10 moves and the header
for (var j=11; j<=moveArray[i].numMoves; j++) {
rows[j].style.display = \'none\';
}

// show the link that shows the hidden moves
var lastTr = rows[ rows.length-1 ];
lastTr.style.display = \'\';
}
}
}
hideSomeMoves();
</script>
';


include '_footer.php';
?>
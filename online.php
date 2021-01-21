<?php 
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php'; 
printHeader($lang['online_title']);

$uid = (int) $_SESSION['userid'];
$time = time();
$otime = $time - (60*60);

/// just an test -- >
if (isset($_GET['get'])) {
	echo date('h:i:s A',$_SESSION['lastseen']);
	die();
}
/// < -- end of test

$query = "SELECT * FROM `users` WHERE `lastseen`>='{$otime}' ORDER BY `lastseen` DESC";
$rows = numRows($query, $conn);

if (getConfigValue('most_online', $conn) < $rows ) {
	setConfigValue('most_online', $rows);
}

echo "<center>
		<font color=white>
			".$lang['online_00']." ".$rows."<br />
			".$lang['online_01']." ".getConfigValue('most_online', $conn)."<br /><br />
		</font>
	</center>"; 
echo '		
                        <table class="pretty-table">
                          
                                <tr>                                 
                                    <th>'.$lang['online_02'].'</th>
                                    <th>'.$lang['online_03'].'</th>
                                    <th>'.$lang['online_04'].'</th>
                                    <th>'.$lang['online_05'].'</th>
                                </tr>

                           
';
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
	$lastseenMins = floor(($time-$row['lastseen'])/60);
	$lastseenSecs = ($time-$row['lastseen'])%60;
	$lastseenStr = $lastseenMins > 0 ? $lastseenMins.''.$lang['online_06'].' ' : '' ;
	$lastseenStr .= $lastseenSecs.''.$lang['online_07'].'';

	echo '
		<tr>
			<td class="pad">'.$row['id'].'</td>
			<td class="pad"><a href="profile.php?id='.$row['id'].'"><b>'.htmlspecialchars($row['username']).' '.$row['rank'].'</a></td></b></font>
			<td class="pad">'.$lastseenStr.'</td>
			<td class="pad">
				<a href="battle_user.php?id='.$row['id'].'">'.$lang['online_08'].'</a> - <a href="view_box.php?id='.$row['id'].'">'.$lang['online_09'].'</a>
			</td>
		</tr>
	';
}
echo '</table>';
?>



	<?php include ('_footer.php'); ?>
	
	<div>
	</section>
	</div>
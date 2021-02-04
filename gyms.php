<?php ob_flush(); ?>
<?php
include('modules/lib.php');
require_once 'gym_functions.php';

if (!isLoggedIn()) {
redirect('login.php');
}
if (isset($_GET['leader'])) {
	$leader = $_GET['leader'];
	$leaderArray = getLeadersPokemonAndBadge($leader);
	
	if ($leaderArray !== false) {
		$i = 0;
		foreach ($leaderArray['pokemon'] as $pokeArray) {
			$name  = $pokeArray['name'];
			$level = $pokeArray['level'];
			$type = isset($pokeArray['type']) ? $pokeArray['type'].' ' : '' ;
			
			$query = "SELECT * FROM `pokemon` WHERE `name`='{$name}' LIMIT 1";		
			$_SESSION['battle']['opponent'][$i] = fetchAssoc($query, $conn);
			$_SESSION['battle']['opponent'][$i]['name'] = $type.$name;
			$_SESSION['battle']['opponent'][$i]['level'] = $level;
			$_SESSION['battle']['opponent'][$i]['maxhp'] = maxHp($name, $level, $conn);
			$_SESSION['battle']['opponent'][$i]['hp']    = maxHp($name, $level, $conn);
			$i++;
		}
		$_SESSION['battle']['onum']  = 0;
		$_SESSION['battle']['badge'] = $leaderArray['badge'];
		$_SESSION['battle']['gymleader']    = $leader;
		$_SESSION['battle']['rebattlelink'] = '<a href="gyms.php?leader='.$leader.'">'.$lang['rebattle_00'].' '.$leader.'</a>';
		
		redirect('battle.php');
	}
}

include '_header.php';
printHeader($lang['rebattle_title']);

$badges = array();
$query = "SELECT * FROM `user_badges` WHERE `uid`='{$uid}'";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) { $badges[] = $row['badge']; }

$leagueArray = getAllLeaguesLeadersAndBadges();

foreach ($leagueArray as $leagueName => $leader) {
	echo '<table style="margin-bottom: 10px;" class="pretty-table"><tr><th colspan="7">'.$leagueName.'</th></tr>';
	echo '<tr>';
	$count = 0;
	foreach ($leader as $leaderArray) {
		
		$badgeHtml = '';
		if (in_array($leaderArray['badge'], $badges)) {
			$badgeHtml = ' <img style="width:25px;" src="images/badges/'.$leaderArray['badge'].'.png" /> ';
		}
		echo '
			<td class="testHover" style="width: 25%;">
				<a href="gyms.php?leader=' . $leaderArray['name'] . '">
					<img src="images/gyms/' . $leaderArray['name'] . '.png" alt="' . $leaderArray['name'] . '" /><br />
					' . $leaderArray['name'] . $badgeHtml. '
				</a>
			</td>
		';
		$count++;
		
		if ($count == 4) {
			echo '</tr>';
		}
	}
	
	echo '</table>';
}
include '_footer.php';
?>
<?php ob_end_flush(); ?>

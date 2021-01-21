<?php
include('modules/lib.php');

include '_header.php';
printHeader($lang['change_team_title']);

$uid = (int) $_SESSION['userid'];
$pid = (int) $_GET['id'];
$teamIds = getUserTeamIds($uid);
$pokemon = getUserPokemon($pid);

if ($pokemon === false) {
	echo '<div class="error">'.$lang['change_team_00'].'</div>';
} elseif ($pokemon['uid'] != $uid) {
	echo '<div class="error">'.$lang['change_team_01'].'</div>';
} elseif (in_array($pokemon['id'], $teamIds)) {
	echo '<div class="error">'.$lang['change_team_02'].'</div>';
} else {	
	if (in_array($_POST['pos'], range(1, 6))) {
		$pos = (int) $_POST['pos'];
		
		for ($i=$pos; $i>0; $i--) {
			if ($teamIds['poke'.$i] == 0) {
				$pos = $i;
			}
		}
		
		$conn->query("UPDATE `users` SET `poke{$pos}`='{$pid}' WHERE `id`='{$uid}'");
		
		echo '<img src="images/pokemon/'.$pokemon['name'].'.png" /><br /><br />
			<div class="notice">
				'.$pokemon['name'].' '.$lang['change_team_03'].'
			</div>
		';
	} else {
		echo '
			<div style="text-align: center;">
				<img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
				'.$pokemon['name'].'<br />
				'.$lang['change_team_04'].': '.$pokemon['level'].'<br />
				'.$lang['change_team_05'].': '.$pokemon['exp'].'
			</div>
		';
		
		$cells = array();
		$pos = 1;
		foreach ($teamIds as $pokeid) {
			$poke = getUserPokemon($pokeid);
			if ($poke === false) {
    		    $cells[] = '
        			<img src="images/pokemon/EMPTY.png" /><br />
    				'.$lang['change_team_06'].'<br />
    				
    				<form method="post">
    					<input type="hidden" name="pos" value="'.$pos.'" />
    					<input type="submit" value="'.$lang['change_team_07'].' '.$pokemon['name'].' '.$lang['change_team_08'].'" />
    				</form>
    			';
			} else {
    			$cells[] = '
    				<img src="images/pokemon/'.$poke['name'].'.png" /><br />
    				'.$poke['name'].'<br />
    				'.$lang['change_team_04'].': '.$poke['level'].'<br />
    				'.$lang['change_team_05'].': '.$poke['exp'].'<br /><br />
    				
    				<form method="post">
    					<input type="hidden" name="pos" value="'.$pos.'" />
    					<input type="submit" value="'.$lang['change_team_09'].' '.$poke['name'].' '.$lang['change_team_10'].' '.$pokemon['name'].'" />
    				</form>
    			';
			}
			
			$pos++;
		}
		
		echo '
			<table class="pretty-table">
				'.cellsToRows($cells, 3).'
			</table>
		';
	}
}

include '_footer.php';
?>
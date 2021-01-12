<?php
include('modules/lib.php');

if (!isLoggedIn()) {
    redirect('login.php');
}

if (!isAdmin()) {
    //die('Down for updates!');
}


logs($uid, " viewed his/her team !");
$uid = (int) $_SESSION['userid'];



if ((isset($_GET['a']) && in_array($_GET['a'], range(1,6))) && (isset($_GET['b']) && in_array($_GET['b'], range(1,6))) && $_GET['a'] != $_GET['b']) {
    $team    = getUserTeamIds($uid);
	$first   = (int) $_GET['a'];
	$second  = (int) $_GET['b'];
	$fPokeId = (int) $team['poke'.$first ];
	$sPokeId = (int) $team['poke'.$second];
	
	if ($fPokeId == 0 || $sPokeId == 0) {
		// echo '<div class="error">You can not move this pokemon.</div>';
	} else {
		mysql_query("UPDATE `users` SET `poke{$second}`='{$fPokeId}', `poke{$first}`='{$sPokeId}' WHERE `id`='{$uid}' LIMIT 1");
        redirect('team.php');
	}
}

if (isset($_GET['box']) && in_array($_GET['box'], range(1,6))) {
    $team    = getUserTeamIds($uid);
    $position = (int) $_GET['box'];
    $pokeCount = 0;
    $validIds = array();
    
    for ($i=1; $i<=6; $i++) {
        $id = $team['poke'.$i];
        if ($id != 0 && $i != $position) {
            $validIds[] = $id;
        }
    }
	
	if (count($validIds) >= 1) {
        $upSql = '';
        $p = 1;
        foreach ($validIds as $id) {
            
            $upSql .= " `poke{$p}`='$id', ";
            $p++;
        }
        if ($p <= 6) {
            for (; $p<=6; $p++) {
                $upSql .= " `poke{$p}`='0', ";
            }
        }
        $upSql = substr($upSql, 0, -2);
        // echo "UPDATE `users` SET {$upSql} WHERE `id`='{$uid}' LIMIT 1";
	    mysql_query("UPDATE `users` SET {$upSql} WHERE `id`='{$uid}' LIMIT 1");
        redirect('team.php');
	}
}

// Is your team broken? <a href="fix_team.php">Click here</a> to try and fix it.<br /><br />

include '_header.php';
printHeader($lang['team_title']);

    
 echo '
    
    <table class="pretty-table">
		<tr>
			<th>&nbsp;</th>
			<th>'.$lang['team_00'].'</th>
			<th>'.$lang['team_01'].'</th>
			<th>'.$lang['team_02'].'</th>
			<th>'.$lang['team_03'].'</th>
		</tr>
';

$team = getUserTeamIds($uid);
$pokeCount = 0;
for ($i=1; $i<=6; $i++) {
    $pid = $team['poke'.$i];
    if ($pid > 0) {
        $pokeCount++;
    }
}

for ($i=1; $i<=6; $i++) {
	$pid = $team['poke'.$i];
	
	if ($pid == 0) {
        
        echo '
            <tr>
                <td>
                    <img src="images/pokemon/EMPTY.png" alt="Empty" /><br />
                    '.$lang['team_04'].'
                </td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
    		</tr>
    	';
        
		continue;
	}
	
	$pokemon = getUserPokemon($pid);
	
	echo '
        <tr>
            <td>
                <img src="images/pokemon/' . $pokemon['name'] . '.png" alt="' . $pokemon['name'] . '" /><br />
                ' . $pokemon['name'] . '
            </td>
            <td>' . $pokemon['level'] . '</td>
            <td>' . number_format($pokemon['exp']) . '</td>
            <td>
                ' . $pokemon['move1'] . '<br />
                ' . $pokemon['move2'] . '<br />
                ' . $pokemon['move3'] . '<br />
                ' . $pokemon['move4'] . '<br />
            </td>
            <td>
	';
    
    if ($pokeCount > 1) {
        echo $lang['team_05'].'<br />';
        for ($j=1; $j<=6; $j++) {
            if ($j == $pokeCount+1) { break; }
            if ($i == $j) {
                echo '['.$j.']&nbsp;';
            } else {
                echo '[<a href="?a='.$i.'&b='.$j.'">'.$j.'</a>]&nbsp;';
            }
            if ($j==3) { echo '<br />'; }
        }
        echo '
            <br /><br />
            <a href="?box='.$i.'">'.$lang['team_06'].'</a>
            <br /><br />
        ';
    }
	echo ' 
				<a href="evolve.php?id='.$pokemon['id'].'">'.$lang['team_07'].'</a><br />
				<a href="change_attacks.php?id='.$pokemon['id'].'">'.$lang['team_08'].'</a>
			</td>
		</tr>
	';
}
echo '</table>';
include '_footer.php';
?>
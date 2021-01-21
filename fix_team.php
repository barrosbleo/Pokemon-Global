<?php
die();
include('modules/lib.php');
     
    if (!isLoggedIn()) {
            redirect('login.php');
    }
     
    $uid = (int) $_SESSION['userid'];
     
    include '_header.php';
     
    $newTeamIds = array();
    $oldTeamIds = getUserTeamIds($uid);
     
    if (count($oldTeamIds) > 0) {
            foreach ($oldTeamIds as $pid) {
                    if ($pid == 0) { continue; }
     
                    $query = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' AND `uid`='{$uid}'";
           
                    if (numRows($query, $conn) == 1) {
                            $newTeamIds[] = $pid;
                    }
            }
    }
     
    $query = "SELECT * FROM `user_pokemon` WHERE `uid`='{$uid}' ORDER BY `exp` DESC";
     
    if (numRows($query, $conn) == 0) {
            // they have no pokemon
            $pid = giveUserPokemonByName($uid, 'Weedle', 5, '');
            $newTeamIds[] = $pid;
    } else if (numRows($query, $conn) > count($newTeamIds)) {
            // pad out their team with pokemon from their box
			$result = $conn->query($query);
            while (count($newTeamIds) < 6 && $pokeInfo = $result->fetch_assoc()) {
                    if (!in_array($pokeInfo['id'], $newTeamIds)) {
                            $newTeamIds[] = $pokeInfo['id'];
                    }
            }
    }
     
    $pokeIdSqlArray = array();
    foreach ($newTeamIds as $key =>$pid) {
            $key += 1;     
            $pokeIdSqlArray[] = "`poke{$key}`='{$pid}'";
    }
    $pokeIdSql = implode(', ', $pokeIdSqlArray);
     
    $query = $conn->query("UPDATE `users` SET {$pokeIdSql} WHERE `id`='{$uid}'");
     
    if ($query) {
            echo '<div class="notice">'.$lang['fix_team_00'].'</div>';
    } else {
            echo '<div class="error">'.$lang['fix_team_01'].'</div>';
    }
     
     
    include '_footer.php';
?>

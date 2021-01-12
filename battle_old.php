<?php
include('modules/lib.php');
require 'banned.php';

if ($_SESSION['admin'] == true || $_SESSION['username'] == 'DarkMaster') {
    redirect('battle2.php');
}


if (!isset($_SESSION['battle']) || !isset($_SESSION['userid'])) {
header('location: membersarea.php');
exit;
}

$uid = (int) $_SESSION['userid'];


/*********************************************/
// captcha code

$query = mysql_query("SELECT `battles` FROM `users` WHERE `id`='{$uid}'");
$row = mysql_fetch_assoc($query);
$battles = $row['battles'];

if ($battles%5== 0 && $battles > 0) {
	$message = '';
    
    require_once('recaptchalib.php');
    $privatekey = "6LcoouYSAAAAAPqMC4MyP8wRieWRNvfGoJw7-LdJ";
    $publickey = "6LcoouYSAAAAAGdxiM-0G2jv8BHKCOFqArqz0gwQ";
    
	if (isset($_POST["recaptcha_challenge_field"]) && isset($_POST["recaptcha_response_field"])) {
	    
  
        $resp = recaptcha_check_answer(
            $privatekey,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]
        );
		
        if($resp->is_valid) {
mysql_query("UPDATE `users` SET `battles`='0', `money`=`money`+500 WHERE `id`='{$uid}'");
            redirect('battle.php');
        } else {
            $message = 'Sorry, the code you entered was invalid.';
        }
	}
    
	include '_header.php';
      printHeader('Battle Captcha');
	echo '
		<div class="sub-content"> 
			
			<div style="text-align: center; color: white;">
		
				'.$message.'
			</div>
            <br />
<div>You will receive $500 if you enter the correct code!</div><form method="post" action="" style="text-align: center;">
                '.recaptcha_get_html($publickey).'<br />
                <input type="submit" value="Submit!" /><br /><br />
            </form>
		</div>
	';
	include '_footer.php';
	die();
}

/*********************************************/



include '_header.php';
printHeader('Battle Area');


function levelAndPowerDamage($level, $move_power) {
	return ceil(($level/2) * ($move_power/20));
}

if (isset($_POST['cp']) && in_array($_POST['cp'], range(0, 5))) {
	$_SESSION['battle']['mynum'] = $_POST['cp'];
	$_SESSION['battle']['screen'] = 'battle';
}

if (!isset($_SESSION['battle']['screen'])) {
	$_SESSION['battle']['screen'] = 'pickpokemon';
}

if (!isset($_SESSION['battle']['usedpokemon'])) {
	$_SESSION['battle']['usedpokemon'] = array();
}


if (!isset($_SESSION['battle']['wild'])) {
	$_SESSION['battle']['wild'] = false;
}


if (isset($_POST['boop'])) {
	$fh = @fopen('caught_botting.txt', 'a') or die();
	fwrite($fh, "{$_SESSION['userid']} - {$_SESSION['username']} - ". date('l jS \of F Y h:i:s A') ." - ". time() . PHP_EOL);
	fclose($fh);
	
	unset($_SESSION['battle']);
	die();
}


$hasWon = true;
foreach ($_SESSION['battle']['opponent'] as $pokemon) {
	if ($pokemon['hp'] > 0) {
		$hasWon = false;
		break;
	}
}
//if ($_SESSION['username'] == 'asdd') { $hasWon = true; }
if ($hasWon == true) {
	$_SESSION['battle']['screen'] = 'winscreen';
}

if (isset($_SESSION['battle']['team'])) {
	$hasLost = true;
	foreach ($_SESSION['battle']['team'] as $pokemon) {
		if ($pokemon['hp'] > 0) {
			$hasLost = false;
			break;
		}
	}
	if ($hasLost == true && count($_SESSION['battle']['team']) >= 1) {
		$_SESSION['battle']['screen'] = 'losescreen';
	}
}
//print_r($_POST);
//unset($_SESSION['battle']['team']);

if (isset($_SESSION['battle']['screen']) && ($_SESSION['battle']['screen'] == 'winscreen' || $_SESSION['battle']['screen'] == 'losescreen')) {
	
	$winlose = $_SESSION['battle']['screen'] == 'winscreen' ? 'won' : 'lost' ;
	
	$fh = @fopen('battlelog3453.txt', 'a') or die();
	fwrite($fh, "{$_SESSION['userid']} - {$_SESSION['username']} - {$winlose} - ". date('l jS \of F Y h:i:s A') ." - ". time() . PHP_EOL);
	fclose($fh);
}

if ($_SESSION['battle']['screen'] == 'pickpokemon') {
	if (!isset($_SESSION['battle']['team'])) {

		$teamIds = getUserTeamIds($uid);
	
		for ($i=1; $i<=6; $i++) {
			$pid = (int) $teamIds['poke'.$i];
			
			if ($pid > 0) {
				$query   = mysql_query("SELECT * FROM `user_pokemon` WHERE `id`='{$pid}'");
				$pokeRow = mysql_fetch_assoc($query);
				
				$_SESSION['battle']['team'][$i-1]          = $pokeRow;
				$_SESSION['battle']['team'][$i-1]['maxhp'] = maxHp($pokeRow['name'], $pokeRow['level']);
				$_SESSION['battle']['team'][$i-1]['hp']    = maxHp($pokeRow['name'], $pokeRow['level']);
			}
		}
	}

	
	function teamTable($team, $myTeam = false) {
		
		$tTable .= '<div class="ranks"><table style="width: 100%;"><tr>';
		$selPoke = false;
		for ($i=0; $i<6; $i++) {
			$pokemon = $team[$i];
			
			if (!is_array($pokemon)) { break; }
			
			$attr = count($team)%2 == 1 && $i+1 == count($team) ? ' colspan="2"' : '' ;
			
			$rAttr = '';
			if (!$selPoke && $myTeam && $pokemon['hp'] > 0) {
				$rAttr = ' checked="checked"'; 
				$selPoke = true;
			}
			
			$radioStr = $myTeam && $pokemon['hp'] > 0 ? '<input type="radio" name="cp" value="'.$i.'" '.$rAttr.' />' : '' ;
			
			$strikeStart = $pokemon['hp'] <= 0 ? '<strike>' : '' ;
			$strikeStop  = $pokemon['hp'] <= 0 ? '</strike>' : '' ;

			$tTable .= '
				<td'.$attr.' style="width: 50%;">
					<img src="images/pokemon/'.$pokemon['name'].'.png" alt="'.$pokemon['name'].'" /><br />
				
					'.$strikeStart.'
						'.$radioStr.'<br />
						'.$pokemon['name'].'<br />
						Level: '.$pokemon['level'].'<br />
						HP: '.$pokemon['hp'].'/'.$pokemon['maxhp'].'
	
					'.$strikeStop.'
				</td>
			';
			
			
			if ($i == 1 || $i == 3) {
				$tTable .= '</tr><tr>';
			}
		}
		$tTable .= '</tr></table>';
		
		return $tTable;
	}
	
	$myTeam = &$_SESSION['battle']['team'];
	$opponentTeam = &$_SESSION['battle']['opponent'];
	
	echo '
		<form action="" method="post" style=" margin-bottom: 80px;">
			<table class="pretty-table">
				<tr>
					<td style="vertical-align: top; padding: 10px; width: 50%;">
						<h2 style="padding: 3px 0;">Your Team</h2>
						'.teamTable($myTeam, true).'
					</td>
					<td style="vertical-align: top; padding: 10px; width: 50%;">
						<h2 style="padding: 3px 0;">Opponents Team</h2>
						'.teamTable($opponentTeam, false).'
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 10px;">
						<input class="button" type="submit" name="" value="Fight!" style="padding: 5px 20px;" />
					</td>
				</tr>
			</table>
		</form>
	';
}

if ($_SESSION['battle']['screen'] == 'battle') {
	$items = array(
		'poke_ball'    => 'Poke Ball',
		'great_ball'   => 'Great Ball',
		'ultra_ball'   => 'Ultra Ball',
		'master_ball'  => 'Master Ball',
		'potion'       => 'Potion',
		'super_potion' => 'Super Potion',
		'hyper_potion' => 'Hyper Potion'
	);
		
	$opponentTeam = &$_SESSION['battle']['opponent'];
	//print_r($opponentTeam);
	$myTeam = &$_SESSION['battle']['team'];
	$pnum = &$_SESSION['battle']['mynum'];
	$onum = &$_SESSION['battle']['onum'];
	
	if (!in_array($pnum, $_SESSION['battle']['usedpokemon'])) {
		$_SESSION['battle']['usedpokemon'][] = $pnum;
	}
	
	
	if (isset($_POST['mnum']) && in_array($_POST['mnum'], range(1, 4))) {
		$moveUsed = $myTeam[$pnum]['move'.$_POST['mnum']];
		
		$query = mysql_query("SELECT * FROM `moves` WHERE `name`='{$moveUsed}'");
		$moveRow = mysql_fetch_assoc($query);
		
		$damageDone = levelAndPowerDamage($myTeam[$pnum]['level'], $moveRow['power']);
		
		if (strpos($myTeam[$pnum]['name'], 'Rainbow ') === 0) {
			$damageDone += round(($damageDone / 100) * 10);
		}
		
		if (strpos($myTeam[$pnum]['name'], 'Helios ') === 0) {
			$damageDone += round(($damageDone / 100) * 20);
		}
		
		$damageDone = $damageDone > $opponentTeam[$onum]['hp'] ? $opponentTeam[$onum]['hp'] : $damageDone ;
		
		$opponentTeam[$onum]['hp'] -= $damageDone;
		
		if ($moveUsed == 'Explosion' || $moveUsed == 'Self Destruct') {
			$myTeam[$pnum]['hp'] = 0;
		}
		
		
	} elseif (isset($_POST['item']) && in_array($_POST['item'], array_keys($items))) {
		$itemKey = $_POST['item'];
		
		$itemQuery = mysql_query("SELECT * FROM `user_items` WHERE `uid`='{$uid}'");
		$userItems = mysql_fetch_assoc($itemQuery);
		$useItem = true;
		
		if (strpos($itemKey, '_ball') !== false && $_SESSION['battle']['wild'] !== true) {
			$useItem = false;
		}
		
		$potions = array(
			'potion' => 50,
			'super_potion' => 150,
			'hyper_potion' => 300
		);
		
		if (strpos($itemKey, '_ball') !== false && $_SESSION['battle']['wild'] === true) {
			$chance = array(
				'poke_ball'   => 20,
				'great_ball'  => 40,
				'ultra_ball'  => 70,
				'master_ball' => 100
			);
			$randChance = rand(1, 100);
			
			if ($userItems[$itemKey] >= 1) {				
				if ($randChance <= $chance[$itemKey]) {
					$_SESSION['battle']['screen'] = 'caughtpokemon';
					$itemMsg = 'You used a '.$items[$itemKey].'<br /> and caught the pokemon';
				} else {
					$itemMsg = 'You used a '.$items[$itemKey].'<br /> and did not catch the pokemon';
				}
			}
		} else if ( in_array($itemKey, array_keys($potions)) ) {
			$itemMsg = 'You used a '.$items[$itemKey].'<br /> and '.$myTeam[$pnum]['name'].' gained '.$potions[$itemKey].' hp.';
			$myTeam[$pnum]['hp'] += $potions[$itemKey];
		}

		if ($userItems[$itemKey] >= 1) {
			if ($useItem === true) {
				mysql_query("UPDATE `user_items` SET `$itemKey`=`$itemKey`-1 WHERE `uid`='{$uid}'");
			}
		} else {
			$itemMsg = 'You do not have a '.$items[$itemKey].'.';
		}
	}
	
	if (isset($_POST['mnum']) || isset($_POST['item'])) {
		$omoveUsed = $opponentTeam[$onum]['move'.rand(1,4)];
		$query = mysql_query("SELECT * FROM `moves` WHERE `name`='{$omoveUsed}'");
		$moveRow = mysql_fetch_assoc($query);
		
		$odamageDone = levelAndPowerDamage($opponentTeam[$onum]['level'], $moveRow['power']);
		
		if (strpos($opponentTeam[$onum]['name'], 'Rainbow ') === 0) {
			$odamageDone += round(($odamageDone / 100) * 10);
		}
		
		if (strpos($opponentTeam[$onum]['name'], 'Helios ') === 0) {
			$odamageDone += round(($odamageDone / 100) * 20);
		}
		
		$odamageDone = $odamageDone > $myTeam[$pnum]['hp'] ? $myTeam[$pnum]['hp'] : $odamageDone ;
		
		$myTeam[$pnum]['hp'] -= $odamageDone;
		
		if ($omoveUsed == 'Explosion' || $omoveUsed == 'Self Destruct') {
			$opponentTeam[$onum]['hp'] = 0;
		}
	}
	
	if ($opponentTeam[$onum]['hp'] <= 0) {
		$opponentTeam[$onum]['hp'] = 0;
		$_SESSION['battle']['screen'] = 'pickpokemon';
	}
	
	if ($myTeam[$pnum]['hp'] <= 0) {
		$myTeam[$pnum]['hp'] = 0;
		$_SESSION['battle']['screen'] = 'pickpokemon';
	}
	
	if ($myTeam[$pnum]['hp'] >= $myTeam[$pnum]['maxhp']) {
		$myTeam[$pnum]['hp'] = $myTeam[$pnum]['maxhp'];
	}
	
	
	echo '
		<form method="post" name="boop" style="display: none;">
			<input class="button" type="submit" value="Attack!" />
		</form>
	';
	
	
	$myHpBarWidth = round($myTeam[$pnum]['hp'] / $myTeam[$pnum]['maxhp'] * 100);
	if ($myHpBarWidth > 30) { $myHpBarColor = 'green'; }
	else if ($myHpBarWidth > 10) { $myHpBarColor = 'yellow'; }
	else { $myHpBarColor = 'red'; }
	
	$opHpBarWidth = round($opponentTeam[$onum]['hp'] / $opponentTeam[$onum]['maxhp'] * 100);
	if ($opHpBarWidth > 30) { $opHpBarColor = 'green'; }
	else if ($opHpBarWidth > 10) { $opHpBarColor = 'yellow'; }
	else { $opHpBarColor = 'red'; }
	
	echo '
	<form action="" method="post" id="'.rand(1000, 2000).'">
	<table class="pretty-table" style="width: 500px">
		<tr>
			<td style="vertical-align: bottom;">
				<img src="images/pokemon/'.$myTeam[$pnum]['name'].'.png" alt="'.$myTeam[$pnum]['name'].'" /><br />
				'.$myTeam[$pnum]['name'].'<br />
				HP: '.$myTeam[$pnum]['hp'].'/'.$myTeam[$pnum]['maxhp'].'<br />
				
				<div style="width: 200px; border: 1px solid #000000; margin: 10px auto;">
					<div class="'.$myHpBarColor.'-gradient-bg" style="height: 15px; width: '.$myHpBarWidth.'%;"></div>
				</div>
                                             

			</td>
			<td style="vertical-align: bottom;">
				<img src="images/pokemon/'.$opponentTeam[$onum]['name'].'.png" alt="'.$opponentTeam[$onum]['name'].'" /><br />
				'.$opponentTeam[$onum]['name'].'<br />
				HP: '.$opponentTeam[$onum]['hp'].'/'.$opponentTeam[$onum]['maxhp'].'<br />
                           
                           <div style="width: 200px; border: 1px solid #000000; margin: 10px auto;">
					<div class="'.$opHpBarColor.'-gradient-bg" style="height: 15px; width: '.$opHpBarWidth.'%;"></div>
				</div>
			</td>
		</tr>
	';

	if ($opponentTeam[$onum]['hp'] > 0 && $myTeam[$pnum]['hp'] > 0 && $_SESSION['battle']['screen'] != 'caughtpokemon') {
		if ((isset($omoveUsed, $odamageDone) || isset($moveUsed, $damageDone) || isset($itemMsg)) && $_SESSION['battle']['screen'] != 'caughtpokemon') {
			echo '<tr><td>&nbsp;</td></tr><tr>';
			
			if (isset($omoveUsed, $odamageDone)) {
				echo '<td>'.$opponentTeam[$onum]['name'].' used '.$omoveUsed.'<br /> and did '.$odamageDone.' damage.</td>';
			}
			
			if (isset($moveUsed, $damageDone)) {
				echo '<td>'.$myTeam[$pnum]['name'].' used '.$moveUsed.'<br /> and did '.$damageDone.' damage</td>';
			}
			
			if (isset($itemMsg)) {
				echo '<td>'.$itemMsg.'</td>';
			}
			
			echo '</tr>';
		}
		
		$rand = rand(1, 3);
		
		if ($rand == 1) {
			$buttonStyle = 'style="float: left; margin-left: 10px;"';
		} else if ($rand == 2) {
			$buttonStyle = 'style="float: right; margin-right: 10px"';
		} else {
			$buttonStyle = 'style=""';
		} 
		
		echo '
			
			<tr>
				<td style="padding-left: 80px; width: 200px" align="left">
					<input type="radio" name="mnum" value="1" checked="checked" />&nbsp;'.$myTeam[$pnum]['move1'].'<br />
					<input type="radio" name="mnum" value="2" />&nbsp;'.$myTeam[$pnum]['move2'].'<br />
					<input type="radio" name="mnum" value="3" />&nbsp;'.$myTeam[$pnum]['move3'].'<br />
					<input type="radio" name="mnum" value="4" />&nbsp;'.$myTeam[$pnum]['move4'].'<br />
				</td>
				<td style="padding-left: 80px; width: 200px" align="left">
					'.$opponentTeam[$onum]['move1'].'<br />
					'.$opponentTeam[$onum]['move2'].'<br />
					'.$opponentTeam[$onum]['move3'].'<br />
					'.$opponentTeam[$onum]['move4'].'<br />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="display: none;"><input class="button" type="submit" name="boop" value="Attack!" /></div>
					<input class="button"  type="submit" value=" Attack! " />
				</td>
			</tr>
		';
		//
	} else {
		if ($opponentTeam[$onum]['hp'] <= 0) {
			echo '<tr><td colspan="2">'.$opponentTeam[$onum]['name'].' has fainted!</td></tr>';
		} else if ($myTeam[$pnum]['hp'] <= 0) {
			echo '<tr><td colspan="2">'.$myTeam[$pnum]['name'].' has fainted!</td></tr>';
		} else if ($_SESSION['battle']['screen'] == 'caughtpokemon') {
			echo '<tr><td colspan="2">'.$itemMsg.'</td></tr>';
		}
		echo '<tr><td colspan="2"><input class="button" type="submit" value="Continue!" /></td></tr>';
	}
	echo '
	</table>
	</form>
	';
	
	if ($opponentTeam[$onum]['hp'] > 0 && $myTeam[$pnum]['hp'] > 0 && $_SESSION['battle']['screen'] != 'caughtpokemon') {
		$itemQuery = mysql_query("SELECT * FROM `user_items` WHERE `uid`='{$uid}'");
		$userItems = mysql_fetch_assoc($itemQuery);
		
		echo '
			<form action="" method="post">
			<table style="margin: 20px auto;">
		';
		
		foreach ($items as $cname => $item) {
			if (strpos($cname, '_ball') !== false && $_SESSION['battle']['wild'] === false) {
				continue;
			}
			echo '
				<tr>
					<td><img src="images/items/'.$item.'.png" alt="'.$item.'" /></td>
					<td><input type="radio" name="item" value="'.$cname.'" /></td>
					<td>'.$userItems[$cname].' x '.$item.'</td>
				</tr>
			';
		}
		
		echo '
				<tr>
					<td colspan="3"><input class="button" type="submit" value="Use Item" /></td>
				</tr>
			</table>
			</form>
		';
	}
	
	if ($opponentTeam[$onum]['hp'] <= 0) {
		$onum++;
	}

  
  
} else if ($_SESSION['battle']['screen'] == 'winscreen') {

	echo '
		<div style="text-align:center;">
			<h1>You Won!</h1>
		</div>
	';

        $info = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '$uid'"));
        $clan = $info['clan'];
        $expu = rand(1,10000);
        if ($clan >= 1) {
        mysql_query("UPDATE `users` SET `clanxp`=`clanxp`+$expu WHERE `id`='{$uid}'");
        mysql_query("UPDATE `clans` SET `exp`=`exp`+$expu WHERE `id`='{$clan}'");
        }
	mysql_query("UPDATE `users` SET `won`=`won`+1, `battles`=`battles`+1 WHERE `id`='{$uid}'");
	
	$olevel = 0;
	foreach ($_SESSION['battle']['opponent'] as $opoke) {
		$olevel += $opoke['level'];
	}
		//Select user for premium
	$premiumQuery = mysql_query("SELECT `premium` FROM `users` where `ID`='{$uid}'");
	$premium = mysql_fetch_object($premiumQuery);

		//Premium get 10% more Money
	if ($premium->premium == 2) {
		$money_premium = 4;
		$text_pre = 'You received 10% more money and exp than usual member because you are a PREMIUM member.';
	} else {
		$money_premium = 3;
		$text_pre = '';
	}		
	
	$team = &$_SESSION['battle']['team'];
	$randMoney = rand(round($olevel*2.3), round($olevel*$money_premium));
	
	if ($randMoney < 1) {
		$randMoney = mt_rand(75,150);
	}
	
	if ($randMoney > 150) {
		$randMoney = mt_rand(250,1000);
	}
	
	mysql_query("UPDATE `users` SET `money`=`money`+{$randMoney} WHERE `id`='{$uid}'");
	
	$myTotalLevel = 0;
	foreach ($_SESSION['battle']['usedpokemon'] as $pnum) {
		$myTotalLevel += $team[$pnum]['level'];
	}
	
		//Premium get double EXP
	if ($premium->premium == 2) {
		$exp_premium = 11;
	} else {
		$exp_premium = 10;
	}	
	
	$randExp = ceil(($olevel / count($_SESSION['battle']['usedpokemon'])) * $exp_premium);

	if ($randExp < 1) {
		$randExp = rand(500, 1000);
	}
/*	
	if ($randExp > 1500) {
		$randExp = 8000;
	}
*/	
	foreach ($_SESSION['battle']['usedpokemon'] as $pnum) {		
		$newExp = $team[$pnum]['exp'] + $randExp;
		echo '
			<div style="text-align:center; margin-bottom: 20px;">
				<img src="images/pokemon/'.$team[$pnum]['name'].'.png" alt="'.$team[$pnum]['name'].'" /><br />
				'.$team[$pnum]['name'].' + '.$randExp.'exp<br />
			
		';
		
		mysql_query("UPDATE `user_pokemon` SET `exp`={$newExp} WHERE `id`='{$team[$pnum]['id']}'") or die('f');
		mysql_query("UPDATE `users` SET `trainer_exp`={$newExp} WHERE `id`='{$uid}'") or die('f');
		
		$newLevel = expToLevel($newExp);
	
			if ($newLevel > 10000) {
				$newLevel = 10000;
			}
			
		if ($newLevel != $team[$pnum]['level']) {
			$levelsGained = $newLevel - $team[$pnum]['level'];
			echo $team[$pnum]['name'] . ' gained ' . $levelsGained . ' levels.<br />';
			mysql_query("UPDATE `user_pokemon` SET `level`={$newLevel} WHERE `id`='{$team[$pnum]['id']}'");
		}
		
		echo '</div>';
	}
	
	if (isset($_SESSION['battle']['uid'])) {
		$wUid = $_SESSION['battle']['uid'];
		
		if ($wUid == getConfigValue('champion_uid')) {
			setConfigValue('champion_uid', $uid);
			echo '<div>You are now the new champion!</div>';
		}
	}

	$gymMsg = '';
	if (isset($_SESSION['battle']['badge'])) {
		$badge = $_SESSION['battle']['badge'];
		$gymleader = $_SESSION['battle']['gymleader'];

		$gymMsg = '
			<div>
				<img src="images/badges/'.$badge.'.gif" alt="'.$badge.' Badge" />
				You have beaten '.$gymleader.' and earned yourself the '.$badge.' badge!
				<img src="images/badges/'.$badge.'.gif" alt="'.$badge.' Badge" />
			</div>
		';
		
		$query = mysql_query("SELECT `id` FROM `user_badges` WHERE `uid`='{$uid}' AND `badge`='{$badge}' LIMIT 1");
		
		if (mysql_num_rows($query) == 0) {
			mysql_query("INSERT INTO `user_badges` (`uid`, `badge`) VALUES ('{$uid}', '{$badge}')");
		}
		
		logActivity($_SESSION['username'].' beat '.$gymleader, $uid, 'images/gyms/'.$gymleader.'.png');
	}
	
	echo '
		<div style="text-align:center;">
			<div>You got $'.$randMoney.' for winning.</div>
			<div>'.$text_pre.'</div>
			<div>'.$gymMsg.'</div>
		</div>
	';
	
	$rebattleLink = isset($_SESSION['battle']['rebattlelink']) ? $_SESSION['battle']['rebattlelink'].'<br />' : '' ;
	echo '
		<div style="text-align:center; margin: 30px 0px;">
			'.$rebattleLink.'
			<a href="team.php">My Team</a><br />
		</div>
	';
	
	unset($_SESSION['battle']);
	
} else if ($_SESSION['battle']['screen'] == 'losescreen') {
	mysql_query("UPDATE `users` SET `lost`=`lost`+1 WHERE `id`='{$uid}'");

	echo '
		<div style="text-align:center;">
			<h1>You Lost!</h1>
		</div>
	';
	
	$rebattleLink = isset($_SESSION['battle']['rebattlelink']) ? $_SESSION['battle']['rebattlelink'].'<br />' : '' ;
	echo '
		<div style="text-align:center; margin: 30px 0px;">
			'.$rebattleLink.'
			<a href="team.php">My Team</a><br />
		</div>
	';
	
	unset($_SESSION['battle']);
	
} else if ($_SESSION['battle']['screen'] == 'caughtpokemon') {

	$pokemon = $_SESSION['battle']['opponent'][ $_SESSION['battle']['onum'] ];
	
	logActivity($_SESSION['username'].' caught a '.$pokemon['name'], $uid, 'images/pokemon/'.$pokemon['name'].'.png');
	
	$level  = (int) $pokemon['level'];
	$name   = $pokemon['name'];
	$move1  = $pokemon['move1'];
	$move2  = $pokemon['move2'];
	$move3  = $pokemon['move3'];
	$move4  = $pokemon['move4'];
	
	$exp = levelToExp($level);
	// mysql_query("INSERT INTO `user_pokemon` (`uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`)
	// VALUES ('{$uid}', '{$name}', '{$level}', '{$exp}', '{$move1}', '{$move2}', '{$move3}', '{$move4}')");
	giveUserPokemon($uid, $name, $level, $exp, $move1, $move2, $move3, $move4);
	
        // $query = mysql_query("SELECT `id` FROM `user_pokemon` WHERE `uid`='{$uid}'");
        // $numPokes = mysql_num_rows($query);
       // if ($numPokes <= 6) {
       // if ($numPokes < 1) { $numPokes = 1; }
       // $pokeId = mysql_insert_id();
      // mysql_query("UPDATE `users` SET `poke{$numPokes}`='$pokeId' WHERE `id`='{$uid}'");
      // }
	
	echo '
		<div style="text-align:center;">
			<h1>You caught a '.$pokemon['name'].'!</h1>
			<div><img src="images/pokemon/'.$pokemon['name'].'.png" alt="'.$pokemon['name'].'" /></div>
		</div>
	';
	
	$rebattleLink = isset($_SESSION['battle']['rebattlelink']) ? $_SESSION['battle']['rebattlelink'].'<br />' : '' ;
	echo '
		<div style="text-align:center; margin: 30px 0px;">
			'.$rebattleLink.'
			<a href="team.php">My Team</a><br />
		</div>
	';
	
	unset($_SESSION['battle']);
}



include '_footer.php';
?>
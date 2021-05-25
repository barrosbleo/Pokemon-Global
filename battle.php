<?php
//die("Battles is down for maintenance. Check back soon.");
include('modules/lib.php');
require_once 'attack_mod.php';

function clacDamage($poke1, $poke2, $moveUsed, $conn) {
	// poke1 is attacking poke2
	global $attackMod;
	
	$types = array('Snow', 'Shiny', 'Halloween', 'Rainbow', 'Helios', 'Possion', 'Shadow', 'Normal');
	$poke1name = trim( str_replace($types, '', $poke1['name']) );
	$poke2name = trim( str_replace($types, '', $poke2['name']) );
	
	$moveUsed = cleanSql($moveUsed, $conn);
	$query = "SELECT * FROM `moves` WHERE `name`='{$moveUsed}' LIMIT 1";
	if (!$query || numRows($query, $conn) == false) { array('damage' => 100, 'message' => ''); }
	$moveRow = fetchAssoc($query, $conn);
	
	$stab = ($moveRow['type'] == $poke1['type1'] || $moveRow['type'] == $poke1['$type2']) ? 1.5 : 1 ;
	
	$query = "SELECT * FROM `pokedex` WHERE `name`='{$poke1name}' LIMIT 1";
	if (!$query || numRows($query, $conn) == false) { array('damage' => 101, 'message' => '');; }
	$poke1row = fetchAssoc($query, $conn);
	if ($moveRow['type'] == 'Status') { return array('damage' => 0, 'message' => '');; }
	$attackStat = ($moveRow['type'] == 'Special') ? $poke1row['spattack'] : $poke1row['attack'] ;
	$attackStat = ceil(((($attackStat*2)+5) / 100) * $poke1['level']);
	$attackPower = $moveRow['power'];
	
	
	// poke 2 defence
	$query = "SELECT * FROM `pokedex` WHERE `name`='{$poke2name}' LIMIT 1";
	if (!$query || numRows($query, $conn) == false) { return array('damage' => 102, 'message' => ''); }
	$poke2row = fetchAssoc($query, $conn);
	$defenseStat = ceil(((($poke2row['defence']*2)+5) / 100) * $poke2['level']);
	
	$weakness = 1;
	if (isset($poke2row['type1']) && isset($attackMod[ $moveRow['type'] ][ $poke2row['type1'] ])) {
		$weakness = $attackMod[ $moveRow['type'] ][ $poke2row['type1'] ];
	}
	if (isset($poke2row['type2']) && isset($attackMod[ $moveRow['type'] ][ $poke2row['type2'] ])) {
		$weakness *= $attackMod[ $moveRow['type'] ][ $poke2row['type2'] ];
	}
	
	$messages = array(
		'msg-0'    => $lang['battle_00'].' '.$poke2['name'].'...',
		'msg-0.25' => $lang['battle_01'],
		'msg-0.5'  => $lang['battle_02'],
		'msg-1'    => '',
		'msg-2'    => $lang['battle_03'],
		'msg-4'    => $lang['battle_04']
	);
	
	$damage = ((((2 * $poke1['level'] / 5 + 2) * $attackStat * $attackPower / $defenseStat) / 50) + 2) * $stab * $weakness * mt_rand(85, 100) / 100;
	
	if ($weakness == 0) { $damage = 0; }
	
	return array(
		'damage' => round($damage/10),
		'message' => $messages[ 'msg-' .  $weakness ]
	);
}

require 'banned.php';

if (!isset($_SESSION['battle']) || !isset($_SESSION['userid']) || !isset($_SESSION['battle']['opponent'])) {
header('location: membersarea.php');
exit;
}

$uid = (int) $_SESSION['userid'];


/*********************************************/
// captcha code

$query = "SELECT `battles` FROM `users` WHERE `id`='{$uid}'";
$row = fetchAssoc($query, $conn);
$battles = $row['battles'];

/*
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
*/

/*********************************************/



include '_header.php';
printHeader($lang['battle_05']);


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
// if ($_SESSION['username'] == '_asdd_') { $hasWon = true; }
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

		$teamIds = getUserTeamIds($uid, $conn);
	
		for ($i=1; $i<=6; $i++) {
			$pid = (int) $teamIds['poke'.$i];
			
			if ($pid > 0) {
				$query   = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}'";
				$pokeRow = fetchAssoc($query, $conn);
				
				$_SESSION['battle']['team'][$i-1]          = $pokeRow;
				$_SESSION['battle']['team'][$i-1]['maxhp'] = maxHp($pokeRow['name'], $pokeRow['level'], $conn);
				$_SESSION['battle']['team'][$i-1]['hp']    = maxHp($pokeRow['name'], $pokeRow['level'], $conn);
			}
		}
	}

	function teamTable($team, $myTeam = false) {
		$tTable = "";
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
						'.$pokemon['name'].'  '.$pokemon['level'].'<br />
						'.$pokemon['hp'].'/'.$pokemon['maxhp'].'
	
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
					<td style="vertical-align: top; padding: 10px; width: 100%;">
						<h2 style="padding: 3px 0;">'.$lang['battle_08'].'</h2>
						'.teamTable($myTeam, true).'
					</td>
					</tr>
					<tr>
					<td style="vertical-align: top; padding: 10px; width: 50%;">
						<h2 style="padding: 3px 0;">'.$lang['battle_09'].'</h2>
						'.teamTable($opponentTeam, false).'
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 10px;">
						<input class="button" type="submit" name="" value="'.$lang['battle_10'].'" style="padding: 5px 20px;" />
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
		
		$query = "SELECT * FROM `moves` WHERE `name`='{$moveUsed}'";
		$moveRow = fetchAssoc($query, $conn);
		
		$foobar = clacDamage($myTeam[$pnum], $opponentTeam[$onum], $moveUsed, $conn);
		
		$damageDone = $foobar['damage'];
		$weakMessage = $foobar['message'];
		
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
		
		$itemQuery = "SELECT * FROM `user_items` WHERE `uid`='{$uid}'";
		$userItems = fetchAssoc($itemQuery, $conn);
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
			$opHpValue = round($opponentTeam[$onum]['hp'] / $opponentTeam[$onum]['maxhp'] * 100);
			if ($opHpValue <= 10) {
				$chance = array(
				'poke_ball'   => 100,
				'great_ball'  => 100,
				'ultra_ball'  => 100,
				'master_ball' => 100
			);
			}elseif ($opHpValue <= 20) {
				$chance = array(
				'poke_ball'   => 94,
				'great_ball'  => 98,
				'ultra_ball'  => 100,
				'master_ball' => 100
			);
			}elseif ($opHpValue <= 30) {
				$chance = array(
				'poke_ball'   => 83,
				'great_ball'  => 91,
				'ultra_ball'  => 100,
				'master_ball' => 100
			);
			}elseif ($opHpValue <= 40) {
				$chance = array(
				'poke_ball'   => 74,
				'great_ball'  => 83,
				'ultra_ball'  => 100,
				'master_ball' => 100
			);
			}elseif ($opHpValue <= 60) {
				$chance = array(
				'poke_ball'   => 55,
				'great_ball'  => 69,
				'ultra_ball'  => 98,
				'master_ball' => 100
			);
			}elseif ($opHpValue <= 75) {
				$chance = array(
				'poke_ball'   => 16,
				'great_ball'  => 54,
				'ultra_ball'  => 87,
				'master_ball' => 100
			);
			}elseif ($opHpValue <= 100) {
				$chance = array(
				'poke_ball'   => 4,
				'great_ball'  => 35,
				'ultra_ball'  => 75,
				'master_ball' => 98
			);
			}
			$randChance = rand(1, 100);
			
			if ($userItems[$itemKey] >= 1) {				
				if ($randChance <= $chance[$itemKey]) {
					$_SESSION['battle']['screen'] = 'caughtpokemon';
					$itemMsg = $lang['battle_11'].' '.$items[$itemKey].'<br /> '.$lang['battle_12'];
				} else {
					$itemMsg = $lang['battle_11'].' '.$items[$itemKey].'<br /> '.$lang['battle_13'];
				}
			}
		} else if ( in_array($itemKey, array_keys($potions)) ) {
			$itemMsg = $lang['battle_11'].' '.$items[$itemKey].'<br /> '.$lang['battle_14'].' '.$myTeam[$pnum]['name'].' '.$lang['battle_15'].' '.$potions[$itemKey].' '.$lang['battle_16'];
			$myTeam[$pnum]['hp'] += $potions[$itemKey];
		}

		if ($userItems[$itemKey] >= 1) {
			if ($useItem === true) {
				$conn->query("UPDATE `user_items` SET `$itemKey`=`$itemKey`-1 WHERE `uid`='{$uid}'");
			}
		} else {
			$itemMsg = $lang['battle_17'].' '.$items[$itemKey].'.';
		}
	}
	
	if (isset($_POST['mnum']) || isset($_POST['item'])) {
		$omoveUsed = $opponentTeam[$onum]['move'.rand(1,4)];
		$query = "SELECT * FROM `moves` WHERE `name`='{$omoveUsed}'";
		$moveRow = fetchAssoc($query, $conn);
		
		
		$foobar = clacDamage($opponentTeam[$onum], $myTeam[$pnum], $omoveUsed, $conn);
		
		$odamageDone = $foobar['damage'];
		$oweakMessage = $foobar['message'];
		
		if (strpos($opponentTeam[$onum]['name'], 'Rainbow ') === 0) {
			$odamageDone += round(($odamageDone / 100) * 10);
		}
		
		if (strpos($opponentTeam[$onum]['name'], 'Helios ') === 0) {
			$odamageDone += round(($odamageDone / 100) * 20);
		}
		
		$odamageDone = $odamageDone > $myTeam[$pnum]['hp'] ? $myTeam[$pnum]['hp'] : $odamageDone ;
		
		$myTeam[$pnum]['hp'] -= $odamageDone;//** Add damage to pokemon
		
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
			<input class="button" type="submit" value="'.$lang['battle_18'].'" />
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
	<table class="pretty-table battling">
		<tr>
			<td style="vertical-align: bottom;">
				<img src="images/pokemon/'.$myTeam[$pnum]['name'].'.png" alt="'.$myTeam[$pnum]['name'].'" /><br />
				'.$myTeam[$pnum]['name'].'<br />
				HP: '.$myTeam[$pnum]['hp'].'/'.$myTeam[$pnum]['maxhp'].'<br />
				
				<div style="width: 100%; border: 1px solid #000000; margin: 10px auto;">
					<div class="'.$myHpBarColor.'-gradient-bg" style="height: 15px; width: '.$myHpBarWidth.'%;"></div>
				</div>
                                             

			</td>
			<td style="vertical-align: bottom;">
				<img src="images/pokemon/'.$opponentTeam[$onum]['name'].'.png" alt="'.$opponentTeam[$onum]['name'].'" /><br />
				'.$opponentTeam[$onum]['name'].'<br />
				HP: '.$opponentTeam[$onum]['hp'].'/'.$opponentTeam[$onum]['maxhp'].'<br />
                           
                           <div style="width: 100%; border: 1px solid #000000; margin: 10px auto;">
					<div class="'.$opHpBarColor.'-gradient-bg" style="height: 15px; width: '.$opHpBarWidth.'%;"></div>
				</div>
			</td>
		</tr>
	';

	//if (/*$opponentTeam[$onum]['hp'] > 0 && $myTeam[$pnum]['hp'] > 0 && */ $_SESSION['battle']['screen'] != 'caughtpokemon') {
		if ((isset($omoveUsed, $odamageDone) || isset($moveUsed, $damageDone) || isset($itemMsg)) && $_SESSION['battle']['screen'] != 'caughtpokemon') {
			echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr>';
			
			if (isset($omoveUsed, $odamageDone)) {
				echo '<td>'.$opponentTeam[$onum]['name'].' '.$lang['battle_19'].' '.$omoveUsed.'<br /> '.$lang['battle_20'].' '.$odamageDone.' '.$lang['battle_21'];
				
				if (isset($oweakMessage)) {
					echo '<br /><br />'.$oweakMessage;
				}
				echo '</td>';
			}
			
			if (isset($moveUsed, $damageDone)) {
				echo '<td>'.$myTeam[$pnum]['name'].' '.$lang['battle_19'].' '.$moveUsed.'<br /> '.$lang['battle_20'].' '.$damageDone.' '.$lang['battle_21'];
				
				if (isset($weakMessage)) {
					echo '<br /><br />'.$weakMessage;
				}
				echo '</td>';
			}
			
			
			
			
			
			
			
			if (isset($itemMsg)) {
				echo '<td colspan="2">'.$itemMsg.'</td>';
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
		
		if ($opponentTeam[$onum]['hp'] > 0 && $myTeam[$pnum]['hp'] > 0 && $_SESSION['battle']['screen'] != 'caughtpokemon') {
		echo '
			
			<tr>
				<td style="align="left">
					<input type="radio" name="mnum" value="1" checked="checked" />&nbsp;'.$myTeam[$pnum]['move1'].'<br />
					<input type="radio" name="mnum" value="2" />&nbsp;'.$myTeam[$pnum]['move2'].'<br />
					<input type="radio" name="mnum" value="3" />&nbsp;'.$myTeam[$pnum]['move3'].'<br />
					<input type="radio" name="mnum" value="4" />&nbsp;'.$myTeam[$pnum]['move4'].'<br />
				</td>
				<td style="align="left">
					'.$opponentTeam[$onum]['move1'].'<br />
					'.$opponentTeam[$onum]['move2'].'<br />
					'.$opponentTeam[$onum]['move3'].'<br />
					'.$opponentTeam[$onum]['move4'].'<br />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="display: none;"><input class="button" type="submit" name="boop" value="'.$lang['battle_18'].'" /></div>
					<input class="button"  type="submit" value=" '.$lang['battle_18'].' " />
				</td>
			</tr>
		';
		}
		else {
		if ($opponentTeam[$onum]['hp'] <= 0) {
			echo '<tr><td colspan="2">'.$opponentTeam[$onum]['name'].' '.$lang['battle_22'].'</td></tr>';
		} else if ($myTeam[$pnum]['hp'] <= 0) {
			echo '<tr><td colspan="2">'.$myTeam[$pnum]['name'].' '.$lang['battle_22'].'</td></tr>';
		} else if ($_SESSION['battle']['screen'] == 'caughtpokemon') {
			echo '<tr><td colspan="2">'.$itemMsg.'</td></tr>';
		}
		echo '<tr><td colspan="2"><input class="button" type="submit" value="'.$lang['battle_23'].'" /></td></tr>';
		}
	//}
	echo '
	</table>
	</form>
	';
	
	if ($opponentTeam[$onum]['hp'] > 0 && $myTeam[$pnum]['hp'] > 0 && $_SESSION['battle']['screen'] != 'caughtpokemon') {
		$itemQuery = "SELECT * FROM `user_items` WHERE `uid`='{$uid}'";
		$userItems = fetchAssoc($itemQuery, $conn);
		
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
					<td colspan="3"><input class="button" type="submit" value="'.$lang['battle_24'].'" /></td>
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
			<h1>'.$lang['battle_25'].'</h1>
		</div>
	';

        $query = "SELECT * FROM users WHERE id = '$uid'";
        $info = fetchArray($query, 2, $conn);
        $clan = $info['clan'];
        $expu = rand(1,10000);
        if ($clan >= 1) {
        $conn->query("UPDATE `users` SET `clanxp`=`clanxp`+$expu WHERE `id`='{$uid}'");
        $conn->query("UPDATE `clans` SET `exp`=`exp`+$expu WHERE `id`='{$clan}'");
        }
	$conn->query("UPDATE `users` SET `won`=`won`+1, `battles`=`battles`+1 WHERE `id`='{$uid}'");
	
	$olevel = 0;
	foreach ($_SESSION['battle']['opponent'] as $opoke) {
		$olevel += $opoke['level'];
	}
		//Select user for premium
	$premiumQuery = "SELECT `premium` FROM `users` where `ID`='{$uid}'";
	$premium = fetchObj($premiumQuery, $conn);

		//Premium get 10% more Money
	if ($premium->premium == 2) {
		$money_premium = 4;
		$text_pre = $lang['battle_26'];
	} else {
		$money_premium = 3;
		$text_pre = $lang['battle_27'];
	}		
	
	$team = &$_SESSION['battle']['team'];
	$randMoney = rand(round($olevel*2.3), round($olevel*$money_premium)) * BATTLE_MONEY_MULTIPLIER;
	
	if ($randMoney < 1) {
		$randMoney = mt_rand(75,150) * BATTLE_MONEY_MULTIPLIER;
	}
	
	if ($randMoney > 150) {
		$randMoney = mt_rand(250,1000) * BATTLE_MONEY_MULTIPLIER;
	}
	
	$conn->query("UPDATE `users` SET `money`=`money`+{$randMoney} WHERE `id`='{$uid}'");
	
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
	if ($randExp > 3000) {
		$randExp = 1200;
	}
*/	
	foreach ($_SESSION['battle']['usedpokemon'] as $pnum) {		
		$newExp = $team[$pnum]['exp'] + $randExp;
		echo '
			<div style="text-align:center; margin-bottom: 20px;">
				<img src="images/pokemon/'.$team[$pnum]['name'].'.png" alt="'.$team[$pnum]['name'].'" /><br />
				'.$team[$pnum]['name'].' + '.$randExp.'exp<br />
			
		';
		
		$conn->query("UPDATE `user_pokemon` SET `exp`={$newExp} WHERE `id`='{$team[$pnum]['id']}'") or die('f');
		$conn->query("UPDATE `users` SET `trainer_exp`={$newExp} WHERE `id`='{$uid}'") or die('f');
		
		$newLevel = expToLevel($newExp);
	
			if ($newLevel > 10000) {
				$newLevel = 10000;
			}
			
		if ($newLevel != $team[$pnum]['level']) {
			$levelsGained = $newLevel - $team[$pnum]['level'];
			echo $team[$pnum]['name'] . ' '.$lang['battle_28'].' ' . $levelsGained . ' '.$lang['battle_29'].'.<br />';
			$conn->query("UPDATE `user_pokemon` SET `level`={$newLevel} WHERE `id`='{$team[$pnum]['id']}'");
		}
		
		echo '</div>';
	}
	
	if (isset($_SESSION['battle']['uid'])) {
		$wUid = $_SESSION['battle']['uid'];
		
		if ($wUid == getConfigValue('champion_uid', $conn) && $wUid != $uid) {
			setConfigValue('champion_uid', $uid, $conn);
			
			$lastTime = getConfigValue('champion_timestamp', $conn);
			$totalTime = time() - $lastTime;
			setConfigValue('champion_timestamp', time(), $conn);
			
			$conn->query("UPDATE `users` SET `champ_times`=`champ_times`+1 WHERE `id`='{$uid}' LIMIT 1");
			
			$qry = "SELECT * FROM `users` WHERE `id`='{$wUid}' LIMIT 1";
			$wRow = fetchAssoc($qry, $conn);
			$extraSql = ($totalTime > $wRow['champ_longest_run']) ? " ,`champ_longest_run`='{$totalTime}' " : '' ;
			$conn->query("UPDATE `users` SET `champ_total_time`=`champ_total_time`+{$totalTime} {$extraSql} WHERE `id`='{$wUid}' LIMIT 1");
			
			echo '<div>'.$lang['battle_30'].'</div>';
		}
	}

	$gymMsg = '';
	if (isset($_SESSION['battle']['badge'])) {
		$badge = $_SESSION['battle']['badge'];
		$gymleader = $_SESSION['battle']['gymleader'];

		$gymMsg = '
			<div>
				'.$lang['battle_31'].' '.$gymleader.' '.$lang['battle_32'].' '.$badge.' '.$lang['battle_33'].'
				<img src="images/badges/'.$badge.'.png" alt="'.$badge.' '.$lang['battle_33'].'" />
			</div>
		';
		
		$query = "SELECT `id` FROM `user_badges` WHERE `uid`='{$uid}' AND `badge`='{$badge}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			$conn->query("INSERT INTO `user_badges` (`uid`, `badge`) VALUES ('{$uid}', '{$badge}')");
		}
		
		logActivity($_SESSION['username'].' beat '.$gymleader, $uid, 'images/gyms/'.$gymleader.'.png', $conn);
	}
	
	echo '
		<div style="text-align:center;">
			<div>'.$lang['battle_34'].' $'.$randMoney.' '.$lang['battle_35'].'</div>
			<div>'.$text_pre.'</div>
			<div>'.$gymMsg.'</div>
		</div>
	';
	
	$rebattleLink = isset($_SESSION['battle']['rebattlelink']) ? $_SESSION['battle']['rebattlelink'].'<br />' : '' ;
	echo '
		<div style="text-align:center; margin: 30px 0px;">
			'.$rebattleLink.'
			<a href="team.php">'.$lang['battle_36'].'</a><br />
		</div>
	';
	
	unset($_SESSION['battle']);
	
} else if ($_SESSION['battle']['screen'] == 'losescreen') {
	$conn->query("UPDATE `users` SET `lost`=`lost`+1 WHERE `id`='{$uid}'");

	echo '
		<div style="text-align:center;">
			<h1>'.$lang['battle_37'].'</h1>
		</div>
	';
	
	$rebattleLink = isset($_SESSION['battle']['rebattlelink']) ? $_SESSION['battle']['rebattlelink'].'<br />' : '' ;
	echo '
		<div style="text-align:center; margin: 30px 0px;">
			'.$rebattleLink.'
			<a href="team.php">'.$lang['battle_36'].'</a><br />
		</div>
	';
	
	unset($_SESSION['battle']);
	
} else if ($_SESSION['battle']['screen'] == 'caughtpokemon') {

	$pokemon = $_SESSION['battle']['opponent'][ $_SESSION['battle']['onum'] ];
	
	logActivity($_SESSION['username'].' '.$lang['battle_38'].' '.$pokemon['name'], $uid, 'images/pokemon/'.$pokemon['name'].'.png', $conn);
	
	$level  = (int) $pokemon['level'];
	$name   = $pokemon['name'];
	$move1  = $pokemon['move1'];
	$move2  = $pokemon['move2'];
	$move3  = $pokemon['move3'];
	$move4  = $pokemon['move4'];
	
	$exp = levelToExp($level);
	// mysql_query("INSERT INTO `user_pokemon` (`uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`)
	// VALUES ('{$uid}', '{$name}', '{$level}', '{$exp}', '{$move1}', '{$move2}', '{$move3}', '{$move4}')");
	giveUserPokemon($uid, $name, $level, $exp, $move1, $move2, $move3, $move4, $conn);
	
        // $query = mysql_query("SELECT `id` FROM `user_pokemon` WHERE `uid`='{$uid}'");
        // $numPokes = mysql_num_rows($query);
       // if ($numPokes <= 6) {
       // if ($numPokes < 1) { $numPokes = 1; }
       // $pokeId = mysql_insert_id();
      // mysql_query("UPDATE `users` SET `poke{$numPokes}`='$pokeId' WHERE `id`='{$uid}'");
      // }
	
	echo '
		<div style="text-align:center;">
			<h1>'.$lang['battle_39'].' '.$pokemon['name'].'!</h1>
			<div><img src="images/pokemon/'.$pokemon['name'].'.png" alt="'.$pokemon['name'].'" /></div>
		</div>
	';
	
	$rebattleLink = isset($_SESSION['battle']['rebattlelink']) ? $_SESSION['battle']['rebattlelink'].'<br />' : '' ;
	echo '
		<div style="text-align:center; margin: 30px 0px;">
			'.$rebattleLink.'
			<a href="team.php">'.$lang['battle_36'].'</a><br />
		</div>
	';
	
	unset($_SESSION['battle']);
}
include '_footer.php';
?>

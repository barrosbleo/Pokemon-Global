<?php
include('modules/lib.php');
require_once 'pagination.class.php';


if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['trade_title']);
echo '
	<div style="text-align: center; margin: 10px 0px;">
		<a href="?a=puft">'.$lang['trade_00'].'</a> &bull;
		<a href="?a=vuft">'.$lang['trade_01'].'</a> &bull;
		<a href="?a=vao">'.$lang['trade_02'].'</a> &bull;
		<a href="?a=va">'.$lang['trade_03'].'</a>
	</div>
';

$uid = (int) $_SESSION['userid'];

switch ($_GET['a']) {
	case 'puft':
		require_once 'trade_puft.php';
	break;
	
	case 'puft_process':
		if (isset($_GET['id'])) {
			$_POST['pokemon'] = array($_GET['id']);
		}
		
		if (!isset($_POST['pokemon']) || count($_POST['pokemon']) == 0) {
			echo '<div class="error">'.$lang['trade_04'].'</div>';
			break;
		}
		
		foreach ($_POST['pokemon'] as $key => $value) {
			$_POST['pokemon'][$key] = (int) $value;	
		}
		
		$query = "SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}'";
		$myTeam = fetchAssoc($query, $conn);
		
		$nonInTeamSql = " `id` NOT IN ('".implode("', '", $myTeam)."') ";
		$puftSql = " `id` IN ('".implode("', '", $_POST['pokemon'])."') ";
		$query = "SELECT * FROM `user_pokemon` WHERE {$nonInTeamSql} AND {$puftSql} AND `uid`='{$uid}' ORDER BY `name`";
		
		if ( numRows($query, $conn) != count($_POST['pokemon']) ) {
			echo '<div class="error">'.$lang['trade_05'].'</div>';
			break;
		}
		
		echo '<div class="notice">'.$lang['trade_06'].'</div>';
		
		echo '<div style="text-align: center;">';
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			echo '
				<img src="images/pokemon/'.$p['name'].'.png" /><br />
				'.$p['name'].'<br />
				'.$lang['trade_07'].' '.$p['level'].'<br />
			';
			$p['name'] = $conn->real_escape_string($p['name']);
			$conn->query("INSERT INTO `trade_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `user_pokemon` WHERE `id`='{$p['id']}'");
		}
		echo '</div>';
	break;
	
	case 'vuft':		
		require_once 'trade_vuft.php';
	break;

	case 'mao':
		$tid = (int) $_GET['id'];
		$query = "SELECT * FROM `trade_pokemon` WHERE `id`='{$tid}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['trade_08'].'</div>';
			break;
		}
		
		$tpoke = fetchAssoc($query, $conn);
		echo '
			<div style="text-align: center;">
				<img src="images/pokemon/'.$tpoke['name'].'.png" /><br />
				'.$tpoke['name'].'<br />
				'.$lang['trade_07'].' '.number_format($tpoke['level']).'
			</div>
		';
		
		$query = "SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}'";
		$myTeam = fetchAssoc($query, $conn);
		
		$nonInTeamSql = " `id` NOT IN ('".implode("', '", $myTeam)."') ";
		$query = "SELECT * FROM `user_pokemon` WHERE {$nonInTeamSql} AND `uid`='{$uid}' ORDER BY `name`";
		
		echo '
			<form action="?a=mao_process&id='.$tid.'" method="post">
			<table class="pretty-table">
				<tr>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>'.$lang['trade_09'].'</th>
					<th>'.$lang['trade_10'].'</th>
					<th>'.$lang['trade_11'].'</th>
					<th>'.$lang['trade_12'].'</th>
				</tr>
		';
$result = $conn->query($query);
		while ($pokemon = $result->fetch_assoc()) {
			echo '
				<tr>
					<td><input type="checkbox" name="pokemon[]" value="'.$pokemon['id'].'" /></td>
					<td><img src="images/pokemon/'.$pokemon['name'].'.png" /></td>
					<td>'.$pokemon['name'].'</td>
					<td>'.number_format($pokemon['level']).'</td>
					<td>'.number_format($pokemon['exp']).'</td>
					<td>
						'.$pokemon['move1'].'<br />
						'.$pokemon['move2'].'<br />
						'.$pokemon['move3'].'<br />
						'.$pokemon['move4'].'
					</td>
				</tr>
			';
		}
		echo '
				<tr>
					<td colspan="6"><input class="smallbutton" type="submit" value="'.$lang['trade_13'].'" /></td>
				</tr>
			</table>
			</form>
		';
	break;
	
	case 'mao_process':
		//print_r($_POST);
		
		$tid = (int) $_GET['id'];
		$query = "SELECT * FROM `trade_pokemon` WHERE `id`='{$tid}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['trade_14'].'</div>';
			break;
		}
		
		if (!isset($_POST['pokemon']) || count($_POST['pokemon']) == 0) {
			echo '<div class="error">'.$lang['trade_15'].'</div>';
			break;
		}
		
		foreach ($_POST['pokemon'] as $key => $value) {
			$_POST['pokemon'][$key] = (int) $value;	
		}
		
		$query = "SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}'";
		$myTeam = fetchAssoc($query, $conn);
		
		$nonInTeamSql = " `id` NOT IN ('".implode("', '", $myTeam)."') ";
		$offerSql = " `id` IN ('".implode("', '", $_POST['pokemon'])."') ";
		$query = "SELECT * FROM `user_pokemon` WHERE {$nonInTeamSql} AND {$offerSql} AND `uid`='{$uid}' ORDER BY `name`";
		
		if ( numRows($query, $conn) != count($_POST['pokemon']) ) {
			echo '<div class="error">'.$lang['trade_16'].'</div>';
			break;
		}
		
		$query2 = "SELECT `oid` FROM `offer_pokemon` ORDER BY `oid` DESC LIMIT 1";
		$oid = fetchAssoc($query2, $conn);
		$oid = $oid['oid']+1;
		
		echo '<div class="notice">'.$lang['trade_17'].'</div>';
		
		echo '<div style="text-align: center;">';
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			echo '
				<img src="images/pokemon/'.$p['name'].'.png" /><br />
				'.$p['name'].'<br />
				'.$lang['trade_07'].' '.$p['level'].'<br />
			';
			
			$p['name'] = $conn->real_escape_string($p['name']);
			
			$conn->query("INSERT INTO `offer_pokemon` (`tid`, `oid`, `uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$tid}', '{$oid}', '{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `user_pokemon` WHERE `id`='{$p['id']}'");
		}
		echo '</div>';
	break;
	
	case 'vao':
		$query = "SELECT * FROM `trade_pokemon` WHERE `uid`='{$uid}'";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['trade_18'].'</div>';
			break;
		}
		
		echo '
			<table class="pretty-table" style="width:99%;">
				<tr>
					<th>'.$lang['trade_09'].'</th>
					<th>'.$lang['trade_11'].'</th>
					<th>'.$lang['trade_12'].'</th>
					<th>'.$lang['trade_19'].'</th>
				</tr>
		';
$result = $conn->query($query);
		while ($pokemon = $result->fetch_assoc()) {
			$query2 = "SELECT * FROM `offer_pokemon` WHERE `tid`='{$pokemon['id']}' GROUP BY `oid`";
			$numOffers = numRows($query2, $conn);
			echo '
				<tr>
					<td rowspan="3"><img style="width:60px;" src="images/pokemon/'.$pokemon['name'].'.png" /></br>
					'.$pokemon['name'].'</td>
					<td>'.number_format($pokemon['exp']).'Xp</td>
					<td rowspan="3">
						'.$pokemon['move1'].'<br />
						'.$pokemon['move2'].'<br />
						'.$pokemon['move3'].'<br />
						'.$pokemon['move4'].'
					</td>
					<td rowspan="3">
						<a href="?a=vo&id='.$pokemon['id'].'">View&nbsp;Offers&nbsp;('.$numOffers.')</a><br /><br />
						<a href="?a=remove&id='.$pokemon['id'].'">'.$lang['trade_20'].'</a><br />
					</td>
				</tr>
				<tr>
				<th>'.$lang['trade_10'].'</th>
				</tr>
				<tr>
				<td>'.number_format($pokemon['level']).'</td>
				</tr>
			';
		}
		echo '
			</table>
		';
	break;
	
	case 'vo':
		$tid = (int) $_GET['id'];
		
		$query = "SELECT * FROM `trade_pokemon` WHERE `uid`='{$uid}' AND `id`='{$tid}'";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['trade_21'].'</div>';
			break;
		}
		
		$tpoke = fetchAssoc($query, $conn);
		echo '
			<div style="text-align: center;">
				<img src="images/pokemon/'.$tpoke['name'].'.png" /><br />
				'.$tpoke['name'].'<br />
				'.$lang['trade_07'].' '.number_format($tpoke['level']).'
			</div>
		';
		
		$query = "SELECT * FROM `offer_pokemon` WHERE `tid`='{$tid}'";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="info">'.$lang['trade_22'].'</div>';
			break;
		}
		
		$offers = array();
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			$query2 = "SELECT * FROM `users` WHERE `id`='{$p['uid']}'";
			$username = fetchAssoc($query2, $conn);
			$username = $username['username'];
			$p['username'] = $username;
			$offers[$p['oid']][] = $p;
		}
		//echo '<pre>';
		//print_r($offers);
		//echo '</pre>';
		
		
		
		foreach ($offers as $oid => $pokemons) {			
			echo '
				<table class="pretty-table">
					<tr>
						<th>&nbsp;</th>
						<th>'.$lang['trade_09'].'</th>
						<th>'.$lang['trade_10'].'</th>
						<th>'.$lang['trade_11'].'</th>
						<th>'.$lang['trade_12'].'</th>
						<th>'.$lang['trade_23'].'</th>
					</tr>
			';
			foreach ($pokemons as $pokemon) {
				echo '
					<tr>
						<td><img src="images/pokemon/'.$pokemon['name'].'.png" /></td>
						<td>'.$pokemon['name'].'</td>
						<td>'.number_format($pokemon['level']).'</td>
						<td>'.number_format($pokemon['exp']).'</td>
						<td>
							'.$pokemon['move1'].'<br />
							'.$pokemon['move2'].'<br />
							'.$pokemon['move3'].'<br />
							'.$pokemon['move4'].'
						</td>
						<td>'.htmlspecialchars($pokemon['username']).'</td>
				';

				echo '
					</tr>
				'; 
			}
			echo '
					<tr>
						<td colspan="6">
							<a href="?a=accept&id='.$oid.'">'.$lang['trade_24'].'</a> &bull; 
							<a href="?a=decline&id='.$oid.'">'.$lang['trade_25'].'</a>
						</td>
					</tr>
				</table>
			';
		}
		
	break;
	
	case 'decline':
		$oid = (int) $_GET['id'];
		
		$query = "SELECT `tid` FROM `offer_pokemon` WHERE `oid`='{$oid}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="notice">'.$lang['trade_26'].'</div>';
			break;
		}
		$row = fetchAssoc($query, $conn);
		
		$query = "SELECT `uid` FROM `trade_pokemon` WHERE `id`='{$row['tid']}' LIMIT 1";
		$row = fetchAssoc($query, $conn);
		
		if ($row['uid'] != $uid) {
			echo '<div class="notice">'.$lang['trade_27'].'</div>';
			break;
		}
		
		echo '<div class="notice">'.$lang['trade_28'].'</div>';
		
		$query = "SELECT * FROM `offer_pokemon` WHERE `oid`='{$oid}'";
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			$p['name'] = $conn->real_escape_string($p['name']);
			$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `offer_pokemon` WHERE `id`='{$p['id']}'");
		}
	break;
	
	case 'accept':
		$oid = (int) $_GET['id'];
		
		$query = "SELECT `tid` FROM `offer_pokemon` WHERE `oid`='{$oid}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="notice">'.$lang['trade_26'].'</div>';
			break;
		}
		$row = fetchAssoc($query, $conn);
		$tid = $row['tid'];
		
		$query = "SELECT `uid` FROM `trade_pokemon` WHERE `id`='{$tid}' LIMIT 1";
		$row = fetchAssoc($query, $conn);
		
		if ($row['uid'] != $uid) {
			echo '<div class="notice">'.$lang['trade_27'].'</div>';
			break;
		}
		
		echo '<div class="notice">'.$lang['trade_29'].'</div>';
		
		
		$query = "SELECT * FROM `offer_pokemon` WHERE `oid`='{$oid}'";
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			$tuid = $p['uid'];
			$p['name'] = $conn->real_escape_string($p['name']);
			$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$uid}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `offer_pokemon` WHERE `id`='{$p['id']}'");
		}
		
		$query = "SELECT * FROM `offer_pokemon` WHERE `tid`='{$tid}'";
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			$p['name'] = $conn->real_escape_string($p['name']);
			$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `offer_pokemon` WHERE `id`='{$p['id']}'");
		}
		
		
		$query = "SELECT * FROM `trade_pokemon` WHERE `id`='{$tid}'";
		$p = fetchAssoc($query, $conn);
		$p['name'] = $conn->real_escape_string($p['name']);
		$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$tuid}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
		$conn->query("DELETE FROM `trade_pokemon` WHERE `id`='{$p['id']}'");
	break;
	
	case 'remove':
		$tid = (int) $_GET['id'];
		
		$query = "SELECT `uid` FROM `trade_pokemon` WHERE `id`='{$tid}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="notice">'.$lang['trade_30'].'</div>';
			break;
		}
		$row = fetchAssoc($query, $conn);
	
		if ($row['uid'] != $uid) {
			echo '<div class="notice">'.$lang['trade_27'].'</div>';
			break;
		}
		
		echo '<div class="notice">'.$lang['trade_31'].'</div>';
		
		
		$query = "SELECT * FROM `offer_pokemon` WHERE `tid`='{$tid}'";
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			//$tuid = $p['uid'];
			$p['name'] = $conn->real_escape_string($p['name']);
			$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `offer_pokemon` WHERE `id`='{$p['id']}'");
		}
		
		$query = "SELECT * FROM `trade_pokemon` WHERE `id`='{$tid}'";
		$p = fetchAssoc($query, $conn);
		$p['name'] = $conn->real_escape_string($p['name']);
		$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
		$conn->query("DELETE FROM `trade_pokemon` WHERE `id`='{$p['id']}'");
	break;
	
	case 'va':	
		$query = "SELECT * FROM `offer_pokemon` WHERE `uid`='{$uid}'";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['trade_32'].'</div>';
			break;
		}
		
		$offers = array();
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			$query2 = "SELECT * FROM `trade_pokemon` WHERE `id`='{$p['tid']}'";
			$tradeRow = fetchAssoc($query2, $conn);

			$query2 = "SELECT * FROM `users` WHERE `id`='{$tradeRow['uid']}'";
			$userRow = fetchAssoc($query2, $conn);
			
			$tradeRow['username'] = $userRow['username'];
			$p['r'] = $tradeRow;
			$offers[$p['oid']][] = $p;
		}
		//echo '<pre>';
		//print_r($offers);
		//echo '</pre>';
		
		
		
		foreach ($offers as $oid => $pokemons) {			
			echo '
				<table class="pretty-table">
					<tr>
						<th>&nbsp;</th>
						<th>'.$lang['trade_09'].'</th>
						<th>'.$lang['trade_10'].'</th>
						<th>'.$lang['trade_11'].'</th>
						<th>'.$lang['trade_12'].'</th>
					</tr>
			';
			foreach ($pokemons as $pokemon) {
				echo '
					<tr>
						<td><img src="images/pokemon/'.$pokemon['name'].'.png" /></td>
						<td>'.$pokemon['name'].'</td>
						<td>'.number_format($pokemon['level']).'</td>
						<td>'.number_format($pokemon['exp']).'</td>
						<td>
							'.$pokemon['move1'].'<br />
							'.$pokemon['move2'].'<br />
							'.$pokemon['move3'].'<br />
							'.$pokemon['move4'].'
						</td>
				';

				echo '
					</tr>
				'; 
			}
			echo '
					<tr>
						<td colspan="5">
							'.$lang['trade_33'].'<br />
							<img src="images/pokemon/'.$pokemon['r']['name'].'.png" /><br />
							'.$lang['trade_34'].' '.htmlspecialchars($pokemon['r']['username']).'<br />
							'.$lang['trade_07'].' '.number_format($pokemon['r']['level']).'<br />
							'.$lang['trade_35'].' '.number_format($pokemon['r']['exp']).'<br /><br />
							<a href="?a=reo&id='.$oid.'">'.$lang['trade_36'].'</a>
						</td>
					</tr>
				</table>
			';
		}
		
	break;
	
	case 'reo':
		$oid = (int) $_GET['id'];
		
		$query = "SELECT `uid` FROM `offer_pokemon` WHERE `oid`='{$oid}' LIMIT 1";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['trade_37'].'</div>';
			break;
		}
		$row = fetchAssoc($query, $conn);
	
		if ($row['uid'] != $uid) {
			echo '<div class="error">'.$lang['trade_27'].'</div>';
			break;
		}
		
		echo '<div class="notice">'.$lang['trade_38'].'</div>';
		
		
		$query = "SELECT * FROM `offer_pokemon` WHERE `oid`='{$oid}'";
$result = $conn->query($query);
		while ($p = $result->fetch_assoc()) {
			//$tuid = $p['uid'];
			$p['name'] = $conn->real_escape_string($p['name']);
			$conn->query("INSERT INTO `user_pokemon` (`uid`, `name`, `exp`, `level`, `move1`, `move2`, `move3`, `move4`)
				VALUES ('{$p['uid']}', '{$p['name']}', '{$p['exp']}', '{$p['level']}', '{$p['move1']}', '{$p['move2']}', '{$p['move3']}', '{$p['move4']}')");
				
			$conn->query("DELETE FROM `offer_pokemon` WHERE `id`='{$p['id']}'");
		}
	break;
}





include '_footer.php';
echo '</div>';

?>
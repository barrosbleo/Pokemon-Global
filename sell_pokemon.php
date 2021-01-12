<?php
include('modules/lib.php');
require_once 'pagination.class.php';

if (!isLoggedIn()) {
redirect('login.php');
}

include '_header.php';
printHeader($lang['sell_poke_title']);

$uid = (int) $_SESSION['userid'];

$userMoney = getUserMoney($uid);

echo '
	<div style="text-align: center; margin: 10px 0;">
		<a href="?p=sell">'.$lang['sell_poke_00'].'</a> &bull; 
		<a href="?p=mine">'.$lang['sell_poke_01'].'</a> &bull; 
		<a href="?p=all">'.$lang['sell_poke_02'].'</a> &bull; 
		<a href="?p=history">'.$lang['sell_poke_03'].'</a>
		
		<br /><br />
		
		'.$lang['sell_poke_04'].' $'.number_format($userMoney).'
	</div>
';

switch (isset($_GET['p'])) {
	case 'sell':
		$query = mysql_query("SELECT * FROM `users` WHERE `id`='{$uid}' LIMIT 1");
		$myTeam = mysql_fetch_assoc($query);
		
		$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `uid`='{$uid}' AND `id` NOT IN ('{$myTeam['poke1']}', '{$myTeam['poke2']}', '{$myTeam['poke3']}', '{$myTeam['poke4']}', '{$myTeam['poke5']}', '{$myTeam['poke6']}')");
		
		if (mysql_num_rows($query) == 0) {
			echo '<div class="info">'.$lang['sell_poke_05'].'</div>';
			break;
		}
		
		echo '
			<table class="pretty-table">
				<tr>
					<th>&nbsp;</th>
					<th>'.$lang['sell_poke_06'].'</th>
					<th>'.$lang['sell_poke_07'].'</th>
					<th>'.$lang['sell_poke_08'].'</th>
					<th>'.$lang['sell_poke_09'].'</th>
					<th>'.$lang['sell_poke_10'].'</th>
				</tr>
		';
		while ($pokemon = mysql_fetch_assoc($query)) {
			echo '
				<tr>
					<td><a href="pinfo.php?id='.$pokemon['id'].'"><img src="images/pokemon/'.$pokemon['name'].'.png" /></a></td>
					<td>'.$pokemon['name'].'</td>
					<td>'.$pokemon['level'].'</td>
					<td>'.number_format($pokemon['exp']).'</td>
					<td>
						'.$pokemon['move1'].'<br />
						'.$pokemon['move2'].'<br />
						'.$pokemon['move3'].'<br />
						'.$pokemon['move4'].'<br />
					</td>
					<td>
						<a href="?p=sell2&id='.$pokemon['id'].'">'.$lang['sell_poke_11'].'</a>
					</td>
				</tr>
			';
		}
		echo '</table>';
	break;
	
	case 'sell2':
		$pid = (int) $_GET['id'];
		$query = mysql_query("SELECT `poke1`,`poke2`,`poke3`,`poke4`,`poke5`,`poke6` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
		$myTeam = mysql_fetch_assoc($query);
		
		$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `uid`='{$uid}' AND `id`='{$pid}'");
		
		if (mysql_num_rows($query) == 0 || in_array($pid, $myTeam)) {
			echo '<div class="error">'.$lang['sell_poke_12'].'</div>';
			break;
		}
		
		$pokemon = mysql_fetch_assoc($query);
		
		echo '
			<table class="pretty-table"><tr><td>'.$lang['sell_poke_13'].' '.$pokemon['name'].'</td></tr><tr>
				<td><img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
				<strong>'.$pokemon['name'].'</strong><br />
				'.$lang['sell_poke_14'].' '.$pokemon['level'].'<br />
				'.$lang['sell_poke_15'].' '.number_format($pokemon['exp']).'</td></tr><tr><td>
		';
			
		if (isset($_POST['price'])) {
			$price = (int) $_POST['price'];
			$price = $price < 1 ? 1000 : $price ;
			echo '<div class="notice">'.$lang['sell_poke_16'].' $'.number_format($price).'.</div>';
			
			$username = cleanSql($_SESSION['username']);
			mysql_query("DELETE FROM `user_pokemon` WHERE `id`='{$pid}' LIMIT 1");
			mysql_query("INSERT INTO `sale_pokemon` (
				`name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `uid`, `username`, `price`
				) VALUES (
				'{$pokemon['name']}', '{$pokemon['level']}', '{$pokemon['exp']}', '{$pokemon['move1']}', '{$pokemon['move2']}', '{$pokemon['move3']}', '{$pokemon['move4']}', '{$uid}', '{$username}', '{$price}'
				)
			");
			mysql_query("UPDATE `users` SET `total_sale_pokes`=`total_sale_pokes`+1 WHERE `id`='{$uid}' LIMIT 1");
		} else {
			echo '
				<form action="?p=sell2&id='.$pid.'" method="post">
					Price: <input type="text" name="price" value="1000" />
					<input type="submit" value="'.$lang['sell_poke_17'].'" />
				</form>
			';
		}
		echo '</td></tr></table>';
		
	break;
	
	case 'mine':
		$query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid`='{$uid}'");
		
		if (mysql_num_rows($query) == 0) {
			echo '<div class="info">'.$lang['sell_poke_18'].'</div>';
			break;
		}
		
		echo '
			<table class="pretty-table">
				<tr>
					<th>&nbsp;</th>
					<th>'.$lang['sell_poke_19'].'</th>
					<th>'.$lang['sell_poke_20'].'</th>
					<th>'.$lang['sell_poke_21'].'</th>
					<th>'.$lang['sell_poke_22'].'</th>
					<th>'.$lang['sell_poke_23'].'</th>
					<th>'.$lang['sell_poke_24'].'</th>
				</tr>
		';
		while ($pokemon = mysql_fetch_assoc($query)) {
			echo '
				<tr>
					<td><img src="images/pokemon/'.$pokemon['name'].'.png" /></td>
					<td>'.$pokemon['name'].'</td>
					<td>'.$pokemon['level'].'</td>
					<td>'.number_format($pokemon['exp']).'</td>
					<td>
						'.$pokemon['move1'].'<br />
						'.$pokemon['move2'].'<br />
						'.$pokemon['move3'].'<br />
						'.$pokemon['move4'].'<br />
					</td>
					<td>$'.number_format($pokemon['price']).'</td>
					<td>
						<a href="?p=remove&id='.$pokemon['id'].'">'.$lang['sell_poke_25'].'</a>
					</td>
				</tr>
			';
		}
		echo '</table>';
	break;
	
	case 'remove':
		$pid = (int) $_GET['id'];
		
		$query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid`='{$uid}' AND `id`='{$pid}'");
		
		if (mysql_num_rows($query) == 0) {
			echo '<div class="error">'.$lang['sell_poke_26'].'</div>';
			break;
		}
		
		$pokemon = mysql_fetch_assoc($query);
		
		echo '
			<div style="text-align: center;">
				<img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
				'.$pokemon['name'].'<br />
				'.$lang['sell_poke_20'].' '.$pokemon['level'].'<br />
				'.$lang['sell_poke_21'].' '.number_format($pokemon['exp']).'<br /><br /><br />
				'.$pokemon['name'].' '.$lang['sell_poke_27'].'
			</div>
		';
		
		mysql_query("DELETE FROM `sale_pokemon` WHERE `id`='{$pid}' LIMIT 1");
		mysql_query("UPDATE `users` SET `total_sale_pokes`=`total_sale_pokes`-1 WHERE `id`='{$uid}' LIMIT 1");
        giveUserPokemon($uid, $pokemon['name'], $pokemon['level'], $pokemon['exp'], $pokemon['move1'], $pokemon['move2'], $pokemon['move3'], $pokemon['move4']);

	break;
	
	case 'all':

		$sorts = array
		(
		    1 => ' ORDER BY `name` ASC',
		    2 => ' ORDER BY `name` DESC',
		    3 => ' ORDER BY `exp` ASC',
		    4 => ' ORDER BY `exp` DESC',
		    5 => ' ORDER BY `price` ASC',
		    6 => ' ORDER BY `price` DESC',
		    7 => ' ORDER BY `id` ASC',
		    8 => ' ORDER BY `id` DESC'
		);

		$search    = isset($_GET['search']) ? $_GET['search'] : '' ;
		$searchSql = '';

		$sort      = $_GET['sort'];
		$sortKey   = isset($sort) && in_array($sort, array_keys($sorts)) ? $sort : 5 ;
		$orderSql  = $sorts[$sortKey];

		if (!empty($search)) {
			$searchSqlSafe  = cleanSql($search);
			$searchHtmlSafe = cleanHtml($search);
			$searchSql      = " AND `name` LIKE '%{$searchSqlSafe}%' ";
		}

		$countQuery = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid` != '{$uid}' {$searchSql}");
		$numRows    = mysql_num_rows($countQuery);
		$pagination = new Pagination($numRows);

		if (!empty($search)) {
			$pagination->addQueryStringVar('search', $_GET['search']);
		}
		$pagination->addQueryStringVar('p', 'all');

		$query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid` != '{$uid}' {$searchSql} {$orderSql} LIMIT {$pagination->itemsPerPage} OFFSET {$pagination->startItem}");



		$qs = '';
		$qs .= 'p=all';
		if (!empty($search)) {
			$qs .= '&amp;search=' . urlencode($search);
		}

		$nameOrder  = $_GET['sort'] == 1 ? 2 : 1 ;
		$expOrder   = $_GET['sort'] == 3 ? 4 : 3 ;
		$priceOrder = $_GET['sort'] == 6 ? 5 : 6 ;
		$idOrder    = $_GET['sort'] == 7 ? 8 : 7 ;

		echo '
			<form method="get" action="" style="text-align: center; margin: 20px 0px;">
				<input type="hidden" value="all" name="p" />
				Search For: <input type="text" name="search" value="'.$searchHtmlSafe.'" />
				<input type="submit" value="'.$lang['sell_poke_28'].'" />
			</form>
		';

		if (mysql_num_rows($query) == 0) {
			echo '<div class="info">'.$lang['sell_poke_29'].'</div>';
		} else {
			if (mysql_num_rows($query) == 0) {
				echo '<div class="info">'.$lang['sell_poke_30'].'</div>';
				break;
			}
		
			echo '
				<table class="pretty-table">
					<tr>
						<th><a href="?'.$qs.'&amp;sort='.$idOrder.'">'.$lang['sell_poke_31'].'</a></th>
						<th><a href="?'.$qs.'&amp;sort='.$nameOrder.'">'.$lang['sell_poke_32'].'</a></th>
						<th>'.$lang['sell_poke_33'].'</th>
						<th><a href="?'.$qs.'&amp;sort='.$expOrder.'">'.$lang['sell_poke_34'].'</a></th>
						<th>'.$lang['sell_poke_35'].'</th>
						<th><a href="?'.$qs.'&amp;sort='.$priceOrder.'">'.$lang['sell_poke_36'].'</a></th>
						<th>'.$lang['sell_poke_37'].'</th>
					</tr>
			';
			
			while ($pokemon = mysql_fetch_assoc($query)) {
				echo '
					<tr>
						<td>'.number_format($pokemon['id']).'</td>
						<td><img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
						'.$pokemon['name'].'</td>
						<td>'.number_format($pokemon['level']).'</td>
						<td>'.number_format($pokemon['exp']).'</td>
						<td>
							'.$pokemon['move1'].'<br />
							'.$pokemon['move2'].'<br />
							'.$pokemon['move3'].'<br />
							'.$pokemon['move4'].'<br />
						</td>
						<td>$'.number_format($pokemon['price']).'</td>
						<td>
							<a href="?p=buy&id='.$pokemon['id'].'">'.$lang['sell_poke_38'].'</a><br />
							from <a href="profile.php?id='.$pokemon['uid'].'">'.cleanHtml($pokemon['username']).'</a>
						</td>
					</tr>
				';
			}
			echo '</table>';
	
			$pagination->echoPagination();
		}
	break;
	
	case 'buy':
		$pid = (int) $_GET['id'];
		
		$query = mysql_query("SELECT * FROM `sale_pokemon` WHERE `uid`!='{$uid}' AND `id`='{$pid}'");
		
		if (mysql_num_rows($query) == 0) {
			echo '<div class="error">'.$lang['sell_poke_39'].'</div>';
			break;
		}
		
		$pokemon = mysql_fetch_assoc($query);
		
		echo '
			<table class="pretty-table">
				<tr><td>
'.$lang['sell_poke_40'].' '.$pokemon['name'].'?</td></tr><tr><td><center><img src="images/pokemon/'.$pokemon['name'].'.png" /><br />
				'.$pokemon['name'].'<br />
				'.$lang['sell_poke_14'].' '.$pokemon['level'].'<br />
				'.$lang['sell_poke_15'].' '.number_format($pokemon['exp']).'</td></tr><tr><td>
		';
		 
		if (isset($_POST['sure'])) {
			$query = mysql_query("SELECT `money` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
			$userMoney = mysql_fetch_assoc($query);
			$userMoney = $userMoney['money'];
			$query2 = mysql_query("SELECT `username` FROM `users` WHERE `id`='{$uid}' LIMIT 1");
			$userMoney2 = mysql_fetch_assoc($query2);
			$userMoney2 = $userMoney2['username'];

			if ($userMoney < $pokemon['price']) {
				echo '<div class="error">'.$lang['sell_poke_41'].'</div>';
			} else {
				mysql_query("DELETE FROM `sale_pokemon` WHERE `id`='{$pid}' LIMIT 1");
				mysql_query("UPDATE `users` SET `money`=`money`-{$pokemon['price']} WHERE `id`='{$uid}'");
				mysql_query("UPDATE `users` SET `money`=`money`+{$pokemon['price']} , `newly_sold_pokes`=`newly_sold_pokes`+1 , `total_sale_pokes`=`total_sale_pokes`-1 WHERE `id`='{$pokemon['uid']}'");
                                send_event($pokemon['uid'], "$userMoney2 ".$lang['sell_poke_42']);
				/*mysql_query("INSERT INTO `user_pokemon` (
					`name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `uid`
					) VALUES (
					'{$pokemon['name']}', '{$pokemon['lekemon['move2']}', '{$pokemon['move3']}', '{$pokemon['move4']}', '{$uid}'
					)
				");*/
giveUserPokemon($uid, $pokemon['name'], $pokemon['level'], $pokemon['exp'], $pokemon['move1'], $pokemon['move2'], $pokemon['move3'], $pokemon['move4']);
				
				/*$query = mysql_query("SELECT `id` FROM `user_pokemon` WHERE `uid`='{$uid}'");
				$numPokes = mysql_num_rows($query);
				if ($numPokes <= 6) {
					if ($numPokes < 1) { $numPokes = 1; }
					$pokeId = mysql_insert_id();
					mysql_query("UPDATE `users` SET `poke{$numPokes}`='$pokeId' WHERE `id`='{$uid}'");
				}*/
				
				$username = mysql_real_escape_string($_SESSION['username']);
				mysql_query("INSERT INTO `sale_history` (
					`name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `uid`, `username`, `soldto`, `sid`, `price`
					) VALUES (
					'{$pokemon['name']}', '{$pokemon['level']}', '{$pokemon['exp']}', '{$pokemon['move1']}', '{$pokemon['move2']}', '{$pokemon['move3']}', '{$pokemon['move4']}', '{$pokemon['uid']}', '{$pokemon['username']}', '{$username}', '{$uid}', '{$pokemon['price']}'
					)
				");
				
				
				
				echo '<div class="notice">'.$lang['sell_poke_43'].' '.$pokemon['name'].' for $'.number_format($pokemon['price']).'.</div>';
			}
		} else {
			echo '
				<form action="?p=buy&id='.$pokemon['id'].'" method="post">
					<input type="submit" name="sure" value="'.$lang['sell_poke_44'].' '.$pokemon['name'].' '.$lang['sell_poke_45'].' $'.number_format($pokemon['price']).'" />
				</form>
			';
		}
		echo '</td></tr></table>';
		
	break;
	
	case 'history':
		$query = mysql_query("SELECT * FROM `sale_history` WHERE `uid`='{$uid}' AND `udeleted`='0' OR `sid`='{$uid}' AND `sdeleted`='0'");
		
		mysql_query("UPDATE `sale_history` SET `seen`='1' WHERE `uid`='{$uid}' AND `udeleted`='0' OR `sid`='{$uid}' AND `sdeleted`='0'");
		
		mysql_query("UPDATE `users` SET `newly_sold_pokes`='0' WHERE `id`='{$uid}'");
		
		if (mysql_num_rows($query) == 0) {
			echo '<div class="info">'.$lang['sell_poke_46'].'</div>';
			break;
		}
		
		echo '
			<p style="text-align: center;"><a href="?p=clear_history">'.$lang['sell_poke_47'].'</a></p>
			<table class="pretty-table">
				<tr>
					<th>&nbsp;</th>
					<th>'.$lang['sell_poke_48'].'</th>
					<th>'.$lang['sell_poke_49'].'</th>
					<th>'.$lang['sell_poke_50'].'</th>
					<th>'.$lang['sell_poke_51'].'</th>
					<th>'.$lang['sell_poke_52'].'</th>
				</tr>
		';
		while ($pokemon = mysql_fetch_assoc($query)) {
			echo '
				<tr>
					<td><a href="pinfo.php?id='.$pokemon['id'].'"><img src="images/pokemon/'.$pokemon['name'].'.png" /></a></td>
					<td>'.$pokemon['name'].'</td>
					<td>'.$pokemon['level'].'</td>
					<td>'.number_format($pokemon['exp']).'</td>
					<td>
						'.$pokemon['move1'].'<br />
						'.$pokemon['move2'].'<br />
						'.$pokemon['move3'].'<br />
						'.$pokemon['move4'].'<br />
					</td>
					<td>
			';
			if ($uid == $pokemon['sid']) {
				echo '
					'.$lang['sell_poke_53'].' <br />
					<strong><a href="profile.php?id='.$pokemon['sid'].'">'.cleanHtml($pokemon['username']).'</a></strong><br />
					'.$lang['sell_poke_54'].' <br />
					<strong>$'.number_format($pokemon['price']).'</strong>.
				';
			} else {
				echo '
					'.$lang['sell_poke_55'].' <br />
					<strong><a href="profile.php?id='.$pokemon['sid'].'">'.cleanHtml($pokemon['soldto']).'</a></strong><br />
					'.$lang['sell_poke_54'].' <br />
					<strong>$'.number_format($pokemon['price']).'</strong>.
				';
			}
			echo '
					</td>
				</tr>
			';
		}
		echo '</table>';
	break;
	
	case 'clear_history':
		mysql_query("UPDATE `users` SET `newly_sold_pokes`='0' WHERE `id`='{$uid}'");
		mysql_query("UPDATE `sale_history` SET `udeleted`='1' WHERE `uid`='{$uid}'") or die(mysql_error());
		mysql_query("UPDATE `sale_history` SET `sdeleted`='1' WHERE `sid`='{$uid}'") or die(mysql_error());
		mysql_query("DELETE FROM `sale_history` WHERE `sdeleted`='1' AND `udeleted`='1'") or die(mysql_error());
		
		echo '<div class="notice">'.$lang['sell_poke_56'].'</div>';
	break;
}

include '_footer.php';
?>
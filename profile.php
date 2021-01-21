<?php
include('modules/lib.php');
require_once 'gym_functions.php';
//$linkr = 2;
include 'bbcode.php';
if (!isLoggedIn()) {
	redirect('index.php');
}
include '_header.php';
printHeader($lang['profile_00']);

$uid = (int) (isset($_GET['id']) ? $_GET['id'] : $_SESSION['userid'] );
$defaultAvatar = 'http://localhost/images/pokemon/Magikarp.png';

$query = "SELECT * FROM `users` WHERE `id`='{$uid}'";

$query45 = "SELECT `username` FROM `users` WHERE `id`='{$uid}' LIMIT 1";
$cktest = fetchAssoc($query45, $conn);
$ck = $cktest['username'];


$skaap1= "SELECT * FROM `friends` WHERE (`uid`='". (int) $_SESSION['userid']."' AND `friendid`='". (int) $_GET['id']."')";
$skaap= numRows($skaap1, $conn);

//START FRIEND REQUEST
if(isset($_GET['friend']) && $_GET['friend'] == "req"){

if($skaap > 0){echo $lang['profile_01']; $error=1;}


if($error != 1){
$sql = "INSERT INTO `friends` (`uid`,`friendid`) VALUES ('". (int) $_SESSION['userid']."', '" . (int) $_GET['id'] . "')";
$conn->query($sql);
echo $lang['profile_02'];
}

}
//END FRIEND REQUEST
if(numRows($query, $conn) != 1) {
	echo $lang['profile_03'];
} else {
	$userRow = fetchArray($query, 2, $conn);
	
	$avatar = !filter_var($userRow['avatar'], FILTER_VALIDATE_URL) ? $defaultAvatar : cleanHtml($userRow['avatar']) ;

	$teamCells = array();
	for ($i=1; $i<=6; $i++) {
		$pid = $userRow[ 'poke' . $i ];
		
		
		if ($pid == 0) {
			$teamCells[] = '
				<img src="images/pokemon/EMPTY.png" alt="No Pokemon" /><br />
				<div class="info" style="display: none;">
					'.$lang['profile_04'].'
				</div>							
			';
		} else {
			$query = "SELECT * FROM `user_pokemon` WHERE `id`='{$pid}'";
			$pokemon = fetchAssoc($query, $conn);
			
			if($pokemon['gender'] == "1"){$gender=$lang['profile_05'];}
			if($pokemon['gender'] == "2"){$gender=$lang['profile_06'];}
			if($pokemon['gender'] == "0"){$gender=$lang['profile_07'];}
			if($pokemon['gender'] == ""){$gender="";}
			
			$adminOptions = '';
			if (isAdmin()) {
				$adminOptions = '
					[<a href="./staff/edit_pokemon.php?id='.$pokemon['id'].'">Edit Pokemon</a>]<br /><br />
				';
			}
			$types = array('Shiny ', 'Halloween ', 'Shiny Halloween ', 'Helios ', 'Possion ', 'Snow ', 'Enraged ', 'Golden ', 'Ancient ');
                        $pokemonName = str_replace($types, '', $pokemon['name']);
                        
                        $query = "SELECT `type1`,`type2` FROM `pokedex` WHERE `name`='{$pokemonName}'";
                        $typeRow = fetchAssoc($query, $conn);
                        
                        $typeStr = '';
                        $typeStr .= !empty($typeRow['type1']) ? '<img src="images/dex/'.$typeRow['type1'].'.png"> ' : '' ;
                        $typeStr .= !empty($typeRow['type2']) ? '<img src="images/dex/'.$typeRow['type2'].'.png"> ' : '' ;
 			$typeStr .= !empty($typeStr) ? '<br /><br />' : '' ;
 
                        if ($pokemon['level'] >= '2250') { $heart = 'likes'; } else { $heart = 'like'; }
						
                        $teamCells[] = '
											<img src="/images/pokemon/' . $pokemon['name'] . '.png" alt="' . $pokemon['name'] . '"  />
											<div class="info" style="display: none;">
											<div class="like"><img src="/img/layout/members/'. $heart .'.png" /></div>
											<a href="pinfo.php?id='.$pokemon['id'].'">' . $pokemon['name'] . '</a><br />
											'.$lang['profile_09'].': ' . number_format($pokemon['level']) . ' <br />
											Exp: ' . number_format($pokemon['exp']) . '<br />
											'.$lang['profile_08'].': <img src="images/gender/' . $pokemon['gender'] . '.png"/> '.$gender.'<br /><br />
											'.$typeStr.'
											'.$adminOptions.'
											</div>
			';
		}

	}
	

	
	
	
	$userBadges = array();
	$query = "SELECT * FROM `user_badges` WHERE `uid`='{$uid}'";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) { $userBadges[] = $row['badge']; }
		
	$badgeCells = array();
	$allLeaguesArray = getAllLeaguesLeadersAndBadges();
	
	foreach ($allLeaguesArray as $leagueName => $leagueArray) {
		$bcell = '<p>'.$leagueName.'</p>';
		
		foreach ($leagueArray as $nameAndBadge) {
			$badge  = $nameAndBadge['badge'];
			$leader = $nameAndBadge['name'];
			
			if (in_array($badge, $userBadges)) {
				$bcell .= '<img src="images/badges/'.$badge.'.png" title="Won '.$leader.' and earned '.$badge.'"/>';
			} else {
				$bcell .= '&nbsp;';
			}
		}
		
		$badgeCells[] = $bcell;
	}
	
	

	
	
	

	$totalQuery = "SELECT SUM(`exp`) AS `total_exp` FROM `user_pokemon` WHERE `uid`='{$uid}'";
	$end = fetchAssoc($totalQuery, $conn);
	$totalExp = $totalQuery ? end($end) : 0 ;
	
	$uniquesQuery = "SELECT COUNT( DISTINCT(`name`) ) AS `uniques` FROM `user_pokemon` WHERE `uid`='{$uid}'";
	$end = fetchAssoc($uniquesQuery, $conn);
	$numUniques   = $uniquesQuery ? end($end) : 0 ;
	
	if ($userRow['clan'] == 0) {
		$clanName = $lang['profile_10'];
	} else {
		$clanQuery = "SELECT `name` FROM `clans` WHERE `id`='{$userRow['clan']}'";
		$clanName = fetchAssoc($clanQuery, $conn);
		$clanName = cleanHtml($clanName['name']);
	}
	
	$signature = nl2br(cleanHtml($userRow['signature']));
	if ($signature != '') {
		//$signature = '<br /><div style="border-top: 1px solid #666666; border-bottom: 1px solid #666666; padding: 5px 0;">' . $signature . '</div>';
		$signature = '<br /><div>' . $signature . '</div><br />';
	}
	
	echo '<p style="text-align: center;">';
	if ($_SESSION['userid'] == $uid) {
		echo '<a href="edit_profile.php">'.$lang['profile_11'].'</a><br />';
	}
	
	if (isAdmin()) {
		echo '[<a href="staff/edit_user.php?id='.$userRow['id'].'">Edit This Account</a>]<br /><br />';
	}
	echo '</p>';
	
	if ($userRow['banned'] == 1) {
		echo '<div class="error">'.$lang['profile_12'].'</div>';
	}
	
	if ($userRow['premium'] == 2) {
		$premium = 'Yes';
		$pre_img = '<br /><img src="/images/userbars/premium.png" />';
	} else {
		$premium = 'No';
		$pre_img = '';
	}
?>
			<div class="profile">
				<div class="trainer-card">
					<div class="tc-img">
						<div class="t-info"><?php echo cleanHtml($userRow['username']);?> #<?php echo cleanHtml($userRow['id']);?></div>
					</div>
					
					<div class="avatar">
						<img src="<?php echo cleanHtml($userRow['avatar']);?>" alt="Avatar" style="max-width:120px; max-height:120px;">
					</div>
					
					<table>
						<?php echo cellsToRowsProfile($teamCells, 3);?>
					</table>
				</div>
				
				<div class="links">
					<a href="messages.php?p=new&uid=<?php echo urlencode($userRow['id']);?>"><?php echo $lang['profile_13'];?></a>
					<a href="battle_user.php?id=<?php echo urlencode($userRow['id']);?>"><?php echo $lang['profile_14'];?></a>
					<a href="profile.php?id=<?php echo $uid;?>&friend=req"><?php echo $lang['profile_15'];?></a>
                    <a href="view_box.php?id=<?php echo urlencode($userRow['id']);?>"><?php echo $lang['profile_16'];?></a>
					<a href="trade_sell.php?uid=<?php echo urlencode($userRow['id']);?>"><?php echo $lang['profile_17'];?></a>
					<a href="trade_sell.php?uid=<?php echo urlencode($userRow['id']);?>&sale"><?php echo $lang['profile_18'];?></a>
					<a href="card.php?id=<?php echo urlencode($userRow['id']);?>"><?php echo $lang['profile_19'];?></a>
					<a href="send_money.php?id=<?php echo urlencode($userRow['id']);?>"><?php echo $lang['profile_20'];?></a>
				</div>
				
				<div class="statics">
					<div class="header in">
						<table class="info">
							<tr>
								<td width="50%"><?php echo $lang['profile_21'];?></td>
								<td width="50%"><?php echo $lang['profile_22'];?></td>
							</tr>
						</table>
					</div>
					
					<table class="fixed-stats">
						<tr>
							<td width="50%">
								<table class="stats">
									<tr>
										<td><?php echo $lang['profile_23'];?>:</td>
										<td><?php echo date('Y/m/d',$userRow['signup_date']);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_24'];?>:</td>
										<td><?php echo number_format($totalExp);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_25'];?>:</td>
										<td><?php echo number_format($numUniques);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_26'];?>:</td>
										<td><?php echo number_format($userRow['money']);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_27'];?>:</td>
										<td><?php echo number_format($userRow['won']);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_28'];?>:</td>
										<td><?php echo number_format($userRow['lost']);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_29'];?>:</td>
										<td><?php echo $clanName;?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_30'];?>:</td>
										<td><?php echo secondsToTimeSince(time()-$userRow['lastseen']);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_31'];?>:</td>
										<td><?php echo expToLevel($userRow['trainer_exp']);?></td>
									</tr>
									<tr>
										<td><?php echo $lang['profile_32'];?>:</td>
										<td><?php echo $premium;?></td>
									</tr>
								</table>
							</td>
							
							<td width="50%">
								<table class="badges">
									<tr>
										<td>
											<?php echo cellsToRowsBadges($badgeCells, 8);?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
				</div>
				
				<?php if($_SESSION['userid']) { ?>
				
				<div class="badges">
					<div class="header in"><p><?php echo $lang['profile_33'];?> <small style="font-weight: 300;font-size: 10px !important;position: relative;left: 5px;top: -5px;color: rgb(63, 192, 208);">[ALPHA]</small></p></div>
					
					<div class="show badges" style="text-align: center; width: 70%; margin: 10px auto;">
					<?php
					if($userRow['won'] >= 1000) { echo '<img src="images/achievements/1k.png" title="Have won a 1000 battles">'; }
					if(expToLevel($userRow['trainer_exp']) >= 1000) { echo '<img src="images/achievements/1kb.png" title="Reached trainer level 1,000">'; }
					if(expToLevel($userRow['trainer_exp']) >= 5000) { echo '<img src="images/achievements/5k.png" title="Reached trainer level 5,000">'; }
					if(expToLevel($userRow['trainer_exp']) >= 10000) { echo '<img src="images/achievements/10k.png" title="Reached trainer level 10,000">'; }
					?>
					</div>
				</div>
				<?php } ?>
				
				<div class="about">
					<div class="header in"><p><?php echo $lang['profile_34'];?></p></div>
						
					<div class="signature">
						<?php echo bbcode($signature);?>
					</div>
				</div>
			</div>

<?php
}
include '_footer.php';
?>
<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

$uid = (int) $_SESSION['userid'];

$rewards = array(

	array(
		'required_pokemon' => 'Pidgey',
		'required_amount'  => 5,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Togepi'
	),
	array(
		'required_pokemon' => 'Nidoran (m)',
		'required_amount'  => 30,
		'reward_level'     => 10,
		'reward_pokemon'   => 'Goomy'
	),
	array(
		'required_pokemon' => 'Togepi',
		'required_amount'  => 30,
		'reward_level'     => 10,
		'reward_pokemon'   => 'Snorlax'
	),
	array(
		'required_pokemon' => 'Togepi',
		'required_amount'  => 120,
		'reward_level'     => 25,
		'reward_pokemon'   => 'Lapras'
	),
	array(
		'required_pokemon' => 'Goomy',
		'required_amount'  => 30,
		'reward_level'     => 25,
		'reward_pokemon'   => 'Lapras'
	),
	array(
		'required_pokemon' => 'Bellsprout',
		'required_amount'  => 3,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Mudkip'
	),
	array(
		'required_pokemon' => 'Mudkip',
		'required_amount'  => 300,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Munchlax'
			
	),
	array(
		'required_pokemon' => 'Goomy',
		'required_amount'  => 40,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Cubchoo'
	),     
	array(
		'required_pokemon' => 'Larvitar',
		'required_amount'  => 5,
		'reward_level'     => 15,
		'reward_pokemon'   => 'Amaura'
	),
	array(
		'required_pokemon' => 'Goldeen',
		'required_amount'  => 200,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Aerodactyl'
	),
	array(
		'required_pokemon' => 'Goldeen',
		'required_amount'  => 100,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Metagross'
	),
	array(
		'required_pokemon' => 'Goldeen',
		'required_amount'  => 400,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Celebi'
	)
);


include '_header.php';
printHeader($lang['coll_mach_title']);

echo '
	<br /><br />
	<div style="text-align: center;">
';

if (isset($_POST['trade'])) {
	$pkey = (int) $_POST['poke'];
	
	if (in_array($pkey, array_keys($rewards))) {
		$reward = $rewards[$pkey];
		
		$teamIds = getUserTeamIds($uid, $conn);
		$notInTeamSql = ' AND `id`!=\'' . implode('\' AND `id`!=\'', $teamIds) . '\'';
		$query = "SELECT * FROM `user_pokemon` WHERE `name`='{$reward['required_pokemon']}' AND `uid`='{$uid}' {$notInTeamSql}";
		$numPokes = numRows($query, $conn);
		
		if ($numPokes >= $reward['required_amount']) {
			$query = $conn->query("
				DELETE FROM `user_pokemon`
					WHERE
						`name`='{$reward['required_pokemon']}' AND
						`uid`='{$uid}'
						{$notInTeamSql}
					ORDER BY `exp` ASC
					LIMIT {$reward['required_amount']}
			");
			
			if ($query) {
				$exp = levelToExp($reward['reward_level']);
				giveUserPokemon($uid, $reward['reward_pokemon'], $reward['reward_level'], $exp, 'Hyper Beam', 'Scratch', 'Scratch', 'Scratch', $conn);

				
				echo '
					<div class="notice" style="color: #FFF;">
						'.$lang['coll_mach_00'].' '.$reward['required_amount'].' '.$reward['required_pokemon'].' '.$lang['coll_mach_01'].' '.$reward['reward_pokemon'].'!<br />
						<img src="images/pokemon/'.$reward['reward_pokemon'].'.png" alt="'.$reward['reward_pokemon'].'" />
					</div>
				';
				
			}
		}
	}
}



foreach ($rewards as $key => $reward) {
	
	$teamIds = getUserTeamIds($uid, $conn);
	$notInTeamSql = ' AND `id`!=\'' . implode('\' AND `id`!=\'', $teamIds) . '\'';
	$query = "SELECT * FROM `user_pokemon` WHERE `name`='{$reward['required_pokemon']}' AND `uid`='{$uid}' {$notInTeamSql}";
	$numPokes = numRows($query, $conn);

	echo '
		'.$lang['coll_mach_02'].' '.$reward['required_amount'].' '.$reward['required_pokemon'].'
		'.$lang['coll_mach_03'].' '.$reward['reward_pokemon'].'!<br />
		'.$lang['coll_mach_04'].' '.$numPokes.'/'.$reward['required_amount'].'.<br />
		<img src="images/pokemon/'.$reward['required_pokemon'].'.png" alt="'.$reward['required_pokemon'].'" />
		<img src="images/pokemon/'.$reward['reward_pokemon'].'.png" alt="'.$reward['reward_pokemon'].'" />
	';
	
	if ($numPokes >= $reward['required_amount']) {
		echo '
			<form action="" method="post">
				<input type="hidden" value="'.$key.'" name="poke" />
				<input type="submit" class="smallbutton" id="button" name="trade" value="'.$lang['coll_mach_05'].' '.$reward['reward_pokemon'].'!" />
			</form>
		';
	}
	echo '<br /><br />';
	if ($key+1 != count($rewards)) {
		echo '<hr />';
	}
	echo '<br /><br />';
}
echo '		
	</div>
';
	
include '_footer.php';
?>

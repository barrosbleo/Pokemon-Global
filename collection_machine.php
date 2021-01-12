<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

$uid = (int) $_SESSION['userid'];

$rewards = array(

	array(
		'required_pokemon' => 'Togepi',
		'required_amount'  => 300,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Helios Pancham'
			),
			array(
		'required_pokemon' => 'Togepi',
		'required_amount'  => 300,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Helios Goomy'
			),
			
			array(
		'required_pokemon' => 'Asdd',
		'required_amount'  => 3,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Togepi'
			),
			
						array(
		'required_pokemon' => 'Ghost',
		'required_amount'  => 3,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Mudkip'
			),

	array(
		'required_pokemon' => 'Mudkip',
		'required_amount'  => 300,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Helios Deerling'
			
			),
				array(
		'required_pokemon' => 'Ghost',
		'required_amount'  => 300,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Helios Cubchoo'
		        ),
		      	
		        
				array(
		'required_pokemon' => 'Asdd',
		'required_amount'  => 300,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Helios Amaura'
		       ),
		       array(
		'required_pokemon' => 'Goldeen',
		'required_amount'  => 100,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Metagross (Mega)'
		       ),
				array(
		'required_pokemon' => 'Goldeen',
		'required_amount'  => 400,
		'reward_level'     => 5,
		'reward_pokemon'   => 'Helios Celebi'
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
		
		$teamIds = getUserTeamIds($uid);
		$notInTeamSql = ' AND `id`!=\'' . implode('\' AND `id`!=\'', $teamIds) . '\'';
		$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `name`='{$reward['required_pokemon']}' AND `uid`='{$uid}' {$notInTeamSql}");
		$numPokes = mysql_num_rows($query);
		
		if ($numPokes >= $reward['required_amount']) {
			$query = mysql_query("
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
				giveUserPokemon($uid, $reward['reward_pokemon'], $reward['reward_level'], $exp, 'Hyper Beam', 'Scratch', 'Scratch', 'Scratch');

				
				echo '
					<div class="notice" style="color: #000000;">
						'.$lang['coll_mach_00'].' '.$reward['required_amount'].' '.$reward['required_pokemon'].' '.$lang['coll_mach_01'].' '.$reward['reward_pokemon'].'!<br />
						<img src="images/pokemon/'.$reward['reward_pokemon'].'.png" alt="'.$reward['reward_pokemon'].'" />
					</div>
				';
				
			}
		}
	}
}



foreach ($rewards as $key => $reward) {
	
	$teamIds = getUserTeamIds($uid);
	$notInTeamSql = ' AND `id`!=\'' . implode('\' AND `id`!=\'', $teamIds) . '\'';
	$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `name`='{$reward['required_pokemon']}' AND `uid`='{$uid}' {$notInTeamSql}");
	$numPokes = mysql_num_rows($query);

	echo '
		'.$lang['coll_mach_02'].' '.$reward['required_amount'].' '.$reward['required_pokemon'].'
		'.$lang['coll_mach_03'].' '.$reward['reward_pokemon'].'!<br />
		'.$lang['coll_mach_04'].' '.$numPokes.'/'.$reward['required_amount'].'.<br />
		<img src="images/pokemon/'.$reward['reward_pokemon'].'.png" alt="'.$reward['reward_pokemon'].'" />
	';
	
	if ($numPokes >= $reward['required_amount']) {
		echo '
			<form action="" method="post">
				<input type="hidden" value="'.$key.'" name="poke" />
				<input type="submit" id="button" name="trade" value="'.$lang['coll_mach_05'].' '.$reward['reward_pokemon'].'!" />
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
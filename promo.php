<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}
$uid = (int) $_SESSION['userid'];

include '_header.php';
printHeader($lang['promo_title']);

$query      = "SELECT `got_promo`, `money`, `token` FROM `users` WHERE `id`='{$uid}'";
$uRow       = fetchAssoc($query, $conn);
$gotPromo   = $uRow['got_promo'];
$userMoney  = $uRow['money'];
$userTokens = $uRow['token'];

$pokeName       = getConfigValue('promo_pokemon_name', $conn);
$pokeLevel      = getConfigValue('promo_pokemon_level', $conn);
$pokeCostMoney  = getConfigValue('promo_cost_money', $conn);
$pokeCostTokens = getConfigValue('promo_cost_tokens', $conn);
$message = '';

if (isset($_POST['claim']) && $gotPromo == 0) {
    
    if ($userMoney < $pokeCostMoney || $userTokens < $pokeCostTokens) {
        $message = '
        	<div class="error" style="color: #000;">
    			'.$lang['promo_00'].'
    		</div>
    	';
    } else {
    	$message = '
    		<div class="notice" style="color: #000;">
    			'.$lang['promo_01'].' '.$pokeName.'!
    		</div>
    	';
        
        $userMoney = $userMoney - $pokeCostMoney;
        updateUserMoney($uid, $userMoney, $conn);
        
        $userTokens = $userTokens - $pokeCostTokens;
        updateUserToken($uid, $userTokens, $conn);
        
    	$exp = levelToExp($pokeLevel);
    	giveUserPokemon($uid, $pokeName, $pokeLevel, $exp, 'Scratch', 'Scratch', 'Scratch', 'Scratch', $conn);
    	
    	$conn->query("UPDATE `users` SET `got_promo`='1' WHERE `id`='{$uid}'");
    }
}

echo '
	<div style="text-align: center; margin: 30px 0px;">
		
        '.$lang['promo_02'].' $'.number_format($userMoney).' '.$lang['promo_03'].' '.$userTokens.' '.$lang['promo_04'].'
        <br /><br /><br />
		<img src="images/pokemon/'.$pokeName.'.png" alt="'.$pokeName.'" /><br />
		'.$lang['promo_05'].' '.$pokeName.'!<br />
';

if ($pokeCostMoney != 0 || $pokeCostTokens != 0) {
	$cost = '';
	if ($pokeCostMoney > 0) {
		$cost = '$'.number_format($pokeCostMoney);
	}
	if ($pokeCostTokens > 0) {
		if ($cost != '') { $cost .= ' '.$lang['promo_06'].' '; }
		$cost .= number_format($pokeCostTokens).' '.$lang['promo_07'];
	}
	
	
	echo $lang['promo_08'].' '.$cost.'<br />';
} else {
	echo $lang['promo_09'].'<br />';
}

echo '<br /><br /><br />';

if (!empty($message) && isset($_POST['claim'])) {
    echo $message;
} else {
	if ($gotPromo == 0) {
		echo '
			<form action="" method="post">
				<input type="submit" id="button" name="claim" value="'.$lang['promo_10'].'" />
			</form>
		';
	} else {
		echo $lang['promo_11'];
	}
}

echo '</div>';

include '_footer.php';
?>
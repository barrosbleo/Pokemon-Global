<?php
include('modules/lib.php');


if (!isLoggedIn()) {
    redirect('login.php');
}

include '_header.php';
printHeader($lang['snow_mach_title']);

$uid = (int) $_SESSION['userid'];
$userMoney = getUserMoney($uid);
$message = '';

$attemptPrice   = getConfigValue('snow_machine_price');
$trappedPokemon = getConfigValue('snow_machine_pokemon');
$chanceOfWin    = getConfigValue('snow_machine_chance');
$trappedLevel   = getConfigValue('snow_machine_pokemon_level');
$spentMoney   	= getConfigValue('snow_machine_lost_money');

echo '<div style="text-align: center;">
'.$lang['snow_mach_00'].' '.number_format($spentMoney).'<br />';

if (isset($_POST['fix'])) {
    
    if ($userMoney < $attemptPrice) {
        $message = $lang['snow_mach_01'];
    } else {
        // take money
        $userMoney -= $attemptPrice;
        updateUserMoney($uid, $userMoney);
        
        if (rand(1, 100) <= $chanceOfWin) {
            // they won
            
            $message = '
                '.$lang['snow_mach_02'].' '.$trappedPokemon.'!<br />
                <img src="images/pokemon/'.$trappedPokemon.'.png" alt="'.$trappedPokemon.'" />
            ';
            
            // give them the pokemon
            $exp = levelToExp($trappedLevel);
            giveUserPokemon($uid, $trappedPokemon, $trappedLevel, $exp, 'Scratch', 'Scratch', 'Scratch', 'Scratch');
            
        } else {
            // they lost
            
            $message = $lang['snow_mach_03'];
			mysql_query("UPDATE `config` SET `value` = `value`+'{$attemptPrice}' WHERE `name` = 'snow_machine_lost_money'");
        }
    }
    
    echo '
        <div style="font-size: 15px;">
            '.$message.'<br /><br />
            <a href="snow_machine.php">'.$lang['snow_mach_04'].'</a><br /><br />
        </div>
    ';
    
} else {

    echo '

        <img src="/images/pokemon/'.$trappedPokemon.'.png"/><br /><br />
        
        '.$lang['snow_mach_05'].'<br />
        
        '.$lang['snow_mach_06'].' <b style="color: #008FFF;">'.$trappedPokemon.'</b> '.$lang['snow_mach_07'].' <br />
        
        '.$lang['snow_mach_08'].' '.$trappedPokemon.' '.$lang['snow_mach_09'].' $' . number_format($attemptPrice) . '.<br />
        
        '.$lang['snow_mach_10'].' '.$trappedPokemon.' '.$lang['snow_mach_11'].' '.$chanceOfWin.'%.<br /><br />
        
        
    
        <form action="" method="post">
            <input style="padding: 3px 20px;" type="submit" name="fix" value="'.$lang['snow_mach_12'].'" id="button" />
        </form>
        <br /><br />
    ';
}

if (isAdmin()) {
    echo '
        [<a href="/staff/edit_snow_machine.php">'.$lang['snow_mach_13'].'</a>]
        <br /><br />
    ';
}

echo '</div>';

include '_footer.php';
?>
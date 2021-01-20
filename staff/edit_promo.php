<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

include '_header.php';
echoHeader('Edit Promo');

if (isset($_POST['save'])) {
    $errors = array();
        
    $name = str_replace(array(chr(0), '.', '/', '\\', '?', '<', '>'), '', $_POST['name']);
    if (!file_exists('../images/pokemon/'.$name.'.png')) {
        $errors[] = 'Could not find a picture for that pokemon.';
    }
    
    $money = (int) str_replace(array(',', ' ', '$'), '', $_POST['money']);
    if ($money < 0) {
        $errors[] = 'Money can not be negative.';
    }
    
    $tokens = (int) str_replace(array(',', ' ', '$'), '', $_POST['tokens']);
    if ($tokens < 0) {
        $errors[] = 'Tokens can not be negative.';
    }
    
    $level = (int) $_POST['level'];
    if ($level <= 0 || $level > 100) {
        $errors[] = 'Level needs to be between 1 and 100.';
    }
    
    if (count($errors) >= 1) {
        echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
    } else {
        echo '<div class="notice">The promo has been edited.</div>';
        
        $name = cleanSql($name, $conn);
        
        setConfigValue('promo_cost_money', $money);
        setConfigValue('promo_cost_tokens', $tokens);
        setConfigValue('promo_pokemon_name', $name);
        setConfigValue('promo_pokemon_level', $level);
        setConfigValue('promo_last_update', time());
        
        $conn->query("UPDATE `users` SET `got_promo`='0'");
    }
}

$pCostMoney    = getConfigValue('promo_cost_money');
$pCostTokens   = getConfigValue('promo_cost_tokens');
$pPokemon      = getConfigValue('promo_pokemon_name');
$pPokemonLevel = getConfigValue('promo_pokemon_level');
$pLastUpdate   = getConfigValue('promo_last_update');

echo '
    <form method="post">
        <table class="pretty-table center">
            <tr>
                <th colspan="2">Edit Promo</th>
            </tr>
            <tr>
                <td>Pokemon Name:</td>
	        	<td>
	        		<input type="text" name="name" value="'.$pPokemon.'" onkeyup="document.getElementById(\'pPic\').src = \'../images/pokemon/\'+this.value+\'.png\';" /><br />
                    <img id="pPic" src="../images/pokemon/'.$pPokemon.'.png" /><br />
                    <span class="small">Pokemon <strong>must</strong> have a picture.</span>
	        	</td>
	        </tr>
            <tr>
                <td>Pokemon Level:</td>
	        	<td>
                    '.numSelectBox('level', $pPokemonLevel, 1, 100, 'style="width: 100px;"').'
	        	</td>
	        </tr>
            <tr>
                <td>Price in money:</td>
	        	<td>
	        		<input type="text" name="money" value="'.number_format($pCostMoney).'" />
	        	</td>
	        </tr>
            <tr>
                <td>Price in tokens:</td>
            	<td>
	        		<input type="text" name="tokens" value="'.number_format($pCostTokens).'" />
	        	</td>
	        </tr>
            <tr>
                <td>Last Update:</td>
                <td>
	        		'.secondsToTimeSince(time() - $pLastUpdate).' ago.
	        	</td>
	        </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
	        		<input type="checkbox" onclick="document.getElementById(\'submit\').disabled = this.checked ? \'\' : \'disabled\' ;" />
                    <span class="small">Check this to enable <br />the submit button.</span><br /><br />
                    <span class="small">This is here to stop <br />admins from mistakenly clicking<br /> save and allowing users<br /> to claim the promo twice.</span>
	        	</td>
	        </tr>
	        <tr>
	        	<td>&nbsp;</td>
	        	<td><input type="submit" id="submit" name="save" value="Save" disabled="disabled" /></td>
	        </tr>
        </table>
    </form>
';

include '_footer.php';

?>
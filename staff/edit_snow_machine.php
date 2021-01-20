<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

$handle = fopen('edit_snow_machine_log.txt', 'a+');
fwrite($handle, "{$_SESSION['username']} accessed edit_snow_machine.php" . PHP_EOL);
fclose($handle);

include '_header.php';
echoHeader('Edit Snow Machine');

if (isset($_POST['save'])) {
    $errors = array();
        
    $name = str_replace(array(chr(0), '.', '/', '\\', '?', '<', '>'), '', $_POST['name']);
    if (!file_exists('../images/pokemon/'.$name.'.png')) {
        $errors[] = 'Could not find a picture for that pokemon.';
    }
    
    $price = (int) str_replace(array(',', ' ', '$'), '', $_POST['price']);
    if ($price <= 0) {
        $errors[] = 'Price can not be negative.';
    }
    
    $level = (int) $_POST['level'];
    if ($level <= 0 || $level > 100) {
        $errors[] = 'Level needs to be between 1 and 100.';
    }
    
    $chance = (int) $_POST['chance'];
    if ($chance <= 0 || $chance > 100) {
        $errors[] = 'Chance needs to be between 1 and 100.';
    }
    
    
    if (count($errors) >= 1) {
        echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
    } else {
        echo '<div class="notice">The pokemon has been edited.</div>';
        
        $name = cleanSql($name, $conn);
        setConfigValue('snow_machine_price', $price);
        setConfigValue('snow_machine_pokemon', $name);
        setConfigValue('snow_machine_chance', $chance);
        setConfigValue('snow_machine_pokemon_level', $level);
        
        $handle = fopen('edit_snow_machine_log.txt', 'a+');
        fwrite($handle, "{$_SESSION['username']} edited the snow machine. Name: {$name}, Price: {$price}, Chance: {$chance}, Level: {$level}" . PHP_EOL);
        fclose($handle);
    }
}

$smPrice   = getConfigValue('snow_machine_price');
$smPokemon = getConfigValue('snow_machine_pokemon');
$smChance  = getConfigValue('snow_machine_chance');
$smPokemonLevel = getConfigValue('snow_machine_pokemon_level');

echo '
    <form method="post">
        <table class="pretty-table center">
            <tr>
                <th colspan="2">Edit Snow Machine</th>
            </tr>
            <tr>
	        	<td>Attempt Price:</td>
	        	<td>
                    $&nbsp;<input type="text" name="price" value="'.number_format($smPrice).'" /><br />
                    <span class="small">Price per attempt at<br />fixing the machine.</span>
	        	</td>
	        </tr>
            <tr>
                <td>Pokemon Name:</td>
	        	<td>
	        		<input type="text" name="name" value="'.$smPokemon.'" onkeyup="document.getElementById(\'pPic\').src = \'../images/pokemon/\'+this.value+\'.png\';" /><br />
                    <img id="pPic" src="../images/pokemon/'.$smPokemon.'.png" /><br />
                    <span class="small">Pokemon <strong>must</strong> have a picture.</span>
	        	</td>
	        </tr>
            <tr>
                <td>Pokemon Level:</td>
	        	<td>
                    '.numSelectBox('level', $smPokemonLevel, 1, 100, 'style="width: 100px;"').'
	        	</td>
	        </tr>
            <tr>
            	<td>Chance:</td>
	        	<td>
	        		'.numSelectBox('chance', $smChance, 1, 100, 'style="width: 100px;"').'<br />
                    <span class="small">The chance of fixing the<br />machine as a percentage.</span>
	        	</td>
	        </tr>
	        <tr>
	        	<td>&nbsp;</td>
	        	<td><input type="submit" name="save" value="Save" /></td>
	        </tr>
        </table>
    </form>
';

include '_footer.php';

?>
<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

include '_header.php';
$text = isset($_GET['add']) ? 'Add Pokemon To Pokedex' : 'Edit Pokedex' ;
echoHeader($text);

$pid = (int) $_GET['id'];
define('MAX_STAT', 255);






if (!isset($_GET['add'])) {
	$query = mysql_query("SELECT * FROM `pokedex` ORDER BY `num` ASC");
	
	echo '<form method="get" class="center-text bottom-padded"><select name="id" style="font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New, monospace;">';
	while ($row = mysql_fetch_assoc($query)) {
		$opttext = ' '.str_pad($row['name'], 30, ' ', STR_PAD_RIGHT) . str_pad('#'.$row['num'], 7, ' ', STR_PAD_LEFT) .' ';
		$opttext = str_replace(' ', '&nbsp;', $opttext);
		$attr = $pid == $row['id'] ? ' selected="selected" ' : '' ;
		echo '<option value="'.$row['id'].'" '.$attr.' style="font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New, monospace;">'.$opttext.'</option>';
	}
	echo '</select> <input type="submit" value="Edit Pokedex" /></form>';
	









	$query = mysql_query("SELECT * FROM `pokedex` WHERE `id`='{$pid}' LIMIT 1");
	
	if (mysql_num_rows($query) == 0) {
	    include '_footer.php';
	    die();
	}
	$pokeInfo = mysql_fetch_assoc($query);
} else {
	$pokeInfo = array(
		'name'     => '',
		'num'      => '',
		'attack'   => '100',
		'spattack' => '100',
		'def'      => '100',
		'spdef'    => '100',
		'hp'       => '100',
		'speed'    => '100',
		'type1'    => 'Normal',
		'type2'    => '',
		'move1'    => 'Fire Blast',
		'move2'    => 'Scratch',
		'move3'    => 'Bubble',
		'move4'    => 'Razor Leaf'
	);
}

if (isset($_POST['submit'])) {
	$errors = array();
	
	$name = str_replace(array(chr(0), '/', '\\', '?', '<', '>'), '', $_POST['name']);
	if (!file_exists('../images/pokemon/'.$name.'.png')) {
	    $errors[] = 'Could not find a picture for that pokemon.';
	}
	
	$num = (int) $_POST['num'];
	
	$type1 = $_POST['type1'];
	if (!validType($type1)) {
	    $errors[] = 'Type 1 was invalid.';
	}
	
	$type2 = $_POST['type2'];
	if (!validType($type2)) {
	    $errors[] = 'Type 2 was invalid.';
	}
	
	$move1Id = $_POST['move1'];
	$move1Name = moveIdToName($move1Id);
	if ($move1Name === false) {
	    $errors[] = 'Move 1 was invalid.';
	}
	
	$move2Id = $_POST['move2'];
	$move2Name = moveIdToName($move2Id);
	if ($move2Name === false) {
	    $errors[] = 'Move 2 was invalid.';
	}
	
	$move3Id = $_POST['move3'];
	$move3Name = moveIdToName($move3Id);
	if ($move3Name === false) {
	    $errors[] = 'Move 1 was invalid.';
	}
	
	$move4Id = $_POST['move4'];
	$move4Name = moveIdToName($move4Id);
	if ($move4Name === false) {
	    $errors[] = 'Move 4 was invalid.';
	}
	
	$attack = (int) $_POST['attack'];
	if ($attack < 1 || $attack > MAX_STAT) {
	    $errors[] = 'Attack was invalid.';
	}
	
	$spattack = (int) $_POST['spattack'];
	if ($spattack < 1 || $spattack > MAX_STAT) {
	    $errors[] = 'Special attack was invalid.';
	}
	
	$defence = (int) $_POST['defence'];
	if ($defence < 1 || $defence > MAX_STAT) {
	    $errors[] = 'Defence was invalid.';
	}
	
	$spdefence = (int) $_POST['spdefence'];
	if ($spdefence < 1 || $spdefence > MAX_STAT) {
	    $errors[] = 'Special defence was invalid.';
	}
	
	$hp = (int) $_POST['hp'];
	if ($hp < 1 || $hp > MAX_STAT) {
	    $errors[] = 'HP was invalid.';
	}
	
	$speed = (int) $_POST['speed'];
	if ($speed < 1 || $speed > MAX_STAT) {
	    $errors[] = 'Speed was invalid.';
	}
	
	if (count($errors) >= 1) {
	    echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
	} else {
	    
	    
	    $name = cleanSql($name);
	    $type1 = cleanSql($type1);
	    $type2 = cleanSql($type2);
	    $move1Name = cleanSql($move1Name);
	    $move2Name = cleanSql($move2Name);
	    $move3Name = cleanSql($move3Name);
	    $move4Name = cleanSql($move4Name);
	    
	    if (!isset($_GET['add'])) {
	    	mysql_query("
		        UPDATE `pokedex` SET
		            `name`   = '{$name}',
		            `num`   = '{$num}',
		            `attack`  = '{$attack}',
		            `spattack`  = '{$spattack}',
		            `def`  = '{$defence}',
		            `spdef`  = '{$spdefence}',
		            `hp`  = '{$hp}',
		            `speed`  = '{$speed}',
		            `type1`  = '{$type1}',
		            `type2`    = '{$type2}',
		            `move1`  = '{$move1Name}',
		            `move2`  = '{$move2Name}',
		            `move3`  = '{$move3Name}',
		            `move4`  = '{$move4Name}'
		        WHERE `id`='{$pid}' LIMIT 1
		");
		echo '<div class="notice">The pokemon has been edited.</div>';
		$query = mysql_query("SELECT * FROM `pokedex` WHERE `id`='{$pid}' LIMIT 1");
		$pokeInfo = mysql_fetch_assoc($query);
	    } else {
	    	mysql_query("
		        INSERT INTO `pokedex` (
			        `name`,
			        `num`,
			        `attack`,
			        `spattack`,
			        `def`,
			        `spdef`,
			        `hp`,
			        `speed`,
			        `type1`,
			        `type2`,
			        `move1`,
			        `move2`,
			        `move3`,
			        `move4`
		        ) VALUES (
			        '{$name}',
				'{$num}',
				'{$attack}',
				'{$spattack}',
				'{$defence}',
				'{$spdefence}',
				'{$hp}',
				'{$speed}',
				'{$type1}',
				'{$type2}',
				'{$move1Name}',
				'{$move2Name}',
				'{$move3Name}',
				'{$move4Name}'
		        )
		");
		echo '<div class="notice">The pokemon has been added.</div>';
	    }
	}
}


echo '
<form method="post">
    <table class="center pretty-table">
        <tr>
            <th colspan="2">'.$text.'</th>
        </tr>
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" value="'.$pokeInfo['name'].'" onkeyup="document.getElementById(\'pPic\').src = \'../images/pokemon/\'+this.value+\'.png\';" /><br />
                <img id="pPic" src="../images/pokemon/'.$pokeInfo['name'].'.png" /><br />
                <span class="small">Pokemon <strong>must</strong> have a picture.</span>
            </td>
        </tr>
        <tr>
            <td>Pokemon #:</td>
            <td><input type="text" name="num" value="'.$pokeInfo['num'].'" /></td>
        </tr>
        <tr>
            <td>Type 1:</td>
            <td>'.typeSelectBox('type1', $pokeInfo['type1']).'</td>
        </tr>
        <tr>
            <td>Type 2:</td>
            <td>'.typeSelectBox('type2', $pokeInfo['type2']).'</td>
        </tr>
        <tr>
            <td>Attack:</td>
            <td>'.numSelectBox('attack', $pokeInfo['attack'], 1, MAX_STAT, 'style="width: 100px;"').'</td>
        </tr>
        <tr>
            <td>Special Attack:</td>
            <td>'.numSelectBox('spattack', $pokeInfo['spattack'], 1, MAX_STAT, 'style="width: 100px;"').'</td>
        </tr>
        <tr>
            <td>Defence:</td>
            <td>'.numSelectBox('defence', $pokeInfo['def'], 1, MAX_STAT, 'style="width: 100px;"').'</td>
        </tr>
        <tr>
            <td>Special Defence:</td>
            <td>'.numSelectBox('spdefence', $pokeInfo['spdef'], 1, MAX_STAT, 'style="width: 100px;"').'</td>
        </tr>
        <tr>
            <td>HP:</td>
            <td>'.numSelectBox('hp', $pokeInfo['hp'], 1, MAX_STAT, 'style="width: 100px;"').'</td>
        </tr>
        <tr>
            <td>Speed:</td>
            <td>'.numSelectBox('speed', $pokeInfo['speed'], 1, MAX_STAT, 'style="width: 100px;"').'</td>
        </tr>
        <tr>
            <td>Move 1:</td>
            <td>'.moveSelectBox('move1', $pokeInfo['move1']).'</td>
        </tr>
        <tr>
            <td>Move 2:</td>
            <td>'.moveSelectBox('move2', $pokeInfo['move2']).'</td>
        </tr>
        <tr>
            <td>Move 3:</td>
            <td>'.moveSelectBox('move3', $pokeInfo['move3']).'</td>
        </tr>
        <tr>
            <td>Move 4:</td>
            <td>'.moveSelectBox('move4', $pokeInfo['move4']).'</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="'.$text.'" /></td>
        </tr>
    </table>
</form>
';


include '_footer.php';

?>
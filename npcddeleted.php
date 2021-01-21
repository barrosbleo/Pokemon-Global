<?php
die();
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

	$usersQuery = "SELECT `poke1` FROM `users` WHERE id='{$uid}'";
	$usersRow = fetchObj($usersQuery, $conn);
							
	$starterID = $usersRow->poke1;
								
	$pokeQuery	= "SELECT * FROM `user_pokemon` WHERE `id`='{$starterID}'";
	$pokeRow = fetchObj($pokeQuery, $conn);
	
	$pokelevel = $pokeRow->level;

switch ($_GET['battle']) {
	case 'x3':
		$level = $pokelevel * 3;
		$numPokes = 1;
		$pokeid = 150;
		$type = '';
	break;
	
	case 'x5':
		$level = $pokelevel * 5;
		$numPokes = 1;
		$pokeid = 248;
		$type = '';
	break;

	
	default:
	case 'x2':
		$_GET['battle'] = 'x2';
		$level = $pokelevel * 2;
		$numPokes = 1;
		$pokeid = 127;
		$type = 'Snow ';
	break;
}


$cells = array();

for ($i=0;$i<$numPokes;$i++ ){

	$query   = "SELECT * FROM `pokemon` WHERE `id`>={$pokeid} AND `name`!='' LIMIT 1";
	$pokeRow = fetchAssoc($query, $conn);
	
	$pokeRow['name']  = $type.$pokeRow['name'];
	$pokeRow['level'] = $level;
	$pokeRow['maxhp'] = maxHp($pokeRow['name'], $level, $conn);
	$pokeRow['hp']    = maxHp($pokeRow['name'], $level, $conn);
	
	$_SESSION['battle']['opponent'][$i] = $pokeRow;
	
	$cells[] = '
		<img src="images/pokemon/'.$pokeRow['name'].'.png" /><br />
		'.$pokeRow['name'].'<br />
		'.$lang['npcddel_00'].' '.$pokeRow['level'].'<br />
		'.$lang['npcddel_01'].' '.$pokeRow['hp'].'/'.$pokeRow['maxhp'].'
	';
}
$_SESSION['battle']['rebattlelink'] = '<a href="npc.php?battle='.$_GET['x2'].'&rebattle">'.$lang['npcddel_02'].'</a>';
$_SESSION['battle']['onum'] = 0;

if (isset($_GET['rebattle'])) {
	redirect('battle.php');
}


include '_header.php';
printHeader($lang['npcddel_title']);


echo '
	<div style="text-align: center;">
		<a href="?battle=x2">'.$lang['npcddel_03'].'</a> &bull; <a href="?battle=x3">'.$lang['npcddel_04'].'</a> &bull; <a href="?battle=x5">'.$lang['npcddel_05'].'</a>
	</div>

	
	<table class="pretty-table" style="margin-top: 10px;">
		'.cellsToRows($cells, 6).'
		<tr>
			<td colspan="6">
				<form action="battle.php" method="post">
					<input type="submit" value="'.$lang['npcddel_06'].'">
				</form>
			</td>
		</tr>
	</table>
';

include '_footer.php';

?>
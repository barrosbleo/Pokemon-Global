<?php
include('modules/lib.php');
//battle training


if (!isLoggedIn()) {
	redirect('index.php');
}

include '_header.php';
printHeader($lang['fix_title']);

switch ($_GET['d']) {
	case 'g':
		$minLevel = 5;
		$maxLevel = 10;
		$numPokes = 1;
	break;
	
	case 'e':
		$minLevel = 5;
		$maxLevel = 10;
		$numPokes = 3;
	break;

	case 'h':
		$minLevel = 15;
		$maxLevel = 20;
		$numPokes = 6;
	break;

        case 'n':
		$minLevel = 25;
		$maxLevel = 35;
		$numPokes = 6;
	break;
	
	case 'i':
		$minLevel = 40;
		$maxLevel = 50;
		$numPokes = 6;
	break;
       
        case 'm':
		$minLevel = 60;
		$maxLevel = 70;
		$numPokes = 6;
	break;

       case 'a':
		$minLevel = 80;
		$maxLevel = 90;
		$numPokes = 6;
	break;
	
	case 'v':
		$minLevel = 95;
		$maxLevel = 100;
		$numPokes = 6;
	break;

	
	default:
	case 'p':
		$_GET['d'] = 'p';
		$minLevel = 30;
		$maxLevel = 50;
		$numPokes = 3;
	break;
}

$query = "SELECT `id` FROM `pokemon` ORDER BY `id` ASC LIMIT 1";
$lastId = fetchAssoc($query, $conn);
$lastId = $lastId['id'];

$cells = array();

for ($i=0;$i<$numPokes;$i++ ){
	$randId      = mt_rand(1, $lastId);
	$randomLevel = mt_rand($minLevel, $maxLevel);
	$type        = mt_rand(1, 5) == 3 ? 'Shiny ' : '' ;
	
	$query   = "SELECT * FROM `pokemon` WHERE `id`>={$randId} AND `name`!='' LIMIT 1";
	$pokeRow = fetchAssoc($query, $conn);
	
	$pokeRow['name']  = $type.$pokeRow['name'];
	$pokeRow['level'] = $randomLevel;
	$pokeRow['maxhp'] = maxHp($pokeRow['name'], $randomLevel, $conn);
	$pokeRow['hp']    = maxHp($pokeRow['name'], $randomLevel, $conn);
	
	$_SESSION['battle']['opponent'][$i] = $pokeRow;
	
	$cells[] = '
		<img src="images/pokemon/'.$pokeRow['name'].'.png" /><br />
		'.$pokeRow['name'].'<br />
		'.$lang['fix_00'].' '.$pokeRow['level'].'<br />
		'.$lang['fix_01'].' '.$pokeRow['hp'].'/'.$pokeRow['maxhp'].'
	';
}
$_SESSION['battle']['rebattlelink'] = '<a href="fix.php?d='.$_GET['d'].'&rebattle">'.$lang['fix_02'].'</a>';
$_SESSION['battle']['onum'] = 0;

if (isset($_GET['rebattle'])) {
	redirect('battle.php');
}

echo '
	<div style="text-align: center;">
		'.$lang['fix_03'].' 
	</div>

	
	<table class="pretty-table" style="margin-top: 10px;">
		'.cellsToRows($cells, 6).'
		<tr>
			<td colspan="6">
				<form action="battle.php" method="post">
					<input type="submit" class="smallbutton" value="'.$lang['fix_04'].'">
				</form>
			</td>
		</tr>
	</table>
';

include '_footer.php';
?>

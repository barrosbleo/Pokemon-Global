<?php
include('../modules/lib.php');
include '../_header.php';
printHeader('Rarity List');

$f = array(
	'1' => array(
		'text' => 'Normal',
		'sql' => " WHERE `name` NOT REGEXP 'Shiny|Possion|Snow|Rainbow|Helios|Halloween|Shadow' ",
	),
	'2' => array(
		'text' => 'Shiny',
		'sql' => " WHERE `name` LIKE '%Shiny%' ",
	),
	'3' => array(
		'text' => 'Possion',
		'sql' => " WHERE `name` LIKE '%Possion%' ",
	),
	'4' => array(
		'text' => 'Snow',
		'sql' => " WHERE `name` LIKE '%Snow%' ",
	),
	'5' => array(
		'text' => 'Rainbow',
		'sql' => " WHERE `name` LIKE '%Rainbow%' ",
	),
	'6' => array(
		'text' => 'Helios',
		'sql' => " WHERE `name` LIKE '%Helios%' ",
	),
	'7' => array(
		'text' => 'Halloween',
		'sql' => " WHERE `name` LIKE '%Halloween%' ",
	),
	'8' => array(
		'text' => 'Shadow',
		'sql' => " WHERE `name` LIKE '%Shadow%' ",
	)
);

$key = isset($_GET['s']) && array_key_exists($_GET['s'], $f) ? (int) $_GET['s'] : 1 ;
$extraSql = $f[ $key ]['sql'];

$links = array();
foreach ($f as $k => $a) {
	$links[] = $key == $k ? $a['text'] : '<a href="?s='.$k.'">'.$a['text'].'</a>' ;
}

$query = mysql_query("SELECT `name`, `gender`, count(`id`) as amount FROM `user_pokemon` {$extraSql} GROUP BY `name`, `gender`");
$pokeArray = array();
$genderArray = array('1'=>'male', '2'=>'female', '0'=>'genderless');

while ($r = mysql_fetch_assoc($query)) {
	$pokeArray[ $r['name'] ][ $genderArray[ $r['gender'] ] ] = $r['amount'];
}

echo '
	'.implode(' &bull; ', $links).'<br /><br />
	<div class="contentcontent"><table class="pretty-table">
		<tr>
			<th>Name</th>
			<th>Male</th>
			<th>Female</th>
			<th>Genderless</th>
		</tr>
';

foreach ($pokeArray as $pokeName => $genderAmount) {
	$genderAmount['male'] = isset($genderAmount['male']) ? $genderAmount['male'] : 0 ;
	$genderAmount['female'] = isset($genderAmount['female']) ? $genderAmount['female'] : 0 ;
	$genderAmount['genderless'] = isset($genderAmount['genderless']) ? $genderAmount['genderless'] : 0 ;
	
	echo '
		<tr>
			<td><a href="poke_rank.php?name=' . $pokeName . '">' . $pokeName . '</a></td>
			<td>' . number_format($genderAmount['male']) . '</td>
			<td>' . number_format($genderAmount['female']) . '</td>
			<td>' . number_format($genderAmount['genderless']) . '</td>
		</tr>
	';
}

echo '
	</table></div>
';
include '../_footer.php';
?>
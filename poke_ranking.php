<?php
include('modules/lib.php');

include '_header.php';
printHeader($lang['poke_rank_title']);

$uid = (int) $_SESSION['userid'];
$cells = array();

$types = array(
	'Snow'        => '#00FFFF',
	'Shiny'       => '#F4FA58',
	'Halloween'   => '#FF8000',
	'Rainbow'     => '#00FF00',
	'Helios'      => '#F7D358',
	'Possion'     => '#610B4B',
	'Shadow'      => '#610B21',
	'Normal'      => '#FFFFFF'
);

foreach ($types as $type => $color) {

if ($type == 'Normal') {
$typesRegExp = implode('|', array_keys($types));
$query = mysql_query("
	SELECT
		`users`.`id`,
		`users`.`username`,
		`user_pokemon`.`name`,
		`user_pokemon`.`id` AS `pid`,
		`user_pokemon`.`exp` AS `poke_exp`,
		`user_pokemon`.`level` AS `poke_level`

	FROM
		`user_pokemon`,
		`users`
                
	WHERE
		`users`.`id` = `user_pokemon`.`uid` AND
		`user_pokemon`.`name` NOT REGEXP '{$typesRegExp}' AND
		`users`.`admin` = '0' AND
		`users`.`banned` = '0'
	ORDER BY `poke_level` DESC
	LIMIT 10
");
} else {
$query = mysql_query("
	SELECT
		`users`.`id`,
		`users`.`username`,
		`user_pokemon`.`name`,
		`user_pokemon`.`id` AS `pid`,
		`user_pokemon`.`exp` AS `poke_exp`,
		`user_pokemon`.`level` AS `poke_level`

	FROM
		`user_pokemon`,
		`users`
                
	WHERE
		`users`.`id` = `user_pokemon`.`uid` AND `user_pokemon`.`name` LIKE '%{$type} %'
		AND `users`.`admin` = '0' AND `users`.`banned` = '0'
	ORDER BY `poke_level` DESC
	LIMIT 10
");
}
if ($query) {
	$cell = '
	        <span style="color: orange;">
		<center><h2 class="header2">'.$lang['poke_rank_00'].' '.$type.' '.$lang['poke_rank_01'].'</h2></center><br />
		<table class="pretty-table">
			<tr>
				<th style="width: 50px; min-width: 50px; max-width: 50px;">#</th>
				<th>'.$lang['poke_rank_02'].'</th>
				<th>'.$lang['poke_rank_03'].'</th>
				<th>'.$lang['poke_rank_04'].'</th>
				<th style="width: 150px;">'.$lang['poke_rank_05'].'</th>
				<th>'.$lang['poke_rank_06'].'</th>
			</tr> </span>
	';
	$i=1;
	while ($row = mysql_fetch_assoc($query)) {
		$imgHtml = '';
		$parts = explode(' ', $row['name']);
		
		for ($j=0; $j<count($parts); $j++) {
			$filename = 'images/icons/' . implode(' ', array_slice($parts, $j)) . '.gif';

			if (file_exists($filename)) {
				$imgHtml = '<img src="'.$filename.'" />';
				break;
			}
		}
		
		$medalImage = 'images/arrows/medal.png';
		if ($i==1) {
			$medalImage = 'images/arrows/gold.png';
		} else if ($i==2) {
			$medalImage = 'images/arrows/silver.png';
		}
		
		$cell .= '
			<tr>
				<td>'.$i.'</td>
				<td>
					<b>
						<img src="'.$medalImage.'" alt="X">&nbsp;<a href="profile.php?id='.$row['id'].'" style="color: '.$color.'">'.htmlspecialchars($row['username']).'</a>
					</b>
				</td>
				<td>'.$imgHtml.'</td>
				<td>
					<b>
						<a href="pinfo.php?id='.$row['pid'].'" style="color: '.$color.'">
							
								'.cleanHtml($row['name']).'
						
						</a>
					</b>
				</td>
				
				
				<td>'.number_format($row['poke_level']).'</td>
				<td>'.number_format($row['poke_exp']).'</td>
			</tr>
		';
		$i++;
	}
	$cell .= '</table><br /><br /><br />';
	$cells[] = $cell;
}

}




// '.cellsToRows($cells, 1).'

echo '
	<div class="sub-content"> 
		
			'.implode('', $cells).'
		
	</div>
';


include '_footer.php';
?>
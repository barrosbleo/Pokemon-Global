<?php
include('modules/lib.php');

include '_header.php';
printHeader($lang['stats_title']);

function secsToTimeAmountArray($secs) {
	if ($secs <= 0) { return array('-'); }
	
        $seconds = array(
                'days'    => 86400,
                'hours'   =>  3600,
                'minutes' =>    60,
                'seconds' =>     1,
        );
        $timeAmounts = array();
        
        foreach ($seconds as $name => $seconds) {
        	$amount = intval($secs / $seconds);
        	$secs -= $amount * $seconds;
		if ($amount > 0) {
			$timeAmounts[] = $amount.' '.($amount == 1 ? rtrim($name, 's') : $name );
		}
        }
        return $timeAmounts;
}

$uid = (int) $_SESSION['userid'];
$cells = array();


$query = "
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
		`users`.`id` = `user_pokemon`.`uid`
		AND `users`.`admin` = '0' AND `users`.`banned` = '0'
		/* GROUP BY `user_pokemon`.`uid` */
	ORDER BY `poke_exp` DESC
	LIMIT 10
";
if ($query) {
	$cell = '
		<center><h2 class="header2">'.$lang['stats_00'].'</h2></center><br />
		<table class="pretty-table">
			<tr>
				<th style="width: 50px; min-width: 50px; max-width: 50px;">#</th>
				<th>'.$lang['stats_01'].'</th>
				<th>'.$lang['stats_02'].'</th>
				<th style="width: 150px;">'.$lang['stats_03'].'</th>
				<th>'.$lang['stats_04'].'</th>
			</tr>
	';
	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .= '
			<tr>
				<td>'.$i.'</td>
				<td>
					<b>
						<a href="profile.php?id='.$row['id'].'">
						'.htmlspecialchars($row['color']).'
							
								'.htmlspecialchars($row['username']).'
						
						</a>
					</b>
				</td>
				<td>
					<b>
						<a href="pinfo.php?id='.$row['pid'].'">
							
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


$query = "
	SELECT
		`users`.`id`,
		`users`.`username`,
		SUM( `user_pokemon`.`exp` ) AS `total_exp` 
              
	FROM
		`user_pokemon`,
		`users`
                
	WHERE
		`users`.`id` = `user_pokemon`.`uid` AND
		`users`.`admin` = '0' AND `users`.`banned` = '0'
	GROUP BY `user_pokemon`.`uid`
	ORDER BY `total_exp` DESC
	LIMIT 10
";
if ($query) {
	$cell = '
		<center><h2 class="header2">'.$lang['stats_05'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_07'].'</th>
			</tr>
	';
	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .= '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['color']).'
'.htmlspecialchars($row['username']).'</a></td>
				<td>'.number_format($row['total_exp']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}


$query = "
	SELECT
		COUNT( DISTINCT(`user_pokemon`.`name`) ) AS `num_uniques`,
		`users`.`username`,
		`users`.`id`
	FROM
		`user_pokemon`,
		`users`
	WHERE
		`users`.`id`=`user_pokemon`.`uid` AND
		`users`.`admin`='0' AND `users`.`banned` = '0'
	GROUP BY `uid`
	ORDER BY `num_uniques`
	DESC LIMIT 10
";

if ($query) {
	$cell = '
		<center><h2 class="header2">'.$lang['stats_08'].'</h2></center><br />
		<table class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_09'].'</th>
			</tr>
	';
	
	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .= '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.number_format($row['num_uniques']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}





$query = "
	SELECT
		ROUND( AVG(`exp`) ) AS `avg_exp`,
		`users`.`username`,
		`users`.`id`
	FROM
		`user_pokemon`,
		`users`
	WHERE
		`users`.`id`=`user_pokemon`.`uid` AND
		`users`.`admin`='0' AND `users`.`banned` = '0'
	GROUP BY `user_pokemon`.`uid`
	ORDER BY `avg_exp`
	DESC LIMIT 10
";

if ($query) {
	$cell = '
		<center><h2 class="header2">'.$lang['stats_10'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_11'].'</th>
			</tr>
	';
	
	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .= '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.number_format($row['avg_exp']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}


$query = "
	SELECT
		`id`,
		`username`,
		`won`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `won` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_12'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_13'].'</th>
			</tr>
	';
	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .= '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.$row['won'].'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}

$query = "
	SELECT
		`id`,
		`username`,
		`money`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `money` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_14'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_15'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>$'.number_format($row['money']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}


$query = "
	SELECT
		`id`,
		`username`,
		`bank`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `bank` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_16'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_17'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>$'.number_format($row['bank']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}





$query = "
	SELECT
		`id`,
		`username`,
		`mexp`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `mexp` DESC
	LIMIT 10
";












$query = "
	SELECT
		`id`,
		`username`,
		`released`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `released` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_18'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_19'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.number_format($row['released']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}















$query = "
	SELECT
		`id`,
		`username`,
		`token`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `token` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_20'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_21'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.number_format($row['token']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}






$query = "
	SELECT
		`id`,
		`username`,
		`Referals`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `Referals` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_22'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_23'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.number_format($row['Referals']).'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}








$query = "
	SELECT
		`id`,
		`username`,
		`champ_longest_run`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `champ_longest_run` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_24'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_25'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$length = implode(', ', secsToTimeAmountArray($row['champ_longest_run']));
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.$length.'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}

















$query = "
	SELECT
		`id`,
		`username`,
		`champ_total_time`
	FROM
		`users`
	WHERE
		`admin`='0' AND `banned` = '0'
	ORDER BY `champ_total_time` DESC
	LIMIT 10
";

if ($query) {

	$cell = '
		<center><h2 class="header2">'.$lang['stats_26'].'</h2></center><br />
		<table  class="pretty-table" width="98%" cellpadding="0" cellspacing="0" text-align="center" align="center" border="1">
			<tr>
				<th style="width: 50px;">#</th>
				<th>'.$lang['stats_06'].'</th>
				<th>'.$lang['stats_27'].'</th>
			</tr>
	';
		

	$i=1;
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$length = implode(', ', secsToTimeAmountArray($row['champ_total_time']));
		$cell .=  '
			<tr>
				<td>'.$i++.'</td>
				<td><a href="profile.php?id='.$row['id'].'">'.htmlspecialchars($row['username']).'</a></td>
				<td>'.$length.'</td>
			</tr>
		';
	}
	$cell .= '</table><br /><br />';
	$cells[] = $cell;
}










// '.cellsToRows($cells, 1).'

echo '
	<div class="sub-content"> 
		
			'.implode('', $cells).'
		
	</div>
';


include '_footer.php';
?>
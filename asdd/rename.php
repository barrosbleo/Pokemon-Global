<?php
include('../modules/lib.php');

$q = mysql_query("SELECT * FROM `pokemon`");

while ($row = mysql_fetch_assoc($q)) {
	//echo $row['num'] . ' - ' . $row['name'] . '<br/>';
	@rename('images/'.$row['num'].'.png', 'images/Snow '.$row['name'].'.png');
}



?>
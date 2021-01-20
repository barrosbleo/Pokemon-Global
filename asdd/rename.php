<?php
include('../modules/lib.php');

$q = "SELECT * FROM `pokemon`";
$result = $conn->query($q);
while ($row = $result->fetch_assoc()) {
	//echo $row['num'] . ' - ' . $row['name'] . '<br/>';
	@rename('images/'.$row['num'].'.png', 'images/Snow '.$row['name'].'.png');
}



?>
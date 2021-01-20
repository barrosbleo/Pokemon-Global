<?php

function echoHeader($header) {
	echo '<div class="sub-content-header"><h3>'.$header.'</h3></div>';
}


function getModProfileList() {
	$query = "SELECT `id`, `username` FROM `users` WHERE `mod`='1'";

	$modLinks = array();
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$row = cleanHtml($row);
		$modLinks[] = '<a href="../profile.php?id='.$row['id'].'">'.$row['username'].'</a>';
	}

	return implode(' &bull; ', $modLinks);
}

?>
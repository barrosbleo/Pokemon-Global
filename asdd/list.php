<?php

$files = glob('../images/pokemon/Enraged *.png');

foreach ($files as $file) {
	echo '<img src="'.$file.'">';
}
?>
<style>
	* { background: #161616; }
</style>
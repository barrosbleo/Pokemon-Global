<?php

if (!defined('GOT_CONFIG')) {
    die('No direct file access.');
}

?><!DOCTYPE html>
<html>
<head>
	<title>Pok&eacute;mon Global Staff Panel</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css?<?php echo rand(1, 9999999); ?>">
</head>
<body>
	
	<div id="wrapper">
		<div id="header">
			<h1>Pok&eacute;mon Global Staff Panel</h1>
		</div>
		
		<div id="left-navigation">
			<ul>
				<li><h3>RPG Links</h3></li>
				<li><a href="../index.php">RPG Home</a></li>
				<li><a href="../membersarea.php">Membersarea</a></li>
				<li><a href="../snow_machine.php">Snow Machine</a></li>
				<li><a href="../shop_pokemon.php">Pokemon Shop</a></li>
				<li><a href="../token_shop.php">Token Shop</a></li>
				<li><a href="../promo.php">Promo</a></li>
			</ul>
			<ul>
				<li><h3>Admin Links</h3></li>
				<li><a href="index.php">Admin Home</a></li>
				<li><a href="edit_news.php">Edit News</a></li>
				<li><a href="edit_pokemon.php">Edit Pokemon</a></li>
				<li><a href="edit_user.php">Edit User</a></li>
				<li><a href="mapmaker.php">Config Map</a></li>
				<li><a href="edit_snow_machine.php">Edit Snow Machine</a></li>
				<li><a href="edit_pokemon_shop.php">Edit Shop Pokemon</a></li>
				<li><a href="edit_ref_shop.php">Edit Referral Shop</a></li>
				<li><a href="edit_token_shop.php">Edit Token Shop Pokemon</a></li>
				<li><a href="edit_promo.php">Edit Promo</a></li>
				<?php
				$query = mysql_query("SELECT * FROM `new_images`");
				$numImages = mysql_num_rows($query);
				?>
				<li><a href="approve_sprites.php">Approve Sprites (<?php echo $numImages; ?>)</a></li>
				<li><a href="ban_list.php">View Ban List</a></li>
			</ul>
		</div>
		
		<div id="content">
			<div class="sub-content">
			
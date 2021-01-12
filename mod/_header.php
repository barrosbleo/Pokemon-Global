<?php

if (!defined('GOT_CONFIG')) {
    die('No direct file access.');
}

?><!DOCTYPE html>
<html>
<head>
	<title>Pok&eacute;mon Helios Mod Panel</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css?<?php echo rand(1, 9999999); ?>">
</head>
<body>
	
	<div id="wrapper">
		<div id="header">
			<h1>Pok&eacute;mon Helios Mod Panel</h1>
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
				<li><h3>Mod Links</h3></li>
				<li><a href="index.php">Admin Home</a></li>
				<li><a href="ae_sprite.php">Add/Edit Sprite</a></li>
			</ul>
		</div>
		
		<div id="content">
			<div class="sub-content">
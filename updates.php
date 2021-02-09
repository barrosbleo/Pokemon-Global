<?php
include('modules/config.php');
include('modules/language.php');


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pokémon Global</title>
		<link rel="stylesheet" href="layout/style-main.css" />
	</head>
	
	<body>
		<div id="wrapper">
			<!--<div id="header">
				<a href="https://www.facebook.com/duskrpg/" target="_blank">
					<img src="layout/fb.png" title="Follow us on Facebook" alt="Pokemon Helios RPG" />
				</a>
			</div>-->
			
			<div id="section">
				<div id="update">
					<img src="layout/update.png" />
					<p class="bigText"><?php echo $lang['updt_big_txt'];?><p>
					<p class="smallText"><?php echo $lang['updt_reason'];?></p>	
				</div>
			</div>
			
			<div id="footerUpdate">
				Copyright &copy; 2020 <a href="https://pkmglobal.online" title="Pokemon Global" alt="Pokemon Global">Pokemon Global</a>. All rights reserved.<br />
				This site is not affiliated with Nintendo, Creatures, or GameFreak. 
			</div>
		</div>
	</body>
</html>
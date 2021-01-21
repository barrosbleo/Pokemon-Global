<?php
	// count online users past 60 min
	$oTime = time() - (60*60);
	$query = "SELECT * FROM `users` WHERE `lastseen` >= '{$oTime}' ORDER BY `lastseen` DESC";
	$online = numRows($query, $conn);
	
	// count total users
	$query = "SELECT `id` FROM `users`";
	$usersTotal = numRows($query, $conn);
	
	// change game style on events (Temporary)
	$eventStyle = '';
	if (empty($eventStyle)) { $eventStyle = ''; } else { $eventStyle = '/'.$eventStyle; }
	
	require_once 'link_ref.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="index, follow">
		<meta name="description" content="Pokemon RPG,pokemon rpg, pokemon, rpg, free pokemon rpg, Pokemon MMORPG">
		<meta name="keywords" content="Pokemon RPG, pokemon rpg, pokemon, rpg, free pokemon rpg, Pokemon MMORPG">
		<meta name="author" content="Pokemon RPG, pokemon rpg, pokemon, rpg, free pokemon rpg, Pokemon MMORPG">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php echo $lang['header_title'];?></title>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,800,700">
		<link rel="shortcut icon" href="/images/layout/favicon.png">
		
		<?php if (isset($_SESSION['userid'])) : ?>
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="/js/jquery-latest.min.js"></script>
		
		<script src="/bootstrap/js/bootstrap.min.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php endif; ?>
		<?php if (isset($_SESSION['userid'])) $style = '-game'; else $style = ''; ?>			
		<?php $version = rand(1,10000); ?>
		<link rel="stylesheet" href="/css/style<?php echo $eventStyle.$style;?>.css?ver=<?php echo $version;?>">
	</head>
	<body>
		<?php
			if (isset($_SESSION['userid'])) :	
				if ($_SESSION['admin'] == 1) {
					echo '<a class="staff" href="/staff">CPanel</a>';
					echo '<style> ins { display: none !important; } </style>';
				}		
				if ($_SESSION['mod'] == 1) {
					echo '<a class="staff" href="/mod">MPanel</a>';
					echo '<style> ins { display: none !important; } </style>';
				}		
		?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand logo" href="membersarea.php"></a>
		</div>
	
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-left">
		            <li class="dropdown">
				<a href="/map.php?map=<?php echo base64_encode($_SESSION['player']['map_num']);?>" class="dropdown-toggle"><?php echo $lang['header_menu_01'];?></span></a>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_02'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/membersarea.php"><?php echo $lang['header_submenu_02_10'];?></a></li>
					<li><a href="/profile.php?id=<?php echo $_SESSION['userid']; ?>&amp;lref=2"><?php echo $lang['header_submenu_02_01'];?></a></li>
					<li><a href="/edit_profile.php"><?php echo $lang['header_submenu_02_02'];?></a></li>
					<li><a href="/messages.php?p=inbox"><?php echo $lang['header_submenu_02_03'];?></a></li>
					<li><a href="/view_box.php"><?php echo $lang['header_submenu_02_04'];?></a></li>
					<li><a href="/team.php"><?php echo $lang['header_submenu_02_05'];?></a></li>
					<li><a href="/friends.php"><?php echo $lang['header_submenu_02_06'];?></a></li>
					<li><a href="/pokedex.php"><?php echo $lang['header_submenu_02_07'];?></a></li>
					<li><a href="/refl.php"><?php echo $lang['header_submenu_02_08'];?></a></li>
					<li><a href="/logout.php"><?php echo $lang['header_submenu_02_09'];?></a></li>
				</ul>
			</li>

            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_03'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/clans"><?php echo $lang['header_submenu_03_01'];?></a></li>
					<li><a href="/clans/clanhome.php"><?php echo $lang['header_submenu_03_02'];?></a></li>
					<li><a href="/clans/createclan.php"><?php echo $lang['header_submenu_03_03'];?></a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_05'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/trade.php"><?php echo $lang['header_submenu_05_01'];?></a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_06'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/shop.php"><?php echo $lang['header_submenu_06_01'];?></a></li>
					<li><a href="/shop_pokemon.php"><?php echo $lang['header_submenu_06_02'];?></a></li>
					<li><a href="/token_shop.php"><?php echo $lang['header_submenu_07_04'];?></a></li>
					<li><a href="/sell_pokemon.php"><?php echo $lang['header_submenu_06_03'];?></a></li>
					<li><a href="/auction.php"><?php echo $lang['header_submenu_06_04'];?></a></li>
					<li><a href="/promo.php"><?php echo $lang['header_submenu_06_05'];?></a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_07'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/snow_machine.php"><?php echo $lang['header_submenu_07_01'];?></a></li>
					<li><a href="/donate.php"><?php echo $lang['header_submenu_07_03'];?></a></li>
					<li><a href="/collection_machine.php"><?php echo $lang['header_submenu_07_05'];?></a></li>
				</ul>
			</li>
           

			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_08'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/send_money.php"><?php echo $lang['header_submenu_08_01'];?></a></li>
					<li><a href="/bank.php"><?php echo $lang['header_submenu_08_02'];?></a></a>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_09'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/stats.php"><?php echo $lang['header_submenu_09_01'];?></a></li>
					<li><a href="/poke_ranking.php"><?php echo $lang['header_submenu_09_02'];?></a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['header_menu_11'];?> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/staff.php"><?php echo $lang['header_submenu_11_01'];?></a></li>
					<li><a href="/users.php"><?php echo $lang['header_submenu_11_02'];?></a></li>
					<li><a href="/online.php"><?php echo $lang['header_submenu_11_03'];?>
						<span class="count online">&nbsp; - &nbsp;<?php echo $online?></span></a></li>
					<li><a href="/chatroom.php" target="_blank"><?php echo $lang['header_submenu_11_04'];?></a></li>
					<!--<li><a href="http://www.facebook.com/duskrpg">Facebook</a></li>-->
					<li><a href="/rules.php"><?php echo $lang['header_submenu_11_05'];?></a></li>
					<li><a href="/legalinfo.php"><?php echo $lang['header_submenu_11_06'];?></a></li>
  				</ul>
			</li>
			<?php 
				$suid = array(1,3);
				if(in_array($_SESSION['userid'], $suid)) : 
			?>
			
			<?php endif; ?>
		</ul>
	</div>
	</div>
</nav>

<?php
	$usersQuery = "SELECT `poke1` FROM `users` WHERE id='{$_SESSION['userid']}'";
	if ($usersQuery) {
	$usersRow = fetchObj($usersQuery, $conn);
							
	$starterID = $usersRow->poke1;
								
	$pokeQuery = "SELECT * FROM `user_pokemon` WHERE `id`='{$starterID}'";
	if ($pokeQuery) {
	$pokeRow = fetchObj($pokeQuery, $conn);
	
	$pokename = $pokeRow->name;
	$pokelevel = $pokeRow->level;
	
	$starter = '<img src="images/pokemon/'.$pokename.'.png" title="'.$pokename.'" />';

		// Lets make level bar ~Roby
	$cexp = $pokeRow->exp;  									// Example 1270
	$clevel = $pokeRow->level; 									// Example 11
	$clevelexp = levelToExp($clevel); 							// Example 1210
	$nextlevelexp = ($clevel + 1) * ($clevel + 1) * 10; 		// Example 1440

	$levelbar = (($cexp - $clevelexp) / ($nextlevelexp - $clevelexp)) * 100; // Example 50%
echo '
	<ul class="usr-inf right">
		<li class="usr-inf-title"><a href="#">Starter</a></li>
		<li class="starter">
					<center><img src="/images/pokemon/'. $pokename .'.png"></center><br />
					
					<span class="level">NIVEL: '. $clevel .'</span><br />
					
					<span class="next_level">
						<span class="next_level_p" style="width: '. ceil($levelbar) .'%;">
							'. floor($levelbar) .'%
						</span>
					</span>
		</li>
	';	
	
}
}	
	include 'user_notifications2.php'; 
?>

<div id="content">


<?php else: ?>
	<div class="header">
		<div class="wrap">
				<a href="index.php" class="logo" alt="<?php echo $lang['header_title'];?>"></a>
					<div class="social-bg" style="visibility:hidden"></div>
			<ul class="social" style="visibility:hidden">
				<li><a href="http://www.youtube.com/"><span><?php echo $lang['social_yt'];?></span></a></li>
				<li><a href="https://plus.google.com/"><span><?php echo $lang['social_gp'];?></span></a></li>
				<li><a href="https://www.facebook.com/duskrpg"><span><?php echo $lang['social_fb'];?></span></a></li>
				<li><a href="https://twitter.com/geek_feeder"><span><?php echo $lang['social_tw'];?></span></a></li>
				<li><a href="http://robytoby.com" alt="<?php echo $lang['social_rl_1'];?>"><span><?php echo $lang['social_rl_2'];?></span></a></li>
			</ul>
			<ul class="menu">
				<li><p onclick="loadPage('login');"><span></span><?php echo $lang['menu_login'];?></p></li>
				<li><p onclick="loadPage('register');"><span></span><?php echo $lang['menu_register'];?></p></li>
				<li><p onclick="loadPage('news');"><span></span><?php echo $lang['menu_news'];?></p></li>
				<li><p onclick="loadPage('chatroom');"><span></span><?php echo $lang['menu_chatroom'];?></p></li>
			</ul>
		</div>	

		<ul class="lang">
			<li class="beta"><?php echo $lang['lang_beta'];?></li>
			<li><a href="?lang=en" title="<?php echo $lang['lang_en'];?>"><img src="images/lang/en.png"></a></li>	
			<li><a href="?lang=pt-br" title="<?php echo $lang['lang_pt-br'];?>"><img src="images/lang/pt-br.png"></a></li>	
		</ul>
		
	</div>

<?php endif; ?>

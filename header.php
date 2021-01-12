<?php
	// count online users past 60 min
	$oTime = time() - (60*60);
	$online = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `lastseen` >= '{$oTime}' ORDER BY `lastseen` DESC"));
	
	// count total users
	$usersTotal = mysql_num_rows(mysql_query("SELECT `id` FROM `users`"));
	
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
		
		<title>Pokemon Dusk - Cyan Edition RPG - Online Pokemon MMORPG</title>
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
					//echo '<a class="staff" href="/staff">CPanel</a>';
					//echo '<style> ins { display: none !important; } </style>';
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
			

		  </button>
		  <a class="navbar-brand logo" href="http://cyan.pkmndusk.in/membersarea.php"></a>
		</div>
	
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/profile.php?id=<?php echo $_SESSION['userid']; ?>&amp;lref=2">My Profile</a></li>
					<li><a href="/edit_profile.php">Edit Profile</a></li>
					<li><a href="/messages.php?p=inbox">Messages</a></li>
					<li><a href="/view_box.php">View Your Box</a></li>
					<li><a href="/team.php">My Team</a></li>
					<li><a href="/friends.php">My Friends</a></li>
					<li><a href="/pokedex.php">Pokedex</a></li>
					<li><a href="/refl.php">Referral Centre</a></li>
					<li><a href="/logout.php">Logout</a></li>
					<li><a href="/membersarea.php">News & updates</a></li>
				</ul>
			</li>

            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Clans <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/clans">Clans List</a></li>
					<li><a href="/clans/clanhome.php">My Clan</a></li>
					<li><a href="/clans/createclan.php">Create Clan</a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Battles <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/gyms.php">Battle Gyms</a></li>
					<li><a href="/fix.php">Battle Training</a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Trades <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/trade.php">Trade Center</a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Shops/Promo <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/shop.php">Shops</a></li>
					<li><a href="/shop_pokemon.php">Buy Pokemon</a></li>
					<li><a href="/sell_pokemon.php">Global Buy/Sell</a></li>
					<li><a href="/auction.php">Auctions</a></li>
					<li><a href="/promo.php">Promo Store</a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Extras <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/snow_machine.php">Snow Machine</a></li>
					<li><a href="/lottery.php">Lottery</a></li>
					<li><a href="/donate.php">Donate</a></li>
					<li><a href="/token_shop.php">Token Shop</a></li>
					<li><a href="/collection_machine.php">Collection Machine</a></li>
				</ul>
			</li>
           
            <li class="dropdown">
				<a href="#" class="dropdown-toggle"">Maps <span class="caret"></span></a>
				<!--<ul class="dropdown-menu" role="menu">
					<li><a href="/map.php?map=1">Grass Throne</a></li>
					<li><a href="/map.php?map=31">Bug Throne</a></li>
					<li><a href="/map.php?map=5">Water Throne</a></li>
					<li><a href="/map.php?map=8">Rock Throne</a></li>
					<li><a href="/map.php?map=10">Ice Throne</a></li>
					<li><a href="/map.php?map=15">Ghost Throne</a></li>
					<li><a href="/map.php?map=12">Fire Throne</a></li>
					<li><a href="/map.php?map=16">Electric Throne</a></li>
					<li><a href="/map.php?map=18">Flying Throne</a></li>
					<li><a href="/map.php?map=19">Psychic Throne</a></li>
					<li><a href="/map.php?map=25">Dragon Throne</a></li>
					<li><a href="/map.php?map=30">Dark Throne</a></li>
				</ul>-->
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Money/Bank <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/send_money.php">Send Money</a></li>
					<li><a href="/bank.php">Bank</a></a>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Rankings <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/stats.php">Trainer Rankings</a></li>
					<li><a href="/poke_ranking.php">Pokemon Ranking</a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Need Help? <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/asdd">Pokemon Rarity</a></a>
					<li><a href="http://forums.pkmndusk.in/">Forum</a></li>
				</ul>
			</li>
			
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Community <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/staff.php">Staff List</a></li>
					<li><a href="/users.php">Members</a></li>
					<li><a href="/online.php">Online members
						<span class="count online">&nbsp; - &nbsp;<?php echo $online;?></span></a></li>
					<li><a href="/chatroom.php" target="_blank">Chatroom</a></li>
					<li><a href="http://www.facebook.com/duskrpg">Facebook</a></li>
					<li><a href="/rules.php">Rules</a></li>
					<li><a href="/legalinfo.php">Legal Info</a></li>
  				</ul>
			</li>
			<?php
				$suid = array(1,3);
				if(in_array($_SESSION['userid'], $suid)) : 
			?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Game Centre <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/fiftyfifty">50/50</a></a>
					<li><a href="/dailyprize.php">Daily Prize</a></a>
					<li><a href="/luckyhour.php">Lucky Hour</a></a>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>
	</div>
</nav>

<?php
	$usersQuery = mysql_query("SELECT `poke1` FROM `users` WHERE id='{$_SESSION['userid']}'");
	if ($usersQuery) {
	$usersRow = mysql_fetch_object($usersQuery);
							
	$starterID = $usersRow->poke1;
								
	$pokeQuery = mysql_query("SELECT * FROM `user_pokemon` WHERE `id`='{$starterID}'");
	if ($pokeQuery) {
	$pokeRow = mysql_fetch_object($pokeQuery);
	
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
					
					<span class="level">LEVEL: '. $clevel .'</span><br />
					
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

		<div class="ads-one" style="text-align: center;">
			ads
		</div>
	
<div id="content">


<?php else: ?>
	<div class="header">
		<div class="wrap">
			<div class="social-bg"></div>
			
			<ul class="social">
				<li><a href="https://plus.google.com/"><span><?php echo $lang['social_gp'];?></span></a></li>
				<li><a href="https://www.facebook.com/duskrpg"><span><?php echo $lang['social_fb'];?></span></a></li>
				<li><a href="https://twitter.com/PokemonDusk"><span><?php echo $lang['social_tw'];?></span></a></li>
				<li><a href="http://robytoby.com" alt="<?php echo $lang['social_rl_1'];?>"><span><?php echo $lang['social_rl_2'];?></span></a></li>
			</ul>
			
			<ul class="menu">
				<li><a href="login.php"><span></span><?php echo $lang['menu_login'];?></a></li>
				<li><a href="chatroom.php"><span></span><?php echo $lang['menu_chatroom'];?></a></li>
				<li><a href="register.php"><span></span><?php echo $lang['menu_register'];?></a></li>
				<li><a href="index.php"><span></span><?php echo $lang['menu_news'];?></a></li>
			</ul>
		</div>	
		
		<a href="index.php" class="logo" alt="Pokemon Online RPG"></a>
		
		<ul class="lang">
			<li class="beta"><?php echo $lang['lang_beta'];?></li>
			<li><a href="?lang=en" title="<?php echo $lang['lang_en'];?>"><img src="images/lang/en.png"></a></li>	
			<li><a href="?lang=es" title="<?php echo $lang['lang_es'];?>"><img src="images/lang/es.png"></a></li>	
			<li><a href="?lang=ph" title="<?php echo $lang['lang_ph'];?>"><img src="images/lang/ph.png"></a></li>	
			<li><a href="?lang=lv" title="<?php echo $lang['lang_lv'];?>"><img src="images/lang/lv.png"></a></li>	
		</ul>
	</div>
	
	<div class="ads2">
		
	</div>
<?php endif; ?>
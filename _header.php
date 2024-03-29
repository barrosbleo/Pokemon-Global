<?php
	//unset battle session if run out of battle
	$exp = explode('/', $_SERVER["SCRIPT_NAME"]);
	$filename = end($exp);
	if ($filename != 'battle.php' && $filename != 'battle_user.php' && $filename != 'map_users.php'){
		unset($_SESSION['battle']);
	}

	// count online users past 60 min
	$oTime = time() - (60*60);
	$query = "SELECT * FROM `users` WHERE `lastseen` >= '{$oTime}' ORDER BY `lastseen` DESC";
	//$online = numRows($query, $conn);
	$foo = rand(48, 65);
	$online = $foo;

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
		<meta name="description" content="<?php echo $lang['meta_description'];?>">
		<meta name="keywords" content="Capturar pokemon, jogar pokemon, Pokemon Global, pokemon global, Pokemon RPG, pokemon rpg, pokemon, rpg, free pokemon rpg, Pokemon MMORPG">
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
		<?php endif; ?>
		<?php if (isset($_SESSION['userid'])) $style = '-game'; else $style = ''; ?>			
		<?php $version = rand(1,10000); ?>
		<link rel="stylesheet" href="/css/style<?php echo $eventStyle.$style;?>.css?ver=<?php echo $version;?>">
		
		<!-- Hotjar Tracking Code for pkmglobal.online -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2387071,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
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
		<div id="tutoFrame">
</div>
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
		  <a class="navbar-brand" href="/map.php?map=<?php echo base64_encode($_SESSION['player']['map_num']);?>"><div class="img"></div>
		  <div class="balloon">
				<?php echo $lang['worldball'];?>
		</div>
		</a>
		</div>
	
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-left">
			<li class="dropdown">
				<a href="/map.php?map=<?php echo base64_encode($_SESSION['player']['map_num']);?>" class="dropdown-toggle" style="color:#ff9900 !important; font-size:18px !important;"><?php echo $lang['header_menu_01'];?></span></a>
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
				<a href="/gyms.php" class="dropdown-toggle"><?php echo $lang['header_submenu_04_01'];?></span></a>
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
					<li><a href="/dailyprize.php"><?php echo $lang['header_submenu_12_02'];?></a></li>
					<li><a href="/luckyhour.php"><?php echo $lang['header_submenu_12_03'];?></a></li>
					<li><a href="/slots.php"><?php echo $lang['slots_title'];?></a></li>
					<li><a href="/fiftyfifty.php"><?php echo $lang['header_submenu_12_01'];?></a></li>
					<li><a href="/snow_machine.php"><?php echo $lang['header_submenu_07_01'];?></a></li>
					<li><a href="/donate.php"><?php echo $lang['header_submenu_07_03'];?></a></li>
					<li><a href="/collection_machine.php"><?php echo $lang['header_submenu_07_05'];?></a></li>
					<li><a href="/asdd"><?php echo $lang['header_submenu_10_01'];?></a></li>
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
					<li><a href="/forum/"><?php echo $lang['header_submenu_10_02'];?></a></li>
					<li><a href="/staff.php"><?php echo $lang['header_submenu_11_01'];?></a></li>
					<li><a href="/users.php"><?php echo $lang['header_submenu_11_02'];?></a></li>
					<li><a href="/online.php"><?php echo $lang['header_submenu_11_03'];?>
						<span class="count online">&nbsp; - &nbsp;<?php echo $online?></span></a></li>
					<li><a href="https://discord.com/invite/ZENSZBzcC6" target="_blank"><?php echo $lang['header_submenu_11_04'];?></a></li>
					<!--<li><a href="http://www.facebook.com/duskrpg">Facebook</a></li>-->
					<li><a href="/rules.php"><?php echo $lang['header_submenu_11_05'];?></a></li>
					<!--<li><a href="/legalinfo.php"><?php //echo $lang['header_submenu_11_06'];?></a></li>-->
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

<div id="slider"></div>
<script>
var slider = document.getElementById('slider');
var txt = [];
var count = 1;
txt[0] = "<spam><?php echo $lang['slider_txt_0'];?></spam>";
txt[1] = "<spam><a href='/donate.php'><?php echo $lang['slider_txt_1'];?></a></spam>";
txt[2] = "<spam><?php echo $lang['slider_txt_2'];?></spam>";
txt[3] = "<spam><a href='https://discord.gg/ZENSZBzcC6' target='blank'><?php echo $lang['slider_txt_3'];?></a></spam>";
txt[4] = "<spam><?php echo $lang['slider_txt_4'];?></spam>";
txt[5] = "<spam><?php echo $lang['slider_txt_5'];?></spam>";

function writeSlider(){
	//alert(count);
	if(count >= (txt.length)-1){
		count = 0;
	}else{
		count += 1;
	}
	slider.innerHTML = txt[count];
}
slider.innerHTML = txt[0];
setInterval(writeSlider, 20000);

</script>
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
		<li class="usr-inf-title"><a href="#">GST</a></li>
		<div id="clock">Loading Clock...</div>
		<li class="usr-inf-title"><a href="#">Starter</a></li>
		<li class="starter">
			<center><img src="/images/pokemon/'. $pokename .'.png"></center></br>
			<span class="level">NIVEL: '. $clevel .'</span></br>
			<span class="next_level">
				<span class="next_level_p" style="width:'.ceil($levelbar).'%;">
					'.floor($levelbar).'%
				</span>
			</span>
		</li>
	</ul>
';	
	
}
}	
	include 'user_notifications2.php'; 
?>
<script>
var gstClock = document.getElementById('clock');
function clock(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			gstClock.innerHTML = this.responseText;
			//alert('sucesso');
		}
	};
	xhttp.open("GET", "<?php echo $general['path'];?>/modules/clock.php", true);
	xhttp.send();
}
setInterval(clock, 1000);
</script>
<!--Tutorials-->
<div id="tutoBox">

</div>
<script>
var curTuto = "<?php echo $_SESSION['tuto'];?>";
var tutoBox = document.getElementById('tutoBox');
var tutoFrame = document.getElementById('tutoFrame');
function getTuto(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(parseInt(this.responseText) <= 9){
				tutoFrame.style.display = "block";
				tutoBox.style.display = "block";
				switch(this.responseText){
					case '0':
					var html = '';
					html += '<h3><?php echo $lang["tuto_0_title"];?></h3>';
					html += '<p><?php echo $lang["tuto_0_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_0_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '1':
					var html = '';
					html += '<p><?php echo $lang["tuto_1_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_1_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '2':
					var html = '';
					html += '<p><?php echo $lang["tuto_2_txt1"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '3':
					var html = '';
					html += '<p><?php echo $lang["tuto_3_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_3_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '4':
					var html = '';
					html += '<p><?php echo $lang["tuto_4_txt1"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '5':
					var html = '';
					html += '<p><?php echo $lang["tuto_5_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_5_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '6':
					var html = '';
					html += '<p><?php echo $lang["tuto_6_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_6_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '7':
					var html = '';
					html += '<p><?php echo $lang["tuto_7_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_7_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '8':
					var html = '';
					html += '<p><?php echo $lang["tuto_8_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_8_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
					case '9':
					var html = '';
					html += '<p><?php echo $lang["tuto_9_txt1"];?></p>';
					html += '<p><?php echo $lang["tuto_9_txt2"];?></p>';
					html += '<center><button onclick="nextTuto(1)" class="tutoButton"><?php echo $lang["tuto_button_1"];?></button><center>';
					html += '<center><button onclick="nextTuto(2)" class="tutoButton"><?php echo $lang["tuto_button_2"];?></button><center>';
					tutoBox.innerHTML = html;
					break;
				}
			}
		}
	};
	xhttp.open("GET", "<?php echo $general['path'];?>/modules/tutorial.php?id=<?php echo $uid;?>", true);
	xhttp.send();
}
function nextTuto(foo){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			window.location.reload();
		}
	};
	if(foo == 1){
		xhttp.open("GET", "<?php echo $general['path'];?>/modules/tutorial.php?func=next&id=<?php echo $uid;?>", true);
	}else{
		xhttp.open("GET", "<?php echo $general['path'];?>/modules/tutorial.php?func=done&id=<?php echo $uid;?>", true);
	}
	xhttp.send();
}
getTuto();
if(curTuto == "4"){
	var hover = document.querySelectorAll("#tuto3hover");
	var i;
	for(i = 0; i < hover.length; i++){
		hover[i].style.display = "block";
	}
}



</script>

<!--tutorials end-->

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
				<!--<li><p onclick="loadPage('chatroom');"><span></span><?php //echo $lang['menu_chatroom'];?></p></li>-->
				<li><a href="https://discord.com/invite/ZENSZBzcC6" target="_blank"><p><span></span><?php echo $lang['menu_chatroom'];?></p></a></li>
			</ul>
		</div>	

		<ul class="lang">
			<li class="beta"><?php echo $lang['lang_beta'];?></li>
			<li><a href="?lang=en" title="<?php echo $lang['lang_en'];?>"><img src="images/lang/en.png"></a></li>	
			<li><a href="?lang=pt-br" title="<?php echo $lang['lang_pt-br'];?>"><img src="images/lang/pt-br.png"></a></li>	
		</ul>
		
	</div>

<?php endif; ?>

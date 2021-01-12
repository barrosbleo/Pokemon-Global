<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="Pokemon online rpg,Pokemon rpg,Pokemon Game,Pokemon online game,Pokemon MMORPG,Pokemon online">
<meta name="description" content="Welcome to Pokemon planet Online RPG, where you can journey to capture all of the Pokemon in the region." />
<title>Pokemon Planet RPG</title>
<link href="http://fonts.googleapis.com/css?family=Dancing+Script|Oswald" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<Style>
div.header{background-color:#003b57;
width:50%;color:#fff;text-align:center;}
</style>
</head>
<body>
<div id="wrapper">
<div id="menu-wrapper">
<div id="menu">
<?php if (isset($_SESSION['userid'])) : ?>
<ul id='navigation'>
<li><a href="membersarea.php">Home</a></li>
<li><a href="map.php">Maps</a>
<ul>
<li><a href="map.php?id=1">Grass Throne</a></li>
                                                <li><a href="map.php?map=2">Water Throne</a></li>
                                                <li><a href="map.php?map=3">Rock Throne</a></li>
<li><a href="map.php?map=4">Ice Throne</a></li>
<li><a href="map.php?map=5">Ghost Throne</a></li>
                                                
</ul>
</li>

<li><a href="gyms.php">Battles</a>
<ul>
<li><a href="gyms.php">Battle Gyms</a></li>
<li><a href="fix.php">Battle Training</a></li>

</ul>
</li>
<li><a href="trade.php">Trade Center</a>
<ul>
<li><a href="trade.php">Trade Pokemon</a></li>


</ul>
</li>
  <li><a href="shop.php">Shops</a>
<ul>
<li><a href="shop.php">PokeMart</a></li>
                                                <li><a href="buy_pokemon.php">Buy Pokemon <img src="images/limited.gif"></a></li>
                                                                                                <li><a href="sell_pokemon.php">Global Buy/Sell</a></li>
                                                <li><a href="promo.php">Promo Store</a></li>

</ul>
</li>
  <li><a href="5050.php">Mini-games</a>
<ul>
<li><a href="5050.php">50/50 Game</a></li>
<li><a href="slots.php">Slots</a></li>    
<li><a href="roll_dice.php">Roll Dice</a></li>                                            
                                                                                         
</ul>
</li>
<li><a href="send_money.php">Money</a>
<ul>
<li><a href="send_money.php">Send Money</a></li>
</ul>
</li>
<li><a href="stats.php">Rankings</a>
<ul>
<li><a href="stats.php">All Ranks</a></li>
                                                <li><a href="top_trainers.php">Top Trainers</a></li>
                                                
                                                


</ul>
</li>
                                    

          <li><a href="profile.php">Your Account</a>
<ul>
                                                
       <li><a href="edit_profile.php">Edit Profile</a></li>
                                                <li><a href="list_pm.php">Messages</a></li>
                                                <li><a href="view_box.php">View Your Box</a></li>
                                                <li><a href="team.php">My Team</a></li>
                                                <li><a href="pokedex.php">Pokedex</a></li>
<li><a href="refl.php">Referal</a></li>
                                                <li><a href="logout.php">Logout</a></li>


</ul>
</li>
 <li><a href="#">Community</a>
<ul>
<li><a href="staff.php">Staff List</a></li>
       <li><a href="/forums" target="_blank">Forums</a></li>
                                                <li><a href="users.php">Members</a></li>
                                                <li><a href="online.php">Online members</a></li>
                                                <li><a href="http://pkmnplanet.net/rpg/chatroom.php" target="_blank">Chatroom</a></li>
                                                <li><a href="http://www.facebook.com/pkmnplanet">Facebook</a></li>

</ul>
</li>
<li><a href="rules.php">Rules</a></li>
<li><a href="donate.php">Donate</a></li>
       

       
      
       


</ul>
<?php else: ?>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="connexion.php">Login</a></li>
<li><a href="sign_up.php">Register</a></li>
<li><a href="legalinfo.php">Legal Info</a></li>
<li><a href="faq.php">FAQ</a></li>
<li><a href="staff.php">Staff</a></li>
<li><a href="chatroom.php">Chatroom</a></li>

</ul>
<?php endif; ?>
</div>
</div>
<div id="logo" class="container">
<h1><a href="#"><img src="images/Pokemon/
<?php echo(rand(100,392))?>.png"/>
  Pokemon Planet RPG</a></h1>
<p>A rpg filled with wonders!</p>
</div>
<div id="page" class="container">
<div id="content">
<div class="post">
<h2 class="title"><a href="#">Pokemon Planet RPG</a></h2>
<div class="entry">
<p><center>
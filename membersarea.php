<?php
include('modules/lib.php');
require_once 'bbcode.php';

if (!isLoggedIn()) {
	redirect('index.php');
}

include '_header.php';
printHeader($lang['membersarea_title']);


$info = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '$uid'"));
$ck = $info['username'];
logs($uid, "$ck has accessed membersarea!");



$champUid = getConfigValue('champion_uid');

$query = mysql_query("SELECT * FROM `users` WHERE `id`='{$champUid}'");
$champRow = mysql_fetch_assoc($query);

// stop xss
$champRow = cleanHtml($champRow);

$avatar = $champRow['avatar'];

if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
	$avatar = 'http://localhost/rpg/'.$avatar;
	
	if (!filter_var($avatar, FILTER_VALIDATE_URL) || empty($champRow['avatar'])) {
		$avatar = 'http://localhost/rpg/images/trainers/032.png';
	}
}

$promoName = getConfigValue('promo_pokemon_name');
?>
<script>//!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


<div style="text-align: center;">
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
-->

<html>
<head>
<!-- 1. Place this in your head tag or anywhere in your body tag where script tags can process -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
</head>
<body>
<!-- 2. Add this to page body where you wish it to render -->
<g:plusone size="standard" count="true" href="http://localhost/index.php"></g:plusone>
</body>
</html>


<!--<div class="fb-like" data-href="https://www.facebook.com/duskrpg" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial"></div>-->
</div>
<?php
echo '
    <table style="margin: 10px auto;" class="pretty-table ">
		<tr>
            <th style="width: 100px;">'.$lang['membersarea_currentpromo'].'</th>
			<th>'.$lang['membersarea_champion'].'</th>
		</tr>
		<tr>
            <td style="width: 200px;">
                <a href="promo.php">
                    <img src="images/pokemon/'.$promoName.'.png" alt="'.$promoName.'" /><br />
                    '.$promoName.'
                </a>
            </td>
			<td style="text-align: center;">
				'.$lang['membersarea_beat_champion'].'!<br /><br />
				
				<a href="profile.php?id='.$champRow['id'].'">
					<img src="'.$avatar.'"><br />
					'.$champRow['username'].'
				</a><br /><br />
				
				<a href="battle_user.php?id='.$champRow['id'].'">
					'.$lang['membersarea_chal_champion'].'
				</a>
			</td>
		</tr>
	</table>
';
$queryNews = mysql_query("SELECT * FROM news ORDER BY `id` DESC LIMIT 5");
while($fetch = mysql_fetch_array($queryNews)){

	
echo '
	<table class="pretty-table news">
		<tr>
			<th>'.$fetch['title'].'</th>
		</tr>
		<tr>
			<td>
				<center>'.nl2br($fetch['news']).'</center>
			</td>
		</tr>
		<tr>
			<th>
				<center><b>By : '.$fetch['bywho'].' [<span style="color: #FFFF00;">Admin</span>]</b></center>
			</th>
		</tr>
	</table>
';
}
?>
			
<?php

include '_footer.php';
?>
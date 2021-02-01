<?php
if (!defined('GOT_CONFIG')) {
    die();
}

if(isset($uid)) :


?>

<br /><br />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<center><?php echo $lang['footer_cr'];?><a href="#" title="<?php echo $lang['footer_cr_title'];?>" alt="<?php echo $lang['footer_cr_alt'];?>"><?php echo $lang['footer_cr_a'];?></a><?php echo $lang['footer_cr_finalTXT'];?>

<div class="social">
<g:plusone size="standard" count="true" href="index.php"></g:plusone>
<!--<div class="fb-like" data-href="https://www.facebook.com/duskrpg" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial"></div>-->
</div>

<div class="count">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<br />
<?php
$query = "SELECT `id` FROM users ORDER BY `id` DESC LIMIT 1";
if($query){
	$lastId = fetchAssoc($query, $conn);
	echo "Total Members: " . number_format($lastId['id']) . "";
}
?>
</div>
</div>
</div>	
</body>
</html>
<?php
else :
?>
<br>
<div id="footer" align="center">
	<p class="info"><?php echo $lang['footer_legal_read'];?><?php echo $lang['footer_cr_title'];?> | <a href="legalinfo.php" title="<?php echo $lang['footer_legal_read'];?>"><?php echo $lang['footer_legal'];?></a></p>
</div>
<br>


<?php
endif;
if($conn){
	mysqli_close($conn);
}
?>
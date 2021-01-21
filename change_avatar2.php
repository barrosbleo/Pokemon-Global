<?php
include('modules/lib.php');
        
if (!isLoggedin()) {
    redirect('login.php');
}

$uid = (int) $_SESSION['userid'];
        
include "_header.php";
printHeader($lang['change_ava2_title']);

if(isset($_POST['pic'])) {
	$avatar = cleanSql('http://localhost/'.$_POST['pic'], $conn);
	$conn->query("UPDATE `users` SET `avatar`='{$avatar}' WHERE `id`='{$uid}'");
	echo '<div class="notice">'.$lang['change_ava2_00'].'</div>';
}
$query = "SELECT `avatar` FROM `users`WHERE `id`='{$uid}'";
$avatar = fetchAssoc($query, $conn);
$avatar = $avatar['avatar'];

echo '
	<form action="" method="post">
		<div style="height: 250px; width: 98%; width: calc(100% - 20px); overflow-y: scroll; overflow-x: none; margin: 0 auto;">
';
$images = glob('images/trainers/*.png');
foreach ($images as $image) {
	$attr = 'http://localhost/'.$image == $avatar ? ' checked="checked" ' : '' ;
	echo '
		<div style="height: 120px; width: 100px; float: left;">
			<img src="'.$image.'" /><br />
			<input type="radio" name="pic" value="'.$image.'" '.$attr.' />
		</div>
	';
}
echo '
		</div>
		<br />
		<input type="submit" value="'.$lang['change_ava2_01'].'" />
	</form>
';


include "_footer.php";
?>
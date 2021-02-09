<?php
include('modules/lib.php');
require 'banned.php'; 

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['edit_profile_00']);

echo '
    <div style="text-align: center; padding: 10px 0;">
        <a href="change_avatar.php">'.$lang['edit_profile_01'].'</a>
    </div>
';

$message = '';
$uid = (int) $_SESSION['userid'];

if (isset($_POST['cpassword'], $_POST['npassword'], $_POST['napassword'], $_POST['email'], $_POST['sprite'], $_POST['signature'])) {
	$password     = $_POST['cpassword'];
	$passwordNew  = $_POST['npassword'];
	$passwordNew2 = $_POST['napassword'];
	$email        = $_POST['email'];
	
	$sprite       = $_POST['sprite'];
	$signature    = $_POST['signature'];
	$errors = array();
	
	$query = "SELECT `password` FROM `users` WHERE `id`='{$uid}'";
	$passwordRow = fetchAssoc($query, $conn);
	
	if ($passwordRow['password'] != sha1($password)) {
		$errors[] = $lang['edit_profile_02'];
	}
	
	if (!empty($passwordNew) && $passwordNew != $passwordNew2) {
		$errors[] = $lang['edit_profile_03'];
	} else if (!empty($passwordNew) && strlen($passwordNew) < 6) {
		$errors[] = $lang['edit_profile_04'];
	}
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = $lang['edit_profile_05'];
	}
	
	if(!in_array($sprite, range(1, 10))) {
		$sprite = 1;
	}
	
	if (count($errors) > 0) {
		$message = '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
	} else {
	
		if (!empty($passwordNew)) {
			$newPasswordSql = !empty($passwordNew) ? " `password`='".sha1($passwordNew)."', " : '' ;
		}
		
		$sqlEmail  = cleanSql($email, $conn);
		$sqlSig    = cleanSql($signature, $conn);
		$sprite    = (int) $sprite;
		
		
		$query = $conn->query("UPDATE `users` SET {$newPasswordSql} `email`='{$sqlEmail}', `map_sprite`='{$sprite}', `signature`='{$sqlSig}' WHERE `id`='{$uid}'");
		
		if ($query) {
			$message = '<div class="notice">'.$lang['edit_profile_06'].'</div>';
		} else {
			$message = '<div class="error">'.$lang['edit_profile_07'].'</div>';
		}
	}
}











$query = "SELECT * FROM `users` WHERE `id`='{$uid}'";
$userRow = cleanHtml(fetchAssoc($query, $conn));

$cells = array();
for ($i=1; $i<=3; $i++) {//change this to add or remove sprites
	$attr = $userRow['map_sprite'] == $i ? ' checked="checked" ' : '' ;
	$cells[] = '
	<label>
		<img src="images/sprites/'.$i.'.png" /><br />
		<input type="radio" name="sprite" value="'.$i.'" '.$attr.' />
	</label>
	';
}

echo '
	'.$message.'
	<form action="" method="post">
		<table class="pretty-table">
			<tr>
				<th class="text-right">'.$lang['edit_profile_08'].' <span class="small">('.$lang['edit_profile_09'].')</span>: </th>
			</tr>
			<tr>
				<td><input type="password" name="cpassword" value="" size="30" /></td>
			</tr>
			
			<tr>
				<th class="text-right">'.$lang['edit_profile_10'].' <span class="small">('.$lang['edit_profile_11'].')</span>: </th>
			</tr>
			<tr>
				<td><input type="password" name="npassword" value="" size="30" /></td>
			</tr>
			
			<tr>
				<th class="text-right">'.$lang['edit_profile_12'].': </th>
			</tr>
			<tr>
				<td><input type="password" name="napassword" value="" size="30" /></td>
			</tr>
			
			<tr>
				<th class="text-right">Email ('.$lang['edit_profile_09'].'): </th>
			</tr>
			<tr>
				<td><input type="text" name="email" value="'.$userRow['email'].'" size="30" /></td>
			</tr>
			
			<tr>
				<th class="text-right" valign="top">'.$lang['edit_profile_13'].'</th>
			</tr>
			<tr>
				<td><center>
					<table class="inline-block">
						'.cellsToRows($cells, 5).'
					</table>
					</center>
				</td>
			</tr>
			
						<tr>
				<th colspan="2" class="text-center">'.$lang['edit_profile_14'].'</th>
			</tr>
			
			<tr>
				<td colspan="2" class="text-center">
					<textarea name="signature" cols="50" rows="5">'.$userRow['signature'].'</textarea>
				</td> 
			</tr>
		
			
			<tr>
				<th colspan="2" class="text-center">
					<center><input id="button" type="submit" class="button" value="     '.$lang['edit_profile_15'].'     " /></center>
				</th>
			</tr>
		
		</table>
    </form>
';
include '_footer.php';
?>

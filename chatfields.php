<?php
include('modules/lib.php');


if(isset($_POST['sendmsg'])){
	if($_POST['message'] == ""){$error = 1; $msg = $lang['chatfields_title'];}
	//if(){$error = 1; $msg = "";}
	//if(){$error = 1; $msg = "";}
	//if(){$error = 1; $msg = "";}
	if($error == 1){
		//echo"error";
	}else{
		$msg = $conn->real_escape_string(htmlspecialchars($_POST['message']));
		$query = "SELECT * FROM users WHERE id='".$uid."'";
		$user = fetchAssoc($query, $conn);
		$sql = "INSERT INTO chat (username, message, map) VALUES ('".$user['username']."', '".$msg."', '".$user['map_num']."')";
		$conn->query($sql);
	}
}


?>

<form method="post" action="">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <textarea name="message" cols="44" rows="1" id="message" maxlength="80" class="txtfield"></textarea>
    </td>
	</tr>
	<tr>
    <td><input type="submit" name="sendmsg" id="sendmsg" value="Enviar" class="sendbuttom"/></td>
  </tr>
</table>
</form>

<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

$user1 = "SELECT * FROM `users` WHERE `id`='".$_SESSION['userid']."' ";
$user = fetchObj($user1, $conn);

if($user->admin != 1){die("You are not authorized here!");}


include '_header.php';
echoHeader('Staff Panel');

$filename = 'admin_messages_nkjdngksndfgermekmrz.txt';
if (isset($_POST['message'])) {
    $fh = fopen($filename, 'w');
    fwrite($fh, $_POST['message']);
    fclose($fh);
    echo '<div class="notice">Message has been saved.</div>';
}

echo '
	<div class="center-text">
		Admin List: '.getAdminProfileList().'<br /><br />

        <form method="post">
            <textarea name="message" cols="50" rows="10">'.file_get_contents($filename).'</textarea><br /><br />
            <input type="submit" value="Save" />
        </form>
	</div>
';

include '_footer.php';
?>
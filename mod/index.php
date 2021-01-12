<?php
include('../modules/lib.php');
require_once 'mod_functions.php';

if (!isMod()) {
    die('Only mods can access this page.');
}

include '_header.php';
echoHeader('Mod Panel');

$filename = 'mod_messages_fsdfadfasdfa.txt';
if (isset($_POST['message'])) {
    $fh = fopen($filename, 'w');
    fwrite($fh, $_POST['message']);
    fclose($fh);
    echo '<div class="notice">Message has been saved.</div>';
}

echo '
	<div class="center-text">
		Mod List: '.getModProfileList().'<br /><br />

        <form method="post">
            <textarea name="message" cols="50" rows="10">'.file_get_contents($filename).'</textarea><br /><br />
            <input type="submit" value="Save" />
        </form>
	</div>
';

include '_footer.php';
?>
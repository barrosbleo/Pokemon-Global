<?php
include('modules/lib.php');

if (isLoggedIn()) { redirect('membersarea.php'); }

//if(!mershandising){redirect to main}
redirect('main.php');
?>

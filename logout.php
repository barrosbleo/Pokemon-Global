<?php
include('modules/lib.php');

$_SESSION = array();
session_regenerate_id(true);
//session_destroy();
$_SESSION['logout'] = '<p class="success">'.$lang['logout_00'].'</p>';

redirect('main.php');
?>
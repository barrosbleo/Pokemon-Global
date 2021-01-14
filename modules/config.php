<?php
@session_save_path("tmp");			//path to store sessions cookies
@session_start();					//start sessions
error_reporting(0);					//0 = hide all errors / 1 = display errors level 1 / E_ALL = show all errors

//general configs
$maintenance = 0;					//sets the game to the maintenance mode(block players access)

//MySQLi section
$database['host'] = "localhost";	//mysql driver host address
$database['user'] = "root";			//mysql user
$database['pass'] = "12345678";		//mysql password
$database['database'] = "pokebr";	//database name
?>

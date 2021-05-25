<?php

//general configs
$general['path'] = "http://localhost";	//default root game path
$general['deflang'] = "pt-br";				//default game language
$maintenance = 0;						//sets the game to the maintenance mode(block players access)

//MySQLi section
$database['host'] = "localhost";		//mysql driver host address
$database['user'] = "root";				//mysql user
$database['pass'] = "12345678";			//mysql password
$database['database'] = "pokebr";		//database name


//in game configs
date_default_timezone_set("America/Sao_Paulo");		//game default timezone
define('DEFAULT_STARTER_LEVEL', 15);				//starter pokemon level at account creation
define('DEFAULT_STARTER_COLUMNS', 3);				//number of columns on register page
define('DEFAULT_USER_MONEY', 20000);				//user money prize when register
define('BATTLE_MONEY_MULTIPLIER', 4);				//battle money drop multip. Default: 2
$pokemonNames = array(								//starter pokemon names
	'Bulbasaur',
	'Charmander',
	'Squirtle',
	'Chikorita',
	'Cyndaquil',
	'Totodile',
	'Treecko',
	'Torchic',
	'Mudkip',
	'Turtwig',
	'Chimchar',
	'Piplup',
	'Snivy',
	'Tepig',
	'Oshawott'
//	'Chespin',
//	'Fennekin',
//	'Froakie'
//	'Rowlet',
//	'Litten',
//	'Popplio',
//	'Grookey',
//	'Scorbunny',
//	'Sobble'
);
?>

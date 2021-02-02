<?php

//general configs
$general['path'] = "https://pkmglobal.online";
$maintenance = 0;					//sets the game to the maintenance mode(block players access)

//MySQLi section
$database['host'] = "localhost";			//mysql driver host address
$database['user'] = "u108578361_pkmglobal";		//mysql user
$database['pass'] = "843762Inter";			//mysql password
$database['database'] = "u108578361_pkmglobal";		//database name


//in game configs
date_default_timezone_set("America/Sao_Paulo");
define('DEFAULT_STARTER_LEVEL', 15);	//starter pokemon level at account creation
define('DEFAULT_STARTER_COLUMNS', 3);	//number of columns on register page
define('DEFAULT_USER_MONEY', 20000);	//user money prize when register
$pokemonNames = array(					//names of starter pokemons
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
);
?>

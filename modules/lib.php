<?php
//define('GOT_CONFIG', true);
//arquivo comum
//carrega-lo em todos os arquivos que necessitarem suas bibliotecas
//carregar neste arquivo os plugins necessários
//atentar que alguns dependem de outros, então existe ordem de importação

//php config modules
include('errorhandler.php');
include('phpconf.php');

//general config module
include('config.php');

//mysql modules
include('conn.php');
include('numrows.php');
include('fetchassoc.php');
include('fetcharray.php');
include('fetchobject.php');
include('doquery.php');
include('cleansql.php');
include('logFunc.php');

//general modules and functionalities
include('general.php');
include('game.php');
include('player.php');
include('pokemon.php');
include('logs.php');
include('security.php');
include('language.php');

?>
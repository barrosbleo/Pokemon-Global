<?php
//define('GOT_CONFIG', true);
//arquivo comum
//carrega-lo em todos os arquivos que necessitarem as bibliotecas
//carregar neste arquivo os plugins necessários
//atentar que alguns dependem de outros, então existe ordem de importação
include('config.php');
include('conn.php');
include('general.php');
include('player.php');
include('game.php');
include('pokemon.php');
include('logs.php');
include('security.php');
include('language.php');
include('numrows.php');
include('fetchassoc.php');


?>

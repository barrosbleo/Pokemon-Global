<?php

//define('GOT_CONFIG', true);
//arquivo comum
//carrega-lo em todos os arquivos que necessitarem as bibliotecas
//carregar neste arquivo os plugins necessários
//atentar que alguns dependem de outros, então existe ordem de importação
include('config.php');
include('modules/conn.php');
include('modules/general.php');
include('modules/player.php');
include('modules/game.php');
include('modules/pokemon.php');
include('modules/logs.php');
include('modules/security.php');
include('modules/language.php');


?>
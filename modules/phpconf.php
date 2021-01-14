<?php

if(!is_dir('tmp')){
	mkdir('tmp');
}

session_save_path('tmp');
session_start();



?>
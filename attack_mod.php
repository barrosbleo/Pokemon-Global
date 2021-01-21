<?php
$attackMod = array(
	'Normal' => array(
		'Rock'  => 0.5,
		'Ghost' => 0,
		'Steel' => 0.5
	),
	'Fire' => array(
		'Fire'   => 0.5,
		'Water'  => 0.5,
		'Grass'  => 2,
		'Ice'    => 2,
		'Bug'    => 2,
		'Rock'   => 0.5,
		'Dragon' => 0.5,
		'Steel'  => 2
	),
	'Water' => array(
		'Fire'   => 2,
		'Water'  => 0.5,
		'Grass'  => 0.5,
		'Ground' => 2,
		'Rock'   => 2,
		'Dragon' => 0.5
	),
	'Electric' => array(
		'Water'    => 2,
		'Electric' => 0.5,
		'Grass'    => 0.5,
		'Ground'   => 0,
		'Flying'   => 2,
		'Dragon'   => 0.5
	),
	'Grass' => array(
		'Fire'   => 0.5,
		'Water'  => 2,
		'Grass'  => 0.5,
		'Poison' => 0.5,
		'Ground' => 2,
		'Flying' => 0.5,
		'Bug'    => 0.5,
		'Rock'   => 2,
		'Dragon' => 0.5,
		'Steel'  => 0.5
	),
	'Ice' => array(
		'Fire'   => 0.5,
		'Water'  => 0.5,
		'Grass'  => 2,
		'Ice'    => 0.5,
		'Ground' => 2,
		'Flying' => 2,
		'Dragon' => 2,
		'Steel'  => 0.5
	),
	'Fighting' => array(
		'Normal'  => 2,
		'Ice'     => 2,
		'Poison'  => 0.5,
		'Flying'  => 0.5,
		'Psychic' => 0.5,
		'Bug'     => 0.5,
		'Rock'    => 2,
		'Ghost'   => 0,
		'Dark'    => 2,
		'Steel'   => 2
	),
	'Poison' => array(
		'Grass'  => 2,
		'Poison' => 0.5,
		'Ground' => 0.5,
		'Rock'   => 0.5,
		'Ghost'  => 0.5,
		'Steel'  => 0
	),
	'Ground' => array(
		'Fire'     => 2,
		'Electric' => 2,
		'Grass'    => 0.5,
		'Poison'   => 2,
		'Flying'   => 0,
		'Bug'      => 0.5,
		'Rock'     => 2,
		'Steel'    => 2
	),
	'Flying' => array(
		'Electric' => 0.5,
		'Grass'    => 2,
		'Fighting' => 2,
		'Bug'      => 2,
		'Rock'     => 0.5,
		'Steel'    => 0.5
	),
	'Psychic' => array(
		'Fighting' => 2,
		'Poison'   => 2,
		'Psychic'  => 0.5,
		'Dark'     => 0,
		'Steel'    => 0.5
	),
	'Bug' => array(
		'Fire'     => 0.5,
		'Grass'    => 2,
		'Fighting' => 0.5,
		'Poison'   => 0.5,
		'Flying'   => 0.5,
		'Psychic'  => 2,
		'Ghost'    => 0.5,
		'Dark'     => 2,
		'Steel'    => 0.5
	),
	'Rock' => array(
		'Fire'     => 2,
		'Ice'      => 2,
		'Fighting' => 0.5,
		'Ground'   => 0.5,
		'Flying'   => 2,
		'Bug'      => 2,
		'Steel'    => 0.5
	),
	'Ghost' => array(
		'Normal'  => 0,
		'Psychic' => 2,
		'Ghost'   => 2,
		'Dark'    => 0.5,
		'Steel'   => 0.5
	),
	'Dragon' => array(
		'Dragon' => 2,
		'Steel'  => 0.5
	),
	'Dark' => array(
		'Fighting' => 0.5,
		'Psychic'  => 2,
		'Ghost'    => 2,
		'Dark'     => 0.5,
		'Steel'    => 0.5
	),
	'Steel' => array(
		'Fire'     => 0.5,
		'Water'    => 0.5,
		'Electric' => 0.5,
		'Ice'      => 2,
		'Rock'     => 2,
		'Steel'    => 0.5
	)
);
?> 

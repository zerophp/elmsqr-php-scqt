<?php


$alumno = array (
		'name' => 'Agustin',
		'lastname' => 'Calderon',
		'email' => 'agustincl@gmail.com',
		'bDate'	=>	12/12/1990,
		FALSE,
		123,
		0 => "mas datos",
		"8" => "y este",
		5.6 => "jajaja",
		11 => "asdas",
		6 => "otro dato",
		"el ultimo dato",
		array("rojo", "verde", "naranja")		
);


echo "<pre>";
print_r($alumno);
echo "</pre>";

ksort($alumno);
echo "<pre>";
print_r($alumno);
echo "</pre>";



echo "<hr/>";

include_once 'functions.php';

muestraArray($alumno);





<?php
echo "<pre>Post:";
print_r($_POST);
echo "</pre>";

echo "<pre>Files:";
print_r($_FILES);
echo "</pre>";

include_once 'functions.php';
muestraArray($_POST);

// Mover la imagen a uploads
$usuariosFile="usuarios.txt";
$filename=$_FILES['photo']['tmp_name'];
$uploadDirectory="/uploads";
$name=$_FILES['photo']['name'];
$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;
$destination=$path."/".$name;

$name=uploadImage();

echo "<img src=\"/uploads/".$name."\" width=100px />";

$data=cambiarArray($_POST);
$data=implode('|', $data);
$data.="|".$name;
$data.="\r";

file_put_contents($usuariosFile, $data, FILE_APPEND);

















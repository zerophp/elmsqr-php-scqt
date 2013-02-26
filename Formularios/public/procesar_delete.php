<?php
echo "<pre>Post:";
print_r($_POST);
echo "</pre>";

echo "<pre>Files:";
print_r($_FILES);
echo "</pre>";

// Configuracion
$userFilename="usuarios.txt";
include_once 'functions.php';


if($_POST['submit']=='No')
{
	header('Location: /usuarios.php');
	exit();
}


// Leer datos del archivo de usuarios
$datos=file_get_contents($userFilename);

// Convertir en un array datos
$datos=explode("\r",$datos);

// Leer datos del usuario id
$usuario=$datos[$_POST['id']];

// Convertir en array
$usuario=explode("|",$usuario);

// Borrar imagen
$uploadDirectory="/uploads";
$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;
// Borrar la imagen anterior
unlink($path."/".$usuario[11]);

// Borrar el usuario
unset($datos[$_POST['id']]);

// Convertir a string
$datos=implode("\r",$datos);

// Guardar en el archivo usuarios
file_put_contents($userFilename, $datos);

// Redireccion a select
header('Location: /usuarios.php');
exit();












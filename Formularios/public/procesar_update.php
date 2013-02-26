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

// Leer datos del archivo de usuarios
$datos=file_get_contents($userFilename);

// Convertir en un array datos
$datos=explode("\r",$datos);

// Leer datos del usuario id
$usuario=$datos[$_POST['id']];

// Convertir en array
$usuario=explode("|",$usuario);

// convertir los datos del update en string
$arr=cambiarArray($_POST);
$datosUpdate=implode("|",$arr);

if(isset($_FILES['photo']['tmp_name'])&&
		 $_FILES['photo']['tmp_name']!='')
{
	// Si imagen nueva agregar la imagen
	$usuariosFile="usuarios.txt";
	$filename=$_FILES['photo']['tmp_name'];
	$uploadDirectory="/uploads";
	$name=$_FILES['photo']['name'];
	$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;
	$destination=$path."/".$name;
	$name=uploadImage();
	// Borrar la imagen anterior
	unlink($path."/".$usuario[11]);
}
else 
{
	// Si no imagen nueva, usar la anterior
	$name=$usuario[11];	
}
// Componer el string
$datosUpdate.="|".$name;

// Sobreescri la linea del usuario id
$datos[$_POST['id']]=$datosUpdate;

// Convertir a string
$datos=implode("\r",$datos);

// Guardar en el archivo usuarios
file_put_contents($userFilename, $datos);

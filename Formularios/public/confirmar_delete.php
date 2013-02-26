
<?php
echo "<pre>Post:";
print_r($_POST);
echo "</pre>";

echo "<pre>Get:";
print_r($_GET);
echo "</pre>";

//Config
$userFilename="usuarios.txt";

// Leer datos del archivo de usuarios
$datos=file_get_contents($userFilename);

// Convertir los datos en array
$datos=explode("\r", $datos);


if(isset($_GET['id']))
{
	// Leer datos del usuario id
	$usuario=$datos[$_GET['id']];

	// Convertir datos usuario en array
	$usuario=explode('|', $usuario);
	
	echo "<pre>";
	print_r($usuario);
	echo "</pre>";
}

// Rellenar el formulario

?>

<form action="<?=(isset($_GET['id']))?'procesar_delete.php':'procesar.php';?>" method="POST" 
enctype="multipart/form-data">
<ul>
<li>Id <input type="hidden" name="id" value="<?=(isset($_GET['id']))?$_GET['id']:''?>" /></li>
<li>SEGURO QUE DESEA BORRAR EL USUARIO: <?=$usuario[1];?></li>
<li>Submit <input type="submit" name="submit" value="Si" /></li>
<li>Submit <input type="submit" name="submit" value="No" /></li>


</ul>
</form>

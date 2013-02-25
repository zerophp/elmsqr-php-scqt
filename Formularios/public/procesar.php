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

$filename=$_FILES['photo']['tmp_name'];
$uploadDirectory="/uploads";
$name=$_FILES['photo']['name'];
$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;
$destination=$path."/".$name;

// Verificar si existe en el directorio de uploads
if(file_exists($destination))
{		//Si existe		
	// Renombrar
		// Mientras que exista el fichero
		$a=0;
		$path_info = pathinfo($destination);
		while(file_exists($destination))
		{
			$a++;
			// Generar uno nuevo y volver a verificar			
			$name = $path_info['filename']."-".$a.
					".".
					$path_info['extension'];
			$destination=$path."/".$name;
		}
		// Subir el fichero con el nombre nuevo
		move_uploaded_file($filename, $path."/".$name);
}
else	//No existe
{
	// Subir el archivo
	move_uploaded_file($filename, $destination);
}
echo "<img src=\"/uploads/".$name."\" width=100px />";
	















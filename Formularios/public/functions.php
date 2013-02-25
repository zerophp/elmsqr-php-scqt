<?php


/**
 *	Show array values
 * 	
 * @param array $array
 * @return boolean
 */

function muestraArray($array)
{
	foreach ($array as $key => $value)
	{
		echo $key.": ";
		if(is_array($value))
			echo implode(',', $value);
		else
			echo $value;
		echo "<br/>";
	}
	return TRUE;
}

/**
 *	Return array pipe separated
 *
 * @param array $array
 * @return boolean
 */

function cambiarArray($array)
{
	$array2=array();
	foreach ($array as $key => $value)
	{	
		if(is_array($value))
			$array2[]=implode(',', $value);
		else
			$array2[]=$value;		
	}
	return $array2;
}


/**
 * Upload and rename image
 * 
 * @return string final filename
 */
function uploadImage()
{
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
	return $name;
}

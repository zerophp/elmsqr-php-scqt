<?php

/**
 * Read Users from file, and return into array
 * 
 * @param string $filename
 * @return array $arrayUsers
 */
function readUsers($filename)
{
	$content=file_get_contents($filename);
	$files=explode("\r", $content);	
	foreach($files as $key => $file){
		$arrayUsers[]=explode("|",$file);
	}	
	return $arrayUsers;
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
 * Upload photo to directory
 * @param string $uploadDirectory
 * @return string $name final filename
 */
function uploadPhoto($uploadDirectory)
{
	$filename=$_FILES['photo']['tmp_name'];
	$uploadDirectory="/uploads";
	$name=$_FILES['photo']['name'];
	$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;
	$destination=$path."/".$name;
		
	$name=uploadImage();
	
	return $name;	
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

/**
 * Update user image
 * @param string $lastImage 
 * @param string $uploadDirectory
 * @return string $name
 */
function updateImage($lastImage, $uploadDirectory)
{
	if(isset($_FILES['photo']['tmp_name'])&&
	$_FILES['photo']['tmp_name']!='')
	{
		// Si imagen nueva agregar la imagen		
		$filename=$_FILES['photo']['tmp_name'];
		$name=$_FILES['photo']['name'];
		$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;
		$destination=$path."/".$name;
		$name=uploadImage();
		// Borrar la imagen anterior
		unlink($path."/".$lastImage);
	}
	else
	{
		// Si no imagen nueva, usar la anterior
		$name=$lastImage;
	}	
	return $name;
}

function deleteImage($users,$uploadDirectory)
{
	$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;	
	unlink($path."/".$users[$_POST['id']][11]);
	return;
}

/**
 * Insert user into file
 * @param array $arrayUser users data
 * @param string $usuariosFile filename
 */
function insertUser($arrayUser,$usuariosFile)
{
	$data=cambiarArray($arrayUser);
	$data=implode('|', $data);
	$data.="\r";
	file_put_contents($usuariosFile, $data, FILE_APPEND);
	
	return;
		
}

/**
 * update users file
 * @param string $users
 * @param string $userFilename
 */
function updateUser($users,$userFilename)
{
	foreach ($users as $key => $value)
	{
		$pipes[]=implode("|",$value);
	}
	// Convertir a string
	$datos=implode("\r",$pipes);
	// Guardar en el archivo usuarios
	file_put_contents($userFilename, $datos);
	return;
}


function deleteUser($users,$userFilename)
{
	foreach ($users as $key => $value)
	{
		$pipes[]=implode("|",$value);
	}
	$datos=implode("\r",$pipes);
	// Guardar en el archivo usuarios
	file_put_contents($userFilename, $datos);
	return;
}


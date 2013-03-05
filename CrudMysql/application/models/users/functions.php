<?php

/**
 * Read Users from MySQL
 * 
 * @param string $filename
 * @return array $arrayUsers
 */
function readUsers($config)
{
	// Conectarse al Servidor
	$link=mysqli_connect($config['db.server'], $config['db.user'], 
						$config['db.password'],$config['db.database']);	
	// Leer Usuarios
	$query = "SELECT * FROM users";
	$result = mysqli_query($link, $query);	
	// Retornar Usuarios como array
	while ($row = mysqli_fetch_assoc($result))
	{
		$users[]=$row;
	}
	return $users;
}



function readUser($id)
{

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
function insertUser($config,$arrayUser,$usuariosFile)
{
	
// 	echo "<pre>";
// 	print_r($arrayUser);
// 	echo "</pre>";
// 	die;
	$arrayUser['pets']=implode(',',$arrayUser['pets']);
	$id=save($config, 'users', $arrayUser);
	
	return $id;

		
}

/**
 * update users file
 * @param string $users
 * @param string $userFilename
 */
function updateUser($users,$userFilename)
{
	
}


function deleteUser($users,$userFilename)
{
	
}


function initUser()
{
	$usuario=array(
			'name'=>'',
			'email'=>'',
			'password'=>'',
			'description'=>'',
			'address'=>'',
			'city'=>array(),
			'pets'=>array(),
			'sports'=>array(),
			'sex'=>array(),
			'photo'=>''
	);
	return $usuario;
}


function save($config, $table, $arrayAssoc, $where=NULL)
{
// 	echo "<pre>";
// 		print_r($arrayAssoc);
// 		echo "</pre>";
// 		die;
	
	$link=mysqli_connect($config['db.server'], $config['db.user'],
			$config['db.password'],$config['db.database']);
	
	$tableColumns="DESCRIBE ".$table;
	$result=mysqli_query($link, $tableColumns);
	while($row=mysqli_fetch_assoc($result))
	{
		$columnst[]=$row['Field'];
	}
	
	foreach($arrayAssoc as $key => $values)
	{
		if(in_array($key,$columnst))
			$columns[]=$key."='".$values."'";
	}
	
	if($where==NULL)
	{
		$query="INSERT INTO ".$table." SET ";
		$query.=implode(',',$columns);
		mysqli_query($link, $query);
		$id=mysqli_insert_id($link);
	}
	else
	{
		$query="UPDATE ".$table." SET ";
		$query.=implode(',',$columns);
		$query.=" WHERE ".$where;
		mysqli_query($link, $query);
		$id=TRUE;
		
	}
		

// 	echo "<pre>";
// 	print_r($query);
// 	echo "</pre>";
	
	
	return $id;
	
}







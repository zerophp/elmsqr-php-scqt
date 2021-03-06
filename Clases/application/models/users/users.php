<?php


class models_users_users
{
	/**
	 * Read Users from MySQL
	 * 
	 * @param string $filename
	 * @return array $arrayUsers
	 */
	static public function readUsers($config)
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
			$users[$row['iduser']]=$row;
			
			$query = "SELECT * FROM users_has_sports WHERE users_iduser=".$row['iduser'];
			
			$result2 = mysqli_query($link, $query);
			$sports=array();
			// Retornar Usuarios como array
			while ($rowSports = mysqli_fetch_assoc($result2))
			{
				$sports[]=$rowSports['sports_idsport'];
			}
			$users[$row['iduser']]['sports']=implode(',',$sports);
			
			
		}
		return $users;
	}
	
	
	
	static public function readUser($config, $id)
	{
		// Conectarse al Servidor
		$link=mysqli_connect($config['db.server'], $config['db.user'],
				$config['db.password'],$config['db.database']);
		// Leer Usuarios
		$query = "SELECT * FROM users WHERE iduser=".$id;
		$result = mysqli_query($link, $query);
		// Retornar Usuarios como array
		while ($row = mysqli_fetch_assoc($result))
		{
			$users[]=$row;
		
			$query = "SELECT * FROM users_has_sports WHERE users_iduser=".$row['iduser'];
		
			$result2 = mysqli_query($link, $query);
			$sports=array();
			// Retornar Usuarios como array
			while ($rowSports = mysqli_fetch_assoc($result2))
			{
				$sports[]=$rowSports['sports_idsport'];
			}
			$users[0]['sports']=implode(',',$sports);
		}
		
		return $users[0];
	}
	
	
	
	
	
	/**
	 * Upload photo to directory
	 * @param string $uploadDirectory
	 * @return string $name final filename
	 */
	static public function uploadPhoto($config)
	{
		$uploadDirectory=$config['uploadDirectory'];
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
	static public function uploadImage()
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
	static public function updateImage($lastImage, $config)
	{
		$uploadDirectory=$config['uploadDirectory'];
		
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
	
	static public function deleteImage($users,$config)
	{
		$uploadDirectory=$config['uploadDirectory'];
		$path=$_SERVER['DOCUMENT_ROOT'].$uploadDirectory;	
		unlink($path."/".$users['photo']);
		return;
	}
	
	/**
	 * Insert user into file
	 * @param array $arrayUser users data
	 * @param string $usuariosFile filename
	 */
	static public function insertUser($config,$arrayUser)
	{
		
		$link=mysqli_connect($config['db.server'], $config['db.user'],
				$config['db.password'],$config['db.database']);
		
		$id=save($config, 'users', $arrayUser);
		
		foreach($arrayUser['sport'] as $key => $value)
		{		
			$query="INSERT INTO users_has_sports SET 
						users_iduser=".$id.",
						sports_idsport=".$value;
			mysqli_query($link, $query);		
		}
		return $id;
	
			
	}
	
	/**
	 * update users file
	 * @param string $users
	 * @param string $userFilename
	 */
	static public function updateUser($config, $id, $arrayUser)
	{
		$link=mysqli_connect($config['db.server'], $config['db.user'],
				$config['db.password'],$config['db.database']);
		
		$id=save($config, 'users', $arrayUser, 'iduser='.$id);
		
		$query="DELETE FROM users_has_sports WHERE users_iduser=".$id;
		mysqli_query($link, $query);
		
		
		
		foreach($arrayUser['sport'] as $key => $value)
		{
			$query="INSERT INTO users_has_sports SET
						users_iduser=".$id.",
						sports_idsport=".$value;
			mysqli_query($link, $query);
		}
		
		return $id;
		
		
	}
	
	
	static public function deleteUser($config, $id)
	{
		$link=mysqli_connect($config['db.server'], $config['db.user'],
				$config['db.password'],$config['db.database']);
		
		$query="DELETE FROM users_has_sports WHERE users_iduser=".$id;
		mysqli_query($link, $query);
		
		$query="DELETE FROM users WHERE iduser=".$id;
		mysqli_query($link, $query);
			
		return;
	}
	
	
	static public function initUser()
	{
		$usuario=array(
				'name'=>'',
				'email'=>'',
				'password'=>'',
				'description'=>'',
				'address'=>'',
				'cities_idcity'=>array(),
				'pets'=>array(),
				'sports'=>array(),
				'genders_idgender'=>array(),
				'photo'=>''
		);
		return $usuario;
	}
	
	
	static public function save($config, $table, $arrayAssoc, $where=NULL)
	{
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
			{
				if(is_array($values))
					$columns[]=$key."='".implode(',',$values)."'";
				else
					$columns[]=$key."='".$values."'";
			}
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
		return $id;
		
	}

}





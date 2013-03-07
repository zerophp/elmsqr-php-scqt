<?php

function loginUser($config,$data)
{
	// Conectarse al Servidor
	$link=mysqli_connect($config['db.server'], $config['db.user'],
			$config['db.password'],$config['db.database']);
	// Leer Usuarios
	$query = "SELECT * FROM users WHERE 
							email='".$data['email']."' 
						AND password='".$data['password']."'";
	$result = mysqli_query($link, $query);
	
	if(mysqli_num_rows($result)===1)
	{
		$row = mysqli_fetch_assoc($result);
		$_SESSION['iduser']=$row['iduser'];
		return TRUE;		
	}
	
	return FALSE;
	
}
<?php
/**
 * Users Controller 
 * @version 1.0
 */


// Include files
include_once('../application/models/users/functions.php');




switch ($route['action'])
{
	case 'delete':	
		if($_POST)
		{
			$users=readUser($config,$_POST['id']);
			unlink($users['photo']);
			deleteImage($users,$config);			
			deleteUser($config, $_POST['id']);
			header('Location: /users.php');
			exit();
		}
		else
		{
			$usuario=readUser($config,$_GET['id']);
			$viewVars=array('usuario'=>$usuario);
			$content=renderView($config, 'users/delete.php', $viewVars);
		}
	break;	
	case 'insert':
		if($_POST)
		{
			$name=uploadPhoto($config);
			$_POST['photo']=$name;
			insertUser($config, $_POST);				
			header('Location: /users.php');
			exit();
		}
		else
		{
			$usuario=initUser();
			$viewVars=array('usuario'=>$usuario);
			$content=renderView($config, 'forms/users.php', $viewVars);
		}
	break;	
	case 'update':	
		if($_POST)
		{			
			$usuario=readUser($config,$_POST['id']);
			$name=updateImage($usuario['photo'], $config);
			$_POST['photo']=$name;			
			updateUser($config, $_POST['id'], $_POST);
			header('Location: /users.php');
			exit();				
		}
		else 
		{	
			$usuario=readUser($config,$_GET['id']);
			debug($usuario);
			//$sports=explode(',',$usuario['sports']);
			//$pets=explode(',',$usuario['pets']);
			$viewVars=array('usuario'=>$usuario);
			$content=renderView($config, 'forms/users.php', $viewVars);
			
		}
	break;	
	case 'select';
		$title = "Tabla de usuarios :: Select";
		$arrayUsers=readUsers($config);
		$viewVars=array('arrayUsers'=>$arrayUsers,
						 'title'=>$title
					);
		$content=renderView($config, 'users/select.php', $viewVars);
				
	break;	
	default:
		echo "Esto default";
	break;
}


$layoutVars=array('content'=>$content,
				  'title'=>$title
);
$layout=renderLayout($config, 'layout.php', $layoutVars);


echo $layout;





<?php
/**
 * Users Controller 
 * @version 1.0
 */

// Read config
$config = parse_ini_file("../application/configs/config.ini", true);

//$config = readConfig($config, 'development');

$config = $config['production'];

$userFilename=$config['filename'];
$uploadDirectory=$config['uploadDirectory'];

// Include helpers
include_once('../application/views/helpers/viewHelpers.php');
include_once('../application/controllers/helpers/actionHelpers.php');

// Include files
include_once('../application/models/users/functions.php');

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';

switch ($action)
{
	case 'delete':	
		if($_POST)
		{
			$users=readUser($config,$_POST['id']);
			unlink($users['photo']);
			deleteImage($users,$uploadDirectory);			
			deleteUser($config, $_POST['id']);
			header('Location: /users.php');
			exit();
		}
		else
		{
			$usuario=readUser($config,$_GET['id']);
			include_once('../application/views/users/delete.php');
		}
	break;	
	case 'insert':
		if($_POST)
		{
			$name=uploadPhoto($uploadDirectory);
			$_POST['photo']=$name;
			insertUser($config, $_POST,$userFilename);				
			header('Location: /users.php');
			exit();
		}
		else
		{
			$usuario=initUser();
			include_once('../application/views/forms/users.php');
		}
	break;	
	case 'update':	
		if($_POST)
		{			
			$usuario=readUser($config,$_POST['id']);
			$name=updateImage($usuario['photo'], $uploadDirectory);
			$_POST['photo']=$name;			
			updateUser($config, $_POST['id'], $_POST);
			header('Location: /users.php');
			exit();				
		}
		else 
		{	
			$usuario=readUser($config,$_GET['id']);
			debug($usuario);
			$sports=explode(',',$usuario['sports']);
			$pets=explode(',',$usuario['pets']);
			include_once('../application/views/forms/users.php');
		}
	break;	
	case 'select';
		$arrayUsers=readUsers($config);
		include_once '../application/views/users/select.php';		
	break;	
	default:
		echo "Esto default";
	break;
}
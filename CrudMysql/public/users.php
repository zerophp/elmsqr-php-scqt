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

// Include view helpers
include_once('../application/views/helpers/viewHelpers.php');

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
			$users=readUsers($userFilename);
			unlink($users[$_POST['id']][11]);
			deleteImage($users,$uploadDirectory);			
			deleteUser($users,$userFilename);
			header('Location: /users.php');
			exit();
		}
		else
		{
			$users=readUsers($userFilename);
			$usuario=$users[$_GET['id']];			
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
			$users=readUsers($userFilename);
			$usuario=$users[$_POST['id']];
			$name=updateImage($usuario[11], $uploadDirectory);
			$_POST[]=$name;			
			$users[$_POST['id']]=cambiarArray($_POST);
			updateUser($users,$userFilename);
			header('Location: /users.php');
			exit();				
		}
		else 
		{	
			$users=readUsers($userFilename);
			$usuario=$users[$_GET['id']];
			$sports=explode(',',$users[$_GET['id']][7]);
			$pets=explode(',',$users[$_GET['id']][8]);
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
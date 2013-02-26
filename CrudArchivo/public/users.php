<?php
/**
 * Users Controller
 * 
 * @version 1.0
 */

// Read config

$config = parse_ini_file("../application/configs/config.ini", true);
$filename=$config['production']['filename'];
include_once('../application/models/users/functions.php');



if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';

switch ($action)
{
	case 'delete':
		echo "Esto delete";
	break;
	
	case 'insert':
		echo "Esto insert";
	break;
	
	case 'update':
		echo "Esto update";
	break;
	
	case 'select';
		$arrayUsers=readUsers($filename);
		include_once '../application/views/users/select.php';
		echo "Esto select";
	break;
	
	default:
		echo "Esto default";
	break;
}






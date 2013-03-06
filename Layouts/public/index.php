<?php

define ("NO_CONTROLLER", 'nocontroller');
define ("NO_ACTION", 'noaction');

// Read config
$config = parse_ini_file("../application/configs/config.ini", true);

//$config = readConfig($config, 'development');

$config = $config['production'];

// Include helpers
include_once('../application/router.php');
include_once('../application/views/helpers/viewHelpers.php');
include_once('../application/controllers/helpers/actionHelpers.php');
include_once('../application/controllers/helpers/frontHelpers.php');




$route=router($config);

// debug($route);

switch ($route['controller'])
{
	case 'users':
		include('../application/controllers/users.php');
	break;
	
	
	case 'error':
		echo "error";
		die;
		include('../application/controllers/errors.php');
	break;
	
	default:
	case 'index':
	break;
}
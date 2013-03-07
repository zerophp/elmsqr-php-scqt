<?php
/**
 * Index Controller
* @version 1.0
*/


// Include files
include_once('../application/models/users/functions.php');

switch ($route['action'])
{
	case 'index':
		$content=renderView($config, 'index/index.php', $viewVars);
	break;
	
}

$layoutVars=array('content'=>$content,
		'title'=>$title
);
$layout=renderLayout($config, 'frontend.php', $layoutVars);


echo $layout;
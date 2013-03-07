<?php
/**
 * Author Controller
* @version 1.0
*/


// Include files
include_once('../application/models/author/functions.php');

switch ($route['action'])
{
	case 'login':
		if($_POST)
		{
			if(loginUser($config,$_POST))
			{			
				header('Location: /users/select');
				exit();
			}
		}
		$content=renderView($config, 'author/login.php', $viewVars);
	break;
	
	case 'logout':
		unset($_SESSION['iduser']);
		header('Location: /index/index');
		exit();
	break;
}

$layoutVars=array('content'=>$content,
		'title'=>$title
);
$layout=renderLayout($config, 'login.php', $layoutVars);
echo $layout;
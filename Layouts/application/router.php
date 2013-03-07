<?php


function router($config)
{
	$parse=explode('/',$_SERVER['REQUEST_URI']);
	foreach($parse as $key => $value)
	{
		if($key==0)
			continue;
		elseif($key==1)
			$route['controller']=$parse[1];
		elseif ($key==2) 
			$route['action']=$parse[2];
		else
		{
			if(!($key%2)==0)
				@$route['vars'][$value]=$parse[$key+1];			
		}	
	}
	
	if(file_exists($config['controllers']."/".$route['controller'].".php"))
	{
		// Read actions from controlller	
		$actions['users']=array('insert','update','delete','select','index');			
		$actions['index']=array('index');
		$actions['author']=array('login','logout');
		
		if(in_array($route['action'],$actions[$route['controller']] ))
			return $route;
		else
		{
			$route['controller']='error';
			$route['action']=NO_ACTION;
		}
			
	}
	else
	{
		// No controller
		$route['controller']='error';
		$route['action']=NO_CONTROLLER;
	}
	
	return $route;
}





function acl($config, $route)
{
	$permissions=array($_SESSION['iduser']=>array(
							'index'.".".'index',
							'users'.".".'select',
							'users'.".".'insert',
							'users'.".".'update',
							'users'.".".'delete',
							'author'.".".'logout',
				));	
	if(isset($_SESSION['iduser']))
	{					
		if(in_array($route['controller'].".".$route['action'],
				$permissions[$_SESSION['iduser']]
		))
		{
			return $route;
		}
	}
	$route['controller']='author';
	$route['action']='login';
	
	return $route;
}












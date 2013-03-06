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
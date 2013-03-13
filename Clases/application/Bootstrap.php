<?php

class Bootstrap
{
	private $config;
	private $route;
	
	public function __construct($config)
	{
		$this->config=$config;
		$this->initSession();
		$this->initRegister();
		$this->initRouter();
		$this->route = $this->initAcl();
	}
	
	protected function initSession()
	{
		session_start();
		return;
	}

	protected function initRegister()
	{
		
		$_SESSION['register']['config']=$this->config;
	}
	
	protected function initRouter()
	{
// 		$this->route=router($this->config);

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
				
		if(file_exists($this->config['controllers']."/".$route['controller']."Controller.php"))
		{
			// Read actions from controlller
			$actions['users']=array('insert','update','delete','select','index');
			$actions['index']=array('index');
			$actions['author']=array('login','logout');
		
			if(in_array($route['action'],$actions[$route['controller']] ))
				$this->route=$route;
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
		
		$this->route=$route;		
	}
	
	protected function initAcl()
	{
		$roles = array('superadmin','admin','user','guest');
		$defaultRol = 'guest';
		$currentRol = 'guest';
		
		$permissions=array('guest'=>array(
				'index'.".".'index',
				'author'.".".'login',
				'author'.".".'logout',
					),
				'admin'=>array(
						'index'.".".'index',
						'users'.".".'select',
						'users'.".".'insert',
						'users'.".".'update',
						'users'.".".'delete',
						'author'.".".'login',
						'author'.".".'logout',
				)				
		);
		
		if(isset($_SESSION['iduser']))
		{
			if(in_array($this->route['controller'].".".$this->route['action'],
					$permissions[$currentRol]
			))
			{
				return $this->route;
			}
		}
		elseif($currentRol=='guest')
		{
			if(in_array($this->route['controller'].".".$this->route['action'],
					$permissions[$currentRol]
			))
			{
				return $this->route;
			}			
		}
		else
		{ 
			$this->route['controller']='index';
			$this->route['action']='index';		
		}
		
		
		
		return $this->route;

	}
	/**
	 * @return the $route
	 */
	public function getRoute() {
		return $this->route;
	}

	
	
	
}

/*
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

*/

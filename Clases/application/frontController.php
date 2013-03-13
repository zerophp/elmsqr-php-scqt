<?php

class frontController
{
	
	private $route;
	
	function __construct($route)
	{
		$this->route = $route->getRoute();
		
		$controller = 'controllers_'.$this->route['controller']."Controller";
		$action = $this->route['action'].'Action';
		$instance = new $controller;
		$instance->$action();	
	}
	
	
}
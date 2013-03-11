<?php

class frontController
{
	
	private $route;
	
	function __construct($route)
	{
		
		
		$this->route = $route->getRoute();
		
		include ('../application/controllers/'.$this->route['controller'].".php");
	}
	
	
}
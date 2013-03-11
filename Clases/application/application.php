<?php


class Application
{
	private $config;
	private $route;
	
	public function __construct($config)
	{
		$config = parse_ini_file($config, true);
		//$config = readConfig($config, 'development');		
		$this->config = $config['production'];
	}
	
	public function Bootstrap()
	{
		$this->route = new Bootstrap($this->config);
		return $this;
		
	}
	
	public function frontController()
	{
		
		new frontController($this->route);
	}
}
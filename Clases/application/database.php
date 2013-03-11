<?php

class database
{
	
	private $instance;
	
	private function __construct()
	{
		
	}
	
	
	static public function newInstance()
	{
		if(isset($this->instance))
			return $this->instance;
		else
		{
			$this->instance = new database();
			return $this->instance;
		}
	}
	
}
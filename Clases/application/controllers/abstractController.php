<?php

abstract class controllers_abstractController
implements controllers_renderViewInterface
{
	
	abstract public function indexAction();
	abstract public function errorAction();
	
	public function renderView($viewVars, $view)
	{
				
		$html='';
		ob_start();
		include_once($_SESSION['register']['config']['path.views']."/".$view);
		$html=ob_get_flush();
		ob_end_clean();
		
		return $html;
	}
}
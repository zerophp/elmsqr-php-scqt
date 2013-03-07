<?php


function renderView($config, $view, $viewVars=NULL)
{
	
	$html='';
	ob_start();
		include_once($config['path.views']."/".$view);
		$html=ob_get_flush();
	ob_end_clean();
	
	return $html;
}


function renderLayout($config, $layout=NULL, $layoutVars=NULL)
{
	if(!isset($layout))
		$layout=$config['default.layout'];
	
	$html='';
	ob_start();
		include_once($config['path.layouts']."/".$layout);
		$html=ob_get_contents();
	ob_end_clean();
	return $html;
}
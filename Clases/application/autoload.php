<?php


function __autoload($var)
{
	$name = str_replace('_', '/', $var);
	include_once ('../application/'.$name.".php");
	return;
}
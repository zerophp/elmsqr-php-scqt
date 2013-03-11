<?php


define ('APPLICATION_ENV', getenv('APPLICATION_ENV'));
if(!defined('APPLICATION_ENV'))
	define ('APPLICATION_ENV', 'production');

require_once ('../application/autoload.php');

$config='../application/configs/config.ini';

define ("NO_CONTROLLER", 'nocontroller');
define ("NO_ACTION", 'noaction');

$application = new Application($config);
$application->Bootstrap()
			->frontController();

// $bootstrap = new Bootstrap();
// $fontController = new frontController($bootstrap);


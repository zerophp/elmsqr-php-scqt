<?php


class controllers_usersController 
	extends controllers_abstractController
	
{
	public function selectAction()
	{
		$title = "Tabla de usuarios :: Select";
		$arrayUsers=models_users_users::readUsers($_SESSION['register']['config']);
		$viewVars=array('arrayUsers'=>$arrayUsers,
						 'title'=>$title
					);
		echo $this->renderView($viewVars, 'users/select.php');
	}
	
	public function indexAction()
	{
		
	}
	
	public function errorAction()
	{
		
	}
	
	
}



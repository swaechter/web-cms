<?php

/**
 * The class AdminController is responsible for the admin interface.
 */
class AdminController extends Controller implements ModuleController
{
	/**
	 * Show the login site.
	 */
	public function index()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$this->getView()->setData("SUCCESS", "You are already logged in.");
		}
	}
	
	/**
	 * Perform the login step.
	 */
	public function login()
	{
		$adminmodel = new AdminModel($this);
		if(!$adminmodel->isUserLoggedIn())
		{
			if(Utils::hasPostEmail("email") && Utils::hasPostString("password"))
			{
				if($adminmodel->loginUser(Utils::getPost("email"), Utils::getPost("password")))
				{
					$this->getView()->setData("SUCCESS", "You were successfully logged in.");
				}
				else
				{
					$this->getView()->setData("ERROR", "Your user account was not found.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please fill in all form fields.");
			}
		}
		else
		{
			$this->getView()->setData("SUCCESS", "You are already logged in.");
		}
	}
	
	/**
	 * Perform the logout step.
	 */
	public function logout()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$adminmodel->logoutUser();
			$this->getView()->setData("SUCCESS", "You were successfully logged out.");
		}
		else
		{
			$this->getView()->setData("ERROR", "You are not logged in.");
		}
	}
	
	/**
	 * Show the admin admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$controllermodel = new ControllerModel($this);
			$this->getView()->setData("SYSTEMCONTROLLERITEMS", $controllermodel->getSystemControllerItems());
			$this->getView()->setData("MODULECONTROLLERITEMS", $controllermodel->getModuleControllerItems());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

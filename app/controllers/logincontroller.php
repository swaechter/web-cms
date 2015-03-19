<?php

/**
 * The class LoginController is responsible for the authentication handling.
 */
class LoginController extends Controller
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
			if(Utils::hasPost("email") && Utils::hasPost("password"))
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
}

?>

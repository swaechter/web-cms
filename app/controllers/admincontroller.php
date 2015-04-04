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
					$this->getView()->setData("SUCCESS", "Sie wurden erfolgreich angemeldet.");
				}
				else
				{
					$this->getView()->setData("ERROR", "Ihr Benutzer konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie den Benutzernamen und das Passwort an.");
			}
		}
		else
		{
			$this->getView()->setData("SUCCESS", "Sie sind bereits angemeldet.");
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
			$this->getView()->setData("SUCCESS", "Sie wurden erfolgreich abgemeldet.");
		}
		else
		{
			$this->getView()->setData("ERROR", "Sie sind nicht angemeldet.");
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
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
}

?>

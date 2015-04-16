<?php

/**
 * The file admincontroller.php contains the admin controller which is
 * responsible for the login management.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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
		if(!$adminmodel->isUserLoggedIn())
		{
			if(!$adminmodel->hasLdapBackend())
			{
				$this->getView()->setData("USERNAMETITLE", "Email");
				$this->getView()->setData("USERNAMEDESCRIPTION", "Ihre Emailadresse");
				$this->getView()->setData("USERNAMETYPE", "email");
			}
			else
			{
				$this->getView()->setData("USERNAMETITLE", "Benutzername");
				$this->getView()->setData("USERNAMEDESCRIPTION", "Ihr Benutzername");
				$this->getView()->setData("USERNAMETYPE", "text");
			}
		}
		else
		{
			$this->getView()->setData("SUCCESS", "Sie sind bereits angemeldet.");
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
			if(Utils::hasPostString("username") && Utils::hasPostString("password"))
			{
				if($adminmodel->loginUser(Utils::getPost("username"), Utils::getPost("password")))
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

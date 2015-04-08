<?php

/**
 * The file usercontroller.php provides an user controller which is capable of
 * creating, editing and deleting users that have access to the CMS system.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class UserController is responsible for the user management.
 */
class UserController extends Controller implements SystemController
{
	/**
	 * Show the user admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$usermodel = new UserModel($this);
			$this->getView()->setData("USERS", $usermodel->getUsers());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Add a user.
	 */
	public function create()
	{
		$adminmodel = new AdminModel($this);
		if(!$adminmodel->isUserLoggedIn())
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the create action.
	 */
	public function processcreate()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasPostString("name") && Utils::hasPostEmail("email") && Utils::hasPostString("passworda") && Utils::hasPostString("passwordb"))
			{
				$usermodel = new UserModel($this);
				if(Utils::getPost("passworda") != Utils::getPost("passwordb"))
				{
					$this->getView()->setData("ERROR", "Die beiden Passwörter stimmen nicht überein.");
				}
				else if($usermodel->createUser(Utils::getPost("name"), Utils::getPost("email"), Utils::getPost("passworda")))
				{
					$this->getView()->setData("SUCCESS", "Der Benutzer wurde erfolgreich erstellt.");
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Benutzer konnte nicht erstelllt werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie die Emailadresse, den Benutzernamen und beide Passwörter an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Edit a user.
	 */
	public function edit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$usermodel = new UserModel($this);
				$user = $usermodel->getUser(Utils::getGet("id"));
				if($user)
				{
					$this->getView()->setData("USER", $user);
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Benutzer konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the edit action.
	 */
	public function processedit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id") && Utils::hasPostString("name") && Utils::hasPostEmail("email") && Utils::hasPostString("passworda") && Utils::hasPostString("passwordb"))
			{
				$usermodel = new UserModel($this);
				$user = $usermodel->getUser(Utils::getGet("id"));
				if($user)
				{
					$user->setName(Utils::getPost("name"));
					$user->setEmail(Utils::getPost("email"));
					$user->setPassword(hash("sha512", Utils::getPost("passworda")));
					if(Utils::getPost("passworda") != Utils::getPost("passwordb"))
					{
						$this->getView()->setData("ERROR", "Die beiden Passwörter stimmen nicht überein.");
					}
					else if($usermodel->updateUser($user))
					{
						$this->getView()->setData("SUCCESS", "Der Benutzer wurde erfolgreich bearbeitet.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Der Benutzer konnte nicht bearbeitet werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Benutzer konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie die ID, den Benutzernamen, die Emailadresse und beide Passwörter an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Remove a user.
	 */
	public function delete()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$this->getView()->setData("ID", Utils::getGet("id"));
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the delete action.
	 */
	public function processdelete()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$usermodel = new UserModel($this);
				$user = $usermodel->getUser(Utils::getGet("id"));
				if($user)
				{
					if(count($usermodel->getUsers()) == 1)
					{
						$this->getView()->setData("ERROR", "Sie können den letzten Benutzer nicht löschen.");
					}
					else if($usermodel->deleteUser($user))
					{
						$this->getView()->setData("SUCCESS", "Der Benutzer wurde erfolgreich gelöscht.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Der Benutzer konnte nicht gelöscht werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Benutzer konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
}

?>

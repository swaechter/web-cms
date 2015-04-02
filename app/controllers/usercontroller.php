<?php

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
			$this->getView()->setData('USERS', $usermodel->getUsers());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
					$this->getView()->setData("ERROR", "Both password do not match.");
				}
				else if($usermodel->createUser(Utils::getPost("name"), Utils::getPost("email"), Utils::getPost("passworda")))
				{
					$this->getView()->setData("SUCCESS", "The user was successfully created.");
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to create the user.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide an email address, username and both passwords.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			if($this->getDataContainer()->getRoute()->getIdValue())
			{
				$usermodel = new UserModel($this);
				$user = $usermodel->getUser($this->getDataContainer()->getRoute()->getIdValue());
				if($user)
				{
					$this->getView()->setData("ID", $user->getId());
					$this->getView()->setData("NAME", $user->getName());
					$this->getView()->setData("EMAIL", $user->getEmail());
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the user.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			if($this->getDataContainer()->getRoute()->getIdValue() && Utils::hasPostString("name") && Utils::hasPostEmail("email") && Utils::hasPostString("passworda") && Utils::hasPostString("passwordb"))
			{
				$usermodel = new UserModel($this);
				$user = $usermodel->getUser($this->getDataContainer()->getRoute()->getIdValue());
				if($user)
				{
					$user->setName(Utils::getPost("name"));
					$user->setEmail(Utils::getPost("email"));
					$user->setPassword(hash("sha512", Utils::getPost("passworda")));
					if(Utils::getPost("passworda") != Utils::getPost("passwordb"))
					{
						$this->getView()->setData("ERROR", "Both password do not match.");
					}
					else if($usermodel->updateUser($user))
					{
						$this->getView()->setData("SUCCESS", "The user was successfully updated.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to update the user.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the user.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID, name, email and both passwords.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			if($this->getDataContainer()->getRoute()->getIdValue())
			{
				$this->getView()->setData("ID", $this->getDataContainer()->getRoute()->getIdValue());
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			if($this->getDataContainer()->getRoute()->getIdValue())
			{
				$usermodel = new UserModel($this);
				$user = $usermodel->getUser($this->getDataContainer()->getRoute()->getIdValue());
				if($user)
				{
					if(count($usermodel->getUsers()) == 1)
					{
						$this->getView()->setData("ERROR", "You cannot delete the last user.");
					}
					else if($usermodel->deleteUser($user))
					{
						$this->getView()->setData("SUCCESS", "The user was successfully deleted.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to delete the user.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the user.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

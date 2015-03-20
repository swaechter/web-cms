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
			$this->getView()->setData("ERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

<?php

/**
 * The class AdminController is responsible for the admin interface.
 */
class AdminController extends Controller
{
	/**
	 * Start site of the admin interface.
	 */
	public function index()
	{
		$adminmodel = new AdminModel($this);
		if(!$adminmodel->isUserLoggedIn())
		{
			$this->getView()->setData("ERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

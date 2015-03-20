<?php

/**
 * The class AdminController is responsible for the admin interface.
 */
class AdminController extends Controller implements SystemController
{
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
			$this->getView()->setData("ERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

<?php

/**
 * The class MenuController is responsible for the menu management.
 */
class MenuController extends Controller
{
	/**
	 * Show the menus.
	 */
	public function index()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$menumodel = new MenuModel($this);
			$this->getView()->setData("MENUS", $menumodel->getMenus());
		}
		else
		{
			$this->getView()->setData("ERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

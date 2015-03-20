<?php

/**
 * The class MenuController is responsible for the menu management.
 */
class MenuController extends Controller implements SystemController
{
	/**
	 * Show the menu admin site.
	 */
	public function adminindex()
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

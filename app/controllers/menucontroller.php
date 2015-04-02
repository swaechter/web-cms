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
			$this->getView()->setData('MENUS', $menumodel->getMenus());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
	
	/**
	 * Add a menu.
	 */
	public function create()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$menumodel = new MenuModel($this);
			$this->getView()->setData('MENUS', $menumodel->getMenus());
		}
		else
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
			if(Utils::hasPossiblePostId('parentid') && Utils::hasPostString("displayname") && Utils::hasPossiblePostString("link"))
			{
				$menumodel = new MenuModel($this);
				if($menumodel->createMenu(Utils::getPost("parentid"), Utils::getPost("displayname"), Utils::getPost("link")))
				{
					$this->getView()->setData("SUCCESS", "The menu was successfully created.");
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to create the menu.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a displayable menu name and link.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
	
	/**
	 * Edit a menu.
	 */
	public function edit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if($this->getDataContainer()->getRoute()->getIdValue())
			{
				$menumodel = new MenuModel($this);
				$menu = $menumodel->getMenu($this->getDataContainer()->getRoute()->getIdValue());
				if($menu)
				{
					if($menu->getParentMenu())
					{
						$parentmenu = $menumodel->getMenu($menu->getParentMenu()->getId());
						if($parentmenu)
						{
							$this->getView()->setData("PARENTMENU", $parentmenu);
						}
					}
					$this->getView()->setData("MENUS", $menumodel->getMenus());
					$this->getView()->setData("ID", $menu->getId());
					$this->getView()->setData("DISPLAYNAME", $menu->getDisplayName());
					$this->getView()->setData("LINK", $menu->getLink());
					if($menu->getParentMenu())
					{
						$this->getView()->setData("PARENTID", $menu->getId());
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the menu.");
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
			if($this->getDataContainer()->getRoute()->getIdValue() && Utils::hasPossiblePostId("parentid") && Utils::hasPostString("displayname") && Utils::hasPossiblePostString("link"))
			{
				$menumodel = new MenuModel($this);
				$menu = $menumodel->getMenu($this->getDataContainer()->getRoute()->getIdValue());
				if($menu)
				{
					$parentmenu = null;
					$parentmenuid = Utils::getPost("parentid");
					if(is_numeric($parentmenuid) && $parentmenuid != 0)
					{
						$parentmenu = $menumodel->getMenu($parentmenuid);
					}
					$menu->setParentMenu($parentmenu);
					$menu->setDisplayName(Utils::getPost("displayname"));
					$menu->setLink(Utils::getPost("link"));
					if($menumodel->updateMenu($menu))
					{
						$this->getView()->setData("SUCCESS", "The menu was successfully updated.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to update the menu.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the menu.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID, display name and link.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
	
	/**
	 * Remove a menu.
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
				$menumodel = new MenuModel($this);
				$menu = $menumodel->getMenu($this->getDataContainer()->getRoute()->getIdValue());
				if($menu)
				{
					if($menumodel->deleteMenu($menu))
					{
						$this->getView()->setData("SUCCESS", "The menu was successfully deleted.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to delete the menu. Maybe do some other menus depend on this menu.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the menu.");
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

<?php

/**
 * The file menucontroller.php contains the menu controller which is
 * responsible for the menu management.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
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
			if(Utils::hasPossiblePostId('parentid') && Utils::hasPostString("displayname") && Utils::hasPossiblePostString("link"))
			{
				$menumodel = new MenuModel($this);
				if($menumodel->createMenu(Utils::getPost("parentid"), Utils::getPost("displayname"), Utils::getPost("link")))
				{
					$this->getView()->setData("SUCCESS", "Das Menü wurde erfogreich erstellt.");
				}
				else
				{
					$this->getView()->setData("ERROR", "Das Menü konnte nicht erstellt werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie einen gültigen Namen und einen Link an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
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
			if(Utils::hasGetId("id"))
			{
				$menumodel = new MenuModel($this);
				$menu = $menumodel->getMenu(Utils::getGet("id"));
				if($menu)
				{
					$parentmenu = null;
					if($menu->getParentMenu())
					{
						$parentmenu = $menumodel->getMenu($menu->getParentMenu()->getId());
					}
					
					if($parentmenu && $menu->getId() == $parentmenu->getId())
					{
						$this->getView()->setData("ERROR", "Ein Menü kann sich nicht selber untergeordnet sein.");
					}
					else
					{
						$this->getView()->setData("MENUS", $menumodel->getMenus());
						$this->getView()->setData("CHILDMENU", $menu);
						$this->getView()->setData("PARENTMENU", $parentmenu);
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Das Menü konnte nicht gefunden werden.");
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
			if(Utils::hasGetId("id") && Utils::hasPossiblePostId("parentid") && Utils::hasPostString("displayname") && Utils::hasPossiblePostString("link"))
			{
				$menumodel = new MenuModel($this);
				$menu = $menumodel->getMenu(Utils::getGet("id"));
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
						$this->getView()->setData("SUCCESS", "Das Menü wurde erfolreich gespeichert.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Das Menü konnte nicht gespeichert werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Das Menü konnte nicht gefunden werden.");
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
	 * Remove a menu.
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
				$menumodel = new MenuModel($this);
				$menu = $menumodel->getMenu(Utils::getGet("id"));
				if($menu)
				{
					if($menumodel->deleteMenu($menu))
					{
						$this->getView()->setData("SUCCESS", "Das Menü wurde erfolreich gelöscht.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Das Menü konnte nicht gelöscht werden. Eventuell wird es von anderen Menüs verwendet?");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Das Menu konnte nicht gefunden werden");
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

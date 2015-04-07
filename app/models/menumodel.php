<?php

/**
 * The file menumodel.php is responsible for the menu management like
 * creating, editing and deleting menu entries.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class MenuModel provides a menu system.
 */
class MenuModel extends Model
{
	/**
	 * Get all menus.
	 *
	 * @return array All menus
	 */
	public function getMenus()
	{
		return $this->getDatabaseManager()->getEntries("Menu");
	}
	
	/**
	 * Get a specific menu by the ID.
	 *
	 * @param integer $id ID of the menu
	 * @return Menu|null Menu object or null
	 */
	public function getMenu($id)
	{
		return $this->getDatabaseManager()->getEntryById("Menu", $id);
	}
	
	/**
	 * Create a new menu.
	 *
	 * @param Menu $parentid Parent menu
	 * @param string $displayname Display name
	 * @param string $link Link
	 * @return boolean Status of the action
	 */
	public function createMenu($parentid, $displayname, $link)
	{
		$parententry = $this->getDatabaseManager()->getEntryById("Menu", $parentid);
		if($parententry && $parententry->getParentMenu())
		{
			return false;
		}
		
		$entry = new Menu();
		$entry->setParentMenu($parententry);
		$entry->setDisplayName($displayname);
		$entry->setLink($link);
		
		return $this->getDatabaseManager()->saveEntry($entry);
	}
	
	/**
	 * Update a menu.
	 *
	 * @param Menu $menu Menu obtect
	 * @return boolean Status of the action
	 */
	public function updateMenu($menu)
	{
		return $this->getDatabaseManager()->saveEntry($menu);
	}
	
	/**
	 * Delete a menu.
	 *
	 * @param Menu $menu Menu obtect
	 * @return boolean Status of the action
	 */
	public function deleteMenu($menu)
	{
		return $this->getDatabaseManager()->deleteEntry($menu);
	}
}

?>

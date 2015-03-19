<?php

/**
 * The class MenuModel provides the possibility to manage menu entries.
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
}

?>

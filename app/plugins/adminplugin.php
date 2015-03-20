<?php

/**
 * The plugin Admin provides an admin interface and an authentication system.
 */
class AdminPlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 *
	 * @return string Plugin name
	 */
	public function getName()
	{
		return "admin";
	}
	
	/**
	 * Get the plugin display name.
	 *
	 * @return string Plugin display name
	 */
	public function getDisplayName()
	{
		return "Admin";
	}
	
	/**
	 * Get the plugin description.
	 *
	 * @return string Plugin description
	 */
	public function getDescription()
	{
		return "The plugin 'Admin' provides a admin interface and a authentication system.";
	}
	
	/**
	 * Get the plugin controller items.
	 *
	 * @return array Plugin controller items
	 */
	public function getItems()
	{
		return array(new Item("login", "Login"), new Item("admin", "Admin"), new Item("user", "Users"), new Item("menu", "Menus"), new Item("plugin", "Plugins"));
	}
}

?>

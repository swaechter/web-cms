<?php

/**
 * The plugin Resource provides a resource system which can manage all resources.
 */
class ResourcePlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 *
	 * @return string Plugin name
	 */
	public function getName()
	{
		return "resource";
	}
	
	/**
	 * Get the plugin display name.
	 *
	 * @return string Plugin display name
	 */
	public function getDisplayName()
	{
		return "Resource";
	}
	
	/**
	 * Get the plugin description.
	 *
	 * @return string Plugin description
	 */
	public function getDescription()
	{
		return "The plugin 'Resource' provides a resource management systen.";
	}
	
	/**
	 * Get the plugin controller items.
	 *
	 * @return array Plugin controller items
	 */
	public function getItems()
	{
		return array(new Item("resource", "Resource"));
	}
}

?>

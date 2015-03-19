<?php

/**
 * Test plugin.
 */
class BarPlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 */
	public function getName()
	{
		return "bar";
	}
	
	/**
	 * Get the plugin display name.
	 */
	public function getDisplayName()
	{
		return "Bar";
	}
	
	/**
	 * Get the plugin description.
	 */
	public function getDescription()
	{
		return "Bar is a test plugin.";
	}
}

?>

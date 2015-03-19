<?php

/**
 * Test plugin.
 */
class FooPlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 */
	public function getName()
	{
		return "foo";
	}
	
	/**
	 * Get the plugin display name.
	 */
	public function getDisplayName()
	{
		return "Foo";
	}
	
	/**
	 * Get the plugin description.
	 */
	public function getDescription()
	{
		return "Foo is a test plugin.";
	}
}

?>

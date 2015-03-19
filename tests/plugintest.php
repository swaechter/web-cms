<?php

/**
 * The class PluginTest is a test for the plugin manager
 */
class PluginTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test for the plugin manager.
	 */
	public function testPluginManager()
	{
		// Create the plugin manager and load the plugins
		$pluginmanager = new Pluginmanager("tests/plugintest/");
		
		// Create the plugin array
		$plugins = array();
		
		// Search for the plugins
		foreach(get_declared_classes() as $class)
		{
			if(in_array("Plugin", class_implements($class)))
			{
				$plugin[] = $class;
			}
		}
		
		// Create the plugins
		$fooplugin = new FooPlugin();
		$barplugin = new BarPlugin();
		
		// Check the numbers of plugin
		$this->assertEquals(count($plugin), 2);
		
		// Check the foo plugin
		$this->assertSame($fooplugin->getName(), "foo");
		$this->assertSame($fooplugin->getDisplayName(), "Foo");
		$this->assertSame($fooplugin->getDescription(), "Foo is a test plugin.");
		
		// Check the bar plugin
		$this->assertSame($barplugin->getName(), "bar");
		$this->assertSame($barplugin->getDisplayName(), "Bar");
		$this->assertSame($barplugin->getDescription(), "Bar is a test plugin.");
	}
}

?>

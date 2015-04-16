<?php

/**
 * The file pluginmanager.php provides a plugin manager that loads all
 * plugins in the app directory.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class PluginManager is responsible for the plugin loading.
 */
class PluginManager
{
	/**
	 * Constructor of the class PluginManager with the path.
	 * 
	 * @param string $pluginpath Path for all models, views and controllers
	 */
	public function __construct($pluginpath)
	{
		// Get all PHP files
		$directories = new RecursiveDirectoryIterator($pluginpath);
		$iterator = new RecursiveIteratorIterator($directories);
		$regex = new RegexIterator($iterator, "%\.php$%i");
		
		// Include them
		foreach($regex as $file)
		{
			include($file->getPathname());
		}
		
		// Check the dependencies
		foreach(get_declared_classes() as $classname)
		{
			if(is_subclass_of($classname, "Plugin"))
			{
				$plugin = new $classname();
				foreach($plugin->getDependencies() as $dependencypluginname)
				{
					$dependencyclassname = $dependencypluginname . PLUGIN_SUFFIX;
					if(!class_exists($dependencyclassname))
					{
						$pluginname = $plugin->getName();
						throw new Exception("The system was unable to find the plugin {$dependencypluginname} that is required by the plugin {$pluginname}.");
					}
					else if(!is_subclass_of($dependencyclassname, "Plugin"))
					{
						throw new Exception("The plugin dependency {$dependencyclassname} is not a real plugin");
					}
				}
			}
		}
	}
}

?>

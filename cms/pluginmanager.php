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
	}
}

?>

<?php

/**
 * The file pluginmodel.php is responsible for detecting all loaded
 * plugins.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class PluginModel provides all plugins.
 */
class PluginModel extends Model
{
	/**
	 * Get all plugins.
	 *
	 * @return array All plugins
	 */
	public function getPlugins()
	{
		$plugins = array();
		
		foreach(get_declared_classes() as $class)
		{
			if(in_array("Plugin", class_implements($class)))
			{
				$plugins[] = new $class();
			}
		}
		
		return $plugins;
	}
}

?>

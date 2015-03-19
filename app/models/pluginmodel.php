<?php

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
		// Create the plugin array
		$plugins = array();
		
		// Search for plugins
		foreach(get_declared_classes() as $class)
		{
			if(in_array("Plugin", class_implements($class)))
			{
				$plugins[] = new $class();
			}
		}
		
		// Return the plugins
		return $plugins;
	}
}

?>

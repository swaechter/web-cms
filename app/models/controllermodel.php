<?php

/**
 * The class ControllerModel is responsible for the system and module controller items.
 */
class ControllerModel extends Model
{
	/**
	 * Get all system controller items.
	 *
	 * @return array System controller items
	 */
	public function getSystemControllerItems()
	{
		// Create the item array
		$items = array();
		
		// Get all items of a plugin
		foreach(get_declared_classes() as $classname)
		{
			if(is_subclass_of($classname, "Plugin"))
			{
				$plugin = new $classname();
				$items = array_merge($items, $plugin->getItems());
			}
		}
		
		// Search for system controllers
		foreach($items as $key => $item)
		{
			$classname = $item->getName() . CONTROLLER_SUFFIX;
			if(!in_array("SystemController", class_implements($classname)))
			{
				unset($items[$key]);
			}
		}
		
		// Return the controller items
		return $items;
	}
	
	/**
	 * Get all module controller information.
	 *
	 * @return array Module controller information
	 */
	public function getModuleControllerItems()
	{
		// Create the item array
		$items = array();
		
		// Get all items of a plugin
		foreach(get_declared_classes() as $classname)
		{
			if(is_subclass_of($classname, "Plugin"))
			{
				$plugin = new $classname();
				$items = array_merge($items, $plugin->getItems());
			}
		}
		
		// Search for module controllers
		foreach($items as $key => $item)
		{
			$classname = $item->getName() . CONTROLLER_SUFFIX;
			if(!in_array("ModuleController", class_implements($classname)))
			{
				unset($items[$key]);
			}
		}
		
		// Return the controller items
		return $items;
	}
}

?>

<?php

/**
 * The file controllermodel.php is capable of detecting all system and
 * module controllers that are loaded.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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
		$items = array();
		
		foreach(get_declared_classes() as $classname)
		{
			if(is_subclass_of($classname, "Plugin"))
			{
				$plugin = new $classname();
				$items = array_merge($items, $plugin->getItems());
			}
		}
		
		foreach($items as $key => $item)
		{
			$classname = $item->getName() . CONTROLLER_SUFFIX;
			if(!in_array("SystemController", class_implements($classname)))
			{
				unset($items[$key]);
			}
		}
		
		return $items;
	}
	
	/**
	 * Get all module controller information.
	 *
	 * @return array Module controller information
	 */
	public function getModuleControllerItems()
	{
		$items = array();
		
		foreach(get_declared_classes() as $classname)
		{
			if(is_subclass_of($classname, "Plugin"))
			{
				$plugin = new $classname();
				$items = array_merge($items, $plugin->getItems());
			}
		}
		
		foreach($items as $key => $item)
		{
			$classname = $item->getName() . CONTROLLER_SUFFIX;
			if(!in_array("ModuleController", class_implements($classname)))
			{
				unset($items[$key]);
			}
		}
		
		return $items;
	}
}

?>

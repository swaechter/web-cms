<?php

/**
 * The file datacontainer.php contains all information about the user input
 * like the user URI.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class DataContainer contains all information that are needed by the system.
 */
class DataContainer
{
	/**
	 * The route.
	 *
	 * @var Route
	 */
	private $route;
	
	/**
	 * The menus.
	 *
	 * @var array
	 */
	private $menus;
	
	/**
	 * Constructor of the class DataContainer all information.
	 * 
	 * @param Route $route Route
	 * @param array $menus All menus
	 */
	public function __construct($route, $menus)
	{
		$this->route = $route;
		$this->menus = $menus;
	}
	
	/**
	 * Get the route.
	 * 
	 * @return Route Route
	 */
	public function getRoute()
	{
		return $this->route;
	}
	
	/**
	 * Get all menus.
	 *
	 * @return array All menus
	 */
	public function getMenus()
	{
		return $this->menus;
	}
}

?>

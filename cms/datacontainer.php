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
	 * The configuration.
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class DataContainer all information.
	 * 
	 * @param Route $route Route
	 * @param array $menus All menus
	 * @param Configuration $configuration Configuration
	 */
	public function __construct($route, $menus, $configuration)
	{
		$this->route = $route;
		$this->menus = $menus;
		$this->configuration = $configuration;
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
	
	/**
	 * Get the configuration.
	 *
	 * @return Configuration Configuration
	 */
	public function getConfiguration()
	{
		return $this->configuration;
	}
}

?>

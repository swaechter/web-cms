<?php

/**
 * The file provides a route that contains all data that are generated
 * from the user input which was passed to the controller.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class Route contains all information about the controller and the
 * action.
 */
class Route
{
	/**
	 * The controller name.
	 *
	 * @var string
	 */
	private $controllername;
	
	/**
	 * The controller class name.
	 *
	 * @var string
	 */
	private $controllerclassname;
	
	/**
	 * The action name.
	 *
	 * @var string
	 */
	private $actionname;
	
	/**
	 * The id value.
	 *
	 */
	private $idvalue;
	
	/**
	 * Constructor of the class Route with all controller and action information.
	 *
	 * @param string $controllername Controller name
	 * @param string $controllerclassname Controller class name
	 * @param string $actionname Action name
	 * @param string $idvalue ID value
	 */
	public function __construct($controllername, $controllerclassname, $actionname, $idvalue)
	{
		$this->controllername = $controllername;
		$this->controllerclassname = $controllerclassname;
		$this->actionname = $actionname;
		$this->idvalue = $idvalue;
	}
	
	/**
	 * Get the controller name.
	 *
	 * @return string Controller name
	 */
	public function getControllerName()
	{
		return $this->controllername;
	}
	
	/**
	 * Get the controller class name.
	 *
	 * @return string Controller class name
	 */
	public function getControllerClassName()
	{
		return $this->controllerclassname;
	}
	
	/**
	 * Get the action name.
	 *
	 * @return string Action name
	 */
	public function getActionName()
	{
		return $this->actionname;
	}
	
	/**
	 * Get the ID value.
	 *
	 * @return string ID Value
	 */
	public function getIdValue()
	{
		return $this->idvalue;
	}
}

?>

<?php

/**
 * The class DataContainer contains all information that are needed by the system.
 */
class DataContainer
{
	/**
	 * The controller class name.
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
	 * Constructor of the class DataContainer all information.
	 * 
	 * @param string $controller Controller name
	 * @param string $controllerclassname Controller class name
	 * @param string $actionname Action name
	 */
	public function __construct($controllername, $controllerclassname, $actionname)
	{
		$this->controllername = $controllername;
		$this->controllerclassname = $controllerclassname;
		$this->actionname = $actionname;
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
}

?>
<?php

/**
 * The class Router handles the user input and generates the controller
 * name and the action name.
 */
class Router
{
	/**
	 * The configuration of the Router
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class Router with the configuration.
	 * 
	 * @param Configuration $configuration Configuration
	 */
	public function __construct($configuration)
	{
		$this->configuration = $configuration;
	}
	
	/**
	 * Get the controller name based on the input.
	 *
	 * @param string $controllername Controller name given by the user
	 * @return string Controller name checked by the system
	 */
	public function getControllerName($controllername)
	{
		// If the controller name is empty, use the default controller name
		if(empty($controllername))
		{
			$controllername = $this->configuration->getDefaultControllerName();
		}
		
		// Check if the class does exist - otherwise use the fallback controller name
		if(!class_exists($controllername . CONTROLLER_SUFFIX))
		{
			$controllername = $this->configuration->getFallbackControllerName();
		}
		
		// Return the controller name
		return $controllername;
	}
	
	/**
	 * Get the controller class name based on the input.
	 *
	 * @param string $controllername Controller name given by the user
	 * @return string Controller class name checked by the system
	 */
	public function getControllerClassName($controllername)
	{
		// Build the controller class name
		$controllerclassname = $this->getControllerName($controllername) . CONTROLLER_SUFFIX;
		
		// Return the controller class name
		return $controllerclassname;
	}
	
	/**
	 * Get the action name based on the input.
	 *
	 * @param string $controllername Controller name given by the system
	 * @param string $actionname Action name given by the user
	 * @return string Action name checked by the system
	 */
	public function getActionName($controllername, $actionname)
	{
		// Build the controller class name
		$controllerclassname = $this->getControllerClassName($controllername);
		
		// Check if the method exists - otherwise use the fallback action name
		if(!method_exists($controllerclassname, $actionname))
		{
			$actionname = DEFAULT_ACTION_NAME;
		}
		
		// Return the action name
		return $actionname;
	}
}

?>

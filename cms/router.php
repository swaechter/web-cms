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
	 * Get the route based on the input.
	 *
	 * @param string $controllername User controller input
	 * @param string $actionname User action input
	 * @param Route|null Router route or null
	 */
	public function getRoute($controllername, $actionname)
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
		
		// If the fallback controller does not exist, throw an exception
		if(!class_exists($controllername . CONTROLLER_SUFFIX))
		{
			throw new Exception("The router cannot find a valid controller or fallback controller.");
		}
		
		// Lowercase the controller name to prevent file system problems
		$controllername = strtolower($controllername);
		
		// Build the controller class name
		$controllerclassname = $controllername . CONTROLLER_SUFFIX;
		
		// If the action name is empty, use the default action name
		if(!method_exists($controllerclassname, $actionname))
		{
			if(in_array("ModuleController", class_implements($controllerclassname)))
			{
				$actionname = DEFAULT_MODULE_ACTION_NAME;
			}
			else if(in_array("SystemController", class_implements($controllerclassname)))
			{
				$actionname = DEFAULT_SYSTEM_ACTION_NAME;
			}
			else
			{
				throw new Exception("The router cannot find a user, system or module interface in the given controller.");
			}
		}
		
		// If the action method does not exist, throw an exception
		if(!method_exists($controllerclassname, $actionname))
		{
			throw new Exception("The router cannot find the method for this router.");
		}
		
		// Lowercase the action name to prevent file system problems
		$actionname = strtolower($actionname);
		
		// Return the route
		return new Route($controllername, $controllerclassname, $actionname);
	}
}

?>

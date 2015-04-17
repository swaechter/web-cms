<?php

/**
 * The file router.php provides a router that can handle the user input and
 * provides a route that is used by the siystem.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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
	 * @param string $uri URI of the user input
	 * @param Route|null Router route or null
	 */
	public function getRoute($uri)
	{
		// Trim the URI
		$uri = ltrim($uri, URI_DELIMITER);
		
		// If the URI is empty, use the default URI
		if(empty($uri))
		{
			$uri = ltrim($this->configuration->getDefaultUri(), URI_DELIMITER);
		}
		
		// Explode the URI
		$params = explode(URI_DELIMITER, $uri);
		$controllername = array_shift($params);
		$actionname = array_shift($params);
		
		// Set all data elements
		for($i = 0; $i < count($params); $i++)
		{
			Utils::setGet("data" . $i, $params[$i]);
		}
		
		// Set the data element
		$data = implode(URI_DELIMITER, $params);
		Utils::setGet("data", $data);
		
		// If the controller was not found, use the fallback URI
		if(!class_exists($controllername . CONTROLLER_SUFFIX))
		{
			$uri = ltrim($this->configuration->getDefaultUri(), URI_DELIMITER);
			$params = explode(URI_DELIMITER, $uri);
			$controllername = !empty($params[0]) ? $params[0] : null;
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
		
		// Lowercase the action name to prevent file system problems
		$actionname = strtolower($actionname);
		
		// Return the route
		return new Route($controllername, $controllerclassname, $actionname, $data);
	}
}

?>

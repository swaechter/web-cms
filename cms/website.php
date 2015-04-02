<?php

// Include the entites
require("entities/menu.php");
require("entities/user.php");

// Include the interfaces
require("interfaces/modulecontroller.php");
require("interfaces/systemcontroller.php");

// Include the system
require("globals.php");
require("configuration.php");
require("databasemanager.php");
require("datacontainer.php");
require("plugin.php");
require("pluginmanager.php");
require("route.php");
require("router.php");
require("model.php");
require("view.php");
require("controller.php");
require("item.php");
require("menumanager.php");
require("viewmanager.php");
require("utils.php");
/**
 * The class Website is the main class of the whole system. It is responsible
 * for handling the user request and generating a displayable site.
 */
class Website
{
	/**
	 * The configuration of the website.
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class Website with the configuration.
	 * 
	 * @param Configuration $configuration Configuration
	 */
	public function __construct($configuration)
	{
		// Set the configuration
		$this->configuration = $configuration;
	}
	
	/**
	 * Generate a site based on the user request.
	 * 
	 * @return string Parsed HTML site
	 */
	public function getDisplayableSite()
	{
		// Create the plugin manager
		$pluginmanager = new PluginManager(APP_DIRECTORY);
		
		// Create the database manager
		$databasemanager = new Databasemanager($this->configuration);
		
		// Create the view manager
		$viewmanager = new ViewManager($this->configuration);
		
		// Create the menu manager
		$menumanager = new MenuManager($databasemanager, $this->configuration);
		
		// Create the router and get the route
		$router = new Router($this->configuration);
		$route = $router->getRoute(Utils::getServer("REQUEST_URI"));
		
		// Get all menus
		$menus = $menumanager->getMenus();
		
		// Create the data container
		$datacontainer = new DataContainer($route, $menus);
		
		// Create a view
		$view = $viewmanager->createView($datacontainer);
		
		// Get the controller class name and create the controller
		$controllerclassname = $route->getControllerClassName();
		$controller = new $controllerclassname($databasemanager, $datacontainer, $view);
		
		// Get the action name and execute the controller action
		$actionname = $route->getActionName();
		$controller->$actionname();
		
		// Parse the view
		$html = $viewmanager->parseView($view);
		
		// Clear all form values
		Utils::unsetPost();
		
		// Return the parsed HTML
		return $html;
	}
}

?>

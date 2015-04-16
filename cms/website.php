<?php

/**
 * The file website.php provides the class Website which hides all the
 * complexity of the system. The class Website makes it posible to generate
 * a whole site with one method.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

// Include the entites
require_once("entities/menu.php");
require_once("entities/user.php");

// Include the interfaces
require_once("interfaces/modulecontroller.php");
require_once("interfaces/systemcontroller.php");

// Include the system
require_once("globals.php");
require_once("configuration.php");
require_once("ldapconfiguration.php");
require_once("databasemanager.php");
require_once("datacontainer.php");
require_once("plugin.php");
require_once("pluginmanager.php");
require_once("route.php");
require_once("router.php");
require_once("model.php");
require_once("view.php");
require_once("controller.php");
require_once("item.php");
require_once("menumanager.php");
require_once("viewmanager.php");
require_once("utils.php");

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
		
		// Start the session
		session_start();
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
		$databasemanager = new DatabaseManager($this->configuration);
		
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
		$datacontainer = new DataContainer($route, $menus, $this->configuration);
		
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

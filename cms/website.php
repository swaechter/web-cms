<?php

require("entities/menu.php");
require("entities/user.php");
require("globals.php");
require("configuration.php");
require("databasemanager.php");
require("datacontainer.php");
require("plugin.php");
require("pluginmanager.php");
require("router.php");
require("model.php");
require("view.php");
require("controller.php");
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
	 * The plugin manager of the website.
	 *
	 * @var PluginManager
	 */
	private $pluginmanager;
	
	/**
	 * The database manager of the website.
	 *
	 * @var DatabaseManager
	 */
	private $databasemanager;
	
	/**
	 * The view manager of the website.
	 *
	 * @var ViewManager
	 */
	private $viewmanager;
	
	/**
	 * The menu manager of the website.
	 *
	 * @var MenuManager
	 */
	private $menumanager;
	
	/**
	 * The configuration of the website.
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class Website with the configuration.
	 * 
	 * @param Configuration $configuration Website configuration
	 */
	public function __construct($configuration)
	{
		// Create the plugin manager
		$this->pluginmanager = new PluginManager(APP_DIRECTORY);
		
		// Create the database manager
		$this->databasemanager = new Databasemanager($configuration);
		
		// Create the view manager
		$this->viewmanager = new ViewManager($configuration);
		
		// Create the menu manager
		$this->menumanager = new MenuManager($configuration);
		
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
		$router = new Router($this->configuration);
		
		$controllername = $router->getControllerName(Utils::getGet('controller'));
		$controllerclassname = $router->getControllerClassName($controllername);
		$actionname = $router->getActionName($controllername, Utils::getGet('action'));
		
		$datacontainer = new DataContainer($controllername, $controllerclassname, $actionname);
		
		$view = $this->viewmanager->createView($datacontainer);
		
		$controller = new $controllerclassname($this->databasemanager, $datacontainer, $view);
		
		$controller->$actionname();
		
		return $this->viewmanager->parseView($view);
	}
}

?>

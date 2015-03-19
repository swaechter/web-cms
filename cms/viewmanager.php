<?php

/**
 * The class ViewManager is responsible for the view creation and parsing.
 */
class ViewManager
{
	/**
	 * Configuration of the view manager.
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class ViewManager with the configuration.
	 * 
	 * @param Configuration $configuration Configuration
	 */
	public function __construct($configuration)
	{
		$this->configuration = $configuration;
	}
	
	/**
	 * Create a new view based on the data container.
	 *
	 * @param DataContainer $datacontainer Data container
	 * @return View New view
	 */
	public function createView($datacontainer)
	{
		// Set all template values
		$templatedirectory = TEMPLATE_DIRECTORY;
		$templatename = INDEX_TEMPLATE_NAME . TEMPLATE_EXTENSION;
		$subtemplatedirectory = SUBTEMPLATE_DIRECTORY;
		$subtemplatename = $datacontainer->getControllerName() . $datacontainer->getActionName() . TEMPLATE_EXTENSION;
		
		// Create and return the view
		return new View($templatedirectory, $templatename, $subtemplatedirectory, $subtemplatename);
	}
	
	/**
	 * Parse a view based on the template information and data
	 *
	 * @param View $view View that will be parsed
	 * @return string Parsed HTML site
	 */
	public function parseView($view)
	{
		$data = $view->getData();
		$data["WEBSITE_NAME"] = $this->configuration->getWebsiteName();
		
		$loader = new Twig_Loader_Filesystem($view->getSubtemplateDirectory());
		$environment = new Twig_Environment($loader, array("autoescape" => true));
		$content = $environment->render($view->getSubtemplateName(), $data);
		
		$data["SUBTEMPLATE"] = $content;
		
		$loader = new Twig_Loader_Filesystem($view->getTemplateDirectory());
		$environment = new Twig_Environment($loader, array("autoescape" => true));
		$content = $environment->render($view->getTemplateName(), $data);
		
		return $content;
	}
}

?>

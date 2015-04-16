<?php

/**
 * The file viewmanager.php provides a manager, that takes a view with data
 * and generates a displayable HTML site.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

use Gajus\Dindent\Indenter;

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
		$subtemplatename = $datacontainer->getRoute()->getControllerName() . $datacontainer->getRoute()->getActionName() . TEMPLATE_EXTENSION;
		
		// Set the data
		$data["WEBSITENAME"] = $this->configuration->getWebsiteName();
		$data["TITLE"] = $this->configuration->getWebsiteName();
		$data["NAVIGATIONMENUS"] = $datacontainer->getMenus();
		
		// Create and return the view
		return new View($templatedirectory, $templatename, $subtemplatedirectory, $subtemplatename, $data);
	}
	
	/**
	 * Parse a view based on the template information and data
	 *
	 * @param View $view View that will be parsed
	 * @return string Parsed HTML site
	 */
	public function parseView($view)
	{
		// Get the data
		$data = $view->getData();
		
		$loader = new Twig_Loader_Filesystem($view->getSubtemplateDirectory());
		$environment = new Twig_Environment($loader, array("autoescape" => true));
		$content = $environment->render($view->getSubtemplateName(), $data);
		
		$data["SUBTEMPLATE"] = $content;
		
		$loader = new Twig_Loader_Filesystem($view->getTemplateDirectory());
		$environment = new Twig_Environment($loader, array("autoescape" => true));
		$content = $environment->render($view->getTemplateName(), $data);
		
		$indenter = new Indenter();
		$indenter->setElementType('span', Indenter::ELEMENT_TYPE_BLOCK);
		$content = $indenter->indent($content);
		
		return $content;
	}
}

?>

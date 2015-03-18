<?php

require("configuration.php");

/**
 * The class Website is the main class of the whole system. It is responsible
 * for handling the user request and generating a displayable site.
 */
class Website
{
	/**
	 * The configuration of the website
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class Website with all parameters.
	 * 
	 * @param Configuration $configuration CMS configuration
	 */
	public function __construct($configuration)
	{
		$this->configuration = $configuration;
	}
	
	/**
	 * Generate a site based on the user request.
	 * 
	 * @return String Displayable HTML site
	 */
	public function getDisplayableSite()
	{
		return "Not implemented yet!";
	}
}

?>

<?php

/**
 * The class View is responsible for holding all data before they get parsed.
 */
class View
{
	/**
	 * The template directory of the main view template.
	 *
	 * @var string
	 */
	private $templatedirectory;
	
	/**
	 * The template name of the main view template.
	 *
	 * @var string
	 */
	private $templatename;
	
	/**
	 * The template directory of the subtemplate.
	 *
	 * @var string
	 */
	private $subtemplatedirectory;
	
	/**
	 * The template name of the subtemplate.
	 *
	 * @var string
	 */
	private $subtemplatename;
	
	/**
	 * The template data that are used for the parsing.
	 *
	 * @var array
	 */
	private $data;
	
	/**
	 * Constructor of the class View with the template information.
	 * 
	 * @param string $templatedirectory Template directory
	 * @param string $templatename Template name
	 * @param string $subtemplatedirectory Subtemplate directory
	 * @param string $subtemplatename Subtemplate name
	 */
	public function __construct($templatedirectory, $templatename, $subtemplatedirectory, $subtemplatename)
	{
		$this->templatedirectory = $templatedirectory;
		$this->templatename = $templatename;
		$this->subtemplatedirectory = $subtemplatedirectory;
		$this->subtemplatename = $subtemplatename;
		$this->data = array();
	}
	
	/**
	 * Get the template directory.
	 *
	 * @return string Template directory
	 */
	public function getTemplateDirectory()
	{
		return $this->templatedirectory;
	}
	
	/**
	 * Get the template name.
	 *
	 * @return string Template name
	 */
	public function getTemplateName()
	{
		return $this->templatename;
	}
	
	/**
	 * Get the subtemplate directory.
	 *
	 * @return string Subtemplate directory
	 */
	public function getSubtemplateDirectory()
	{
		return $this->subtemplatedirectory;
	}
	
	/**
	 * Get the subtemplate name.
	 *
	 * @return string Subtemplate name
	 */
	public function getSubtemplateName()
	{
		return $this->subtemplatename;
	}
	
	/**
	 * Set a value in the data array.
	 *
	 * @param string $key Key of the data entry
	 * @param string $value Value of the key
	 */
	public function setData($key, $value)
	{
		$this->data[$key] = $value;
	}
	
	/**
	 * Get all data entries.
	 *
	 * @return array All data as array
	 */
	public function getData()
	{
		return $this->data;
	}
}

?>

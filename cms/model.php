<?php

/**
 * The class Model provides a way to interact with the database over
 * the database manager.
 */
abstract class Model
{
	/**
	 * The controller to access the database manager.
	 *
	 * @var Controller
	 */
	private $controller;
	
	/**
	 * Constructor of the class Controller.
	 *
	 * @param Controller $controller Controller
	 */
	public function __construct($controller)
	{
		$this->controller = $controller;
	}
	
	/**
	 * Get the database manager.
	 *
	 * @return DatabaseManager Database manager
	 */
	public function getDatabaseManager()
	{
		return $this->controller->getDatabaseManager();
	}
	
	/**
	 * Get the data container.
	 *
	 * @return DataContainer Data container
	 */
	public function getDataContainer()
	{
		return $this->controller->getDataContainer();
	}
}

?>

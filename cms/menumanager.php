<?php

/**
 * The file menumanager.php contains the menu manager which reads all menu
 * items.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class MenuManager is responsible for the menu entries and for the site
 * navigation.
 */
class MenuManager
{
	/**
	 * The database manager of the menu manager.
	 *
	 * @var DatabaseManager
	 */
	private $databasemanager;
	
	/**
	 * The configuration of the menu manager;
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class MenuManager with the database manager and the configuration.
	 *
	 * @param DatabaseManager $databasemanager Database manager
	 * @param Configuration $configuration Configuration
	 */
	public function __construct($databasemanager, $configuration)
	{
		$this->databasemanager = $databasemanager;
		$this->configuration = $configuration;
	}
	
	/**
	 * Get all menus.
	 *
	 * @return array All menus
	 */
	public function getMenus()
	{
		return $this->databasemanager->getEntries('Menu');
	}
}

?>

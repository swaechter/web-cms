<?php

/**
 * The file item.php contains a fine granulated information class for a
 * controller like the system name and the displayable name.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class Item holds all data of a controller.
 */
class Item
{
	/**
	 * The name of the controller.
	 *
	 * @var string
	 */
	private $name;
	
	/**
	 * The displaya name of the controller.
	 *
	 * @var string
	 */
	private $displayname;
	
	/**
	 * Constructor of the class Item with the name and the display name.
	 *
	 * @param string $name Controller name
	 * @param string $displayname Controller display name
	 */
	public function __construct($name, $displayname)
	{
		$this->name = $name;
		$this->displayname = $displayname;
	}
	
	/**
	 * Get the name of the controller.
	 *
	 * @return string Controller name
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Get the display name of the controller.
	 *
	 * @return string Controller display name
	 */
	public function getDisplayName()
	{
		return $this->displayname;
	}
}

?>

<?php

/**
 * The file plugin.php contains the plugin functionality. A plugin acts
 * as a container for controllers.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The interface Plugin provides information about a plugin.
 *
 */
interface Plugin
{
	/**
	 * Get the plugin name.
	 *
	 * @return string Plugin name
	 */
	public function getName();
	
	/**
	 * Get the plugin display name.
	 *
	 * @return string Plugin display name
	 */
	public function getDisplayName();
	
	/**
	 * Get the plugin description.
	 *
	 * @return string Plugin description
	 */
	public function getDescription();
	
	/**
	 * Get the plugin controller items.
	 *
	 * @return array Plugin controller items
	 */
	public function getItems();
}

?>

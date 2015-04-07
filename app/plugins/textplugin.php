<?php

/**
 * The file textplugin.php provides the text plugin which is responsible
 * for creating, editing and deleting text entries.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The plugin Text provides an article system for text sites.
 */
class TextPlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 *
	 * @return string Plugin name
	 */
	public function getName()
	{
		return "text";
	}
	
	/**
	 * Get the plugin display name.
	 *
	 * @return string Plugin display name
	 */
	public function getDisplayName()
	{
		return "Text";
	}
	
	/**
	 * Get the plugin description.
	 *
	 * @return string Plugin description
	 */
	public function getDescription()
	{
		return "Das Plugin 'Text' stellt einfache Textseiten mit Markdownverarbeitung zur Verfügung.";
	}
	
	/**
	 * Get the plugin controller items.
	 *
	 * @return array Plugin controller items
	 */
	public function getItems()
	{
		return array(new Item("text", "Texte"));
	}
}

?>

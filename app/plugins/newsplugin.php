<?php

/**
 * The file newsplugin.php provides the news plugin which is responsible
 * for creating, editing and deleting news entries in a news feed.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The plugin News provide a news system with news entries.
 */
class NewsPlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 *
	 * @return string Plugin name
	 */
	public function getName()
	{
		return "news";
	}
	
	/**
	 * Get the plugin display name.
	 *
	 * @return string Plugin display name
	 */
	public function getDisplayName()
	{
		return "News";
	}
	
	/**
	 * Get the plugin description.
	 *
	 * @return string Plugin description
	 */
	public function getDescription()
	{
		return "Das Plugin 'News' stellt einen Newsfeed mit einzelnen News zur Verfügung.";
	}
	
	/**
	 * Get the plugin controller items.
	 *
	 * @return array Plugin controller items
	 */
	public function getItems()
	{
		return array(new Item("news", "News"));
	}
	
	/**
	 * Get the plugin dependencies as array.
	 *
	 * @return array Plugin dependencies
	 */
	public function getDependencies()
	{
		return array("admin");
	}
}

?>

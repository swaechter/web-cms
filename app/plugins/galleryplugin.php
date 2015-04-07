<?php

/**
 * The file galleryplugin.php contains the gallery plugin and provides an
 * image gallery.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The plugin Gallery provides an image gallery with images.
 */
class GalleryPlugin implements Plugin
{
	/**
	 * Get the plugin name.
	 *
	 * @return string Plugin name
	 */
	public function getName()
	{
		return "gallery";
	}
	
	/**
	 * Get the plugin display name.
	 *
	 * @return string Plugin display name
	 */
	public function getDisplayName()
	{
		return "Gallery";
	}
	
	/**
	 * Get the plugin description.
	 *
	 * @return string Plugin description
	 */
	public function getDescription()
	{
		return "Das Plugin 'Gallery' stellt eine Bildergallery zur Verfügung.";
	}
	
	/**
	 * Get the plugin controller items.
	 *
	 * @return array Plugin controller items
	 */
	public function getItems()
	{
		return array(new Item("gallery", "Gallery"));
	}
}

?>

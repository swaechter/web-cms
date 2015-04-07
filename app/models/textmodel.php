<?php

/**
 * The file provides a method for creating, editing and deleting text
 * entries.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class TextModel provides an article reader system.
 */
class TextModel extends Model
{
	/**
	 * Get all texts.
	 *
	 * @return array All texts
	 */
	public function getTexts()
	{
		return $this->getDatabaseManager()->getEntries("Text");
	}
	
	/**
	 * Get a specific text by the ID.
	 *
	 * @param integer $id ID of the text
	 * @return Text|null Text object or null
	 */
	public function getText($id)
	{
		return $this->getDatabaseManager()->getEntryById("Text", $id);
	}
	
	/**
	 * Create a new text.
	 *
	 * @param string $title Title of the text
	 * @param string $text Content of the text
	 * @return boolean Status of the action
	 */
	public function createText($title, $text)
	{
		$entry = new Text();
		$entry->setTitle($title);
		$entry->setMarkdownText($text);
		
		return $this->getDatabaseManager()->saveEntry($entry);
	}
	
	/**
	 * Update a text.
	 *
	 * @param Text $text Text obtect
	 * @return boolean Status of the action
	 */
	public function updateText($text)
	{
		return $this->getDatabaseManager()->saveEntry($text);
	}
	
	/**
	 * Delete a text.
	 *
	 * @param Text $text Text obtect
	 * @return boolean Status of the action
	 */
	public function deleteText($text)
	{
		return $this->getDatabaseManager()->deleteEntry($text);
	}
}

?>

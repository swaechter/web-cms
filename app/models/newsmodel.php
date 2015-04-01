<?php

/**
 * The class NewsModel provides a news reader system.
 */
class NewsModel extends Model
{
	/**
	 * Get all news.
	 *
	 * @return array All news
	 */
	public function getNewses()
	{
		return array_reverse($this->getDatabaseManager()->getEntries("News"));
	}
	
	/**
	 * Get a specific news by the ID.
	 *
	 * @param integer $id ID of the news
	 * @return News|null News object or null
	 */
	public function getNews($id)
	{
		return $this->getDatabaseManager()->getEntryById("News", $id);
	}
	
	/**
	 * Create a new news.
	 *
	 * @param string $title Title of the news
	 * @param string $text Content of the news
	 * @return boolean Status of the action
	 */
	public function createNews($title, $text)
	{
		$entry = new News();
		$entry->setDate(date("d.m.Y H:i:s"));
		$entry->setTitle($title);
		$entry->setMarkdownText($text);
		
		return $this->getDatabaseManager()->saveEntry($entry);
	}
	
	/**
	 * Update a news.
	 *
	 * @param News $news News obtect
	 * @return boolean Status of the action
	 */
	public function updateNews($news)
	{
		return $this->getDatabaseManager()->saveEntry($news);
	}
	
	/**
	 * Delete a news.
	 *
	 * @param News $news News obtect
	 * @return boolean Status of the action
	 */
	public function deleteNews($news)
	{
		return $this->getDatabaseManager()->deleteEntry($news);
	}
}

?>

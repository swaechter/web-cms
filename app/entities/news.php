<?php

/**
 * The class News represents a news.
 *
 * @Entity
 **/
class News
{
	/**
	* The unique number of the news.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The date of the news.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $date;
	
	/**
	* The title of the news.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $title;
	
	/**
	* The markdown content of the news.
	*
	* @var string
	* @Column(type="text")
	**/
	protected $text;
	
	/**
	 * Get the unique number of the news.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the date of the news.
	 *
	 * @param string $date Date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}
	
	/**
	 * Get the date of the news.
	 *
	 * @return string News date
	 */
	public function getDate()
	{
		return $this->date;
	}
	
	/**
	 * Set the title of the news.
	 *
	 * @param string $title Title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Get the title of the news.
	 *
	 * @return string News title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Get the markdown content of the news.
	 *
	 * @return string Text content
	 */
	public function getMarkdownText()
	{
		return $this->text;
	}
	
	/**
	 * Set the markdown content of the news.
	 *
	 * @param string $text Text
	 */
	public function setMarkdownText($text)
	{
		$this->text = $text;
	}
	
	/**
	 * Get the content of the news as HTML text.
	 *
	 * @return string Parsed markdown as HTML
	 */
	public function getParsedText()
	{
		$parser = new Parsedown();
		return $parser->text($this->text);
	}
}

?>

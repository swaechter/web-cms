<?php

/**
 * The class Text represents a text.
 *
 * @Entity
 **/
class Text
{
	/**
	* The unique number of the text.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The title of the text.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $title;
	
	/**
	* The markdown content of the text.
	*
	* @var string
	* @Column(type="text")
	**/
	protected $text;
	
	/**
	 * Get the unique number of the text.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the title of the text.
	 *
	 * @param string $title Title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Get the title of the text.
	 *
	 * @return string Text title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Get the markdown content of the text.
	 *
	 * @return string Text content
	 */
	public function getMarkdownText()
	{
		return $this->text;
	}
	
	/**
	 * Set the markdown content of the text.
	 *
	 * @param string $text Text
	 */
	public function setMarkdownText($text)
	{
		$this->text = $text;
	}
	
	/**
	 * Get the content of the text as HTML text.
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

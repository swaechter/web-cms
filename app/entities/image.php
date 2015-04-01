<?php

/**
 * The class Image represents an image.
 *
 * @Entity
 **/
class Image
{
	/**
	* The unique number of the image.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The file name of the image.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $filename;
	
	/**
	* The date of the image.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $date;
	
	/**
	* The title of the image.
	*
	* @var $title
	* @Column(type="string", length=15)
	**/
	protected $title;
	
	/**
	 * Get the unique number of the image.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the file name of the image.
	 *
	 * @param string $filename File name
	 */
	public function setFileName($filename)
	{
		$this->filename = $filename;
	}
	
	/**
	 * Get the file name of the image.
	 *
	 * @return string File name
	 */
	public function getFileName()
	{
		return $this->filename;
	}
	
	/**
	 * Set the date of the image.
	 *
	 * @param string $date Image date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}
	
	/**
	 * Get the date of the image.
	 *
	 * @return string Image date
	 */
	public function getDate()
	{
		return $this->date;
	}
	
	/**
	 * Set the title of the image.
	 *
	 * @param string $title Image title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Get the title of the image.
	 *
	 * @return string Image title
	 */
	public function getTitle()
	{
		return $this->title;
	}
}

?>

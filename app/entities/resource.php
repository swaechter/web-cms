<?php

/**
 * The class Resource represents an resource.
 *
 * @Entity
 **/
class Resource
{
	/**
	* The unique number of the resource.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The file name of the resource.
	*
	* @var string
	* @Column(type="text")
	**/
	protected $filename;
	
	/**
	 * Get the unique number of the resource.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the file name of the resource.
	 *
	 * @param string $filename File name
	 */
	public function setFileName($filename)
	{
		$this->filename = $filename;
	}
	
	/**
	 * Get the file name of the resource.
	 *
	 * @return string File name
	 */
	public function getFileName()
	{
		return $this->filename;
	}
}

?>

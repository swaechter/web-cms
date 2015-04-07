<?php

/**
 * The file resource.php provides a resource entity that contains the
 * file name.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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

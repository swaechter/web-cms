<?php

/**
 * The class Menu represents an entry of the site navigation.
 *
 * @Entity
 */
class Menu
{
	/**
	* The unique number of the menu.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The parent menu of the menu.
	*
	* @var object
	* @ManyToOne(targetEntity="Menu")
	**/
	protected $parentmenu;
	
	/**
	* The name of the menu.
	*
	* @var string
	* @Column(type="string")
	**/
	protected $name;
	
	/**
	* The display name of the menu.
	*
	* @var string
	* @Column(type="string")
	**/
	protected $displayname;
	
	/**
	* The URL link of the menu.
	*
	* @var string
	* @Column(type="string")
	**/
	protected $link;
	
	/**
	* The position of the menu.
	*
	* @var integer
	* @Column(type="integer")
	**/
	protected $position;
	
	/**
	 * Get the unique number of the menu.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Get the parent menu of the menu.
	 *
	 * @return object Parent menu
	 */
	public function getParentMenu()
	{
		return $this->parentmenu;
	}
	
	/**
	 * Get the name of the menu.
	 *
	 * @return string Menu name
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Get the displayable name of the menu.
	 *
	 * @return string Displayable menu name
	 */
	public function getDisplayName()
	{
		return $this->displayname;
	}
	
	/**
	 * Get the URL link of the menu.
	 *
	 * @return string URL link
	 */
	public function getLink()
	{
		return $this->link;
	}
	
	/**
	 * Get the position of the menu.
	 *
	 * @return integer Position ID
	 */
	public function getPosition()
	{
		return $this->position;
	}
}

?>

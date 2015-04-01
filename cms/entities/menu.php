<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
* The class Menu contains information about a navigation object.
*
* @Entity
*/
class Menu
{
	/**
	* @var integer
	* @Id
	* @GeneratedValue
	* @Column(type="integer")
	*/
	private $id;
	
	/**
	* @var Menu|null
	* @ManyToOne(targetEntity="Menu", inversedBy="childrenmenus")
	*/
	private $parentmenu;
	
	/**
	 * @var array
	 * @OneToMany(targetEntity="Menu", mappedBy="parentmenu")
	*/
	private $childrenmenus;
	
	/**
	 * The display name of the menu.
	 *
	 * @var string
	 * @Column(type="string", length=50)
	**/
	protected $displayname;
	
	/**
	 * The URL link of the menu.
	 *
	 * @var string
	 * @Column(type="string", length=50)
	**/
	protected $link;
	
	/**
	 * Constructor of the class Menu.
	 */
	public function __construct()
	{
		$this->childrenmenus = new ArrayCollection();
	}
	
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
	 * @return Menu|null Parent menu
	 */
	public function getParentMenu()
	{
		return $this->parentmenu;
	}
	
	/**
	 * Set the parent menu of the menu.
	 *
	 * @param Menu $parentmenu Parent menu
	 */
	public function setParentMenu($parentmenu)
	{
		$this->parentmenu = $parentmenu;
	}
	
	/**
	 * Get the all children menus of the menu.
	 *
	 * @return array Children menus
	 */
	public function getChildrenMenus()
	{
		return $this->childrenmenus;
	}
	
	/**
	 * Set all children menus to the menu.
	 *
	 * @param array $childrenmenus Children menus
	 */
	public function setChildrenMenus($childrenmenus)
	{
		$this->childrenmenus = $childrenmenus;
	}
	
	/**
	 * Add a children menu to the menu.
	 *
	 * @param Menu $childrenmenu Children Menu
	 */
	public function addChildrenMenu($childrenmenu)
	{
		$this->childrenmenus->add($childrenmenus);
	}
	
	/**
	 * Set the display name of the menu.
	 *
	 * @param string $displayname Display name of the menu
	 */
	public function setDisplayName($displayname)
	{
		$this->displayname = $displayname;
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
	 * Set the URL link of the menu.
	 *
	 * @param string $link Link of the menu
	 */
	public function setLink($link)
	{
		$this->link = $link;
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
}

?>

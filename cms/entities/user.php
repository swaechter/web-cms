<?php

/**
 * The class User represents a person that can access and change the system.
 *
 * @Entity
 **/
class User
{
	/**
	* The unique number of the user.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The email address of the user.
	*
	* @var string
	* @Column(type="string")
	**/
	protected $email;
	
	/**
	* The password hash of the user.
	*
	* @var string
	* @Column(type="string")
	**/
	protected $password;
	
	/**
	* The real name of the user.
	*
	* @var string
	* @Column(type="string")
	**/
	protected $name;
	
	/**
	 * Get the unique number of the user.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Get the email address of the user.
	 *
	 * @return integer Email address
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * Get the password hash of the user.
	 *
	 * @return integer Password hash
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	 * Get the real name of the user.
	 *
	 * @return integer Real name
	 */
	public function getName()
	{
		return $this->name;
	}
}

?>

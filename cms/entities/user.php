<?php

/**
 * The file user.php contains the user entity that is loaded by Doctrine. The
 * user entity is used for the authentication.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class User represents a person that can access and change the system.
 *
 * @Entity
 **/
class User
{
	/**
	 * The unique number of the user.
	 *
	 * @var integer
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	protected $id;
	
	/**
	 * The real name of the user.
	 *
	 * @var string
	 * @Column(type="string", length=50)
	 **/
	protected $name;
	
	/**
	 * The email address of the user.
	 *
	 * @var string
	 * @Column(type="string", length=50)
	 **/
	protected $email;
	
	/**
	 * The password hash of the user.
	 *
	 * @var string
	 * @Column(type="string", length=128)
	 **/
	protected $password;
	
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
	 * Set the name.
	 *
	 * @param string $name Name
	 */
	public function setName($name)
	{
		$this->name = $name;
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
	
	/**
	 * Set the email address.
	 *
	 * @param string $email Email address
	 */
	public function setEmail($email)
	{
		$this->email = $email;
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
	 * Set the password.
	 *
	 * @param string $password Password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
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
}

?>

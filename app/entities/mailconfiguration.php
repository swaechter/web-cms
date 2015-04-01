<?php

/**
 * The class MailConfiguration contains the whole mail server configuration.
 *
 * @Entity
 **/
class MailConfiguration
{
	/**
	* The unique number of the mail configuration.
	
	* @var integer
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	**/
	protected $id;
	
	/**
	* The domain of the SMTP server. Connection is established over TLS.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $smtpserver;
	
	/**
	* The port of the SMTP server.
	*
	* @var integer
	* @Column(type="integer")
	**/
	protected $port;
	
	/**
	* The sender address of the mail user.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $sender;
	
	/**
	* The username of the mail user.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $username;
	
	/**
	* The password of the mail user.
	*
	* @var string
	* @Column(type="string", length=50)
	**/
	protected $password;
	
	/**
	 * Get the unique number of the mail configuration.
	 *
	 * @return integer Unique ID
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the SMTP server name.
	 *
	 * @param string $smtpserver SMTP server name
	 */
	public function setSmtpServer($smtpserver)
	{
		$this->smtpserver = $smtpserver;
	}
	
	/**
	 * Get the SMTP server name.
	 *
	 * @return string SMTP server name
	 */
	public function getSmtpServer()
	{
		return $this->smtpserver;
	}
	
	/**
	 * Set the TLS port of the SMTP server.
	 *
	 * @param integer $port SMTP TLS port
	 */
	public function setPort($port)
	{
		$this->port = $port;
	}
	
	/**
	 * Get the TLS port of the SMTP server.
	 *
	 * @return integer SMTP port
	 */
	public function getPort()
	{
		return $this->port;
	}
	
	/**
	 * Set the sender address of the user.
	 *
	 * @param string $sender Sender address
	 */
	public function setSender($sender)
	{
		$this->sender = $sender;
	}
	
	/**
	 * Get the sender address of the user.
	 *
	 * @return string Sender address
	 */
	public function getSender()
	{
		return $this->sender;
	}
	
	/**
	 * Set the name of the user.
	 *
	 * @param string $username User name
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}
	
	/**
	 * Get name of the user.
	 *
	 * @return string Name of the user
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * Set the user password.
	 *
	 * @param string $password User password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	/**
	 * Get the user password.
	 *
	 * @return string User password
	 */
	public function getPassword()
	{
		return $this->password;
	}
}

?>

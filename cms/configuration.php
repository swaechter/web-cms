<?php

/**
 * The file configuration.php contains the whole configuration of the CMS
 * system. These information are accessed by different modules.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class Configuration contains all information that are required by the
 * CMS system.
 */
class Configuration
{
	/**
	 * The name of the website that is displayed.
	 *
	 * @var string
	 */
	private $websitename;
	
	/**
	 * The default URI of the system.
	 *
	 * @var string
	 */
	private $defaulturi;
	
	/**
	 * The hostname of the SQL server.
	 *
	 * @var string
	 */
	private $databasehostname;
	
	/**
	 * The username of the SQL server.
	 *
	 * @var string
	 */
	private $databaseusername;
	
	/**
	 * The password of the SQL server.
	 *
	 * @var string
	 */
	private $databasepassword;
	
	/**
	 * The database name of the SQL server.
	 *
	 * @var string
	 */
	private $databasename;
	
	/**
	 * The LDAP configuration of the system
	 *
	 * @var LdapConfiguration
	 */
	private $ldapconfiguration;
	
	/**
	 * Constructor of the class Configuration.
	 *
	 * @param string $websitename The name of the website
	 * @param string $defaulturi Default URI
	 * @param string $databasehostname The database hostname
	 * @param string $databaseusername The database username
	 * @param string $databasepassword The database user password
	 * @param string $databasename The database name
	 * @param LdapConfiguration $ldapconfiguration The possible LDAP configuration
	 */
	public function __construct($websitename, $defaulturi, $databasehostname, $databaseusername, $databasepassword, $databasename, $ldapconfiguration)
	{
		$this->websitename = $websitename;
		$this->defaulturi = $defaulturi;
		$this->databasehostname = $databasehostname;
		$this->databaseusername = $databaseusername;
		$this->databasepassword = $databasepassword;
		$this->databasename = $databasename;
		$this->ldapconfiguration = $ldapconfiguration;
	}
	
	/**
	 * Get the website name.
	 *
	 * @return string Website name
	 */
	public function getWebsiteName()
	{
		return $this->websitename;
	}
	
	/**
	 * Get the default URI if there is no user input.
	 *
	 * @return string Default URI
	 */
	public function getDefaultUri()
	{
		return $this->defaulturi;
	}
	
	/**
	 * Get the database hostname.
	 *
	 * @return string Database hostname
	 */
	public function getDatabaseHostname()
	{
		return $this->databasehostname;
	}
	
	/**
	 * Get the database username.
	 *
	 * @return string Database username
	 */
	public function getDatabaseUsername()
	{
		return $this->databaseusername;
	}
	
	/**
	 * Get the database password.
	 *
	 * @return string Database password
	 */
	public function getDatabasePassword()
	{
		return $this->databasepassword;
	}
	
	/**
	 * Get the database name.
	 *
	 * @return string Database name
	 */
	public function getDatabaseName()
	{
		return $this->databasename;
	}
	
	/**
	 * Get the LDAP configuration.
	 *
	 * @return LdapConfiguration LDAP configuration
	 */
	public function getLdapConfiguration()
	{
		return $this->ldapconfiguration;
	}
}

?>

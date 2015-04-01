<?php

/**
 * The class configuration contains all information that are required by the
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
	 * This default configuration array is used when no user input was found.
	 *
	 * @var string
	 */
	private $defaultconfiguration;
	
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
	 * Constructor of the class Configuration.
	 *
	 * @param string $websitename The name of the website
	 * @param array $defaultconfiguration Default user input configuration
	 * @param string $databasehostname The database hostname
	 * @param string $databaseusername The database username
	 * @param string $databasepassword The database user password
	 * @param string $databasename The database name
	 */
	public function __construct($websitename, $defaultconfiguration, $databasehostname, $databaseusername, $databasepassword, $databasename)
	{
		$this->websitename = $websitename;
		$this->defaultconfiguration = $defaultconfiguration;
		$this->databasehostname = $databasehostname;
		$this->databaseusername = $databaseusername;
		$this->databasepassword = $databasepassword;
		$this->databasename = $databasename;
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
	 * Get the default user input configuration if there is no user input.
	 *
	 * @return array Configuration as double nested array
	 */
	public function getDefaultConfiguration()
	{
		return $this->defaultconfiguration;
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
}

?>

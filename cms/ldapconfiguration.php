<?php

/**
 * The file ldapconfiguration.php contains the whole LDAP configuration of the
 * CMS system. These information are accessed by different modules.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class LdapConfiguration contains all information that are required by the
 * CMS system.
 */
class LdapConfiguration
{
	/**
	 * The hostname of the LDAP server.
	 *
	 * @var string
	 */
	private $ldaphostname;
	
	/**
	 * The distinguished name of the LDAP server.
	 *
	 * @var string
	 */
	private $ldapdn;
	
	/**
	 * Constructor of the class LdapConfiguration.
	 *
	 * @param string $ldaphostname The LDAP hostname
	 * @param string $ldapdn The LDAP distinguished name
	 */
	public function __construct($ldaphostname, $ldapdn)
	{
		$this->ldaphostname = $ldaphostname;
		$this->ldapdn = $ldapdn;
	}
	
	/**
	 * Get the LDAP hostname.
	 *
	 * @return string Hostname
	 */
	public function getLdapHostname()
	{
		return $this->ldaphostname;
	}
	
	/**
	 * Get the LDAP distinguished name (DN).
	 *
	 * @return string Distinguished name
	 */
	public function getLdapDn()
	{
		return $this->ldapdn;
	}
}

?>

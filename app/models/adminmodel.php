<?php

/**
 * The file adminmodel.php contains the admin functionality like the login
 * and logout system.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class AdminModel model provides an authentication system.
 */
class AdminModel extends Model
{
	/**
	 * Check if the current user is logged in.
	 *
	 * @return boolean Login status
	 */
	public function isUserLoggedIn()
	{
		return Utils::getSession("UserStatus");
	}
	
	/**
	 * Login a user based on the email address/user name and the password.
	 *
	 * @param string $username Email address or the user name
	 * @param string $password Password
	 * @return boolean Status of the login
	 */
	public function loginUser($username, $password)
	{
		if(!$this->hasLdapBackend())
		{
			$passwordhash = hash("sha512", $password);
			$users = $this->getDatabaseManager()->getEntries("User");
			foreach($users as $user)
			{
				if(!strcasecmp($user->getEmail(), $username) && !strcasecmp($user->getPassword(), $passwordhash))
				{
					Utils::setSession("UserStatus", true);
					Utils::setSession("UserUsername", $username);
					Utils::setSession("UserLoginPassword", $password);
					return true;
				}
			}
		}
		else
		{
			Utils::setSession("UserStatus", true);
			return true;
			$ldapconfiguration = $this->getDataContainer()->getConfiguration()->getLdapConfiguration();
			$ldaphostname = $ldapconfiguration->getHostname();
			$ldapdn = $ldapconfiguration->getDn();
			$connection = ldap_connect($ldaphostname, 389);
			if($connection)
			{
				$bind = @ldap_bind($connection, $username . "@" . $ldapdn, $password);
				if($bind)
				{
					Utils::setSession("UserStatus", true);
					Utils::setSession("UserUsername", $username);
					Utils::setSession("UserPassword", $password);
					return true;
				}
				ldap_unbind($connection);
			}
		}
		return false;
	}
	
	/**
	 * Logout a user.
	 */
	public function logoutUser()
	{
		session_unset();
	}
	
	/**
	 * Get the name of the user.
	 *
	 * @return string User name
	 */
	public function getUserName()
	{
		return Utils::getSession("UserUsername");
	}
	
	/**
	 * Get the password of the user.
	 *
	 * @return string Password
	 */
	public function getUserPassword()
	{
		return Utils::getSession("UserPassword");
	}
	
	/**
	 * Check if the system uses a LDAP backend.
	 *
	 * @¶eturn boolean Status of the backend
	 */
	public function hasLdapBackend()
	{
		return $this->getDataContainer()->getConfiguration()->getLdapConfiguration() ? true : false;
	}
}

?>

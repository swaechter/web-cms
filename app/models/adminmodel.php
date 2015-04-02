<?php

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
		return Utils::getSession("UserLoginStatus");
	}
	
	/**
	 * Login a user based on the email address and the password.
	 *
	 * @param string $email Email address
	 * @param string $password Password
	 * @return boolean Status of the login
	 */
	public function loginUser($email, $password)
	{
		$passwordhash = hash("sha512", $password);
		$users = $this->getDatabaseManager()->getEntries("User");
		
		foreach($users as $user)
		{
			if(!strcasecmp($user->getEmail(), $email) && !strcasecmp($user->getPassword(), $passwordhash))
			{
				Utils::setSession("UserLoginStatus", true);
				Utils::setSession("UserLoginName", $user->getName());
				return true;
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
	 */
	public function getUserName()
	{
		return Utils::getSession("UserLoginName");
	}
}

?>

<?php

/**
 * The file usermodel.php is responsible for the user creation, editing
 * and deleting.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class UserModel provides a user system.
 */
class UserModel extends Model
{
	/**
	 * Get all users.
	 *
	 * @return array All users
	 */
	public function getUsers()
	{
		return $this->getDatabaseManager()->getEntries("User");
	}
	
	/**
	 * Get a specific user by the ID.
	 *
	 * @param integer $id ID of the user
	 * @return User|null User object or null
	 */
	public function getUser($id)
	{
		return $this->getDatabaseManager()->getEntryById("User", $id);
	}
	
	/**
	 * Create a new user.
	 *
	 * @param string $name Name
	 * @param string $email Email address
	 * @param string $password Password
	 * @return boolean Status of the action
	 */
	public function createUser($name, $email, $password)
	{
		$entry = new User();
		$entry->setName($name);
		$entry->setEmail($email);
		$entry->setPassword(hash("sha512", $password));
		
		return $this->getDatabaseManager()->saveEntry($entry);
	}
	
	/**
	 * Update a user.
	 *
	 * @param User $user User obtect
	 * @return boolean Status of the action
	 */
	public function updateUser($user)
	{
		return $this->getDatabaseManager()->saveEntry($user);
	}
	
	/**
	 * Delete a user.
	 *
	 * @param User $user User obtect
	 * @return boolean Status of the action
	 */
	public function deleteUser($user)
	{
		return $this->getDatabaseManager()->deleteEntry($user);
	}
}

?>

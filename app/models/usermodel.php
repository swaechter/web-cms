<?php

/**
 * The class UserModel provides a system to access all users.
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
}

?>

<?php

/**
 * The class Utils is a collection of usefull functions.
 */
class Utils
{
	/**
	 * Check if a GET value does exist.
	 *
	 * @param string $key GET Key
	 * @return boolean Status of existence
	 */
	public static function hasGet($key)
	{
		return isset($_GET[$key]) && strlen(trim($_GET[$key])) > 0 ? true : false;
	}
	
	/**
	 * Check if a GET ID value does exist.
	 *
	 * @param string $key GET ID Key
	 * @return boolean Status of existence
	 */
	public static function hasGetId($key)
	{
		$value = Utils::getGet($key);
		return $value != null && is_numeric($value) && $value >= 0;
	}
	
	/**
	 * Set a GET value.
	 *
	 * @param string $key GET key
	 * @param string $value GET value
	 */
	public static function setGet($key, $value)
	{
		$_GET[$key] = $value;
	}
	
	/**
	 * Get a GET value. If the value does not exist, null will be returned.
	 *
	 * @param string $key GET Key
	 * @return string|null Key value or null
	 */
	public static function getGet($key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}
	
	/**
	 * Check if a POST value does exist.
	 *
	 * @param string $key POST Key
	 * @return boolean Status of existence
	 */
	public static function hasPost($key)
	{
		return isset($_POST[$key]) && strlen(trim($_POST[$key])) > 0 ? true : false;
	}
	
	/**
	 * Check if a possible POST ID value does exist and check it.
	 *
	 * @param string $key Possible POST ID Key
	 * @return boolean Status of existence
	 */
	public static function hasPossiblePostId($key)
	{
		if(!Utils::hasPost($key))
		{
			return true;
		}
		else
		{
			$value = Utils::getPost($key);
			return $value != null && is_numeric($value);
		}
		return false;
	}
	
	/**
	 * Check if a POST number value does exist.
	 *
	 * @param string $key POST number Key
	 * @return boolean Status of existence
	 */
	public static function hasPostNumber($key)
	{
		$value = Utils::getPost($key);
		return $value != null && is_numeric($value) && $value >= 0;
	}
	
	/**
	 * Check if a POST string value does exist.
	 *
	 * @param string $key POST string Key
	 * @return boolean Status of existence
	 */
	public static function hasPostString($key)
	{
		$value = Utils::getPost($key);
		return $value != null && strlen($value) != 0 && strlen($value) <= 60;
	}
	
	/**
	 * Check if a possible POST string value does exist and check it.
	 *
	 * @param string $key Possible POST string Key
	 * @return boolean Status of existence
	 */
	public static function hasPossiblePostString($key)
	{
		if(!Utils::hasPost($key))
		{
			return true;
		}
		else
		{
			$value = Utils::getPost($key);
			return $value != null && strlen($value) != 0 && strlen($value) <= 60;
		}
		return false;
	}
	
	/**
	 * Check if a POST text value does exist.
	 *
	 * @param string $key POST text Key
	 * @return boolean Status of existence
	 */
	public static function hasPostText($key)
	{
		$value = Utils::getPost($key);
		return $value != null && strlen($value) != 0;
	}
	
	/**
	 * Check if a POST email value does exist.
	 *
	 * @param string $key POST email Key
	 * @return boolean Status of existence
	 */
	public static function hasPostEmail($key)
	{
		$value = Utils::getPost($key);
		return $value != null && filter_var($value, FILTER_VALIDATE_EMAIL) && strlen($value) <= 60;
	}
	
	/**
	 * Set a POST value.
	 *
	 * @param string $key POST key
	 * @param string $value POST value
	 */
	public static function setPost($key, $value)
	{
		$_POST[$key] = $value;
	}
	
	/**
	 * Get a POST value. If the value does not exist, null will be returned.
	 *
	 * @param string $key POST Key
	 * @return string|null Key value or null
	 */
	public static function getPost($key)
	{
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}
	
	/**
	 * Destroy all POST variables
	 */
	public static function unsetPost()
	{
		$_POST = array();
	}
	
	/**
	 * Get a SERVER value. If the value does not exist, null will be returned.
	 *
	 * @param string $key SERVER Key
	 * @return string|null Key value or null
	 */
	public static function getServer($key)
	{
		return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
	}
	
	/**
	 * Check if a FILE value does exist.
	 *
	 * @param string $variable Variable
	 * @param string $key FILE Key
	 * @return boolean Status of existence
	 */
	public static function hasFiles($variable, $key)
	{
		return isset($_FILES[$variable][$key]) && strlen(trim($_FILES[$variable][$key])) > 0 ? true : false;
	}
	
	/**
	 * Set a FILE value.
	 * @param string $variable Variable
	 * @param string $key FILE Key
	 * @param string $value FILE value
	 */
	public static function setFiles($variable, $key, $value)
	{
		$_FILES[$variable][$key] = $value;
	}
	
	/**
	 * Get a FILE value. If the value does not exist, null will be returned.
	 *
	 * @param string $variable Variable
	 * @param string $key FILE Key
	 * @return string|null Key value or null
	 */
	public static function getFiles($variable, $key)
	{
		return isset($_FILES[$variable][$key]) ? $_FILES[$variable][$key] : null;
	}
	
	/**
	 * Check if a SESSION value does exist.
	 *
	 * @param string $key SESSION Key
	 * @return boolean Status of existence
	 */
	public static function hasSession($key)
	{
		return isset($_SESSION[$key]) && strlen(trim($_SESSION[$key])) > 0 ? true : false;
	}
	
	/**
	 * Set a SESSION value.
	 *
	 * @param string $key SESSION key
	 * @param string $value SESSION value
	 */
	public static function setSession($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	/**
	 * Get a SESSION value. If the value does not exist, null will be returned.
	 *
	 * @param string $key SESSION Key
	 * @return string|null Key value or null
	 */
	public static function getSession($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}
}

?>

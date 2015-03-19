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
}

?>

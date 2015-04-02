<?php

// Include the vendor directory and the website
require_once('vendor/autoload.php');
require_once('cms/website.php');

// Start the session
session_start();

// Display a website site
try
{
	// Create the configuration
	$configuration = new Configuration("Web-CMS", "/text/show/1", "127.0.0.1", "root", "123456", "webcms");
	
	// Create the website
	$website = new Website($configuration);
	
	// Display the site
	echo($website->getDisplayableSite());
}
catch(Exception $exception)
{
	// Display the exception
	echo($exception->getMessage());
}
?>

<?php

// Include the CMS system
require("cms/website.php");

// Display a website site
try
{
	// Create the configuration
	$configuration = new Configuration();
	
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

<?php

// Include the vendor directory and the website
require_once('vendor/autoload.php');
require_once('cms/website.php');

// Display a website site
try
{
	// Create a LDAP configuration if you whish to use a LDAP server as backend system
	// $ldapconfiguration = new LdapConfiguration("smb42", "web-cms.org");
	$ldapconfiguration = null;
	
	// Create the configuration
	$configuration = new Configuration("Web-CMS", "/text/show/1", "127.0.0.1", "root", "123456", "webcms", $ldapconfiguration);
	
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

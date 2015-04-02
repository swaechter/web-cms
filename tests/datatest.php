<?php

/**
 * The class DataTest is a simple getter and setter test for classes.
 */
class DataTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test for the Configuration class.
	 */
	public function testConfiguration()
	{
		// Object getter test
		$configuration = new Configuration("Web-CMS", "/foobar/show/5", "127.0.0.1", "root", "123456", "webcms");
		$this->assertSame($configuration->getWebsiteName(), "Web-CMS");
		$this->assertSame($configuration->getDefaultUri(), "/foobar/show/5");
		$this->assertSame($configuration->getDatabaseHostname(), "127.0.0.1");
		$this->assertSame($configuration->getDatabaseUsername(), "root");
		$this->assertSame($configuration->getDatabasePassword(), "123456");
		$this->assertSame($configuration->getDatabaseName(), "webcms");
	}
	
	/**
	 * Test for the Utils class.
	 */
	public function testUtils()
	{
		// Set values
		Utils::setGet("MyKey", "MyValue");
		Utils::setPost("MyKey", "MyValue");
		
		// Check if they exist
		$this->assertTrue(Utils::hasGet("MyKey"));
		$this->assertTrue(Utils::hasPost("MyKey"));
		
		// Check if the values are correct
		$this->assertSame(Utils::getGet("MyKey"), "MyValue");
		$this->assertSame(Utils::getPost("MyKey"), "MyValue");
		
		// Reset them
		Utils::setGet("MyKey", null);
		Utils::setPost("MyKey", null);
		
		// Check if they don't exist
		$this->assertFalse(Utils::hasGet("MyKey"));
		$this->assertFalse(Utils::hasPost("MyKey"));
	}
}

?>

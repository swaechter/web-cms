<?php

/**
 * The class UtilsTest is a simple test for all util methods.
 */
class UtilsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test for the Utils class.
	 */
	public function testUtils()
	{
		Utils::setGet("MyKey", "MyValue");
		Utils::setGet("MyKeyId", 1);
		Utils::setPost("MyKey", "MyValue");
		Utils::setPost("MyKeyId", 1);
		
		$this->assertTrue(Utils::hasGet("MyKey"));
		$this->assertTrue(Utils::hasGetId("MyKeyId"));
		$this->assertTrue(Utils::hasPost("MyKey"));
		$this->assertTrue(Utils::hasPossiblePostId("MyKeyId"));
		Utils::setPost("MyKeyId", null);
		$this->assertTrue(Utils::hasPossiblePostId("MyKeyId"));
		
		Utils::setGet("MyKey", null);
		Utils::setPost("MyKey", null);
		$this->assertFalse(Utils::hasGet("MyKey"));
		$this->assertFalse(Utils::hasPost("MyKey"));
		
		Utils::setPost("MyKeyNumber", 42);
		Utils::setPost("MyKeyString", "foo");
		Utils::setPost("MyKeyText", "fooooooooooooooooooooooooooooo");
		Utils::setPost("MyKeyEmail", "foo@bar.com");
		$this->assertTrue(Utils::hasPostNumber("MyKeyNumber"));
		$this->assertTrue(Utils::hasPostString("MyKeyString"));
		$this->assertTrue(Utils::hasPossiblePostString("MyKeyString"));
		$this->assertTrue(Utils::hasPostText("MyKeyText"));
		$this->assertTrue(Utils::hasPostEmail("MyKeyEmail"));
		Utils::setPost("MyKeyString", null);
		$this->assertTrue(Utils::hasPossiblePostString("MyKeyString"));
		
		Utils::unsetPost();
		$this->assertFalse(Utils::hasPost("MyKeyNumber"));
		
		Utils::setFiles("MyFiles", "tmp_name", "/tmp/abc123");
		$this->assertTrue(Utils::hasFiles("MyFiles", "tmp_name"));
		$this->assertSame(Utils::getFiles("MyFiles", "tmp_name"), "/tmp/abc123");
		
		Utils::setSession("MyName", "foo");
		$this->assertTrue(Utils::hasSession("MyName"));
		$this->assertSame(Utils::getSession("MyName"), "foo");
	}
}

?>

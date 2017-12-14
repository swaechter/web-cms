<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * The class ObjectTest is a simple getter and setter test for classes.
 */
class ObjectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test for the Menu class
	 */
	public function testMenu()
	{
		$parentmenu = new Menu();
		$parentmenu->setDisplayName("Parent");
		$parentmenu->setLink(null);
		
		$childrenmenu = new Menu();
		$childrenmenu->setParentMenu($parentmenu);
		$childrenmenu->setDisplayName("Child");
		$childrenmenu->setLink("/foo/bar");
		
		$parentmenu->addChildrenMenu($childrenmenu);
		$this->assertSame($parentmenu->getId(), null);
		$this->assertSame($parentmenu->getDisplayName(), "Parent");
		$this->assertSame($parentmenu->getLink(), null);
		$this->assertSame($childrenmenu->getId(), null);
		$this->assertSame($childrenmenu->getParentMenu(), $parentmenu);
		$this->assertSame($childrenmenu->getDisplayName(), "Child");
		$this->assertSame($childrenmenu->getLink(), "/foo/bar");
		
		$arraycollection = new ArrayCollection();
		$arraycollection->add($childrenmenu);
		$parentmenu->setChildrenMenus($childrenmenu);
		$this->assertSame(count($parentmenu->getChildrenMenus()), 1);
	}
	
	/**
	 * Test for the User class
	 */
	public function testUser()
	{
		$user = new User();
		$user->setName("Foo Bar");
		$user->setEmail("foo@bar.com");
		$user->setPassword(hash("sha512", "foobar1911"));
		
		$this->assertSame($user->getId(), null);
		$this->assertSame($user->getName(), "Foo Bar");
		$this->assertSame($user->getEmail(), "foo@bar.com");
		$this->assertSame($user->getPassword(), "757dd128b2989c4f9ecb37d6c79ec8d3a037180a483867368c960b15da0f178cbda8db1e8111026dd64c7e8d6bbb32d3e2e53f2c3672b8cd4b536989e2036fdd");
	}
	
	/**
	 * Test for the LdapConfiguration class.
	 */
	public function testLdapConfiguration()
	{
		$ldapconfiguration = new LdapConfiguration("smb42", "webcms.org");
		$this->assertSame($ldapconfiguration->getLdapHostname(), "smb42");
		$this->assertSame($ldapconfiguration->getLdapDn(), "webcms.org");
	}
	
	/**
	 * Test for the Configuration class.
	 */
	public function testConfiguration()
	{
		$ldapconfiguration = new LdapConfiguration("smb42", "webcms.org");
		$configuration = new Configuration("WebCMS", "/foobar/show/5", "127.0.0.1", "root", "123456aA", "webcms_test", $ldapconfiguration);
		$this->assertSame($configuration->getWebsiteName(), "WebCMS");
		$this->assertSame($configuration->getDefaultUri(), "/foobar/show/5");
		$this->assertSame($configuration->getDatabaseHostname(), "127.0.0.1");
		$this->assertSame($configuration->getDatabaseUsername(), "root");
		$this->assertSame($configuration->getDatabasePassword(), "123456aA");
		$this->assertSame($configuration->getDatabaseName(), "webcms_test");
		$this->assertSame($configuration->getLdapConfiguration(), $ldapconfiguration);
	}
	
	/**
	 * Test for the Route class.
	 */
	public function testAction()
	{
		$route = new Route("foo", "foocontroller", "action", array("5"));
		$this->assertSame($route->getControllerName(), "foo");
		$this->assertSame($route->getControllerClassName(), "foocontroller");
		$this->assertSame($route->getActionName(), "action");
		$this->assertSame($route->getData(), array("5"));
	}
	
	/**
	 * Test for the Item class.
	 */
	public function testItem()
	{
		$route = new Item("foobar", "Foobar");
		$this->assertSame($route->getName(), "foobar");
		$this->assertSame($route->getDisplayName(), "Foobar");
	}
	
	/**
	 * Test all globals
	 */
	public function testGlobals()
	{
		$this->assertSame(CMS_DIRECTORY, "cms/");
		$this->assertSame(CMS_ENTITY_DIRECTORY, "cms/entities/");
		$this->assertSame(APP_DIRECTORY, "app/");
		$this->assertSame(APP_ENTITY_DIRECTORY, "app/entities/");
		$this->assertSame(DATA_DIRECTORY, "public/data/");
		$this->assertSame(TEMPLATE_DIRECTORY, "public/html/");
		$this->assertSame(SUBTEMPLATE_DIRECTORY, "app/views/");
		$this->assertSame(INDEX_TEMPLATE_NAME, "index");
		$this->assertSame(TEMPLATE_EXTENSION, ".html");
		$this->assertSame(URI_DELIMITER, "/");
		$this->assertSame(CONTROLLER_SUFFIX, "controller");
		$this->assertSame(DEFAULT_CONTROLLER_NAME, "index");
		$this->assertSame(DEFAULT_SYSTEM_ACTION_NAME, "adminindex");
		$this->assertSame(DEFAULT_MODULE_ACTION_NAME, "index");
	}
}

?>

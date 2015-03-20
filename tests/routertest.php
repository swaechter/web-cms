<?php

require("routertest/foocontroller.php");
require("routertest/barcontroller.php");

/**
 * The class RouterTest is a test for the router
 */
class RouterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test for the router.
	 */
	public function testRouter()
	{
		// Create the configuration
		$configuration = new Configuration("Web-CMS", "foo", "bar", "127.0.0.1", "root", "123456", "webcms");
		
		// Create the router
		$router = new Router($configuration);
		
		// Set the user controller name to empty. Expected controller name should be foo
		Utils::setGet("controller", null);
		$route = $router->getRoute(Utils::getGet("controller"), Utils::getGet("action"));
		$this->assertSame($route->getControllerName(), "foo");
		$this->assertSame($route->getControllerClassName(), "foocontroller");
		
		// Set the user controller name to foo. Expected controller name should be foo
		Utils::setGet("controller", "foo");
		$route = $router->getRoute(Utils::getGet("controller"), Utils::getGet("action"));
		$this->assertSame($route->getControllerName(), "foo");
		$this->assertSame($route->getControllerClassName(), "foocontroller");
		
		// Set the user controller name to bar. Expected controller name should be bar
		Utils::setGet("controller", "bar");
		$route = $router->getRoute(Utils::getGet("controller"), Utils::getGet("action"));
		$this->assertSame($route->getControllerName(), "bar");
		$this->assertSame($route->getControllerClassName(), "barcontroller");
		
		// Set the user controller name to fancy. Expected controller name should be bar
		Utils::setGet("controller", "fancy");
		$route = $router->getRoute(Utils::getGet("controller"), Utils::getGet("action"));
		$this->assertSame($route->getControllerName(), "bar");
		$this->assertSame($route->getControllerClassName(), "barcontroller");
	}
}

?>

<?php

require("routertest/foocontroller.php");
require("routertest/barcontroller.php");
require("routertest/foobarcontroller.php");

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
		$configuration = new Configuration("Web-CMS", "/foobar/show/5", "127.0.0.1", "root", "123456", "webcms");
		
		// Create the router
		$router = new Router($configuration);
		
		// Set the user controller name empty (Configuration problem). Expected controller name should be foobar
		$route = $router->getRoute(null);
		$this->assertSame($route->getControllerName(), "foobar");
		$this->assertSame($route->getControllerClassName(), "foobarcontroller");
		
		// Set the user controller name to a slash (Default URI value). Expected controller name should be foobar
		$route = $router->getRoute("/");
		$this->assertSame($route->getControllerName(), "foobar");
		$this->assertSame($route->getControllerClassName(), "foobarcontroller");
		
		// Set the user controller name to foo (Correct controller). Expected controller name should be foo
		$route = $router->getRoute("/foo");
		$this->assertSame($route->getControllerName(), "foo");
		$this->assertSame($route->getControllerClassName(), "foocontroller");
		
		// Set the user controller name to bar (Correct controller). Expected controller name should be bar
		$route = $router->getRoute("/bar");
		$this->assertSame($route->getControllerName(), "bar");
		$this->assertSame($route->getControllerClassName(), "barcontroller");
		
		// Set the user controller name to fancy (Non existing controller). Expected controller name should be foo
		$route = $router->getRoute("/fancy");
		$this->assertSame($route->getControllerName(), "foobar");
		$this->assertSame($route->getControllerClassName(), "foobarcontroller");
	}
}

?>

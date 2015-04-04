<?php

/**
 * The class PluginTest is a test all MVC components
 */
class MvcTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test for the MVC components.
	 */
	public function testMvc()
	{
		$configuration = new Configuration("Web-CMS", "/admin/index", "127.0.0.1", "root", "123456", "webcms_test");
		
		$databasemanager = new DatabaseManager($configuration);
		
		$text1 = new Text();
		$text1->setTitle("text1");
		$text1->setMarkdownText("This is a test.");
		
		$text2 = new Text();
		$text2->setTitle("text2");
		$text2->setMarkdownText("This is another test");
		
		$databasemanager->saveEntry($text1);
		$databasemanager->saveEntry($text2);
		
		$textid1 = $databasemanager->getEntryById("Text", $text1->getId());
		$this->assertSame($textid1, $text1);
		
		$textswithout1 = $databasemanager->getEntriesWithoutId("Text", $text1->getId());
		$this->assertSame($textswithout1[0], $text2);
		
		$this->assertSame(count($databasemanager->getEntries("Text")), 2);
		
		try
		{
			$texts = $databasemanager->getOneEntry("Text");
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		try
		{
			$databasemanager->deleteEntry(null);
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		$databasemanager->deleteEntry($text1);
		$databasemanager->deleteEntry($text2);
		
		try
		{
			$databasemanager->saveEntry(null);
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		$viewmanager = new ViewManager($configuration);
		
		$menumanager = new MenuManager($databasemanager, $configuration);
		
		$router = new Router($configuration);
		
		$route = null;
		
		try
		{
			$route = $router->getRoute("/admin/index");
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		try
		{
			require_once("mvctest/wrongcontroller.php");
			$route = $router->getRoute("wrong/index");
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		try
		{
			$route = $router->getRoute("wrong/index");
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		require_once("mvctest/adminmodel.php");
		require_once("mvctest/admincontroller.php");
		
		try
		{
			$route = $router->getRoute("wrong/lll");
			$this->assertTrue(true, false);
		}
		catch(Exception $exception) { }
		
		$route = $router->getRoute(Utils::getServer($configuration->getDefaultUri()));
		
		$menus = $menumanager->getMenus();
		
		$datacontainer = new DataContainer($route, $menus);
		
		$view = $viewmanager->createView($datacontainer);
		$view->setData("FOO", "BAR");
		$this->assertSame($view->getTemplateDirectory(), "public/html/");
		$this->assertSame($view->getTemplateName(), "index.html");
		$this->assertSame($view->getSubtemplateDirectory(), "app/views/");
		$this->assertSame($view->getSubtemplateName(), "adminindex.html");
		$this->assertSame(count($view->getData()), 4);
		
		$controllerclassname = $route->getControllerClassName();
		$controller = new $controllerclassname($databasemanager, $datacontainer, $view);
		$this->assertSame($controller->getDatabaseManager(), $databasemanager);
		$this->assertSame($controller->getDataContainer(), $datacontainer);
		$this->assertSame($controller->getView(), $view);
		
		$model = new AdminModel($controller);
		$this->assertSame($model->getDatabaseManager(), $databasemanager);
		$this->assertSame($model->getDataContainer(), $datacontainer);
		
		$actionname = $route->getActionName();
		$controller->$actionname();
		
		$html = $viewmanager->parseView($view);
		$this->assertContains("Anmelden", $html);
	}
}

?>

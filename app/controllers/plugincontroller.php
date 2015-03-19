<?php

/**
 * The class PluginMenu is responsible for the plugin management.
 */
class PluginController extends Controller
{
	/**
	 * Show the plugins.
	 */
	public function index()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$pluginmodel = new PluginModel($this);
			$this->getView()->setData("PLUGINS", $pluginmodel->getPlugins());
		}
		else
		{
			$this->getView()->setData("ERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>

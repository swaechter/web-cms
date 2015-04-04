<?php

/**
 * The class PluginMenu is responsible for the plugin management.
 */
class PluginController extends Controller implements SystemController
{
	/**
	 * Show the plugin admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$pluginmodel = new PluginModel($this);
			$this->getView()->setData("PLUGINS", $pluginmodel->getPlugins());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
}

?>

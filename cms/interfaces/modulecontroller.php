<?php

/**
 * The class ModuleController provides a controller that can be listed as
 * user and admin controller.
 */
interface ModuleController
{
	/**
	 * Index action that should be accessible without privileges.
	 */
	public function index();
	
	/**
	 * Admin index action that should only be accessible with privileges.
	 */
	public function adminindex();
}

?>

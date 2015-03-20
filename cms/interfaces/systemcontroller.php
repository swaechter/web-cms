<?php

/**
 * The class SystemController provides a controller that can be listed as
 * admin controller.
 */
interface SystemController
{
	/**
	 * Admin index action that should only be accessible with privileges.
	 */
	public function adminindex();
}

?>

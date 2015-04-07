<?php

/**
 * The file modulecontroller.php contains an interface that defines
 * a controller which can be used as normal and as admin site.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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

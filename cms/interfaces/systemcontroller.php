<?php

/**
 * The file systemcontroller.php contains an interface that defines
 * a controller which can be used as admin interface. The interface does
 * not provide an user action like the module controller.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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

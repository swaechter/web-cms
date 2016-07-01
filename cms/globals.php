<?php

/**
 * The file globals.php contains several variables that are used accross the
 * system.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * This variable represents the directory where the CMS is located.
 *
 * @var string
 */
define("CMS_DIRECTORY", "cms/");

/**
 * This variable represents the directory where the CMS entities are located.
 *
 * @var string
 */
define("CMS_ENTITY_DIRECTORY", "cms/entities/");

/**
 * This variable represents the directory where the application is located.
 *
 * @var string
 */
define("APP_DIRECTORY", "app/");

/**
 * This variable represents the directory where the application entities are located.
 *
 * @var string
 */
define("APP_ENTITY_DIRECTORY", "app/entities/");

/**
 * This variable represents the directory where the plugin data are located.
 *
 * @var string
 */
define("DATA_DIRECTORY", "public/data/");

/**
 * This variable represents the directory where the main template file is located.
 *
 * @var string
 */
define("TEMPLATE_DIRECTORY", "public/html/");

/**
 * This variable represents the directory where all view templates are located.
 *
 * @var string
 */
define("SUBTEMPLATE_DIRECTORY", "app/views/");

/**
 * This variable represents the main template name.
 *
 * @var string
 */
define("INDEX_TEMPLATE_NAME", "index");

/**
 * This variable represents the template file extension.
 *
 * @var string
 */
define("TEMPLATE_EXTENSION", ".html");

/**
 * This variable represents the delimiter in the URI
 *
 * @var string
 */
define("URI_DELIMITER", "/");

/**
 * This variable represents the plugin suffix.
 *
 * @var string
 */
define("PLUGIN_SUFFIX", "plugin");

/**
 * This variable represents the controller suffix.
 *
 * @var string
 */
define("CONTROLLER_SUFFIX", "controller");

/**
 * This variable represents the default controller name.
 *
 * @var string
 */
define("DEFAULT_CONTROLLER_NAME", "index");

/**
 * This variable represents the default system action name.
 *
 * @var string
 */
define("DEFAULT_SYSTEM_ACTION_NAME", "adminindex");

/**
 * This variable represents the default module action name.
 *
 * @var string
 */
define("DEFAULT_MODULE_ACTION_NAME", "index");

/**
 * This variable represents the name of the file entry point.
 *
 * @var string
 */
define("DEFAULT_FILE_NAME", "index.php");

?>

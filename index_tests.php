<?php

if(php_sapi_name() == "cli")
{
	echo(shell_exec("vendor" . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "phpunit --bootstrap cms" . DIRECTORY_SEPARATOR . "website.php"));
}
else
{
	echo("Please execute this code from the PHP command line.");
}

?>

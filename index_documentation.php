<?php

if(php_sapi_name() == "cli")
{
	echo(exec("vendor" . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "phpdoc -d cms/ -t doc/"));
}
else
{
	echo("Please execute this code from the PHP command line.");
}

?>

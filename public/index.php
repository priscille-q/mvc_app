<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \priscille_q\mvc_app\Bootstrap;

try
{
	(new Bootstrap)->run();
}
catch (Exception $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
	exit(0);
}
catch (InvalidArgumentException $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
	exit(0);
}

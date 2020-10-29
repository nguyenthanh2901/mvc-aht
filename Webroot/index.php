<?php
require __DIR__ . '../../vendor/autoload.php';
// echo ROOT;
define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
// require(ROOT . 'Config/core.php');
use MVC\Config\Core;

// require(ROOT . 'router.php');
// require(ROOT . 'request.php');
// require(ROOT . 'dispatcher.php');
use MVC\Router;
use MVC\Request;
use MVC\Dispatcher;

$dispatch = new Dispatcher();
$dispatch->dispatch();

?>
<?php

define('ROOT', dirname(__FILE__));


require ROOT . '/lib/Dev.php';
require ROOT . '/components/Router.php';

error_reporting(E_ALL ^ E_DEPRECATED);
require_once(ROOT . '/components/Autoload.php');

session_start();

$router = new Router;
$router->run();
?>

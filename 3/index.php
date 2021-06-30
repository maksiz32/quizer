<?php
require_once 'config/config.php';
require_once 'autoload.php';

$urlArray = explode('/', $_SERVER['REQUEST_URI']);
$controller = $urlArray[1];

$controller = ($controller === "") ? "home" : $controller;
$routes = require './routes.php';

if (isset($routes[$controller])) {
    require_once $routes[$controller];
} else {
    require_once 'controller/MainController.php';
}

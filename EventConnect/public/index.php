<?php
session_start();
require_once '../Core/Router.php';
//require_once '../Controllers/HomeController.php';

$router = new Router();
$router->routes();

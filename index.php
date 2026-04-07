<?php

session_start();

require __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

use App\Core\Router;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->run();

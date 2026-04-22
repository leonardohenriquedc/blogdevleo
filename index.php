<?php

session_start();

require __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use App\Core\Router;

if (!App\Core\Session::get("csrf_token")) {
    App\Core\Session::set("csrf_token", bin2hex(random_bytes(32)));
}

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

$router->addRouter("/blogs/to_home", []);
$router->addRouter("/blogs/to_blog", []);
$router->addRouter("/blogs_admin/new_blog", ["Authorization", "IdempotencyKey"]);
$router->addRouter("/blogs_admin/save_blog", ["Authorization", "IdempotencyKey"]);

$router->run();

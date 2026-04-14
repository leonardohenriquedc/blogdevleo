<?php

namespace App\Core;

use Exception;

class Controller
{
    public function view($view, $data = [])
    {
        if (
            !file_exists(__DIR__ . "/../../view/components/" . $view . ".php")
        ) {
            die("View not found");
        }
        $view = "/components/" . $view . ".php";
        extract($data);
        require_once __DIR__ . "/../../view/main.php";
    }

    public function dd(mixed $data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }

    public function handle(string $middleware)
    {
        $middleware = "App\\Core\\Middlewares\\" . $middleware;

        if (!class_exists($middleware)) {
            error_log("Middleware not found: " . $middleware);
            redirect("/blogs/to_home");
            exit();
        }

        $instance = new $middleware();

        return $instance->execute();
    }
}

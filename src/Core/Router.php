<?php

namespace App\Core;

class Router
{
    public function run()
    {
        $url = trim($_SERVER["REQUEST_URI"] ?? "auth/login", "/");

        $url = explode("/", $url);

        $controller = "App\\Controller\\" . ucfirst($url[0]);

        $method = $url[1] ?? "index";

        $params = array_slice($url, 2);

        if (!class_exists($controller)) {
            die("Controller not found: " . $controller);
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $method)) {
            die("Method not found: " . $method);
        }

        call_user_func_array([$controllerInstance, $method], $params);
    }

    private function dd(mixed $data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }
}

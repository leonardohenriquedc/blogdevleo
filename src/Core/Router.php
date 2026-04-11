<?php

namespace App\Core;
use App\Core\Middlewares\CsrfMiddleware;

class Router
{
    public function run()
    {
        $url = trim($_SERVER["REQUEST_URI"] ?? "", "/");

        if (
            in_array($_SERVER["REQUEST_METHOD"], [
                "POST",
                "PUT",
                "DELETE",
                "PATCH",
            ])
        ) {
            new CsrfMiddleware()->execute();
        }

        if ($url === "") {
            $url = "blogs/to_home";
        }

        $url = explode("/", $url);

        $controller =
            "App\\Controller\\" . ucfirst($this->snakeToCamel($url[0]));

        $method = $this->snakeToCamel($url[1] ?? "to_home");

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

    function snakeToCamel(string $string): string
    {
        return lcfirst(str_replace("_", "", ucwords($string, "_")));
    }

    private function dd(mixed $data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }
}

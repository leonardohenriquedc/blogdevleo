<?php

namespace App\Core;
use App\Core\Middlewares\CsrfMiddleware;

class Router
{
    public array $routers = [];

    public function run()
    {
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

        $url = trim($_SERVER["REQUEST_URI"] ?? "", "/");

        if ($url === "" || $url === "/") {
            $url = "blogs/to_home";
        }

        $url = explode("/", $url);        

        $controller =
            "App\\Controller\\" . ucfirst($this->snakeToCamel($url[0]));

        $method = $this->snakeToCamel($url[1] ?? "to_home");

        $params = array_slice($url, 2);

        $this->verifyAndRunMiddlaware($url[0] ?? "blogs", $url[1] ?? "to_home");

        $this->instanceController($controller, $method, $params);
    }

    private function verifyAndRunMiddlaware(
        string $controller,
        string $method
    ) {

        $path = "/" . $controller . "/" . $method;
        $middlewares = $this->routers[$path] ?? [];

        if (empty($middlewares)) {
            return;
        }

        foreach ($middlewares as $middleware) {
            if (!class_exists($middleware)) {
                break;
            }

            $middlewareInstance = new $middleware();
            $middlewareInstance->execute();
        }

    }

    public function addRouter(string $router, array $middlewares)
    {
        $this->routers[$router] = $middlewares;
    }

    private function instanceController(
        string $controller,
        string $method,
        array $params,
    ) {
        if (!class_exists($controller)) {
            die("Controller not found: " . $controller);
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $method)) {
            die("Method not found: " . $method);
        }

        call_user_func_array([$controllerInstance, $method], $params);
    }

    private function snakeToCamel(string $string): string
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

<?php

namespace App\Core\Middlewares;

use App\Core\Session;
use App\Service\Auth as AuthService;

class AuthMiddleware
{
    public function execute()
    {
        $token = $_COOKIE["token"] ?? "";
        if (!$token) {
            header("Location: /auth/login");
            exit();
        }

        $authService = new AuthService();

        $newToken = $authService->validateToken($token);
        if (!$newToken) {
            header("Location: /auth/login");
            exit();
        }

        setcookie("token", $newToken, time() + 3600, "/");
    }
}

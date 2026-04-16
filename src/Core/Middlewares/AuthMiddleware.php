<?php

namespace App\Core\Middlewares;

use App\Core\Session;
use App\Model\User;

class AuthMiddleware
{
    public function execute()
    {
        $token = $_COOKIE["token"] ?? "";
        if (!$token) {
            header("Location: /auth/login");
            exit();
        }

        $user = new User();

        $newToken = $user->validateToken($token);
        if (!$newToken) {
            header("Location: /auth/login");
            exit();
        }

        setcookie("token", $newToken, time() + 3600, "/");
    }
}

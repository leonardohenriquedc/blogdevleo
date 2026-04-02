<?php

require_once __DIR__ . "/../service/AuthServer.php";

use App\Server\Auth\AuthServer;

class Auht
{
    public static function login()
    {
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;

        if ($email === null || $password === null) {
            throw new Exception("Layers null");
        }

        $userDto = new UserDTO($email, $password);

        $authServer = new AuthServer();

        $token = $authServer->validateLogin($userDto);

        header("Authorization: Bearer" . $token);
    }

    private static function renderPageNewBlog()
    {
        require_once __DIR__ . "/../view/new_blog.php";
    }
}

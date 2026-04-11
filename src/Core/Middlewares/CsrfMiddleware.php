<?php

namespace App\Core\Middlewares;

use App\Core\Session;

class CsrfMiddleware
{
    public function execute()
    {
        $tokenSession = Session::get("csrf_token");
        $tokenRequest = $_POST["csrf_token"] ?? "";

        if (!$tokenSession) {
            http_response_code(403);
            die("CSRF token ausente na sessão");
        }

        if (!$tokenRequest || !hash_equals($tokenSession, $tokenRequest)) {
            http_response_code(403);
            die("CSRF Token inválido");
        }

        return true;
    }
}

<?php

namespace App\Core\Middlewares

use App\Core\Session;

class IdempotencyKeyMiddleware{
    public function execute() {
        $session = new Session();

        $idempotencyKeySession = $session->get("IdempotencyKey") ?? "";
        $headers = getHeaders();
        $idempotencyKey = $headers['IdempotencyKey'] ?? "";

        if(empty($idempotencyKey)){
            redirect("/blogs/to_error");
        }

        if($idempotencyKey !== $idempotencyKeySession){
            redirect("/blogs/to_error");
        }

        if(empty($idempotencyKeySession)){
            $session->set("IdempotencyKey", $idempotencyKey);
        }
    }
}

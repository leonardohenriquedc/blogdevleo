<?php

namespace App\Service;
require_once __DIR__ . "/../../db/crud/User.php";
use PDO;
use Exception;

use Firebase\JWT\JWT;
use App\Model\User as UserModel;
use Db\Crud\User as UserCrud;
use App\Dto\Login;

class Auth
{
    public function validateLogin(Login $loginUser): string
    {
        $userCrud = new UserCrud();

        $userModel = $userCrud->findByEmail($loginUser->email) ?? null;

        if (!$userModel) {
            throw new Exception("User not found");
        }

        $passwordEncripted = password_hash(
            $loginUser->password,
            PASSWORD_BCRYPT,
        );

        if (!password_verify($loginUser->password, $passwordEncripted)) {
            throw new Exception("Invalid password");
        }

        error_log(
            "Este e o objeto email: " .
                $userModel->email .
                "\nSenha: " .
                $userModel->password,
        );

        return $this->generateToken($userModel->email);
    }

    public function validateToken(string $token): ?string
    {
        $secretKey = $_ENV["SECRET_KEY"];
        $decode = JWT::decode($token, $secretKey, ["HS256"]);

        $user = new UserCrud()->findByEmail($decode->email);

        if ($user === null) {
            throw new Exception("User not found");
        }

        if ($decode->exp < time()) {
            throw new Exception("Time token expired");
        }

        return $this->generateToken($user->email);
    }

    private function generateToken(string $email): string
    {
        $secretKey = $_ENV["SECRET_KEY"];
        return JWT::encode(
            [
                "email" => $email,
                "iat" => time(),
                "exp" => time() + 3600, // Token expires in one hour
            ],
            $secretKey,
            "HS256",
        );
    }
}

<?php

namespace App\Server\Auth;

use PDO;
use Exception;

require_once __DIR__ . "/../db/crud/User.php";
require_once __DIR__ . "/../models/User.php";

use Firebase\JWT\JWT;
use App\Model\User as UserModel;
use Db\Crud\User as UserCrud;
use App\Dto\Login;

class AuthServer
{
    private ?PDO $connection = null;

    public function validateLogin(Login $loginUser): string
    {
        $userCrud = new UserCrud();

        $userModel = $userCrud->findByEmail($loginUser->email);

        if ($userModel === null) {
            throw new Exception("User not found");
        }

        $passwordEncripted = password_hash($login->password, PASSWORD_BCRYPT);

        if (!password_verify($login->password, $passwordEncripted)) {
            throw new Exception("Invalid password");
        }

        return JWT::encode(
            [
                "email" => $userModel->email,
                "iat" => time(),
                "exp" => time() + 3600, // Token expires in one hour
            ],
            "mozovohehe",
            "HS256",
        );
    }
}

<?php

namespace App\Model;

use DateTime;
use PDO;
use App\Core\Exceptions\CrendentialsExceptions;

use Firebase\JWT\JWT;
use Db\Repository\User as UserCrud;
use App\Dto\Login;
use Firebase\JWT\Key;

class User
{
    public string $name;
    public string $email;
    public string $password;

    public int $attemps;

    public DateTime $last_attemp;

    public DateTime $blocked_until;

    public function __construct(
        string $name = "",
        string $email = "",
        string $password = "",
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function hasEmpty(): bool
    {
        return empty($this->name) ||
            empty($this->email) ||
            empty($this->password);
    }

    public function validateLogin(): ?string
    {
        if (empty($this->email) || empty($this->password)) {
            return null;
        }

        $userCrud = new UserCrud();

        $userModel = $userCrud->findByEmail($this->email) ?? null;

        if (!$userModel) {
            throw new CrendentialsExceptions("User not found");
        }

        $passwordEncripted = password_hash($this->password, PASSWORD_BCRYPT);

        if (!password_verify($userModel->password, $passwordEncripted)) {
            throw new CrendentialsExceptions("Invalid password");
        }

        //debug
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
        $decode = JWT::decode($token, new Key($secretKey, "HS256"));

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

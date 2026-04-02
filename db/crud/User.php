<?php

namespace Db\Crud;

require_once __DIR__ . "/../../config/Database.php";

use App\Model\User as UserModel;

class User
{
    private PDO $connection;

    public function __construct()
    {
        $this->$connection = Database::getConnection();
    }

    public function findByEmail(string $email): ?UserModel
    {
        $stmt = $this->connection->prepare(
            "SELECT name, email, password FROM users WHERE email = :email",
        );

        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new UserModel($data["name"], $data["email"], $data["password"]);
    }

    public function save(Login $login): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO users(user, email, password) VALUES (:user, :email, :password)",
        );

        $stmt->bindParam([
            ":user" => $login->user,
            ":email" => $login->email,
            ":password" => $login->password,
        ]);
        return $stmt->execute([
            ":user" => $login->user,
            ":email" => $login->email,
            ":password" => $login->password,
        ]);
    }
}

<?php

namespace Config;
use Exception;
use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $db_user = $_ENV["DB_USER"];
        $db_host = $_ENV["DB_HOST"];
        $db_port = $_ENV["DB_PORT"];
        $db_pass = $_ENV["DB_PASS"];
        $db_name = $_ENV["DB_DATABASE"];

        if (!$db_user || !$db_host || !$db_pass || !$db_port || !$db_name) {
            throw new Exception("Variável de ambiente DB_URL não definida");
        }

        try {
            $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8";
            self::$connection = new PDO($dsn, $db_user, $db_pass);

            self::$connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
            );
            self::$connection->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC,
            );

            return self::$connection;
        } catch (PDOException $e) {
            throw new Exception(
                "Erro ao conectar no banco: " . $e->getMessage(),
            );
        }
    }
}

<?php

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $url_db = getenv('DB_URL');

        if (!$url_db) {
            throw new Exception("Variável de ambiente DB_URL não definida");
        }

        try {
            self::$connection = new PDO($url_db);

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return self::$connection;
        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar no banco: " . $e->getMessage());
        }
    }
}

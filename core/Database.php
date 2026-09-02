<?php

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../config/config.php';
            $db = $config['db'];

            $dsn = "mysql:host={$db['host']};dbname={$db['name']};charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            if (!empty($db['ssl_ca'])) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = $db['ssl_ca'];
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
            }

            self::$connection = new PDO($dsn, $db['user'], $db['pass'], $options);
        }

        return self::$connection;
    }
}

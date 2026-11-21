<?php
namespace App\Config;

class Database 
{
    private static ?\mysqli $conn = null;
    private static string $host = '';
    private static int $port = 3306;
    private static string $database = '';
    private static string $user = '';
    private static string $password = '';


    public static function getConnection(): \mysqli
    {
        if (self::$conn instanceof \mysqli) {
            return self::$conn;
        }

        try {
            self::$host = getenv('DB_HOST') ?: 'db';
            self::$port = (int) (getenv('DB_PORT') ?: 3306);
            self::$database = getenv('DB_DATABASE') ?: 'meubanco';
            self::$user = getenv('DB_USERNAME') ?: 'user';
            self::$password = getenv('DB_PASSWORD') ?: '123456';

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            self::$conn = new \mysqli(
                self::$host,
                self::$user,
                self::$password,
                self::$database,
                self::$port
            );
            self::$conn->set_charset('utf8mb4');
        } catch (\mysqli_sql_exception $exception) {
            throw new \RuntimeException('Erro de conexão com o banco de dados MySQL.', 0, $exception);
        }

        return self::$conn;
    }
}
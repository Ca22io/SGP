<?php
namespace App\Config;

use PDO;
use PDOException;

class Database 
{
    private static ?PDO $conn = null;
    private static string $host = 'db';
    private static string $port = '5432';
    private static string $database = 'meubanco';
    private static string $user = 'user';
    private static string $password = '123456';


    public static function getConnection(): PDO
    {
        if (self::$conn instanceof PDO) {
            return self::$conn;
        }

        try {
            self::$conn = new PDO(
                'pgsql:host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$database,
                self::$user,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch(PDOException $exception) {
            throw new RuntimeException('Erro de conexão com o banco de dados.', 0, $exception);
        }

        return self::$conn;
    }
}
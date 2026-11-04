<?php

declare(strict_types=1);

final class Database
{
    public static function connect(): PDO
    {
        $host = getenv('DB_HOST') ?: 'db';
        $port = getenv('DB_PORT') ?: '5432';
        $database = getenv('POSTGRES_DB') ?: 'meubanco';
        $user = getenv('POSTGRES_USER') ?: 'user';
        $password = getenv('POSTGRES_PASSWORD') ?: '123456';

        return new PDO(
            "pgsql:host={$host};port={$port};dbname={$database}",
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}
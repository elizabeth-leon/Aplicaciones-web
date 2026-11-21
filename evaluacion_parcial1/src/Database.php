<?php
declare(strict_types=1);

// La conexión se utiliza desde los repositorios.
final class Database
{
    private static ?PDO $conexion = null;

    public static function conectar(): PDO
    {
        if (self::$conexion === null) {
            $config = require __DIR__ . '/../config/database.php';
            $dsn = 'mysql:host=' . $config['host']
                . ';port=' . $config['port']
                . ';dbname=' . $config['database'] . ';charset=utf8mb4';
            self::$conexion = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        }
        return self::$conexion;
    }
}

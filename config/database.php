<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'touchepasauklaxon');
define('DB_USER', 'root');
define('DB_PASS', '');


class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $this->connection = new PDO(
           'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            'root',
            ''
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

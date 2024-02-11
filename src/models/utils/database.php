<?php

require_once 'src/models/utils/dotEnv.php';
class Database {
    private static $instance;
    private $connection;

    private function __construct() {

        $host = Dotenv::get('DB_HOST');
        $port = Dotenv::get('DB_PORT');
        $database = Dotenv::get('DB_DATABASE');
        $username = Dotenv::get('DB_USERNAME');
        $password = Dotenv::get('DB_PASSWORD');
/* 
        $host = "127.0.0.1"; //getenv('DB_HOST');
        $port = "3306"; //getenv('DB_PORT');
        $database = "shop"; //getenv('DB_DATABASE');
        $username = "root"; //getenv('DB_USERNAME');
        $password = "root"; //getenv('DB_PASSWORD'); */

        $this->connection = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance->connection;
    }
}

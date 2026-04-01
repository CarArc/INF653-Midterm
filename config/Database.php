<?php

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $port;
    public  $conn;

    public function __construct() {
        $this->host     = getenv('DB_HOST') ?: 'localhost';
        $this->db_name  = getenv('DB_NAME') ?: 'quotesdb';
        $this->username = getenv('DB_USER') ?: 'postgres';
        $this->password = getenv('DB_PASS') ?: '';
        $this->port     = getenv('DB_PORT') ?: '5432';
    }

    public function connect() {
        $this->conn = null;

        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Database Connection Error: ' . $e->getMessage()]);
            exit;
        }

        return $this->conn;
    }
}

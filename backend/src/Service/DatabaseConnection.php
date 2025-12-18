<?php

namespace App\Service;

use PDO;
use PDOException;
use RuntimeException;

class DatabaseConnection
{
    private PDO $pdo;
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private int $port;

    public function __construct(string $host, string $dbname, string $user, string $password, int $port)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
    }

    /**
     * @return void
     */
    private function execute():void
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            throw new RuntimeException('database connexion failed : ' . $e->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        if (!isset($this->pdo)) {
            $this->execute();
        }
        return $this->pdo;
    }
}

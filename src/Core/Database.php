<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private PDO $pdo;

    public function __construct(private array $config)
    {
        $this->pdo = $this->connect();
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }

    public function migrate(): void
    {
        $driver = $this->config['driver'] ?? 'sqlite';

        if ($driver === 'mysql') {
            $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS subscriptions (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(150) NOT NULL,
                email VARCHAR(190) NOT NULL,
                phone VARCHAR(40) NOT NULL,
                message TEXT NULL,
                origin VARCHAR(120) DEFAULT 'landing',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_email (email)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            SQL;
        } else {
            $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS subscriptions (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                full_name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT NOT NULL,
                message TEXT,
                origin TEXT DEFAULT 'landing',
                created_at TEXT NOT NULL
            );
            SQL;
        }

        $this->pdo->exec($sql);
    }

    private function connect(): PDO
    {
        $driver = $this->config['driver'] ?? 'sqlite';

        try {
            return match ($driver) {
                'sqlite' => $this->connectSqlite(),
                default => $this->connectDsn(),
            };
        } catch (PDOException $exception) {
            throw new RuntimeException('Connessione al database fallita: ' . $exception->getMessage());
        }
    }

    private function connectSqlite(): PDO
    {
        $databasePath = $this->config['database'] ?? null;

        if (!$databasePath) {
            throw new RuntimeException('Config database mancante per SQLite.');
        }

        $directory = dirname($databasePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        if (!file_exists($databasePath)) {
            touch($databasePath);
        }

        return new PDO('sqlite:' . $databasePath, null, null, $this->config['options'] ?? []);
    }

    private function connectDsn(): PDO
    {
        $dsn = $this->config['dsn'] ?? null;
        if (!$dsn) {
            throw new RuntimeException('Per driver non-SQLite è necessario definire `dsn`.');
        }

        $username = $this->config['username'] ?? null;
        $password = $this->config['password'] ?? null;

        return new PDO($dsn, $username, $password, $this->config['options'] ?? []);
    }
}

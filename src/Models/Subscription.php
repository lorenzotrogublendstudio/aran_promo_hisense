<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Subscription
{
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->pdo();
    }

    public function create(array $attributes): int
    {
        $sql = <<<SQL
        INSERT INTO subscriptions (full_name, email, phone, message, origin, created_at)
        VALUES (:full_name, :email, :phone, :message, :origin, :created_at);
        SQL;

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':full_name' => $attributes['full_name'],
            ':email' => $attributes['email'],
            ':phone' => $attributes['phone'],
            ':message' => $attributes['message'] ?? null,
            ':origin' => $attributes['origin'] ?? 'landing',
            ':created_at' => date('c'),
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}

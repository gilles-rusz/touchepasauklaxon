<?php

namespace App\Models;

use PDO;

class Agence
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM agences ORDER BY nom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agences WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(string $nom): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO agences (nom) VALUES (?)");
        return $stmt->execute([$nom]);
    }

    public function update(int $id, string $nom): bool
    {
        $stmt = $this->pdo->prepare("UPDATE agences SET nom = ? WHERE id = ?");
        return $stmt->execute([$nom, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM agences WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

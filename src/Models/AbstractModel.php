<?php
declare(strict_types=1);

namespace App\Models;

use PDO;


/**
 * Classe abstraite pour mutualiser l'accès aux données et les méthodes CRUD de base.
 */
abstract class AbstractModel
{
    protected string $table;

    protected function getDb(): PDO
    {
        return Database::getInstance();
    }

    /**
     * Récupère tous les enregistrements de la table.
     */
    public function findAll(): array
    {
        $stmt = $this->getDb()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve un enregistrement par son ID.
     */
    public function find(int $id): ?array
    {
        $stmt = $this->getDb()->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }

    /**
     * Supprime un enregistrement par son ID.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->getDb()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

class Agence extends AbstractModel
{
    protected string $table = 'agences';

    /**
     * Crée une nouvelle agence.
     */
    public function create(string $nom): bool
    {
        $db = $this->getDb();
        $stmt = $db->prepare("INSERT INTO agences (nom) VALUES (:nom)");
        return $stmt->execute(['nom' => $nom]);
    }

    /**
     * Supprime une agence par son ID.
     */
    public function delete(int $id): bool
    {
        $db = $this->getDb();
        $stmt = $db->prepare("DELETE FROM agences WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
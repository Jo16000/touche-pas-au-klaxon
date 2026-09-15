<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

class User extends AbstractModel
{
    protected string $table = 'users';

    /**
     * Récupère tous les utilisateurs
     */
    public function findAll(): array
    {
        $stmt = $this->getDb()->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve un utilisateur par son email
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user !== false ? $user : null;
    }

    /**
     * Met à jour le rôle d'un utilisateur par son ID
     */
    public function updateRole(int $userId, string $role): bool
    {
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        $stmt = $this->getDb()->prepare($sql);
        return $stmt->execute([
            'role' => $role,
            'id' => $userId
        ]);
    }
}
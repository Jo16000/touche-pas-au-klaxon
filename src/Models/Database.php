<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;

/**
 * Classe de gestion de la connexion à la base de données.
 */
class Database
{
    private static ?PDO $instance = null;

    /**
     * Retourne une instance unique de connexion PDO (Pattern Singleton).
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $configPath = __DIR__ . '/../../config/database.php';
            if (file_exists($configPath)) {
                $config = require $configPath;
            } else {
                $config = [
                    'host' => 'localhost',
                    'dbname' => 'klaxon',
                    'user' => 'root',
                    'password' => ''
                ];
            }

            try {
                self::$instance = new PDO(
                    "mysql:host=" . ($config['host'] ?? 'localhost') . ";dbname=" . ($config['dbname'] ?? 'klaxon') . ";charset=utf8mb4",
                    $config['user'] ?? 'root',
                    $config['password'] ?? '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$instance;
    }

    /**
     * Teste et retourne un statut de connexion.
     */
    public static function checkConnection(): bool
    {
        try {
            self::getInstance();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
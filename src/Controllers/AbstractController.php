<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

abstract class AbstractController
{
    public function __construct()
    {
        // Actualise et normalise le rôle de l'utilisateur connecté à chaque chargement de page
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $userModel = new User();
            $freshUser = $userModel->find((int)$_SESSION['user']['id']);
            
            if ($freshUser && isset($freshUser['role'])) {
                $_SESSION['user']['role'] = strtolower(trim($freshUser['role']));
            }
        }
    }

    /**
     * Méthode pour afficher une vue avec des données
     */
    protected function render(string $view, array $data = []): void
    {
        // Extrait les données pour les rendre accessibles sous forme de variables dans la vue
        extract($data);

        // Chemin vers le fichier de vue
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "Erreur : La vue '{$view}' est introuvable.";
        }
    }
}
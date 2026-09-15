<?php
declare(strict_types=1);

session_start();

// Chargement automatique des classes via Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\RideController;
use App\Controllers\AdminController;

// Récupération de l'action demandée dans l'URL (par défaut 'home')
$action = $_GET['action'] ?? 'home';

// Instanciation des contrôleurs
$authController = new AuthController();
$rideController = new RideController();
$adminController = new AdminController();

// Routeur central
switch ($action) {
    // Pages publiques et principales
    case 'home':
        $rideController->home();
        break;

    // Authentification
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;

    // Gestion des trajets (Création, Modification, Suppression)
    case 'ride-create':
        $rideController->create();
        break;
    case 'ride-store':
        $rideController->store();
        break;
    case 'ride-edit':
        $rideController->edit((int)($_GET['id'] ?? 0));
        break;
    case 'ride-delete':
        $rideController->delete((int)($_GET['id'] ?? 0));
        break;

    // Espace Administrateur
    case 'admin-dashboard':
        $adminController->dashboard();
        break;
    case 'admin-agences':
    case 'admin-agencies':
        $adminController->agencies();
        break;
    case 'admin-rides':
        $adminController->rides();
        break;
    case 'admin-users':
        $adminController->users();
        break;
    case 'agence-delete':
        $adminController->deleteAgence();
        break;
    case 'admin-update-role':
        $adminController->updateRole();
        break;

    // Route par défaut si l'action n'existe pas
    default:
        header('HTTP/1.0 404 Not Found');
        echo "Erreur 404 : La page demandée n'existe pas.";
        break;
}
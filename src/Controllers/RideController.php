<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Ride;
use App\Models\Agence;

class RideController extends AbstractController
{
    public function home(): void
    {
        $rideModel = new Ride();
        $rides = $rideModel->findAll();

        require_once __DIR__ . '/../Views/layout/header.php';
        require_once __DIR__ . '/../Views/rides/home.php';
        require_once __DIR__ . '/../Views/layout/footer.php';
    }

    public function create(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /klaxon-v2/public/?action=login');
            exit;
        }

        $agenceModel = new Agence();
        $agences = $agenceModel->findAll();

        require_once __DIR__ . '/../Views/layout/header.php';
        require_once __DIR__ . '/../Views/rides/create.php';
        require_once __DIR__ . '/../Views/layout/footer.php';
    }

    public function store(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /klaxon-v2/public/?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            if (isset($_SESSION['user']['id'])) {
                $data['user_id'] = $_SESSION['user']['id'];
            }

            $rideModel = new Ride();
            $rideModel->create($data);
            $_SESSION['flash_success'] = "Trajet créé avec succès.";
            
            header('Location: /klaxon-v2/public/');
            exit;
        }

        header('Location: /klaxon-v2/public/?action=ride-create');
        exit;
    }

    public function edit(int $id): void
    {
        if ($id <= 0) {
            header('Location: /klaxon-v2/public/');
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /klaxon-v2/public/?action=login');
            exit;
        }

        $rideModel = new Ride();
        $ride = $rideModel->find($id);

        if (!$ride) {
            header('Location: /klaxon-v2/public/');
            exit;
        }

        // SÉCURITÉ : Seul l'auteur du trajet ou un admin peut le modifier
        $userId = $_SESSION['user']['id'];
        $userRole = $_SESSION['user']['role'] ?? 'user';

        if ($ride['user_id'] !== $userId && $userRole !== 'admin') {
            $_SESSION['flash_error'] = "Vous n'avez pas l'autorisation de modifier ce trajet.";
            header('Location: /klaxon-v2/public/');
            exit;
        }

        $agenceModel = new Agence();
        $agences = $agenceModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rideModel->update($id, $_POST);
            $_SESSION['flash_success'] = "Trajet mis à jour avec succès.";
            header('Location: /klaxon-v2/public/');
            exit;
        }

        require_once __DIR__ . '/../Views/layout/header.php';
        require_once __DIR__ . '/../Views/rides/edit.php';
        require_once __DIR__ . '/../Views/layout/footer.php';
    }

    public function delete(int $id): void
    {
        if ($id <= 0) {
            header('Location: /klaxon-v2/public/');
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /klaxon-v2/public/?action=login');
            exit;
        }

        $rideModel = new Ride();
        $ride = $rideModel->find($id);

        if (!$ride) {
            header('Location: /klaxon-v2/public/');
            exit;
        }

        // SÉCURITÉ : Seul l'auteur du trajet ou un admin peut le supprimer
        $userId = $_SESSION['user']['id'];
        $userRole = $_SESSION['user']['role'] ?? 'user';

        if ($ride['user_id'] !== $userId && $userRole !== 'admin') {
            $_SESSION['flash_error'] = "Vous n'avez pas l'autorisation de supprimer ce trajet.";
            header('Location: /klaxon-v2/public/');
            exit;
        }

        $rideModel->delete($id);
        $_SESSION['flash_success'] = "Trajet supprimé avec succès.";
        header('Location: /klaxon-v2/public/');
        exit;
    }
}
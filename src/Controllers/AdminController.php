<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Models\Agence;
use App\Models\Ride;

class AdminController extends AbstractController
{
    public function dashboard(): void
    {
        $userModel = new User();
        $users = $userModel->findAll();

        $rideModel = new Ride();
        $rides = $rideModel->findAll();

        $this->render('admin/dashboard', [
            'title' => 'Tableau de bord Admin',
            'users' => $users,
            'rides' => $rides
        ]);
    }

    public function agencies(): void
    {
        $agenceModel = new Agence();
        $agences = $agenceModel->findAll();

        $this->render('admin/agencies', [
            'title' => 'Gestion des agences',
            'agences' => $agences
        ]);
    }

    public function rides(): void
    {
        $rideModel = new Ride();
        $rides = $rideModel->findAll();

        $this->render('admin/rides', [
            'title' => 'Gestion des trajets',
            'rides' => $rides
        ]);
    }

    public function users(): void
    {
        $userModel = new User();
        $users = $userModel->findAll();

        $this->render('admin/users', [
            'title' => 'Gestion des utilisateurs',
            'users' => $users
        ]);
    }

    public function deleteAgence(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $agenceModel = new Agence();
            $agenceModel->delete($id);
            $_SESSION['flash_success'] = "Agence supprimée avec succès.";
        }
        header('Location: ?action=admin-agencies');
        exit;
    }

    public function updateRole(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = (int)($_POST['user_id'] ?? 0);
            $newRole = trim($_POST['role'] ?? '');

            if ($userId > 0 && in_array($newRole, ['user', 'admin', 'USER', 'ADMIN'], true)) {
                $userModel = new User();
                $userModel->updateRole($userId, $newRole);

                if (isset($_SESSION['user']) && (int)$_SESSION['user']['id'] === $userId) {
                    $_SESSION['user']['role'] = strtoupper($newRole);
                }

                $_SESSION['flash_success'] = "Rôle mis à jour avec succès.";
            } else {
                $_SESSION['flash_error'] = "Erreur lors de la mise à jour du rôle.";
            }
        }
        header('Location: ?action=admin-users');
        exit;
    }
}
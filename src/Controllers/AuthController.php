<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

class AuthController extends AbstractController
{
    public function login(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Stockage des informations de l'utilisateur en session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email' => $user['email'],
                    'role' => strtolower($user['role'] ?? 'user')
                ];

                $_SESSION['flash_success'] = "Connexion réussie ! Bienvenue " . $user['prenom'];

                // Redirection intelligente selon le rôle de l'utilisateur
                if ($_SESSION['user']['role'] === 'admin') {
                    header('Location: ?action=admin-dashboard');
                    exit;
                } else {
                    header('Location: ?action=home');
                    exit;
                }
            } else {
                $error = "Identifiants incorrects.";
            }
        }

        $this->render('auth/login', [
            'title' => 'Connexion',
            'error' => $error
        ]);
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
        
        // Redirection vers l'accueil après déconnexion
        header('Location: ?action=home');
        exit;
    }
}
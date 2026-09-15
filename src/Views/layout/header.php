<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Touche pas au klaxon</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Favicon personnalisé -->
    <link rel="icon" type="image/png" href="/klaxon-v2/public/favicon.png">

    <!-- Respect de la palette de couleurs imposée par le brief -->
    <style>
        :root {
            --bs-body-bg: #f1f8fc;
            --bs-primary: #00497c;
            --bs-secondary: #00497c;
            --bs-dark: #384050;
            --bs-danger: #cd2c2e;
            --bs-success: #82b864;
        }
        body {
            background-color: var(--bs-body-bg) !important;
            color: var(--bs-dark);
        }
        .btn-dark {
            background-color: var(--bs-dark) !important;
            border-color: var(--bs-dark) !important;
        }
        .table-dark {
            background-color: var(--bs-secondary) !important;
            border-color: var(--bs-secondary) !important;
        }
        .btn-primary {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }
        .btn-primary:hover {
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container my-4">
    <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border rounded-pill px-4 shadow-sm bg-light">
        <?php
        $homeLink = "/klaxon-v2/public/";
        // Si l'utilisateur est admin, le logo renvoie vers son tableau de bord admin
        if (isset($_SESSION['user']) && strtolower($_SESSION['user']['role'] ?? '') === 'admin') {
            $homeLink = "/klaxon-v2/public/?action=admin-dashboard";
        }
        ?>
        <a href="<?= $homeLink ?>" class="d-flex align-items-center text-dark text-decoration-none fs-5 fw-bold">
            Touche pas au klaxon
        </a>

        <!-- Menu de navigation central pour l'administrateur uniquement -->
        <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <?php if (isset($_SESSION['user']) && strtolower($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                <?php $currentAction = $_GET['action'] ?? ''; ?>
                <?php if ($currentAction !== 'admin-dashboard'): ?>
                    <a href="/klaxon-v2/public/?action=admin-dashboard" class="btn btn-primary btn-sm mx-1 rounded-pill px-3 text-white shadow-sm">Tableau de bord</a>
                <?php endif; ?>
                <a href="/klaxon-v2/public/?action=admin-users" class="btn btn-outline-secondary btn-sm mx-1 rounded-pill px-3">Utilisateurs</a>
                <a href="/klaxon-v2/public/?action=admin-agencies" class="btn btn-outline-secondary btn-sm mx-1 rounded-pill px-3">Agences</a>
                <a href="/klaxon-v2/public/?action=admin-rides" class="btn btn-outline-secondary btn-sm mx-1 rounded-pill px-3">Trajets</a>
            <?php endif; ?>
        </div>

        <div class="d-flex align-items-center">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/klaxon-v2/public/?action=ride-create" class="btn btn-dark btn-sm rounded-pill px-3 me-3">Créer un trajet</a>
                <span class="me-3 small fw-semibold text-muted">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></span>
                <a href="/klaxon-v2/public/?action=logout" class="btn btn-outline-dark btn-sm rounded-pill px-3">Déconnexion</a>
            <?php else: ?>
                <a href="/klaxon-v2/public/?action=login" class="btn btn-dark btn-sm rounded-pill px-4">Connexion</a>
            <?php endif; ?>
        </div>
    </header>

<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success border py-2 mb-4 rounded-pill text-center" role="alert">
        <?= htmlspecialchars($_SESSION['flash_success']) ?>
    </div>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger border py-2 mb-4 rounded-pill text-center" role="alert">
        <?= htmlspecialchars($_SESSION['flash_error']) ?>
    </div>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>

<main class="mb-5">
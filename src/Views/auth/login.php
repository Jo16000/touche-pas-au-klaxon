<?php
require_once __DIR__ . '/../layout/header.php';
?>

<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-5">
        <div class="card shadow-sm border rounded-4 p-5 bg-white">
            <h2 class="fw-bold mb-4 text-center" style="color: var(--bs-dark);">Connexion à Klaxon</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger border py-2 mb-4 rounded-pill text-center" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="?action=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Adresse email</label>
                    <input type="email" class="form-control rounded-pill px-3" id="email" name="email" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold">Mot de passe</label>
                    <input type="password" class="form-control rounded-pill px-3" id="password" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark rounded-pill py-2">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
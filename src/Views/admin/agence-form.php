<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 600px; margin: 30px auto; padding: 0 15px; font-family: Arial, sans-serif;">
    <h1 style="color: #00497c; margin-bottom: 20px;">
        <?= isset($agence) ? 'Modifier l\'agence' : 'Créer une nouvelle agence' ?>
    </h1>

    <p><a href="?action=admin-agencies" style="color: #0074c7; text-decoration: none;">&larr; Retour à la gestion des agences</a></p>

    <form action="?action=<?= isset($agence) ? 'admin-agence-update&id=' . $agence['id'] : 'admin-agence-store' ?>" method="POST" style="background: white; padding: 25px; border: 1px solid #ddd; border-radius: 8px; margin-top: 15px;">
        
        <div style="margin-bottom: 20px;">
            <label for="nom_ville" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Nom de la ville / de l'agence :</label>
            <input type="text" id="nom_ville" name="nom_ville" value="<?= htmlspecialchars($agence['nom'] ?? $agence['nom_ville'] ?? '') ?>" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="text-align: right;">
            <button type="submit" style="background-color: transparent; border: 1px solid #198754; color: #198754; padding: 6px 18px; border-radius: 20px; font-size: 14px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block;">
                <?= isset($agence) ? 'Mettre à jour' : 'Enregistrer' ?>
            </button>
        </div>

    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
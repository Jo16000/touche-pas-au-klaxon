<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 1100px; margin: 30px auto; padding: 0 15px; font-family: Arial, sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="color: #00497c; margin: 0;">Administration - Gestion des agences</h1>
        <a href="?action=admin-agence-create" style="background-color: #212529; border: 1px solid #212529; color: white; padding: 6px 14px; border-radius: 20px; font-size: 14px; text-decoration: none;">+ Ajouter une agence</a>
    </div>

    <p><a href="?action=admin-dashboard" style="color: #0074c7; text-decoration: none;">&larr; Retour au tableau de bord</a></p>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #ddd; margin-top: 10px;">
        <thead>
            <tr style="background: #f1f8fc; color: #00497c; text-align: left;">
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">ID</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Nom de l'agence</th>
                <th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($agences)): ?>
                <?php foreach ($agences as $agence): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; vertical-align: middle;"><?= htmlspecialchars((string)$agence['id']) ?></td>
                        <td style="padding: 10px; vertical-align: middle;"><?= htmlspecialchars($agence['nom_ville'] ?? $agence['nom'] ?? '') ?></td>
                        <td style="padding: 10px; text-align: right; vertical-align: middle;">
                            <!-- Bouton Modifier -->
                            <a href="?action=admin-agence-edit&id=<?= $agence['id'] ?>" style="background-color: transparent; border: 1px solid #ffc107; color: #ffc107; padding: 4px 14px; border-radius: 20px; font-size: 13px; text-decoration: none; display: inline-block; margin-right: 5px;">Modifier</a>
                            
                            <!-- Bouton Supprimer -->
                            <a href="?action=admin-agence-delete&id=<?= $agence['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');" style="background-color: transparent; border: 1px solid #dc3545; color: #dc3545; padding: 4px 14px; border-radius: 20px; font-size: 13px; text-decoration: none; display: inline-block;">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="padding: 15px; text-align: center; color: #666;">Aucune agence trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 900px; margin: 30px auto; padding: 0 15px; font-family: Arial, sans-serif;">
    <h1 style="color: #00497c;">Administration - Gestion des agences</h1>
    
    <p><a href="?action=admin-dashboard" style="color: #0074c7; text-decoration: none;">&larr; Retour au tableau de bord</a></p>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #ddd; margin-top: 20px;">
        <thead>
            <tr style="background: #f1f8fc; color: #00497c; text-align: left;">
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Nom de l'agence</th>
                <th style="padding: 10px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($agences)): ?>
                <?php foreach ($agences as $agence): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;"><?= htmlspecialchars((string)$agence['id']) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($agence['nom']) ?></td>
                        <td style="padding: 10px; text-align: center;">
                            <a href="?action=agence-delete&id=<?= $agence['id'] ?>" onclick="return confirm('Supprimer cette agence ?');" style="color: #cd2c2e; text-decoration: none; font-weight: bold;">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="padding: 15px; text-align: center;">Aucune agence trouvée.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
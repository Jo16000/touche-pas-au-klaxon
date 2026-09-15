<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: var(--bs-dark);"><?= htmlspecialchars($title ?? 'Gestion des utilisateurs') ?></h2>
    </div>

    <div class="card shadow-sm border rounded-4 p-4 bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars((string)$user['id']) ?></td>
                                <td><?= htmlspecialchars($user['nom'] ?? '') ?></td>
                                <td><?= htmlspecialchars($user['prenom'] ?? '') ?></td>
                                <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                                <td>
                                    <form action="?action=admin-update-role" method="POST" class="d-flex align-items-center gap-2">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <select name="role" class="form-select form-select-sm rounded-pill px-3" style="width: 150px;">
                                            <option value="user" <?= (strtolower($user['role'] ?? '') === 'user') ? 'selected' : '' ?>>Utilisateur</option>
                                            <option value="admin" <?= (strtolower($user['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Administrateur</option>
                                        </select>
                                        <button type="submit" class="btn btn-dark btn-sm rounded-pill px-3">Modifier</button>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <!-- Actions supplémentaires si besoin -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Aucun utilisateur trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 1000px; margin: 30px auto; padding: 0 15px; font-family: Arial, sans-serif;">
    <h1 style="color:#00497c; margin-bottom: 25px;">Tableau de bord Administrateur</h1>

    <!-- Messages flash -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px 15px; margin-bottom: 20px; border-radius: 4px;">
            <?= htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?>
        </div>
    <?php endif; ?>

    <h2 style="color:#384050; margin-top: 10px; font-size: 20px;">Liste de tous les utilisateurs</h2>
    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #ddd; margin-bottom: 30px;">
        <thead>
            <tr style="background: #f1f8fc; color: #00497c; text-align: left;">
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Nom & Prénom</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $u): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;"><?= htmlspecialchars((string)$u['id']) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($u['nom'] . ' ' . $u['prenom']) ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($u['email']) ?></td>
                        <td style="padding: 10px;"><strong style="color: <?= $u['role'] === 'ADMIN' ? '#0074c7' : '#333'; ?>"><?= htmlspecialchars($u['role']) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="padding: 15px; text-align: center;">Aucun utilisateur trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 style="color:#384050; margin-top: 30px; font-size: 20px;">Gestion globale des trajets</h2>
    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #f1f8fc; color: #00497c; text-align: left;">
                <th style="padding: 10px;">Départ</th>
                <th style="padding: 10px;">Arrivée</th>
                <th style="padding: 10px;">Date Départ</th>
                <th style="padding: 10px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rides)): ?>
                <?php foreach ($rides as $r): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;"><?= htmlspecialchars($r['departure_agency_name'] ?? 'N/A') ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($r['arrival_agency_name'] ?? 'N/A') ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($r['gdh_depart']) ?></td>
                        <td style="padding: 10px; text-align: center;">
                            <div style="display: inline-flex; gap: 8px; align-items: center;">
                                <!-- Bouton Détails ouvrant la modale Bootstrap -->
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalAdminDashRide<?= $r['id'] ?>" style="font-size: 12px; padding: 4px 12px;">
                                    Détails
                                </button>

                                <!-- Bouton Modifier pour l'admin -->
                                <a href="?action=ride-edit&id=<?= $r['id'] ?>" class="btn btn-outline-warning btn-sm rounded-pill px-3" style="font-size: 12px; padding: 4px 12px; text-decoration: none;">
                                    Modifier
                                </a>

                                <!-- Bouton Supprimer -->
                                <a href="?action=ride-delete&id=<?= $r['id'] ?>" onclick="return confirm('En tant qu\'admin, voulez-vous supprimer ce trajet ?');" style="background: #cd2c2e; color: white; padding: 4px 12px; text-decoration: none; border-radius: 20px; font-size: 12px;">
                                    Supprimer
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Fenêtre Modale de détails pour chaque trajet -->
                    <div class="modal fade" id="modalAdminDashRide<?= $r['id'] ?>" tabindex="-1" aria-labelledby="modalAdminDashRideLabel<?= $r['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow rounded-4 text-start">
                                <div class="modal-header bg-light border-0">
                                    <h5 class="modal-title fw-bold text-primary" id="modalAdminDashRideLabel<?= $r['id'] ?>">Détails du covoiturage (Admin)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <p class="mb-2"><strong>Conducteur :</strong> <?= htmlspecialchars(($r['conducteur_prenom'] ?? '') . ' ' . ($r['conducteur_nom'] ?? '')) ?></p>
                                    <p class="mb-2"><strong>Téléphone :</strong> <a href="tel:<?= htmlspecialchars($r['conducteur_telephone'] ?? '') ?>"><?= htmlspecialchars($r['conducteur_telephone'] ?? 'Non renseigné') ?></a></p>
                                    <p class="mb-3"><strong>Email :</strong> <a href="mailto:<?= htmlspecialchars($r['conducteur_email'] ?? '') ?>"><?= htmlspecialchars($r['conducteur_email'] ?? '') ?></a></p>
                                    <hr class="text-muted">
                                    <p class="mb-2"><strong>Trajet :</strong> <?= htmlspecialchars($r['departure_agency_name'] ?? '') ?> ➔ <?= htmlspecialchars($r['arrival_agency_name'] ?? '') ?></p>
                                    <p class="mb-2"><strong>Nombre total de places :</strong> <?= htmlspecialchars((string)($r['nombre_places'] ?? '')) ?></p>
                                    <p class="mb-0"><strong>Places disponibles :</strong> <?= htmlspecialchars((string)($r['places_disponibles'] ?? '')) ?></p>
                                </div>
                                <div class="modal-footer bg-light border-0">
                                    <button type="button" class="btn btn-dark btn-sm rounded-pill px-4" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="padding: 15px; text-align: center;">Aucun trajet enregistré.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
    <h2 class="mb-4 text-primary fw-bold">Gestion globale des Trajets</h2>
    
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($rides)): ?>
        <div class="alert alert-light border text-center py-4 rounded-4 shadow-sm" role="alert">
            Aucun trajet enregistré.
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Départ (Agence)</th>
                            <th class="py-3">Date/Heure Départ</th>
                            <th class="py-3">Arrivée (Agence)</th>
                            <th class="py-3">Date/Heure Arrivée</th>
                            <th class="py-3">Places dispo</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rides as $r): ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= htmlspecialchars((string)$r['id']) ?></td>
                                <td><?= htmlspecialchars($r['departure_agency_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($r['gdh_depart'] ?? '') ?></td>
                                <td><?= htmlspecialchars($r['arrival_agency_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($r['gdh_arrivee'] ?? '') ?></td>
                                <td>
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <?= htmlspecialchars((string)($r['places_disponibles'] ?? '')) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <!-- Bouton Détails ouvrant la modale -->
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalAdminRides<?= $r['id'] ?>">
                                            Détails
                                        </button>

                                        <!-- Bouton Modifier pour l'admin -->
                                        <a href="/klaxon-v2/public/?action=ride-edit&id=<?= $r['id'] ?>" class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            Modifier
                                        </a>

                                        <!-- Bouton Supprimer -->
                                        <a href="/klaxon-v2/public/?action=ride-delete&id=<?= $r['id'] ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet en tant qu\'administrateur ?');">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Fenêtre Modale pour les détails du conducteur -->
                            <div class="modal fade" id="modalAdminRides<?= $r['id'] ?>" tabindex="-1" aria-labelledby="modalAdminRidesLabel<?= $r['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow rounded-4 text-start">
                                        <div class="modal-header bg-light border-0">
                                            <h5 class="modal-title fw-bold text-primary" id="modalAdminRidesLabel<?= $r['id'] ?>">Détails du covoiturage (Admin)</h5>
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
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
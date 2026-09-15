<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-4">
    <h2 class="mb-4 text-primary fw-bold">Trajets proposés</h2>
    
    <?php if (empty($rides)): ?>
        <div class="alert alert-light border text-center py-4 rounded-4 shadow-sm" role="alert">
            Aucun trajet disponible pour le moment.
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-4">Départ</th>
                            <th class="py-3">Date/Heure Départ</th>
                            <th class="py-3">Arrivée</th>
                            <th class="py-3">Date/Heure Arrivée</th>
                            <th class="py-3">Places dispo</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rides as $ride): ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= htmlspecialchars($ride['departure_agency_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($ride['gdh_depart'] ?? '') ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($ride['arrival_agency_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($ride['gdh_arrivee'] ?? '') ?></td>
                                <td>
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <?= htmlspecialchars((string)($ride['places_disponibles'] ?? '')) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <?php if (isset($_SESSION['user'])): ?>
                                            <!-- Bouton Détails (Fenêtre modale exigée par le brief) -->
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalRide<?= $ride['id'] ?>">
                                                Détails
                                            </button>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['user']) && (($_SESSION['user']['id'] == $ride['user_id']) || (strtolower($_SESSION['user']['role'] ?? '') === 'admin'))): ?>
                                            <!-- Bouton Modifier -->
                                            <a href="/klaxon-v2/public/?action=ride-edit&id=<?= $ride['id'] ?>" class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                                Modifier
                                            </a>

                                            <!-- Bouton Supprimer -->
                                            <a href="/klaxon-v2/public/?action=ride-delete&id=<?= $ride['id'] ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?');">
                                                Supprimer
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>

                            <?php if (isset($_SESSION['user'])): ?>
                                <!-- Fenêtre Modale pour les détails du conducteur -->
                                <div class="modal fade" id="modalRide<?= $ride['id'] ?>" tabindex="-1" aria-labelledby="modalRideLabel<?= $ride['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4 text-start">
                                            <div class="modal-header bg-light border-0">
                                                <h5 class="modal-title fw-bold text-primary" id="modalRideLabel<?= $ride['id'] ?>">Détails du covoiturage</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <p class="mb-2"><strong>Conducteur :</strong> <?= htmlspecialchars(($ride['conducteur_prenom'] ?? '') . ' ' . ($ride['conducteur_nom'] ?? '')) ?></p>
                                                <p class="mb-2"><strong>Téléphone :</strong> <a href="tel:<?= htmlspecialchars($ride['conducteur_telephone'] ?? '') ?>"><?= htmlspecialchars($ride['conducteur_telephone'] ?? 'Non renseigné') ?></a></p>
                                                <p class="mb-3"><strong>Email :</strong> <a href="mailto:<?= htmlspecialchars($ride['conducteur_email'] ?? '') ?>"><?= htmlspecialchars($ride['conducteur_email'] ?? '') ?></a></p>
                                                <hr class="text-muted">
                                                <p class="mb-2"><strong>Trajet :</strong> <?= htmlspecialchars($ride['departure_agency_name'] ?? '') ?> ➔ <?= htmlspecialchars($ride['arrival_agency_name'] ?? '') ?></p>
                                                <p class="mb-2"><strong>Nombre total de places :</strong> <?= htmlspecialchars((string)($ride['nombre_places'] ?? '')) ?></p>
                                                <p class="mb-0"><strong>Places disponibles :</strong> <?= htmlspecialchars((string)($ride['places_disponibles'] ?? '')) ?></p>
                                            </div>
                                            <div class="modal-footer bg-light border-0">
                                                <button type="button" class="btn btn-dark btn-sm rounded-pill px-4" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
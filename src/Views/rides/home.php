<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 900px; margin: 30px auto; padding: 0 15px; font-family: Arial, sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="color: #00497c; margin: 0;">Trajets proposés</h1>
    </div>

    <?php if (empty($rides)): ?>
        <div style="background: white; padding: 25px; border: 1px solid #ddd; border-radius: 8px; text-align: center; color: #666;">
            Aucun trajet disponible pour le moment.
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($rides as $ride): ?>
                <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="color: #00497c; margin-top: 0; font-size: 18px;">
                            <?= htmlspecialchars($ride['departure_agency_name'] ?? '') ?> &rarr; <?= htmlspecialchars($ride['arrival_agency_name'] ?? '') ?>
                        </h3>
                        <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
                            Date : <?= htmlspecialchars($ride['gdh_depart'] ?? '') ?>
                        </p>
                    </div>

                    <div>
                        <!-- Bouton pour ouvrir la modale d'informations (couleur corrigée et bien lisible) -->
                        <button type="button" class="btn btn-sm rounded-pill mb-2 w-100" data-bs-toggle="modal" data-bs-target="#rideModal<?= $ride['id'] ?>" style="border: 1px solid #0891b2; color: #0891b2; background: transparent; border-radius: 20px; padding: 6px 15px; width: 100%; cursor: pointer; margin-bottom: 8px; font-weight: bold;">
                            Plus d'informations
                        </button>

                        <!-- Boutons de modification/suppression réservés à l'auteur -->
                        <?php if (isset($_SESSION['user']) && (int)$_SESSION['user']['id'] === (int)($ride['user_id'] ?? 0)): ?>
                            <div style="display: flex; gap: 8px;">
                                <a href="?action=ride-edit&id=<?= $ride['id'] ?>" style="flex: 1; text-align: center; border: 1px solid #ffc107; color: #ffc107; background: transparent; border-radius: 20px; padding: 5px 10px; text-decoration: none; font-size: 13px; font-weight: bold;">Modifier</a>
                                <a href="?action=ride-delete&id=<?= $ride['id'] ?>" style="flex: 1; text-align: center; border: 1px solid #dc3545; color: #dc3545; background: transparent; border-radius: 20px; padding: 5px 10px; text-decoration: none; font-size: 13px; font-weight: bold;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?');">Supprimer</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Fenêtre Modale Bootstrap -->
                <div class="modal fade" id="rideModal<?= $ride['id'] ?>" tabindex="-1" aria-labelledby="rideModalLabel<?= $ride['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rideModalLabel<?= $ride['id'] ?>">Détails du trajet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>👤 Conducteur :</strong> <?= htmlspecialchars($ride['conducteur_prenom'] ?? '') ?> <?= htmlspecialchars($ride['conducteur_nom'] ?? 'Inconnu') ?></li>
                                    <li style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>📞 Téléphone :</strong> <?= htmlspecialchars($ride['conducteur_telephone'] ?? 'Non renseigné') ?></li>
                                    <li style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>✉️ Email :</strong> <a href="mailto:<?= htmlspecialchars($ride['conducteur_email'] ?? '') ?>"><?= htmlspecialchars($ride['conducteur_email'] ?? 'Non renseigné') ?></a></li>
                                    <li style="padding: 8px 0;"><strong>💺 Nombre total de places :</strong> <?= htmlspecialchars((string)($ride['places_disponibles'] ?? '0')) ?></li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal" style="border-radius: 20px; padding: 5px 15px;">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
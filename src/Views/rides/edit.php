<?php
/**
 * @var array $ride
 * @var array $agences
 */
require_once __DIR__ . '/../layout/header.php'; 
?>

<div class="container" style="padding: 20px; max-width: 600px; margin: 0 auto;">
    <h2>Modifier le trajet</h2>

    <form action="?action=ride-edit&id=<?= $ride['id'] ?>" method="POST" style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
        <div style="display: flex; flex-direction: column;">
            <label for="agence_depart_id" style="font-weight: bold; margin-bottom: 5px;">Agence de départ :</label>
            <select name="agence_depart_id" id="agence_depart_id" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <?php if (!empty($agences)): ?>
                    <?php foreach ($agences as $agence): ?>
                        <option value="<?= $agence['id'] ?>" <?= ($agence['id'] == $ride['agence_depart_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($agence['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div style="display: flex; flex-direction: column;">
            <label for="agence_arrivee_id" style="font-weight: bold; margin-bottom: 5px;">Agence d'arrivée :</label>
            <select name="agence_arrivee_id" id="agence_arrivee_id" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <?php if (!empty($agences)): ?>
                    <?php foreach ($agences as $agence): ?>
                        <option value="<?= $agence['id'] ?>" <?= ($agence['id'] == $ride['agence_arrivee_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($agence['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div style="display: flex; flex-direction: column;">
            <label for="gdh_depart" style="font-weight: bold; margin-bottom: 5px;">Date et heure de départ :</label>
            <input type="datetime-local" name="gdh_depart" id="gdh_depart" value="<?= date('Y-m-d\TH:i', strtotime($ride['gdh_depart'])) ?>" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="display: flex; flex-direction: column;">
            <label for="gdh_arrivee" style="font-weight: bold; margin-bottom: 5px;">Date et heure d'arrivée :</label>
            <input type="datetime-local" name="gdh_arrivee" id="gdh_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($ride['gdh_arrivee'])) ?>" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="display: flex; flex-direction: column;">
            <label for="nombre_places" style="font-weight: bold; margin-bottom: 5px;">Nombre de places :</label>
            <input type="number" name="nombre_places" id="nombre_places" min="1" value="<?= htmlspecialchars((string)$ride['nombre_places']) ?>" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="display: flex; flex-direction: column;">
            <label for="places_disponibles" style="font-weight: bold; margin-bottom: 5px;">Places disponibles :</label>
            <input type="number" name="places_disponibles" id="places_disponibles" min="0" value="<?= htmlspecialchars((string)$ride['places_disponibles']) ?>" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Mettre à jour le trajet</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

class Ride extends AbstractModel
{
    protected string $table = 'rides';

    public function findAll(): array
    {
        $db = $this->getDb();
        $sql = "SELECT r.*, 
                       a1.nom AS departure_agency_name,
                       a2.nom AS arrival_agency_name,
                       u.nom AS conducteur_nom,
                       u.prenom AS conducteur_prenom,
                       u.email AS conducteur_email,
                       u.telephone AS conducteur_telephone
                FROM rides r
                LEFT JOIN agences a1 ON r.agence_depart_id = a1.id
                LEFT JOIN agences a2 ON r.agence_arrivee_id = a2.id
                LEFT JOIN users u ON r.user_id = u.id
                WHERE r.gdh_depart > NOW() 
                  AND r.places_disponibles > 0
                ORDER BY r.gdh_depart ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllAdmin(): array
    {
        $db = $this->getDb();
        $sql = "SELECT r.*, 
                       a1.nom AS departure_agency_name,
                       a2.nom AS arrival_agency_name,
                       u.nom AS conducteur_nom,
                       u.prenom AS conducteur_prenom,
                       u.email AS conducteur_email,
                       u.telephone AS conducteur_telephone
                FROM rides r
                LEFT JOIN agences a1 ON r.agence_depart_id = a1.id
                LEFT JOIN agences a2 ON r.agence_arrivee_id = a2.id
                LEFT JOIN users u ON r.user_id = u.id
                ORDER BY r.id DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $db = $this->getDb();
        $stmt = $db->prepare("SELECT * FROM rides WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    public function create(array $data): bool
    {
        $db = $this->getDb();

        $agenceDepartId = isset($data['agence_depart_id']) ? (int)$data['agence_depart_id'] : 0;
        $agenceArriveeId = isset($data['agence_arrivee_id']) ? (int)$data['agence_arrivee_id'] : 0;

        $stmtCheck = $db->prepare("SELECT id FROM agences WHERE id = ?");
        
        $stmtCheck->execute([$agenceDepartId]);
        if (!$stmtCheck->fetch()) {
            $stmtFirst = $db->query("SELECT id FROM agences LIMIT 1");
            $firstAgence = $stmtFirst->fetch(PDO::FETCH_ASSOC);
            $agenceDepartId = $firstAgence ? (int)$firstAgence['id'] : 1;
        }

        $stmtCheck->execute([$agenceArriveeId]);
        if (!$stmtCheck->fetch()) {
            $stmtFirst = $db->query("SELECT id FROM agences LIMIT 1");
            $firstAgence = $stmtFirst->fetch(PDO::FETCH_ASSOC);
            $agenceArriveeId = $firstAgence ? (int)$firstAgence['id'] : 1;
        }

        $stmt = $db->prepare("INSERT INTO rides (agence_depart_id, agence_arrivee_id, gdh_depart, gdh_arrivee, nombre_places, places_disponibles, user_id) VALUES (:agence_depart_id, :agence_arrivee_id, :gdh_depart, :gdh_arrivee, :nombre_places, :places_disponibles, :user_id)");

        return $stmt->execute([
            'agence_depart_id' => $agenceDepartId,
            'agence_arrivee_id' => $agenceArriveeId,
            'gdh_depart' => $data['gdh_depart'] ?? date('Y-m-d H:i:s'),
            'gdh_arrivee' => $data['gdh_arrivee'] ?? date('Y-m-d H:i:s'),
            'nombre_places' => isset($data['nombre_places']) ? (int)$data['nombre_places'] : 1,
            'places_disponibles' => isset($data['places_disponibles']) ? (int)$data['places_disponibles'] : 1,
            'user_id' => isset($data['user_id']) ? (int)$data['user_id'] : 1,
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $db = $this->getDb();
        $agenceDepartId = !empty($data['agence_depart_id']) ? (int)$data['agence_depart_id'] : 1;
        $agenceArriveeId = !empty($data['agence_arrivee_id']) ? (int)$data['agence_arrivee_id'] : 1;

        $stmt = $db->prepare("UPDATE rides SET agence_depart_id = :agence_depart_id, agence_arrivee_id = :agence_arrivee_id, gdh_depart = :gdh_depart, gdh_arrivee = :gdh_arrivee, nombre_places = :nombre_places, places_disponibles = :places_disponibles WHERE id = :id");

        return $stmt->execute([
            'id' => $id,
            'agence_depart_id' => $agenceDepartId,
            'agence_arrivee_id' => $agenceArriveeId,
            'gdh_depart' => $data['gdh_depart'],
            'gdh_arrivee' => $data['gdh_arrivee'],
            'nombre_places' => (int)$data['nombre_places'],
            'places_disponibles' => (int)$data['places_disponibles']
        ]);
    }
}
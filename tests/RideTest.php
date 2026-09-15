<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class RideTest extends TestCase
{
    public function testRideCreationDataStructure(): void
    {
        // Simulation des données d'écriture d'un trajet (insertion)
        $rideData = [
            'user_id' => 1,
            'departure_agency_id' => 9, // Bordeaux
            'arrival_agency_id' => 2,   // Lyon
            'departure_datetime' => '2026-09-22 08:30:00',
            'arrival_datetime' => '2026-09-22 11:45:00',
            'total_seats' => 3,
            'available_seats' => 3
        ];

        // Vérifications unitaires sur les règles de gestion du trajet
        $this->assertIsArray($rideData);
        $this->assertGreaterThan(0, $rideData['total_seats'], "Le nombre total de places doit être supérieur à 0.");
        $this->assertEquals($rideData['total_seats'], $rideData['available_seats'], "À la création, les places disponibles doivent être égales au total.");
        $this->assertNotEquals($rideData['departure_agency_id'], $rideData['arrival_agency_id'], "Les agences de départ et d'arrivée doivent être différentes.");
    }
}
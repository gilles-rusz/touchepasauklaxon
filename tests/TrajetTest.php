<?php

use PHPUnit\Framework\TestCase;
use App\Models\Trajet; // ✅ Import de la bonne classe avec son namespace

class TrajetTest extends TestCase
{
    public function testCreateTrajet()
    {
        $trajet = new Trajet(); // ✅ Utilise la classe importée correctement

        $data = [
            'depart' => 'Lyon',
            'arrivee' => 'Grenoble',
            'date_trajet' => '2025-06-15',
            'heure_depart' => '08:30:00',
            'nb_places' => 3,
            'employe_id' => 1 // Assure-toi que l'employé ID 1 existe en base de test
        ];

        $result = $trajet->create($data);

        $this->assertTrue($result);
    }
}

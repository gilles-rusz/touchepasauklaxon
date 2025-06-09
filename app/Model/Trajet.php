<?php

namespace App\Models;

use PDO;
use App\Core\Database;

class Trajet
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

   public function getAll(): array
{
    $stmt = $this->pdo->query("
        SELECT trajets.*, 
               employes.nom, 
               employes.prenom, 
               employes.email, 
               employes.telephone
        FROM trajets
        JOIN employes ON employes.id = trajets.employe_id
        ORDER BY date_trajet ASC, heure_depart ASC
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO trajets (depart, arrivee, date_trajet, heure_depart, nb_places, employe_id)
            VALUES (:depart, :arrivee, :date_trajet, :heure_depart, :nb_places, :employe_id)
        ");

        return $stmt->execute($data);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM trajets WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE trajets
            SET depart = :depart, arrivee = :arrivee, date_trajet = :date, heure_depart = :heure, nb_places = :places
            WHERE id = :id AND employe_id = :user_id
        ");

        return $stmt->execute([
            'depart' => $data['depart'],
            'arrivee' => $data['arrivee'],
            'date' => $data['date_trajet'],
            'heure' => $data['heure_depart'],
            'places' => $data['nb_places'],
            'id' => $id,
            'user_id' => $data['employe_id'],
        ]);
    }

  
    public function getDisponibles(): array
{
    $stmt = $this->pdo->query("
        SELECT trajets.*, 
               employes.nom, 
               employes.prenom, 
               employes.email, 
               employes.telephone
        FROM trajets
        JOIN employes ON employes.id = trajets.employe_id
        WHERE trajets.date_trajet >= CURDATE()
          AND trajets.nb_places > 0
        ORDER BY trajets.date_trajet ASC, trajets.heure_depart ASC
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    public function delete(int $id, int $userId): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM trajets WHERE id = ? AND employe_id = ?");
        return $stmt->execute([$id, $userId]);
    }
}

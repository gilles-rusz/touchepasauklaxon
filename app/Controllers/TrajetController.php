<?php
namespace App\Controllers;

use App\Model\Trajet;

class TrajetController
{
    public function home()
    {
        $trajetModel = new Trajet();
        $trajets = $trajetModel->getDisponibles(); // Trajets à venir avec places
        require_once __DIR__ . '/../Views/Trajets/home.php';
    }

    public function index()
    {
        $trajetModel = new Trajet();
        $trajets = $trajetModel->getAll(); // Tous les trajets (admin/employé)
        require_once __DIR__ . '/../Views/Trajets/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/Trajets/create.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $depart = trim($_POST['depart']);
        $arrivee = trim($_POST['arrivee']);
        $date = $_POST['date_trajet'];
        $heure = $_POST['heure_depart'];
        $places = (int) $_POST['nb_places'];

        if ($depart === $arrivee) {
            $_SESSION['flash']['error'] = "L'agence de départ et d'arrivée doivent être différentes.";
            header('Location: /trajets/creer');
            exit;
        }

        $datetime_depart = strtotime($date . ' ' . $heure);
        if ($datetime_depart < time()) {
            $_SESSION['flash']['error'] = "La date et l’heure de départ doivent être dans le futur.";
            header('Location: /trajets/creer');
            exit;
        }

        if ($places < 1) {
            $_SESSION['flash']['error'] = "Le nombre de places doit être d'au moins 1.";
            header('Location: /trajets/creer');
            exit;
        }

        $data = [
            'depart' => $depart,
            'arrivee' => $arrivee,
            'date_trajet' => $date,
            'heure_depart' => $heure,
            'nb_places' => $places,
            'employe_id' => $_SESSION['user']['id']
        ];

        $trajetModel = new Trajet();
        if ($trajetModel->create($data)) {
            $_SESSION['flash']['success'] = "Trajet ajouté avec succès.";
            header('Location: /trajets');
            exit;
        } else {
            $_SESSION['flash']['error'] = "Erreur lors de l'ajout du trajet.";
            header('Location: /trajets/creer');
            exit;
        }
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $trajetModel = new Trajet();
        $trajet = $trajetModel->getById($id);

        if (!$trajet || $trajet['employe_id'] != $_SESSION['user']['id']) {
            $_SESSION['flash']['error'] = "Accès refusé.";
            header('Location: /trajets');
            exit;
        }

        require_once __DIR__ . '/../Views/Trajets/edit.php';
    }

    public function update($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $trajetModel = new Trajet();
        $trajet = $trajetModel->getById($id);

        if (!$trajet || $trajet['employe_id'] != $_SESSION['user']['id']) {
            $_SESSION['flash']['error'] = "Modification non autorisée.";
            header('Location: /trajets');
            exit;
        }

        $depart = trim($_POST['depart']);
        $arrivee = trim($_POST['arrivee']);
        $date = $_POST['date_trajet'];
        $heure = $_POST['heure_depart'];
        $places = (int) $_POST['nb_places'];

        if ($depart === $arrivee) {
            $_SESSION['flash']['error'] = "L'agence de départ et d'arrivée doivent être différentes.";
            header("Location: /trajets/$id/modifier");
            exit;
        }

        $datetime_depart = strtotime($date . ' ' . $heure);
        if ($datetime_depart < time()) {
            $_SESSION['flash']['error'] = "Date ou heure invalide.";
            header("Location: /trajets/$id/modifier");
            exit;
        }

        $data = [
            'depart' => $depart,
            'arrivee' => $arrivee,
            'date_trajet' => $date,
            'heure_depart' => $heure,
            'nb_places' => $places,
            'employe_id' => $_SESSION['user']['id']
        ];

        if ($trajetModel->update($id, $data)) {
            $_SESSION['flash']['success'] = "Trajet modifié avec succès.";
            header('Location: /trajets');
        } else {
            $_SESSION['flash']['error'] = "Erreur lors de la modification.";
            header("Location: /trajets/$id/modifier");
        }
    }

    public function delete($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $trajetModel = new Trajet();
        if ($trajetModel->delete($id, $_SESSION['user']['id'])) {
            $_SESSION['flash']['success'] = "Trajet supprimé.";
        } else {
            $_SESSION['flash']['error'] = "Suppression non autorisée.";
        }

        header('Location: /trajets');
    }
}

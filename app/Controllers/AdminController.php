<?php

use App\Model\Employe;
use App\Model\Trajet;
use App\Model\Agence;

class AdminController
{
    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
            $_SESSION['flash']['error'] = "Accès interdit.";
            header('Location: /');
            exit;
        }
    }

    // Tableau de bord
    public function dashboard()
    {
        $this->checkAdmin();

        $employeModel = new Employe();
        $trajetModel = new Trajet();
        $agenceModel = new Agence();

        $employes = $employeModel->getAll();
        $trajets = $trajetModel->getAll();
        $agences = $agenceModel->getAll();

        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    // Liste des agences 
    public function agencesIndex()
    {
        $this->checkAdmin();

        $agenceModel = new Agence();
        $agences = $agenceModel->getAll();

        require_once __DIR__ . '/../Views/admin/agences/index.php';
    }

    // Formulaire création
    public function agencesCreate()
    {
        $this->checkAdmin();

        require_once __DIR__ . '/../Views/admin/agences/form.php';
    }

    // Traitement création
    public function agencesStore()
    {
        $this->checkAdmin();

        $nom = trim($_POST['nom']);
        if ($nom === '') {
            $_SESSION['flash']['error'] = "Le nom de l'agence est requis.";
            header('Location: /admin/agences/creer');
            exit;
        }

        $agenceModel = new Agence();
        $agenceModel->create($nom);

        $_SESSION['flash']['success'] = "Agence ajoutée avec succès.";
        header('Location: /admin');
    }

    // Formulaire modification
    public function agencesEdit($id)
    {
        $this->checkAdmin();

        $agenceModel = new Agence();
        $agence = $agenceModel->getById($id);

        if (!$agence) {
            $_SESSION['flash']['error'] = "Agence introuvable.";
            header('Location: /admin');
            exit;
        }

        require_once __DIR__ . '/../Views/admin/agences/form.php';
    }

    // Traitement modification
    public function agencesUpdate($id)
    {
        $this->checkAdmin();

        $nom = trim($_POST['nom']);
        if ($nom === '') {
            $_SESSION['flash']['error'] = "Le nom de l'agence est requis.";
            header("Location: /admin/agences/$id/modifier");
            exit;
        }

        $agenceModel = new Agence();
        $agenceModel->update($id, $nom);

        $_SESSION['flash']['success'] = "Agence modifiée avec succès.";
        header('Location: /admin');
    }

    // Suppression
    public function agencesDelete($id)
    {
        $this->checkAdmin();

        $agenceModel = new Agence();
        $agenceModel->delete($id);

        $_SESSION['flash']['success'] = "Agence supprimée.";
        header('Location: /admin');
    }
}

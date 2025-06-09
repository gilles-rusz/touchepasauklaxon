<?php

namespace App\Controllers;

use App\Models\Employe;

class AuthController {
    public function loginForm() {
        include __DIR__ . '/../Views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $employe = Employe::findByEmail($email);

            if ($employe && password_verify($password, $employe['password'])) {
                $_SESSION['user'] = [
                    'id' => $employe['id'],
                    'nom' => $employe['nom'],
                    'prenom' => $employe['prenom'],
                    'email' => $employe['email'],
                    'is_admin' => $employe['is_admin']
                ];
                header('Location: /touchepasauklaxon/public');
                exit;
            } else {
                $_SESSION['flash']['error'] = "Identifiants incorrects.";
                      header('Location: /login');
                      exit;

            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /touchepasauklaxon/public');
    }
}

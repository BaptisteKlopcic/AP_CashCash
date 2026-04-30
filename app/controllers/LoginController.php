<?php

class LoginController {

    public function index() {
        require_once __DIR__ . "/../../views/login.php";
    }

    public function verifier() {
        $identifiant = $_POST['identifiant'];
        $password = $_POST['password'];

        // Exemple : appel au modèle
        $user = User::verifierConnexion($identifiant, $password);

        if ($user) {
            $_SESSION['user'] = $user;

            if ($user['role'] === 'technicien') {
                header("Location: /technicien/dashboard");
            } else {
                header("Location: /gestionnaire/dashboard");
            }
        } else {
            $erreur = "Identifiants incorrects";
            require_once __DIR__ . "/../../views/login.php";
        }
    }
}

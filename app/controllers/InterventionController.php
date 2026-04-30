<?php

class InterventionController {

    public function liste() {
        $interventions = Intervention::getByTechnicien($_SESSION['user']['id']);
        require_once __DIR__ . "/../../views/interventions_liste.php";
    }
}

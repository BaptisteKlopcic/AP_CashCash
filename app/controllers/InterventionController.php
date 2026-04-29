<?php
class InterventionController {

    public function liste() {
        require "../config/database.php";
        require "../app/models/InterventionModel.php";

        $model = new InterventionModel($db);
        $interventions = $model->getAll();

        require "../app/views/interventions/liste.php";
    }
}

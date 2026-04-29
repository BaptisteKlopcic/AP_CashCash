<?php
class InterventionController {

    public function liste() {
        require "../config/database.php";
        require "../app/models/InterventionModel.php";

        $model = new InterventionModel($db);

        if (isset($_GET['date'])) {
            $interventions = $model->getByDate($_GET['date']);
        } else {
            $interventions = $model->getByTechnicien($_SESSION['user']['id']);
        }

        require "../app/views/interventions/liste.php";
    }

    public function fiche() {
        require "../config/database.php";
        require "../app/models/InterventionModel.php";

        $model = new InterventionModel($db);
        $intervention = $model->getOne($_GET['id']);

        require "../app/views/interventions/fiche.php";
    }

    public function affecter() {
        require "../config/database.php";
        require "../app/models/InterventionModel.php";

        $model = new InterventionModel($db);
        $model->affecter($_POST['idIntervention'], $_POST['idTech']);

        header("Location: index.php?controller=intervention&action=liste");
    }

    public function valider() {
        require "../config/database.php";
        require "../app/models/InterventionModel.php";

        $model = new InterventionModel($db);
        $model->valider($_POST['id'], $_POST['commentaire'], $_POST['duree']);

        header("Location: index.php?controller=intervention&action=liste");
    }

    public function stats() {
        require "../config/database.php";
        require "../app/models/InterventionModel.php";

        $model = new InterventionModel($db);
        $stats = $model->statsMensuelles($_GET['idTech'], $_GET['mois']);

        require "../app/views/interventions/stats.php";
    }
}

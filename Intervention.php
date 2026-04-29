<?php
class InterventionModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByTechnicien($idTech) {
        $sql = "SELECT * FROM intervention WHERE idTechnicien = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idTech]);
        return $stmt->fetchAll();
    }

    public function getByDate($date) {
        $sql = "SELECT * FROM intervention WHERE dateIntervention = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll();
    }

    public function getOne($id) {
        $sql = "SELECT * FROM intervention WHERE idIntervention = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function affecter($idIntervention, $idTech) {
        $sql = "UPDATE intervention SET idTechnicien = ? WHERE idIntervention = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$idTech, $idIntervention]);
    }

    public function valider($id, $commentaire, $duree) {
        $sql = "UPDATE intervention SET commentaire = ?, duree = ?, statut = 'TERMINEE' WHERE idIntervention = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$commentaire, $duree, $id]);
    }

    public function statsMensuelles($idTech, $mois) {
        $sql = "SELECT COUNT(*) AS nb, SUM(km) AS totalKm, SUM(duree) AS totalDuree
                FROM intervention
                WHERE idTechnicien = ? AND MONTH(dateIntervention) = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idTech, $mois]);
        return $stmt->fetch();
    }
}

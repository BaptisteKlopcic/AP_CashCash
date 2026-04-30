<?php

class Intervention {

    public static function getByTechnicien($idTech) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM interventions WHERE id_technicien = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$idTech]);
        return $stmt->fetchAll();
    }
}

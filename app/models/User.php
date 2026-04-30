<?php

class User {

    public static function verifierConnexion($identifiant, $password) {
        $db = Database::getConnection();

        $sql = "SELECT * FROM users WHERE identifiant = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$identifiant]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }
}

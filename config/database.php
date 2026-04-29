<?php
$host = 'localhost';
$dbname = 'cashcash'; // le nom que tu as choisi
$user = 'root';       // en local, souvent 'root'
$pass = '';           // sous XAMPP/WAMP, souvent vide

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

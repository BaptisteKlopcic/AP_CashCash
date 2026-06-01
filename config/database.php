<?php
$host = 'localhost';
$dbname = 'cashcash'; 
$user = 'root';       
$pass = '';           

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//liste du matériel loué
$stmt = $pdo->prepare("SELECT * FROM Materiel WHERE Etat = 'LOUE'");
$stmt->execute();
$materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);

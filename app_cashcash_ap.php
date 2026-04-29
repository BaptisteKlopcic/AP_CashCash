
<?php
//Connexion à la base de données avec PHP (PDO)
$host = "localhost";
$dbname = "bdd_ap";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>


<?php
//Lire les données
require_once "config.php";

$sql = "SELECT * FROM utilisateurs ORDER BY id DESC";
$stmt = $pdo->query($sql);

$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($utilisateurs as $user) {
    echo "ID : " . $user['id'] . "<br>";
    echo "Nom : " . $user['nom'] . "<br>";
    echo "Email : " . $user['email'] . "<br>";
    echo "Créé le : " . $user['created_at'] . "<hr>";
}
?>

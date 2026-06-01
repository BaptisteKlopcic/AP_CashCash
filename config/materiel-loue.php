<?php
require_once '../config/database.php';
//liste du matériel loué
$stmt = $pdo->prepare("SELECT * FROM Materiel WHERE Etat = 'LOUE'");
$stmt->execute();
$materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Liste du matériel loué</h1>

<table>
    <tr>
            <th>Numéro de série</th>
            <th>Emplacement</th>
            <th>Type</th>
            <th>État</th>
        </tr>

        <?php foreach ($materiels as $m): ?>
        <tr>
            <td><?= $m['NumSerie'] ?></td>
            <td><?= $m['Emplacement'] ?></td>
            <td><?= $m['RefInter_TypeMateriel'] ?></td>
            <td><?= $m['Etat'] ?></td>
        </tr>
        <?php endforeach; ?>
</table>
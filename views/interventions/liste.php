<h2>Interventions</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Client</th>
        <th>Statut</th>
        <th>Action</th>
    </tr>

    <?php foreach ($interventions as $i): ?>
    <tr>
        <td><?= $i['idIntervention'] ?></td>
        <td><?= $i['dateIntervention'] ?></td>
        <td><?= $i['idClient'] ?></td>
        <td><?= $i['statut'] ?></td>
        <td>
            <a href="index.php?controller=intervention&action=fiche&id=<?= $i['idIntervention'] ?>">Voir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

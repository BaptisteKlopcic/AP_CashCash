<h1>Liste des interventions</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Client</th>
        <th>Technicien</th>
        <th>Statut</th>
    </tr>

    <?php foreach ($interventions as $i): ?>
        <tr>
            <td><?= htmlspecialchars($i['idIntervention']) ?></td>
            <td><?= htmlspecialchars($i['dateIntervention']) ?></td>
            <td><?= htmlspecialchars($i['idClient']) ?></td>
            <td><?= htmlspecialchars($i['idTechnicien']) ?></td>
            <td><?= htmlspecialchars($i['statut']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<tbody>
<?php foreach ($interventions as $i): ?>
<tr>
    <td><?= $i['client_nom'] ?></td>
    <td><?= $i['adresse'] ?></td>
    <td><?= $i['date'] ?></td>
    <td><?= $i['statut'] ?></td>
    <td>
        <a href="/intervention/voir?id=<?= $i['id'] ?>" class="btn">Voir</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

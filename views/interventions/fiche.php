<h2>Fiche intervention #<?= $intervention['idIntervention'] ?></h2>

<p>Date : <?= $intervention['dateIntervention'] ?></p>
<p>Client : <?= $intervention['idClient'] ?></p>
<p>Technicien : <?= $intervention['idTechnicien'] ?></p>
<p>Statut : <?= $intervention['statut'] ?></p>

<form method="POST" action="index.php?controller=intervention&action=valider">
    <input type="hidden" name="id" value="<?= $intervention['idIntervention'] ?>">

    <textarea name="commentaire" placeholder="Commentaire"></textarea>
    <input type="number" name="duree" placeholder="Durée (min)">

    <button type="submit">Valider</button>
</form>

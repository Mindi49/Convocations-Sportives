
<?php $this->titre = "Convocations sportives"; ?>



<!---------------------- ABSENCES ---------------------->

<hr />
<h1>Liste des Absents</h1>
<table class="liste">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Date</th>
        <th>Motif</th>
        <th>Action</th>
    </tr>
    <?php foreach ($absences as $absence): ?>
        <tr>
            <td><?= $absence['Nom'] ?></td>
            <td><?= $absence['Prenom'] ?></td>
            <td><?= $absence['Date'] ?></td>
            <td><?= $absence['Motif'] ?></td>
            <td><form method="post" action="index.php?action=supprimerAbsence">
                    <input type="hidden" name="idJoueur" value="<?= $absence['IdJoueur'] ?>" />
                    <input type="hidden" name="date" value="<?= $absence['Date'] ?>" />
                    <input type="submit" value="Supprimer" /></form></td>

        </tr>
    <?php endforeach; ?>
</table>
<br>

<h1>Ajouter une absence</h1>
<form method="post" action="index.php?action=ajouterAbsence">
    <label for="joueursAbs">Joueur : </label>
    <select name="idJoueur" id="joueursAbs">
        <?php foreach ($joueurs as $joueur): ?>
            <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom'] . " " .$joueur['Prenom']?></option>
        <?php endforeach;?>
    </select>
    <br>
    <label>Motif de l'absence : </label><br>
    <table>
        <tr>
            <td><input type="radio" name="motif" id="absent" value="Absent" checked /><label for="absent" >Absent</label></td>
            <td><input type="radio" name="motif" id="blesse" value="Blessé" /><label for="blesse">Blessé</label></td>
        </tr>
        <tr>
            <td><input type="radio" name="motif" id="nonlicencie" value="Non licencié" /><label for="nonlicencie">Non licencié</label></td>
            <td><input type="radio" name="motif" id="suspendu" value="Suspendu" /><label for="suspendu">Suspendu</label></td>
        </tr>
    </table>
    <label for="dateAbs">Absence Journalière :</label>
    <input type="date" name="date" id="dateAbs" required>
    <br>
    <!--    <label>Absence Plagiaire :</label>-->
    <!--    <input type="date" name="dateabsence" id="dateAbsDeb">-->
    <!--    <input type="date" name="dateabsence" id="dateAbsFin">-->
    <!--    <br>-->
    <input type="submit" value="Confirmer l'absence">
</form>
<br>

<!---------------------- MATCHS ---------------------->

<hr />
<h1>Liste des Matchs Disponibles</h1>
<table class="liste">
    <tr>
        <th>Categorie</th>
        <th>Competition</th>
        <th>Equipe</th>
        <th>Equipe adverse</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Terrain</th>
        <th>Site</th>
        <th>Action</th>
    </tr>
    <?php foreach ($matchs as $match): ?>
        <tr>
            <td><?= $match['Categorie'] ?></td>
            <td><?= $match['Competition'] ?></td>
            <td><?= $match['Equipe'] ?></td>
            <td><?= $match['EquipeAdverse'] ?></td>
            <td><?= $match['Date'] ?></td>
            <td><?= $match['Heure'] ?></td>
            <td><?= $match['Terrain'] ?></td>
            <td><?= $match['Site'] ?></td>
            <td><form method="post" action="index.php?action=supprimerMatch">
                    <input type="hidden" name="num" value="<?= $match['NumMatch'] ?>" />
                    <input type="submit" value="Supprimer" />
                </form></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

<h1>Ajouter un Match</h1>
<form method="post" action="index.php?action=ajouterMatch">
    <label for="categorieMatch">Catégorie : </label>
    <select name="categorie" id="categorieMatch">
        <?php foreach ($categories as $categorie): ?>
            <option value="<?=$categorie['Nom']?>"><?=$categorie['Nom']?></option>
        <?php endforeach;?>
    </select>
    <br>
    <label for="competitionMatch">Compétition : </label>
    <select name="competition" id="competitionMatch">
        <?php foreach ($competitions as $competition): ?>
            <option value="<?=$competition['Nom']?>"><?=$competition['Nom']?></option>
        <?php endforeach;?>
    </select>
    <br>
    <label for="equipeMatch">Equipe : </label>
    <select name="equipe" id="equipeMatch">
        <?php foreach ($equipes as $equipe): ?>
            <option value="<?=$equipe['Nom']?>"><?=$equipe['Nom']?></option>
        <?php endforeach;?>
    </select>
    <br>
    <label for="equipeAdvMatch">Equipe adverse : </label>
    <input type="text" name="equipeadv" id="equipeAdvMatch">
    <br>
    <label for="dateCompetition">Date de la compétition : </label>
    <input type="date" name="date" id="dateCompetition" required>
    <br>
    <label for="heureCompetition">Heure de la compétition : </label>
    <input type="time" name="heure" id="heureCompetition" required>
    <br>
    <label for="terrain">Terrain : </label>
    <input type="text" id="terrain" name="terrain" size="12">
    <br>
    <label for="site">Site : </label>
    <input type="text" id="site" name="site" size="12">
    <br>
    <input type="submit" value="Ajouter">
</form>
<br>

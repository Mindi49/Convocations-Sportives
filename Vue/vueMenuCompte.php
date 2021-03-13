
<?php $this->titre = "Convocations sportives"; ?>

<h1><a href="index.php?action=match">Liste des Matchs programmés</a></h1>
<h1><a href="index.php?action=convocation">Liste des Convocations</a></h1>
<h1><a href="index.php?action=absence">Liste des Absences</a></h1>

<!---------------------- JOUEURS ---------------------->
<hr />
<h1>Liste des Joueurs du Club</h1>
<table class="liste">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Categorie</th>
        <th>Licencie</th>
        <th>ACTION</th>
    </tr>
<?php foreach ($joueurs as $joueur): ?>
        <tr>
            <td><?= $joueur['Nom'] ?></td>
            <td><?= $joueur['Prenom'] ?></td>
            <td><?= $joueur['Categorie'] ?></td>
            <td><?= $joueur['Licencie'] ?></td>
            <td><form method="post" action="index.php?action=supprimerJoueur">
                    <input type="hidden" name="idJoueur" value="<?= $joueur['IdJoueur'] ?>" />
                    <input type="submit" value="Supprimer" />
                </form></td>
        </tr>
<?php endforeach; ?>
</table>
<br>

<h1>Liste des Joueurs Licenciés</h1>
<table class="liste">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Categorie</th>
    </tr>
    <?php foreach ($licencies as $licencie): ?>
        <tr>
            <td><?= $licencie['Nom'] ?></td>
            <td><?= $licencie['Prenom'] ?></td>
            <td><?= $licencie['Categorie'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>


<h1>Ajouter une licence</h1>
<form method="post" action="index.php?action=ajouterLicence">
    <label for="joueurLicence">Joueur à qui ajouter une licence : </label>
    <select name="idJoueur" id="joueurLicence">
        <?php foreach ($nonlicencies as $nonlicencie): ?>
            <option value="<?=$nonlicencie['IdJoueur']?>"><?=$nonlicencie['Nom']?> <?=$nonlicencie['Prenom']?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Ajouter une licence">
    <br>
</form>
<br>



<h1>Ajouter un joueur</h1>
<form method="post" action="index.php?action=ajouterJoueur">
    <table>
        <tr><td><label for="nomJoueur">Nom : </label></td>
            <td><input type="text" name="nom" id="nomJoueur" required></td></tr>
        <tr><td><label for="prenomJoueur">Prénom : </label></td>
            <td><input type="text" name="prenom" id="prenomJoueur" required></td></tr>
        <br>
        <tr><td><label for="categorieJoueur">Categorie : </label></td>
            <td><select name="categorie" id="categorieJoueur">
            <?php foreach ($categories as $categorie): ?>
                <option value="<?=$categorie['Nom']?>"><?=$categorie['Nom']?></option>
            <?php endforeach;?>
            </td></tr>
        </select>
        <br>
        <tr><td><label>Licencié au club : </label>
            <td><input type="radio" name="licencie" id="oui" value="oui"><label for="oui">Oui</label>
            <input type="radio" name="licencie" id="non" value="non" checked><label for="non">Non</label></td></tr>
    </table>
    <input type="submit" value="Ajouter">
    <br>
</form>
<br>

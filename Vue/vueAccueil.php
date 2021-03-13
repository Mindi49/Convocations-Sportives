
<?php $this->titre = "Convocations sportives"; ?>

<h1><a href="index.php?action=menuCompte">Liste des Joueurs</a></h1>
<!---------------------- CATEGORIES ---------------------->
<hr />
<h1>Liste des Catégories</h1>
<table class="liste">
    <tr>
        <th>Nom</th>
        <th>Action</th>
    </tr>
    <?php foreach ($categories as $categorie): ?>
        <tr>
            <td><?= $categorie['Nom'] ?></td>
            <td><form method="post" action="index.php?action=supprimerCategorie">
                    <input type="hidden" name="nom" value="<?= $categorie['Nom'] ?>" />
                    <input type="submit" value="Supprimer" />
                </form></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

<h1>Ajouter une categorie</h1>
<form method="post" action="index.php?action=ajouterCategorie">
    <label for="nomCategorie">Categorie : </label>
    <input type="text" name="nom" id="nomCategorie" required>
    <br>
    <input type="submit" value="Ajouter">
</form>
<br>


<!---------------------- COMPETITIONS ---------------------->

<hr />
<h1>Liste des Compétitions</h1>
<table class="liste">
    <tr>
        <th>Nom</th>
        <th>Action</th>
    </tr>
    <?php foreach ($competitions as $competition): ?>
        <tr>
            <td><?= $competition['Nom'] ?></td>
            <td><form method="post" action="index.php?action=supprimerCompetition">
                    <input type="hidden" name="nom" value="<?= $competition['Nom'] ?>" />
                    <input type="submit" value="Supprimer" />
                </form></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

<h1>Ajouter une competition</h1>
<form method="post" action="index.php?action=ajouterCompetition">
    <label for="nomCompetition">Competition : </label>
    <input type="text" name="nom" id="nomCompetition" required>
    <br>
    <input type="submit" value="Ajouter">
</form>
<br>

<!---------------------- EQUIPES ---------------------->

<hr />
<h1>Liste des Equipes</h1>
<table class="liste">
    <tr>
        <th>Nom</th>
        <th>Action</th>
    </tr>
    <?php foreach ($equipes as $equipe): ?>
        <tr>
            <td><?= $equipe['Nom'] ?></td>
            <td><form method="post" action="index.php?action=supprimerEquipe">
                    <input type="hidden" name="nom" value="<?= $equipe['Nom'] ?>" />
                    <input type="submit" value="Supprimer" />
                </form></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

<h1>Ajouter une équipe</h1>
<form method="post" action="index.php?action=ajouterEquipe">
    <label for="nomEquipe">Equipe : </label>
    <input type="text" name="nom" id="nomEquipe" required>
    <br>
    <input type="submit" value="Ajouter">
</form>
<br>





<!---------------------- CONVOCATION ---------------------->
<hr />
<!-- voir la liste des convocs pour un match (tous les joueurs qui sont convoqués) -->
<!-- voir la liste des convocs pour un joueur (tous les matchs auxquels est convoqué le joueur) -->
<!-- ici la liste de toutes les convocs, le joueur et le match -->


<h1>Liste des Convocations Publiées</h1>
<table class="liste">
    <?php foreach ($convocationsPubliees as $convocationPubliee): ?>
        <tr>
            <td><a href=""><?= $convocationPubliee['Equipe'] ?> le <?= $convocationPubliee['Date'] ?> : <?= $convocationPubliee['Nom'] ?> <?= $convocationPubliee['Prenom'] ?> - <?= $convocationPubliee['Competition'] ?> - </a></td>
            <td><form method="post" action="index.php?action=supprimerConvocation">
                    <input type="hidden" name="num" value="<?= $convocationPubliee['NumConvoc'] ?>" />
                    <input type="submit" value="Supprimer" /></form></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

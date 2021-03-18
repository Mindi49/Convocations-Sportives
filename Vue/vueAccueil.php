
<?php $this->titre = "Convocations sportives"; ?>

<!---------------------- CATEGORIES ---------------------->
<!--
<div class="row pt-5">
    <div class="col-6">
        <h1>Catégories</h1>
        <table class="table border table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $categorie): ?>
                <tr>
                    <td><?= $categorie['Nom'] ?></td>
                    <td><form method="post" action="index.php?action=supprimerCategorie">
                            <input type="hidden" name="nom" value="<?= $categorie['Nom'] ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                        </form></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="offset-1 col-5">
        <h1>Ajouter une catégorie</h1>
        <form method="post" action="index.php?action=ajouterCategorie">
            <div class="form-group row">
                <label for="nomCategorie" class="col-3 form-label">Catégorie : </label>
                <div class="col-5">
                    <input type="text" name="nom" id="nomCategorie" class="form-control" required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <button type="submit" class="btn btn-primary col-5">Ajouter</button>
            </div>
        </form>
    </div>
</div>
-->
<!---------------------- COMPETITIONS ---------------------->
<!--
<div class="row pt-5">
    <div class="col-6">
        <h1>Compétitions</h1>
        <table class="table border table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            <thead>
            <tbody>
                <?php foreach ($competitions as $competition): ?>
                    <tr>
                        <td><?= $competition['Nom'] ?></td>
                        <td><form method="post" action="index.php?action=supprimerCompetition">
                                <input type="hidden" name="nom" value="<?= $competition['Nom'] ?>" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="offset-1 col-5">
        <h1>Ajouter une compétition</h1>
        <form method="post" action="index.php?action=ajouterCompetition">
            <div class="form-group form-inline row">
                <label for="nomCompetition" class="col-3 form-label">Compétition : </label>
                <div class="col-5">
                    <input type="text" name="nom" id="nomCompetition" class="form-control" required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <button type="submit" class="btn btn-primary col-5">Ajouter</button>
            </div>
        </form>
    </div>
</div>
-->

<!---------------------- EQUIPES ---------------------->
<!--
<div class="row pt-5">
    <div class="col-6">
        <h1>Équipes</h1>
        <table  class="table border table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipes as $equipe): ?>
                    <tr>
                        <td><?= $equipe['Nom'] ?></td>
                        <td><form method="post" action="index.php?action=supprimerEquipe">
                                <input type="hidden" name="nom" value="<?= $equipe['Nom'] ?>" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="offset-1 col-5">
        <h1>Ajouter une équipe</h1>
        <form method="post" action="index.php?action=ajouterEquipe">
            <div class="form-group row">
                <label for="nomEquipe" class="col-3 form-label">Equipe : </label>
                <div class="col-5">
                    <input type="text" name="nom" id="nomEquipe" class="form-control" required>
                </div>
                <div class="form-group row mt-2">
                    <button type="submit" class="btn btn-primary col-5">Ajouter</button>
                </div>
        </form>
    </div>
</div>
-->



<!---------------------- CONVOCATION ---------------------->

<!-- voir la liste des convocs pour un match (tous les joueurs qui sont convoqués) -->
<!-- voir la liste des convocs pour un joueur (tous les matchs auxquels est convoqué le joueur) -->
<!-- ici la liste de toutes les convocs, le joueur et le match -->
<div class="bs-callout" style="border-left-color: #001D6E">
    Bienvenue sur ce site de convocations sportives
</div>
<div class="bs-callout" style="border-left-color: #eeeeee">
    Consultez les matchs prévus
</div>
<div class="bs-callout" style="border-left-color: darkred">
    Composez vos équipes et publiez les convocations
</div>

<div class="row pt-5">
    <h1>Convocations Publiées</h1>
    <div class="col-6">
        <table class="table border table-striped table-hover">
            <?php foreach ($convocationsPubliees as $convocationPubliee): ?>
                <tr>
                    <td><?= $convocationPubliee['Competition'] ?> - <?= $convocationPubliee['Equipe'] ?> (le <?= $convocationPubliee['Date'] ?>)</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>





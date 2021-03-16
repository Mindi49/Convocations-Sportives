
<?php $this->titre = "Convocations sportives"; ?>

<!--<h1><a href="index.php?action=match">Liste des Matchs programmés</a></h1>-->
<!--<h1><a href="index.php?action=convocation">Liste des Convocations</a></h1>-->
<!--<h1><a href="index.php?action=absence">Liste des Absences</a></h1>-->

<!---------------------- JOUEURS ---------------------->
<div class="row pt-5">
    <div class="col-6">
        <h1>Joueurs du Club</h1>
        <table class="table border table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Categorie</th>
                    <th>Licencie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($joueurs as $joueur): ?>
                <tr>
                    <td><?= $joueur['Nom'] ?></td>
                    <td><?= $joueur['Prenom'] ?></td>
                    <td><?= $joueur['Categorie'] ?></td>
                    <td><?= $joueur['Licencie'] ?></td>
                    <td><form method="post" action="index.php?action=supprimerJoueur">
                            <input type="hidden" name="idJoueur" value="<?= $joueur['IdJoueur'] ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-user-slash"></i></button>
                        </form></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="offset-1 col-5">
        <div class="row">
            <h1>Joueurs Licenciés</h1>
            <table class="table border table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Categorie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($licencies as $licencie): ?>
                        <tr>
                            <td><?= $licencie['Nom'] ?></td>
                            <td><?= $licencie['Prenom'] ?></td>
                            <td><?= $licencie['Categorie'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row pt-5">
            <h1>Ajouter une licence</h1>
            <form method="post" action="index.php?action=ajouterLicence">
                <div class="form-group row">
                    <div class="col-6">
                        <select name="idJoueur" id="joueurLicence" class="form-select">
                            <?php foreach ($nonlicencies as $nonlicencie): ?>
                                <option value="<?=$nonlicencie['IdJoueur']?>"><?=$nonlicencie['Nom']?> <?=$nonlicencie['Prenom']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="offset-1 col-5">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-id-badge"></i>&nbsp;&nbsp;Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!------------------------------->

<div class="row pt-5 mb-5">
    <div class="col-5">
        <h1>Ajouter un joueur</h1>
        <form method="post" action="index.php?action=ajouterJoueur">
            <div class="form-group row">
                <label for="nomJoueur" class="col-4 col-form-label">Nom : </label>
                <div class="col">
                    <input type="text" name="nom" id="nomJoueur" class="form-control" required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="prenomJoueur" class="col-4 col-form-label">Prénom : </label>
                <div class="col">
                    <input type="text" name="prenom" id="prenomJoueur" class="form-control" required>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label for="categorieJoueur" class="col-4 col-form-label">Categorie : </label>
                <div class="col">
                    <select name="categorie" id="categorieJoueur" class="form-select" >
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?=$categorie['Nom']?>"><?=$categorie['Nom']?></option>
                    <?php endforeach;?>
                </select>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label class="col-4 col-form-label">Licencié au club : </label>
                <div class="col">
                    <div class="form-group row">
                        <label for="oui" class="col-form-label col-3">
                            <input type="radio" name="licencie" id="oui" value="oui" class="form-check-input mr-1"> Oui
                        </label>
                        <label for="non" class="col-form-label offset-1 col-3">
                            <input type="radio" name="licencie" id="non" value="oui" class="form-check-input mr-1" checked> Non
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-center mt-2">
                <button type="submit" class="btn btn-primary col-5">Ajouter</button>
            </div>
        </form>
    </div>
</div>








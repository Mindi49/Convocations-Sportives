
<?php $this->titre = "Convocations sportives"; ?>

<!---------------------- CONVOCATION ---------------------->

<!-- voir la liste des convocs pour un match (tous les joueurs qui sont convoqués) -->
<!-- voir la liste des convocs pour un joueur (tous les matchs auxquels est convoqué le joueur) -->
<!-- ici la liste de toutes les convocs, le joueur et le match -->
<div class="row pt-5">
    <div class="col">
        <h1>Convocations par match</h1>
        <table class="table border table-striped table-hover">
            <tbody>
                <?php foreach ($convocations as $convocation): ?>
                    <tr>
                        <td><?= $convocation['Competition'] ?> - <?= $convocation['Equipe'] ?> (le <?= $convocation['Date'] ?>)</td>
                        <td><form method="post" action="index.php?action=supprimerConvocation">
                                <input type="hidden" name="num" value="<?= $convocation['NumConvoc'] ?>" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-user-slash"></i></button></form></td>
                        <td><form method="post" action="index.php?action=publier">
                            <input type="hidden" name="num" value="<?= $convocation['NumConvoc'] ?>" />
                            <button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i></button></form></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row pt-5">
    <div class="col">
        <h1>Convocations Publiées</h1>
        <table class="table border table-striped table-hover">
            <?php foreach ($convocationsPubliees as $convocationPubliee): ?>
                <tr>
                    <td><?= $convocationPubliee['Competition'] ?> - <?= $convocationPubliee['Equipe'] ?> (le <?= $convocationPubliee['Date'] ?>)</td>
                    <td><form method="post" action="index.php?action=depublier">
                            <input type="hidden" name="num" value="<?= $convocationPubliee['NumConvoc'] ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button></form></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="row pt-5">
    <h1>Supprimer des convocations</h1>
    <div class="col-5">
        <h2>Pour un Joueur :</h2>
        <form method="post" action="index.php?action=supprimerConvocationsJoueur">
            <div class="form-group row">
                <label for="convocationsJoueur" class="col-2 col-form-label"> Joueur : </label>
                <div class="col">
                    <select name="idJoueur" id="convocationsMatchJoueur" class="form-select">
                    <?php foreach ($joueurs as $joueur): ?>
                        <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom']?> <?=$joueur['Prenom']?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row justify-content-center mt-2">
                <button type="submit" class="btn btn-danger col-5">Supprimer</button>
            </div>
        </form>
    </div>
</div>


<div class="row pt-5">
    <h1>Ajouter une Convocation</h1>
    <form method="post" action="index.php?action=ajouterConvocation">
        <div class="form-group row mb-3">
            <label for="convocationMatch" class="col-1 col-form-label">Match : </label>
            <div class="col-7">
                <select name="num" id="convocationMatch" class="form-select">
                <?php foreach ($matchs as $match): ?>
                    <option value="<?=$match['NumMatch']?>"><?=$match['Competition']?> - <?=$match['Equipe']?> le <?=$match['Date']?></option>
                <?php endforeach;?>
                </select>
            </div>
        </div>
        <!-- afficher le détail du match selectionné -->

        <?php for($i = 1; $i <= 11; $i++) : ?>
            <div class="form-group row">
                <div class="input-group mb-2">
                    <div class="input-group-prepend col-1">
                        <label for="convocationJoueur<?=$i?>" class="input-group-text">Joueur <?=$i?> </label>
                    </div>
                    <div class="col-4">
                        <select name="idJoueur<?=$i?>" id="convocationJoueur<?=$i?>" class="form-select" required>
                            <option value="" selected>choix</option>
                            <?php foreach ($joueurs as $joueur): ?>
                                <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom']?>  <?=$joueur['Prenom']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
        <?php endfor;?>


        <?php for($i = 12; $i <= 14; $i++) : ?>
            <div class="form-group row">
                <div class="input-group mb-2">
                    <div class="input-group-prepend col-1">
                        <label for="convocationJoueur<?=$i?>" c class="input-group-text">Joueur <?=$i?></label>
                    </div>
                    <div class="col-4">
                        <select name="idJoueur<?=$i?>" id="convocationJoueur<?=$i?>" class="form-select">
                            <option value="" selected>choix</option>
                            <?php foreach ($joueurs as $joueur): ?>
                                <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom']?>  <?=$joueur['Prenom']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
        <?php endfor;?>
        <div class="form-group row justify-content-center mt-2">
            <button type="submit" class="btn btn-primary col-3">Ajouter</button>
        </div>    </form>
</div>
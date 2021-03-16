
<?php $this->titre = "Convocations sportives"; ?>

<!---------------------- ABSENCES ---------------------->
<div class="row pt-5">
    <div class="col-6">
        <h1>Liste des Absents</h1>
        <table class="table border table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $absence): ?>
                <tr>
                    <td><?= $absence['Nom'] ?></td>
                    <td><?= $absence['Prenom'] ?></td>
                    <td><?= $absence['Date'] ?></td>
                    <td><?= $absence['Motif'] ?></td>
                    <td><form method="post" action="index.php?action=supprimerAbsence">
                            <input type="hidden" name="idJoueur" value="<?= $absence['IdJoueur'] ?>" />
                            <input type="hidden" name="date" value="<?= $absence['Date'] ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-user-slash"></i></button>
                        </form>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="offset-1 col-5">
        <h1>Ajouter une absence</h1>
        <form method="post" action="index.php?action=ajouterAbsence">
            <div class="form-group row mt-2">
                <label for="joueursAbs" class="col-4 col-form-label">Joueur : </label>
                <div class="col">
                    <select name="idJoueur" id="joueursAbs" class="form-select">
                        <?php foreach ($joueurs as $joueur): ?>
                            <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom'] . " " .$joueur['Prenom']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <label class="form-label">Motif de l'absence : </label>
            <div class="form-group row">
                <div class="offset-1 col-4">
                    <input type="radio" name="motif" id="absent" value="Absent" checked class="form-check-input mr-1"/><label for="absent" >&nbsp;&nbsp;Absent</label>
                </div>
                <div class="col">
                    <input type="radio" name="motif" id="blesse" value="Blessé" class="form-check-input mr-1"/><label for="blesse" >&nbsp;&nbsp;Blessé</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-1 col-4">
                    <input type="radio" name="motif" id="nonlicencie" value="Non licencié"  class="form-check-input mr-1"/><label for="nonlicencie">&nbsp;&nbsp;Non licencié</label>
                </div>
                <div class="col">
                    <input type="radio" name="motif" id="suspendu" value="Suspendu" class="form-check-input mr-1" /><label for="suspendu" >&nbsp;&nbsp;Suspendu</label>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label for="dateAbs" class="col-5 col-form-label">Absence Journalière :</label>
                <div class="col">
                    <input type="date" name="date" id="dateAbs" required class="form-control">
                </div>
            </div>
                <!--    <label>Absence Plagiaire :</label>-->
                <!--    <input type="date" name="dateabsence" id="dateAbsDeb">-->
                <!--    <input type="date" name="dateabsence" id="dateAbsFin">-->
                <!--    <br>-->
            <div class="form-group row justify-content-center mt-2">
                <button type="submit" class="btn btn-primary col-5">Confirmer l'absence</button>
            </div>
        </form>
    </div>
</div>

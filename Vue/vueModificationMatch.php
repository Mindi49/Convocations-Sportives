
<div class="row pt-5">
    <h1>Modifier un Match</h1>
    <form method="post" action="index.php?action=modfierMatch">
        <div class="form-group row">
            <label for="categorieMatch" class="col-3 col-form-label">Catégorie : </label>
            <div class="col-6">
                <select name="categorie" id="categorieMatch" class="form-select">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?=$categorie['Nom']?>" <?php if ($match['Categorie'] == $categorie['Nom']) echo "selected" ?>><?=$categorie['Nom']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="competitionMatch" class="col-3 col-form-label">Compétition : </label>
            <div class="col-6">
                <select name="competition" id="competitionMatch" class="form-select">
                    <?php foreach ($competitions as $competition): ?>
                        <option value="<?=$competition['Nom']?>"><?=$competition['Nom']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="equipeMatch" class="col-3 col-form-label">Equipe : </label>
            <div class="col-6">
                <select name="equipe" id="equipeMatch" class="form-select">
                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?=$equipe['Nom']?>"><?=$equipe['Nom']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="form-group row pt-2">
            <label for="equipeAdvMatch" class="col-3 col-form-label">Equipe adverse : </label>
            <div class="col-6">
                <input type="text" name="equipeadv" id="equipeAdvMatch" class="form-control">
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="dateCompetition" class="col-3 col-form-label">Date de la compétition : </label>
            <div class="col-6">
                <input type="date" name="date" id="dateCompetition" class="form-control" required>
            </div>
        </div>

        <div class="form-group row pt-2">
            <label for="heureCompetition" class="col-3 col-form-label">Heure de la compétition : </label>
            <div class="col-6">
                <input type="time" name="heure" id="heureCompetition" class="form-control" required>
            </div>
        </div>

        <div class="form-group row pt-2">
            <label for="terrain" class="col-3 col-form-label">Terrain : </label>
            <div class="col-6">
                <input type="text" id="terrain" name="terrain" size="12" class="form-control">
            </div>
        </div>

        <div class="form-group row pt-2">
            <label for="site" class="col-3 col-form-label">Site : </label>
            <div class="col-6">
                <input type="text" id="site" name="site" size="12" class="form-control">
            </div>
        </div>


        <div class="form-group row justify-content-center pt-2">
            <button type="submit" class="btn btn-primary col-5">Ajouter</button>
        </div>
    </form>
</div>
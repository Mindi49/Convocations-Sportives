
<?php $this->titre = "Convocations sportives"; ?>

<!---------------------- CONVOCATION ---------------------->
<hr />
<!-- voir la liste des convocs pour un match (tous les joueurs qui sont convoqués) -->
<!-- voir la liste des convocs pour un joueur (tous les matchs auxquels est convoqué le joueur) -->
<!-- ici la liste de toutes les convocs, le joueur et le match -->
<h1>Liste des Convocations (par joueur et par match)</h1>
<table class="liste">
    <?php foreach ($convocations as $convocation): ?>
        <tr>
            <td><a href=""><?= $convocation['Equipe'] ?> le <?= $convocation['Date'] ?> : <?= $convocation['Nom'] ?> <?= $convocation['Prenom'] ?> - <?= $convocation['Competition'] ?> - </a></td>
            <td><form method="post" action="index.php?action=supprimerConvocation">
                    <input type="hidden" name="num" value="<?= $convocation['NumConvoc'] ?>" />
                    <input type="submit" value="Supprimer" /></form></td>

        </tr>
    <?php endforeach; ?>
</table>
<br>

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

<h1>Supprimer des convocations</h1>
<h2>Pour un Match :</h2>
<form method="post" action="index.php?action=supprimerConvocationsMatch">
    <label for="convocationsMatch">Match : </label>
    <select name="num" id="convocationsMatch">
        <?php foreach ($matchs as $match): ?>
            <option value="<?=$match['NumMatch']?>"><?=$match['Competition']?> - <?=$match['Equipe']?> le <?=$match['Date']?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Supprimer toutes les convocations pour ce match" />
</form>

<br>
<h2>Pour un Joueur :</h2>
<form method="post" action="index.php?action=supprimerConvocationsJoueur">
    <label for="convocationsJoueur"> Joueur : </label>
    <select name="idJoueur" id="convocationsMatchJoueur">
        <?php foreach ($joueurs as $joueur): ?>
            <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom']?> <?=$joueur['Prenom']?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Supprimer toutes les convocations pour ce joueur" />
</form>


<h1>Ajouter une Convocation</h1>
<form method="post" action="index.php?action=ajouterConvocation">
    <label for="convocationMatch">Match : </label>
    <select name="num" id="convocationMatch">
        <?php foreach ($matchs as $match): ?>
            <option value="<?=$match['NumMatch']?>"><?=$match['Competition']?> - <?=$match['Equipe']?> le <?=$match['Date']?></option>
        <?php endforeach;?>
    </select>
    <!-- afficher le détail du match selectionné -->
    <br>
    <table>
    <?php for($i = 1; $i <= 11; $i++) : ?>
        <tr><td><label for="convocationJoueur<?=$i?>">Joueur<?=$i?> : </label><select name="idJoueur<?=$i?>" id="convocationJoueur<?=$i?>" required>
                    <option value="" selected>choix</option>
                    <?php foreach ($joueurs as $joueur): ?>
                        <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom']?>  <?=$joueur['Prenom']?></option>
                    <?php endforeach;?>
                </select></td></tr>
    <?php endfor;?>
    <?php for($i = 12; $i <= 14; $i++) : ?>
    <tr><td><label for="convocationJoueur<?=$i?>">Joueur<?=$i?> : </label><select name="idJoueur<?=$i?>" id="convocationJoueur<?=$i?>">
                <option value="" selected>choix</option>
                <?php foreach ($joueurs as $joueur): ?>
                    <option value="<?=$joueur['IdJoueur']?>"><?=$joueur['Nom']?>  <?=$joueur['Prenom']?></option>
                <?php endforeach;?>
            </select></td></tr>
    <?php endfor;?>
    </table>
    <br>
    <input type="submit" value="Ajouter">
</form>
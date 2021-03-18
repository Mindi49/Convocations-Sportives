<?php $this->titre = "Convocations sportives"; ?>

<div class="row mt-5">
    <div class="col-6">
        <h1>Se connecter</h1>
        <div class="card">
            <div class="card-body">
                <form method="post" action="index.php?action=connexion">
                    <div class="form-group row mt-2">
                        <label for="login" class="col-3 col-form-label">Utilisateur</label>
                        <div class="col">
                            <input type="text" class="form-control" id="login" placeholder="Nom d'utilisateur" ">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="password" class="col-3 col-form-label">Mot de passe</label>
                        <div class="col">
                            <input type="password" class="form-control" id="password" placeholder="Mot de Passe">
                        </div>
                        <div class="form-group row mt-2 justify-content-center">
                            <button type="submit" class="btn btn-primary col-5">Se connecter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="offset-1 col-5">
        <h1>Utilisateurs</h1>
        <table class="table border table-striped table-hover">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= $utilisateur['NomUtilisateur'] ?></td>
                    <td><?= $utilisateur['Role'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row py-5">
    <div class="col-5">
        <h2>Vous êtes entraîneur :</h2>
        <div class="list-group mt-3">
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Gérer les convocations</h5>
                </div>
                <p class="mb-1">Créez des convocation : convoquez vos joueurs pour un match parmi ceux proposés. Modifiez les ou supprimez celles que vous souhaitez. Publiez les ensuite pour les rendre accessibles par tous !</p>
            </div>
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Accéder aux absences</h5>
                </div>
                <p class="mb-1">Suivez les absences de vos joueurs et adapter vos équipes en fonction.</p>
            </div>
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Accéder aux matchs programmés</h5>
                </div>
                <p class="mb-1">Prenez de l'avance en consultant les matchs à suivre, vos équipes mise en jeu ainsi que les dates de ces évènements.</p>
            </div>
        </div>
    </div>

    <div class="offset-2 col-5">
        <h2>Vous êtes secrétaire :</h2>
        <div class="list-group mt-3">
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Programmer des matchs</h5>
                </div>
                <p class="mb-1">Ajouter des matchs : les lieux, dates, heures, compétitions et équipes mises en jeu. Mettez à jour les matchs ou supprimez ceux qui ne sont plus d'actualité.</p>
            </div>
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Gérer les absences</h5>
                </div>
                <p class="mb-1">Contrôlez les absences des joueurs du club, ceux-ci ne pourront pas être convoqués aux matchs.</p>
            </div>
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Administrer les joueurs</h5>
                </div>
                <p class="mb-1">Gérez les inscriptions de joueurs, l'ajout de nouvelles licences ou leur suppression.</p>
            </div>
        </div>
    </div>
</div>